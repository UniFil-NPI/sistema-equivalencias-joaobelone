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
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('codigo');
            $table->string('titulo');
            $table->string('periodo')->nullable();
            $table->integer('carga_horaria')->nullable();
            $table->string('tipo')->nullable();
            $table->string('modalidade')->nullable();            
            $table->integer('ativo')->default(1);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplinas');
    }
};
