<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PtjRequest extends FormRequest
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
            'kod_ptj' => 'required|max:50',
            'desc_ptj' => 'required|max:100',
            'ketua_ptj' => 'required|max:100',
            'alamat_ptj' => 'required|max:255',
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
            'kod_ptj' => 'Kod Ptj',
            'desc_ptj' => 'Nama Ptj',
            'ketua_ptj' => 'Nama Ketua Ptj',
            'alamat_ptj' => 'Alamat Ptj',
        ];
    }
}
