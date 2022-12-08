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
use App\Models\Classe;
use App\Models\Suivi;
use App\Models\Rattacher;
use App\Models\Association;
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
        $this->authorize('ad_re_su_ch_fo', User::class);
        try
        {
            $user_email = (Auth::user()->email);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;


           if($profil_libelle == 'Formateur_IFAD')
           {
                if(Rattacher::where('user_id','=',Auth::user()->id)->select('*')->doesntExist())
                {
                    return back()->with('messagealert', "Vous n'est pas rattaché(e) à un Métier.");
                }
            }

            $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();

            return view('positionnements.index_apprenant_classe', compact('metiers'));

        }
        catch(\Exception $exception)
        {
        return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    /**
     * return states list.
     *
     * @return json
     */
    public function getClasse(Request $request)
    {
        try
        {
          $user_id = (Auth::user()->id);

            $classes = Classe::where('metier_id', $request->metier_id)->select('*')->distinct('id')->orderBy('id')->get();

            if (count($classes) > 0)
            {
                return response()->json($classes);
            }

        }
            catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function getApprenant(Request $request)
    {
       /* try
        {
            $user_email = (Auth::user()->email);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

            if($profil_libelle == 'Administrateur' || $profil_libelle == 'Responsable pédagogique' || $profil_libelle == 'Suivi_AED')
           {
                //$suivis = Suivi::select('*')->where('datefin','=',null)->orderBy('id','DESC')->get();

                $users =  DB::table('profils')
                ->join('users','profils.id','=','users.profil_id')
                ->join('associations','users.id','=','associations.user_id')
                ->join('classes','classes.id','=','associations.classe_id')
                ->join('metiers','metiers.id','=','classes.metier_id')
                ->where('profils.libelleprofil','=','Apprenant')
                ->where('classes.id','=',$request->classe_id)
                ->select('users.*','classes.libelleclasse','metiers.id as ood')
                ->distinct('users.id')->orderBy('users.id','DESC')->get();

                if (count($users) > 0)
                {
                    return response()->json($users);
                }

           }
           elseif($profil_libelle == 'Chargé du suivi')
           {
               if(Appartenance::where('user_id','=',Auth::user()->id)->select('id')->exists())
               {
                    $entreprise = Appartenance::where('user_id','=',Auth::user()->id)->select('*')->get()->last();

                    //$suivis = Suivi::where('entreprise_id','=',$entreprise->entreprise_id)->where('datefin','=',null)->select('*')->orderBy('id','DESC')->get();

                    $suivis =  DB::table('entreprises')
                    ->join('suivis','entreprises.id','=','suivis.entreprise_id')
                    ->join('users','users.id','=','suivis.user_id')
                    ->join('associations','users.id','=','associations.user_id')
                    ->join('classes','classes.id','=','associations.classe_id')
                    ->join('metiers','metiers.id','=','classes.metier_id')
                    ->where('entreprises.id','=',$entreprise->entreprise_id)
                    ->where('suivis.datefin','=',null)
                    ->where('classes.id','=',$request->classe_id)
                    ->select('suivis.*','users.id as id_user','users.nomuser','users.prenomuser','users.imageuser','entreprises.libelleentreprise','classes.libelleclasse')
                    ->distinct('suivis.id')->orderBy('id','DESC')->get();

                    if(count($suivis) > 0)
                    {
                        return response()->json($suivis);
                    }
               }
               else
               {
                   return back()->with('messagealert', "Pas de droit nécessaire.");
               }
           }
           else
           {
                $formateurs = Rattacher::where('user_id','=',Auth::user()->id)->select('*')->get()->last();

                //dd($formateurs);

                $users =  DB::table('profils')
                ->join('users','profils.id','=','users.profil_id')
                ->join('associations','users.id','=','associations.user_id')
                ->join('classes','classes.id','=','associations.classe_id')
                ->join('metiers','metiers.id','=','classes.metier_id')
                ->where('profils.libelleprofil','=','Apprenant')
                ->where('metiers.id','=',$formateurs->metier_id)
                ->where('classes.id','=',$request->classe_id)
                ->select('users.*','classes.libelleclasse','metiers.id as ood')
                ->distinct('users.id')->orderBy('users.id','DESC')->get();

                if (count($users) > 0)
                {
                    return response()->json($users);
                }
            }
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }*/
    }

    public function classe_apprenant()
    {
        $this->authorize('ad_re_su_ch_fo', User::class);
        try
        {
            $user_email = (Auth::user()->email);
            $profil_id = (Auth::user()->profil_id);

            $classe_id = request('classe_id');

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

            if($classe_id == null)
            {
                return back()->with('messagealert', "Sélectionner une classe.");
            }

            if($profil_libelle == 'Administrateur' || $profil_libelle == 'Suivi_AED')
           {
                //$suivis = Suivi::select('*')->where('datefin','=',null)->orderBy('id','DESC')->get();

                $users =  DB::table('profils')
                ->join('users','profils.id','=','users.profil_id')
                ->join('associations','users.id','=','associations.user_id')
                ->join('classes','classes.id','=','associations.classe_id')
                ->join('metiers','metiers.id','=','classes.metier_id')
                ->where('profils.libelleprofil','=','Apprenant')
                ->where('classes.id','=',$classe_id)
                ->select('users.*','classes.libelleclasse','metiers.id as ood')
                ->distinct('users.id')->orderBy('users.id','DESC')->get();

                return view('positionnements.index_apprenant', compact('users'));

           }
           elseif($profil_libelle == 'Chargé du suivi')
           {
               if(Appartenance::where('user_id','=',Auth::user()->id)->select('id')->exists())
               {
                    $entreprise = Appartenance::where('user_id','=',Auth::user()->id)->select('*')->get()->last();

                    //$suivis = Suivi::where('entreprise_id','=',$entreprise->entreprise_id)->where('datefin','=',null)->select('*')->orderBy('id','DESC')->get();

                    $suivis =  DB::table('entreprises')
                    ->join('suivis','entreprises.id','=','suivis.entreprise_id')
                    ->join('users','users.id','=','suivis.user_id')
                    ->join('associations','users.id','=','associations.user_id')
                    ->join('classes','classes.id','=','associations.classe_id')
                    ->join('metiers','metiers.id','=','classes.metier_id')
                    ->where('entreprises.id','=',$entreprise->entreprise_id)
                    ->where('suivis.datefin','=',null)
                    ->where('classes.id','=',$classe_id)
                    ->select('suivis.*','users.id as id_user','users.nomuser','users.prenomuser','users.imageuser','entreprises.libelleentreprise','classes.libelleclasse')
                    ->distinct('suivis.id')->orderBy('id','DESC')->get();

                    return view('positionnements.index', compact('suivis'));
               }
               else
               {
                   return back()->with('messagealert', "Pas de droit nécessaire.");
               }
           }
           else
           {
                $formateurs = Rattacher::where('user_id','=',Auth::user()->id)->select('*')->get()->last();

                //dd($formateurs);

                $users =  DB::table('profils')
                ->join('users','profils.id','=','users.profil_id')
                ->join('associations','users.id','=','associations.user_id')
                ->join('classes','classes.id','=','associations.classe_id')
                ->join('metiers','metiers.id','=','classes.metier_id')
                ->where('profils.libelleprofil','=','Apprenant')
                ->where('metiers.id','=',$formateurs->metier_id)
                ->where('classes.id','=',$classe_id)
                ->select('users.*','classes.libelleclasse','metiers.id as ood')
                ->distinct('users.id')->orderBy('users.id','DESC')->get();

                return view('positionnements.index_apprenant', compact('users'));
            }
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function recup_apprenant(User $user)
    {
        $this->authorize('ad_re_su_ch_fo', User::class);
        try
        {
            if(DB::table('associations')->where('associations.user_id','=',$user->id)->select('associations.id')->doesntExist())
            {
                return back()->with('messagealert',"L'apprenant(e) n'est pas associé à un IFAD");
            }

            $association = Association::where('user_id','=',$user->id)
            ->select('*')->get()->last();

            $fiche_positionnements = DB::table('users')
            ->join('associations','users.id','=','associations.user_id')
            ->join('classes','classes.id','=','associations.classe_id')
            ->join('metiers','metiers.id','=','classes.metier_id')
            ->join('ifads','ifads.id','=','metiers.ifad_id')
            ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
            ->where('users.id','=',$user->id)
            ->select('fiche_positionnements.*','classes.libelleclasse','ifads.libelleifad')
            ->distinct('fiche_positionnements.id')
            ->orderBy('fiche_positionnements.id','DESC')
            ->get();

            return view('positionnements.recup_apprenant',compact('fiche_positionnements','user','association'));

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function create(User $user)
    {
        $this->authorize('ad_re_su_ch_fo', User::class);
        try
        {
            $user_id = (Auth::user()->id);
            $profil = (Auth::user()->profil_id);


            if(DB::table('associations')->where('associations.user_id','=',$user->id)->select('associations.id')->doesntExist())
            {
                return back()->with('messagealert',"L'apprenant(e) n'est pas associé à un IFAD");
            }

            $association = Association::where('user_id','=',$user->id)
            ->select('*')->get()->last();

            $metier_id = $association->classe->metier->id;

            if(Metier::where('id','=',$metier_id)->select('*')->doesntExist())
            {
                return back()->with('messagealert', "Ajouter un métier de l'apprenant(e).");
            }
            else
            {
                $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y H-i-s')." de ".$user->nomuser." ".$user->prenomuser;

                if(FichePositionnement::where('libellefiche','=',$fiche_positionnement)->select('id')->exists())
                {
                    return redirect('positionnements')->with('messagealert',"L'apprenant(e) ".$user->nomuser." ".$user->prenomuser." a déjà été positionné(e) aujourd'hui");
                }
                else
                {
                    //$classe_id = DB::table('associations')->where('associations.user_id','=',$suivis->user_id)
                    //->select('classe_id')->get()->last()->classe_id;

                    //$ifad_id = Classe::where('id','=',$classe_id)->select('*')->first()->ifad_id;

                    //$metier = Metier::where('ifad_id','=',$ifad_id)->select('*')->first();

                    if(DB::table('metiers')->join('groupe_activites','metiers.id','=','groupe_activites.metier_id')
                    ->join('activites','groupe_activites.id','=','activites.groupe_activite_id')
                    ->join('taches','activites.id','=','taches.activite_id')
                    ->where('groupe_activites.metier_id','=',$metier_id)->select('taches.id')->doesntExist())
                    {
                        return back()->with('messagealert', "Ajouter au moins une tâche au métier de l'apprenant(e).");
                    }
                    else
                    {
                        $positionnement = new Positionnement();

                        /** selection des groupe_activite par metier **/
                        $groupe_activites = GroupeActivite::select('*')->where('metier_id','=',$metier_id)->orderBy('id')->distinct('id')->get();

                        $i = 0;
                        foreach($groupe_activites as $groupe_activite)
                        {
                            $tab_groupe_activite_id[$i] = $groupe_activite->id;
                            $tab_groupe_activite_libelle[$i] = $groupe_activite->libellegroupe;

                            /** Groupe_activite = fonction **/


                            $tab_activites[$i] = Activite::select('*')->where('groupe_activite_id','=',$tab_groupe_activite_id[$i])
                            ->orderBy('id')->distinct('id')->get();

                                $a = 0;
                                foreach($tab_activites[$i] as $tab_activite)
                                {
                                    $tab_activite_id[$a] = $tab_activite->id;
                                    $tab_activite_libelle[$a] = $tab_activite->libelleactivite;

                                    /** recuperation de tous les positionnements de toutes les fiches d'un apprenant
                                     * l'apprenant de peut pas avoir un positionnement inferieur par rapport aux anciens positionnements**/

                                        $all_taches = Tache::select(DB::raw('0 as valeurpost'),'taches.id','taches.libelletache')->where('activite_id','=',$tab_activite_id[$a])
                                        ->orderBy('id')->distinct('id')->get();

                                         $t = 0;
                                         foreach($all_taches as $all_tache)
                                         {
                                            if(DB::table('taches')
                                            ->join('positionnements','taches.id','=','positionnements.tache_id')
                                            ->join('fiche_positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
                                            ->join('associations','associations.id','=','fiche_positionnements.association_id')
                                            ->where('associations.user_id','=',$user->id)
                                            ->where('taches.id','=',$all_tache->id)
                                            ->where('taches.activite_id','=',$tab_activite_id[$a])->exists())
                                            {
                                                $valeur[$t] = DB::table('taches')
                                                ->join('positionnements','taches.id','=','positionnements.tache_id')
                                                ->join('fiche_positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
                                                ->join('associations','associations.id','=','fiche_positionnements.association_id')
                                                ->where('taches.id','=',$all_tache->id)
                                                ->where('associations.user_id','=',$user->id)
                                                ->where('taches.activite_id','=',$tab_activite_id[$a])
                                                ->select(DB::raw('MAX(positionnements.valeurpost) as valeurpost'),'taches.id','taches.libelletache')
                                                ->groupBy('taches.id','taches.libelletache')
                                                ->distinct('taches.id')
                                                ->first();

                                                $t++;
                                            }
                                            else
                                            {
                                                $valeur[$t] = DB::table('taches')->select(DB::raw('0 as valeurpost'),'taches.id','taches.libelletache')->where('id','=',$all_tache->id)
                                                ->where('activite_id','=',$tab_activite_id[$a])->orderBy('id')->distinct('id')->first();

                                                $t++;
                                            }

                                         }

                                         $tab_taches[$a] = $valeur;

                                    /** Recuperation des taches selon l'activité **/

                                    /*$tab_taches[$a] = Tache::select('*')->where('activite_id','=',$tab_activite_id[$a])
                                    ->orderBy('id')->distinct('id')->get();*/

                                    $collection_taches[$a] = collect(['activite_id' => $tab_activite_id[$a], 'activite_libelle' => $tab_activite_libelle[$a], 'taches' => $tab_taches[$a]])->all();

                                    /** vider le contenu avant de reprendre **/
                                    $valeur = null;
                                    $tab_taches[$a] = null;

                                    $a++;
                                }



                            $collections[$i] = collect(['fonction_id' => $tab_groupe_activite_id[$i], 'focntion_libelle' => $tab_groupe_activite_libelle[$i], 'activites' => $collection_taches])->all();

                            /** Vider la collection **/
                            $collection_taches = null;

                            $i++;

                        }

                        //dd($collections);

                        $metiers = Metier::where('id','=',$metier_id)->select('*')->first();

                        return view('positionnements.create',compact('collections','user','metiers'));
                    }
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
        $this->authorize('ad_re_su_ch_fo', User::class);
      try
      {
            $auth = Auth::user()->id;
            $auth_email = Auth::user()->email;
            $nom_tuteur =  Auth::user()->nomuser;//request('nom_tuteur');
            $prenom_tuteur = Auth::user()->prenomuser; //request('prenom_tuteur');
            $tel_tuteur = Auth::user()->teluser; //request('tel_tuteur');
            $user_id = request('user_id');
            $metier_id = request('metier_id');
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
            if(Suivi::where('user_id','=',$user_id)->select('datedebut')->exists())
            {
                if(Suivi::where('user_id','=',$user_id)->select('datedebut')->get()->last()->datedebut == null)
                {
                    $suivi_id = Suivi::where('user_id','=',$user_id)->select('*')->get()->last()->id;

                    Suivi::where('id','=',$suivi_id)->update(['datedebut' => now()]);
                }
            }
        }
        else
        {
            $tel_entreprise = null;
            $adresse_entreprise = null;
            $nom_entreprise = null;
            $mail_entreprise = null;
        }

        $users = User::where('id','=',$user_id)->select('*')->first();

        $association = DB::table('associations')
        ->where('associations.user_id','=',$users->id)
        ->select('associations.id')->get()->last();

        $responsable_suivi_id = Auth::user()->id;
        $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y H-i-s')." de ".$users->nomuser." ".$users->prenomuser;

        /** Recuperation des valeurs **/
        $taches = DB::table('metiers')->join('groupe_activites','metiers.id','=','groupe_activites.metier_id')
        ->join('activites','groupe_activites.id','=','activites.groupe_activite_id')
        ->join('taches','activites.id','=','taches.activite_id')
        ->where('groupe_activites.metier_id','=',$metier_id)->select('taches.*')->get();

            $nombre_tache = 0;
            $t = 1;
            foreach($taches as $tache_value)
            {
               $value_id[$t]= request('valeurpost_'.$tache_value->id);

               if($value_id[$t] != null)
               {

                   if($value_id[$t] != 0)
                   {
                        if(DB::table('taches')
                        ->join('positionnements','taches.id','=','positionnements.tache_id')
                        ->join('fiche_positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
                        ->join('associations','associations.id','=','fiche_positionnements.association_id')
                        ->where('associations.user_id','=',$users->id)
                        ->where('taches.id','=',$tache_value->id)
                        ->select('positionnements.valeurpost')->exists())
                        {
                            $positionnement_fiche = DB::table('taches')
                            ->join('positionnements','taches.id','=','positionnements.tache_id')
                            ->join('fiche_positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
                            ->join('associations','associations.id','=','fiche_positionnements.association_id')
                            ->where('associations.user_id','=',$users->id)
                            ->where('taches.id','=',$tache_value->id)
                            ->select(DB::raw('MAX(positionnements.valeurpost) as valeurpost'),'taches.libelletache')
                            ->groupBy('taches.id','taches.libelletache')
                            ->distinct('taches.id')
                            ->first();


                            if($positionnement_fiche->valeurpost < $value_id[$t])
                            {
                                $nombre_tache = $nombre_tache +1;
                            }

                        }
                        else
                        {
                            $nombre_tache = $nombre_tache +1;
                        }
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
                    /** recuperer toutes les fiches de l'apprenant(e) selon la tache donnée et recuperer
                     * la plus grande valeur et si la valeur recuperée de la fiche
                     *  est superieur a l'ancien valeur
                     * de toutes les anciens **/
                        if(DB::table('taches')
                        ->join('positionnements','taches.id','=','positionnements.tache_id')
                        ->join('fiche_positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
                        ->join('associations','associations.id','=','fiche_positionnements.association_id')
                        ->where('associations.user_id','=',$users->id)
                        ->where('taches.id','=',$tache_value->id)
                        ->select('positionnements.valeurpost')->exists())
                        {
                            $positionnement_fiche = DB::table('taches')
                            ->join('positionnements','taches.id','=','positionnements.tache_id')
                            ->join('fiche_positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
                            ->join('associations','associations.id','=','fiche_positionnements.association_id')
                            ->where('associations.user_id','=',$users->id)
                            ->where('taches.id','=',$tache_value->id)
                            ->select(DB::raw('MAX(positionnements.valeurpost) as valeurpost'),'taches.libelletache')
                            ->groupBy('taches.id','taches.libelletache')
                            ->distinct('taches.id')
                            ->first();


                            if($positionnement_fiche->valeurpost < $value_id[$i])
                            {
                                /** enregistrement des positionnements **/
                                $positionnement = Positionnement::create([
                                    'valeurpost'=> $value_id[$i],
                                    'fiche_positionnement_id'=> $fiche,
                                    'tache_id'=> $tache_value->id,]);
                            }
                        }
                        else
                        {
                            /** enregistrement des positionnements **/
                            $positionnement = Positionnement::create([
                            'valeurpost'=> $value_id[$i],
                            'fiche_positionnement_id'=> $fiche,
                            'tache_id'=> $tache_value->id,]);
                        }
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
        $this->authorize('ad_re_su_ch_fo', User::class);
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
        $this->authorize('ad_re_su_ch_fo', User::class);
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
