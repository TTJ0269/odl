<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Suivi;
use App\Models\User;
use App\Models\Ifad;
use App\Models\Entreprise;
use App\Models\Association;

class SuiviController extends Controller
{
    public function __construct()
  {
        $this->middleware('auth');//->except(['index'])
  }
  /**
   * Display a listing of the users
   *
   * @param  \App\Models\Suivi  $model
   * @return \Illuminate\View\View
   */

    public function index()
    {
        $this->authorize('ad_re_su', User::class);
        try
        {
            $suivis = Suivi::select('*')->get();

            return view('suivis.index', compact('suivis'));
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
      $suivi = new Suivi();
      $ifads = Ifad::select('*')->get();
      $entreprises = Entreprise::select('*')->get();

      /** Liste des tuteurs**/
      $users = DB::table('profils')
      ->join('users','profils.id','=','users.profil_id')
      ->where('profils.libelleprofil','=','Chargé du suivi')
      ->select('users.*')
      ->get();

      return view('suivis.create',compact('ifads','entreprises','users','suivi'));

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
   try
   {
      $entreprise_id = request('entreprise_id');
      $user_id = request('user_id');
      $tuteur_suivi_id = request('tuteur_suivi_id');

        if(Suivi::where('user_id','=',$user_id)->where('entreprise_id','=',$entreprise_id)->select('*')->exists())
         {
            $suivi_verification = Suivi::where('user_id','=',$user_id)
            ->where('entreprise_id','=',$entreprise_id)->select('*')->get()->last();

            if($suivi_verification->datefin == null)
            {
              return back()->with('messagealert', "Veuillez définir la fin du suivi de cet utilisateur");
            }
            else
            {
                $this->creation();

                return redirect('suivis/create')->with('message', 'Informations bien enregistrées.');
            }
        }
        else
        {
            $this->creation();

            return redirect('suivis/create')->with('message', 'Informations bien enregistrées.');
        }

      //dd($entreprise_id,$user_id,$tuteur_suivi_id);

      //$sendemail = ['email' => $emailuser , 'nomutilisateur' => $username , 'prenomutilisateur' => $userprenom, 'password' => $a];

      //Mail::to($sendemail['email'])->send(new UserMail($sendemail));

      return redirect('suivis/create')->with('message', 'Informations bien entregistrées.');

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

 public function show(Suivi $suivi)
 {
    $this->authorize('ad_re_su', User::class);
    try
    {
      return view('suivis.show',compact('suivi'));
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

 public function edit(Suivi $suivi)
 {
    /* $this->authorize('ad_re_su', User::class);
    try
    {
       /* $classes = Classe::select('*')->where('libelleclasse','not like',"%Aucune%")->get();
        $entreprises = Entreprise::select('*')->get();*/

        /** Liste des tuteurs**/
        /*$users = DB::table('profils')
        ->join('users','profils.id','=','users.profil_id')
        ->where('profils.libelleprofil','=','Chargé du suivi')
        ->select('users.*')
        ->get();

       return view('suivis.edit', compact('classes', 'entreprises','users','suivi'));*/

    /*}
    catch(\Exception $exception)
    {
        return redirect('erreur')->with('messageerreur',$exception->getMessage());
    }*/
 }

    /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */

 public function update(Suivi $suivi)
 {
    $this->authorize('ad_re_su', User::class);
    try
    {
        $suivi->update(['datefin'=> now()]);

        return redirect('suivis/' . $suivi->id)->with('message', 'Informations bien entregistrées.');

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

    public function destroy(Suivi $suivi)
    {
        $this->authorize('ad_re_su', User::class);
        try
        {
            $suivi->delete();

            return redirect('suivis');

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    private function creation()
    {
        $entreprise_id = request('entreprise_id');
        $user_id = request('user_id');
        $tuteur_suivi_id = request('tuteur_suivi_id');

        $suivi = Suivi::create([
            'entreprise_id'=> $entreprise_id,
            'user_id'=> $user_id,
            'tuteur_suivi_id' => $tuteur_suivi_id,
            'datedebut'=> now()
          ]);
    }

}
