<?php

namespace App\Livewire\Product;

use Livewire\Component;

use App\Models\Products\Product;

class ProductCard extends Component
{
    public Product $product;
    public $productAttributes;
    public bool $selected;
    public array $selectedOptions = [];

    public function toggleSelection()
    {
        $this->selected = !$this->selected;
        $this->dispatch('toggle-product', productId: $this->product->id);
    }

    public function selectOption(int $attributeId, $optionId)
    {
        $optionId = $optionId !== '' ? (int) $optionId : null;
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