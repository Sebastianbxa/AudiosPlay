<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Audio extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = ['titulo', 'descripcion', 'imagen', 'genero_id', 'autor_id', 'year_id', 'time', 'calificacion_id', 'url_a', 'url_b', 'url_c', 'download_free', 'download_1', 'download_2', 'view'];

    
    public function autors(){
        return $this->belongsTo(Autor::class, 'autor_id');
    }


    public function generos(){
        return $this->belongsTo(Etiqueta::class, 'genero_id');
    }

    public function years(){
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function calificacions(){
        return $this->belongsTo(Calificacion::class, 'calificacion_id');
    }


    public function usuarios(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function nuevos(){
        return $this->hasMany(Nuevo::class, 'id');
    }


    public function recomendados(){
        return $this->hasMany(Recomendado::class, 'id');
    }

    public function reportes(){
        return $this->hasMany(Reporte::class, 'id');
    }

    public function favoritos(){
        return $this->hasMany(Favorito::class, 'id');
    }

    public function SagasOk(){
        return $this->hasMany(Sagas_and_audiobook::class, 'id');
    }


    public function tops(){
        return $this->hasMany(Top::class, 'id');
    }


    public function visitas(){
        return $this->hasMany(Visita::class, 'id');
    }


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('titulo')
            ->saveSlugsTo('slug');
    }


   /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

  
}
