<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

    public function groupeactivites()
     {
         return $this->hasMany('App\Models\GroupeActivite');
     }

     public function metier()
    {
        return $this->belongsTo('App\Models\Metier');
    }
}
