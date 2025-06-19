 <div class="mt-8 p-6 bg-blue-50 rounded-lg">
     <h2 class="text-xl font-semibold mb-4 text-gray-800">Order Summary</h2>
     <div class="space-y-4">
         @foreach ($priceBreakdowns as $breakdown)
             <div class="border-b pb-4 last:border-b-0 last:pb-0">
                 <div class="flex justify-between items-start">
                     <div>
                         <h3 class="font-bold">{{ $breakdown['product_name'] }}</h3>
                         <span>Product final price : {{ number_format($breakdown['final_price'], 2) }} KD</span>
                     </div>
                 </div>

                 <div class="mt-2 pl-4 space-y-1">
                     <div class="flex justify-between text-sm">
                         <span class="text-gray-600">Base: </span>
                         <span>{{ number_format($breakdown['base_price'], 2) }} KD</span>
                     </div>
                 </div>
                 @if (count($breakdown['attributes']) > 0)
                     <div class="mt-2 pl-4 space-y-1">
                         @foreach ($breakdown['attributes'] as $attribute)
                             <div class="flex justify-between text-sm">
                                 <span class="text-gray-600">{{ $attribute['name'] }}:</span>
                                 <span>{{ $attribute['price'] > 0 ? '+' : '' }}{{ number_format($attribute['price'], 2) }}
                                     KD</span>
                             </div>
                         @endforeach
                     </div>
                 @endif
                 @if ($breakdown['subtotal'] > 0)
                     <div class="mt-2 pl-4 space-y-1">
                         <div class="flex justify-between text-sm">
                             <span class="text-gray-600">Subtotal :</span>
                             <span>{{ number_format($breakdown['subtotal'], 2) }} KD</span>
                         </div>
                     </div>
                 @endif

                 @if (count($breakdown['discounts']) > 0)
                     <div class="mt-2 pl-4 space-y-1">
                         @foreach ($breakdown['discounts'] as $discount)
                             <div class="flex justify-between text-sm text-red-600">
                                 <span>{{ $discount['name'] }}:</span>
                                 <span>-{{ number_format($discount['amount'], 2) }} KD</span>
                             </div>
                         @endforeach
                     </div>
                 @endif
             </div>
         @endforeach

         <div class="pt-4 border-t mt-4">
             <div class="flex justify-between font-bold text-lg">
                 <span>Total Price:</span>
                 <span class="text-green-600">{{ number_format($totalPrice, 2) }} KD</span>
             </div>
         </div>
     </div>
 </div>
