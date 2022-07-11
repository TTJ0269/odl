<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use App\Models\Suivi;
use App\Models\Profil;
use App\Models\User;
use App\Models\Historique;

class EntrepriseController extends Controller
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
        $this->authorize('ad_re_su', User::class);
        try
        {
            $entreprises = Entreprise::select('*')->orderBy('id','DESC')->get();

            return view('entreprises.index', compact('entreprises'));
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
            if(Profil::where('libelleprofil','Chargé du suivi')->exists())
            {
                $entreprise = new Entreprise();

                return view('entreprises.create',compact('entreprise'));
            }
            else
            {
                //profil entreprise = chargé du suivi.
                return back()->with('messagealert', "Le profil Entreprise n'existe pas encore.");
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
         if(Profil::where('libelleprofil','Chargé du suivi')->exists())
         {
            $profil_id = Profil::where('libelleprofil','Chargé du suivi')->select('id')->first()->id;
            $entreprise_libelle = request('libelleentreprise');
            $entreprise_email = request('emailentreprise');
            $entreprise_tel = request('telentreprise');
            $entreprise_adresse = request('adresseentreprise');
            $password = strtotime(now());  //request('password')
            //$entreprise_logo = request('logoentreprise');

            //dd($entreprise_libelle, $entreprise_email, $entreprise_tel);

              $entreprise_logo = null;

              if($request->file('logoentreprise'))
              {
                  $file=$request->file('logoentreprise');
                  $filename=time().'.'.$file->getClientOriginalExtension();
                  $request->logoentreprise->move('storage/entreprise/', $filename);

                  $entreprise_logo = $filename;
              }

              $users = User::select('*')->get();
              foreach($users as $user)
              {
                  if($user->email == $entreprise_email)
                  {
                    return back()->with('messagealert', "Le mail existe déjà.");
                  }
              }

              if(Entreprise::where('libelleentreprise','=',request('libelleentreprise'))->select('id')->doesntExist())
              {
                    $entreprise = Entreprise::create([
                    'libelleentreprise'=> request('libelleentreprise'),
                    'emailentreprise'=> request('emailentreprise'),
                    'telentreprise'=> request('telentreprise'),
                    'adresseentreprise'=> request('adresseentreprise'),
                    'logoentreprise'=> $entreprise_logo,
                    ]);

                /** Création info connection entreprise **/
                    $entrep = User::create([
                        'name'=> request('libelleentreprise'),
                        'email'=> request('emailentreprise'),
                        'password' => Hash::make($password),
                        'profil_id'=> $profil_id,
                        'nomuser'=> request('libelleentreprise'),
                        'prenomuser'=> null,
                        'teluser'=> request('telentreprise'),
                        'imageuser'=> $entreprise_logo,
                    ]);

                    $this->historique(request('libelleentreprise'), 'Ajout');

                    return redirect('entreprises')->with('message', 'Entreprise bien ajoutée.');
                }

                return back()->with('messagealert',"Cette entreprise existe déjà.");
         }
         else
         {
            //profil entreprise = chargé du suivi.
            return back()->with('messagealert', "Le profil Entreprise n'existe pas encore.");
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

     public function show(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
       try
        {
          return view('entreprises.show',compact('entreprise'));
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

     public function edit(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
          return view('entreprises.edit', compact('entreprise'));
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

     public function update(Entreprise $entreprise, Request  $request)
     {
        $this->authorize('ad_re_su', User::class);
       try
       {
          $this->validator();

          $entreprise_libelle = request('libelleentreprise');
          $entreprise_logo = null;

           if($request->file('logoentreprise'))
            {
                $file=$request->file('logoentreprise');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $request->logoentreprise->move('storage/entreprise/', $filename);

                $entreprise_logo = $filename;

                $entreprise->update([
                    'libelleentreprise'=> request('libelleentreprise'),
                    'emailentreprise'=> request('emailentreprise'),
                    'telentreprise'=> request('telentreprise'),
                    'adresseentreprise'=> request('adresseentreprise'),
                    'logoentreprise'=> $entreprise_logo,
                ]);
            }
            else
            {
                $entreprise->update([
                    'libelleentreprise'=> request('libelleentreprise'),
                    'emailentreprise'=> request('emailentreprise'),
                    'telentreprise'=> request('telentreprise'),
                    'adresseentreprise'=> request('adresseentreprise'),
                ]);
            }

          $this->historique(request('libelleentreprise'), 'Modification');

          return redirect('entreprises/' . $entreprise->id);
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

     public function destroy(Entreprise $entreprise)
     {
        $this->authorize('ad_re_su', User::class);
        try
        {
            if(Suivi::where('entreprise_id','=',$entreprise->id)->select('id')->exists())
            {
               return back()->with('messagealert',"Suppression pas possible. Cette Entreprise est référencée dans une autre table.");
            }
            else
            {
                $entreprise->delete();

                $this->historique($entreprise->libelleentreprise, 'Suppression');

                return redirect('entreprises')->with('messagealert','Suppression éffectuée');
            }
        }
          catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

     }

     private  function validator()
     {
         return request()->validate([
             'libelleentreprise'=>'required|min:2',
             'telentreprise',
             'emailentreprise'=>'required|email',
             'adresseentreprise',
             'logoentreprise'
         ]);
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Entreprise',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
