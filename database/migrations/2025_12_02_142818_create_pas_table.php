<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasos', function (Blueprint $table) {
            $table->id();
            $table->string('itinerari');
            $table->string('pregunta');
            $table->string('resposta');
            $table->timestamps();

            //Claus foranies
            $table->foreign('itinerari')->references('id')->on('itineraris')->onDelete('cascade');
            $table->foreign('pregunta')->references('id')->on('preguntes')->onDelete('cascade');
            $table->foreign('resposta')->references('id')->on('respostes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasos');
    }
};
