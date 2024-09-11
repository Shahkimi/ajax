<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HukumanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kod_hukuman' => 'required|max:50',
            'desc_hukuman' => 'required|max:100',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'kod_hukuman' => 'Kod Hukuman',
            'desc_hukuman' => 'Deskripsi Hukuman',
        ];
    }
}