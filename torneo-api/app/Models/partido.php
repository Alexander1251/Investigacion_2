<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partido extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function equipo1(){
        return $this->belongsTo(equipo::class, 'id_equipo1', 'id');
    }

    public function equipo2(){
        return $this->belongsTo(equipo::class, 'id_equipo2', 'id');
    }

    public function estado(){
        return $this->belongsTo(partido_estado::class, 'id_estado', 'id');
    }
}

