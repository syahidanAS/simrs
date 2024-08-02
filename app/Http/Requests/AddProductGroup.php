<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductGroup extends FormRequest
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
            'code' => 'required|max:100',
            'name' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'code.required'     =>  'Kode Golongan harus diisi!',
            'code.max'     =>  'Kode Golongan terlalu panjang!',
            'name.required'     =>  'Nama Golongan harus diisi!',
            'name.max'     =>  'Nama Golongan terlalu panjang!'
        ];
    }
}
