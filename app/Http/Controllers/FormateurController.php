<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Rattacher;
use App\Models\Profil;
use App\Models\User;
use App\Models\Metier;
use App\Models\Classe;
use App\Models\Historique;

class FormateurController extends Controller
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
        $formateurs = DB::table('profils')
        ->join('users','profils.id','=','users.profil_id')
        ->join('rattachers','users.id','=','rattachers.user_id')
        ->join('metiers','metiers.id','=','rattachers.metier_id')
        ->join('ifads','ifads.id','=','metiers.ifad_id')
        ->where('profils.libelleprofil','=','Formateur_IFAD')
        ->where('rattachers.datefin','=',null)
        ->select('users.*','ifads.id as ifad_id','ifads.libelleifad','metiers.id as id_metier','metiers.libellemetier')
        ->orderBy('users.id','DESC')
        ->get();

         return view('formateurs.index', compact('formateurs'));
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
        if(Profil::where('libelleprofil','Formateur_IFAD')->exists())
        {
            $formateur = new User();
            $metiers = Metier::select('*')->get();//->where('libellemetier','not like',"%Aucun%")

            return view('formateurs.create',compact('formateur','metiers'));
        }

         return back()->with('messagealert', "Le profil Formateur n'existe pas encore.");

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
        $this->authorize('ad_su', User::class);
        $this->validator();

       try
       {
        if(Profil::where('libelleprofil','Formateur_IFAD')->exists())
        {
            $profil_id = Profil::where('libelleprofil','Formateur_IFAD')->select('id')->first()->id;
            $emailuser = request('email');
            $username=request('nomuser');
            $userprenom=request('prenomuser');
            $metier_id = request('metier_id');
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

                /** le formateur peut intervenir dans plusieurs classes **/

                    if(Rattacher::where('user_id','=',$user->id)->where('metier_id','=',$metier_id)->select('*')->exists())
                    {
                        Rattacher::where('user_id','=',$user->id)->where('metier_id','=',$metier_id)->update(['datefin' => now()]);
                    }
                     $ifad_id = Metier::where('id','=',$metier_id)->select('ifad_id')->first()->ifad_id;
                        /** Rattacher d'un formateur à un metier **/
                        Rattacher::create([
                            'user_id' => $user->id,
                            'ifad_id'=> $ifad_id,
                            'metier_id'=> $metier_id,
                            'datedebut'=> now(),
                            'datefin'=> null,
                        ]);


                $this->historique(request('nomuser').' '.request('prenomuser'), 'Ajout');

                //event(new NotificationEvent($user));

                return redirect('formateurs')->with('message', 'Formateur/Formatrice bien ajouté(e).');
            }

            return back()->with('messagealert',"Le mail existe déjà.");
        }
        else
        {
            return back()->with('messagealert', "Le profil Formateur n'existe pas encore.");
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

     public function show(User $formateur)
     {
        $this->authorize('ad_su', User::class);
        try
        {
           return view('formateurs.show',compact('formateur'));
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

     public function edit(User $formateur)
     {
        $this->authorize('ad_su', User::class);
       try
       {
         $metiers = Metier::select('*')->get();

         return view('formateurs.edit', compact('formateur','metiers'));
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

     public function update(User $formateur, Request  $request)
     {
        $this->authorize('ad_su', User::class);
      try
      {
        //$metier_id = request('metier_id');

        if(request('email') != null && $formateur->email != request('email') && User::where('email','=',request('email'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le mail ".request('email')." existe déjà.");
        }
        elseif(request('teluser') != null && $formateur->teluser != request('teluser') && User::where('teluser','=',request('teluser'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le numéro de téléphone ".request('teluser')." existe déjà.");
        }
        elseif(request('name') != null && $formateur->name != request('name') && User::where('name','=',request('name'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le login ".request('name')." existe déjà.");
        }
        elseif($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;

            $formateur->update([
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
            $formateur->update([
                'nomuser'=> request('nomuser'),
                'name'=> request('name'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                //'password'=> Hash::make(135792468),
            ]);
        }

        $this->historique(request('nomuser').' '.request('prenomuser'), 'Modification');

        return redirect('formateurs/' . $formateur->id)->with('message', "Informations du Formateur/Formatrice bien modifiées.");

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

     public function destroy(User $formateur)
     {
        $this->authorize('ad_su', User::class);
       try
       {
            $formateur->delete();

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
            'metier_id'=>'required',
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
