<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FormView;

class UserExport implements FromCollection,WithHeadings
{

    public function headings():array{
        return[
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'nomuser',
            'prenomuser',
            'teluser',
            'imageuser',
            'etat',
            'etatconnection',
            'etatsup',
            'remember_token',
            'created_at',
            'updated_at',
            'profil_id',

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
       // return collect(User::getUser());
    }

    /*public function view(): View
    {
         return view('users.index', compact(User::all()));
    }*/
}
