<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Activite;
use App\Models\Tache;
use App\Models\User;
use App\Models\Positionnement;
use App\Models\Historique;

class TacheController extends Controller
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
        $this->authorize('ad_su', User::class);
       try
       {
         $taches = Tache::select('*')->orderBy('id','DESC')->get();

         return view('taches.index', compact('taches'));
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
        $this->authorize('ad_su', User::class);
       try
       {
         $tach = new Tache();
         $activites = activite::select('*')->get();

         return view('taches.create',compact('tach','activites'));

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
        $this->authorize('ad_su', User::class);
        $this->validator();

       try
       {
        if(Tache::where('libelletache','=',request('libelletache'))->select('id')->doesntExist())
        {
            $tache = Tache::create([
                'libelletache'=> request('libelletache'),
                'identifianttache'=> request('identifianttache'),
                'activite_id'=> request('activite_id'),
                ]);

                $this->historique(request('libelletache'), 'Ajout');

                return redirect('taches/create')->with('message', 'Informations bien enregistrées.');
        }

        return back()->with('messagealert',"Cette tâche existe déjà.");

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

     public function show(Tache $tach)
     {
        $this->authorize('ad_su', User::class);
        try
        {
           return view('taches.show',compact('tach'));
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

     public function edit(Tache $tach)
     {
        $this->authorize('ad_su', User::class);
       try
       {
        $activites = activite::all();

        return view('taches.edit', compact('tach','activites'));
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

     public function update(Tache $tach)
     {
        $this->authorize('ad_su', User::class);
        $this->validator();
      try
      {
              /** actualisation de la tâche **/
              $tach->update([
                'libelletache'=> request('libelletache'),
                'identifianttache'=> request('identifianttache'),
                'activite_id'=> request('activite_id'),
                ]);

            $this->historique(request('libelletache'), 'Modification');

            return redirect('taches/' . $tach->id)->with('message', 'Tâche bien mise à jour.');

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

     public function destroy(Tache $tach)
     {
        $this->authorize('ad_su', User::class);
       try
       {
        if(Positionnement::where('tache_id','=',$tach->id)->select('id')->exists())
        {
           return back()->with('messagealert',"Suppression pas possible. Cette est référencée dans une autre table.");
        }
        else
        {
            $tach->delete();

            $this->historique($tach->libelletache, 'Suppression');

            return redirect('taches')->with('messagealert','Suppression éffectuée');
        }
      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }

     }


     private  function validator()
     {
         return request()->validate([
            'libelletache'=> 'required|min:2',
            'identifianttache'=> 'required|max:10',
            'activite_id' =>'required|integer',
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Tache',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
