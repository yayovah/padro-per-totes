<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situacio extends Model
{
    protected $table = 'situacions';
    protected $fillable = ['pregunta','resposta','ciutat','seguent_pregunta','posicio' ];

    public function ciutat(){
        return $this->belongsTo(Ciutat::class, 'ciutat'); //Cada permís es relaciona amb només una ciutat
    }
    public function pregunta(){
        return $this->belongsTo(Pregunta::class, 'pregunta'); //Cada itinerari es relaciona amb només una ciutat
    }
    public function resposta(){
        return $this->belongsTo(Resposta::class, 'resposta'); //Cada itinerari es relaciona amb només una ciutat
    }
    public function seguentPregunta(){
        return $this->belongsTo(Pregunta::class, 'seguent_pregunta'); //Cada itinerari es relaciona amb només una ciutat
    }    
}
