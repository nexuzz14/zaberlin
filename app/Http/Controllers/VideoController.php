<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $heroVideo = Video::orderBy('views', 'desc')->first();

        $podcasts = Video::where('category', 'podcast')
            ->orderBy('created_at', 'desc')
            ->get();

        $edukasi = Video::where('category', 'edukasi')
            ->orderBy('created_at', 'desc')
            ->get();

        $varietyShows = Video::where('category', 'variety show')
            ->orderBy('created_at', 'desc')
            ->get();

        $iklanKomersial = Video::where('category', 'iklan komersial')
            ->orderBy('created_at', 'desc')
            ->get();

        $filteredVideos = null;
        if ($category && in_array($category, ['podcast', 'edukasi', 'variety show', 'iklan komersial'])) {
            $filteredVideos = Video::where('category', $category)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('index', compact('heroVideo', 'podcasts', 'edukasi', 'varietyShows', 'iklanKomersial', 'filteredVideos', 'category'));
    }

    public function show(Video $video)
    {
        $video->increment('views');

        $related = Video::where('category', $video->category)
            ->where('id', '!=', $video->id)
            ->orderBy('views', 'desc')
            ->limit(8)
            ->get();

        return view('show', compact('video', 'related'));
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->query('category');

        if (!$category || !in_array($category, ['podcast', 'edukasi', 'variety show', 'iklan komersial'])) {
            return redirect()->route('home');
        }

        return redirect()->route('home', ['category' => $category]);
    }

    public function upload()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'   => 'required|in:podcast,edukasi,variety show,iklan komersial',
            'type'       => 'required|in:youtube,file',
            'url'        => 'nullable|url|required_if:type,youtube',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,webm|max:512000|required_if:type,file',
            'thumbnail'  => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'owner_name' => 'required|string|max:100',
        ]);

        $url = $validated['url'] ?? '';
        if ($request->type === 'file' && $request->hasFile('video_file')) {
            $url = $request->file('video_file')->store('videos', 'public');
        }

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Video::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category'    => $validated['category'],
            'type'        => $validated['type'],
            'url'         => $url,
            'thumbnail'   => $thumbnail,
            'owner_name'  => $validated['owner_name'],
        ]);

        return redirect()->route('home')->with('success', 'Video berhasil diupload!');
    }
}
