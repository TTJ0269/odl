<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeActivite extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     public function metier()
    {
        return $this->belongsTo('App\Models\Metier');
    }

      public function activites()
     {
         return $this->hasMany('App\Models\Activite');
     }
}
