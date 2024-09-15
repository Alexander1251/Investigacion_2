<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resultado extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function partido(){
        return $this->belongsTo(partido::class, 'id_partido', 'id');
    }

    public function vencedor(){
        return $this->belongsTo(equipo::class, 'ganador', 'id');
    }
}
