<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NotificationMail;
use App\Events\NotificationEvent;
use App\Models\User;
use App\Models\Profil;
use App\Models\Ifad;
use App\Models\Association;
use App\Models\Historique;

class ApprenantController extends Controller
{
    public function __construct()
  {
        $this->middleware('auth');//->except(['index'])
  }
  /**
   * Display a listing of the users
   *
   * @param  \App\Models\User  $model
   * @return \Illuminate\View\View
   */
  /**public function index(User $model)
  {
      return view('users.index', ['users' => $model->paginate(15)]);
  }*/

    public function index()
    {
        $this->authorize('ad_re_su', User::class);
        try
        {
            /** $users = User::with('type_utilisateur')->paginate(5); **/

            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

            if($profil_libelle == 'Responsable pédagogique')
           {
                if(DB::table('rattachers')->where('rattachers.user_id','=',Auth::user()->id)->select('rattachers.id')->doesntExist())
                {
                    return back()->with('messagealert',"Vous n'est pas associé à un IFAD");
                }
                else
                {
                    $ifad_id = DB::table('rattachers')
                    ->where('rattachers.user_id','=',Auth::user()->id)
                    ->select('rattachers.ifad_id')->get()->last()->ifad_id;

                    $apprenants = DB::table('profils')
                    ->join('users','profils.id','=','users.profil_id')
                    ->join('associations','users.id','=','associations.user_id')
                    ->join('classes','classes.id','=','associations.classe_id')
                    ->join('metiers','metiers.id','=','classes.metier_id')
                    ->join('ifads','ifads.id','=','metiers.ifad_id')
                    ->where('profils.libelleprofil','=','Apprenant')
                    ->where('ifads.id','=',$ifad_id)
                    ->select('users.*','ifads.id as ifad_id','ifads.libelleifad','classes.id as id_classe','classes.libelleclasse','metiers.id as id_metier','metiers.libellemetier')
                    ->orderBy('users.id','DESC')
                    ->get();

                    return view('apprenants.index', compact('apprenants'));
                }
            }
            else
            {
                $apprenants = DB::table('profils')
                ->join('users','profils.id','=','users.profil_id')
                ->join('associations','users.id','=','associations.user_id')
                ->join('classes','classes.id','=','associations.classe_id')
                ->join('metiers','metiers.id','=','classes.metier_id')
                ->join('ifads','ifads.id','=','metiers.ifad_id')
                ->where('profils.libelleprofil','=','Apprenant')
                ->select('users.*','ifads.id as ifad_id','ifads.libelleifad','classes.id as id_classe','classes.libelleclasse','metiers.id as id_metier','metiers.libellemetier')
                ->orderBy('users.id','DESC')
                ->get();

                return view('apprenants.index', compact('apprenants'));
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
    if(Profil::where('libelleprofil','Apprenant')->exists())
    {
        $apprenant = new User();
        $ifads = Ifad::select('*')->get();

        return view('apprenants.create',compact('apprenant','ifads'));
    }
    else
    {
        return back()->with('messagealert', "Le profil Apprenant n'existe pas encore.");
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

 public function store(Request  $request)
 {
    $this->authorize('ad_re_su', User::class);
    $this->validator();
   try
   {
    if(Profil::where('libelleprofil','Apprenant')->exists())
    {
        $profil_id = Profil::where('libelleprofil','Apprenant')->select('id')->first()->id;
        $emailuser = request('email');
        $username=request('nomuser');
        $userprenom=request('prenomuser');
        $numero_matricule=request('numero_matricule');
        $classe_id = request('classe_id');
        $name = request('name');
        $password = request('nomuser').'@'.now()->format('Y'); //request('password')
        $imageuser = null;

        if($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;
        }

        if($classe_id == null)
        {
            return back()->with('messagealert',"Sélectionner une classe.");
        }
        /*elseif(request('numero_matricule') != null && User::where('numero_matricule','=',request('numero_matricule'))->select('id')->exists())
        {
            return back()->with('messagealert',"Ce numéro matricule existe déjà.");
        }*/
        elseif(request('email') != null && User::where('email','=',request('email'))->select('id')->exists())
        {
            return back()->with('messagealert',"Ce mail existe déjà.");
        }
        /*elseif(request('teluser') != null && User::where('teluser','=',request('teluser'))->select('id')->exists())
        {
            return back()->with('messagealert',"Ce numéro de téléphone existe déjà.");
        }*/
        else
        {
            /** Enregistrement de l'apprenant(e) **/
            $user = User::create([
                'numero_matricule'=> request('numero_matricule'),
                'name'=> $name,
                'email'=> request('email'),
                'password' => Hash::make($password), // si le mail sera envoyé alors ça $password NB: le mot de passe est crypté dans l'envoye du mail,
                'profil_id'=> $profil_id,
                'nomuser'=> request('nomuser'),
                'prenomuser'=> request('prenomuser'),
                'teluser'=> request('teluser'),
                'imageuser'=> $imageuser,
            ]);

            if(Association::where('user_id','=',$user->id)->where('classe_id','=',$classe_id)->select('*')->doesntExist())
            {
                /** Association d'un apprenant a un ifad **/
                Association::create([
                    'user_id' => $user->id,
                    'classe_id'=> $classe_id,
                    'datedebut'=> now(),
                    'datefin'=> null,
                ]);
            }

            $this->historique(request('nomuser').' '.request('prenomuser'), 'Ajout');

            //event(new NotificationEvent($user));

            return redirect('apprenants')->with('message', 'Apprenant(e) bien ajouté(e).');
        }

    }
    else
    {
        return back()->with('messagealert', "Le profil Apprenant n'existe pas encore.");
    }

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

 public function show(User $apprenant)
 {
    $this->authorize('ad_re_su', User::class);
    try
    {
      return view('apprenants.show',compact('apprenant'));
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

 public function edit(User $apprenant)
 {
    $this->authorize('ad_re_su', User::class);
    try
    {
      $ifads = Ifad::select('*')->get();

      return view('apprenants.edit', compact('apprenant','ifads'));
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

 public function update(User $apprenant, Request  $request)
 {
    $this->authorize('ad_re_su', User::class);
   try
   {
        $classe_id = request('classe_id');

        $association = Association::where('user_id','=',$apprenant->id)->select('*')->get()->last();

        if($classe_id == null)
        {
            return back()->with('messagealert',"Sélectionner une classe");
        }
        if(request('email') != null && $apprenant->email != request('email') && User::where('email','=',request('email'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le mail ".request('email')." existe déjà.");
        }
        elseif(request('numero_matricule') != null && $apprenant->numero_matricule != request('numero_matricule') && User::where('numero_matricule','=',request('numero_matricule'))->select('id')->exists())
        {
            return back()->with('messagealert',"Ce numéro matricule existe déjà.");
        }
        elseif(request('teluser') != null && $apprenant->teluser != request('teluser') && User::where('teluser','=',request('teluser'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le numéro de téléphone ".request('teluser')." existe déjà.");
        }
        elseif(request('name') != null && $apprenant->name != request('name') && User::where('name','=',request('name'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le login ".request('name')." existe déjà.");
        }
        if($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;

            $apprenant->update([
                'name'=> request('name'),
                'nomuser'=> request('nomuser'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                'numero_matricule'=> request('numero_matricule'),
                'imageuser'=> $imageuser,
                //'password'=> Hash::make(135792468),
            ]);
        }
        else
        {
            $apprenant->update([
                'name'=> request('name'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                'numero_matricule'=> request('numero_matricule'),
                //'password'=> Hash::make(135792468),
            ]);
        }


        /** Actualisation Association d'un apprenant a un ifad **/
        $associat = DB::table('associations')->where('associations.id','=',$association->id)->update(['associations.classe_id'=> $classe_id]);

        $this->historique(request('nomuser').' '.request('prenomuser'), 'Modification');

        return redirect('apprenants/' . $apprenant->id)->with('message', "Informations de l'apprenant(e) bien modifiées.");

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

 public function destroy(User $apprenant)
 {
    $this->authorize('ad_re_su', User::class);
   try
   {
       /** Recuperation du dernier en cours **/
       $reference = null; /*DB::table('ifad_moniteurs')
       ->where('ifad_moniteurs.user_id','=',Auth::user()->id)
       ->select('ifad_moniteurs.user_id')
       ->get()->last()->user_id;*/

      /*if($reference == null)
      {
          $apprenant->delete();


          return redirect('users');
      }*/
     return redirect('apprenants')->with('messagealert','Pas de suppression pour le moment');
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
         'classe_id'=>'required|integer',
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
