<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function accueil()
    {
        try
        {
            $users                    = DB::table('users')->count();
            $activites                = DB::table('activites')->count();
            $taches                   = DB::table('taches')->count();
            $fiche_positionnements    = DB::table('fiche_positionnements')->count();

            return view('dashboard',compact('users','activites','taches','fiche_positionnements'));
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function messagenewpassword()
    {
        return view('message.email');
    }

    public function emailerreur()
    {
        return view('emails.erreur');
    }

    public function pageerreur()
    {
        return view('message.erreurpage');
    }

    public function send_erreur_mail()
    {
        return view('message.erreurpage');
    }

    public function send_logo(String $logo, String $name)
    {
        if($logo){
            return view('auth.login', compact('logo','name'));
        }else {
             return redirect('index');
        }

    }

}
