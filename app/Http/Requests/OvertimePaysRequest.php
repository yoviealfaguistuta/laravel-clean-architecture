<?php

namespace App\Http\Requests;

use App\Models\Overtime;
use Illuminate\Contracts\Validation\Validator as ExceptionValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OvertimePaysRequest extends FormRequest
{

    public function rules()
    {
        return [
            'month' => 'date_format:Y-m',
        ];

    }

    // public function messages()
    // {
    //     return [
    //         "age.integer" => "User name is required",
    //         "title.required" => "User name should be unique"
    //     ];
    // }

    protected function failedValidation(ExceptionValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
