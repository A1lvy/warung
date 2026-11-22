<x-layouts.app title="Belanja" :active="'belanja'">

    <div class="max-w-screen-xl mx-auto px-8 py-12">

        <!-- Section 1: Pilihan Sembako -->
        <section class="mb-14">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-[#2b2925] text-xl">Pilihan sembako</h2>
                <button class="w-10 h-10 rounded-full bg-[#2b2925] flex items-center justify-center hover:bg-[#3d3730] transition-colors" aria-label="Lihat lebih">
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="→" class="w-6 h-6"
                         onerror="this.outerHTML='<svg class=\'w-5 h-5 text-white\' fill=\'none\' stroke=\'white\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 5l7 7-7 7\'/></svg>'">
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @php
                $products = [
                    ['name' => 'Minyak goreng', 'price' => 'IDR 11.500'],
                    ['name' => 'Gula pasir',    'price' => 'IDR 11.500'],
                    ['name' => 'Tepung terigu', 'price' => 'IDR 11.500'],
                    ['name' => 'Beras',         'price' => 'IDR 11.500'],
                    ['name' => 'Garam',         'price' => 'IDR 11.500'],
                ];
                @endphp

                @foreach($products as $product)
                <div class="flex flex-col">
                    <div class="rounded-xl overflow-hidden mb-3">
                        <img src="{{ asset('images/product-card.png') }}" alt="{{ $product['name'] }}"
                             class="w-full h-52 object-cover rounded-xl"
                             onerror="this.closest('div').classList.add('bg-[#d9d9d9]'); this.style.display='none'">
                    </div>
                    <p class="text-[#615a57] text-2xl font-normal leading-tight">{{ $product['name'] }}</p>
                    <p class="text-[#615a57] text-base mt-1">{{ $product['price'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Section 2: Banyak Jenis Pilihan Lain -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-[#2b2925] text-xl">Banyak jenis pilihan lain</h2>
                <button class="w-10 h-10 rounded-full bg-[#2b2925] flex items-center justify-center hover:bg-[#3d3730] transition-colors" aria-label="Lihat lebih">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
                @php
                $moreProducts = [
                    ['name' => 'Tepung terigu',  'price' => 'IDR 11.500'],
                    ['name' => 'Mie instan',     'price' => 'IDR 11.500'],
                    ['name' => 'Kecap manis',    'price' => 'IDR 11.500'],
                    ['name' => 'Saus tomat',     'price' => 'IDR 11.500'],
                    ['name' => 'Kopi sachet',    'price' => 'IDR 11.500'],
                    ['name' => 'Sabun mandi',    'price' => 'IDR 11.500'],
                ];
                @endphp

                @foreach($moreProducts as $product)
                <a href="{{ route('checkout') }}" class="flex flex-col group">
                    <div class="rounded-xl overflow-hidden mb-2">
                        <img src="{{ asset('images/product-card.png') }}" alt="{{ $product['name'] }}"
                             class="w-full h-44 object-cover rounded-xl group-hover:scale-105 transition-transform duration-200"
                             onerror="this.closest('div').classList.add('bg-[#d9d9d9]'); this.style.display='none'">
                    </div>
                    <p class="text-[#615a57] text-2xl font-normal leading-tight">{{ $product['name'] }}</p>
                    <p class="text-[#615a57] text-base mt-1">{{ $product['price'] }}</p>
                </a>
                @endforeach
            </div>
        </section>

    </div>

</x-layouts.app>
