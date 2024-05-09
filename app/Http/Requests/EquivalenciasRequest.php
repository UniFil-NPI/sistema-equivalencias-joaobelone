<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquivalenciasRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'titulo' => ['string','required'],
            'disciplinas'=>['string','nullable'] 
        ];
    }
}
