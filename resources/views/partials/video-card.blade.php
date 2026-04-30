<a href="{{ route('video.show', $video) }}"
   class="video-card group block rounded-xl overflow-hidden relative cursor-pointer"
   id="card-{{ $video->id }}">

    {{-- Thumbnail --}}
    <div class="relative aspect-video overflow-hidden bg-slate-800 rounded-xl">
        <img
            src="{{ $video->thumbnail_url }}"
            alt="{{ $video->title }}"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
            onerror="this.src='https://placehold.co/640x360/06065D/A2DAE0?text=Zaberlin+TV'"
        >

        {{-- Hover overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center">
            <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm border border-white/40 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
        </div>

        {{-- Category badge --}}
        <div class="absolute top-2 left-2">
            <span class="px-2 py-0.5 rounded-md text-xs font-semibold {{ $video->category === 'podcast' ? 'bg-red-600' : 'bg-blue-600' }} text-white">
                {{ ucfirst($video->category) }}
            </span>
        </div>

        {{-- Views badge (always visible) --}}
        <div class="absolute bottom-2 right-2">
            <span class="px-2 py-0.5 rounded-md text-xs font-medium bg-black/70 text-slate-300 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                {{ $video->formatted_views }}
            </span>
        </div>
    </div>

    {{-- Card Info --}}
    <div class="mt-2.5 px-0.5">
        <h3 class="text-sm font-semibold text-white line-clamp-2 leading-snug group-hover:text-blue-300 transition-colors duration-200 mb-1">
            {{ $video->title }}
        </h3>
        <p class="text-xs text-slate-500 flex items-center gap-1">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
            {{ $video->owner_name }}
        </p>
        <p class="text-xs text-slate-600 mt-0.5">{{ $video->formatted_views }} tayangan</p>
    </div>
</a>
