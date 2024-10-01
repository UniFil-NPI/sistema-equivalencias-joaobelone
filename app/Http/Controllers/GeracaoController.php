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
use App\Models\Resultados;
use Illuminate\Support\Facades\DB;
use Throwable;

class GeracaoController extends Controller
{
    public function geracao()
    {
        return Inertia::render('Geracao/Geracao', [
            'disciplinas' => Disciplinas::with('grades')->where('ativo',1)->get(),
            'grades' => Grades::all()
        ]);
    }

    public function gerarEquivalencias(Request $request)
    {
        try {
            $grade_antiga = $request->grades['grade_antiga'];
            $grade_nova = $request->grades['grade_nova'];
            $disciplinas_antigas = $request->disciplinas;

            $disciplinas_abatidas_grade_nova = $this->getDisciplinasAbatidas($disciplinas_antigas, $grade_nova['id']);

            $disciplinas_abatidas_grade_nova_ids_array = $this->makeArrayOfIds($disciplinas_abatidas_grade_nova);

            $disciplinas_a_cursar_grade_nova = $this->getDisciplinasRestantes($grade_nova['id'], $disciplinas_abatidas_grade_nova_ids_array);

            $resultado = [
                'titulo'=>$request->titulo,
                'grade_antiga' => $grade_antiga,
                'grade_nova' => $grade_nova,
                'disciplinas_cursadas_grade_antiga' => $disciplinas_antigas,
                'disciplinas_abatidas_grade_nova' => $disciplinas_abatidas_grade_nova,
                'disciplinas_a_cursar_grade_nova' => $disciplinas_a_cursar_grade_nova
            ];

            $rc = new ResultadosController();
            $resultado_criado = $rc->store($resultado);
            if($resultado_criado == 'error'){
                return response()->json(['error' =>'Não foi possível salvar o resultado: ']);
            }

            return response()->json($resultado_criado);
        } catch (Throwable $e) {
            return response()->json(['error' =>'Não foi possível gerar as equivalências: '. $e->getMessage()]);
        }
    }

    function getDisciplinasAbatidas($disciplinas_antigas, $grade_nova_id)
    {
        $disciplinas_abatidas_grade_nova = [];

        foreach ($disciplinas_antigas as $disciplinas_antiga) {
            $disciplina_antiga_instance = Disciplinas::find($disciplinas_antiga['id']);
            $equivalencias_from_this_disciplina = $disciplina_antiga_instance->equivalencias($grade_nova_id);

            //adiciona essas equivalencias em um array com as disciplinas que o aluno ja matou da grade nova, devido as equivalencias
            foreach ($equivalencias_from_this_disciplina as $equivalencia) {
                $disciplinas_abatidas_grade_nova[] = $equivalencia;
            }
        }

        return $disciplinas_abatidas_grade_nova;
    }

    function getDisciplinasRestantes($grade_nova_id, $disciplinas_abatidas_id_array)
    {
        return Grades::find($grade_nova_id)->disciplinas()->whereNotIn('disciplinas.id', $disciplinas_abatidas_id_array)->get();
    }

    function makeArrayOfIds($object_array)
    {
        return array_map(function ($obj) {
            return $obj->id;
        }, $object_array);
    }


}
