<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'type',
        'url',
        'thumbnail',
        'views',
        'owner_name',
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    public function getYoutubeIdAttribute(): ?string
    {
        if ($this->type !== 'youtube') {
            return null;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->url, $matches);
        return $matches[1] ?? null;
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        if ($this->type === 'youtube' && $this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }

        return asset('images/default-thumbnail.jpg');
    }

    public function getFormattedViewsAttribute(): string
    {
        if ($this->views >= 1000000) {
            return round($this->views / 1000000, 1) . 'M';
        }
        if ($this->views >= 1000) {
            return round($this->views / 1000, 1) . 'K';
        }
        return (string) $this->views;
    }
}
