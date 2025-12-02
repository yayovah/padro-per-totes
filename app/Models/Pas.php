<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pas extends Model
{
    protected $table = 'pasos';
    protected $fillable = ['itinerari','pregunta','resposta'];
    
    public function itinerari(){
        return $this->belongsTo(Itinerari::class, 'itinerari'); //Cada itinerari es relaciona amb només una ciutat
    }
    public function pregunta(){
        return $this->belongsTo(Pregunta::class, 'pregunta'); //Cada itinerari es relaciona amb només una ciutat
    }
    public function resposta(){
        return $this->belongsTo(Resposta::class, 'resposta'); //Cada itinerari es relaciona amb només una ciutat
    }
}
