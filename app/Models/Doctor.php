<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = "doctors";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'front_degree',
        'back_degree',
        'address',
        'specialist_id',
        'phone_number',
        'gender',
        'id_number'
    ];

    public function specialist()
    {
        return $this->hasOne(Specialist::class, 'id', 'specialist_id');
    }
}
