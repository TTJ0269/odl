<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Niveau;
use App\Models\User;
use App\Models\Historique;

class NiveauController extends Controller
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
        $this->authorize('ad_su', User::class);
       try
       {
            $niveaux = Niveau::all();

            return view('niveaux.index', compact('niveaux'));
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

          $niveau = new Niveau();

          return view('niveaux.create',compact('niveau'));
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
       try
       {
          $niveau_libelle = request('libelleniveau');

          $niveau = Niveau::create($this->validator());

          $this->historique($niveau_libelle, 'Ajout');

          return redirect('niveaux')->with('message', 'Niveau bien ajouté.');
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

     public function show(Niveau $niveau)
     {
        $this->authorize('ad_su', User::class);
       try
        {
          return view('niveaux.show',compact('niveau'));
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

     public function edit(Niveau $niveau)
     {
        $this->authorize('ad_su', User::class);
        try
        {
          return view('niveaux.edit', compact('niveau'));
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

     public function update(Niveau $niveau)
     {
        $this->authorize('ad_su', User::class);
       try
       {
          $niveau_libelle = request('libelleniveau');

          $niveau->update($this->validator());

          $this->historique($niveau->libelleniveau, 'Modification');

          return redirect('niveaux/' . $niveau->id);
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

     public function destroy(Niveau $niveau)
     {
        $this->authorize('ad_su', User::class);
        try
        {
            if(DB::table('classes')->where('classes.niveau_id','=',$niveau->id)->doesntExist())
            {
              $niveau->delete();

              $this->historique($niveau->libelleniveau, 'Suppression');

              return redirect('niveaux')->with('messagealert','Suppression éffectuée');
            }

            return redirect('niveaux')->with('messagealert','Ce niveau est référencé dans une autre table');
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'libelleniveau'=>'required|min:2'
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Niveau',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
