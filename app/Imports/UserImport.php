<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\Ifad;

class UserImport implements ToCollection ,WithHeadingRow, WithValidation //ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*public function model(array $row)
    {
        $profil = Profil::where('libelleprofil','=','Apprenant')->select('*')->first();

        return new User([
            'name' => 'dkkdk',
            'nomuser' => $row['nomuser'],
            'prenomuser' => $row['prenomuser'],
            'email' => $row['email'],
            'password' => Hash::make(135792468),
            'teluser' => null,
            'imageuser' => null,
            'etat' => 1,
            'etatconnection' => 0,
            'etatsup' => 0,
            'profil_id' => $profil->id,
        ]);
    }*/

    public function collection(Collection $rows)
    {
        $profil = Profil::where('libelleprofil','=','Apprenant')->select('*')->first();

        foreach($rows as $row)
        {
            $data = [
                'name' => $row['name'],
                'nomuser' => $row['nom'],
                'prenomuser' => $row['prenom'],
                'email' => $row['email'],
                'password' => Hash::make($row['nom'].'@'.now()->format('Y')),
                'teluser' => null,
                'imageuser' => null,
                'profil_id' => $profil->id,
            ];

            User::create($data);
        }
    }

    public function rules(): array
    {
        return [
            'name'=>'required|unique:users',
            'nom'=>'required',
            'prenom'=>'required',
        ];
    }
}
