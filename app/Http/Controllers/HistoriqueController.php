<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Historique;
use App\Models\User;

class HistoriqueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('admin', User::class);
        try
        {
            $historiques = Historique::select('*')->orderBy('id','DESC')->get();

            return view('historiques.index', compact('historiques'));
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }

    }
}
