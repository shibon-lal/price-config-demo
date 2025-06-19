<div @class([
    'shadow rounded-lg p-4 transition-all duration-200',
    'bg-blue-50 border-blue-500' => $selected,
    'bg-gray-50 hover:shadow-md hover:border-blue-300' => !$selected,
])>
    <!-- Product Header -->
    <div class="flex justify-between items-center cursor-pointer" wire:click="toggleSelection">
        <div>
            <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
            <p class="text-sm text-gray-600 font-bold">Base: {{ number_format($product->base_price, 2) }} KD</p>
        </div>
        <div class="flex items-center">
            <span class="mr-2 text-sm {{ $selected ? 'text-blue-600' : 'text-gray-500' }}">
                {{ $selected ? 'Selected' : 'Select' }}
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $selected ? 'text-blue-500' : 'text-gray-400' }}"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Attributes (shown when selected) -->
    @if ($selected)
        <div class="mt-4 space-y-4">
            @foreach ($productAttributes as $attribute)
                <div>
                    <label class="block text-gray-700 font-medium mb-2">{{ $attribute->name }}</label>
                    <div class="mb-4">
                        <select
                            class="w-full border border-gray-300 rounded p-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            wire:change="selectOption({{ $attribute->id }}, $event.target.value)">
                            <option value="">-- Select an option --</option>
                            @foreach ($attribute->options as $option)
                                <option value="{{ $option->id }}">
                                    {{ $option->name }}
                                    ({{ $option->price > 0 ? '+' : '' }}{{ number_format($option->price, 2) }} KD)
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Current Price -->
        {{-- @if ($selected)
            <div class="mt-4 pt-4 border-t">
                <div class="flex justify-between font-medium">
                    <span>Current Price:</span>
                    <span class="text-blue-600">
                        {{ number_format($product->base_price, 2) }} KD
                    </span>
                </div>
            </div>
        @endif --}}
    @endif

    @include('components.ui.loader')
</div>
