<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeActivite extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     public function filiere()
    {
        return $this->belongsTo('App\Models\Filiere');
    }

      public function activites()
     {
         return $this->hasMany('App\Models\Activite');
     }
}
