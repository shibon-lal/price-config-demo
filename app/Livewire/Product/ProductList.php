<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\On; 


use App\Models\Products\Product;
use App\Models\Products\Attribute;
use App\Models\Products\Discount;

use App\Services\Product\ProductService;


use Illuminate\Support\Facades\Log;


class ProductList extends Component
{
    public string $userType = 'normal';
    public array $selectedProducts = [];
    public array $selectedOptions = [];
    public array $priceBreakdowns = [];
    public $productAttributes;
    public $products;
    public $discounts;
    
    public function mount()
    {
        Log::info('SQL mount:');
        $this->priceBreakdowns = [];
        $this->productAttributes = Attribute::with('options')->get();
        $this->products = Product::all();
        $this->discounts = Discount::orderBy('apply_order', 'asc')->get();
        Log::info('SQL mount end:');
    }

    public function updatedUserType()
    {
        $this->calculatePrices();
    }

    #[On('toggle-product')] 
    public function toggleProduct(int $productId)
    {
        if (isset($this->selectedProducts[$productId])) {
            unset($this->selectedProducts[$productId]);
            unset($this->selectedOptions[$productId]);
        } else {
            $this->selectedProducts[$productId] = true;
            $this->selectedOptions[$productId] = [];
        }
        $this->calculatePrices();
    }

    #[On('update-selected-option')]
    public function updateSelectedOption(int $productId, int $attributeId, ?int $optionId)
    {
        if ($optionId === null || $optionId === '') {
            unset($this->selectedOptions[$productId][$attributeId]);
        } else {
            $this->selectedOptions[$productId][$attributeId] = $optionId;
        }
        $this->calculatePrices();
    }

    public function calculatePrices()
    {
        $this->priceBreakdowns = [];
        
        Log::info('SQL calculatePrices:');

        foreach ($this->selectedProducts as $productId => $selected) {
            $product = $this->products->find($productId);
            $basePrice = $product->base_price;
            $attributePrices = 0;
            $attributeDetails = [];

            // Calculate attribute additions
            foreach ($this->selectedOptions[$productId] ?? [] as $attributeId => $optionId) {
                if(empty($attributeId) || empty($optionId)) {
                    continue;
                }
                $attribute = $this->productAttributes->find($attributeId);
                $option = $attribute->options->find($optionId);
                $attributePrices += $option->price;
                $attributeDetails[] = [
                    'name' => $attribute->name . ': ' . $option->name,
                    'price' => $option->price,
                    'option_id' => $option->id,
                ];
            }
            $subtotal = $basePrice + $attributePrices;

            $discountResult = app(ProductService::class)->calculateDiscount($subtotal, $this->discounts, $this->userType, $attributeDetails);
            $finalPrice = $subtotal - $discountResult['discountTotal'];

            $this->priceBreakdowns[$productId] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'base_price' => $basePrice,
                'attributes' => $attributeDetails,
                'subtotal' => $subtotal,
                'discounts' => $discountResult['discountDetails'],
                'total_discount' => $discountResult['discountTotal'],
                'final_price' => $finalPrice,
            ];
        }

        Log::info('SQL calculatePrices end:');
    }

    public function getTotalPriceProperty()
    {
        return collect($this->priceBreakdowns)->sum('final_price');
    }

    public function render()
    {
        return view('livewire.product.product-list', [
            'products' => $this->products,
            'productAttributes' => $this->productAttributes,
        ]);
    }
}