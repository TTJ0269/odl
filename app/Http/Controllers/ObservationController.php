<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Observation;
use App\Models\FichePositionnement;
use App\Models\Profil;
use App\Models\User;
use App\Models\Historique;

class ObservationController extends Controller
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
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

            if($profil_libelle == 'Administrateur' || $profil_libelle == 'Responsable pédagogique' || $profil_libelle == 'Suivi_AED')
           {
                $observations = Observation::select('*')->orderBy('observations.id','DESC')->get();

                return view('observations.index', compact('observations'));
           }
           elseif($profil_libelle == 'Chargé du suivi')
           {
                $observations = Observation::where('responsable','=',Auth::user()->id)->select('*')->orderBy('observations.id','DESC')->get();

                return view('observations.index', compact('observations'));
           }
           elseif($profil_libelle == 'DG_IFAD')
           {
                if(DB::table('associations')->where('associations.user_id','=',Auth::user()->id)->select('associations.id')->doesntExist())
                {
                    return back()->with('messagealert',"Vous n'est pas associé à un IFAD");
                }
                else
                {
                    $ifad_id = DB::table('associations')->where('associations.user_id','=',Auth::user()->id)
                    ->select('ifad_id')->get()->last()->ifad_id;

                    $observations = Observation::select('*')->orderBy('observations.id','DESC')->get();

                    return view('observations.index', compact('observations'));
                }
           }
           else
           {
                if(DB::table('associations')->where('associations.user_id','=',Auth::user()->id)->select('associations.id')->doesntExist())
                {
                    return back()->with('messagealert',"Vous n'est pas associé à un IFAD");
                }
                else
                {
                    $association = DB::table('associations')->where('associations.user_id','=',Auth::user()->id)
                    ->select('id')->get()->last()->id;

                    $observations = Observation::where('association_id','=',$association->id)->select('*')->orderBy('observations.id','DESC')->get();

                    return view('observations.index', compact('observations'));
                }
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

     public function create(user $user)
     {
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
            if(DB::table('associations')->where('associations.user_id','=',$user->id)->select('associations.id')->doesntExist())
            {
                return back()->with('messagealert',"L'apprenant(e) n'est pas associé(e) à un IFAD");
            }
            else
            {
                $users = User::select('*')->where('id','=',$user->id)->get();
                $observation = new Observation();

                return view('observations.create',compact('observation','users'));
            }
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
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
            $users_id = Auth::user()->id;
            $user_id = request('user_id');

            $association = DB::table('associations')->where('associations.user_id','=',$user_id)->select('id')->get()->last()->id;

            $observation = Observation::create([
                    'descriptionobservation'=> request('descriptionobservation'),
                    'association_id'=> $association,
                    'responsable'=> Auth::user()->id,
                    'dateobservation'=> now(),
            ]);

            $this->historique(request('descriptionobservation'), 'Ajout');

            return back()->with('message', 'Observation bien envoyé.');
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

     public function show(Observation $observation)
     {
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
          return view('observations.show',compact('observation'));
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

     public function edit(observation $observation)
     {
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
            $users = User::select('*')->get();
            return view('observations.edit', compact('observation','users'));
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

     public function update(observation $observation)
     {
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
            $observation->update([
                'descriptionobservation'=> request('descriptionobservation'),
            ]);

            $this->historique($observation->descriptionobservation, 'Modification');

            return redirect('observations/' . $observation->id);
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

     public function destroy(observation $observation)
     {
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
            $observation->delete();

            $this->historique($observation->descriptionobservation, 'Suppression');

            return redirect('observations');
         }
        catch(\Exception $exception)
       {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Observation',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }

}
