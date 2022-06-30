<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

     //Pour recuperer les competences
     public function competence()
     {
         return $this->belongsTo('App\Models\Competence');
     }

     public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }
}
