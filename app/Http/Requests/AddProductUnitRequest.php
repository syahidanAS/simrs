<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductUnitRequest extends FormRequest
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
            'code.required'     =>  'Kode Satuan harus diisi!',
            'code.max'     =>  'Kode Satuan terlalu panjang!',
            'name.required'     =>  'Nama Satuan harus diisi!',
            'name.max'     =>  'Nama Satuan terlalu panjang!'
        ];
    }
}
