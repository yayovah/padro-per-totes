<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $table = 'respostes';
    protected $fillable = ['titol','descripcio'];

    public function passos(){
        return $this->hasMany(Pas::class, 'resposta');
    }
    public function situacions(){
        return $this->hasMany(Situacio::class, 'resposta');
    }
}
