<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Association;
use App\Models\User;
use App\Models\Ifad;
use App\Models\Classe;

class AssociationController extends Controller
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
        $this->authorize('ad_re_su', User::class);
       try
       {
         $associations = Association::select('*')->orderBy('id','DESC')->get();

         return view('associations.index', compact('associations'));
       }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }

     }

     public function getIfad(Request $request)
    {
        try
        {
            $ifads = DB::table('ifads')
            ->join('classes','ifads.id','=','classes.ifad_id')
            ->select('classes.id','classes.libelleclasse')
            ->where('ifads.id', $request->ifad_id)
            ->where('classes.libelleclasse','not like',"%Aucune%")
            ->orderBy('ifads.id')
            ->get();

            if (count($ifads) > 0)
            {
                return response()->json($ifads);
            }

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
         $association = new Association();
         $ifads = Ifad::select('*')->get();
         $users = DB::table('profils')
         ->join('users','profils.id','=','users.profil_id')
         ->where('profils.libelleprofil','=','Apprenant')
         ->orWhere('profils.libelleprofil','=','DG_IFAD')
         ->orWhere('profils.libelleprofil','=','Chargé du suivi')
         ->select('users.*','profils.libelleprofil')
         ->get();

         //$classes = Classe::select('*')->get();

         return view('associations.create',compact('association','users','ifads'));

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
           /** ici il peut arriver qu'un utilisateur ne soit pas dans aucune classe
            * pour cela aucune_le libelle de l'IFAD ont creer prealablement comme classe **/
             $ifad_id = request('ifad_id');
            if($ifad_id == null)
             {
                  return back()->with('messagealert', "Sélectionner un IFAD");
             }
            elseif(Association::where('user_id','=',request('user_id'))->where('ifad_id','=',$ifad_id)->select('*')->exists())
            {
                $assocition_verification = Association::where('user_id','=',request('user_id'))
                ->where('ifad_id','=',$ifad_id)->select('*')->get()->last();

                if($assocition_verification->datefin == null)
                {
                return back()->with('messagealert', "Veuillez définir la fin de l'association de cet utilisateur");
                }
                else
                {
                    $this->creation();

                    return redirect('associations/create')->with('message', 'Informations bien enregistrées.');
                }
            }
            else
            {
                $this->creation();

                return redirect('associations/create')->with('message', 'Informations bien enregistrées.');
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

     public function show(Association $association)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
           return view('associations.show',compact('association'));
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

     public function edit(Association $association)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
         $users = User::select('*')->get();
         $ifads = Ifad::select('*')->get();

        return view('associations.edit', compact('association','users','ifads'));
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

     public function update(Association $association)
     {
        $this->authorize('ad_re_su', User::class);
      try
      {
              /** actualisation de l'association **/
              $association->update([
                'datefin'=> now(),
                ]);

            return redirect('associations/' . $association->id)->with('message', 'Informations bien mise à jour.');

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

     public function destroy(Association $association)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $association->delete();

            return redirect('associations')->with('messagealert','Suppression éffectuée');
      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }

     }


     private  function validator()
     {
         return request()->validate([
            'user_id'=> 'required|integer',
            'ifad_id' =>'required|integer',
         ]);
     }

     private function creation()
     {
        $ifad_id = request('ifad_id');

        $nbre = count(request('user_id'));

            for ($i=0; $i < $nbre; $i++) {
                Association::create([
                    'user_id' => (int)request('user_id')[$i],
                    'ifad_id'=> $ifad_id,
                    'datedebut'=> now(),
                    'datefin'=> request('datefin'),
                ]);
            }
     }
}
