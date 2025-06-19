<?php

namespace App\Services\Product;

use Illuminate\Database\Eloquent\Collection;

class ProductService
{

    public function calculateDiscount(float $subtotal, Collection $discounts,string $userType = 'normal', array $attributeDetails = []): array
    {
        $discountTotal = 0;
        $discountDetails = [];
        $subtotal = $subtotal;
        foreach ($discounts as $discount) {
            switch ($discount->condition_type->value) {
                case 'attribute':
                    if (in_array($discount->condition_value, array_column($attributeDetails, 'option_id'))) {
                        $amount = $this->applyDiscount($discount, $subtotal);
                        $discountTotal += $amount;
                        $subtotal -= $amount;
                        $discountDetails[] = ['name' => $discount->name . ' (' . $discount->discount_value . ($discount->is_percentage ? '%' : '') . ')', 'amount' => $amount];
                    }
                    break;

                case 'total':
                    if ($subtotal >= $discount->condition_value) {
                        $amount = $this->applyDiscount($discount, $subtotal);
                        $discountTotal += $amount;
                        $subtotal -= $amount;
                        $discountDetails[] = ['name' => $discount->name . ' (' . $discount->discount_value . ($discount->is_percentage ? '%' : '') . ')', 'amount' => $amount];
                    }
                    break;

                case 'user_type':
                    if ($userType === $discount->condition_value) {
                        $amount = $this->applyDiscount($discount, $subtotal);
                        $discountTotal += $amount;
                        $subtotal -= $amount;
                        $discountDetails[] = ['name' => $discount->name . ' (' . $discount->discount_value . ($discount->is_percentage ? '%' : '') . ')', 'amount' => $amount];
                    }
                    break;
            }
        }

        return [
            'discountTotal' => $discountTotal,
            'discountDetails' => $discountDetails
        ];
    }

    public function applyDiscount($discount, $subtotal)
    {
        return $discount->is_percentage
            ? $subtotal * ($discount->discount_value / 100)
            : $discount->discount_value;
    }
}
