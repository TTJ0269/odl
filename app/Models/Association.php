<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ifad()
    {
        return $this->belongsTo('App\Models\Ifad');
    }

     public function fiche_positionnements()
     {
         return $this->hasMany('App\Models\FichePositionnement');
     }

     public function observations()
     {
         return $this->hasMany('App\Models\Observation');
     }

}
