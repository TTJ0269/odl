<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ifad;
use App\Models\User;

class IfadController extends Controller
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
            $ifads = Ifad::select('*')->get();

            return view('ifads.index', compact('ifads'));
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
          $ifad = new Ifad();

          return view('ifads.create',compact('ifad'));
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
          $libelle = request('libelleifad');

          $ifad = Ifad::create($this->validator());

          return redirect('ifads')->with('message', 'IFAD bien ajouté.');
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

     public function show(Ifad $ifad)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
          return view('ifads.show',compact('ifad'));
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

     public function edit(Ifad $ifad)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
          return view('ifads.edit', compact('ifad'));
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

     public function update(Ifad $ifad)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          $libelle = request('libelleifad');

          $ifad->update($this->validator());

          return redirect('ifads/' . $ifad->id)->with('message','Modication éffectuée');
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

     public function destroy(Ifad $ifad)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $ifad->delete();

            return redirect('ifads')->with('messagealert','Suppression éffectuée');
        }
        catch(\Exception $exception)
       {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
     }

     private  function validator()
     {
         return request()->validate([
             'libelleifad'=>'required',
         ]);
     }
}
