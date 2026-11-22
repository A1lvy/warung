@props(['active' => ''])

<nav class="bg-[#b9ac99] px-8 py-4 relative z-50">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="font-bold text-[#2b2925] text-xl tracking-wide hover:opacity-80 transition-opacity">
            SEMBAKOCI
        </a>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-8 text-base text-[#2b2925]">
            <a href="{{ route('pelayanan') }}"
               class="nav-link {{ $active === 'pelayanan' ? 'font-bold' : '' }} hover:opacity-70 transition-opacity">
                Pelayanan
            </a>
            <a href="{{ route('keranjang') }}"
               class="nav-link {{ $active === 'keranjang' ? 'font-bold' : '' }} hover:opacity-70 transition-opacity inline-flex items-center gap-1.5">
                <span>Keranjang</span>
                @if(($cartCount ?? 0) > 0)
                    <span class="bg-[#2b2925] text-[#efe9de] text-xs font-bold px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="{{ route('belanja') }}"
               class="nav-link {{ $active === 'belanja' ? 'font-bold' : '' }} hover:opacity-70 transition-opacity">
                Belanja
            </a>
            <a href="{{ route('tentang-kami') }}"
               class="nav-link {{ $active === 'tentang-kami' ? 'font-bold' : '' }} hover:opacity-70 transition-opacity">
                Tentang kami
            </a>
            <a href="{{ route('kontak') }}"
               class="nav-link {{ $active === 'kontak' ? 'font-bold' : '' }} hover:opacity-70 transition-opacity">
                Kontak
            </a>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" class="md:hidden p-2 text-[#2b2925]" aria-label="Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-[#b9ac99] border-t border-[#2b2925]/20 px-8 py-4 space-y-3">
        <a href="{{ route('pelayanan') }}" class="block text-[#2b2925] text-base hover:font-bold transition-all">Pelayanan</a>
        <a href="{{ route('keranjang') }}" class="flex items-center justify-between text-[#2b2925] text-base hover:font-bold transition-all">
            <span>Keranjang</span>
            @if(($cartCount ?? 0) > 0)
                <span class="bg-[#2b2925] text-[#efe9de] text-xs font-bold px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
            @endif
        </a>
        <a href="{{ route('belanja') }}" class="block text-[#2b2925] text-base hover:font-bold transition-all">Belanja</a>
        <a href="{{ route('tentang-kami') }}" class="block text-[#2b2925] text-base hover:font-bold transition-all">Tentang kami</a>
        <a href="{{ route('kontak') }}" class="block text-[#2b2925] text-base hover:font-bold transition-all">Kontak</a>
    </div>
</nav>
