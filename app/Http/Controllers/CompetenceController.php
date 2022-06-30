<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Competence;
use App\Models\User;

class CompetenceController extends Controller
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
            $competences = Competence::select('*')->get();

            return view('competences.index', compact('competences'));
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
          $competence = new Competence();

          return view('competences.create',compact('competence'));
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
          $libelle = request('libellecompetence');

          $competence = Competence::create($this->validator());


          return redirect('competences/create')->with('message', 'Competence bien ajoutée.');
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

     public function show(Competence $competence)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          return view('competences.show',compact('competence'));
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

     public function edit(Competence $competence)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          return view('competences.edit', compact('competence'));
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

     public function update(Competence $competence)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          $competence->update([
              'libellecompetence'=> request('libellecompetence'),
              'identifiantcompetence'=> request('identifiantcompetence'),
          ]);

          return redirect('competences/' . $competence->id);
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

     public function destroy(Competence $competence)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $competence->delete();

            return redirect('competences')->with('messagealert','Suppression éffectuée');
        }
        catch(\Exception $exception)
       {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
     }

     private  function validator()
     {
         return request()->validate([
             'libellecompetence'=>'required|min:2',
             'identifiantcompetence'=>'max:10',
             'categorie'=>'max:255',
         ]);
     }
}
