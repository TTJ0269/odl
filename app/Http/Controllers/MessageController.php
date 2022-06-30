<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
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

}
