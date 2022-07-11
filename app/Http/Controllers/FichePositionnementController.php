<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FichePositionnement;
use App\Models\Positionnement;
use App\Models\Classe;
use App\Models\Profil;
use App\Models\User;
use App\Models\Association;
use App\Models\Entreprise;
use App\Models\Historique;

class FichePositionnementController extends Controller
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
     // Afficher les fiches de positionnment
     public function index()
     {
      try
       {
          $user_id = (Auth::user()->id);
          $profil_id = (Auth::user()->profil_id);

          $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

           if($profil_libelle == 'Administrateur' || $profil_libelle == 'Responsable pédagogique' || $profil_libelle == 'Suivi_AED')
           {
                $fiche_positionnements = DB::table('users')
                ->join('associations','users.id','=','associations.user_id')
                ->join('ifads','ifads.id','=','associations.ifad_id')
                ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
                ->select('fiche_positionnements.*','ifads.libelleifad')
                ->distinct('fiche_positionnements.id')
                ->orderBy('fiche_positionnements.id','DESC')
                ->get();

                return view('fiche_positionnements.index', compact('fiche_positionnements'));
           }
           elseif($profil_libelle == 'Chargé du suivi')
           {
                $fiche_positionnements = DB::table('users')
                ->join('associations','users.id','=','associations.user_id')
                ->join('ifads','ifads.id','=','associations.ifad_id')
                ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
                ->where('fiche_positionnements.responsable_suivi_id','=',$user_id)
                ->select('fiche_positionnements.*','ifads.libelleifad')
                ->distinct('fiche_positionnements.id')
                ->orderBy('fiche_positionnements.id','DESC')
                ->get();

                return view('fiche_positionnements.index', compact('fiche_positionnements'));
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

                    $fiche_positionnements = DB::table('users')
                    ->join('associations','users.id','=','associations.user_id')
                    ->join('ifads','ifads.id','=','associations.ifad_id')
                    ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
                    ->where('associations.ifad_id','=',$ifad_id)
                    ->select('fiche_positionnements.*','ifads.libelleifad')
                    ->distinct('fiche_positionnements.id')
                    ->orderBy('fiche_positionnements.id','DESC')
                    ->get();

                    return view('fiche_positionnements.index', compact('fiche_positionnements'));
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
                    $ifad_id = DB::table('associations')->where('associations.user_id','=',Auth::user()->id)
                    ->select('ifad_id')->get()->last()->ifad_id;

                    $fiche_positionnements = DB::table('users')
                    ->join('associations','users.id','=','associations.user_id')
                    ->join('ifads','ifads.id','=','associations.ifad_id')
                    ->join('fiche_positionnements','associations.id','=','fiche_positionnements.association_id')
                    ->where('associations.ifad_id','=',$ifad_id)
                    ->where('associations.user_id','=',Auth::user()->id)
                    ->select('fiche_positionnements.*','ifads.libelleifad')
                    ->distinct('fiche_positionnements.id')
                    ->orderBy('fiche_positionnements.id','DESC')
                    ->get();

                    return view('fiche_positionnements.index', compact('fiche_positionnements'));
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

     public function create()
     {

     }

       /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */

     public function store()
     {

     }

     // return redirect('rapports')->with('message', 'Rapport bien ajoutée.');
      /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     public function show(FichePositionnement $fiche_positionnement)
     {
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;
            if($profil_libelle == 'Apprenant')
            {
                if(Association::where('user_id','=',Auth::user()->id)->select()->exists())
                {
                    $association = Association::where('user_id','=',Auth::user()->id)->select('*')->first();
                    if($fiche_positionnement->association_id != $association->id)
                    {
                      return back()->with('messagealert',"Pas de droit nécessaire");
                    }
                }
            }

            /** selection des activites classes par activites **/
            $activites = DB::table('activites')
            ->join('taches','activites.id','=','taches.activite_id')
            ->join('positionnements','taches.id','=','positionnements.tache_id')
            ->select('activites.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('activites.id')->distinct('activites.id')->get();

            $i = 1;
            foreach($activites as $activite)
            {
            $tab_activite_id[$i]= $activite->id;
            $tab_activite_libelle[$i]= $activite->libelleactivite;

            $tab_tache[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('taches','taches.id','=','positionnements.tache_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('taches.activite_id','=',$tab_activite_id[$i])
            ->select('positionnements.*','taches.libelletache')
            ->orderBy('taches.id')
            ->get();

            $collections[$i] = collect(['activite_id' => $tab_activite_id[$i],'activite_libelle' => $tab_activite_libelle[$i], 'taches' => $tab_tache[$i]])->all();

            $i++;
            }

            return view('fiche_positionnements.show', compact('collections','fiche_positionnement'));


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

     public function edit(FichePositionnement $fiche_positionnement)
     {
        $this->authorize('ad_re_su_ch', User::class);
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            /** selection des activites classes par activites **/
            $activites = DB::table('activites')
            ->join('taches','activites.id','=','taches.activite_id')
            ->join('positionnements','taches.id','=','positionnements.tache_id')
            ->select('activites.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('activites.id')->distinct('activites.id')->get();

            $i = 1;
            foreach($activites as $activite)
            {
            $tab_activite_id[$i]= $activite->id;
            $tab_activite_libelle[$i]= $activite->libelleactivite;

            $tab_tache[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('taches','taches.id','=','positionnements.tache_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('taches.activite_id','=',$tab_activite_id[$i])
            ->select('positionnements.*','taches.libelletache')
            ->orderBy('taches.id')
            ->get();

            $collections[$i] = collect(['activite_id' => $tab_activite_id[$i],'activite_libelle' => $tab_activite_libelle[$i], 'taches' => $tab_tache[$i]])->all();

            $i++;
            }

            return view('fiche_positionnements.edit', compact('collections','fiche_positionnement'));


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

     public function update(FichePositionnement $fiche_positionnement)
     {
        $this->authorize('ad_re_su_ch', User::class);
         try
         {
            /** Recuperation des valeurs **/
            $positionnement_values = Positionnement::where('fiche_positionnement_id','=',$fiche_positionnement->id)->select('*')->get();
            $i = 1;
            foreach($positionnement_values as $positionnement_value)
            {
                $value[$i]= request('positionnement_'.$positionnement_value->id);
                /** Actualisation des positionnements **/
                $positionnements = DB::table('positionnements')
                                        ->where('positionnements.id','=',$positionnement_value->id)
                                        ->update(['positionnements.ValeurPost' => $value[$i]]);
                    $i++;
            }

                $this->historique($fiche_positionnement->libellefiche, 'Modification');

                return redirect('fiche_positionnements/show/'.$fiche_positionnement->id)->with('message', "Fiche de positionnement bien mise à jour");
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

     public function destroy(FichePositionnement $fiche_positionnement)
     {
        $this->authorize('admin', User::class);

         $fiche_positionnement->delete();

         return redirect('fiche_positionnements');
     }

     private function historique($attribute, $action)
    {
        $auth_user = (Auth::user()->nomuser). ' ' .(Auth::user()->prenomuser);

        /** historiques des actions sur le systeme **/
        $historique = Historique::create([
        'user_action'=> $auth_user,
        'table'=> 'Fiche de positionnement',
        'attribute' => $attribute,
        'action'=> $action
        ]);
    }
}
