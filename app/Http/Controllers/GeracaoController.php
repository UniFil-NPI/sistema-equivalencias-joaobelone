<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquivalenciasRequest;
use App\Http\Requests\GradesRequest;
use App\Models\Disciplinas;
use App\Models\DisciplinasEquivalencias;
use App\Models\DisciplinasGrades;
use App\Models\Equivalencias;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Grades;
use Illuminate\Support\Facades\DB;
use Throwable;

class GeracaoController extends Controller
{
    public function geracao()
    {
        return Inertia::render('Geracao/Geracao', [
            'disciplinas' => Disciplinas::with('grades')->get(),
            'grades' => Grades::all()
        ]);
        
    }

    public function create()
    {
        
    }


}