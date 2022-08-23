<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rattacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes=['etatsup'=> 0];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function metier()
    {
        return $this->belongsTo('App\Models\Metier');
    }

    public function ifad()
    {
        return $this->belongsTo('App\Models\Ifad');
    }
}
