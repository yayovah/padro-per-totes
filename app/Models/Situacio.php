<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situacio extends Model
{
    protected $table = 'situacions';
    protected $fillable = ['pregunta','resposta','ciutat','seguent_pregunta','posicio' ];
}
