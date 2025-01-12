<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendado extends Model
{
    use HasFactory;

    public function audios(){
        return $this->belongsTo(Audio::class, 'recomendado_id');
    }
}
