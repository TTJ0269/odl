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
use App\Models\Ifad;
use App\Models\Association;

class UserIfadImport implements ToCollection ,WithHeadingRow, WithValidation //ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        $profil = Profil::where('libelleprofil','=','Apprenant')->select('*')->first();

        $classe_id = Session::get('classe');
        Session::forget('classe');

        foreach($rows as $row)
        {
            $data = [
                //'numero_matricule' => $row['numero_matricule'],
                'name' => $row['name'],
                'nomuser' => $row['nom'],
                'prenomuser' => $row['prenom'],
                'email' => $row['email'],
                'password' => Hash::make($row['nom'].'@'.now()->format('Y')),
                'teluser' => null,
                'imageuser' => null,
                'profil_id' => $profil->id,
            ];

            $user = User::create($data);

            if(Association::where('user_id','=',$user->id)->where('classe_id','=',$classe_id)->select('*')->doesntExist())
            {
                /** Association d'un apprenant a un ifad **/
                Association::create([
                    'user_id' => $user->id,
                    'classe_id'=> (int)$classe_id,
                    'datedebut'=> now(),
                    'datefin'=> null,
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            //'numero_matricule'=>'required|unique:users',
            'name'=>'required|unique:users',
            'nom'=>'required',
            'prenom'=>'required',
        ];
    }
}
