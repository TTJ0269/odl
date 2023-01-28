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
        // ...
    }
}
