<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PanelRequest extends FormRequest
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
            'nama_pengurusi' => 'required|max:100',
            'mpm_pengurusi' => 'required|max:100',
            'nama_panel' => 'required|max:100',
            'nama_panel2' => 'required|max:100',
            'mpm_panel2' => 'required|max:100',
            'jawatan_panel2' => 'required|max:100',
            'tajuk_panel2' => 'required|max:100',
            'penyemak' => 'required|max:100',
            'jawatan_penyemak' => 'required|max:100'
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
            'nama_pengurusi' => 'Nama Pengurusi',
            'mpm_pengurusi' => 'No MPM Pengurusi',
            'nama_panel' => 'Nama Panel 1',
            'nama_panel2' => 'Nama Panel 2',
            'mpm_panel2' => 'No MPM Panel 2',
            'jawatan_panel2' => 'Jawatan Panel 2',
            'tajuk_panel2' => 'Tajuk Panel 2',
            'penyemak' => 'Nama Penyemak',
            'jawatan_penyemak' => 'Jawatan Penyemak'
        ];
    }
}
