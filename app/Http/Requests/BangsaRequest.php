<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BangsaRequest extends FormRequest
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
            'nama_bangsa' => 'required|max:50',
            'desc_bangsa' => 'required|max:100',
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
            'nama_bangsa' => 'nama bangsa',
            'desc_bangsa' => 'deskripsi bangsa',
        ];
    }
}
