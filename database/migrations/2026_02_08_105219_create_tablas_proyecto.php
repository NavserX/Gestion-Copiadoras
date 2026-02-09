<?php

// Importo las clases necesarias para crear la migración
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Creo una migración anónima
return new class extends Migration
{
    /**
     * Run the migrations.
     * He creado un único bloque con todas las tablas
     * porque tenía errores al intentar crearlas por separado
     * debido a las claves foráneas y el orden de creación.
     */
    public function up(): void
    {
        // Creo la tabla marcas
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();                 // Clave primaria
            $table->string('nombre');     // Nombre de la marca
            $table->timestamps();         // created_at y updated_at
        });

        // Creo la tabla tecnicos
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id();                         // Clave primaria
            $table->string('nombre');             // Nombre del técnico
            $table->string('email')->unique();    // Email único
            $table->timestamps();                 // created_at y updated_at
        });

        // Creo la tabla clientes
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();                         // Clave primaria
            $table->string('nombre');             // Nombre del cliente
            $table->string('empresa')->nullable();// Empresa (puede ser nula)
            $table->string('email');              // Email del cliente
            $table->timestamps();                 // created_at y updated_at
        });

        // Creo la tabla reparaciones
        Schema::create('reparaciones', function (Blueprint $table) {
            $table->id(); // Clave primaria

            // Claves foráneas que relacionan la reparación
            // con marca, técnico y cliente
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('tecnico_id')->constrained('tecnicos');
            $table->foreignId('cliente_id')->constrained('clientes');

            $table->text('descripcion');           // Descripción de la reparación
            $table->string('estado')
                ->default('pendiente');          // Estado por defecto

            $table->timestamps();                  // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Elimino las tablas creadas por esta migración.
     */
    public function down(): void
    {
        // Borro las tablas en orden inverso para evitar problemas
        // con las claves foráneas
        Schema::dropIfExists('reparaciones');
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('tecnicos');
        Schema::dropIfExists('marcas');
    }
};
