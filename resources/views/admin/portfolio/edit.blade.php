@extends('admin.layouts.app')

@section('title', isset($portfolio) && $portfolio->exists ? 'Portfolio Düzəlt' : 'Yeni Portfolio')

@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary btn-sm">← Geri</a>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start;">

    {{-- MAIN FORM --}}
    <div>
        <form method="POST"
              action="{{ isset($portfolio) && $portfolio->exists ? route('admin.portfolio.update', $portfolio) : route('admin.portfolio.store') }}"
              id="pfForm">
            @csrf
            @if(isset($portfolio) && $portfolio->exists) @method('PUT') @endif

            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">Əsas məlumat</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Başlıq *</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $portfolio->title ?? '') }}"
                               placeholder="Samsung soyuducu kompressor dəyişimi" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="İş haqqında qısa məlumat...">{{ old('description', $portfolio->description ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Xidmət (isteğe bağlı)</label>
                        <select name="service_id" class="form-control">
                            <option value="">— Seçin —</option>
                            @foreach($services as $srv)
                            <option value="{{ $srv->id }}"
                                {{ old('service_id', $portfolio->service_id ?? '') == $srv->id ? 'selected' : '' }}>
                                {{ $srv->icon }} {{ $srv->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">🎬 YouTube Linki</span></div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">YouTube URL (isteğe bağlı)</label>
                        <input type="text" name="youtube_url" id="ytUrlInput" class="form-control"
                               value="{{ old('youtube_url', $portfolio->youtube_url ?? '') }}"
                               placeholder="https://youtube.com/shorts/... və ya https://youtu.be/...">
                        <div class="form-hint">Shorts, youtu.be, youtube.com/watch?v= — hamısı dəstəklənir</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Parametrlər</span></div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Sıra</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}">
                        </div>
                        <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:18px;">
                            <label class="form-check">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $portfolio->is_active ?? true) ? 'checked' : '' }}>
                                Aktiv
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">💾 Yadda saxla</button>
                </div>
            </div>
        </form>
    </div>

    {{-- PREVIEW PANEL --}}
    <div>
        <div class="card" style="position:sticky;top:80px;">
            <div class="card-header"><span class="card-title">Önizləmə</span></div>
            <div class="card-body" style="padding:16px;">

                {{-- Thumbnail preview --}}
                <div id="ytThumbWrap" style="position:relative;border-radius:10px;overflow:hidden;background:#1a1a2e;margin-bottom:12px;">
                    <div id="ytRatioBox" style="aspect-ratio:16/9;">
                        <img id="ytThumb" src="" alt=""
                             style="width:100%;height:100%;object-fit:cover;display:none;">
                        <div id="ytPlaceholder" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:40px;color:rgba(255,255,255,.3);">🎬</div>
                    </div>

                    {{-- Play overlay --}}
                    <div id="ytPlayOverlay"
                         style="display:none;position:absolute;inset:0;align-items:center;justify-content:center;background:rgba(0,0,0,.2);">
                        <div style="width:52px;height:52px;background:#FF6B35;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <svg viewBox="0 0 24 24" fill="white" width="22" height="22"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>

                    {{-- YouTube badge --}}
                    <div id="ytBadge"
                         style="display:none;position:absolute;top:8px;right:8px;background:rgba(255,0,0,.85);color:#fff;font-size:11px;font-weight:600;padding:3px 8px;border-radius:6px;">
                        YouTube
                    </div>
                </div>

                <div style="font-size:12px;color:var(--text-muted);text-align:center;" id="ytInfo">
                    URL daxil edin — thumbnail avtomatik yüklənəcək
                </div>

                {{-- Play in preview --}}
                <button type="button" id="previewPlayBtn"
                        style="display:none;margin-top:10px;width:100%;"
                        class="btn btn-secondary btn-sm"
                        onclick="previewPlay()">▶ Videonu sına</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
var _ytPreviewEmbed = '';

function extractYtId(url) {
    if (!url) return null;
    var m;
    if ((m = url.match(/shorts\/([a-zA-Z0-9_-]+)/i))) return { id: m[1], short: true };
    if ((m = url.match(/[?&]v=([a-zA-Z0-9_-]+)/)))    return { id: m[1], short: false };
    if ((m = url.match(/youtu\.be\/([a-zA-Z0-9_-]+)/))) return { id: m[1], short: false };
    return null;
}

function updateYtPreview(url) {
    var result      = extractYtId(url);
    var thumb       = document.getElementById('ytThumb');
    var placeholder = document.getElementById('ytPlaceholder');
    var overlay     = document.getElementById('ytPlayOverlay');
    var badge       = document.getElementById('ytBadge');
    var info        = document.getElementById('ytInfo');
    var playBtn     = document.getElementById('previewPlayBtn');
    var ratioBox    = document.getElementById('ytRatioBox');

    if (result) {
        var thumbUrl = 'https://img.youtube.com/vi/' + result.id + '/hqdefault.jpg';
        thumb.src    = thumbUrl;
        thumb.style.display = 'block';
        placeholder.style.display  = 'none';
        overlay.style.display      = 'flex';
        badge.style.display        = 'flex';
        badge.textContent          = result.short ? 'Shorts' : 'YouTube';
        ratioBox.style.aspectRatio = result.short ? '9/16' : '16/9';
        info.textContent           = result.short ? 'YouTube Shorts (9:16)' : 'YouTube Video (16:9)';
        playBtn.style.display      = 'flex';
        _ytPreviewEmbed = 'https://www.youtube.com/embed/' + result.id + '?autoplay=1&rel=0';
    } else {
        thumb.style.display        = 'none';
        placeholder.style.display  = 'flex';
        overlay.style.display      = 'none';
        badge.style.display        = 'none';
        ratioBox.style.aspectRatio = '16/9';
        info.textContent           = url ? 'Düzgün YouTube linki deyil' : 'URL daxil edin — thumbnail avtomatik yüklənəcək';
        playBtn.style.display      = 'none';
        _ytPreviewEmbed = '';
    }
}

function previewPlay() {
    if (!_ytPreviewEmbed) return;
    var wrap  = document.getElementById('ytRatioBox');
    var isShort = wrap.style.aspectRatio === '9/16';

    // Create overlay iframe inside the preview box
    var existing = document.getElementById('previewIframe');
    if (existing) { existing.remove(); return; }

    var iframe = document.createElement('iframe');
    iframe.id  = 'previewIframe';
    iframe.src = _ytPreviewEmbed;
    iframe.setAttribute('allowfullscreen', '');
    iframe.setAttribute('allow', 'autoplay; encrypted-media');
    iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:none;z-index:5;';

    var thumbWrap = document.getElementById('ytThumbWrap');
    thumbWrap.style.position = 'relative';
    thumbWrap.appendChild(iframe);
    document.getElementById('previewPlayBtn').textContent = '⏹ Videonu dayandır';
}

// Listen to input changes
document.getElementById('ytUrlInput').addEventListener('input', function() {
    updateYtPreview(this.value.trim());
    // Remove any playing iframe
    var existing = document.getElementById('previewIframe');
    if (existing) existing.remove();
    document.getElementById('previewPlayBtn').textContent = '▶ Videonu sına';
});

// Init on page load
updateYtPreview(document.getElementById('ytUrlInput').value.trim());
</script>
@endpush
