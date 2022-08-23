<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ifad;
use App\Models\Association;
use App\Models\Metier;
use App\Models\User;
use App\Models\Historique;

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

     public function store(Request  $request)
     {
        $this->authorize('ad_re_su', User::class);
        $this->validator();
       try
       {
        if(Ifad::where('libelleifad','=',request('libelleifad'))->select('id')->doesntExist())
        {
            $libelle = request('libelleifad');
            $imageifad = null;

            if($request->file('image'))
            {
                $file=$request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $request->image->move('storage/imageifad/', $filename);

                $imageifad = $filename;
            }

            $ifad = Ifad::create([
                'libelleifad'=> $libelle,
                'logoifad'=> $imageifad,
            ]);

            $this->historique($libelle, 'Ajout');

            return redirect('ifads')->with('message', 'IFAD bien ajouté.');
        }
        return back()->with('messagealert',"L'IFAD existe déjà.");

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

     public function update(Ifad $ifad, Request  $request)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          $libelle = request('libelleifad');

          if($request->file('image'))
          {
            if($request->file('image'))
            {
                $file=$request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $request->image->move('storage/imageifad/', $filename);

                $imageifad = $filename;
            }

            $ifad->update([
                'libelleifad'=> $libelle,
                'logoifad'=> $imageifad,
            ]);
          }
          else
          {
            $ifad->update([
                'libelleifad'=> $libelle,
            ]);
          }

          $this->historique($libelle, 'Modification');

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
        if(Metier::where('ifad_id','=',$ifad->id)->select('id')->exists())
        {
           return back()->with('messagealert',"Suppression pas possible. L'IFAD est référencé dans une autre table.");
        }
        else
        {
            $ifad->delete();

            $this->historique($ifad->libelleifad, 'Suppression');

            return redirect('ifads')->with('messagealert','Suppression éffectuée');
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
             'libelleifad'=>'required',
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Ifad',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
