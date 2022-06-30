<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profil_id',
        'nomuser',
        'prenomuser',
        'teluser',
        'imageuser',
        'etat',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes=['etat'=> 1,'etatsup'=> 0,'etatconnection'=> 0];

    public function profil()
    {
        return $this->belongsTo('App\Models\Profil');
    }

    public function associations()
     {
         return $this->hasMany('App\Models\associations');
     }

     public function suivis()
     {
         return $this->hasMany('App\Models\Suivi');
     }

     public function preference()
     {
         return $this->hasMany('App\Models\Preference');
     }
}
