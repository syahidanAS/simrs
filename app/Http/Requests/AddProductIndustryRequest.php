<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductIndustryRequest extends FormRequest
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
            'address' => 'required|max:400',
            'city' => 'required|max:100',
            'phone' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'code.required'     =>  'Kode Industri harus diisi!',
            'code.max'     =>  'Kode Industri terlalu panjang!',
            'name.required'     =>  'Nama Industri harus diisi!',
            'name.max'     =>  'Nama Industri terlalu panjang!',
            'address.required'     =>  'Alamat Industri harus diisi!',
            'address.max'     =>  'Alamat Industri terlalu panjang!',
            'city.required'     =>  'Kota Industri harus diisi!',
            'city.max'     =>  'Kota Industri terlalu panjang!',
            'phone.required'     =>  'No. Telepon harus diisi!',
            'phone.max'     =>  'No. Telepon terlalu panjang!'
        ];
    }
}
