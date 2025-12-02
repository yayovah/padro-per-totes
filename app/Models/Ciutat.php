<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciutat extends Model
{
    protected $fillable = ['nom','activada','provincia'];

    public function usuariesAdministradores()
    {
        return $this->hasMany(Permis::class, 'usuaria'); //Permis relaciona ciutats i usuaries que les administren
    }
}
