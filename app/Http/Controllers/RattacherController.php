<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Rattacher;
use App\Models\User;
use App\Models\Ifad;
use App\Models\Classe;
use App\Models\Metier;

class RattacherController extends Controller
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
     // Afficher les activites appartenants a la personne qui s'est connecter
     public function index()
     {
        $this->authorize('ad_su', User::class);
       try
       {
         $rattachers = Rattacher::select('*')->orderBy('id','DESC')->get();

         return view('rattachers.index', compact('rattachers'));
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
         $rattacher = new Rattacher();
         $ifads = Ifad::select('*')->get();
         $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();
         $users = DB::table('profils')
         ->join('users','profils.id','=','users.profil_id')
         ->where('profils.libelleprofil','=','Formateur_IFAD')
         ->orWhere('profils.libelleprofil','=','DG_IFAD')
         ->orWhere('profils.libelleprofil','=','Responsable pédagogique')
         ->select('users.*','profils.libelleprofil')
         ->get();

         return view('rattachers.create',compact('rattacher','users','metiers','ifads'));

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
           /** ici il peut arriver qu'un utilisateur ne soit pas rattacher à aucune metier
            * pour cela aucun_metier a été creer prealablement comme metier **/
         $ifad_id = request('ifad_id');
         $metier_id = request('metier_id');

         $libellemetier = 'Aucun_metier'.request('ifad_id');

         if($metier_id == 0)
         {
            $metier_id = DB::table('metiers')->select('id')->where('libellemetier','=',$libellemetier)->first()->id;
         }
         elseif($metier_id != 0)
         {
            $ifad_id = Metier::where('ifad_id','=',$ifad_id)->select('ifad_id')->first()->ifad_id;
         }

         if(Rattacher::where('user_id','=',request('user_id'))
         ->where('metier_id','=',$metier_id)
         ->where('ifad_id','=',$ifad_id)->doesntExist())
         {
            $this->creation();

            return redirect('rattachers/create')->with('message', 'Informations bien enregistrées.');
         }
         else
         {
            $rattachement_verification = Rattacher::where('user_id','=',request('user_id'))
            ->where('metier_id','=',$metier_id)->where('ifad_id','=',$ifad_id)->select('*')->get()->last();

            if($rattachement_verification->datefin == null)
            {
              return back()->with('messagealert', "Veuillez définir la fin du rattachement de cet utilisateur");
            }
            else
            {
                $this->creation();

                return redirect('rattachers/create')->with('message', 'Informations bien enregistrées.');
            }

         }

      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
     }

     // return redirect('rapports')->with('message', 'Rapport bien ajoutée.');
      /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function show(Rattacher $rattacher)
     {
        $this->authorize('ad_su', User::class);
        try
        {
           return view('rattachers.show',compact('rattacher'));
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

     public function edit(Rattacher $rattacher)
     {
        $this->authorize('ad_su', User::class);
       try
       {
         $users = User::select('*')->get();
         $metiers = Metier::select('*')->where('libellemetier','not like',"%Aucun%")->get();
         $ifads = Ifad::select('*')->get();

        return view('rattachers.edit', compact('rattachers','users','metiers','ifads'));
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

     public function update(Rattacher $rattacher)
     {
        $this->authorize('ad_su', User::class);
      try
      {
              /** actualisation du rattachement **/
              $rattacher->update([
                'datefin'=> now(),
                ]);

            return redirect('rattachers/' . $rattacher->id)->with('message', 'Informations bien mise à jour.');

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

     public function destroy(Rattacher $rattacher)
     {
        $this->authorize('ad_su', User::class);
       try
       {
            $rattacher->delete();

            return redirect('rattachers')->with('messagealert','Suppression éffectuée');
      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }

     }


     private  function validator()
     {
         return request()->validate([
            'metier_id' =>'required|integer',
            'ifad_id' =>'required|integer',
         ]);
     }

     private function creation()
     {
        $ifad_id = request('ifad_id');
        $metier_id = request('metier_id');

        $libellemetier = 'Aucun_metier'.request('ifad_id');

         if($metier_id == 0)
         {
            $metier_id = DB::table('metiers')->select('id')->where('libellemetier','=',$libellemetier)->first()->id;
         }
         elseif($metier_id != 0)
         {
            /** si id du metier est different de 0 alors selectionner le vrai IFAD **/
            $ifad_id = Metier::where('ifad_id','=',$ifad_id)->select('ifad_id')->first()->ifad_id;
         }

        $nbre = count(request('user_id'));

        for ($i=0; $i < $nbre; $i++) {
            Rattacher::create([
                'user_id' => request('user_id')[$i],
                'metier_id'=> $metier_id,
                'ifad_id'=> $ifad_id,
                'datedebut'=> now(),
                'datefin'=> request('datefin'),
            ]);
        }

     }
}
