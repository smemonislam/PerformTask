<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required',
            'first_name'    => 'required|min:3|max:32',
            'last_name'     => 'required|min:3|max:32',
            'email'         => ['required', 'email', 'unique:employees,email'],
            'phone'         => 'required'
        ];
    }
}
