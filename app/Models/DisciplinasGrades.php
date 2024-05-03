<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinasGrades extends Model
{
    use HasFactory;

    protected $table = 'disciplinas_grades';

    protected $fillable = [
        'disciplinas_id',
        'grades_id'
    ];
}