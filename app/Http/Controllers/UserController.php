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

class UserController extends Controller
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
        $this->authorize('admin', User::class);
        try
        {
            /** $users = User::with('type_utilisateur')->paginate(5); **/

            $users = User::select('*')->get();
            //$profils = Profil::all();

            return view('users.index', compact('users'));
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
    $this->authorize('admin', User::class);
   try
   {
      $user = new User();
      $profils = Profil::select('*')->get();

      return view('users.create',compact('user', 'profils'));

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
    $this->authorize('admin', User::class);
   try
   {
      $emailuser = request('email');
      $username=request('nomuser');
      $userprenom=request('prenomuser');
      $password = strtotime(now());  //request('password')

      $users = new User;

      $users->name=request('name');
      $users->email=request('email');
      $users->password=Hash::make($password);
      $users->profil_id=request('profil_id');
      $users->nomuser=request('nomuser');
      $users->prenomuser=request('prenomuser');
      $users->teluser=request('teluser');
      if($request->file('image'))
      {
          $file=$request->file('image');
          $filename=time().'.'.$file->getClientOriginalExtension();
          $request->image->move('storage/image/', $filename);

          $users->imageuser=$filename;
      }
      $users->save();

      $message = "Votre mot de passe est : ";

      $useremail = ['email' => $emailuser , 'nomuser' => $username , 'prenomuser' => $userprenom, 'password' => $password, 'message' => $message];

      Mail::to($useremail['email'])->send(new NotificationMail($useremail));

      return redirect('users')->with('message', 'Utilisateur bien ajouté.');

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

 public function show(User $user)
 {
    $this->authorize('admin', User::class);
    try
    {
      return view('users.show',compact('user'));
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

 public function edit(User $user)
 {
    $this->authorize('admin', User::class);
    try
    {
      $profils = Profil::all();
      return view('users.edit', compact('user', 'profils'));

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

 public function update(User $user)
 {
    $this->authorize('admin', User::class);
   try
   {
        $user->update([
            'name'=> request('name'),
            'nomuser'=> request('nomuser'),
            'prenomuser'=> request('prenomuser'),
            'email'=> request('email'),
            'profil_id'=> request('profil_id'),
            'teluser'=> request('teluser'),
            ]);

        return redirect('users/' . $user->id);

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

 public function destroy(User $user)
 {
   $this->authorize('admin', User::class);
   try
   {
       /** Recuperation du dernier en cours **/
       $reference = null; /*DB::table('ifad_moniteurs')
       ->where('ifad_moniteurs.user_id','=',Auth::user()->id)
       ->select('ifad_moniteurs.user_id')
       ->get()->last()->user_id;*/

      /*if($reference == null)
      {
          $user->delete();


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
         'name'=>'required',
         'nomuser'=>'required',
         'prenomuser'=>'required',
         'password'=>'required',
         'email'=>'required|email|min:8',
         'profil_id'=>'required|integer',
         'teluser'=>'integer',
     ]);
 }

 public function GenerationNewPassword()
 {
   try
   {
      $id = request('id');
      $emailuser = request('email');
      $username=request('nomutilisateur');
      $userprenom=request('prenomutilisateur');
      $a = Hash::make(strtotime(now())) ;



      $useremail = ['email' => $emailuser , 'nomuser' => $username , 'prenomuser' => $userprenom, 'password' => $a];

      $user = DB::table('users')->where('users.id','=',$id)->update(['users.password' => Hash::make($a), 'users.etatconnection' => 0]);

      Mail::to($useremail['email'])->send(new UserMail($useremail));

      return redirect('users/' . $id)->with('message', 'Nouveau mot de passe bien régénérer.');

    }
    catch(\Exception $exception)
    {
      /** si erreur mot de passe par defaut **/
      $user = DB::table('users')->where('users.id','=',$id)->update(['users.password' => Hash::make(123456789), 'users.etatconnection' => 0]);

      return redirect('erreur')->with('messageerreur',$exception->getMessage());
    }

 }

 public function ActiveCompte()
 {
   try
   {
    $user_id = request('id');

    $user = DB::table('users')->where('users.id','=',$user_id)->update(['users.etat' => 1]);

    return redirect('users/' . $user_id)->with('message', 'Compte bien activé.');

   }
  catch(\Exception $exception)
  {
      return redirect('erreur')->with('messageerreur',$exception->getMessage());
  }
 }

 public function BloquerCompte()
 {
   try
   {
    $user_id = request('id');

    $user = DB::table('users')->where('users.id','=',$user_id)->update(['users.etat' => 0]);

    return redirect('users/' . $user_id)->with('message', 'Compte bien bloqué.');

   }
  catch(\Exception $exception)
  {
      return redirect('erreur')->with('messageerreur',$exception->getMessage());
  }
 }

 private function historique()
 {
    
 }
}
