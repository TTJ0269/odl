<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AideController extends Controller
{
    public function index()
    {
        return view('aides.index');
    }

    public function guide_utilisation_docx()
    {
       try
       {
          return response()->download('storage/fichier/guide_utilisation.docx');
       }
       catch(\Exception $exception)
       {
          return 'Erreur du téléchargement';
       }
    }

    public function guide_utilisation_pdf()
    {
       try
       {
          return response()->download('storage/fichier/guide_utilisation.pdf');
       }
       catch(\Exception $exception)
       {
          return 'Erreur du téléchargement';
       }
    }
}
