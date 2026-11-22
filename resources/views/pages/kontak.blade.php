<x-layouts.app title="Kontak" :active="'kontak'">

    <div class="max-w-screen-xl mx-auto px-8 py-14">
        <div class="flex flex-col md:flex-row gap-14">

            <!-- Left: Contact Content -->
            <div class="flex-1">
                <h1 class="font-bold text-[#2b2925] text-5xl leading-tight mb-10 max-w-lg">
                    PUNYA PERTANYAAN TENTANG KAMI?
                </h1>

                <p class="text-[#615a57] text-xl font-semibold leading-relaxed mb-8 max-w-sm">
                    Kami ada untuk membantu anda dengan kemudahan.
                </p>

                <h3 class="font-bold text-[#2b2925] text-xl mb-6">HUBUNGI KAMI LEWAT</h3>

                <div class="flex items-center gap-6">
                    <a href="#" aria-label="WhatsApp" class="hover:opacity-70 transition-opacity">
                        <img src="{{ asset('images/social-whatsapp.png') }}" alt="WhatsApp" class="w-9 h-9 object-cover">
                    </a>
                    <a href="#" aria-label="Instagram" class="hover:opacity-70 transition-opacity">
                        <img src="{{ asset('images/social-instagram.png') }}" alt="Instagram" class="w-9 h-9 object-cover">
                    </a>
                    <a href="#" aria-label="TikTok" class="hover:opacity-70 transition-opacity">
                        <img src="{{ asset('images/social-tiktok.png') }}" alt="TikTok" class="w-9 h-9 object-cover">
                    </a>
                </div>
            </div>

            <!-- Right: Image -->
            <div class="flex-1 flex justify-end">
                <div class="w-full max-w-sm h-64 bg-[#d9d9d9] rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/product-hero.png') }}" alt="Kontak Sembakoci"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
