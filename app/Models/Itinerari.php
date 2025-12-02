<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerari extends Model
{
    protected $fillable = ['ciutat','usuaria'];

    public function user(){
        return $this->belongsTo(User::class, 'usuaria'); //Cada itinerari es relaciona amb només un user
    }
    public function ciutat(){
        return $this->belongsTo(Ciutat::class, 'ciutat'); //Cada itinerari es relaciona amb només una ciutat
    }

    public function passos(){
        return $this->hasMany(Pas::class, 'itinerari');
    }
}
