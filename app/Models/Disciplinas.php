<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplinas extends Model
{
    use HasFactory;

    protected $table = 'disciplinas';

    protected $fillable = [
        'titulo',
        'codigo',
        'periodo',
        'carga_horaria',
        'tipo',
        'modalidade'       
    ];

    public function grades()
    {
        return $this->belongsToMany(Grades::class, 'disciplinas_grades');
    }

    public function equivalencias(){
        return $this->belongsToMany(Equivalencias::class, 'disciplinas_equivalencias');
    }
}