@props(['name' => 'Produk', 'price' => 'IDR 11.500', 'image' => null, 'showOrder' => true])

<div class="product-card bg-white rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-200">
    <div class="relative overflow-hidden rounded-xl">
        @if($image)
            <img src="{{ asset($image) }}" alt="{{ $name }}"
                 class="w-full h-48 object-cover rounded-xl">
        @else
            <div class="w-full h-48 bg-[#d9d9d9] rounded-xl flex items-center justify-center">
                <svg class="w-12 h-12 text-[#b9ac99]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        @endif
    </div>
    <div class="p-3">
        <p class="text-[#615a57] text-xl font-normal">{{ $name }}</p>
        <p class="text-[#615a57] text-sm mt-1">{{ $price }}</p>
        @if($showOrder)
        <div class="mt-3 flex items-center gap-2">
            <div class="qty-control flex items-center border border-[#2b2925] rounded-xl overflow-hidden">
                <button class="qty-decrease px-3 py-2 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors text-sm font-bold">
                    &minus;
                </button>
                <input type="number" class="qty-input w-10 text-center text-sm border-none outline-none bg-transparent text-[#2b2925]" value="1" min="0" readonly>
                <button class="qty-increase px-3 py-2 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors text-sm font-bold">
                    +
                </button>
            </div>
            <a href="{{ route('checkout') }}" class="btn-primary text-sm py-2 px-5 rounded-[40px] text-center flex-1 text-center">
                Pesan
            </a>
        </div>
        @endif
    </div>
</div>
