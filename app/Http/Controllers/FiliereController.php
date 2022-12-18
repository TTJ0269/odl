<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Metier;
use App\Models\GroupeActivite;
use App\Models\Filiere;
use App\Models\User;
use App\Models\Historique;

class FiliereController extends Controller
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
            $filieres = Filiere::select('*')->orderBy('id','DESC')->get();

            return view('filieres.index', compact('filieres'));
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
          $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();
          $filiere = new Filiere();

          return view('filieres.create',compact('filiere','metiers'));
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
            $libelle = request('libellefiliere');

            $filiere = Filiere::create([
                'libellefiliere'=> request('libellefiliere'),
                'metier_id'=> request('metier_id'),
            ]);

            $this->historique(request('libellefiliere'), 'Ajout');

            return redirect('filieres/create')->with('message', 'filiére bien ajoutée.');

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

     public function show(Filiere $filiere)
     {
        $this->authorize('ad_su', User::class);
       try
       {
          return view('filieres.show',compact('filiere'));
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

     public function edit(Filiere $filiere)
     {
        $this->authorize('ad_su', User::class);
       try
       {
          $metiers = Metier::select('*')->get();
          return view('filieres.edit', compact('filiere','metiers'));
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

     public function update(Filiere $filiere)
     {
        $this->authorize('ad_su', User::class);
        $this->validator();
       try
       {
          $filiere->update([
            'libellefiliere'=> request('libellefiliere'),
            'metier_id'=> request('metier_id'),
          ]);

          $this->historique(request('libellefiliere'), 'Modification');

          return redirect('filieres/' . $filiere->id)->with('message',"Modification effectuée avec succès.");
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

     public function destroy(Filiere $filiere)
     {
        $this->authorize('ad_su', User::class);
       try
       {
        if(GroupeActivite::where('filiere_id','=',$filiere->id)->select('id')->exists())
        {
           return back()->with('messagealert',"Suppression pas possible. Cette filiére est référencée dans une autre table.");
        }
        else
        {
            $filiere->delete();

            $this->historique($filiere->libellefiliere, 'Suppression');

            return redirect('filieres')->with('messagealert','Suppression éffectuée');
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
             'libellefiliere'=>'required|min:2',
             'metier_id'=>'required|integer',
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Filiere',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }

}
