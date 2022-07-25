<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Models\Profil;
use App\Models\Ifad;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import_user_index()
    {
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
}
