<?php

namespace App\Http\Requests;

use App\Models\Drink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDrinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('drink_create');
    }

    public function rules()
    {
        return [
            'completed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
