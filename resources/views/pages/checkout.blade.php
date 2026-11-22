<x-layouts.app title="Checkout" :active="'checkout'">

    <div class="max-w-screen-xl mx-auto px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">

            <!-- Left: Form -->
            <div class="flex-1">
                <form action="#" method="POST" class="space-y-8">
                    @csrf

                    <!-- Contact Info -->
                    <div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-bold text-[#2b2925] text-2xl mb-3">Nama</label>
                                <input type="text" name="nama" placeholder="Nama lengkap"
                                       class="w-full border border-[#2b2925]/30 rounded-xl px-4 py-3 bg-white/60 text-[#2b2925] text-base outline-none focus:border-[#2b2925] transition-colors">
                            </div>
                            <div>
                                <label class="block font-bold text-[#2b2925] text-2xl mb-3">Nomor</label>
                                <input type="tel" name="nomor" placeholder="Nomor WhatsApp"
                                       class="w-full border border-[#2b2925]/30 rounded-xl px-4 py-3 bg-white/60 text-[#2b2925] text-base outline-none focus:border-[#2b2925] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block font-bold text-[#2b2925] text-2xl mb-3">Alamat</label>
                        <input type="text" name="alamat" placeholder="Alamat lengkap pengiriman"
                               class="w-full border border-[#2b2925]/30 rounded-xl px-4 py-3 bg-white/60 text-[#2b2925] text-base outline-none focus:border-[#2b2925] transition-colors">
                    </div>

                    <!-- Pesan/Note -->
                    <div>
                        <label class="block font-bold text-[#2b2925] text-2xl mb-3">Pesan</label>
                        <textarea name="pesan" rows="4" placeholder="Catatan tambahan (opsional)"
                                  class="w-full border border-[#2b2925]/30 rounded-xl px-4 py-3 bg-white/60 text-[#2b2925] text-base outline-none focus:border-[#2b2925] transition-colors resize-none"></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <h3 class="font-bold text-[#2b2925] text-2xl mb-5">Metode Pembayaran</h3>
                        <div class="flex items-center gap-5 flex-wrap">
                            <label class="cursor-pointer">
                                <input type="radio" name="payment" value="dana" class="sr-only peer">
                                <div class="border-2 border-transparent peer-checked:border-[#2b2925] rounded-xl p-2 hover:border-[#b9ac99] transition-colors">
                                    <img src="{{ asset('images/product-card.png') }}" alt="DANA"
                                         class="w-16 h-16 object-contain"
                                         onerror="this.closest('div').querySelector('span') ? '' : this.insertAdjacentHTML('afterend', '<span class=\'font-bold text-sm text-[#2b2925]\'>DANA</span>')">
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment" value="gopay" class="sr-only peer">
                                <div class="border-2 border-transparent peer-checked:border-[#2b2925] rounded-xl p-2 hover:border-[#b9ac99] transition-colors">
                                    <div class="w-16 h-16 bg-[#d9d9d9] rounded-lg flex items-center justify-center">
                                        <span class="font-bold text-xs text-[#2b2925]">GoPay</span>
                                    </div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment" value="ovo" class="sr-only peer">
                                <div class="border-2 border-transparent peer-checked:border-[#2b2925] rounded-xl p-2 hover:border-[#b9ac99] transition-colors">
                                    <div class="w-16 h-16 bg-[#d9d9d9] rounded-lg flex items-center justify-center">
                                        <span class="font-bold text-xs text-[#2b2925]">OVO</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <p class="text-[#615a57] text-xl font-semibold mt-4">Bayar di tempat</p>
                    </div>

                </form>
            </div>

            <!-- Divider -->
            <div class="hidden lg:block w-px bg-[#2b2925]/20"></div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-96">
                <h3 class="font-bold text-[#2b2925] text-2xl mb-6">Rincian</h3>

                <!-- Product Row -->
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-36 h-36 bg-[#d9d9d9] rounded-xl overflow-hidden shrink-0">
                        <img src="{{ asset('images/product-card.png') }}" alt="Tepung terigu"
                             class="w-full h-full object-cover"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="flex-1">
                        <p class="text-[#2b2925] text-xl font-normal">Tepung terigu</p>
                        <p class="text-[#615a57] text-sm">(1)</p>
                    </div>
                    <div class="text-right">
                        <button class="text-[#615a57] hover:text-[#2b2925] transition-colors" aria-label="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <p class="text-[#615a57] text-sm mt-2">IDR 11.500</p>
                    </div>
                </div>

                <!-- Totals -->
                <div class="space-y-3 py-6 border-t border-[#2b2925]/20">
                    <div class="flex justify-between">
                        <span class="text-[#2b2925] text-xl font-normal">Subtotal</span>
                        <span class="text-[#615a57] text-base">IDR 11.500</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#2b2925] text-xl font-normal">Ongkir</span>
                        <span class="text-[#615a57] text-base">IDR 500</span>
                    </div>
                </div>
                <div class="flex justify-between py-4 border-t border-[#2b2925]/20">
                    <span class="font-bold text-[#2b2925] text-xl">Total</span>
                    <span class="text-[#615a57] text-base">IDR 12.000</span>
                </div>

                <!-- Order Button -->
                <button type="submit" form=""
                        class="mt-6 block w-full bg-[#2b2925] text-[#efe9de] font-bold text-xl rounded-[40px] px-8 py-4 text-center hover:bg-[#3d3730] transition-colors duration-200">
                    Pesan Sekarang
                </button>
            </div>
        </div>
    </div>

</x-layouts.app>
