<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolyclinicRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'kd_poli' => 'required|max:500',
            'open_at' => 'required',
            'closed_at' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     =>  'Nama poli harus diisi!',
            'name.max'     =>  'Nama poli terlalu panjang!',
            'kd_poli.required'     =>  'Kode poli harus diisi!',
            'kd_poli.max'     =>  'Kode poli terlalu panjang!',
            'open_at.required'     =>  'Jam buka poli harus dipilih!',
            'closed_at.required'     =>  'Jam tutup poli harus dipilih!',
        ];
    }
}
