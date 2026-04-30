@extends('layouts.app')

@section('title', $video->title)
@section('meta_description', Str::limit($video->description ?? $video->title, 160))

@section('content')
<div class="pt-16 lg:pt-18 min-h-screen">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ===== Judul Tayangan ===== --}}
    <div class="mb-4">
      <div class="flex items-center gap-3 mb-2">
        <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $video->category === 'podcast' ? 'bg-red-600' : 'bg-blue-600' }} text-white">
          {{ ucfirst($video->category) }}
        </span>
        <span class="flex items-center gap-1 text-slate-400 text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          {{ $video->formatted_views }} tayangan
        </span>
        <span class="text-slate-500 text-sm">·</span>
        <span class="text-slate-400 text-sm">oleh <strong class="text-slate-200">{{ $video->owner_name }}</strong></span>
      </div>
      <h1 class="font-outfit font-800 text-xl lg:text-3xl text-white leading-tight">{{ $video->title }}</h1>
    </div>

    {{-- ===== VIDEO PLAYER ===== --}}
    <div class="rounded-2xl overflow-hidden bg-black shadow-2xl mb-6" id="player-wrapper">

      @if($video->type === 'youtube')
        {{-- YouTube Embed --}}
        <div class="relative aspect-video" id="yt-container">
          <div id="yt-player"></div>
          {{-- Custom controls overlay --}}
          <div id="yt-controls" class="absolute bottom-0 left-0 right-0 px-4 pt-8 pb-3 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-0 transition-opacity duration-300 flex flex-col gap-2.5">
            {{-- Progress bar --}}
            <div class="flex items-center gap-2.5 text-xs text-white">
              <span id="yt-current" class="tabular-nums w-10 text-right">0:00</span>
              <div class="flex-1 relative h-1.5 bg-white/25 rounded-full cursor-pointer group" id="yt-progress-bar">
                <div id="yt-progress-fill" class="h-full bg-red-500 rounded-full relative transition-all" style="width:0%">
                  <div class="absolute right-0 top-1/2 -translate-y-1/2 w-3.5 h-3.5 bg-white rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity scale-0 group-hover:scale-100 duration-150"></div>
                </div>
              </div>
              <span id="yt-duration" class="tabular-nums w-10">0:00</span>
            </div>
            {{-- Control buttons --}}
            <div class="flex items-center gap-2">
              <button id="yt-play-btn" onclick="ytTogglePlay()" class="player-btn" aria-label="Play/Pause">
                <svg id="yt-play-icon" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                <svg id="yt-pause-icon" class="w-6 h-6 text-white hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
              </button>
              <button onclick="ytToggleMute()" class="player-btn" aria-label="Mute/Unmute" id="yt-mute-btn">
                <svg id="yt-vol-icon" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
                <svg id="yt-mute-icon" class="w-5 h-5 text-white hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
              </button>
              <div class="flex-1"></div>
              <div class="relative" id="yt-quality-wrapper">
                <button onclick="ytToggleQuality()" class="player-btn flex items-center gap-1.5 text-xs text-white px-2.5 py-1.5 rounded-lg bg-white/10 hover:bg-white/20" id="yt-quality-btn" aria-label="Resolusi">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                  Auto
                </button>
                <div id="yt-quality-menu" class="hidden absolute bottom-10 right-0 rounded-xl overflow-hidden shadow-2xl min-w-28 border border-white/10" style="background: rgba(4,4,64,0.97); backdrop-filter: blur(16px);">
                  @foreach(['hd1080','hd720','large','medium','small'] as $q)
                  <button onclick="ytSetQuality('{{ $q }}')" class="w-full text-left px-4 py-2.5 text-sm text-slate-300 hover:bg-white/10 hover:text-white transition-colors">{{ ['hd1080'=>'1080p','hd720'=>'720p','large'=>'480p','medium'=>'360p','small'=>'240p'][$q] }}</button>
                  @endforeach
                </div>
              </div>
              <button onclick="ytFullscreen()" class="player-btn" aria-label="Fullscreen">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
              </button>
            </div>
          </div>
        </div>

      @else
        {{-- HTML5 File Player --}}
        <div class="relative aspect-video bg-black" id="html5-player-wrapper">
          <video id="html5-video" class="w-full h-full" preload="metadata"
            src="{{ asset('storage/' . $video->url) }}"
            poster="{{ $video->thumbnail_url }}">
            Browser Anda tidak mendukung HTML5 video.
          </video>

          {{-- Custom Controls --}}
          <div id="html5-controls" class="absolute bottom-0 left-0 right-0 px-4 pt-8 pb-3 bg-gradient-to-t from-black/95 via-black/40 to-transparent flex flex-col gap-2.5">
            {{-- Progress --}}
            <div class="flex items-center gap-2.5 text-xs text-white">
              <span id="h5-current" class="tabular-nums w-10 text-right">0:00</span>
              <div class="flex-1 relative h-1.5 bg-white/25 rounded-full cursor-pointer group" id="h5-progress-bar">
                <div id="h5-progress-fill" class="h-full bg-red-500 rounded-full relative" style="width:0%">
                  <div class="absolute right-0 top-1/2 -translate-y-1/2 w-3.5 h-3.5 bg-white rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
              </div>
              <span id="h5-duration" class="tabular-nums w-10">0:00</span>
            </div>
            {{-- Buttons --}}
            <div class="flex items-center gap-2">
              <button id="h5-play-btn" class="player-btn" aria-label="Play/Pause">
                <svg id="h5-play-icon" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                <svg id="h5-pause-icon" class="w-6 h-6 text-white hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
              </button>
              <button id="h5-mute-btn" class="player-btn" aria-label="Mute/Unmute">
                <svg id="h5-vol-icon" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
                <svg id="h5-mute-icon" class="w-5 h-5 text-white hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
              </button>
              {{-- Volume slider --}}
              <input type="range" id="h5-volume" min="0" max="1" step="0.05" value="1" class="w-20 accent-red-500 cursor-pointer">
              <div class="flex-1"></div>
              <button class="player-btn flex items-center gap-1.5 text-xs text-white px-2.5 py-1.5 rounded-lg bg-white/10" id="h5-quality-btn" aria-label="Kualitas">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                HD
              </button>
              <button id="h5-fullscreen-btn" class="player-btn" aria-label="Fullscreen">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
              </button>
            </div>
          </div>
        </div>
      @endif
    </div>

    {{-- ===== DESKRIPSI VIDEO ===== --}}
    <div class="bg-white/5 rounded-2xl p-6 border border-white/10">
      <div class="flex items-start gap-4 mb-4">
        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-navy flex items-center justify-center font-bold text-base flex-shrink-0">
          {{ strtoupper(substr($video->owner_name, 0, 1)) }}
        </div>
        <div>
          <p class="font-semibold text-white text-sm">{{ $video->owner_name }}</p>
          <p class="text-xs text-slate-500 mt-0.5">{{ $video->created_at->diffForHumans() }}</p>
        </div>
      </div>
      <h2 class="font-outfit font-700 text-base mb-3 text-white">Tentang Video</h2>
      <p class="text-slate-400 leading-relaxed whitespace-pre-line text-sm">{{ $video->description ?? 'Tidak ada deskripsi.' }}</p>
    </div>

  </div>
</div>
@endsection

@push('head')
@if($video->type === 'youtube')
<script src="https://www.youtube.com/iframe_api"></script>
@endif
@endpush

@push('scripts')
<script>
@if($video->type === 'youtube')
// ===== YOUTUBE PLAYER =====
let ytPlayer, ytMuted = false, ytCurrentQuality = 'auto';

function onYouTubeIframeAPIReady() {
  ytPlayer = new YT.Player('yt-player', {
    height: '100%', width: '100%',
    videoId: '{{ $video->youtube_id }}',
    playerVars: { rel: 0, modestbranding: 1, controls: 0, disablekb: 0 },
    events: {
      onReady: onYTReady,
      onStateChange: onYTStateChange,
    }
  });
}

function onYTReady(e) {
  document.getElementById('yt-container').addEventListener('mouseenter', () => {
    document.getElementById('yt-controls').style.opacity = '1';
  });
  document.getElementById('yt-container').addEventListener('mouseleave', () => {
    document.getElementById('yt-controls').style.opacity = '0';
  });
  setInterval(updateYTProgress, 500);
}

function onYTStateChange(e) {
  const playing = e.data === YT.PlayerState.PLAYING;
  document.getElementById('yt-play-icon').classList.toggle('hidden', playing);
  document.getElementById('yt-pause-icon').classList.toggle('hidden', !playing);
}

function ytTogglePlay() {
  const s = ytPlayer.getPlayerState();
  s === YT.PlayerState.PLAYING ? ytPlayer.pauseVideo() : ytPlayer.playVideo();
}

function ytToggleMute() {
  ytMuted = !ytMuted;
  ytMuted ? ytPlayer.mute() : ytPlayer.unMute();
  document.getElementById('yt-vol-icon').classList.toggle('hidden', ytMuted);
  document.getElementById('yt-mute-icon').classList.toggle('hidden', !ytMuted);
}

function updateYTProgress() {
  if (!ytPlayer || !ytPlayer.getDuration) return;
  const cur = ytPlayer.getCurrentTime() || 0;
  const dur = ytPlayer.getDuration() || 0;
  if (dur > 0) {
    document.getElementById('yt-progress-fill').style.width = (cur/dur*100) + '%';
  }
  document.getElementById('yt-current').textContent = fmtTime(cur);
  document.getElementById('yt-duration').textContent = fmtTime(dur);
}

document.getElementById('yt-progress-bar')?.addEventListener('click', function(e) {
  const rect = this.getBoundingClientRect();
  const pct = (e.clientX - rect.left) / rect.width;
  ytPlayer.seekTo(pct * ytPlayer.getDuration(), true);
});

function ytToggleQuality() {
  document.getElementById('yt-quality-menu').classList.toggle('hidden');
}

function ytSetQuality(q) {
  ytPlayer.setPlaybackQuality(q);
  ytCurrentQuality = q;
  const labels = {hd1080:'1080p',hd720:'720p',large:'480p',medium:'360p',small:'240p'};
  document.getElementById('yt-quality-btn').innerHTML = `
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
    ${labels[q] || 'Auto'}`;
  document.getElementById('yt-quality-menu').classList.add('hidden');
}

function ytFullscreen() {
  const el = document.getElementById('yt-container');
  if (!document.fullscreenElement && !document.webkitFullscreenElement) {
    if (el.requestFullscreen) el.requestFullscreen();
    else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
  } else {
    if (document.exitFullscreen) document.exitFullscreen();
    else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
  }
}

@else
// ===== HTML5 PLAYER =====
const video = document.getElementById('html5-video');
const playBtn = document.getElementById('h5-play-btn');
const playIcon = document.getElementById('h5-play-icon');
const pauseIcon = document.getElementById('h5-pause-icon');
const muteBtn = document.getElementById('h5-mute-btn');
const volIcon = document.getElementById('h5-vol-icon');
const muteIcon = document.getElementById('h5-mute-icon');
const volumeSlider = document.getElementById('h5-volume');
const progressBar = document.getElementById('h5-progress-bar');
const progressFill = document.getElementById('h5-progress-fill');
const currentTime = document.getElementById('h5-current');
const durationEl = document.getElementById('h5-duration');
const fsBtn = document.getElementById('h5-fullscreen-btn');
const controls = document.getElementById('html5-controls');

let hideControlsTimer;

function showControls() {
  controls.style.opacity = '1';
  clearTimeout(hideControlsTimer);
  hideControlsTimer = setTimeout(() => {
    if (!video.paused) controls.style.opacity = '0';
  }, 3000);
}

document.getElementById('html5-player-wrapper').addEventListener('mousemove', showControls);
document.getElementById('html5-player-wrapper').addEventListener('mouseleave', () => {
  if (!video.paused) controls.style.opacity = '0';
});
showControls();

playBtn.addEventListener('click', () => {
  video.paused ? video.play() : video.pause();
});

video.addEventListener('play', () => {
  playIcon.classList.add('hidden');
  pauseIcon.classList.remove('hidden');
});
video.addEventListener('pause', () => {
  playIcon.classList.remove('hidden');
  pauseIcon.classList.add('hidden');
  controls.style.opacity = '1';
});

video.addEventListener('timeupdate', () => {
  if (!video.duration) return;
  const pct = (video.currentTime / video.duration) * 100;
  progressFill.style.width = pct + '%';
  currentTime.textContent = fmtTime(video.currentTime);
});

video.addEventListener('loadedmetadata', () => {
  durationEl.textContent = fmtTime(video.duration);
});

progressBar.addEventListener('click', function(e) {
  const rect = this.getBoundingClientRect();
  video.currentTime = ((e.clientX - rect.left) / rect.width) * video.duration;
});

muteBtn.addEventListener('click', () => {
  video.muted = !video.muted;
  volIcon.classList.toggle('hidden', video.muted);
  muteIcon.classList.toggle('hidden', !video.muted);
});

volumeSlider.addEventListener('input', function() {
  video.volume = this.value;
  const isMuted = this.value == 0;
  volIcon.classList.toggle('hidden', isMuted);
  muteIcon.classList.toggle('hidden', !isMuted);
});

fsBtn.addEventListener('click', () => {
  const el = document.getElementById('html5-player-wrapper');
  if (!document.fullscreenElement && !document.webkitFullscreenElement) {
    if (el.requestFullscreen) el.requestFullscreen();
    else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
  } else {
    if (document.exitFullscreen) document.exitFullscreen();
    else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
  }
});

video.addEventListener('dblclick', () => {
  video.paused ? video.play() : video.pause();
});
@endif

function fmtTime(s) {
  s = Math.floor(s || 0);
  const m = Math.floor(s / 60);
  const sec = s % 60;
  return m + ':' + (sec < 10 ? '0' : '') + sec;
}
</script>
@endpush
