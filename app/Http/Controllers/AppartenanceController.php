<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Appartenance;
use App\Models\Profil;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Historique;

class AppartenanceController extends Controller
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
         $appartenances = Appartenance::select('*')->orderBy('id','DESC')->get();

         return view('appartenances.index', compact('appartenances'));
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
         $appartenance = new Appartenance();
         $entreprises = Entreprise::select('*')->get();

         return view('appartenances.create',compact('appartenance','entreprises'));

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
        if(Profil::where('libelleprofil','Chargé du suivi')->exists())
        {
            $profil_id = Profil::where('libelleprofil','Chargé du suivi')->select('id')->first()->id;
            $emailuser = request('email');
            $username=request('nomuser');
            $userprenom=request('prenomuser');
            $entreprise_id = request('entreprise_id');
            $name = request('name');
            $password = request('prenomuser').'@'.request('teluser');  //request('password')
            $imageuser = null;

            if($request->file('image'))
            {
                $file=$request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $request->image->move('storage/image/', $filename);

                $imageuser = $filename;
            }

            if(request('email') != null && User::where('email','=',request('email'))->select('id')->exists())
            {
                return back()->with('messagealert',"Ce mail existe déjà.");
            }
            elseif(request('teluser') != null && User::where('teluser','=',request('teluser'))->select('id')->exists())
            {
                return back()->with('messagealert',"Ce numéro de téléphone existe déjà.");
            }
            else
            {
                /** Enregistrement de l'apprenant(e) **/
                $user = User::create([
                    'name'=> $name,
                    'email'=> request('email'),
                    'password' => Hash::make($password), // si le mail sera envoyé alors ça $password NB: le mot de passe est crypté dans l'envoye du mail,
                    'profil_id'=> $profil_id,
                    'nomuser'=> request('nomuser'),
                    'prenomuser'=> request('prenomuser'),
                    'teluser'=> request('teluser'),
                    'imageuser'=> $imageuser,
                ]);

                if(Appartenance::where('user_id','=',$user->id)->where('entreprise_id','=',$entreprise_id)->select('*')->doesntExist())
                {
                    /** Association d'un apprenant a un ifad **/
                    Appartenance::create([
                        'user_id' => $user->id,
                        'entreprise_id'=> $entreprise_id,
                    ]);
                }


                $this->historique(request('nomuser').' '.request('prenomuser'), 'Ajout');

                //event(new NotificationEvent($user));

                return redirect('appartenances')->with('message', 'Tuteur/Tutrice bien ajouté(e).');
            }

            return back()->with('messagealert',"Le mail existe déjà.");
        }
        else
        {
             //profil tuteur = Chargé du suivi
            return back()->with('messagealert', "Le profil Tuteur n'existe pas encore.");
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

     public function show(Appartenance $appartenance)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
           return view('appartenances.show',compact('appartenance'));
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

     public function edit(Appartenance $appartenance)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
         $entreprises = Entreprise::select('*')->get();

         return view('appartenances.edit', compact('appartenance','entreprises'));
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

     public function update(Appartenance $appartenance, Request  $request)
     {
        $this->authorize('ad_re_su', User::class);
      try
      {
        $entreprise_id = request('entreprise_id');

        if(request('email') != null && $appartenance->user->email != request('email') && User::where('email','=',request('email'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le mail ".request('email')." existe déjà.");
        }
        elseif(request('teluser') != null && $appartenance->user->teluser != request('teluser') && User::where('teluser','=',request('teluser'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le numéro de téléphone ".request('teluser')." existe déjà.");
        }
        elseif(request('name') != null && $appartenance->user->name != request('name') && User::where('name','=',request('name'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le login ".request('name')." existe déjà.");
        }
        elseif($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;

            $appartenance->user->update([
                'nomuser'=> request('nomuser'),
                'name'=> request('name'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                'imageuser'=> $imageuser,
                //'password'=> Hash::make(135792468),
            ]);
        }
        else
        {
            $appartenance->user->update([
                'nomuser'=> request('nomuser'),
                'name'=> request('name'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                //'password'=> Hash::make(135792468),
            ]);
        }


        /** Actualisation Appartenance **/
        DB::table('appartenances')->where('appartenances.id','=',$appartenance->id)->update(['appartenances.entreprise_id'=> $entreprise_id]);

        $this->historique(request('nomuser').' '.request('prenomuser'), 'Modification');

        return redirect('appartenances/' . $appartenance->id)->with('message', "Informations du tuteur/tutrice bien modifiées.");

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

     public function destroy(Appartenance $appartenance)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
            $appartenance->delete();

            return redirect('appartenances')->with('messagealert','Suppression éffectuée');
      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }

     }


     private  function validator()
     {
        return request()->validate([
            'nomuser'=>'required',
            'prenomuser'=>'required',
            'entreprise_id'=>'required|integer',
            'name'=>'required|unique:users',
        ]);
     }

    private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'User',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
