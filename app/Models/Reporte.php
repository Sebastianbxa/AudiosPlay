<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    public function audios(){
        return $this->belongsTo(Audio::class, 'audiolibro_id');
    }
}
