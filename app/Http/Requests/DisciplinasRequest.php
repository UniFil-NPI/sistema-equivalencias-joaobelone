<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DisciplinasRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'titulo' => ['string','required'],
            'codigo' => ['string','required'],
            'periodo' => ['int', 'nullable'],
            'carga_horaria' => ['int','required'],
            'tipo' => ['string', 'nullable'],
            'modalidade' => ['string', 'nullable'],
            'grades'=>['string','nullable']
        ];
    }
}
