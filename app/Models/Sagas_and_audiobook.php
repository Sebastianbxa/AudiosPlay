<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sagas_and_audiobook extends Model
{
    use HasFactory;
    protected $fillable = ['audiolibros_id',  'sagas_id'];
    public function audios(){
        return $this->belongsTo(Audio::class, 'audiolibros_id');
    }


     public function sagas(){
        return $this->belongsTo(Saga::class, 'sagas_id');
    }

 
}
