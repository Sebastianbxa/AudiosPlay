<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;
    protected $fillable = ['genero'];
    public function generos(){
        return $this->hasMany(Audio::class, 'id');
    }
}
