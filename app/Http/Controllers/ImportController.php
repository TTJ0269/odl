<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Imports\ActiviteTacheImport;
use App\Imports\UserIfadImport;
use App\Models\Profil;
use App\Models\User;
use App\Models\Ifad;
use App\Models\GroupeActivite;
use App\Models\Association;
use App\Models\Activite;
use App\Models\Tache;
use App\Models\Metier;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Hash;

class ImportController extends Controller
{
    public function import_user_index()
    {
        $this->authorize('ad_su', User::class);
        try
        {
            if(Profil::where('libelleprofil','=','Apprenant')->select('id')->exists())
            {
                $ifads = Ifad::select('*')->get();

                return view('Import.user',compact('ifads'));
            }
            return back()->with('messagealert',"Le profil Apprenant n'existe pas encore.");
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function import_user_store(Request  $request)
    {
        $this->authorize('ad_su', User::class);
        try
        {
            /* $ifad_id = request('ifad_id');
            if($ifad_id == null)
            {
                return back()->with('messagealert','Sélectionner IFAD');
            }*/
            if($request->file == null)
            {
                return back()->with('messagealert','Sélectionner un fichier');
            }

            Excel::import(new UserImport, $request->file('file'));
            return back()->with('message','Importation éffectuée avec succées');
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function import_index()
    {
        $this->authorize('ad_su', User::class);
        try
        {
            if(Profil::where('libelleprofil','=','Apprenant')->select('id')->doesntExist())
            {
                return back()->with('messagealert',"Le profil Apprenant n'existe pas encore.");
            }
            elseif(GroupeActivite::select('id')->exists())
            {
                $groupe_activites = GroupeActivite::select('*')->get();
                $ifads = Ifad::select('*')->get();

                return view('Import.form',compact('groupe_activites','ifads'));
            }
            return back()->with('messagealert',"Ajouter au moins un groupe d'activité (Fonction) à un métier.");
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function import_user_ifad_store(Request  $request)
    {
        $this->authorize('ad_su', User::class);
        try
        {
            $profil = Profil::where('libelleprofil','=','Apprenant')->select('*')->first();
            $classe = request('classe_id');
            /*Session::put('classe',$classe);*/

            if($classe == null)
            {
                return back()->with('messagealert','Sélectionner une classe');
            }
            if($request->file == null)
            {
                return back()->with('messagealert','Sélectionner un fichier');
            }

            // Récupération du fichier Excel
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);

            // Récupération de la feuille active
            $worksheet = $spreadsheet->getActiveSheet();

            // Boucle sur les lignes et les colonnes pour récupérer les données
            $rows = $worksheet->toArray();

            //dd($rows);

            $i = 0;
            foreach($rows as $row)
            {
                $numero_matricule = $row['0'];
                $name = $row['1'];
                $nom = $row['2'];
                $prenom = $row['3'];
                $email = $row['4'];
                $telephone = $row['5'];

                if ($i != 0)
                {
                    if(User::where('email','=',$email)->select('id')->exists())
                    {
                        return back()->with('messagealert',"L'email existe déjà");
                    }

                    $user = User::create([
                        'numero_matricule' => $numero_matricule,
                        'name' => $name,
                        'nomuser' => $nom,
                        'prenomuser' => $prenom,
                        'email' => $email,
                        'password' => Hash::make($nom.'@'.now()->format('Y')),
                        'teluser' => $telephone,
                        'imageuser' => null,
                        'profil_id' => $profil->id,
                    ]);

                    if(Association::where('user_id','=',$user->id)->where('classe_id','=',(int)$classe)->select('*')->doesntExist())
                    {
                        /** Association d'un apprenant a un ifad **/
                        Association::create([
                            'user_id' => $user->id,
                            'classe_id'=> (int)$classe,
                            'datedebut'=> now(),
                            'datefin'=> null,
                        ]);
                    }
                }
                $i++;

            }

            /*Excel::import(new UserIfadImport, $request->file('file'));*/
            return back()->with('message','Importation éffectuée avec succées');
        }
        catch(\Exception $exception)
        {
            return back()->with('messageerreur',$exception->getMessage());
        }
    }

    public function import_activite_tache_store(Request  $request)
    {
        $this->authorize('ad_su', User::class);
        try
        {

            $groupe_activite = request('groupe_activite_id');
           /* Session::put('groupe_activite_id',$groupe_activite);*/

            //dd($groupe_activite);

            if($groupe_activite == null)
            {
                return back()->with('messagealert',"Sélectionner un groupe d'activité");
            }
            if($request->file == null)
            {
                return back()->with('messagealert','Sélectionner un fichier');
            }

            //$valeur = ['file' => $request->file , 'groupe_activite' => $groupe_activite];

            // Récupération du fichier Excel
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);

            // Récupération de la feuille active
            $worksheet = $spreadsheet->getActiveSheet();

            // Boucle sur les lignes et les colonnes pour récupérer les données
            $rows = $worksheet->toArray();

            //dd($rows);

            $i = 0;
            foreach($rows as $row)
            {
                $identifiantactivite = $row['0'];
                $libelleactivite = $row['1'];
                $identifianttache = $row['2'];
                $libelletache = $row['3'];


                /*if($identifiantactivite == 'identifiant activite' && $libelleactivite == 'activite' &&
                $identifianttache == 'identifiant tache' && $libelletache == 'tache'){
                }else{
                    return back()->with('messagealert',"L'en-tête du fichier Excel non respecté. Veuillez cliquez sur l'icône téléchargé pour voir l'en-tête du fichier Excel");
                }*/

                if ($i != 0)
                {
                    $data_activite = [
                        'identifiantactivite' => $identifiantactivite,
                        'libelleactivite' =>  $libelleactivite,
                        'groupe_activite_id' => (int)$groupe_activite,
                    ];

                    if($libelleactivite != null)
                    {
                        $activite = Activite::create($data_activite);
                    }

                    $data_tache = [
                        'identifianttache' => $identifianttache,
                        'libelletache' => $libelletache,
                        'activite_id' => $activite->id,
                    ];

                    if($libelletache != null)
                    {
                        $tache = Tache::create($data_tache);
                    }
                }
                $i++;

            }
            /*Excel::import(new ActiviteTacheImport, $request->file('file'));*/
            return back()->with('message','Importation éffectuée avec succées');

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function referentiel_user()
    {
       $this->authorize('ad_su', User::class);
       try
       {
          return response()->download('storage/fichier/reference_user.xlsx');
       }
       catch(\Exception $exception)
       {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
    }

    public function referentiel_metier()
    {
       $this->authorize('ad_su', User::class);
       try
       {
          return response()->download('storage/fichier/reference_activite_tache.xlsx');
       }
       catch(\Exception $exception)
       {
          return redirect('erreur')->with('messageerreur',$exception->getMessage());
       }
    }
}
