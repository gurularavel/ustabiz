@extends('layouts.app')

@section('title', 'Portfolio – ' . \App\Models\Setting::get('site_title', 'USTA.BİZ.AZ'))

@section('content')

{{-- HERO --}}
<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ana səhifə</a>
            <span class="breadcrumb-sep">›</span>
            <span>Portfolio</span>
        </nav>
        <h1>Bizim işlərimiz</h1>
        <p>Hər iş öz sözünü özü danışır. Gördüyümüz təmirlərdən seçmə nümunələr.</p>
    </div>
</section>

{{-- FILTER --}}
@if($services->count() > 0)
<section style="background:var(--bg);padding:20px 0;border-bottom:1px solid var(--border);">
    <div class="container">
        <div class="pf-filters">
            <a href="{{ route('portfolio') }}" class="pf-filter {{ !$serviceId ? 'active' : '' }}">Hamısı</a>
            @foreach($services as $srv)
            <a href="{{ route('portfolio', ['service' => $srv->id]) }}"
               class="pf-filter {{ $serviceId == $srv->id ? 'active' : '' }}">
                {{ $srv->icon }} {{ $srv->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- GRID --}}
<section class="section">
    <div class="container">
        @if($items->count())
        <div class="pf-grid">
            @foreach($items as $item)
            <div class="pf-card fade-in">
                <div class="pf-thumb {{ $item->is_short ? 'pf-thumb--short' : '' }}" id="thumb_{{ $item->id }}">
                    @if($item->thumbnail_url)
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" loading="lazy">
                    @else
                        <div class="pf-thumb-placeholder">🔧</div>
                    @endif

                    @if($item->youtube_id)
                    <button class="pf-play-btn"
                            onclick="pfPlay({{ $item->id }}, '{{ $item->embed_url }}', {{ $item->is_short ? 'true' : 'false' }})"
                            aria-label="Videonu oynat">
                        <div class="pf-play-icon">
                            <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </button>
                    @endif

                    @if($item->service)
                    <span class="pf-badge">{{ $item->service->icon }} {{ $item->service->name }}</span>
                    @endif

                    @if($item->youtube_id)
                    <span class="pf-yt-badge">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><path d="M23 7s-.3-2-1.2-2.8c-1.1-1.2-2.4-1.2-3-1.3C16.2 2.7 12 2.7 12 2.7s-4.2 0-6.8.2c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.3v2c0 2.1.3 4.3.3 4.3s.3 2 1.2 2.8c1.1 1.2 2.6 1.1 3.3 1.2C7.2 21.8 12 21.8 12 21.8s4.2 0 6.8-.3c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.8 1.2-2.8s.3-2.1.3-4.3v-2C23.3 9.1 23 7 23 7zM9.7 15.5V8.4l8.1 3.6-8.1 3.5z"/></svg>
                        {{ $item->is_short ? 'Shorts' : 'YouTube' }}
                    </span>
                    @endif
                </div>
                <div class="pf-body">
                    <h3>{{ $item->title }}</h3>
                    @if($item->description)
                    <p>{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        @if($items->hasPages())
        <div style="margin-top:48px;display:flex;justify-content:center;">
            {{ $items->links() }}
        </div>
        @endif

        @else
        <div style="text-align:center;padding:80px 0;color:var(--text-muted);">
            <div style="font-size:48px;margin-bottom:16px;">🔧</div>
            <p style="font-size:16px;">Portfolio hələ əlavə edilməyib.</p>
        </div>
        @endif
    </div>
</section>

{{-- VIDEO MODAL --}}
<div class="pf-video-modal" id="pfModal" onclick="pfModalClose(event)">
    <div class="pf-modal-inner" id="pfModalInner">
        <button class="pf-modal-close" onclick="pfClose()" aria-label="Bağla">✕</button>
        <div class="pf-modal-video" id="pfModalVideo"></div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/service.css') }}">
<style>
/* PAGE HERO */
.page-hero{background:linear-gradient(135deg,var(--dark) 0%,var(--dark-2) 60%,#0A1628 100%);padding:70px 0 80px;color:var(--white)}
.page-hero h1{font-size:48px;font-weight:900;letter-spacing:-1.5px;margin:16px 0 14px}
.page-hero p{font-size:17px;color:rgba(255,255,255,0.65);max-width:560px}

/* FILTERS */
.pf-filters{display:flex;flex-wrap:wrap;gap:8px;align-items:center}
.pf-filter{padding:7px 16px;border-radius:100px;font-size:13px;font-weight:500;color:var(--text-muted);background:var(--white);border:1.5px solid var(--border);transition:all .2s}
.pf-filter:hover,.pf-filter.active{background:var(--primary);color:#fff;border-color:var(--primary)}

/* GRID */
.pf-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}

/* CARD */
.pf-card{background:var(--white);border-radius:var(--radius);border:1.5px solid var(--border);overflow:hidden;transition:all .3s}
.pf-card:hover{border-color:var(--primary);box-shadow:var(--shadow-md);transform:translateY(-4px)}

/* THUMBNAIL */
.pf-thumb{position:relative;aspect-ratio:16/9;overflow:hidden;background:#1a1a2e}
.pf-thumb--short{aspect-ratio:9/16;max-height:420px;width:100%}
.pf-thumb img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s}
.pf-card:hover .pf-thumb img{transform:scale(1.04)}
.pf-thumb-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:56px;background:var(--bg)}

/* PLAY BUTTON */
.pf-play-btn{position:absolute;inset:0;width:100%;height:100%;background:rgba(0,0,0,0);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .25s}
.pf-play-btn:hover{background:rgba(0,0,0,.25)}
.pf-play-icon{width:64px;height:64px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 24px rgba(255,107,53,.5);transition:transform .2s,box-shadow .2s}
.pf-play-btn:hover .pf-play-icon{transform:scale(1.1);box-shadow:0 8px 32px rgba(255,107,53,.6)}

/* BADGES */
.pf-badge{position:absolute;bottom:10px;left:10px;background:rgba(0,0,0,.7);color:#fff;font-size:12px;font-weight:500;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px)}
.pf-yt-badge{position:absolute;top:10px;right:10px;background:rgba(255,0,0,.85);color:#fff;font-size:11px;font-weight:600;padding:3px 8px;border-radius:6px;display:flex;align-items:center;gap:4px}

/* CARD BODY */
.pf-body{padding:18px 20px}
.pf-body h3{font-size:15px;font-weight:700;color:var(--dark);margin-bottom:6px;line-height:1.4}
.pf-body p{font-size:13.5px;color:var(--text-muted);line-height:1.6}

/* VIDEO MODAL */
.pf-video-modal{display:none;position:fixed;inset:0;z-index:9500;background:rgba(0,0,0,.88);align-items:center;justify-content:center;padding:16px}
.pf-video-modal.open{display:flex}
.pf-modal-inner{position:relative;width:100%;max-width:860px}
.pf-modal-inner.is-short{max-width:420px}
.pf-modal-close{position:absolute;top:-44px;right:0;background:rgba(255,255,255,.12);border:none;color:#fff;font-size:20px;width:36px;height:36px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s}
.pf-modal-close:hover{background:rgba(255,255,255,.25)}
.pf-modal-video{position:relative;width:100%;background:#000;border-radius:12px;overflow:hidden}
.pf-modal-video.ratio-16-9{aspect-ratio:16/9}
.pf-modal-video.ratio-9-16{aspect-ratio:9/16}
.pf-modal-video iframe{position:absolute;inset:0;width:100%;height:100%;border:none}
.pf-modal-video.ratio-9-16 iframe{transform:scale(2.5);transform-origin:center center}

/* RESPONSIVE */
@media(max-width:991px){.pf-grid{grid-template-columns:repeat(2,1fr)}.page-hero h1{font-size:36px}.page-hero{padding:52px 0 62px}}
@media(max-width:767px){.pf-grid{grid-template-columns:repeat(2,1fr)}.page-hero h1{font-size:28px}.page-hero p{font-size:15px}}
@media(max-width:480px){.pf-grid{grid-template-columns:1fr}.page-hero h1{font-size:24px}.pf-thumb--short{max-height:280px}.pf-modal-inner.is-short{max-width:calc(100vw - 32px)}}
</style>
@endpush

@push('scripts')
<script>
function pfPlay(id, embedUrl, isShort) {
    var modal    = document.getElementById('pfModal');
    var inner    = document.getElementById('pfModalInner');
    var videoDiv = document.getElementById('pfModalVideo');

    inner.className    = 'pf-modal-inner' + (isShort ? ' is-short' : '');
    videoDiv.className = 'pf-modal-video ' + (isShort ? 'ratio-9-16' : 'ratio-16-9');
    videoDiv.innerHTML = '<iframe src="' + embedUrl + '" allowfullscreen allow="autoplay; encrypted-media" referrerpolicy="strict-origin-when-cross-origin"></iframe>';

    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function pfClose() {
    var modal    = document.getElementById('pfModal');
    var videoDiv = document.getElementById('pfModalVideo');
    videoDiv.innerHTML = '';
    modal.classList.remove('open');
    document.body.style.overflow = '';
}

function pfModalClose(e) {
    if (e.target === document.getElementById('pfModal')) pfClose();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') pfClose();
});
</script>
@endpush
