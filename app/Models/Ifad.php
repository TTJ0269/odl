<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ifad extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

    public function classes()
     {
         return $this->hasMany('App\Models\Classe');
     }

     public function associations()
     {
         return $this->hasMany('App\Models\Association');
     }
}
