<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisciplinasGrades extends Model
{
    use HasFactory;
    // use SoftDeletes;
    
    protected $table = 'disciplinas_grades';

    protected $fillable = [
        'disciplinas_id',
        'grades_id'
    ];
}