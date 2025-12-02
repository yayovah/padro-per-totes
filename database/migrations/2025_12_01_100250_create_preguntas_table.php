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
        Schema::create('preguntes', function (Blueprint $table) {
            $table->id();
            $table->string('titol');
            $table->text('text');
            $table->string('imatge')->nullable();
            $table->timestamps();
            
            //claus foranies
            $table->foreign('imatge')->references('id')->on('imatges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntes');
    }
};
