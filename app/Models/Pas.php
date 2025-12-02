<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pas extends Model
{
    protected $table = 'pasos';
    protected $fillable = ['itinerari','pregunta','resposta'];
}
