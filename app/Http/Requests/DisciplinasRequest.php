<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'modalidade' => ['string', 'required'],
            'grades'=>['string','nullable'] 
        ];
    }
}
