<?php

namespace App\Http\Requests;

use App\Models\DrinksType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDrinksTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('drinks_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
        ];
    }
}
