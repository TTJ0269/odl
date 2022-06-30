<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     //Pour recuperer les utilisateurs qui appartient à un profil
     public function user()
     {
         return $this->hasMany('App\Models\User');
     }
}
