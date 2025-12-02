<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permis extends Model
{
    protected $table = 'permisos';
    protected $fillable = ['usuaria','ciutat'];

    public function user(){
        return $this->belongsTo(User::class, 'usuaria'); //Cada permís es relaciona amb només una una usuària
    }

    public function ciutat(){
        return $this->belongsTo(Ciutat::class, 'ciutat'); //Cada permís es relaciona amb només una ciutat
    }
}
