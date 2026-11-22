<x-layouts.app title="Belanja" :active="'belanja'">

    <div class="max-w-screen-xl mx-auto px-8 py-12">

        <!-- Section 1: Pilihan Sembako -->
        <section class="mb-14">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-[#2b2925] text-xl">{{ $sembakoCategory?->name ?? 'Pilihan sembako' }}</h2>
                <button class="w-10 h-10 rounded-full bg-[#2b2925] flex items-center justify-center hover:bg-[#3d3730] transition-colors" aria-label="Lihat lebih">
                    <img src="{{ asset('images/arrow-right.svg') }}" alt="→" class="w-6 h-6"
                         onerror="this.outerHTML='<svg class=\'w-5 h-5 text-white\' fill=\'none\' stroke=\'white\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 5l7 7-7 7\'/></svg>'">
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($sembakoProducts as $product)
                    <form action="{{ route('cart.add') }}" method="POST" class="block">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full text-left cursor-pointer group" title="Tambah {{ $product->name }} ke keranjang">
                            <x-product-card :product="$product" variant="simple" />
                        </button>
                    </form>
                @empty
                    <p class="text-[#615a57] col-span-full">Belum ada produk sembako.</p>
                @endforelse
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
                @forelse($otherProducts as $product)
                    <form action="{{ route('cart.add') }}" method="POST" class="block">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full text-left cursor-pointer group" title="Tambah {{ $product->name }} ke keranjang">
                            <x-product-card :product="$product" variant="simple" />
                        </button>
                    </form>
                @empty
                    <p class="text-[#615a57] col-span-full">Belum ada pilihan produk lainnya.</p>
                @endforelse
            </div>
        </section>

    </div>

</x-layouts.app>
