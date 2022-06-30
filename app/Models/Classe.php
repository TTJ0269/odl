<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     //Pour recuperer les activites
     public function activites()
     {
         return $this->hasMany('App\Models\Activite');
     }

     public function ifad()
    {
        return $this->belongsTo('App\Models\Ifad');
    }
}
