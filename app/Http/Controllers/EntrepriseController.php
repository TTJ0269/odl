<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use App\Models\User;

class EntrepriseController extends Controller
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
            $entreprises = Entreprise::select('*')->get();

            return view('entreprises.index', compact('entreprises'));
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

          $entreprise = new Entreprise();

          return view('entreprises.create',compact('entreprise'));
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
       try
       {
          $this->validator();

          $entreprise_libelle = request('libelleentreprise');
          $entreprise_email = request('emailentreprise');
          $entreprise_tel = request('telentreprise');

          //dd($entreprise_libelle, $entreprise_email, $entreprise_tel);

          $entreprise = Entreprise::create([
            'libelleentreprise'=> request('libelleentreprise'),
            'emailentreprise'=> request('emailentreprise'),
            'telentreprise'=> request('telentreprise'),
            ]);

          return redirect('entreprises')->with('message', 'Entreprise bien ajoutée.');
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

     public function show(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
       try
        {
          return view('entreprises.show',compact('entreprise'));
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

     public function edit(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
          return view('entreprises.edit', compact('entreprise'));
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

     public function update(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          $this->validator();

          $entreprise_libelle = request('libelleentreprise');

          $entreprise->update([
            'libelleentreprise'=> request('libelleentreprise'),
            'emailentreprise'=> request('emailentreprise'),
            'telentreprise'=> request('telentreprise'),
            ]);

          return redirect('entreprises/' . $entreprise->id);
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

     public function destroy(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
              $entreprise->delete();

              return redirect('entreprises')->with('messagealert','Suppression éffectuée');
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'libelleentreprise'=>'required|min:2',
             'telentreprise',
             'emailentreprise'
         ]);
     }
}
