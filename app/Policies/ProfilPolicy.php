<?php

namespace App\Policies;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfilPolicy
{
    use HandlesAuthorization;

    public function admin(User $user)
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Administrateur')->exists()){return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function responsable_pedagogique(User $user)
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Responsable pédagogique')->exists()){return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function charge_suivi(User $user)
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Chargé du suivi')->exists()){return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function dg_ifad(User $user)
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','DG_IFAD')->exists()){return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function suivi_aed(User $user)
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Suivi_AED')->exists()){return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function apprenant(User $user)
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Apprenant')->exists()){return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function ad_re_su(User $user)
    {
        //ad_re_su = administrateur,responsable et suivi aed;
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Administrateur')->exists() ||
               Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Responsable pédagogique')->exists() ||
               Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','suivi_aed')->exists())
           {return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    public function ad_re()
    {
        try
        {
            if(Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Administrateur')->exists() ||
               Profil::where('id',Auth::user()->profil_id)->where('libelleprofil','Responsable pédagogique')->exists())
           {return true;}
            return false;
        }
        catch(\Exception $exception)
        {
            return redirect('erreur')->with('messageerreur',$exception->getMessage());
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Profil $profil)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Profil $profil)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Profil $profil)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Profil $profil)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Profil $profil)
    {
        //
    }
}
