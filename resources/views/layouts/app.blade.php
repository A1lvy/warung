<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sembakoci' }} – Warung Sembako</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#efe9de] text-[#2b2925] font-[Source_Serif_Pro,serif] antialiased">

    <!-- Navigation -->
    <x-navbar :active="$active ?? ''" />

    <!-- Flash Alerts -->
    @if(session('success'))
        <div class="max-w-screen-xl mx-auto px-8 pt-6">
            <div class="p-4 rounded-xl bg-[#2b2925] text-[#efe9de] flex items-center justify-between shadow-md">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.closest('.max-w-screen-xl').remove()" class="text-[#efe9de]/70 hover:text-white font-bold p-1">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-screen-xl mx-auto px-8 pt-6">
            <div class="p-4 rounded-xl bg-red-800 text-white flex items-center justify-between shadow-md">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.closest('.max-w-screen-xl').remove()" class="text-white/70 hover:text-white font-bold p-1">&times;</button>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

</body>
</html>
