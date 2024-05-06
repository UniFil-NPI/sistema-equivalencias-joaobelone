<?php

namespace App\Http\Controllers;

use App\Models\Disciplinas;
use App\Models\Grades;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\DisciplinasRequest;
use App\Models\DisciplinasGrades;
use Illuminate\Support\Facades\DB;
use Throwable;

class DisciplinasController extends Controller
{
    public function index()
    {
        return Inertia::render('Disciplinas/Index', [
            'disciplinas' => Disciplinas::with('grades')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Disciplinas/Create', [
            'disciplinas' => Disciplinas::all(),
            'grades'=> Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    public function store(DisciplinasRequest $request)
    {
        try {
            DB::beginTransaction();

            $disciplina = Disciplinas::create($request->validated());

            $grades = explode(',',$request->grades);

            foreach ($grades as $grade) {
                if($grade != ''){
                    DisciplinasGrades::create([
                        'disciplinas_id' => $disciplina->id,
                        'grades_id' => $grade
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Disciplina adicionada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao adicionar disciplina! '.$th], 500);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return Inertia::render('Disciplinas/Edit', [
            'disciplina' => Disciplinas::find($id)->with('grades'),
            'grades'=> Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            $disciplinas_grades = DisciplinasGrades::where('disciplinas_id',$id)->get();

            foreach ($disciplinas_grades as $dg) {
                $dg->delete();
            }

            Disciplinas::find($id)->delete();

            DB::commit();
            return response()->json(['success' => 'Disciplina removida com sucesso!'], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao remover disciplina! '.$th], 500);
        }
    }
}
