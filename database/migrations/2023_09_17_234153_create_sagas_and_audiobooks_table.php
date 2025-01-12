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
        Schema::create('sagas_and_audiobooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audiolibros_id')->nullable()->constrained('audio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sagas_id')->nullable()->constrained('sagas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sagas_and_audiobooks');
    }
};
