<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_software',
        'whatsapp',
        'telegram',
        'discord',
        'precio_membresia',
        'precio_membresia_descripcion',
        'metodo_pago_1',
        'imagen_metodo_pago_1',
        'metodo_pago_2',
        'imagen_metodo_pago_2',
        'metodo_pago_3',
        'imagen_metodo_pago_3',
        'metodo_pago_4',
        'imagen_metodo_pago_4',
    ];
}
