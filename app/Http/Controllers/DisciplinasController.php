<?php

namespace App\Http\Controllers;

use App\Models\Disciplinas;
use App\Models\Grades;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DisciplinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Disciplinas/Index', [
            'disciplinas' => Disciplinas::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Disciplinas/Create', [
            'disciplinas' => Disciplinas::all(),
            'grades'=> Grades::all(),
            'csrf_token' => csrf_token()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       dd('WIP');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
