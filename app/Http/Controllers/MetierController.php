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

class MetierController extends Controller
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
        $this->authorize('ad_su', User::class);
       try
       {
            $metiers = Metier::select('*')->get();//->where('libellemetier','not like',"%Aucun%")

            return view('metiers.index', compact('metiers'));
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
          $metier = new Metier();
          $ifads = Ifad::select('*')->get();

          return view('metiers.create',compact('metier','ifads'));
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

        /** il peut arrivé d'un formateur ou apprenant ne soit pas directement
         * liées au metier donc dans chaque ifad aucun_metierid_ifad est créé. **/

        $libellemetier = 'Aucun_metier'.request('ifad_id');
        try
        {
            if(Metier::where('libellemetier','=',$libellemetier)->select('id')->doesntExist())
            {
               Metier::create([
                'libellemetier'=> $libellemetier,
                'niveaumetier'=>'Aucun',
                'ifad_id' => request('ifad_id')
               ]);
            }

            $metier = Metier::create($this->validator());

            $this->historique(request('libellemetier'), 'Ajout');

            return redirect('metiers')->with('message', 'metier bien ajoutée.');


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

     public function show(Metier $metier)
     {
        $this->authorize('ad_su', User::class);
       try
        {
          return view('metiers.show',compact('metier'));
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

     public function edit(Metier $metier)
     {
        $this->authorize('ad_su', User::class);
        try
        {
          $ifads = Ifad::select('*')->get();

          return view('metiers.edit', compact('metier','ifads'));
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

     public function update(Metier $metier)
     {
        $this->authorize('ad_su', User::class);
        $this->validator();
       try
       {
          $metier_libelle = request('libellemetier');

          $metier->update($this->validator());

          $this->historique($metier_libelle, 'Modification');

          return redirect('metiers/' . $metier->id);
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

     public function destroy(Metier $metier)
     {
        $this->authorize('ad_su', User::class);
        try
        {
            if(GroupeActivite::where('metier_id','=',$metier->id)->doesntExist())
            {
              $metier->delete();

              $this->historique($metier->libellemetier, 'Suppression');

              return redirect('metiers')->with('messagealert','Suppression éffectuée');
            }

            return redirect('metiers')->with('messagealert','Cette metier est referencée dans une autre table');
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'libellemetier'=>'required|min:2',
             'niveaumetier'=>'max:150',
             'ifad_id' => 'required'
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'metier',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
