<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jugador extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'jugadores';

    public function equipo(){
        return $this->belongsTo(equipo::class, 'id_equipo', 'id');
    }
}
