<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddIcdxRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'code' => 'required|max:50|unique:diagnose_icd_x,code',
            'name_en' => 'required|max:500|unique:diagnose_icd_x,name_en',
            'name_id' => 'required|unique:diagnose_icd_x,name_id',
        ];
    }

    public function messages()
    {
        return [
            'code.required'     =>  'Kode Diagnosa harus diisi!',
            'code.max'     =>  'Kode Diagnosa terlalu panjang!',
            'code.unique' => 'Kode Diagnosa sudah ada!',
            'name_en.required'     =>  'Nama Diagnosa dalam bahasa inggris harus diisi!',
            'name_en.max'     =>  'Nama Diagnosa dalam bahasa inggris terlalu panjang!',
            'name_en.unique' => 'Nama Diagnosa dalam bahasa inggris sudah ada!',
            'name_id.required'     =>  'Nama Diagnosa dalam Bahasa Indonesia harus diisi!',
            'name_id.max'     =>  'Nama Diagnosa dalam Bahasa Indonesia terlalu panjang!',
            'name_id.unique' => 'Nama Diagnosa dalam Bahasa Indonesia sudah ada!',
        ];
    }
}
