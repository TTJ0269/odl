<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Metier;
use App\Models\Activite;
use App\Models\Tache;
use App\Models\User;
use App\Models\Historique;

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
     // Afficher les types utilisateurs
     public function index()
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $activites = Activite::select('*')->orderBy('id','DESC')->get();

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
          $metiers = Metier::select('*')->get();
          $activite = new Activite();

          return view('activites.create',compact('activite','metiers'));
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
        if(Activite::where('libelleactivite','=',request('libelleactivite'))->select('id')->doesntExist())
        {
            $libelle = request('libelleactivite');

            $activite = Activite::create([
                'libelleactivite'=> request('libelleactivite'),
                'identifiantactivite'=> request('identifiantactivite'),
                'metier_id'=> request('metier_id'),
                'categorie'=> request('categorie'),
            ]);

            $this->historique(request('libelleactivite'), 'Ajout');

            return redirect('activites/create')->with('message', 'Activit?? bien ajout??e.');
        }
        return back()->with('messagealert',"Cette activit?? existe d??j??.");
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
          $metiers = Metier::select('*')->get();
          return view('activites.edit', compact('activite','metiers'));
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
        $this->validator();
       try
       {
          $activite->update([
              'libelleactivite'=> request('libelleactivite'),
              'identifiantactivite'=> request('identifiantactivite'),
              'metier_id'=> request('metier_id'),
              'categorie'=> request('categorie'),
          ]);

          $this->historique(request('libelleactivite'), 'Modification');

          return redirect('activites/' . $activite->id)->with('message',"Modification effectu??e avec succ??s.");
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

     public function destroy(activite $activite)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
        if(Tache::where('activite_id','=',$activite->id)->select('id')->exists())
        {
           return back()->with('messagealert',"Suppression pas possible. Cette activit?? est r??f??renc??e dans une autre table.");
        }
        else
        {
            $activite->delete();

            $this->historique($activite->libelleactivite, 'Suppression');

            return redirect('activites')->with('messagealert','Suppression ??ffectu??e');
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
             'libelleactivite'=>'required|min:2',
             'identifiantactivite'=>'max:10',
             'metier_id'=>'required|integer',
             'categorie'=>'max:255',
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Activite',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
