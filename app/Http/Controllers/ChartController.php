<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ChartController extends Controller
{

    public function first()
    {
        DB::table('profils')->insert([
            'libelleprofil' => 'Administrateur',
            'etatsup' => 0,
        ]);

        DB::table('profils')->insert([
            'libelleprofil' => 'Responsable pédagogique',
            'etatsup' => 0,
        ]);

        DB::table('profils')->insert([
            'libelleprofil' => 'Chargé du suivi',
            'etatsup' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'tognijoel10@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make(123456789),
            'created_at' => now(),
            'updated_at' => now(),

            'nomuser' => 'TOGNI',
            'prenomuser' => 'Joel',
            'teluser' => 90785263,
            'imageuser' => null,
            'profil_id' => 1,
            'etat' => 1,
            'etatconnection' => 1,
            'etatsup' => 0,
        ]);

        /*DB::table('users')->insert([
            'name' => 'Suivi AQUACULTURE',
            'email' => 'suivi-aquaculture@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('suivi@aquaculture154'),
            'created_at' => now(),
            'updated_at' => now(),

            'nomuser' => 'Suivi IFAD-AQUACULTURE',
            'prenomuser' => null,
            'teluser' => null,
            'imageuser' => null,
            'profil_id' => 3,
            'etat' => 1,
            'etatconnection' => 1,
            'etatsup' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Suivi BATIMENT',
            'email' => 'suivi-batiment@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('suivi@batiment273'),
            'created_at' => now(),
            'updated_at' => now(),

            'nomuser' => 'Suivi IFAD-BATIMENT',
            'prenomuser' => null,
            'teluser' => null,
            'imageuser' => null,
            'profil_id' => 3,
            'etat' => 1,
            'etatconnection' => 1,
            'etatsup' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Suivi ELEVAGE',
            'email' => 'suivi-elevage@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('suivi@elevage349'),
            'created_at' => now(),
            'updated_at' => now(),

            'nomuser' => 'Suivi IFAD-ELEVAGE',
            'prenomuser' => null,
            'teluser' => null,
            'imageuser' => null,
            'profil_id' => 3,
            'etat' => 1,
            'etatconnection' => 1,
            'etatsup' => 0,
        ]);*/
    }


    public function pie()
    {

        $chart = LarapexChart::radarChart()
        ->setTitle('Individual Player Stats.')
        ->setSubtitle('Season 2021.')
        ->addData('Stats', [70, 93, 78, 97, 50, 120])
        ->setXAxis(['Passj', 'Dribkwkw ', 'ShotDomwl', 'Stamina', 'Long shots', 'Tactica'])
        ->setMarkers(['#ff6384','#303F9F'], 12, 16)
        ->setColors(['#FFC107'])
        ->setFontColor('#303F9F');

        return view('chart.pie', compact('chart'));

    }

   /* public function redirection()
    {
        if(Auth::user()->profil_id == 1)
         return view('dashboard');
        else
        return redirect()->route('activites.index');
    }*/
}
