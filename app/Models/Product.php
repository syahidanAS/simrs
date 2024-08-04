<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $tables = 'products';
    protected $fillable = [
        'code',
        'industry_id',
        'name',
        'content',
        'large_unit_id',
        'fill',
        'small_unit_id',
        'capacity',
        'type_id',
        'category_id',
        'group_id',
        'current_stock',
        'minimum_stock',
        'basic_price',
        'purchase_price',
        'outpatient_price',
        'inpatient_price_class_1',
        'inpatient_price_class_2',
        'inpatient_price_class_3',
        'inpatient_price_bpjs',
        'inpatient_price_vip',
        'inpatient_price_vvip'
    ];

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    public function group()
    {
        return $this->hasOne(ProductGroup::class, 'id', 'group_id');
    }

    public function industry()
    {
        return $this->hasOne(ProductIndustry::class, 'id', 'industry_id');
    }

    public function type()
    {
        return $this->hasOne(ProductType::class, 'id', 'type_id');
    }

    public function smallUnit()
    {
        return $this->belongsTo(ProductUnit::class, 'small_unit_id', 'id');
    }

    public function largeUnit()
    {
        return $this->belongsTo(ProductUnit::class, 'large_unit_id', 'id');
    }
}
