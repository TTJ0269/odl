<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FichePositionnement;
use App\Models\Positionnement;
use App\Models\Profil;
use App\Models\User;
use App\Models\Ifad;

class EtatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list_ifad()
    {
        try
        {
            $ifads = Ifad::select('*')->get();

            return view('etats.list_ifad', compact('ifads'));
        }
        catch(\Exception $exception)
        {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    /** liste des formateurs **/
    public function index_nombrepositionnement(Ifad $ifad)
    {
        try
       {
        $user_id = (Auth::user()->id);
          $profil_id = (Auth::user()->profil_id);

          $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

           if($profil_libelle == 'Administrateur' || $profil_libelle == 'Suivi_AED'
              || $profil_libelle == 'DG_IFAD' || $profil_libelle == 'Responsable pédagogique')
           {
                $formateurs = DB::table('profils')
                ->join('users','profils.id','=','users.profil_id')
                ->join('rattachers','users.id','=','rattachers.user_id')
                ->join('metiers','metiers.id','=','rattachers.metier_id')
                ->join('ifads','ifads.id','=','metiers.ifad_id')
                ->leftjoin('fiche_positionnements','fiche_positionnements.responsable_suivi_id','=','users.id')
                ->where('profils.libelleprofil','=','Formateur_IFAD')
                ->where('rattachers.datefin','=',null)
                ->where('ifads.id','=',$ifad->id)
                ->select('users.id','users.nomuser','users.prenomuser','ifads.id as ifad_id','ifads.libelleifad','metiers.id as id_metier','metiers.libellemetier',DB::raw('COUNT(fiche_positionnements.id) as postionnements_count'))
                ->groupBy('users.id','users.nomuser','users.prenomuser','ifad_id','ifads.libelleifad','id_metier','libellemetier')
                ->distinct('users.id')
                ->get();

                return view('etats.index_nombrepositionnement',compact('formateurs'));
           }
           else
           {
            return back()->with('messagealert',"Pas de droit nécessaire.");
           }
        }
        catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
    }

    public function show_nombrepositionnement(User $user)
    {
        try
        {
          $nombre_postionnements = FichePositionnement::where('responsable_suivi_id','=',$user->id)
          ->select('*')->distinct('id')->get();

          return view('etats.show_nombrepositionnement',compact('nombre_postionnements'));
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }
}
