<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\User;
use App\Models\Association;
use App\Models\Metier;
use App\Models\FichePositionnement;
use App\Models\GroupeActivite;
use App\Models\Activite;
use App\Models\Tache;

class StatistiqueController extends Controller
{

    public function index()
    {
        try
        {
            $user_id = (Auth::user()->id);
            $profil = (Auth::user()->profil_id);

            $users = DB::table('profils')
            ->join('users','profils.id','=','users.profil_id')
            ->join('associations','users.id','=','associations.user_id')
            ->join('classes','classes.id','=','associations.classe_id')
            ->join('metiers','metiers.id','=','classes.metier_id')
            ->join('ifads','ifads.id','=','metiers.ifad_id')
            ->where('profils.libelleprofil','=','Apprenant')
            ->select('users.*','classes.libelleclasse','ifads.libelleifad')
            ->distinct('users.id')
            ->get();

            return view('statistiques.index', compact('users'));
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
    public function getfichepositionnement(Request $request)
    {
        try
        {
          $user_id = (Auth::user()->id);

            $fiche_positionnements = DB::table('users')
            ->join('associations','users.id','=','associations.user_id')
            ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
            ->select('fiche_positionnements.*')
            ->where('users.id', $request->user_id)
            ->distinct('fiche_positionnements.id')
            ->orderBy('fiche_positionnements.id','DESC')
            ->get();

            if (count($fiche_positionnements) > 0)
            {
                return response()->json($fiche_positionnements);
            }

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function show(FichePositionnement $fiche_positionnement)
    {
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;
            if($profil_libelle == 'Apprenant')
            {
                if(Association::where('user_id','=',Auth::user()->id)->select()->exists())
                {
                    $association = Association::where('user_id','=',Auth::user()->id)->select('*')->first();
                    if($fiche_positionnement->association_id != $association->id)
                    {
                        return back()->with('messagealert',"Pas de droit nécessaire");
                    }
                }
            }

            /** selection des activites metiers par activites **/
            $activites = DB::table('activites')
            ->join('taches','activites.id','=','taches.activite_id')
            ->join('positionnements','taches.id','=','positionnements.tache_id')
            ->select('activites.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('activites.id')->distinct('activites.id')->get();

            $i = 1;
            foreach($activites as $activite)
            {
            $tab_activite_id[$i]= $activite->id;
            $tab_activite_libelle[$i]= $activite->libelleactivite;

            $tab_tache[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('taches','taches.id','=','positionnements.tache_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('taches.activite_id','=',$tab_activite_id[$i])
            ->select('positionnements.*','taches.libelletache')
            ->orderBy('taches.id')
            ->get();

            $collections[$i] = collect(['activite_id' => $tab_activite_id[$i], 'activite_libelle' => $tab_activite_libelle[$i], 'taches' => $tab_tache[$i]])->all();

            $i++;
            }

            //dd($collections);

            return view('statistiques.show', compact('collections','fiche_positionnement'));

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

    }

    public function show_info()
    {
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            $fiche_positionnement_id = request('fiche_positionnement_id');

            if($fiche_positionnement_id == null)
            {
                return back()->with('messagealert',"Sélectionner une fiche");
            }

            $fiche_positionnement = FichePositionnement::where('id','=',$fiche_positionnement_id)->select('*')->first();

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;
            if($profil_libelle == 'Apprenant')
            {
                if(Association::where('user_id','=',Auth::user()->id)->select()->exists())
                {
                    $association = Association::where('user_id','=',Auth::user()->id)->select('*')->first();
                    if($fiche_positionnement->association_id != $association->id)
                    {
                        return back()->with('messagealert',"Pas de droit nécessaire");
                    }
                }
            }

            /** selection des activites metiers par activites **/
            $activites = DB::table('activites')
            ->join('taches','activites.id','=','taches.activite_id')
            ->join('positionnements','taches.id','=','positionnements.tache_id')
            ->select('activites.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('activites.id')->distinct('activites.id')->get();

            $i = 1;
            foreach($activites as $activite)
            {
            $tab_activite_id[$i]= $activite->id;
            $tab_activite_libelle[$i]= $activite->libelleactivite;

            $tab_tache[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('taches','taches.id','=','positionnements.tache_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('taches.activite_id','=',$tab_activite_id[$i])
            ->select('positionnements.*','taches.libelletache')
            ->orderBy('taches.id')
            ->get();

            $collections[$i] = collect(['activite_id' => $tab_activite_id[$i], 'activite_libelle' => $tab_activite_libelle[$i], 'taches' => $tab_tache[$i]])->all();

            $i++;
            }

            //dd($collections);

            return view('statistiques.show_info', compact('collections','fiche_positionnement'));
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function fiche_generale(User $user)
    {
        try
        {
            $collections = $this->getdata($user);

            /** Recuperation de la derniere assocoation d'un apprenant a un IFAD **/
            $association = Association::where('associations.user_id','=',$user->id)->select('*')->get()->last();

            /** Recuperation du metier de l'apprenant **/
            $metier_id = $association->classe->metier->id;

            $metiers = Metier::where('id','=',$metier_id)->select('*')->first();

            return view('fiche_positionnements.show_generale',compact('collections','metiers','user'));

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function statistique_generale(User $user)
    {
        try
        {
            $collections = $this->getdata($user);

            /** Recuperation de la derniere assocoation d'un apprenant a un IFAD **/
            $association = Association::where('associations.user_id','=',$user->id)->select('*')->get()->last();

            /** Recuperation du metier de l'apprenant **/
            $metier_id = $association->classe->metier->id;

            $metiers = Metier::where('id','=',$metier_id)->select('*')->first();

            return view('statistiques.show_generale', compact('collections','user','metiers'));

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }


    private function getdata(User $user)
    {
        $user_id = (Auth::user()->id);
        $profil_id = (Auth::user()->profil_id);

        $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;
        if($profil_libelle == 'Apprenant')
        {
            if(Association::where('user_id','=',Auth::user()->id)->select()->exists())
            {
                $association = Association::where('user_id','=',Auth::user()->id)->select('*')->first();
                if($fiche_positionnement->association_id != $association->id)
                {
                    return back()->with('messagealert',"Pas de droit nécessaire");
                }
            }
        }

        /** Recuperation de la derniere assocoation d'un apprenant a un IFAD **/
        $association = Association::where('associations.user_id','=',$user->id)->select('*')->get()->last();

        /** Recuperation du metier de l'apprenant **/
        $metier_id = $association->classe->metier->id;

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
        return $collections;
    }
}
