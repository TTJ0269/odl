<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllUserController extends Controller
{
    public function index()
    {
        try
        {
           return view('all_users.index');
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }
}
