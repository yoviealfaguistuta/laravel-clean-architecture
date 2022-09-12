<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator as ExceptionValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:employees,name',
            'salary' => 'required|integer|min:2000000|max:10000000',
        ];
    }

    public function messages()
    {
        return [
            "name.unique" => "Nama sudah digunakan (harus unik)",
            "salary.min" => "Gaji harus lebih dari 2000000",
            "salary.max" => "Gaji tidak boleh lebih dari 10000000",
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
