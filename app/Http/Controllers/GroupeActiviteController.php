<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Metier;
use App\Models\Ifad;
use App\Models\User;
use App\Models\GroupeActivite;
use App\Models\Activite;
use App\Models\Historique;

class GroupeActiviteController extends Controller
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
     // Afficher les metiers
     public function index()
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $groupe_activites = GroupeActivite::select('*')->get();

            return view('groupe_activites.index', compact('groupe_activites'));
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

          $groupe_activite = new GroupeActivite();
          $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();

          return view('groupe_activites.create',compact('groupe_activite','metiers'));
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
          $groupe_activite = GroupeActivite::create($this->validator());

          $this->historique(request('libellegroupe'), 'Ajout');

          return redirect('groupe_activites')->with('message', "Groupe d'activité bien ajouté.");
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

     public function show(GroupeActivite $groupe_activite)
     {
        $this->authorize('ad_re_su', User::class);
       try
        {
          return view('groupe_activites.show',compact('groupe_activite'));
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

     public function edit(GroupeActivite $groupe_activite)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
          $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();

          return view('groupe_activites.edit', compact('groupe_activite','metiers'));
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

     public function update(GroupeActivite $groupe_activite)
     {
        $this->authorize('ad_re_su', User::class);
        $this->validator();
       try
       {
          $groupe_libelle = request('libellegroupe');

          $groupe_activite->update($this->validator());

          $this->historique($groupe_libelle, 'Modification');

          return redirect('groupe_activites/' . $groupe_activite->id);
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

     public function destroy(GroupeActivite $groupe_activite)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
            if(Activite::where('groupe_activite_id','=',$groupe_activite->id)->doesntExist())
            {
              $groupe_activite->delete();

              $this->historique($groupe_activite->libellegroupe, 'Suppression');

              return redirect('groupe_activites')->with('messagealert','Suppression éffectuée');
            }

            return redirect('metiers')->with('messagealert',"Ce groupe d'activité est referencé dans une autre table");
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'identifiantgroupe'=>'max:10',
             'libellegroupe'=>'required|min:2',
             'metier_id' => 'required'
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Groupe Activite',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
