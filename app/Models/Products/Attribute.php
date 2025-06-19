<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
class Attribute extends Model
{
    protected $fillable = [
        'name',
        'is_active'
    ];

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }
}
