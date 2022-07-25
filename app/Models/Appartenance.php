<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartenance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function entreprise()
    {
        return $this->belongsTo('App\Models\Entreprise');
    }
}
