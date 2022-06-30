<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Preference;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    public function store()
    {
        try
        {
            if(Preference::where('user_id','=',Auth::user()->id)->select('id')->exists())
            {
                return back()->with('messagealert', 'Vous avez déjà des Péférences');
            }
            else
            {
                $preference = Preference::create([
                    'top'=> 'navbar-white',
                    'left'=> 'sidebar-dark-primary',
                    'center' => '',
                    'right'=> 'control-sidebar-dark',
                    'user_id' => Auth::user()->id,
                  ]);

                return back()->with('message', 'Péférence créée.');
            }

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function top()
    {
        try
        {
            //dd(request('preference_top'));
            $name = request('preference_top');
            $top = DB::table('preferences')->where('preferences.user_id','=',Auth::user()->id)->update(['preferences.top' => $name]);

            return back();

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function left()
    {
        try
        {
            //dd(request('preference_left'));
            $name = request('preference_left');
            $top = DB::table('preferences')->where('preferences.user_id','=',Auth::user()->id)->update(['preferences.left' => $name]);

            return back();
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function center()
    {
        try
        {
            //dd(request('preference_center'));
            $name = request('preference_center');
            $top = DB::table('preferences')->where('preferences.user_id','=',Auth::user()->id)->update(['preferences.center' => $name]);

            return back();

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function right()
    {
        try
        {
            //dd(request('preference_right'));
            $name = request('preference_right');
            $top = DB::table('preferences')->where('preferences.user_id','=',Auth::user()->id)->update(['preferences.right' => $name]);

            return back();

        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }
}
