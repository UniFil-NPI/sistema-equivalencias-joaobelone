<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resultados extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'resultados';

    protected $fillable = [
        'titulo',
        'grade_antiga',
        'grade_nova'
    ];

    public function disciplinas($tipo){
        return $this->hasMany(Disciplinas::class, 'resultados_disciplinas')->where('resultados_disciplinas.tipo', $tipo);
    }

    public function gradeAntiga(){
        return $this->hasOne(Grades::class, 'grade_antiga');
    }

    public function gradeNova(){
        return $this->hasOne(Grades::class, 'grade_nova');
    }
    
}