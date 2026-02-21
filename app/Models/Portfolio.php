<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    protected $fillable = [
        'title', 'description', 'youtube_url', 'service_id', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getYoutubeIdAttribute(): ?string
    {
        if (!$this->youtube_url) return null;
        if (preg_match('/shorts\/([a-zA-Z0-9_-]+)/i', $this->youtube_url, $m)) return $m[1];
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]+)/', $this->youtube_url, $m))     return $m[1];
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $this->youtube_url, $m)) return $m[1];
        return null;
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->youtube_id
            ? "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg"
            : '';
    }

    public function getEmbedUrlAttribute(): string
    {
        return $this->youtube_id
            ? "https://www.youtube.com/embed/{$this->youtube_id}?autoplay=1&rel=0&modestbranding=1"
            : '';
    }

    public function getIsShortAttribute(): bool
    {
        return (bool) ($this->youtube_url && str_contains(strtolower($this->youtube_url), '/shorts/'));
    }
}
