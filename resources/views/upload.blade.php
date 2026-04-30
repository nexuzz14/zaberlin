@extends('layouts.app')

@section('title', 'Upload Video - Zaberlin TV')

@section('content')
<div class="pt-28 pb-20 min-h-screen">
  <div class="max-w-2xl mx-auto px-4 sm:px-6">

    <div class="mb-8">
      <a href="{{ route('home') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Beranda
      </a>
      <h1 class="font-outfit font-800 text-3xl lg:text-4xl text-white">Upload Video</h1>
      <p class="text-slate-400 mt-2">Bagikan konten podcast atau edukasi kamu ke Zaberlin TV</p>
    </div>

    <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data" id="upload-form" class="space-y-6">
      @csrf

      {{-- Errors --}}
      @if($errors->any())
      <div class="bg-red-900/30 border border-red-500/40 rounded-xl p-4">
        <ul class="text-red-300 text-sm space-y-1">
          @foreach($errors->all() as $error)
          <li class="flex items-start gap-2"><span class="mt-0.5">•</span>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      {{-- Judul --}}
      <div>
        <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">Judul Video <span class="text-red-500">*</span></label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required
          placeholder="Masukkan judul video..."
          class="input-field w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-blue-500 focus:bg-white/8 transition-all">
      </div>

      {{-- Deskripsi --}}
      <div>
        <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">Deskripsi</label>
        <textarea name="description" id="description" rows="4"
          placeholder="Ceritakan tentang video ini..."
          class="input-field w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-blue-500 transition-all resize-none">{{ old('description') }}</textarea>
      </div>

      {{-- Grid: kategori + type --}}
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="category" class="block text-sm font-semibold text-slate-300 mb-2">Kategori <span class="text-red-500">*</span></label>
          <select name="category" id="category" required
            class="input-field w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:border-blue-500 transition-all appearance-none cursor-pointer">
            <option value="" class="bg-navy" disabled {{ !old('category') ? 'selected' : '' }}>Pilih...</option>
            <option value="podcast" class="bg-navy" {{ old('category') === 'podcast' ? 'selected' : '' }}>🎙 Podcast</option>
            <option value="edukasi" class="bg-navy" {{ old('category') === 'edukasi' ? 'selected' : '' }}>📚 Edukasi</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-300 mb-2">Tipe Video <span class="text-red-500">*</span></label>
          <div class="flex gap-3 mt-1">
            <label class="type-option flex-1 flex items-center gap-2 px-3 py-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500 transition-all {{ old('type') === 'youtube' ? 'border-blue-500 bg-blue-600/10' : 'bg-white/5' }}">
              <input type="radio" name="type" value="youtube" id="type-youtube" class="hidden" {{ old('type', 'youtube') === 'youtube' ? 'checked' : '' }}>
              <span class="text-lg">▶️</span>
              <span class="text-sm font-medium text-slate-300">YouTube</span>
            </label>
            <label class="type-option flex-1 flex items-center gap-2 px-3 py-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500 transition-all {{ old('type') === 'file' ? 'border-blue-500 bg-blue-600/10' : 'bg-white/5' }}">
              <input type="radio" name="type" value="file" id="type-file" class="hidden" {{ old('type') === 'file' ? 'checked' : '' }}>
              <span class="text-lg">📁</span>
              <span class="text-sm font-medium text-slate-300">Upload File</span>
            </label>
          </div>
        </div>
      </div>

      {{-- YouTube URL --}}
      <div id="youtube-field">
        <label for="url" class="block text-sm font-semibold text-slate-300 mb-2">URL YouTube <span class="text-red-500">*</span></label>
        <input type="url" name="url" id="url" value="{{ old('url') }}"
          placeholder="https://www.youtube.com/watch?v=..."
          class="input-field w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-blue-500 transition-all">
      </div>

      {{-- File Upload --}}
      <div id="file-field" class="hidden">
        <label class="block text-sm font-semibold text-slate-300 mb-2">File Video <span class="text-red-500">*</span></label>
        <label for="video_file" class="flex flex-col items-center justify-center w-full py-10 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-blue-500 transition-all group bg-white/3" id="file-drop-zone">
          <svg class="w-10 h-10 text-slate-500 group-hover:text-blue-400 transition-colors mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
          <p class="text-slate-400 text-sm font-medium">Klik untuk upload atau drag & drop</p>
          <p class="text-slate-600 text-xs mt-1">MP4, MOV, AVI, WebM — maks 512MB</p>
          <p id="file-name" class="text-blue-400 text-xs mt-2 font-medium hidden"></p>
          <input type="file" name="video_file" id="video_file" accept="video/*" class="hidden">
        </label>
      </div>

      {{-- Thumbnail --}}
      <div>
        <label class="block text-sm font-semibold text-slate-300 mb-2">Thumbnail</label>
        <div class="flex items-start gap-4">
          <label for="thumbnail" class="flex flex-col items-center justify-center w-40 h-24 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-blue-500 transition-all bg-white/3" id="thumb-drop">
            <img id="thumb-preview" src="" alt="" class="w-full h-full object-cover rounded-xl hidden">
            <div id="thumb-placeholder">
              <svg class="w-6 h-6 text-slate-500 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              <p class="text-slate-600 text-xs text-center">Tambah thumbnail</p>
            </div>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden">
          </label>
          <p class="text-slate-600 text-xs mt-3">JPEG, PNG, WebP<br>maks 5MB<br>Opsional — jika YouTube, otomatis diambil</p>
        </div>
      </div>

      {{-- Owner Name --}}
      <div>
        <label for="owner_name" class="block text-sm font-semibold text-slate-300 mb-2">Nama Pemilik <span class="text-red-500">*</span></label>
        <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name') }}" required
          placeholder="Nama channel atau creator..."
          class="input-field w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-blue-500 transition-all">
      </div>

      {{-- Submit --}}
      <button type="submit" id="submit-btn"
        class="w-full py-4 rounded-xl font-bold text-base bg-red-600 hover:bg-red-700 text-white transition-all duration-300 shadow-2xl hover:shadow-red-600/30 hover:scale-[1.01] flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
        Upload Video
      </button>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
// Type toggle
const typeOptions = document.querySelectorAll('.type-option');
const ytField = document.getElementById('youtube-field');
const fileField = document.getElementById('file-field');
const urlInput = document.getElementById('url');

function updateType(val) {
  typeOptions.forEach(opt => {
    const radio = opt.querySelector('input[type=radio]');
    const active = radio.value === val;
    opt.classList.toggle('border-blue-500', active);
    opt.classList.toggle('bg-blue-600/10', active);
    opt.classList.toggle('bg-white/5', !active);
  });
  ytField.classList.toggle('hidden', val === 'file');
  fileField.classList.toggle('hidden', val === 'youtube');
  urlInput.required = val === 'youtube';
}

typeOptions.forEach(opt => {
  opt.addEventListener('click', () => {
    const radio = opt.querySelector('input[type=radio]');
    radio.checked = true;
    updateType(radio.value);
  });
});

// Init
const checkedType = document.querySelector('input[name=type]:checked');
updateType(checkedType ? checkedType.value : 'youtube');

// File name display
document.getElementById('video_file').addEventListener('change', function() {
  const fn = document.getElementById('file-name');
  fn.textContent = this.files[0]?.name || '';
  fn.classList.toggle('hidden', !this.files[0]);
});

// Thumbnail preview
document.getElementById('thumbnail').addEventListener('change', function() {
  if (!this.files[0]) return;
  const reader = new FileReader();
  reader.onload = e => {
    const preview = document.getElementById('thumb-preview');
    preview.src = e.target.result;
    preview.classList.remove('hidden');
    document.getElementById('thumb-placeholder').classList.add('hidden');
  };
  reader.readAsDataURL(this.files[0]);
});

// Submit loading
document.getElementById('upload-form').addEventListener('submit', function() {
  const btn = document.getElementById('submit-btn');
  btn.disabled = true;
  btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Mengupload...';
});
</script>
@endpush
