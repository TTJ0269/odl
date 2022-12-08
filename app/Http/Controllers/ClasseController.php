<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ifad;
use App\Models\Classe;
use App\Models\Metier;
use App\Models\User;

class ClasseController extends Controller
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
     // Afficher les classes
     public function index()
     {
        $this->authorize('ad_su', User::class);
       try
       {
            $classes = Classe::select('*')->get();

            return view('classes.index', compact('classes'));
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

          $class = new Classe();
          $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();

          return view('classes.create',compact('class','metiers'));
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
          $classe_libelle = request('libelleclasse');

          $classe = Classe::create($this->validator());

          return redirect('classes')->with('message', 'Classe bien ajoutée.');
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

     public function show(Classe $class)
     {
        $this->authorize('ad_su', User::class);
       try
        {
          return view('classes.show',compact('class'));
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

     public function edit(Classe $class)
     {
        $this->authorize('ad_su', User::class);
        try
        {
          $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();
          return view('classes.edit', compact('class','metiers'));
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

     public function update(Classe $class)
     {
        $this->authorize('ad_su', User::class);
       try
       {
          $classe_libelle = request('libelleclasse');

          $class->update($this->validator());

          return redirect('classes/' . $class->id);
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

     public function destroy(Classe $class)
     {
        $this->authorize('ad_su', User::class);
        try
        {
            if(DB::table('associations')->where('associations.classe_id','=',$class->id)->doesntExist())
            {
              $class->delete();

              return redirect('classes')->with('messagealert','Suppression éffectuée');
            }

            return redirect('classes')->with('messagealert','Cette classe est referencée dans une autre table');
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'libelleclasse'=>'required|min:2',
             'metier_id' => 'required',
             'niveauclasse' => 'max:255'
         ]);
     }
}
