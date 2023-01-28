<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\GroupeActivite;
use App\Models\Ifad;
use App\Models\Metier;
use App\Models\Tache;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferentielController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try
        {
            $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();

            return view('referentiels.index', compact('metiers'));
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function show(Metier $metier)
    {
        try
        {
            if(DB::table('metiers')->join('filieres','metiers.id','=','filieres.metier_id')
                    ->join('groupe_activites','filieres.id','=','groupe_activites.filiere_id')
                    ->join('activites','groupe_activites.id','=','activites.groupe_activite_id')
                    ->join('taches','activites.id','=','taches.activite_id')
                    ->where('filieres.metier_id','=',$metier->id)->select('taches.id')->doesntExist())
            {
                return back()->with('messagealert', "Ajouter au moins une tâche au métier de l'apprenant(e).");
            }

           $collections = $this->getdata_referentiel($metier);

           return view('referentiels.show', compact('collections','metier'));
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

    }


    private function getdata_referentiel(Metier $metier)
    {
        /** selection des filieres par groupe d'activité **/
        $filieres = Filiere::select('*')->where('metier_id','=',$metier->id)->orderBy('id')->distinct('id')->get();

        $f = 0;
        foreach($filieres as $filiere)
        {
            $tab_filiere_id[$f] = $filiere->id;
            $tab_filiere_libelle[$f] = $filiere->libellefiliere;

            /** Groupe_activite = fonction **/


            $tab_groupe_activites[$f] = GroupeActivite::select('*')->where('filiere_id','=',$tab_filiere_id[$f])
            ->orderBy('id')->distinct('id')->get();


            $i = 0;
            foreach($tab_groupe_activites[$f] as $groupe_activite)
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
                                $valeur[$t] = DB::table('taches')->select(DB::raw('0 as valeurpost'),'taches.id','taches.libelletache')->where('id','=',$all_tache->id)
                                ->where('activite_id','=',$tab_activite_id[$a])->orderBy('id')->distinct('id')->first();

                                $t++;

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



                $collection_groupe_activites[$i] = collect(['fonction_id' => $tab_groupe_activite_id[$i], 'focntion_libelle' => $tab_groupe_activite_libelle[$i], 'activites' => $collection_taches])->all();

                /** Vider la collection **/
                $collection_taches = null;

                $i++;

            }

            $collections[$f] = collect(['filiere_id' => $tab_filiere_id[$f], 'filiere_libelle' => $tab_filiere_libelle[$f], 'groupe_activites' => $collection_groupe_activites])->all();

            /** Vider la collection **/
            $collection_groupe_activites = null;

            $f++;
        }

        //dd($collections);

        return $collections;
    }
}
