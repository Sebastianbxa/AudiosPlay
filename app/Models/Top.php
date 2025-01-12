<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Top extends Model
{
    use HasFactory;
    protected $fillable = ['audiolibros_id' , 'posicion'];
    public function audios(){
        return $this->belongsTo(Audio::class, 'audiolibros_id');
    }
}
