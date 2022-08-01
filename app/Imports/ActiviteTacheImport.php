<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\Metier;
use App\Models\Activite;
use App\Models\Tache;
//use Session;

class ActiviteTacheImport implements ToCollection, WithHeadingRow //, WithValidation //ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*public function model(array $row)
    {
        return new Acitivite([
            //
        ]);
    }*/

    public function collection(Collection $rows)
    {
        //$profil = Profil::where('libelleprofil','=','Apprenant')->select('*')->first();

         $metier_id = Session::get('metier_id');
         Session::forget('metier_id');

        foreach($rows as $row)
        {
            $data_activite = [
                'identifiantactivite' => $row['identifiant_activite'],
                'libelleactivite' => $row['activite'],
                'metier_id' => (int)$metier_id,
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

            $tache = Tache::create($data_tache);
        }
    }

   /* public function rules(): array
    {
        return [
            'libelleactivite'=>'unique:activites',
            'libelletache'=>'required|unique:taches',
            'activite_id' => 'required',
        ];
    }*/
}
