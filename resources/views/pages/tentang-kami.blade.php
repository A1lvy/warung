<x-layouts.app title="Tentang Kami" :active="'tentang-kami'">

    <div class="max-w-screen-xl mx-auto px-8 py-14">
        <div class="flex flex-col md:flex-row gap-14">

            <!-- Left: Text Content -->
            <div class="flex-1">
                <h1 class="font-bold text-[#2b2925] text-5xl leading-tight mb-10">TENTANG SEMBAKOCI</h1>

                <p class="text-[#615a57] text-xl font-semibold leading-relaxed mb-10 max-w-sm">
                    Warung ini pertama kali didirikan pada tahun 2015 oleh Ibu Sari dengan tujuan untuk memenuhi kebutuhan pokok para warga setempat.
                </p>

                <h3 class="font-bold text-[#2b2925] text-2xl mb-5">VISI MISI</h3>

                <p class="text-[#615a57] text-xl font-semibold leading-relaxed max-w-sm">
                    Menjadi warung sembako terpercaya dan andalan utama keluarga di Cileungsi Indah yang menghadirkan kemudahan belanja kebutuhan pokok melalui layanan antar cepat, ramah, dan terjangkau.
                </p>
            </div>

            <!-- Right: Image -->
            <div class="flex-1 flex justify-end">
                <div class="w-full max-w-sm h-[620px] bg-[#d9d9d9] rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/product-hero.png') }}" alt="Tentang Sembakoci"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
