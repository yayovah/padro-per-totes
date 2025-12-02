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
        Schema::create('situacios', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta');
            $table->string('resposta');
            $table->string('ciutat');
            $table->string('seguent_pregunta');
            $table->integer('posicio')->nullable();
            $table->timestamps();

            //Claus foranies
            $table->foreign('itinerari')->references('id')->on('itineraris')->onDelete('cascade');
            $table->foreign('pregunta')->references('id')->on('preguntes')->onDelete('cascade');
            $table->foreign('resposta')->references('id')->on('respostes')->onDelete('cascade');
            $table->foreign('ciutat')->references('id')->on('ciutats')->onDelete('cascade');
            $table->foreign('seguent_pregunta')->references('id')->on('preguntes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situacios');
    }
};
