<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     public function suivis()
     {
         return $this->hasMany('App\Models\Suivi');
     }

     public function appartenance()
     {
         return $this->hasMany('App\Models\Appartenance');
     }

}
