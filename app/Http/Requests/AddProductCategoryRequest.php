<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductCategoryRequest extends FormRequest
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
            'code.required'     =>  'Kode Kategori harus diisi!',
            'code.max'     =>  'Kode Kategori terlalu panjang!',
            'name.required'     =>  'Nama Kategori harus diisi!',
            'name.max'     =>  'Nama Kategori terlalu panjang!'
        ];
    }
}
