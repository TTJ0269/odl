<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Classe;
use App\Models\FichePositionnement;

class StatistiqueController extends Controller
{

    public function index()
    {
        $user_id = (Auth::user()->id);
        $profil = (Auth::user()->profil_id);

        $users = DB::table('profils')
        ->join('users','profils.id','=','users.profil_id')
        ->where('profils.libelleprofil','=','Apprenant')
        ->select('users.*')
        ->get();

        return view('statistiques.index', compact('users'));
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

    public function show()
    {
        $fiche_positionnement = request('fiche_positionnement_id');

        if($fiche_positionnement == null)
        {
            return back()->with('messagealert','Séléctionner une fiche');
        }
        else
        {
            $fiche_select = FichePositionnement::where('id','=',$fiche_positionnement)->select('*')->first();

            $fiches = FichePositionnement::where('id','=',$fiche_positionnement)->select('*')->get();
            $classes = Classe::where('id','=',$fiche_select->classe_id)->select('*')->get();

            $tuteur_suivi_infos = DB::table('users')
            ->join('suivis','users.id','=','suivis.user_id')
            ->join('entreprises','entreprises.id','=','suivis.entreprise_id')
            ->where('suivis.tuteur_suivi_id','=',$fiche_select->responsable_suivi_id)
            ->select('users.*')->distinct('users.id')
            ->get();

            /** selection des activites classes par competences **/
            $competences = DB::table('competences')
            ->join('activites','competences.id','=','activites.competence_id')
            ->join('positionnements','activites.id','=','positionnements.activite_id')
            ->select('competences.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement)
            ->orderBy('competences.id')->distinct('competences.id')->get();

            $i = 1;
            foreach($competences as $competence)
            {
            $tab_competence_id[$i]= $competence->id;
            $tab_competence_libelle[$i]= $competence->libellecompetence;

            $tab_activite[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('activites','activites.id','=','positionnements.activite_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement)
            ->where('activites.competence_id','=',$tab_competence_id[$i])
            ->select('positionnements.*','activites.libelleactivite')
            ->orderBy('activites.id')
            ->get();

            $collections[$i] = collect(['competence_id' => $tab_competence_id[$i], 'competence_libelle' => $tab_competence_libelle[$i], 'activite' => $tab_activite[$i]])->all();

            $i++;
            }

            //dd($collections);

            return view('statistiques.show', compact('collections','fiches','classes'));

        }
    }

    public function fiche_longue_show(FichePositionnement $fiche_positionnement)
    {

            $classes = Classe::where('id','=',$fiche_positionnement->classe_id)->select('*')->get();

            $tuteur_suivi_infos = DB::table('users')
            ->join('suivis','users.id','=','suivis.user_id')
            ->join('entreprises','entreprises.id','=','suivis.entreprise_id')
            ->where('suivis.tuteur_suivi_id','=',$fiche_positionnement->responsable_suivi_id)
            ->select('users.*')->distinct('users.id')
            ->get();

            /** selection des activites classes par competences **/
            $competences = DB::table('competences')
            ->join('activites','competences.id','=','activites.competence_id')
            ->join('positionnements','activites.id','=','positionnements.activite_id')
            ->select('competences.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('competences.id')->distinct('competences.id')->get();

            $i = 1;
            foreach($competences as $competence)
            {
            $tab_competence_id[$i]= $competence->id;
            $tab_competence_libelle[$i]= $competence->libellecompetence;

            $tab_activite[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('activites','activites.id','=','positionnements.activite_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('activites.competence_id','=',$tab_competence_id[$i])
            ->select('positionnements.*','activites.libelleactivite')
            ->orderBy('activites.id')
            ->get();

            $collections[$i] = collect(['competence_id' => $tab_competence_id[$i], 'competence_libelle' => $tab_competence_libelle[$i], 'activite' => $tab_activite[$i]])->all();

            $i++;
            }

            //dd($collections);

            return view('statistiques.fiche_longue_show', compact('collections','fiche_positionnement','classes'));
    }
}
