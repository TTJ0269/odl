<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\User;
use App\Models\Positionnement;
use App\Models\FichePositionnement;
use App\Models\Competence;
use App\Models\Activite;
use App\Models\Classe;
use App\Models\Ifad;

class FicheLongueController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');//->except(['index'])
    }

    public function index()
    {
      try
      {
        $user_id = (Auth::user()->id);
        $profil = (Auth::user()->profil_id);

        $classes = Classe::select('*')->get();

        return view('fiche_longue.index',compact('classes'));

      }
      catch(\Exception $exception)
      {
        return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
    }

    public function create()
    {
        try
        {
            $classe_id = request('classe_id');

            if($classe_id == null)
            {
                return back()->with('messagealert', "Sélectionner une classe.");
            }
            else
            {
                $classe = Classe::select('*')->where('id','=',$classe_id)->first();

                if(DB::table('associations')->where('associations.ifad_id','=',$classe->ifad_id)
                         ->where('associations.user_id','=',Auth::user()->id)->select('associations.id')->doesntExist())
                {
                    return back()->with('messagealert', "Vous n'est pas associé à un IFAD ou Vous n'avez pas les accès nécessaires pour la classe sélectionnée.");
                }
                elseif(Activite::select('*')->where('classe_id','=',$classe_id)->doesntExist())
                {
                   return back()->with('messagealert', "Aucune activité trouvée pour cette classe.");
                }
                else
                {
                        // dd($classe_id, $user_id);

                        $positionnement = new Positionnement();

                        /** selection des activites classes par competences **/
                        $competences = DB::table('competences')
                        ->join('activites','competences.id','=','activites.competence_id')
                        ->select('competences.*')->where('activites.classe_id','=',$classe_id)
                        ->orderBy('competences.id')->distinct('competences.id')->get();

                        $i = 0;
                        foreach($competences as $competence)
                        {
                            $tab_competence_id[$i] = $competence->id;
                            $tab_competence_libelle[$i] = $competence->libellecompetence;


                            $tab_activite[$i] = DB::table('competences')
                            ->join('activites','competences.id','=','activites.competence_id')
                            ->select('competences.id','activites.id','activites.libelleactivite')
                            ->where('competences.id','=',$tab_competence_id[$i])
                            ->where('activites.classe_id','=',$classe_id)
                            ->orderBy('competences.id')
                            ->distinct('competences.id')
                            ->get();

                            $collections[$i] = collect([$tab_competence_id[$i],$tab_competence_libelle[$i],$tab_activite[$i]])->all();

                            $i++;
                        }

                        return view('fiche_longue.create',compact('collections','classe_id'));

                }
            }


        }

        catch(\Exception $exception)
        {
           return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function store()
    {
      try
      {
            $nom_entreprise = request('nom_entreprise');
            $tel_entreprise = request('tel_entreprise');
            $mail_entreprise = request('mail_entreprise');
            $nom_tuteur = request('nom_tuteur');
            $prenom_tuteur = request('prenom_tuteur');
            $tel_tuteur = request('tel_tuteur');
            $nom_apprenant = request('nom_apprenant');
            $prenom_apprenant = request('prenom_apprenant');
            $classe_id = request('classe_id');

            //dd($nom_entreprise, $tel_entreprise, $mail_entreprise, $nom_tuteur, $prenom_tuteur, $tel_tuteur, $nom_apprenant, $prenom_apprenant, $classe_id);

            $classe = Classe::select('*')->where('id','=',$classe_id)->first();

            $association = DB::table('associations')
            ->where('associations.ifad_id','=',$classe->ifad_id)
            ->where('associations.user_id','=',Auth::user()->id)
            ->select('associations.id')->get()->last();


             $fiche_positionnement = "Fiche de positionnement du ".now()->format('d-m-Y')." de ".$nom_apprenant." ".$prenom_apprenant;

           /** Enregistrement du livret de positionnement et recuperation de id **/
            $fiche = FichePositionnement::insertGetId([
             'libellefiche'=> $fiche_positionnement,
             'nom_entreprise'=> $nom_entreprise,
             'tel_entreprise'=> $tel_entreprise,
             'mail_entreprise'=> $mail_entreprise,
             'nom_tuteur'=> $nom_tuteur,
             'prenom_tuteur'=> $prenom_tuteur,
             'tel_tuteur'=> $tel_tuteur,
             'nom_apprenant'=> $nom_apprenant,
             'prenom_apprenant'=> $prenom_apprenant,
             'classe_id'=> $classe_id,
             'responsable_suivi_id'=> Auth::user()->id,
             'association_id'=> $association->id,
             'dateenregistrement'=> now(),
             'etatsup'=> 0]);

            /** Recuperation des valeurs **/
             $activite_values = DB::table('activites')->select('id')->where('classe_id','=',$classe_id)->get();
             $i = 1;
             foreach($activite_values as $activite_value)
             {
               $value[$i]= request('valeurpost_'.$activite_value->id);
               /** enregistrement des positionnements **/
               $positionnement = Positionnement::create([
                 'valeurpost'=> $value[$i],
                 'fiche_positionnement_id'=> $fiche,
                 'activite_id'=> $activite_value->id,]);
                 $i++;
             }

             return redirect('fiche_positionnements-apprenant/'.$fiche)->with('message', "Fiche de positionnement bien enregistrée.");

      }
      catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
    }


    public function fiche_index()
    {
       try
       {
           $user_id = (Auth::user()->id);
           $profil_id = (Auth::user()->profil_id);

           $profil_libelle = Profil::where('id','=',$profil_id)->select('*')->first()->libelleprofil;

           if($profil_libelle == 'Administrateur' || $profil_libelle == 'Responsable pédagogique' || $profil_libelle == 'Suivi_AED')
           {
            $fiche_positionnements = FichePositionnement::select('*')->orderBy('id','DESC')->get();

            return view('fiche_longue.fiche_index', compact('fiche_positionnements'));
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
                    ->select('fiche_positionnements.*','ifads.libelleifad')
                    ->orderBy('fiche_positionnements.id','DESC')
                    ->get();

                    return view('fiche_longue.fiche_index', compact('fiche_positionnements'));
                }
           }

       }
       catch(\Exception $exception)
      {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
      }
    }

    public function show(FichePositionnement $fiche_positionnement)
     {
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            /** selection des activites classes par competences **/
            $competences = DB::table('competences')
            ->join('activites','competences.id','=','activites.competence_id')
            ->join('positionnements','activites.id','=','positionnements.activite_id')
            ->select('competences.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('competences.id')->distinct('competences.id')->get();

            $i = 1;
            foreach($competences as $competence)
            {
            $tab_competence_id[$i]= $competence->id;
            $tab_competence_libelle[$i]= $competence->libellecompetence;

            $tab_activite[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('activites','activites.id','=','positionnements.activite_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('activites.competence_id','=',$tab_competence_id[$i])
            ->select('positionnements.*','activites.libelleactivite')
            ->orderBy('activites.id')
            ->get();

            $collections[$i] = collect([$tab_competence_id[$i],$tab_competence_libelle[$i],$tab_activite[$i]])->all();

            $i++;
            }

            return view('fiche_longue.show', compact('collections','fiche_positionnement'));


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
        try
        {
            $user_id = (Auth::user()->id);
            $profil_id = (Auth::user()->profil_id);

            /** selection des activites classes par competences **/
            $competences = DB::table('competences')
            ->join('activites','competences.id','=','activites.competence_id')
            ->join('positionnements','activites.id','=','positionnements.activite_id')
            ->select('competences.*')->where('positionnements.fiche_positionnement_id','=',$fiche_positionnement->id)
            ->orderBy('competences.id')->distinct('competences.id')->get();

            $i = 1;
            foreach($competences as $competence)
            {
            $tab_competence_id[$i]= $competence->id;
            $tab_competence_libelle[$i]= $competence->libellecompetence;

            $tab_activite[$i] = DB::table('fiche_positionnements')
            ->join('positionnements','fiche_positionnements.id','=','positionnements.fiche_positionnement_id')
            ->join('activites','activites.id','=','positionnements.activite_id')
            ->where('fiche_positionnements.id','=',$fiche_positionnement->id)
            ->where('activites.competence_id','=',$tab_competence_id[$i])
            ->select('positionnements.*','activites.libelleactivite')
            ->orderBy('activites.id')
            ->get();

            $collections[$i] = collect([$tab_competence_id[$i],$tab_competence_libelle[$i],$tab_activite[$i]])->all();

            $i++;
            }

            return view('fiche_longue.edit', compact('collections','fiche_positionnement'));


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
         try
         {
             $classe = request('classe');
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

                return redirect('fiche_positionnements-apprenant/'.$fiche_positionnement->id)->with('message', "Fiche de positionnement bien mise à jour");
            }
            catch(\Exception $exception)
           {
               return redirect('erreur')->with('messageerreur',$exception->getMessage());
           }
     }
}
