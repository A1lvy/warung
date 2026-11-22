<x-layouts.app title="Beranda" :active="'home'">

    <!-- Hero Section -->
    <section class="bg-[#b9ac99] min-h-[600px] relative overflow-hidden">
        <div class="max-w-screen-xl mx-auto px-8 py-16 flex flex-col md:flex-row items-center gap-12">
            <!-- Left content -->
            <div class="flex-1 z-10">
                <h1 class="font-bold text-[#2b2925] text-5xl leading-tight mb-8">
                    MENYEDIAKAN BERBAGAI MACAM JENIS SEMBAKO
                </h1>
                <p class="text-[#615a57] text-xl font-semibold mb-10 max-w-sm leading-relaxed">
                    Anti kadaluarsa, beraneka ragam, dan khusus di daerah Cileungsi Indah pesanan bisa diantar ke depan pintu rumah anda, proses cepat.
                </p>
                <a href="{{ route('belanja') }}"
                   class="bg-[#2b2925] text-[#b9ac99] font-bold text-xl rounded-[40px] px-10 py-4 hover:bg-[#3d3730] transition-colors duration-200 inline-block">
                    Pesan
                </a>
            </div>

            <!-- Right image -->
            <div class="flex-1 flex justify-center items-center">
                <div class="w-full max-w-lg h-[480px] bg-[#d9d9d9] rounded-2xl overflow-hidden relative">
                    <img src="{{ asset('images/product-hero.png') }}" alt="Produk Sembako"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.parentElement.classList.add('bg-[#d9d9d9]')">
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Viral Section -->
    <section class="py-16 px-8 bg-[#efe9de]">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex items-center justify-between mb-10">
                <h2 class="font-bold text-[#2b2925] text-4xl">PRODUK YANG LAGI VIRAL</h2>
                <a href="{{ route('belanja') }}" class="text-[#615a57] text-base hover:underline">Lihat semua</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($viralProducts as $product)
                    <x-product-card :product="$product" variant="viral" />
                @empty
                    <p class="text-[#615a57] text-lg col-span-3 text-center">Belum ada produk viral saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tentang Kami Preview Section -->
    <section class="py-16 px-8 bg-[#efe9de]">
        <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row items-start gap-12">
            <!-- Left: Text -->
            <div class="flex-1">
                <h2 class="font-bold text-[#2b2925] text-5xl leading-tight mb-6">TENTANG KAMI</h2>
                <p class="text-[#615a57] text-xl font-semibold leading-relaxed mb-8 max-w-lg">
                    Warung sembako terlengkap dan khusus di daerah Cileungsi Indah dan sekitarnya, kami siap mengantar pesanan anda.
                </p>
                <a href="{{ route('tentang-kami') }}"
                   class="bg-[#2b2925] text-[#efe9de] font-bold text-xl rounded-[40px] px-10 py-4 hover:bg-[#3d3730] transition-colors duration-200 inline-block">
                    Pelajari lebih lanjut
                </a>

                <!-- Bottom image placeholder -->
                <div class="mt-10 w-full max-w-lg h-[260px] bg-[#d9d9d9] rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/product-hero.png') }}" alt="Tentang Sembakoci"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'">
                </div>
            </div>

            <!-- Right: Image -->
            <div class="flex-1 flex justify-end">
                <div class="w-[420px] h-[400px] bg-[#d9d9d9] rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/product-hero.png') }}" alt="Tentang Sembakoci"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
