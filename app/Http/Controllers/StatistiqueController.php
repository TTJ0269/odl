<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\User;
use App\Models\Association;
use App\Models\metier;
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

    public function show(FichePositionnement $fiche_positionnement)
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

        $tuteur_suivi_infos = DB::table('users')
        ->join('suivis','users.id','=','suivis.user_id')
        ->join('entreprises','entreprises.id','=','suivis.entreprise_id')
        ->where('suivis.tuteur_suivi_id','=',$fiche_positionnement->responsable_suivi_id)
        ->select('users.*')->distinct('users.id')
        ->get();

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
}
