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
        Schema::create('itineraris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ciutat');
            $table->unsignedBigInteger('usuaria')->nullable();
            $table->timestamps();

            //Claus foranies
            $table->foreign('ciutat')->references('id')->on('ciutats')->onDelete('cascade');
            $table->foreign('usuaria')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraris');
    }
};
