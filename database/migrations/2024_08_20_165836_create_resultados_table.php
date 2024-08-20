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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->integer('grade_antiga');
            $table->integer('grade_nova');
            $table->text('disciplinas_cursadas_grade_antiga');
            $table->text('disciplinas_abatidas_grade_nova');
            $table->text('disciplinas_atribuidas_grade_nova');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
