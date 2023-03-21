<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportPhpSpreadsheetController extends Controller
{
    public function importExcel(Request $request) {
        // Récupération du fichier Excel
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);

        // Récupération de la feuille active
        $worksheet = $spreadsheet->getActiveSheet();

        // Boucle sur les lignes et les colonnes pour récupérer les données
        $rows = $worksheet->toArray();

        foreach($rows as $row)
        {
            $data_activite = [
                'identifiantactivite' => $row['identifiant_activite'],
                'libelleactivite' => $row['activite'],
                'groupe_activite_id' => (int)$groupe_activite_id,
            ];

            if($row['activite'] != null)
            {
              $acitivite = Activite::create($data_activite);
            }

            $data_tache = [
                'identifianttache' => $row['identifiant_tache'],
                'libelletache' => $row['tache'],
                'activite_id' => $acitivite->id,
            ];

            if($row['tache'] != null)
            {
              $tache = Tache::create($data_tache);
            }
        }
         /** code**/
        $this->authorize('ad_su', User::class);
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
        /** code**/
    }
}
