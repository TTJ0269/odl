<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Events\NotificationEvent;
use App\Mail\NotificationMail;
use App\Models\User;
use App\Models\Profil;
use App\Models\Historique;

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



            $users = User::select('*')->orderBy('id','DESC')->get();
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
    $this->validator();
   try
   {
      $password = strtotime(now());  //request('password')

      $imageuser = null;

        if(request('email') != null && User::where('email','=',request('email'))->select('id')->exists())
        {
            return back()->with('messagealert',"Ce mail existe déjà.");
        }
        elseif(request('teluser') != null && User::where('teluser','=',request('teluser'))->select('id')->exists())
        {
            return back()->with('messagealert',"Ce numéro de téléphone existe déjà.");
        }

        if($request->file('image'))
        {
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $request->image->move('storage/image/', $filename);

            $imageuser = $filename;
        }

        $user = User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password' => $password,
            'profil_id'=> request('profil_id'),
            'nomuser'=> request('nomuser'),
            'prenomuser'=> request('prenomuser'),
            'teluser'=> request('teluser'),
            'imageuser'=> $imageuser,
        ]);

      $this->historique(request('nomuser').' '.request('prenomuser'), 'Ajout');

      event(new NotificationEvent($user));

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
        if(request('email') != null && $user->email != request('email') && User::where('email','=',request('email'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le mail ".request('email')." existe déjà.");
        }
        elseif(request('teluser') != null && $user->teluser != request('teluser') && User::where('teluser','=',request('teluser'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le numéro de téléphone ".request('teluser')." existe déjà.");
        }
        elseif(request('name') != null && $user->name != request('name') && User::where('name','=',request('name'))->select('id')->exists())
        {
            return back()->with('messagealert',"Le login ".request('name')." existe déjà.");
        }
        else
        {
            $user->update([
                'name'=> request('name'),
                'nomuser'=> request('nomuser'),
                'prenomuser'=> request('prenomuser'),
                'email'=> request('email'),
                'profil_id'=> request('profil_id'),
                'teluser'=> request('teluser'),
                //'password'=> Hash::make(135792468),
                ]);

            $this->historique(request('nomuser').' '.request('prenomuser'), 'Modification');

            return redirect('users/' . $user->id);
        }

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
         'name'=>'required|unique:users',
         'nomuser'=>'required',
         'prenomuser'=>'required',
         'profil_id'=>'required|integer',
     ]);
 }

 public function GenerationNewPassword(User $user)
 {
   try
   {
      //dd($user);
      //$a = 123456789 ;
      $a = strtotime(now());
      $message = 'Votre nouveau de passe est : ';

      $useremail = ['email' => $user->email , 'nomuser' => $user->nomuser , 'prenomuser' => $user->prenomuser, 'password' => $a , 'message' => $message];

      DB::table('users')->where('users.id','=',$user->id)->update(['users.password' => Hash::make($a), 'users.etatconnection' => 0]);

      Mail::to($useremail['email'])->send(new NotificationMail($useremail));

      return redirect('users/' . $user->id)->with('message', 'Nouveau mot de passe bien régénérer.');

    }
    catch(\Exception $exception)
    {
      /** si erreur mot de passe par defaut **/
      DB::table('users')->where('users.id','=',$user->id)->update(['users.password' => Hash::make(123456789), 'users.etatconnection' => 0]);

      return redirect('erreur')->with('messageerreur',$exception->getMessage());
    }
 }

 public function ActiveCompte()
 {
   try
   {
    $user_id = request('id');

    $user = DB::table('users')->where('users.id','=',$user_id)->update(['users.etat' => 1]);

    $this->historique('Compte '.$user_id, 'Débloquer');

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

    $this->historique('Compte '.$user_id, 'Bloquer');

    return redirect('users/' . $user_id)->with('message', 'Compte bien bloqué.');

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
      'table'=> 'User',
      'attribute' => $attribute,
      'action'=> $action
    ]);
 }
}
