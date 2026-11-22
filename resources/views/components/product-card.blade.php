@props([
    'product' => null,
    'name' => null,
    'price' => null,
    'unit' => null,
    'image' => null,
    'stock' => null,
    'slug' => null,
    'showOrder' => true,
    'variant' => 'default', // 'default', 'viral', 'simple'
])

@php
    $productName = $product?->name ?? $name ?? 'Produk';
    $productPrice = $product ? $product->formatted_price : ($price ?? 'IDR 11.500');
    $productImage = $product?->image_path ?? $image ?? 'images/product-card.png';
    $productUnit = $product?->unit ?? $unit;
    $productStock = $product?->stock ?? $stock ?? 99;
    $productSlug = $product?->slug ?? $slug;
    $productId = $product?->id;
@endphp

@if($variant === 'viral')
    <!-- Viral Variant (Homepage) -->
    <div class="flex flex-col items-center">
        <div class="relative w-[300px] h-[300px]">
            <img src="{{ asset('images/ellipse-bg.svg') }}" alt=""
                 class="absolute inset-0 w-full h-full object-contain"
                 onerror="this.style.display='none'">
            <div class="absolute inset-6 rounded-full overflow-hidden">
                <img src="{{ asset($productImage) }}" alt="{{ $productName }}"
                     class="w-full h-full object-cover"
                     onerror="this.onerror=null; this.src='{{ asset('images/product-hero.png') }}';">
            </div>
        </div>
        <p class="text-[#615a57] text-2xl mt-4 font-normal">{{ $productName }}</p>
        <p class="text-[#615a57] text-base">{{ $productPrice }}</p>
        @if($showOrder && $productId)
        <form action="{{ route('cart.add') }}" method="POST" class="mt-3 flex items-center gap-2 w-full max-w-xs">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productId }}">
            <div class="qty-control flex items-center border border-[#2b2925] rounded-xl overflow-hidden">
                <button type="button" class="qty-decrease px-3 py-2 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors text-sm font-bold cursor-pointer">&minus;</button>
                <input type="number" name="quantity" class="qty-input w-10 text-center text-sm bg-transparent border-none outline-none text-[#2b2925]" value="1" min="1" max="{{ $productStock }}" readonly>
                <button type="button" class="qty-increase px-3 py-2 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors text-sm font-bold cursor-pointer">+</button>
            </div>
            <button type="submit"
               class="bg-[#2b2925] text-[#efe9de] font-bold text-base rounded-[40px] px-6 py-2 hover:bg-[#3d3730] transition-colors flex-1 text-center cursor-pointer">
                Pesan
            </button>
        </form>
        @endif
    </div>
@elseif($variant === 'simple')
    <!-- Simple Variant (Catalog Grid) -->
    <div class="flex flex-col group">
        <div class="rounded-xl overflow-hidden mb-3 bg-[#d9d9d9]">
            <img src="{{ asset($productImage) }}" alt="{{ $productName }}"
                 class="w-full h-52 object-cover rounded-xl group-hover:scale-105 transition-transform duration-200"
                 onerror="this.onerror=null; this.src='{{ asset('images/product-card.png') }}';">
        </div>
        <p class="text-[#615a57] text-2xl font-normal leading-tight">{{ $productName }}</p>
        <p class="text-[#615a57] text-base mt-1">{{ $productPrice }}</p>
    </div>
@else
    <!-- Default Card Variant -->
    <div class="product-card bg-white rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-200">
        <div class="relative overflow-hidden rounded-xl bg-[#d9d9d9]">
            <img src="{{ asset($productImage) }}" alt="{{ $productName }}"
                 class="w-full h-48 object-cover rounded-xl"
                 onerror="this.onerror=null; this.src='{{ asset('images/product-card.png') }}';">
        </div>
        <div class="p-3">
            <p class="text-[#615a57] text-xl font-normal leading-tight">{{ $productName }}</p>
            <p class="text-[#615a57] text-sm mt-1">{{ $productPrice }}</p>
            @if($showOrder && $productId)
            <form action="{{ route('cart.add') }}" method="POST" class="mt-3 flex items-center gap-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productId }}">
                <div class="qty-control flex items-center border border-[#2b2925] rounded-xl overflow-hidden">
                    <button type="button" class="qty-decrease px-3 py-2 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors text-sm font-bold cursor-pointer">
                        &minus;
                    </button>
                    <input type="number" name="quantity" class="qty-input w-10 text-center text-sm border-none outline-none bg-transparent text-[#2b2925]" value="1" min="1" max="{{ $productStock }}" readonly>
                    <button type="button" class="qty-increase px-3 py-2 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors text-sm font-bold cursor-pointer">
                        +
                    </button>
                </div>
                <button type="submit" class="btn-primary text-sm py-2 px-5 rounded-[40px] text-center flex-1 text-center cursor-pointer">
                    Pesan
                </button>
            </form>
            @endif
        </div>
    </div>
@endif
