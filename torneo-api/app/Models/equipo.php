<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function jugadores(){
        return $this->hasMany(jugador::class, 'id_equipo', 'id');
    }
}
