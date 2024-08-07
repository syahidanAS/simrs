<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddIcdIxRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'code' => 'required|max:50|unique:diagnose_icd_x,code',
            'name' => 'required|max:500|unique:diagnose_icd_x,name_en',
        ];
    }

    public function messages()
    {
        return [
            'code.required'     =>  'Kode Prosedur harus diisi!',
            'code.max'     =>  'Kode Prosedur terlalu panjang!',
            'code.unique' => 'Kode Prosedur sudah ada!',
            'name.required'     =>  'Nama harus diisi!',
            'name.max'     =>  'Nama terlalu panjang!',
            'name.unique' => 'Nama sudah ada!',

        ];
    }
}
