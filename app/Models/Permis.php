<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permis extends Model
{
    protected $table = 'permisos';
    protected $fillable = ['usuaria','ciutat'];
}
