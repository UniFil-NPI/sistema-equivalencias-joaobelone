<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinasEquivalencias extends Model
{
    use HasFactory;

    protected $table = 'disciplinas_equivalencias';

    protected $fillable = [
        'disciplinas_id',
        'equivalencias_id'
    ];
}