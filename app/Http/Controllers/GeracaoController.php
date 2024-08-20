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

    public function resultado(Request $request)
    {
        return Inertia::render('Geracao/Resultado', ['resultado' => $request->resultado]);
    }

    public function gerarEquivalencias(Request $request)
    {
        //@todo melhorar essa bosta

        $grade_antiga = $request->grades['grade_antiga'];
        $grade_nova = $request->grades['grade_nova'];

        $disciplinas_antigas = $request->disciplinas;

        $disciplinas_matadas_grade_nova = [];
        $disciplinas_a_cursar_grade_nova = [];

        //
        foreach ($disciplinas_antigas as $da) {
            //pega as equivalencias das disciplinas antigas
            $disciplina_antiga = Disciplinas::find($da['id']);
            $equivalencias_from_this_disciplina = $disciplina_antiga->equivalencias($grade_nova);

            //adiciona essas equivalencias em um array com as disciplinas que o aluno ja matou da grade nova, devido as equivalencias
            foreach ($equivalencias_from_this_disciplina as $equivalencia) {
                $disciplinas_matadas_grade_nova[] = $equivalencia;
            }
        }

        //transforma esse array de objetos em um array só de ids para poder usar o whereNotIn
        $disciplinas_matadas_grade_nova_ids = array_map(function ($disciplina) {
            return $disciplina->id;
        }, $disciplinas_matadas_grade_nova);


        //disciplinas que o aluno ainda não matou da grade nova
        $disciplinas_a_cursar_grade_nova = Grades::find($grade_nova)->disciplinas()->whereNotIn('disciplinas.id', $disciplinas_matadas_grade_nova_ids)->get();

        $resultado = [
            'grade_antiga' => Grades::find($grade_antiga),
            'grade_nova' => Grades::find($grade_nova),
            'disciplinas_cursadas_grade_antiga' => $disciplinas_antigas,
            'disciplinas_matadas_grade_nova' => $disciplinas_matadas_grade_nova,
            'disciplinas_a_cursar_grade_nova' => $disciplinas_a_cursar_grade_nova
        ];


        return response()->json($resultado);
    }
}
