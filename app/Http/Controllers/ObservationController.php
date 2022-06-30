<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Observation;
use App\Models\FichePositionnement;
use App\Models\Profil;
use App\Models\User;

class ObservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
             /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
     // Afficher les types utilisateurs
     public function index()
     {
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

            if($profil_libelle == 'Administrateur' || $profil_libelle == 'Responsable pédagogique' || $profil_libelle == 'Suivi_AED')
           {
                $observations = DB::table('fiche_positionnements')
                ->join('observations','fiche_positionnements.id','=','observations.fiche_positionnement_id')
                ->select('observations.*','fiche_positionnements.libellefiche')
                ->orderBy('observations.id','DESC')
                ->get();

                return view('observations.index', compact('observations'));
           }
           else
           {
               if(DB::table('associations')->where('associations.user_id','=',Auth::user()->id)->select('associations.id')->doesntExist())
                {
                    return back()->with('messagealert',"Vous n'est pas associé à un IFAD");
                }
                else
                {
                    $ifad_id = DB::table('associations')->where('associations.user_id','=',Auth::user()->id)
                    ->select('ifad_id')->get()->last()->ifad_id;

                    $observations = DB::table('associations')
                    ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
                    ->join('observations','fiche_positionnements.id','=','observations.fiche_positionnement_id')
                    ->where('associations.ifad_id','=',$ifad_id)
                    ->select('observations.*','fiche_positionnements.libellefiche')
                    ->orderBy('observations.id','DESC')
                    ->get();

                    return view('observations.index', compact('observations'));
                }
            }

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

       /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */

     public function create(FichePositionnement $fiche_positionnement)
     {
         try
         {

            $fiche_positionnements = FichePositionnement::select('*')->where('id','=',$fiche_positionnement->id)->get();
            $observation = new Observation();

            return view('observations.create',compact('observation','fiche_positionnements'));
         }
         catch(\Exception $exception)
         {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
         }
     }

       /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */

     public function store()
     {
         try
         {
            $users_id = (Auth::user())->id;
            $fiche_positionnement_id = request('fiche_positionnement_id');

            $observation = Observation::create([
                    'descriptionobservation'=> request('descriptionobservation'),
                    'fiche_positionnement_id'=> $fiche_positionnement_id,
                    'dateobservation'=> now(),
            ]);


            return redirect('fiche_positionnements-apprenant/'.$fiche_positionnement_id)->with('message', 'Observation bien envoyé.');
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
     }

      /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function show(Observation $observation)
     {
         try
         {
          return view('observations.show',compact('observation'));
         }
         catch(\Exception $exception)
         {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
         }
     }


    /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function edit(observation $observation)
     {
         try
         {
            $fiche_positionnements = FichePositionnement::all();
            return view('observations.edit', compact('observation','fiche_positionnements'));
         }
         catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
     }

        /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function update(observation $observation)
     {
         try
         {
            $observation->update([
                'descriptionobservation'=> request('descriptionobservation'),
            ]);

            return redirect('observations/' . $observation->id);
        }
         catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
     }

      /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function destroy(observation $observation)
     {
         try
         {
            $observation->delete();

            return redirect('observations');
         }
        catch(\Exception $exception)
       {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
     }

}
