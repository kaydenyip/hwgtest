<?php

namespace App\Http\Requests;

use App\Models\Payout;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePayoutRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payout_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'completed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
