<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ConditionType;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'condition_type',
        'condition_key',
        'condition_value',
        'is_percentage',
        'apply_order',
        'discount_value',
        'is_active'
    ];

    protected $casts = [
        'condition_type' => ConditionType::class,
    ];
}
