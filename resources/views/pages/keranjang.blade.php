<x-layouts.app title="Keranjang" :active="'keranjang'">

    <div class="max-w-screen-xl mx-auto px-8 py-12">
        <h2 class="font-bold text-[#2b2925] text-xl mb-8">
            List keranjang belanjamu
            <span class="text-base font-normal text-[#615a57]">(1)</span>
        </h2>

        <!-- Cart Items -->
        <div class="border-b border-[#2b2925]/20 pb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <!-- Product Image -->
                <div class="w-44 h-44 rounded-xl overflow-hidden shrink-0 bg-[#d9d9d9]">
                    <img src="{{ asset('images/product-card.png') }}" alt="Tepung terigu"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'">
                </div>

                <!-- Product Info -->
                <div class="flex-1">
                    <p class="text-[#2b2925] text-2xl font-normal">Tepung terigu</p>
                </div>

                <!-- Quantity -->
                <div class="flex items-center gap-4">
                    <div class="qty-control flex items-center border border-[#2b2925] rounded-xl overflow-hidden">
                        <button class="qty-decrease px-4 py-3 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors font-bold">&minus;</button>
                        <input type="number" class="qty-input w-12 text-center bg-transparent border-none outline-none text-[#2b2925] text-base" value="1" min="0" readonly>
                        <button class="qty-increase px-4 py-3 text-[#2b2925] hover:bg-[#2b2925] hover:text-[#efe9de] transition-colors font-bold">+</button>
                    </div>
                </div>

                <!-- Price -->
                <div class="text-right">
                    <p class="text-[#615a57] text-base">IDR 11.500</p>
                </div>

                <!-- Remove -->
                <button class="text-[#615a57] hover:text-[#2b2925] transition-colors p-2" aria-label="Hapus">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Summary -->
        <div class="mt-8 flex justify-end">
            <div class="w-full max-w-xs">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-bold text-[#2b2925] text-base uppercase">SUBTOTAL:</span>
                    <span class="text-[#615a57] text-base">IDR 11.500</span>
                </div>
                <a href="{{ route('checkout') }}"
                   class="block w-full bg-[#2b2925] text-[#efe9de] font-bold text-xl rounded-[40px] px-8 py-4 text-center hover:bg-[#3d3730] transition-colors duration-200">
                    Pesan
                </a>
            </div>
        </div>
    </div>

</x-layouts.app>
