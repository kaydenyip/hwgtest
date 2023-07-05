<?php

namespace App\Http\Requests;

use App\Models\DrinksType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDrinksTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('drinks_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:drinks_types,id',
        ];
    }
}
