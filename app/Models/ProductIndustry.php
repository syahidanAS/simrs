<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIndustry extends Model
{
    use HasFactory;
    protected $table = "product_industries";
    protected $primaryKey = "id";
    protected $fillable = [
        'code',
        'name',
        'address',
        'city',
        'phone'
    ];
}
