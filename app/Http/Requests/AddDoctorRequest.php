<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'id_number' => 'required|unique:doctors,id_number|digits:16',
            'name' => 'required|max:50',
            'front_degree' => 'max:20',
            'back_degree' => 'max:20',
            'phone_number' => 'required',
            'gender' => 'required',
            'specialist_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_number.required'     =>  'NIK dokter harus diisi!',
            'id_number.unique'     =>  'NIK dokter sudah digunakan!',
            'id_number.digits' => 'NIK harus terdiri dari 16 digit!',
            'name.required' => 'Nama dokter harus diisi!',
            'name.max' => 'Nama dokter terlalu panjang!',
            'front_degree.max' => 'Gelar depan terlalu panjang!',
            'back_degree.max' => 'Gelar belakang terlalu panjang!',
            'phone_number.required' => 'No.telepon harus diisi!',
            'gender.required' => 'Jenis kelamin harus diisi!',
            'specialist_id.required' => 'Spesialis harus dipilih!',
        ];
    }
}
