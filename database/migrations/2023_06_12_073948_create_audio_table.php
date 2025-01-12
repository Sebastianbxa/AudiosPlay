<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug'); 
            $table->string('descripcion', 9000);
            $table->string('imagen')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('genero_id')->nullable()->constrained('etiquetas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('autor_id')->nullable()->constrained('autors')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('year_id')->nullable()->constrained('years')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('calificacion_id')->nullable()->constrained('calificacions')->onDelete('restrict')->onUpdate('cascade');
            $table->string('time')->nullable();
            $table->integer('view')->nullable();        
            $table->string('url_a', 2000)->nullable();
            $table->string('url_b', 500)->nullable();
            $table->string('url_c', 500)->nullable();
            $table->string('download_free', 900)->nullable();
            $table->string('download_1', 900)->nullable();
            $table->string('download_2', 900)->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio');
    }
};
