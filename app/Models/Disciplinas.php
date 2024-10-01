<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplinas extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'disciplinas';

    protected $fillable = [
        'titulo',
        'codigo',
        'periodo',
        'carga_horaria',
        'tipo',
        'modalidade',
        'ativo'
    ];

    public function grades()
    {
        return $this->belongsToMany(Grades::class, 'disciplinas_grades');
    }

    public function equivalencias($grade_id = null)
    {
        $equivalencias_id = DisciplinasEquivalencias::where('disciplinas_id', $this->id)->first()->equivalencias_id;

        $disciplinas_equivalencias = DisciplinasEquivalencias::where('equivalencias_id', $equivalencias_id)->get();

        $disciplinas = Disciplinas::where('ativo',1)->whereIn('id', $disciplinas_equivalencias->pluck('disciplinas_id'))->get();

        if($grade_id){
            $disciplinas = $disciplinas->filter(function($disciplina) use ($grade_id){
                return $disciplina->grades->contains($grade_id);
            });
        }

        return $disciplinas;
    }
}
