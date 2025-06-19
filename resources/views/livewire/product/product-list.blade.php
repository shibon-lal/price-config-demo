<div class="max-w-7xl mx-auto p-6">
    <!-- User Type Selection -->
    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
        <label class="block text-gray-700 font-medium mb-2">User Type</label>
        <div class="flex space-x-4">
            <label class="inline-flex items-center">
                <input type="radio" wire:model.live="userType" value="normal" class="form-radio h-5 w-5 text-blue-600">
                <span class="ml-2 text-gray-700">Normal User</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" wire:model.live="userType" value="company"
                    class="form-radio h-5 w-5 text-blue-600">
                <span class="ml-2 text-gray-700">Company User</span>
            </label>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <livewire:product.product-card :product="$product" :productAttributes="$productAttributes" :selected="isset($selectedProducts[$product->id])" :selectedOptions="$selectedOptions[$product->id] ?? []"
                :key="$product->id" />
        @endforeach
    </div>

    <!-- Order Summary -->
    @if (count($priceBreakdowns) > 0)
        <livewire:product.product-summary :priceBreakdowns="$priceBreakdowns" :totalPrice="$this->totalPrice" />
    @endif
    
    @include('components.ui.loader')
</div>
