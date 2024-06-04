<?php

namespace App\Http\Controllers;

use App\Models\Disciplinas;
use App\Models\Grades;
use Inertia\Inertia;
use App\Http\Requests\DisciplinasRequest;
use App\Models\DisciplinasGrades;
use App\Models\Equivalencias;
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
            'grades' => Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    public function store(DisciplinasRequest $request)
    {
        try {

            if(Disciplinas::where('codigo', $request->codigo)->first()) return response()->json(['error' => 'Disciplina já cadastrada!']);

            DB::beginTransaction();

            $disciplina = Disciplinas::create($request->validated());

            if ($request->grades) {
                $grades = explode(',', $request->grades);
                foreach ($grades as $grade) {
                    if ($grade != '') {
                        DisciplinasGrades::create([
                            'disciplinas_id' => $disciplina->id,
                            'grades_id' => $grade
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => 'Disciplina adicionada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao adicionar disciplina! '], 500);
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        return Inertia::render('Disciplinas/Edit', [
            'disciplina' => Disciplinas::with('grades')->find($id),
            'grades' => Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    public function update(DisciplinasRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $disciplina = Disciplinas::find($id);
            $disciplina->update($request->validated());

            //remover disciplinas grades antigas
            $disciplinas_grades = DisciplinasGrades::where('disciplinas_id', $id)->get();
            foreach ($disciplinas_grades as $dg) {
                $dg->delete();
            }

            //adicionar novas disciplinas grades
            $grades = explode(',', $request->grades);
            foreach ($grades as $grade) {
                if ($grade != '') {
                    DisciplinasGrades::firstOrCreate([
                        'disciplinas_id' => $disciplina->id,
                        'grades_id' => $grade
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Disciplina atualizada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao atualizar a disciplina! '], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $disciplinas_grades = DisciplinasGrades::where('disciplinas_id', $id)->get();

            foreach ($disciplinas_grades as $dg) {
                $dg->delete();
            }

            //DESTRUIR EQUIVALENCIAS COM ESSA DISCIPLINA TAMBEM
            // $equivalencias = Equivalencias::where('disciplinas_id', $id)->get();
            // foreach ($equivalencias as $equivalencia) {
            //     $equivalencia->delete();
            // }

            Disciplinas::find($id)->delete();

            DB::commit();
            return response()->json(['success' => 'Disciplina removida com sucesso!'], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao remover disciplina! '], 500);
        }
    }

    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();

            $disciplina = Disciplinas::find($id);

            $disciplina->ativo = !$disciplina->ativo;
            
            $disciplina->save();

            DB::commit();
            if ($disciplina->ativo == 1) return response()->json(['success' => 'Disciplina ativada com sucesso!'], 200);

            return response()->json(['success' => 'Disciplina desativada com sucesso!'], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao alterar status da disciplina! '], 500);
        }
    }
}
