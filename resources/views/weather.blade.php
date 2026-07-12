<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen transition-colors duration-300 bg-gradient-to-br from-slate-900 via-blue-900 to-blue-600 dark:from-slate-950 dark:via-slate-900 dark:to-slate-800 text-white font-sans antialiased">

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-4xl">

            <div class="bg-white/10 dark:bg-white/5 backdrop-blur-xl rounded-3xl border border-white/15 shadow-2xl p-6 sm:p-8 lg:p-10">

                {{-- Header --}}
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-white/15 rounded-2xl">
                            <svg class="w-8 h-8 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zm11.394-5.834a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight">Weather Dashboard</h1>
                            <p class="text-xs text-white/50">Powered by Open-Meteo API</p>
                        </div>
                    </div>

                    <button id="theme-toggle" type="button" class="p-2.5 bg-white/10 hover:bg-white/20 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/30" title="Toggle dark mode">
                        <svg id="icon-sun" class="w-5 h-5 text-yellow-300 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                        </svg>
                        <svg id="icon-moon" class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                        </svg>
                    </button>
                </div>

                <form method="GET" class="mb-6">
                    <div class="flex gap-3">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="city"
                                class="w-full h-12 pl-11 pr-4 bg-white/10 border border-white/15 rounded-xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-200"
                                placeholder="Cari nama kota..."
                                value="{{ $city }}"
                            >
                        </div>
                        <button type="submit" class="h-12 px-6 bg-blue-500 hover:bg-blue-400 active:bg-blue-600 rounded-xl font-semibold text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400/50 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                            <span class="hidden sm:inline">Cari</span>
                        </button>
                    </div>
                </form>

                <div id="history-container" class="mb-6 hidden">
                    <p class="text-xs text-white/40 mb-2 uppercase tracking-wider font-medium">Riwayat Pencarian</p>
                    <div id="history-chips" class="flex flex-wrap gap-2"></div>
                </div>

                @if($error)
                    <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                        <span class="text-red-300 text-sm">{{ $error }}</span>
                    </div>
                @endif

                @if($weather)

                    @php
                        $weatherCode = $weather['current_weather']['weathercode'];

                        if ($weatherCode == 0) {
                            $condition = 'Cerah';
                            $bgGradient = 'from-yellow-500/20 to-orange-500/10';
                        } elseif ($weatherCode <= 3) {
                            $condition = 'Berawan';
                            $bgGradient = 'from-blue-400/20 to-slate-500/10';
                        } elseif ($weatherCode <= 67) {
                            $condition = 'Hujan';
                            $bgGradient = 'from-blue-600/20 to-slate-700/10';
                        } elseif ($weatherCode <= 77) {
                            $condition = 'Bersalju';
                            $bgGradient = 'from-cyan-300/20 to-blue-400/10';
                        } else {
                            $condition = 'Tidak Diketahui';
                            $bgGradient = 'from-slate-500/20 to-slate-600/10';
                        }

                        $temp = round($weather['current_weather']['temperature']);
                        $windspeed = $weather['current_weather']['windspeed'];
                        $winddir = $weather['current_weather']['winddirection'];
                        $lat = number_format($weather['latitude'], 2);
                        $lon = number_format($weather['longitude'], 2);
                        $time = $weather['current_weather']['time'];
                    @endphp

                    <div class="bg-gradient-to-br {{ $bgGradient }} rounded-2xl border border-white/10 p-6 sm:p-8 mb-6">
                        <div class="flex flex-col sm:flex-row items-center gap-6">

                            <div class="text-center sm:text-left shrink-0">
                                @if($weatherCode == 0)
                                    <svg class="w-24 h-24 text-yellow-300 mx-auto sm:mx-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zm11.394-5.834a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                                    </svg>
                                @elseif($weatherCode <= 3)
                                    <svg class="w-24 h-24 text-blue-200 mx-auto sm:mx-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4.5 9.75a6 6 0 0111.573-2.226 3.75 3.75 0 014.133 4.303A4.5 4.5 0 0118 20.25H6.75a5.25 5.25 0 01-1.209-10.249 6 6 0 0111.47-2.226z"/>
                                    </svg>
                                @elseif($weatherCode <= 67)
                                    <svg class="w-24 h-24 text-blue-300 mx-auto sm:mx-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M1 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.376 4h7.248a2 2 0 011.664.89l.812 1.22A2 2 0 0019.07 7H20a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V9z" clip-rule="evenodd"/>
                                        <path d="M10.178 6.525a.75.75 0 01.622-.876l2.675-.445a.75.75 0 11.25 1.474l-2.675.445a.75.75 0 01-.872-.622zM9.504 8.01a.75.75 0 01.622-.875l2.675-.445a.75.75 0 11.25 1.474l-2.675.445a.75.75 0 01-.872-.622z"/>
                                    </svg>
                                @elseif($weatherCode <= 77)
                                    <svg class="w-24 h-24 text-cyan-200 mx-auto sm:mx-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M1 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.376 4h7.248a2 2 0 011.664.89l.812 1.22A2 2 0 0019.07 7H20a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V9z" clip-rule="evenodd"/>
                                        <path d="M12 9a3 3 0 100 6 3 3 0 000-6z"/>
                                    </svg>
                                @else
                                    <svg class="w-24 h-24 text-slate-300 mx-auto sm:mx-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4.5 9.75a6 6 0 0111.573-2.226 3.75 3.75 0 014.133 4.303A4.5 4.5 0 0118 20.25H6.75a5.25 5.25 0 01-1.209-10.249 6 6 0 0111.47-2.226z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="text-center sm:text-left">
                                <div class="flex items-center justify-center sm:justify-start gap-2 mb-1">
                                    <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">{{ $weather['city_name'] }}</h2>
                                </div>
                                <p class="text-white/50 text-sm mb-3">{{ $weather['country'] }}</p>

                                <div class="flex items-baseline justify-center sm:justify-start gap-1 mb-2">
                                    <span class="text-6xl sm:text-7xl font-extrabold tracking-tighter">{{ $temp }}</span>
                                    <span class="text-3xl font-light text-white/60">°C</span>
                                </div>

                                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 rounded-full">
                                    <span class="w-2 h-2 rounded-full @if($weatherCode == 0) bg-yellow-300 @elseif($weatherCode <= 3) bg-blue-200 @elseif($weatherCode <= 67) bg-blue-400 @elseif($weatherCode <= 77) bg-cyan-200 @else bg-slate-300 @endif"></span>
                                    <span class="text-sm font-medium text-white/80">{{ $condition }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-white/10 text-xs text-white/40 text-center sm:text-left">
                            Update terakhir: {{ \Carbon\Carbon::parse($time)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">

                        <div class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl p-4 sm:p-5 text-center transition-all duration-200 hover:-translate-y-1 group">
                            <div class="w-10 h-10 mx-auto mb-3 bg-orange-500/20 rounded-xl flex items-center justify-center group-hover:bg-orange-500/30 transition-colors">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/>
                                </svg>
                            </div>
                            <p class="text-xs text-white/40 mb-1 uppercase tracking-wider">Suhu</p>
                            <p class="text-lg sm:text-xl font-bold">{{ $temp }}°C</p>
                        </div>

                        <div class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl p-4 sm:p-5 text-center transition-all duration-200 hover:-translate-y-1 group">
                            <div class="w-10 h-10 mx-auto mb-3 bg-cyan-500/20 rounded-xl flex items-center justify-center group-hover:bg-cyan-500/30 transition-colors">
                                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
                                </svg>
                            </div>
                            <p class="text-xs text-white/40 mb-1 uppercase tracking-wider">Angin</p>
                            <p class="text-lg sm:text-xl font-bold">{{ $windspeed }} <span class="text-sm font-normal text-white/50">km/h</span></p>
                        </div>

                        <div class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl p-4 sm:p-5 text-center transition-all duration-200 hover:-translate-y-1 group">
                            <div class="w-10 h-10 mx-auto mb-3 bg-emerald-500/20 rounded-xl flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25L15.75 11.25L22.5 12L15.75 12.75L12 21.75L8.25 12.75L1.5 12L8.25 11.25L12 2.25Z"/>
                                </svg>
                            </div>
                            <p class="text-xs text-white/40 mb-1 uppercase tracking-wider">Arah Angin</p>
                            <p class="text-lg sm:text-xl font-bold">{{ $winddir }}°</p>
                        </div>

                        <div class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl p-4 sm:p-5 text-center transition-all duration-200 hover:-translate-y-1 group">
                            <div class="w-10 h-10 mx-auto mb-3 bg-purple-500/20 rounded-xl flex items-center justify-center group-hover:bg-purple-500/30 transition-colors">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </div>
                            <p class="text-xs text-white/40 mb-1 uppercase tracking-wider">Lokasi</p>
                            <p class="text-lg sm:text-xl font-bold">{{ $lat }}°</p>
                            <p class="text-xs text-white/30">{{ $lon }}°</p>
                        </div>

                    </div>

                @endif

                <div class="mt-8 pt-4 border-t border-white/5 text-center">
                    <p class="text-xs text-white/25">
                        Weather Dashboard &copy; {{ date('Y') }} &middot; Data dari
                        <a href="https://open-meteo.com/" target="_blank" class="text-white/40 hover:text-white/60 underline underline-offset-2 transition-colors">Open-Meteo</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
