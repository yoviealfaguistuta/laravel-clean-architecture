<?php

namespace App\Http\Requests;

use App\Models\Overtime;
use Illuminate\Contracts\Validation\Validator as ExceptionValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OvertimeRequest extends FormRequest
{

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                Rule::exists('employees', 'id'),
            ],
            'date' => 'required|unique:overtimes,date,NULL,id,employee_id,' . $this->request->get('employee_id'),
            'time_started'    => 'required|date_format:H:i|before_or_equal:time_started',
            'time_ended'      => 'required|date_format:H:i|after_or_equal:time_started',
        ];

    }

    public function messages()
    {
        return [
            "time_started.before_or_equal" => "Waktu dimulai harus lebih kecil dari waktu berakhir",
            "time_ended.after_or_equal" => "Waktu berakhir harus lebih besar dari waktu dimulai"
        ];
    }

    protected function failedValidation(ExceptionValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
