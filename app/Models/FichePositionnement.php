<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichePositionnement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etat'=> 0,'etatsup'=> 0];


     public function association()
    {
        return $this->belongsTo('App\Models\Association');
    }
}
