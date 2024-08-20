<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultadosDisciplinas extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'resultados_disciplinas';

    protected $fillable = [
        'resultados_id',
        'disciplinas_id',
        'carga_horaria',
        'tipo',
    ];

    public function resultado(){
        return $this->belongsTo(Resultados::class,'resultados_id');
    }

    public function disciplina(){
        return $this->hasOne(Disciplinas::class,'disciplinas_id');
    }
}