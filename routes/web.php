<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{DisciplinasController, GradesController, EquivalenciasController, GeracaoController};

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('disciplinas')->group(function () {
        Route::get('/', [DisciplinasController::class, 'index'])->name('disciplinas.index');
        Route::get('/create', [DisciplinasController::class, 'create'])->name('disciplinas.create');
        Route::post('/', [DisciplinasController::class, 'store'])->name('disciplinas.store');
        Route::get('/{disciplina}', [DisciplinasController::class, 'show'])->name('disciplinas.show');
        Route::get('/{disciplina}/edit', [DisciplinasController::class, 'edit'])->name('disciplinas.edit');
        Route::put('/{disciplina}', [DisciplinasController::class, 'update'])->name('disciplinas.update');
        Route::delete('/{disciplina}', [DisciplinasController::class, 'destroy'])->name('disciplinas.destroy');
    });

    Route::post('change-disciplina-status/{disciplina}', [DisciplinasController::class, 'changeStatus'])->name('disciplinas.change-status');
    
    Route::prefix('equivalencias')->group(function () {
        Route::get('/', [EquivalenciasController::class, 'index'])->name('equivalencias.index');
        Route::get('/create', [EquivalenciasController::class, 'create'])->name('equivalencias.create');
        Route::post('/', [EquivalenciasController::class, 'store'])->name('equivalencias.store');
        Route::get('/{equivalencia}', [EquivalenciasController::class, 'show'])->name('equivalencias.show');
        Route::get('/{equivalencia}/edit', [EquivalenciasController::class, 'edit'])->name('equivalencias.edit');
        Route::put('/{equivalencia}', [EquivalenciasController::class, 'update'])->name('equivalencias.update');
        Route::delete('/{equivalencia}', [EquivalenciasController::class, 'destroy'])->name('equivalencias.destroy');
    });
    
    Route::prefix('grades')->group(function () {
        Route::get('/', [GradesController::class, 'index'])->name('grades.index');
        Route::get('/create', [GradesController::class, 'create'])->name('grades.create');
        Route::post('/', [GradesController::class, 'store'])->name('grades.store');
        Route::get('/{grade}', [GradesController::class, 'show'])->name('grades.show');
        Route::get('/{grade}/edit', [GradesController::class, 'edit'])->name('grades.edit');
        Route::put('/{grade}', [GradesController::class, 'update'])->name('grades.update');
        Route::delete('/{grade}', [GradesController::class, 'destroy'])->name('grades.destroy');
    });

    Route::prefix('geracao')->group(function () {
        Route::get('/', [GeracaoController::class, 'geracao'])->name('geracao.page');

        Route::post('/resultado', [GeracaoController::class, 'resultado'])->name('geracao.resultado');

        Route::post('/gerar-equivalencias', [GeracaoController::class, 'gerarEquivalencias'])->name('geracao.gerar-equivalencias');
    });
});

require __DIR__ . '/auth.php';