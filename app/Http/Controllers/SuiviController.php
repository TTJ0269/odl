<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Suivi;
use App\Models\User;
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
            $suivis = Suivi::select('*')->orderBy('id','DESC')->get();

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
      $entreprises = Entreprise::select('*')->get();

      /** Liste des apprenants**/
      $apprenants = DB::table('profils')
      ->join('users','profils.id','=','users.profil_id')
      ->where('profils.libelleprofil','=','Apprenant')
      ->select('users.*')
      ->get();

      return view('suivis.create',compact('apprenants','entreprises','suivi'));

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
   /*try
   {*/
        $entreprise_id = request('entreprise_id');
        $user_id = request('user_id');
        $datedebut = request('datedebut');
        $datefin = request('datefin');

        /*$entreprise = Entreprise::where('id','=',$entreprise_id)->select('*')->first();
        $tuteur_suivi = User::where('email','=',$entreprise->emailentreprise)->select('*')->first();*/

        $nbre = count(request('user_id'));

        for ($i=0; $i < $nbre; $i++) {
            Suivi::create([
                'user_id' => (int)request('user_id')[$i],
                'entreprise_id'=> $entreprise_id,
                'tuteur_suivi_id' => 1,
                'datedebut'=> null,
                'datefin'=> null,
            ]);
        }

      return redirect('suivis/create')->with('message', 'Informations bien enregistrées.');

     /* if(Date::make($datedebut) > Date::make($datefin))
      {
        return back()->with('messagealert', "Date début supérieure à la date de fin ");
      }
      else
      {
        if(Suivi::where('user_id','=',$user_id)->where('entreprise_id','=',$entreprise_id)->select('*')->exists())
        {
            $suivi_verification = Suivi::where('user_id','=',$user_id)
            ->where('entreprise_id','=',$entreprise_id)->select('*')->get()->last();

            $date_fin_now = Date::make($datefin);
            $date_fin_avant = Date::make($suivi_verification->datefin);

            if($date_fin_avant > $date_fin_now)
            {
                return back()->with('messagealert', "L'apprenant(e) est toujours en stage .Veuillez définir sa fin de stage ");
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
      }*/

  /*}
  catch(\Exception $exception)
  {
      return redirect('erreur')->with('messageerreur',$exception->getMessage());
  }*/

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
       /* $metiers = metier::select('*')->where('libellemetier','not like',"%Aucune%")->get();
        $entreprises = Entreprise::select('*')->get();*/

        /** Liste des tuteurs**/
        /*$users = DB::table('profils')
        ->join('users','profils.id','=','users.profil_id')
        ->where('profils.libelleprofil','=','Chargé du suivi')
        ->select('users.*')
        ->get();

       return view('suivis.edit', compact('metiers', 'entreprises','users','suivi'));*/

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

    private  function validator()
    {
        return request()->validate([
            'entreprise_id'=>'required|integer',
            //'user_id'=>'required|integer',
        ]);
    }

    /*private function creation()
    {
        $entreprise_id = request('entreprise_id');
        $user_id = request('user_id');
        $datedebut = request('datedebut');
        $datefin = request('datefin');

        $entreprise = Entreprise::where('id','=',$entreprise_id)->select('*')->first();
        $tuteur_suivi = User::where('email','=',$entreprise->emailentreprise)->select('*')->first();

        $nbre = count(request('user_id'));

            for ($i=0; $i < $nbre; $i++) {
                Suivi::create([
                    'user_id' => (int)request('user_id')[$i],
                    'entreprise_id'=> $entreprise_id,
                    'tuteur_suivi_id' => $tuteur_suivi->id,
                    'datedebut'=> null,
                    'datefin'=> null,
                ]);
            }
    }*/

}
