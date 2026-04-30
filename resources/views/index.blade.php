@extends('layouts.app')

@section('title', isset($category) && $category ? ucfirst($category) . ' - Zaberlin TV' : 'Zaberlin TV')
@section('meta_description', 'Tonton podcast, video edukasi, variety show, dan iklan komersial pilihan di Zaberlin TV. Platform streaming gratis terbaik Indonesia.')

@section('content')

{{-- ===== HERO SECTION ===== --}}
@if($heroVideo)
<section class="hero-section relative min-h-[85vh] lg:min-h-screen flex items-center overflow-hidden" id="hero">
    {{-- Background blur dari thumbnail --}}
    <div class="absolute inset-0 z-0">
        <img
            src="{{ $heroVideo->thumbnail_url }}"
            alt=""
            class="w-full h-full object-cover scale-110 blur-sm"
            aria-hidden="true"
        >
        {{-- Gradient overlays --}}
        <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/90 to-navy/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-navy via-transparent to-navy/60"></div>
    </div>

    {{-- Hero Content — 2 kolom --}}
    <div class="relative z-10 w-full max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">

            {{-- Kolom Kiri: Sinopsis & CTA --}}
            <div class="order-2 lg:order-1 lg:col-span-8 xl:col-span-8">
                {{-- Category badge --}}
                <div class="flex items-center gap-3 mb-5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest {{ $heroVideo->category === 'podcast' ? 'bg-red-600' : 'bg-blue-600' }} text-white">
                        @if($heroVideo->category === 'podcast')
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a3 3 0 0 1 3 3v6a3 3 0 0 1-6 0V5a3 3 0 0 1 3-3z"/><path d="M19 11a7 7 0 0 1-14 0H3a9 9 0 0 0 18 0h-2z"/></svg>
                        @else
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
                        @endif
                        {{ ucfirst($heroVideo->category) }}
                    </span>
                    <span class="text-slate-400 text-xs flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ $heroVideo->formatted_views }} tayangan
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="font-outfit font-900 text-3xl sm:text-4xl lg:text-5xl xl:text-6xl leading-tight mb-4 text-white hero-title-shadow">
                    {{ $heroVideo->title }}
                </h1>

                {{-- Owner --}}
                <p class="text-slate-400 text-sm mb-4 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                        {{ strtoupper(substr($heroVideo->owner_name, 0, 1)) }}
                    </span>
                    <span>oleh <strong class="text-slate-200">{{ $heroVideo->owner_name }}</strong></span>
                </p>

                {{-- Synopsis --}}
                <p class="text-slate-300 text-sm lg:text-base leading-relaxed mb-8 max-w-none line-clamp-3">
                    {{ $heroVideo->description ?? 'Saksikan konten terbaik dari Zaberlin TV. Podcast inspiratif dan video edukasi berkualitas tinggi untuk memperluas wawasanmu.' }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('video.show', $heroVideo) }}"
                       class="group inline-flex items-center gap-3 px-7 py-3.5 rounded-xl font-bold text-sm lg:text-base bg-white text-navy hover:bg-blue-50 transition-all duration-300 shadow-2xl hover:shadow-white/20 hover:scale-105"
                       id="hero-play-btn">
                        <span class="w-8 h-8 rounded-full bg-navy flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-300 flex-shrink-0">
                            <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        Putar Sekarang
                    </a>
                </div>
            </div>

            {{-- Kolom Kanan: Poster Menonjol --}}
            <div class="order-1 lg:order-2 flex justify-center lg:justify-end lg:col-span-4 xl:col-span-4">
                <div class="hero-poster relative w-64 sm:w-80 lg:w-96 xl:w-[420px]">
                    {{-- Glow effect --}}
                    <div class="absolute inset-0 rounded-2xl blur-2xl opacity-40 scale-95"
                         style="background: linear-gradient(135deg, #0E49B5 0%, #ED0101 100%);"></div>
                    {{-- Poster image --}}
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10 aspect-video lg:aspect-[4/5]">
                        <img
                            src="{{ $heroVideo->thumbnail_url }}"
                            alt="{{ $heroVideo->title }}"
                            class="w-full h-full object-cover"
                            id="hero-poster-img"
                            onerror="this.src='https://placehold.co/420x525/06065D/A2DAE0?text=Zaberlin+TV'"
                        >
                        {{-- Play overlay --}}
                        <a href="{{ route('video.show', $heroVideo) }}"
                           class="absolute inset-0 flex items-center justify-center bg-black/20 hover:bg-black/40 transition-colors duration-300 group"
                           aria-label="Putar {{ $heroVideo->title }}">
                            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm border-2 border-white/60 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 animate-bounce hidden lg:block">
        <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

@else
{{-- Empty state hero --}}
<section class="min-h-screen flex items-center justify-center relative overflow-hidden" id="hero-empty">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, rgba(14,73,181,0.3) 0%, rgba(6,6,93,1) 70%);"></div>
    <div class="relative z-10 text-center px-4">
        <div class="w-24 h-24 mx-auto mb-8 rounded-2xl zaberlin-gradient flex items-center justify-center shadow-2xl">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        </div>
        <h1 class="font-outfit font-900 text-5xl lg:text-7xl mb-4"><span class="text-white">Zaberlin</span><span class="text-red-500"> TV</span></h1>
        <p class="text-slate-400 text-xl mb-8">Platform streaming podcast & edukasi terbaik</p>
        <a href="{{ route('video.upload') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-bold bg-red-600 hover:bg-red-700 text-white transition-all duration-300 hover:scale-105 shadow-2xl">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Upload Video Pertama
        </a>
    </div>
</section>
@endif

{{-- ===== FILTERED CONTENT ===== --}}
@if(isset($filteredVideos) && $filteredVideos)
<section class="py-12 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-1 h-8 rounded-full {{ $category === 'podcast' ? 'bg-red-600' : 'bg-blue-500' }}"></div>
        <h2 class="font-outfit font-800 text-2xl lg:text-3xl">
            {{ ucfirst($category) }}
        </h2>
        <span class="text-slate-500 text-sm">({{ $filteredVideos->count() }} video)</span>
    </div>

    @if($filteredVideos->isEmpty())
        <div class="text-center py-20">
            <p class="text-slate-500 text-lg">Belum ada video dalam kategori ini.</p>
            <a href="{{ route('video.upload') }}" class="mt-4 inline-block text-blue-400 hover:text-blue-300 transition-colors">Upload video pertama →</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($filteredVideos as $video)
                @include('partials.video-card', ['video' => $video])
            @endforeach
        </div>
    @endif
</section>

@else

{{-- ===== PODCAST CAROUSEL ===== --}}
@if($podcasts->isNotEmpty())
<section class="py-10 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8" id="section-podcast">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-7 rounded-full bg-red-600"></div>
            <h2 class="font-outfit font-800 text-xl lg:text-2xl">Podcast</h2>
        </div>
        <a href="{{ route('home', ['category' => 'podcast']) }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center gap-1 transition-colors" id="podcast-lihat-semua">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="carousel-container relative">
        <button class="carousel-btn carousel-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Sebelumnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="carousel-track flex gap-4 overflow-x-auto scrollbar-hide pb-4" data-carousel="podcast">
            @foreach($podcasts as $video)
                <div class="carousel-item flex-shrink-0 w-64 sm:w-72 lg:w-80 xl:w-[340px]">
                    @include('partials.video-card', ['video' => $video])
                </div>
            @endforeach
        </div>
        <button class="carousel-btn carousel-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Selanjutnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>
@endif

{{-- ===== EDUKASI CAROUSEL ===== --}}
@if($edukasi->isNotEmpty())
<section class="py-10 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8" id="section-edukasi">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-7 rounded-full bg-blue-500"></div>
            <h2 class="font-outfit font-800 text-xl lg:text-2xl">Edukasi</h2>
        </div>
        <a href="{{ route('home', ['category' => 'edukasi']) }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center gap-1 transition-colors" id="edukasi-lihat-semua">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="carousel-container relative">
        <button class="carousel-btn carousel-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Sebelumnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="carousel-track flex gap-4 overflow-x-auto scrollbar-hide pb-4" data-carousel="edukasi">
            @foreach($edukasi as $video)
                <div class="carousel-item flex-shrink-0 w-64 sm:w-72 lg:w-80 xl:w-[340px]">
                    @include('partials.video-card', ['video' => $video])
                </div>
            @endforeach
        </div>
        <button class="carousel-btn carousel-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Selanjutnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>
@endif

{{-- ===== VARIETY SHOW CAROUSEL ===== --}}
@if($varietyShows->isNotEmpty())
<section class="py-10 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8" id="section-variety-show">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-7 rounded-full bg-purple-500"></div>
            <h2 class="font-outfit font-800 text-xl lg:text-2xl">Variety Show</h2>
        </div>
        <a href="{{ route('home', ['category' => 'variety show']) }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center gap-1 transition-colors" id="variety-show-lihat-semua">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="carousel-container relative">
        <button class="carousel-btn carousel-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Sebelumnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="carousel-track flex gap-4 overflow-x-auto scrollbar-hide pb-4" data-carousel="variety-show">
            @foreach($varietyShows as $video)
                <div class="carousel-item flex-shrink-0 w-64 sm:w-72 lg:w-80 xl:w-[340px]">
                    @include('partials.video-card', ['video' => $video])
                </div>
            @endforeach
        </div>
        <button class="carousel-btn carousel-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Selanjutnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>
@endif

{{-- ===== IKLAN KOMERSIAL CAROUSEL ===== --}}
@if($iklanKomersial->isNotEmpty())
<section class="py-10 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8" id="section-iklan-komersial">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-7 rounded-full bg-yellow-500"></div>
            <h2 class="font-outfit font-800 text-xl lg:text-2xl">Iklan Komersial</h2>
        </div>
        <a href="{{ route('home', ['category' => 'iklan komersial']) }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center gap-1 transition-colors" id="iklan-komersial-lihat-semua">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="carousel-container relative">
        <button class="carousel-btn carousel-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Sebelumnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="carousel-track flex gap-4 overflow-x-auto scrollbar-hide pb-4" data-carousel="iklan-komersial">
            @foreach($iklanKomersial as $video)
                <div class="carousel-item flex-shrink-0 w-64 sm:w-72 lg:w-80 xl:w-[340px]">
                    @include('partials.video-card', ['video' => $video])
                </div>
            @endforeach
        </div>
        <button class="carousel-btn carousel-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 rounded-full bg-navy border border-white/20 flex items-center justify-center hover:bg-blue-700 transition-all shadow-xl" aria-label="Selanjutnya">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>
@endif

@if($podcasts->isEmpty() && $edukasi->isEmpty() && $varietyShows->isEmpty() && $iklanKomersial->isEmpty())
<section class="py-32 text-center px-4">
    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-white/5 flex items-center justify-center">
        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
    </div>
    <h3 class="font-outfit font-bold text-xl text-slate-400 mb-2">Belum ada video</h3>
    <p class="text-slate-600 mb-6">Mulai dengan mengupload video pertama kamu!</p>
    <a href="{{ route('video.upload') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold bg-red-600 hover:bg-red-700 text-white transition-all duration-300">
        Upload Video
    </a>
</section>
@endif

@endif

@endsection

@push('scripts')
<script>
document.querySelectorAll('.carousel-container').forEach(container => {
    const track = container.querySelector('.carousel-track');
    const prevBtn = container.querySelector('.carousel-prev');
    const nextBtn = container.querySelector('.carousel-next');

    if (!track) return;

    const scrollAmount = () => {
        const item = track.querySelector('.carousel-item');
        return item ? item.offsetWidth + 16 : 340;
    };

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            track.scrollBy({ left: -scrollAmount() * 3, behavior: 'smooth' });
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            track.scrollBy({ left: scrollAmount() * 3, behavior: 'smooth' });
        });
    }
});
</script>
@endpush
