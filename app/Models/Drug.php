<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $table = "drugs";
    protected $primaryKey = "id";
    protected $fillable = [
        'code',
        'name',
        'unit',
        'amount',
        'type',
        'supplier_code'
    ];
}
