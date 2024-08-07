<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnoseIcdX extends Model
{
    use HasFactory;
    protected $table = "diagnose_icd_x";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'code',
        'name_en',
        'name_id'
    ];
}
