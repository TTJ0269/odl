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
use App\Models\Metier;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    public function import_user_index()
    {
        $this->authorize('ad_re_su', User::class);
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
        $this->authorize('ad_re_su', User::class);
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
        $this->authorize('ad_re_su', User::class);
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
            return back()->with('messagealert',"Ajouter au moins un groupe d'activité à un métier.");
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function import_user_ifad_store(Request  $request)
    {
        $this->authorize('ad_re_su', User::class);
        try
        {
            $ifad = request('ifad_id');
            Session::put('ifad',$ifad);

            if($ifad == null)
            {
                return back()->with('messagealert','Sélectionner un IFAD');
            }
            if($request->file == null)
            {
                return back()->with('messagealert','Sélectionner un fichier');
            }

            Excel::import(new UserIfadImport, $request->file('file'));
            return back()->with('message','Importation éffectuée avec succées');
        }
        catch(\Exception $exception)
        {
            return back()->with('messageerreur',$exception->getMessage());
        }
    }

    public function import_activite_tache_store(Request  $request)
    {
        $this->authorize('ad_re_su', User::class);
        try
        {

            $groupe_activite = request('groupe_activite_id');
            Session::put('groupe_activite_id',$groupe_activite);

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

            Excel::import(new ActiviteTacheImport, $request->file('file'));
            return back()->with('message','Importation éffectuée avec succées');
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function referentiel_user()
    {
       $this->authorize('ad_re_su', User::class);
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
       $this->authorize('ad_re_su', User::class);
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
