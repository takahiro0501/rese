<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DatePast;

class ReservationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required'],
            'datetime' => [ new DatePast ]
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付けを選択してください',
        ];
    }
}
