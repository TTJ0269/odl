<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NotificationMail;
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

            $apprenants = DB::table('profils')
            ->join('users','profils.id','=','users.profil_id')
            ->join('associations','users.id','=','associations.user_id')
            ->join('ifads','ifads.id','=','associations.ifad_id')
            ->where('profils.libelleprofil','=','Apprenant')
            ->select('users.*','ifads.id as ifad_id','ifads.libelleifad')
            ->orderBy('users.id','DESC')
            ->get();

            return view('apprenants.index', compact('apprenants'));
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
        $ifad_id = request('ifad_id');
        $name = request('nomuser').' '.request('prenomuser');
        $password = request('prenomuser').'@'.request('teluser');  //request('password')
        $imageuser = null;

        if($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;
        }

        if(User::where('email','=',request('email'))->select('id')->doesntExist())
        {
            /** Enregistrement de l'apprenant(e) **/
            $apprenant = User::insertGetId([
                'name'=> $name,
                'email'=> request('email'),
                'password' => Hash::make($password),
                'profil_id'=> $profil_id,
                'nomuser'=> request('nomuser'),
                'prenomuser'=> request('prenomuser'),
                'teluser'=> request('teluser'),
                'imageuser'=> $imageuser,
                'etat'=> 1,
                'etatsup'=> 0,
                'etatconnection'=> 0,
            ]);
            if(Association::where('user_id','=',$apprenant)->where('ifad_id','=',$ifad_id)->select('*')->doesntExist())
            {
                /** Association d'un apprenant a un ifad **/
                Association::create([
                    'user_id' => $apprenant,
                    'ifad_id'=> $ifad_id,
                    'datedebut'=> now(),
                    'datefin'=> null,
                ]);
            }


            $this->historique(request('nomuser').' '.request('prenomuser'), 'Ajout');

            /*$message = "Votre mot de passe est : ";

            $useremail = ['email' => $emailuser , 'nomuser' => $username , 'prenomuser' => $userprenom, 'password' => $password, 'message' => $message];

            Mail::to($useremail['email'])->send(new NotificationMail($useremail));*/

            return redirect('apprenants')->with('message', 'Apprenant(e) bien ajouté(e).');
        }

        return back()->with('messagealert',"Le mail existe déjà.");
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
    $this->validator();
   try
   {
        $ifad_id = request('ifad_id');

        $association = Association::where('user_id','=',$apprenant->id)->select('*')->get()->last();

        if($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;

            $apprenant->update([
                'nomuser'=> request('nomuser'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                'imageuser'=> $imageuser,
                //'password'=> Hash::make(135792468),
            ]);
        }
        else
        {
            $apprenant->update([
                'nomuser'=> request('nomuser'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'teluser'=> request('teluser'),
                //'password'=> Hash::make(135792468),
            ]);
        }


        /** Actualisation Association d'un apprenant a un ifad **/
        $associat = DB::table('associations')->where('associations.id','=',$association->id)->update(['associations.ifad_id'=> $ifad_id]);

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
     return redirect('users')->with('messagealert','Pas de suppression pour le moment');
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
         'email'=>'required|email|min:4',
         'ifad_id'=>'required|integer',
         'teluser'=>'integer',
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
