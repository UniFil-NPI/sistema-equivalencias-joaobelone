<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equivalencias extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'equivalencias';

    protected $fillable = [
        'titulo'
    ];

    public function disciplinas(){
        return $this->belongsToMany(Disciplinas::class, 'disciplinas_equivalencias');
    }
}