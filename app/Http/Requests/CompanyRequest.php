<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CompanyRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email|unique:companies,email',
            'website'   => 'url',
            'logo' => [
                'required',
                File::image()
                    ->types(['png', 'jpg', 'jpeg'])
                    ->max(1024)
                    ->dimensions(
                        Rule::dimensions()
                            ->maxWidth(100)
                            ->maxHeight(100)
                    )
            ]
        ];
    }
}
