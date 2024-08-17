<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisciplinasEquivalencias extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'disciplinas_equivalencias';

    protected $fillable = [
        'disciplinas_id',
        'equivalencias_id'
    ];
}