<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|max:100',
            'name' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'code.required'     =>  'Kode Tipe harus diisi!',
            'code.max'     =>  'Kode Tipe terlalu panjang!',
            'name.required'     =>  'Nama Tipe harus diisi!',
            'name.max'     =>  'Nama Tipe terlalu panjang!'
        ];
    }
}
