<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciutat extends Model
{
    protected $fillable = ['nom','activada','provincia'];

    public function administradores(){
        return $this->hasMany(Permis::class, 'ciutat'); //Permis relaciona ciutats i usuaries que les administren
    }
    public function itineraris(){
        return $this->hasMany(Itinerari::class, 'ciutat');
    }
    public function situacions(){
        return $this->hasMany(Situacio::class, 'ciutat');
    }
}
