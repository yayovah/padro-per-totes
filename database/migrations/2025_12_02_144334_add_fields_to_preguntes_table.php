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
        Schema::table('preguntes', function (Blueprint $table) {
            $table->unsignedBigInteger('imatge')->nullable();
            
            //claus foranies
            $table->foreign('imatge')->references('id')->on('imatges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preguntes', function (Blueprint $table) {
            $table->dropColumn(['imatge']);
        });
    }
};
