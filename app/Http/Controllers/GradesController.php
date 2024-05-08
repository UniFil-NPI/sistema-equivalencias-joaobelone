<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradesRequest;
use App\Models\Disciplinas;
use App\Models\DisciplinasGrades;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Grades;
use Illuminate\Support\Facades\DB;
use Throwable;

class GradesController extends Controller
{
    public function index()
    {
        return Inertia::render('Grades/Index', [
            'grades' => Grades::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Grades/Create', [
            'disciplinas' => Disciplinas::all(),
            'grades' => Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    public function store(GradesRequest $request)
    {
        try {
            DB::beginTransaction();

            $grade = Grades::create($request->validated());

            $disciplinas = explode(',', $request->disciplinas);

            foreach ($disciplinas as $disciplina) {
                if ($disciplina != '') {
                    DisciplinasGrades::create([
                        'disciplinas_id' => $disciplina,
                        'grades_id' => $grade->id
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Grade adicionada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao adicionar grade! '.$th], 500);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return Inertia::render('Grades/Edit', [
            'disciplina' => Disciplinas::all(),
            'grades' => Grades::with('disciplinas')->find($id),
            'csrf_token' => csrf_token()
        ]);
    }

    public function update(GradesRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $grade = Grades::find($id);
            $grade->update($request->validated());

            //remover disciplinas grades antigas
            $disciplinas_grades = DisciplinasGrades::where('grades_id', $id)->get();
            foreach ($disciplinas_grades as $dg) {
                $dg->delete();
            }

            //adicionar novas disciplinas grades
            $disciplinas = explode(',', $request->disciplinas);
            foreach ($disciplinas as $disciplina) {
                if ($disciplina != '') {
                    DisciplinasGrades::firstOrCreate([
                        'disciplinas_id' => $disciplina,
                        'grades_id' => $grade->id
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Grade atualizada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao atualizar a grade! '], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $disciplinas_grades = DisciplinasGrades::where('grades_id', $id)->get();

            foreach ($disciplinas_grades as $dg) {
                $dg->delete();
            }

            Grades::find($id)->delete();

            DB::commit();
            return response()->json(['success' => 'Grade removida com sucesso!'], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao remover grade! '], 500);
        }
    }
}
