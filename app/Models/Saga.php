<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saga extends Model
{
    use HasFactory;
    protected $fillable = ['nombre' , 'saga_codigo',];

    public function Sagasok(){
        return $this->hasMany(Sagas_and_audiobook::class, 'id');
    }

 
}
