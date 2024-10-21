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
        Schema::create('asistentes', function (Blueprint $table) {
            $table->bigIncrements('id_asistente');
            $table->string('nombre_asistente');
            $table->string('ci_asistente');
            $table->string('telefono');
            
            $table->unsignedBigInteger('id_evento');
            $table->foreign('id_evento')->references('id_evento')->on('evento')->onDelete('cascade');
        
            $table->unsignedBigInteger('id_ubicacion');
            $table->foreign('id_ubicacion')->references('id_ubicacion')->on('ubicacion')->onDelete('cascade');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistentes');
    }
};
