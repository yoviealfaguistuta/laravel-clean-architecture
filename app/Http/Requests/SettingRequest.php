<?php

namespace App\Http\Requests;

use App\Models\Overtime;
use Illuminate\Contracts\Validation\Validator as ExceptionValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
{

    public function rules()
    {
        return [
            'key' => 'required|in:overtime_method',
            'value' => [
                'required',
                Rule::exists('references', 'id')
                ->where('code', $this->request->get('key'),),
            ]
        ];
    }

    public function messages()
    {
        return [
            "key.in" => "Key harus berupa 'overtime_method'",
            "value.exists" => "Relasi pada tabel references tidak ditemukan"
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
