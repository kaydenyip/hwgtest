<?php

namespace App\Http\Requests;

use App\Models\Appoitment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppoitmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appoitment_edit');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'array',
            ],
        ];
    }
}
