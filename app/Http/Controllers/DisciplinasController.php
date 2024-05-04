<?php

namespace App\Http\Controllers;

use App\Models\Disciplinas;
use App\Models\Grades;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\DisciplinasRequest;
use Illuminate\Support\Facades\DB;
use Throwable;

class DisciplinasController extends Controller
{
    public function index()
    {
        return Inertia::render('Disciplinas/Index', [
            'disciplinas' => Disciplinas::all(),
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

            Disciplinas::create($request->validated());

            DB::commit();
            return to_route('disciplinas.create');
        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Erro ao adicionar aula!');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return Inertia::render('Disciplinas/Edit', [
            'disciplina' => Disciplinas::find($id),
            'grades'=> Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
