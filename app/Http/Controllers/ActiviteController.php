<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Activite;
use App\Models\Competence;
use App\Models\Classe;
use App\Models\User;

class ActiviteController extends Controller
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
     // Afficher les activites appartenants a la personne qui s'est connecter
     public function index()
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
         $activites = Activite::select('*')->get();

         return view('activites.index', compact('activites'));
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

     public function create()
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
         $activite = new Activite();
         $competences = Competence::select('*')->get();
         $classes = Classe::select('*')->where('libelleclasse','not like',"%Aucune%")->get();

         return view('activites.create',compact('activite','competences','classes'));

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
        $this->authorize('ad_re_su', User::class);
        $this->validator();

       try
       {

         $activite = Activite::create([
          'libelleactivite'=> request('libelleactivite'),
          'identifiantactivite'=> request('identifiantactivite'),
          'competence_id'=> request('competence_id'),
          'classe_id'=> request('classe_id'),
          ]);

          return redirect('activites/create')->with('message', 'Informations bien enregistrées.');

      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
     }

     // return redirect('rapports')->with('message', 'Rapport bien ajoutée.');
      /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function show(Activite $activite)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
           return view('activites.show',compact('activite'));
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

     public function edit(Activite $activite)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
        $competences = Competence::all();
        $classes = Classe::all();

        return view('activites.edit', compact('activite','competences','classes'));
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

     public function update(Activite $activite)
     {
        $this->authorize('ad_re_su', User::class);
      try
      {
              /** actualisation de l'activite **/
              $activite->update([
                'libelleactivite'=> request('libelleactivite'),
                'identifiantactivite'=> request('identifiantactivite'),
                'competence_id'=> request('competence_id'),
                'classe_id'=> request('classe_id'),
                ]);

            return redirect('activites/' . $activite->id)->with('message', 'Activité bien mise à jour.');

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

     public function destroy(Activite $activite)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $activite->delete();

            return redirect('activites')->with('messagealert','Suppression éffectuée');
      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }

     }


     private  function validator()
     {
         return request()->validate([
            'libelleactivite'=> 'required|min:2',
            'identifiantactivite'=> 'required|max:10',
            'competence_id' =>'required|integer',
            'classe_id' =>'required|integer',
         ]);
     }
}
