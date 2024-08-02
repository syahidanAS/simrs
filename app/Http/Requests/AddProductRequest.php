<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required',
            'kfa_code' => 'required',
            'industry_id' => 'required',
            'name' => 'required|max:150',
            'content' => 'max:500',
            'large_unit_id' => 'required',
            'fill' => 'required',
            'small_unit_id' => 'required',
            'capacity' => 'required',
            'type_id' => 'required',
            'category_id' => 'required',
            'group_id' => 'required',
            'current_stock' => 'required',
            'minimum_stock' => 'required',
            'expired_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required'     =>  'Kode produk harus diisi!',
            'kfa_code.required'     =>  'Kode KFA harus diisi!',
            'industry_id.required'     =>  'Industri harus dipilih!',
            'name.required'     =>  'Nama produk harus diisi!',
            'name.max'     =>  'Nama produk terlalu panjang!',
            'content.max'     =>  'Kandungan terlalu panjang!',
            'large_unit_id.required'     =>  'Saturan Terbesar harus diisi!',
            'fill.required'     =>  'Isi satuan terbesar harus diinput!',
            'small_unit_id.required'     =>  'Saturan Terkecil harus diisi!',
            'capacity.required'     =>  'Kapasitas harus diisi!',
            'type_id.required'     =>  'Tipe produk harus dipilih!',
            'category_id.required'     =>  'Kategori produk harus dipilih!',
            'group_id.required'     =>  'Kelompok produk harus dipilih!',
            'current_stock.required'     =>  'Stok saat ini harus diisi!',
            'minimum_stock.required'     =>  'Stok minimal harus diisi!',
            'expired_date.required'     =>  'Tanggal kedaluwarsa harus diisi!',
        ];
    }
}
