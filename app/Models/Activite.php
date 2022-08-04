<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     //Pour recuperer les activites qui appartient à une activite
     public function taches()
     {
         return $this->hasMany('App\Models\Tache');
     }

     public function groupe_activite()
    {
        return $this->belongsTo('App\Models\GroupeActivite');
    }
}
