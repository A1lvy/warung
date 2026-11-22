<x-layouts.app title="Pelayanan" :active="'pelayanan'">

    <!-- Hero Banner -->
    <section class="py-6 px-8 bg-[#efe9de]">
        <div class="max-w-screen-xl mx-auto">
            <div class="w-full h-80 bg-[#d9d9d9] rounded-2xl overflow-hidden">
                <img src="{{ asset('images/product-hero.png') }}" alt="Pelayanan Sembakoci"
                     class="w-full h-full object-cover"
                     onerror="this.style.display='none'">
            </div>
        </div>
    </section>

    <!-- Service Info Section -->
    <section class="py-14 px-8 bg-[#efe9de]">
        <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row gap-12">

            <!-- Left: Heading + Jam Operasional -->
            <div class="flex-1">
                <h2 class="font-bold text-[#2b2925] text-4xl mb-10">KAMI ADA DEMI KEMUDAHAN</h2>

                <div class="flex items-start gap-6">
                    <!-- Clock/schedule image -->
                    <div class="w-48 h-44 bg-[#d9d9d9] rounded-xl overflow-hidden shrink-0 flex items-center justify-center">
                        <svg class="w-16 h-16 text-[#b9ac99]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
                            <path d="M12 6v6l4 2" stroke-linecap="round" stroke-width="1.5"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-bold text-[#2b2925] text-2xl mb-3">Jam operasional</h3>
                        <p class="text-[#615a57] text-xl font-semibold leading-relaxed max-w-md">
                            Warung kami buka setiap hari mulai dari pukul 06:00 Wib s/d 21:30 Wib.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Description -->
            <div class="flex-1 flex items-start">
                <p class="text-[#615a57] text-xl font-semibold leading-relaxed max-w-lg mt-2">
                    Kami percaya bahwa pelayanan yang kami berikan sangat berguna terutama untuk ibu-ibu yang sedang sibuk.
                </p>
            </div>
        </div>
    </section>

</x-layouts.app>
