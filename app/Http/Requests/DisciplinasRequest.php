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
            'periodo' => ['int'],
            'carga_horaria' => ['int','required'],
            'tipo' => ['string'],
            'modalidade' => ['string'],
        ];
    }
}
