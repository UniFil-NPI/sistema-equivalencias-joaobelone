<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquivalenciasRequest;
use App\Http\Requests\GradesRequest;
use App\Models\{Disciplinas, DisciplinasEquivalencias, DisciplinasGrades};
use App\Models\Equivalencias;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Grades;
use Illuminate\Support\Facades\DB;
use Throwable;

class EquivalenciasController extends Controller
{
    public function index()
    {
        return Inertia::render('Equivalencias/Index', [
            'equivalencias' => Equivalencias::with('disciplinas')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Equivalencias/Create', [
            'disciplinas' => Disciplinas::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    public function store(EquivalenciasRequest $request)
    {
        try {
            DB::beginTransaction();

            $equivalencia = Equivalencias::create($request->validated());

            $disciplinas = explode(',', $request->disciplinas);

            foreach ($disciplinas as $disciplina) {
                if ($disciplina != '') {
                    DisciplinasEquivalencias::create([
                        'disciplinas_id' => $disciplina,
                        'equivalencias_id' => $equivalencia->id
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Equivalencia adicionada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao adicionar equivalencia! '.$th->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return Inertia::render('Equivalencias/Edit', [
            'disciplinas' => Disciplinas::all(),
            'equivalencia' => Equivalencias::with('disciplinas')->find($id),
            'csrf_token' => csrf_token()
        ]);
    }

    public function update(EquivalenciasRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $equivalencia = Equivalencias::find($id);
            $equivalencia->update($request->validated());

            //remover disciplinas grades antigas
            $disciplinas_equivalencias = DisciplinasEquivalencias::where('equivalencias_id', $id)->get();
            foreach ($disciplinas_equivalencias as $dg) {
                $dg->delete();
            }

            //adicionar novas disciplinas grades
            $disciplinas = explode(',', $request->disciplinas);
            foreach ($disciplinas as $disciplina) {
                if ($disciplina != '') {
                    DisciplinasEquivalencias::firstOrCreate([
                        'disciplinas_id' => $disciplina,
                        'equivalencias_id' => $equivalencia->id
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Equivalencia atualizada com sucesso!'], 201);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao atualizar a equivalencia! '], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $disciplinas_equivalencias = DisciplinasEquivalencias::where('equivalencias_id', $id)->get();

            foreach ($disciplinas_equivalencias as $dg) {
                $dg->delete();
            }

            Equivalencias::find($id)->delete();

            DB::commit();
            return response()->json(['success' => 'Equivalencia removida com sucesso!'], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao remover equivalencia! '], 500);
        }
    }
}
