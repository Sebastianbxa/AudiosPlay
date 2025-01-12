<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $fillable = ['autor'];

     public function audios(){
        return $this->hasMany(Audio::class, 'id');
    }
    
    /*
    public function audios(){
        return $this->belongsTo(Audio::class, 'id');
    }
    */
}
