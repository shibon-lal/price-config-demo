<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class ProductSummary extends Component
{
    #[Reactive]
    public $priceBreakdowns;
    #[Reactive]
    public $totalPrice;

    public function render()
    {
        return view('livewire.product.product-summary');
    }
}
