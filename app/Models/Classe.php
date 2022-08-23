<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     //Pour recuperer les activites qui appartient à une activite
     public function association()
     {
         return $this->hasMany('App\Models\Association');
     }

     public function metier()
    {
        return $this->belongsTo('App\Models\Metier');
    }
}
