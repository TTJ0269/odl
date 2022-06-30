<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Positionnement;
use App\Models\FichePositionnement;
use App\Models\Competence;
use App\Models\Activite;
use App\Models\Classe;
use App\Models\Ifad;

class PositionnementController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');//->except(['index'])
    }

    public function index()
    {
      try
      {
        $user_id = (Auth::user()->id);
        $profil = (Auth::user()->profil_id);

        $ifads = Ifad::select('*')->get();

        return view('positionnements.index',compact('ifads'));

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
        try
        {
            $classe_id = request('classe_id');
            $user_id = request('user_id');

            if($user_id == null)
            {
                return back()->with('messagealert', "Sélectionner un(e) apprenant(e).");
            }
            elseif($classe_id == null)
            {
                return back()->with('messagealert', "Sélectionner une classe.");
            }
            elseif(Competence::select('*')->doesntExist())
            {
               return back()->with('messagealert', "Ajouter au moins une compétence.");
            }
            elseif(Activite::select('*')->doesntExist())
            {
               return back()->with('messagealert', "Ajouter au moins une activité.");
            }
            else
            {
                $users = User::select('*')->where('id','=',$user_id)->first();

                $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$users->nomuser." ".$users->prenomuser;

                if(FichePositionnement::where('libellefiche','=',$fiche_positionnement)->select('id')->exists())
                {
                    return redirect('positionnements')->with('messagealert',"L'apprenant(e) ".$users->nomuser." ".$users->prenomuser." a déjà été positionné(e) aujourd'hui");
                }
                else
                {
                    // dd($classe_id, $user_id);

                    $positionnement = new Positionnement();

                    /** selection des activites classes par competences **/
                    $competences = DB::table('competences')
                    ->join('activites','competences.id','=','activites.competence_id')
                    ->select('competences.*')->where('activites.classe_id','=',$classe_id)
                    ->orderBy('competences.id')->distinct('competences.id')->get();

                    $i = 0;
                    foreach($competences as $competence)
                    {
                        $tab_competence_id[$i] = $competence->id;
                        $tab_competence_libelle[$i] = $competence->libellecompetence;


                        $tab_activite[$i] = DB::table('competences')
                        ->join('activites','competences.id','=','activites.competence_id')
                        ->select('competences.id','activites.id','activites.libelleactivite')
                        ->where('competences.id','=',$tab_competence_id[$i])
                        ->where('activites.classe_id','=',$classe_id)
                        ->orderBy('competences.id')
                        ->distinct('competences.id')
                        ->get();

                        $collections[$i] = collect([$tab_competence_id[$i],$tab_competence_libelle[$i],$tab_activite[$i]])->all();

                        $i++;
                    }

                    return view('positionnements.create',compact('collections','classe_id','user_id'));
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
      try
      {
        $classe_id = request('classe_id');
        $user_id = request('user_id');

        $classe = Classe::select('*')->where('id','=',$classe_id)->first();
        $users = User::select('*')->where('id','=',$user_id)->first();

        $association = DB::table('associations')
        ->where('associations.ifad_id','=',$classe->ifad_id)
        ->where('associations.user_id','=',$user_id)
        ->select('associations.id')->get()->last();

        $responsable_suivi_id = Auth::user()->id;
        $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$users->nomuser." ".$users->prenomuser;

           /** Enregistrement du livret de positionnement et recuperation de id **/
            $fiche = FichePositionnement::insertGetId([
             'libellefiche'=> $fiche_positionnement,
             'dateenregistrement'=>now(),
             'association_id'=> $association->id,
             'responsable_suivi_id'=> $responsable_suivi_id,
             'classe_id'=> $classe_id,
             'etatsup'=> 0]);

            /** Recuperation des valeurs **/
             $activite_values = DB::table('activites')->select('id')->where('classe_id','=',$classe_id)->get();
             $i = 1;
             foreach($activite_values as $activite_value)
             {
               $value[$i]= request('valeurpost_'.$activite_value->id);
               /** enregistrement des positionnements **/
               $positionnement = Positionnement::create([
                 'valeurpost'=> $value[$i],
                 'fiche_positionnement_id'=> $fiche,
                 'activite_id'=> $activite_value->id,]);
                 $i++;
             }

             return redirect('fiche_positionnements')->with('message', "Fiche de positionnement bien enregistrée.");

      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
    }


    public function edit(Positionnement $positionnement)
    {
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

}
