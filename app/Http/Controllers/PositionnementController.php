<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\User;
use App\Models\Positionnement;
use App\Models\FichePositionnement;
use App\Models\Activite;
use App\Models\Tache;
use App\Models\Metier;
use App\Models\Ifad;
use App\Models\Suivi;
use App\Models\Entreprise;
use App\Models\Historique;

class PositionnementController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');//->except(['index'])
    }

    public function index()
    {
        $this->authorize('ad_re_su_ch', User::class);
        try
        {
            $user_email = (Auth::user()->email);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

            if($profil_libelle == 'Administrateur' || $profil_libelle == 'Responsable pédagogique' || $profil_libelle == 'Suivi_AED')
           {
                $suivis = Suivi::select('*')->orderBy('id','DESC')->get();

                return view('positionnements.index', compact('suivis'));
           }
           else
           {
               if(Entreprise::where('emailentreprise','=',$user_email)->select('id')->exists())
               {
                    $entreprise = Entreprise::where('emailentreprise','=',$user_email)->select('*')->first();

                    $suivis = Suivi::where('entreprise_id','=',$entreprise->id)->select('*')->orderBy('id','DESC')->get();

                    return view('positionnements.index', compact('suivis'));
               }
               else
               {
                   return back()->with('messagealert', "Pas de droit nécessaire.");
               }
           }

        }
        catch(\Exception $exception)
        {
        return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function recup_metier(User $user)
    {
        if(Metier::select('*')->doesntExist())
        {
           return back()->with('messagealert', "Ajouter au moins un métier.");
        }
        else
        {
            if(DB::table('associations')->where('associations.user_id','=',$user->id)->select('associations.id')->doesntExist())
            {
                return back()->with('messagealert',"L'apprenant(e) n'est pas associé à un IFAD");
            }
            else
            {
                $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$user->nomuser." ".$user->prenomuser;

                if(FichePositionnement::where('libellefiche','=',$fiche_positionnement)->select('id')->exists())
                {
                    return redirect('positionnements')->with('messagealert',"L'apprenant(e) ".$user->nomuser." ".$user->prenomuser." a déjà été positionné(e) aujourd'hui");
                }
                else
                {
                    $ifad_id = DB::table('associations')->where('associations.user_id','=',$user->id)
                    ->select('ifad_id')->get()->last()->ifad_id;

                    $metiers = Metier::where('ifad_id','=',$ifad_id)->select('*')->get();

                    return view('positionnements.recup_metier',compact('metiers','user'));
                }
            }
        }
    }

    /**
     * return states list.
     *
     * @return json
     */
    public function getUser(Request $request)
    {
        try
        {
          $user_id = (Auth::user()->id);

            $users = DB::table('profils')
            ->join('users','profils.id','=','users.profil_id')
            ->join('associations','users.id','=','associations.user_id')
            ->join('ifads','ifads.id','=','associations.ifad_id')
            ->select('users.id','users.nomuser','users.prenomuser')
            ->where('profils.libelleprofil', 'Apprenant')
            ->where('ifads.id', $request->ifad_id)
            ->distinct('users.id')
            ->orderBy('users.id')
            ->get();

            if (count($users) > 0)
            {
                return response()->json($users);
            }

        }
            catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function create()
    {
        $this->authorize('ad_re_su_ch', User::class);
        try
        {

            $user_id = (Auth::user()->id);
            $profil = (Auth::user()->profil_id);

            $recup_user_id = request('user_id');
            $metier_id = request('metier_id');

            //dd($user , $metier);
            if($recup_user_id == null)
            {
                return back()->with('messagealert', "Sélectionner un(e) apprenant(e).");
            }
            elseif($metier_id == null)
            {
                return back()->with('messagealert', "Sélectionner un métier.");
            }
            else
            {
                if(DB::table('activites')->join('taches','activites.id','=','taches.activite_id')
                ->where('activites.metier_id','=',$metier_id)->select('taches.id')->doesntExist())
                {
                  return back()->with('messagealert', "Ajouter au moins une tâche à ce métier.");
                }
                else
                {
                    $positionnement = new Positionnement();

                    $users = User::select('*')->where('id','=',$recup_user_id)->first();

                    $metiers = Metier::select('*')->where('id','=',$metier_id)->first();

                    /** selection des activites metiers par activites **/
                    $activites = Activite::where('metier_id','=',$metier_id)->select('*')->orderBy('id')->distinct('id')->get();

                    $i = 0;
                    foreach($activites as $activite)
                    {
                        $tab_activite_id[$i] = $activite->id;
                        $tab_activite_libelle[$i] = $activite->libelleactivite;


                        $tab_tache[$i] = DB::table('activites')
                        ->join('taches','activites.id','=','taches.activite_id')
                        ->select('taches.*','activites.id as id_activite')
                        ->where('activites.id','=',$tab_activite_id[$i])
                        ->where('activites.metier_id','=',$metier_id)
                        ->orderBy('activites.id')
                        ->distinct('activites.id')
                        ->get();

                        $collections[$i] = collect(['activite_id' => $tab_activite_id[$i], 'activite_libelle' => $tab_activite_libelle[$i], 'taches' => $tab_tache[$i]])->all();

                        $i++;
                    }

                    return view('positionnements.create',compact('collections','users','metiers'));
                }
            }

        }
        catch(\Exception $exception)
        {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function store()
    {
        $this->authorize('ad_re_su_ch', User::class);
      try
      {
            $auth = Auth::user()->id;
            $auth_email = Auth::user()->email;
            $tel_entreprise = request('tel_entreprise');
            $adresse_entreprise = request('adresse_entreprise');
            $nom_tuteur = request('nom_tuteur');
            $prenom_tuteur = request('prenom_tuteur');
            $tel_tuteur = request('tel_tuteur');
            $user_id = request('user_id');
            $metier_id = request('metier_id');
            $metier_libelle = request('metier_libelle');

        if(Entreprise::where('emailentreprise','=',$auth_email)->select('id')->exists())
        {
            $entreprise_recup = Entreprise::where('emailentreprise','=',$auth_email)->select('*')->first();

            $entreprise = Entreprise::where('emailentreprise','=',$entreprise_recup->emailentreprise)->select('*')->first();

            $nom_entreprise      = $entreprise->libelleentreprise;
            $mail_entreprise     = $entreprise->emailentreprise;
            $tel_entreprise      = request('tel_entreprise');
            $adresse_entreprise  = request('adresse_entreprise');

            if($tel_entreprise == null)
            {
                $tel_entreprise = $entreprise->telentreprise;
            }
            if($adresse_entreprise == null)
            {
                $adresse_entreprise = $entreprise->adresseentreprise;
            }

            $user = DB::table('entreprises')
                   ->where('entreprises.id','=',$entreprise->id)
                   ->update(['entreprises.telentreprise' => $tel_entreprise,
                             'entreprises.adresseentreprise' => $adresse_entreprise
                    ]);
        }
        else
        {
            $tel_entreprise = request('tel_entreprise');
            $adresse_entreprise = request('adresse_entreprise');
            $nom_entreprise = null;
            $mail_entreprise = null;
        }

        $users = User::select('*')->where('id','=',$user_id)->first();

        $association = DB::table('associations')
        ->where('associations.user_id','=',$user_id)
        ->select('associations.id')->get()->last();

        $responsable_suivi_id = Auth::user()->id;
        $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$users->nomuser." ".$users->prenomuser;

        /** Recuperation des valeurs **/
        $taches = DB::table('activites')->join('taches','activites.id','=','taches.activite_id')
        ->where('activites.metier_id','=',$metier_id)->select('taches.*')->get();

            $nombre_tache = 0;
            $t = 1;
            foreach($taches as $tache_value)
            {
               $value_id[$t]= request('valeurpost_'.$tache_value->id);

               if($value_id[$t] != null)
               {
                   if($value_id[$t] != 0)
                   {
                     $nombre_tache = $nombre_tache +1;
                   }
               }
               $t++;
            }

            if($nombre_tache == 0)
            {
                return back()->with('messagealert', "Fiche de positionnement non enregistrée. Vous n'avez pas positionné l'apprenant(e).");
            }

           /** Enregistrement du livret de positionnement et recuperation de id **/
            $fiche = FichePositionnement::insertGetId([
             'libellefiche'=> $fiche_positionnement,
             'nom_entreprise'=> $nom_entreprise,
             'tel_entreprise'=> $tel_entreprise,
             'email_entreprise'=> $mail_entreprise,
             'adresse_entreprise'=> $adresse_entreprise,
             'nom_tuteur'=> $nom_tuteur,
             'prenom_tuteur'=> $prenom_tuteur,
             'tel_tuteur'=> $tel_tuteur,
             'metier_apprenant'=> $metier_libelle,
             'dateenregistrement'=>now(),
             'association_id'=> $association->id,
             'responsable_suivi_id'=> $responsable_suivi_id,
             'etat'=> 0,
             'etatsup'=> 0]);

            $i = 1;
            foreach($taches as $tache_value)
            {
               $value_id[$i]= request('valeurpost_'.$tache_value->id);

               if($value_id[$i] != null)
               {
                   if($value_id[$i] != 0)
                   {
                        /** enregistrement des positionnements **/
                        $positionnement = Positionnement::create([
                            'valeurpost'=> $value_id[$i],
                            'fiche_positionnement_id'=> $fiche,
                            'tache_id'=> $tache_value->id,]);
                   }
               }

               $i++;
            }

             $this->historique($fiche_positionnement, 'Ajout');

             return redirect('fiche_positionnements/show/'.$fiche)->with('message', "Fiche de positionnement bien enregistrée.");

      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
    }


    public function edit(Positionnement $positionnement)
    {
        $this->authorize('ad_re_su_ch', User::class);
      try
      {
        $activites = DB::table('activites')
        ->join('positionnements','activites.id','=','positionnements.activite_id')
        ->where('positionnements.id','=', $positionnement->id)
        ->select('positionnements.*','activites.libelleactivite')
        ->get();

        return view('positionnements.edit', compact('activites'));
      }
      catch(\Exception $exception)
     {
         return redirect('erreur')->with('messageerreur',$exception->getMessage());
     }
    }

    public function update(Positionnement $positionnement)
     {
        $this->authorize('ad_re_su_ch', User::class);
       try
       {
          $fiche_id = request('fiche_id');

          $positionnement->update(['valeurpost'=> request('valeurpost')]);

          return redirect('fiche_positionnements/' . $fiche_id)->with('message', "Fiche de positionnement mise à jour");
        }
        catch(\Exception $exception)
       {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Positionnement',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }

}
