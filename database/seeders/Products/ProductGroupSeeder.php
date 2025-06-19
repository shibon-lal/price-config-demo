<?php
namespace Database\Seeders\Products;
use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use App\Models\Products\Attribute;
use App\Models\Products\AttributeOption;
use App\Models\Products\Discount;

class ProductGroupSeeder extends Seeder
{
    public function run()
    {
        // Products
        $toyCar = Product::create([
            'name' => 'Toy Car',
            'base_price' => 100,
        ]);
        $toyBike = Product::create([
            'name' => 'Toy Bike',
            'base_price' => 150,
        ]);

        // Attributes & Options
        $delivery = Attribute::create(['name' => 'Delivery Method']);
        $atHome = AttributeOption::create(['attribute_id' => $delivery->id, 'name' => 'At Home', 'price' => 20]);
        $inLab  = AttributeOption::create(['attribute_id' => $delivery->id, 'name' => 'In Lab', 'price' => 0]);

        $speed = Attribute::create(['name' => 'Speed']);
        $sameDay = AttributeOption::create(['attribute_id' => $speed->id, 'name' => 'Same Day', 'price' => 30]);
        $nextDay = AttributeOption::create(['attribute_id' => $speed->id, 'name' => 'Next Day', 'price' => 10]);

        //can add a junction table to link product with attributes
        
        // Discounts can user insert also
        Discount::create([
            'name' => 'Off at Home',
            'condition_type' => 'attribute',
            'condition_key' => 'attribute_option_id',
            'condition_value' => $atHome->id,
            'is_percentage' => 1,
            'apply_order' => 1,
            'discount_value' => 5,
        ]);
        
        Discount::create([
            'name' => 'Off at Lab',
            'condition_type' => 'attribute',
            'condition_key' => 'attribute_option_id',
            'condition_value' => $inLab->id,
            'is_percentage' => 1,
            'apply_order' => 1,
            'discount_value' => 10,
        ]);

        Discount::create([
            'name' => 'Off for Next day delivery',
            'condition_type' => 'attribute',
            'condition_key' => 'attribute_option_id',
            'condition_value' => $nextDay->id,
            'is_percentage' => 1,
            'apply_order' => 1,
            'discount_value' => 2,
        ]);

        Discount::create([
            'name' => '20 % for user type company',
            'condition_type' => 'user_type',
            'condition_key' => 'user_type',
            'condition_value' => 'company',
            'is_percentage' => 1,
            'apply_order' => 2,
            'discount_value' => 20,
        ]);

        Discount::create([
            'name' => '10 over 130',
            'condition_type' => 'total',
            'condition_key' => 'min_total',
            'condition_value' => 130,
            'is_percentage' => 0,
            'apply_order' => 3,
            'discount_value' => 10,
        ]);

        
    }
}
