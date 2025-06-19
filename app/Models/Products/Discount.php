<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ConditionType;

class Discount extends Model
{
    protected $fillable = [
        'condition_type',
        'condition_key',
        'condition_value',
        'discount_method',
        'discount_value'
    ];

    protected $casts = [
        'condition_type' => ConditionType::class,
    ];
}
