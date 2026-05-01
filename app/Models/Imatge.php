<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imatge extends Model
{
    protected $fillable = ['id','path'];

    public function preguntesAmbImatge(){
        return $this->hasMany(Pregunta::class, 'imatge'); 
    }
}
