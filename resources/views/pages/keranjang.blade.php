<x-layouts.app title="Keranjang" :active="'keranjang'">

    <div class="max-w-screen-xl mx-auto px-8 py-12">
        <h2 class="font-bold text-[#2b2925] text-xl mb-8">
            List keranjang belanjamu
            <span class="text-base font-normal text-[#615a57]">({{ $totalQuantity }})</span>
        </h2>

        @if($cartItems->isEmpty())
            <!-- Empty Cart State -->
            <div class="bg-white/60 rounded-2xl p-12 text-center max-w-lg mx-auto my-8 border border-[#2b2925]/10">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-[#b9ac99]/30 flex items-center justify-center">
                    <svg class="w-10 h-10 text-[#2b2925]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#2b2925] mb-2">Keranjang Belanja Kosong</h3>
                <p class="text-[#615a57] text-base mb-6">Kamu belum menambahkan sembako apapun ke dalam keranjang.</p>
                <a href="{{ route('belanja') }}" class="btn-primary text-base py-3 px-8 rounded-[40px]">
                    Mulai Belanja
                </a>
            </div>
        @else
            <!-- Cart Items -->
            <div class="space-y-6">
                @foreach($cartItems as $item)
                    @php $product = $item['product']; @endphp
                    <div class="border-b border-[#2b2925]/20 pb-8 flex flex-col md:flex-row items-start md:items-center gap-6">
                        <!-- Product Image -->
                        <div class="w-44 h-44 rounded-xl overflow-hidden shrink-0 bg-[#d9d9d9]">
                            <img src="{{ asset($product->image_path ?: 'images/product-card.png') }}" alt="{{ $product->name }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null; this.src='{{ asset('images/product-card.png') }}';">
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1">
                            <p class="text-[#2b2925] text-2xl font-normal">{{ $product->name }}</p>
                            <p class="text-[#615a57] text-sm mt-1">{{ $product->formatted_price }}{{ $product->unit ? ' / ' . $product->unit : '' }}</p>
                            @if($product->stock < 5)
                                <p class="text-xs text-amber-800 font-semibold mt-1">Sisa stok: {{ $product->stock }}</p>
                            @endif
                        </div>

                        <!-- Quantity -->
                        <div class="flex items-center gap-4">
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <div class="qty-control flex items-center border border-[#2b2925] rounded-xl overflow-hidden">
                                    <button type="submit" name="action" value="decrease" class="px-4 py-3 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors font-bold cursor-pointer" aria-label="Kurangi">&minus;</button>
                                    <span class="w-12 text-center text-[#2b2925] text-base font-semibold select-none">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="action" value="increase" class="px-4 py-3 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors font-bold cursor-pointer" aria-label="Tambah">&plus;</button>
                                </div>
                            </form>
                        </div>

                        <!-- Subtotal -->
                        <div class="text-right min-w-32">
                            <p class="text-[#615a57] text-base font-semibold">{{ $item['formatted_subtotal'] }}</p>
                        </div>

                        <!-- Remove -->
                        <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[#615a57] hover:text-red-700 transition-colors p-2 cursor-pointer" aria-label="Hapus {{ $product->name }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="mt-8 flex justify-end">
                <div class="w-full max-w-xs">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-bold text-[#2b2925] text-base uppercase">SUBTOTAL:</span>
                        <span class="text-[#615a57] text-xl font-bold">{{ $formattedTotal }}</span>
                    </div>
                    <a href="{{ route('checkout') }}"
                       class="block w-full bg-[#2b2925] text-[#efe9de] font-bold text-xl rounded-[40px] px-8 py-4 text-center hover:bg-[#3d3730] transition-colors duration-200">
                        Pesan
                    </a>
                </div>
            </div>
        @endif
    </div>

</x-layouts.app>
