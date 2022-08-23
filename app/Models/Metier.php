<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metier extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     public function ifad()
    {
        return $this->belongsTo('App\Models\Ifad');
    }

    public function groupeactivites()
     {
         return $this->hasMany('App\Models\GroupeActivite');
     }

     public function classes()
     {
         return $this->hasMany('App\Models\Classe');
     }

     public function rattachers()
     {
         return $this->hasMany('App\Models\Rattacher');
     }
}
