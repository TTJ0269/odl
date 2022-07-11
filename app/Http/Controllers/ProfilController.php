<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use App\Models\User;
use App\Models\Historique;

class ProfilController extends Controller
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
        $this->authorize('admin', User::class);
       try
       {
            $profils = Profil::all();

            return view('profils.index', compact('profils'));
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
        $this->authorize('admin', User::class);
       try
       {

          $profil = new Profil();

          return view('profils.create',compact('profil'));
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
        $this->authorize('admin', User::class);
       try
       {
          $profil_libelle = request('libelleprofil');

          $profil = Profil::create($this->validator());

          $this->historique($profil_libelle, 'Ajout');

          return redirect('profils')->with('message', 'Profil bien ajouté.');
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

     public function show(Profil $profil)
     {
        $this->authorize('admin', User::class);
       try
        {
          return view('profils.show',compact('profil'));
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

     public function edit(Profil $profil)
     {
        $this->authorize('admin', User::class);
        try
        {
          return view('profils.edit', compact('profil'));
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

     public function update(Profil $profil)
     {
        $this->authorize('admin', User::class);
       try
       {
          $profil_libelle = request('libelleprofil');

          $profil->update($this->validator());

          $this->historique($profil->libelleprofil, 'Modification');

          return redirect('profils/' . $profil->id);
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

     public function destroy(Profil $profil)
     {
        $this->authorize('admin', User::class);
        try
        {
            if(DB::table('users')->where('users.profil_id','=',$profil->id)->doesntExist())
            {
              $profil->delete();

              $this->historique($profil->libelleprofil, 'Suppression');

              return redirect('profils')->with('messagealert','Suppression éffectuée');
            }

            return redirect('profils')->with('messagealert','Ce profil est référencé dans une autre table');
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'libelleprofil'=>'required|min:2'
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Profil',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
