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
        Schema::create('cache', function (Blueprint $table) {
            //$table->string('key')->primary();
            //$table->mediumText('value');
            //$table->integer('expiration');
            $table->id(); // Esto crea el campo `id` como clave primaria y auto-incremental
            $table->string('nombre'); // Nombre del usuario
            $table->string('password'); // Contraseña del usuario
            $table->string('rol'); // Rol del usuario, como 'admin' o 'user'
            $table->string('ci')->unique(); // Documento de identidad, debe ser único
            $table->string('telefono'); // Teléfono del usuario
            $table->date('fecha'); // Fecha de registro o nacimiento, según necesites
            $table->rememberToken(); // Token para recordar sesión
            $table->timestamps(); // Campos `created_at` y `updated_at`
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('users');
    }
};
