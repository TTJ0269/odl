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
use App\Models\GroupeActivite;
use App\Models\Activite;
use App\Models\Tache;
use App\Models\Metier;
use App\Models\Ifad;
use App\Models\Suivi;
use App\Models\Entreprise;
use App\Models\Appartenance;
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
               if(Appartenance::where('user_id','=',Auth::user()->id)->select('id')->exists())
               {
                    $entreprise = Appartenance::where('user_id','=',Auth::user()->id)->select('*')->get()->last();

                    $suivis = Suivi::where('entreprise_id','=',$entreprise->entreprise_id)->select('*')->orderBy('id','DESC')->get();

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

    public function recup_metier(Suivi $suivi)
    {
        if(Metier::select('*')->doesntExist())
        {
           return back()->with('messagealert', "Ajouter au moins un métier.");
        }
        else
        {
            if(DB::table('associations')->where('associations.user_id','=',$suivi->user_id)->select('associations.id')->doesntExist())
            {
                return back()->with('messagealert',"L'apprenant(e) n'est pas associé à un IFAD");
            }
            else
            {
                $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$suivi->user->nomuser." ".$suivi->user->prenomuser;

                if(FichePositionnement::where('libellefiche','=',$fiche_positionnement)->select('id')->exists())
                {
                    return redirect('positionnements')->with('messagealert',"L'apprenant(e) ".$suivi->user->nomuser." ".$suivi->user->prenomuser." a déjà été positionné(e) aujourd'hui");
                }
                else
                {
                    $ifad_id = DB::table('associations')->where('associations.user_id','=',$suivi->user_id)
                    ->select('ifad_id')->get()->last()->ifad_id;

                    $metiers = Metier::where('ifad_id','=',$ifad_id)->select('*')->get();

                    return view('positionnements.recup_metier',compact('metiers','suivi'));
                }
            }
        }
    }

    /**
     * return states list.
     *
     * @return json
     */
    public function getGroupeActivite(Request $request)
    {
        try
        {
          $user_id = (Auth::user()->id);

            $groupe_activites = DB::table('groupe_activites')
            ->select('groupe_activites.id','groupe_activites.identifiantgroupe','groupe_activites.libellegroupe')
            ->where('groupe_activites.metier_id', $request->metier_id)
            ->distinct('groupe_activites.id')
            ->orderBy('groupe_activites.id')
            ->get();

            if (count($groupe_activites) > 0)
            {
                return response()->json($groupe_activites);
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

            $recup_suivi_id = request('suivi_id');
            $groupe_activite_id = request('groupe_activite_id');
            //dd($groupe_activite_id);

            if($recup_suivi_id == null)
            {
                return back()->with('messagealert', "Sélectionner un(e) apprenant(e).");
            }
            elseif($groupe_activite_id == null)
            {
                return back()->with('messagealert', "Sélectionner un groupe d'activité.");
            }
            else
            {
                if(DB::table('groupe_activites')->join('activites','groupe_activites.id','=','activites.groupe_activite_id')
                ->join('taches','activites.id','=','taches.activite_id')
                ->where('activites.groupe_activite_id','=',$groupe_activite_id)->select('taches.id')->doesntExist())
                {
                  return back()->with('messagealert', "Ajouter au moins une tâche à ce groupe.");
                }
                else
                {
                    $positionnement = new Positionnement();

                    $suivis = Suivi::select('*')->where('id','=',$recup_suivi_id)->first();

                    $groupe_activites = GroupeActivite::select('*')->where('id','=',$groupe_activite_id)->first();

                    /** selection des activites metiers par activites **/
                    $activites = Activite::where('groupe_activite_id','=',$groupe_activite_id)->select('*')->orderBy('id')->distinct('id')->get();

                    $i = 0;
                    foreach($activites as $activite)
                    {
                        $tab_activite_id[$i] = $activite->id;
                        $tab_activite_libelle[$i] = $activite->libelleactivite;


                        $tab_tache[$i] = DB::table('activites')
                        ->join('taches','activites.id','=','taches.activite_id')
                        ->select('taches.*','activites.id as id_activite')
                        ->where('activites.id','=',$tab_activite_id[$i])
                        ->where('activites.groupe_activite_id','=',$groupe_activite_id)
                        ->orderBy('activites.id')
                        ->distinct('activites.id')
                        ->get();

                        $collections[$i] = collect(['activite_id' => $tab_activite_id[$i], 'activite_libelle' => $tab_activite_libelle[$i], 'taches' => $tab_tache[$i]])->all();

                        $i++;
                    }

                    return view('positionnements.create',compact('collections','suivis','groupe_activites'));
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
            $nom_tuteur =  Auth::user()->nomuser;//request('nom_tuteur');
            $prenom_tuteur = Auth::user()->prenomuser; //request('prenom_tuteur');
            $tel_tuteur = Auth::user()->teluser; //request('tel_tuteur');
            $suivi_id = request('suivi_id');
            $groupe_activite_id = request('groupe_activite_id');
            $metier_libelle = request('metier_libelle');

        if(Appartenance::where('user_id','=',Auth::user()->id)->select('id')->exists())
        {
            $entreprise_recup = Appartenance::where('user_id','=',Auth::user()->id)->select('*')->get()->last();

            $entreprise = Entreprise::where('id','=',$entreprise_recup->entreprise_id)->select('*')->first();

            $nom_entreprise      = $entreprise->libelleentreprise;
            $mail_entreprise     = $entreprise->emailentreprise;
            $tel_entreprise      = $entreprise->telentreprise;
            $adresse_entreprise  = $entreprise->adresseentreprise;

            /** date debut suivi **/
            if(Suivi::where('id','=',$suivi_id)->select('datedebut')->first()->datedebut == null)
            {
                DB::table('suivis')->where('suivis.id','=',$suivi_id)->update(['suivis.datedebut' => now()]);
            }
        }
        else
        {
            $tel_entreprise = null;
            $adresse_entreprise = null;
            $nom_entreprise = null;
            $mail_entreprise = null;
        }

        $suivi = Suivi::select('*')->where('id','=',$suivi_id)->first();
        $users = User::select('*')->where('id','=',$suivi->user_id)->first();

        $association = DB::table('associations')
        ->where('associations.user_id','=',$suivi->user_id)
        ->select('associations.id')->get()->last();

        $responsable_suivi_id = Auth::user()->id;
        $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$users->nomuser." ".$users->prenomuser;

        /** Recuperation des valeurs **/
        $taches = DB::table('groupe_activites')
        ->join('activites','groupe_activites.id','=','activites.groupe_activite_id')
        ->join('taches','activites.id','=','taches.activite_id')
        ->where('activites.groupe_activite_id','=',$groupe_activite_id)->select('taches.*')->get();

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
