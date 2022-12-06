<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\GroupeActivite;
use App\Models\Ifad;
use App\Models\Metier;
use App\Models\Tache;
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
        $ifads = Ifad::select('*')->get();

        return view('referentiels.index', compact('ifads'));
    }

    public function show(Ifad $ifad)
    {
        $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->where('ifad_id','=',$ifad->id)->get();

             $m = 0;
             foreach($metiers as $metier)
             {
                $tab_metier_id[$m] = $metier->id;
                $tab_metier_libelle[$m] = $metier->libellemetier;

                $fonctions = GroupeActivite::select('*')->where('metier_id','=',$tab_metier_id[$m])->distinct('id')->get();
                $f = 0;
                foreach($fonctions as $fonction)
                {
                    $tab_fonction_id[$f] = $fonction->id;
                    $tab_fonction_libelle[$f] = $fonction->libellegroupe;

                    $activites = Activite::select('*')->where('groupe_activite_id','=',$tab_fonction_id[$f])->distinct('id')->get();
                    $a = 0;
                    foreach($activites as $activite)
                    {
                        $tab_activite_id[$a] = $activite->id;
                        $tab_activite_libelle[$a] = $activite->libelleactivite;

                        $tab_taches[$a] = Tache::select('*')->where('activite_id','=',$tab_activite_id[$a])->distinct('id')->get();

                        $collection_activite[$a] = collect(['activite_id' => $tab_activite_id[$a], 'activite_libelle' => $tab_activite_libelle[$a], 'taches' => $tab_taches[$a]])->all();

                        $a++;
                    }
                     $activites[$f] = $collection_activite;
                     $collection_fonction[$f] = collect(['fonction_id' => $tab_fonction_id[$f], 'fonction_libelle' => $tab_fonction_libelle[$f], 'activites' => $activites[$f]])->all();
                     $f++;
                    // $collection_activite == null;
                }
                $m++;
             }

             dd($collection_fonction);

        return view('referentiels.show', compact('collections'));
    }
}
