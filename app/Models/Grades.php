<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'titulo'
    ];

    public function disciplinas(){
        return $this->belongsToMany(Disciplinas::class, 'disciplinas_grades');
    }
}