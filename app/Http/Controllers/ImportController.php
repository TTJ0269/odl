<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Imports\ActiviteTacheImport;
use App\Imports\UserIfadImport;
use App\Models\Profil;
use App\Models\User;
use App\Models\Ifad;
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
            elseif(Metier::select('id')->exists())
            {
                $metiers = Metier::select('*')->get();
                $ifads = Ifad::select('*')->get();

                return view('Import.form',compact('metiers','ifads'));
            }
            return back()->with('messagealert',"Ajouter au moins un métier.");
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
            $metier = request('metier_id');
            Session::put('metier_id',$metier);

            if($metier == null)
            {
                return back()->with('messagealert','Sélectionner un métier');
            }
            if($request->file == null)
            {
                return back()->with('messagealert','Sélectionner un fichier');
            }

            //$valeur = ['file' => $request->file , 'metier' => $metier];

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
