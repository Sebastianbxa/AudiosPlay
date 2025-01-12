<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'audiolibro_id' , 'comentario'];
    public function usuarios(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
