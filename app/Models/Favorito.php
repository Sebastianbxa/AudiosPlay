<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;
    protected $table = 'favoritos';
    protected $fillable = ['audiolibro_id',  'user_id'];

    public function audios(){
        return $this->belongsTo(Audio::class, 'audiolibro_id');
    }
}
