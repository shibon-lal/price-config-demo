<?php

namespace App\Livewire\Product;

use Livewire\Component;

use App\Models\Products\Product;



use Illuminate\Support\Facades\Log;

class ProductCard extends Component
{
    public Product $product;
    public $productAttributes;
    public bool $selected;
    public array $selectedOptions = [];

    /*public function mount($product, $productAttributes, $selected, $selectedOptions)
    {
        Log::info('SQL mount card:');
        $this->product = $product;
        $this->productAttributes = $productAttributes;
        $this->selected = $selected;
        $this->selectedOptions = $selectedOptions;
        Log::info('SQL mount card end:');
    } */

    public function toggleSelection()
    {
        $this->selected = !$this->selected;
        $this->dispatch('toggle-product', productId: $this->product->id);
    }

    public function selectOption(int $attributeId, ?int $optionId)
    {
        $this->dispatch('update-selected-option', 
            productId: $this->product->id,
            attributeId: $attributeId,
            optionId: $optionId,
        );
    }

    public function render()
    {
        return view('livewire.product.product-card');
    }
}