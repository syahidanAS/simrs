<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureIcdIxCm extends Model
{
    use HasFactory;
    protected $table = "icd_ix_cm";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'code',
        'name'
    ];
}
