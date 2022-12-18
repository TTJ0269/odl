<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

    public function classe()
    {
        return $this->hasMany('App\Models\Classe');
    }
}
