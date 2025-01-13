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
        Schema::create('ajustes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_software', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('discord', 255)->nullable();
            $table->decimal('precio_membresia', 8, 2)->nullable(); 
            $table->text('precio_membresia_descripcion')->nullable();
            $table->string('metodo_pago_1', 255)->nullable();
            $table->string('imagen_metodo_pago_1', 255)->nullable();
            $table->string('metodo_pago_2', 255)->nullable();
            $table->string('imagen_metodo_pago_2', 255)->nullable();
            $table->string('metodo_pago_3', 255)->nullable();
            $table->string('imagen_metodo_pago_3', 255)->nullable();
            $table->string('metodo_pago_4', 255)->nullable();
            $table->string('imagen_metodo_pago_4', 255)->nullable();
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
        Schema::dropIfExists('ajustes');
    }
};
