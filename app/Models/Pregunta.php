<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntes';
    protected $fillable = ['text','imatge'];

    public function passos(){
        return $this->hasMany(Pas::class, 'pregunta');
    }
    public function situacions(){
        return $this->hasMany(Situacio::class, 'pregunta');
    }
    public function situacionsSeguent(){
        return $this->hasMany(Situacio::class, 'seguent_pregunta');
    }
}
