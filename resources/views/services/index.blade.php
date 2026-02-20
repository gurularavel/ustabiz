@extends('layouts.app')

@section('title', 'Bütün Xidmətlər – USTAM.AZ')

@section('content')

{{-- PAGE HERO --}}
<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ana səhifə</a>
            <span class="breadcrumb-sep">›</span>
            <span>Xidmətlər</span>
        </nav>
        <h1>Xidmətlərimiz</h1>
        <p>Bakıda bütün ev texnikasının peşəkar təmiri. 12 xidmət növü, 40+ marka, pulsuz diaqnostika.</p>
    </div>
</section>

{{-- SERVICES LIST --}}
<section class="section">
    <div class="container">
        <div class="services-list-grid">
            @foreach($services as $service)
            <a href="{{ route('services.show', $service->slug) }}" class="sl-card fade-in">
                <div class="sl-card-left">
                    <div class="sl-icon">{{ $service->icon }}</div>
                </div>
                <div class="sl-card-body">
                    <h2>{{ $service->name }}</h2>
                    <p>{{ $service->description }}</p>
                    <div class="sl-meta">
                        <span class="sl-price">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            {{ $service->price_from }} AZN-dən başlayır
                        </span>
                        <span class="sl-guarantee">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            12 ay zəmanət
                        </span>
                    </div>
                </div>
                <div class="sl-card-arrow">
                    <span>Ətraflı →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="section section-alt">
    <div class="container">
        <div class="service-cta">
            <h2>Texnikanız xarabdır?</h2>
            <p>İndi zəng edin, 2 saata usta evinizə gəlsin. Pulsuz diaqnostika, 12 ay zəmanət.</p>
            <div class="service-cta-btns">
                <a href="tel:+994552345678" class="btn-white">📞 +994 55 234 56 78</a>
                <a href="{{ route('home') }}#elaqe" class="btn btn-outline">Sifariş ver →</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/service.css') }}">
<style>
.page-hero{background:linear-gradient(135deg,var(--dark) 0%,var(--dark-2) 60%,#0A1628 100%);padding:70px 0 80px;color:var(--white)}
.page-hero h1{font-size:48px;font-weight:900;letter-spacing:-1.5px;margin:16px 0 14px}
.page-hero p{font-size:17px;color:rgba(255,255,255,0.65);max-width:560px}
.services-list-grid{display:flex;flex-direction:column;gap:16px}
.sl-card{display:flex;align-items:center;gap:24px;background:var(--white);border-radius:var(--radius);padding:28px 30px;border:1.5px solid var(--border);transition:all 0.3s}
.sl-card:hover{border-color:var(--primary);box-shadow:var(--shadow-md);transform:translateX(4px)}
.sl-icon{width:68px;height:68px;background:var(--primary-light);border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:32px;flex-shrink:0}
.sl-card-body{flex:1}
.sl-card-body h2{font-size:19px;font-weight:700;color:var(--dark);margin-bottom:8px}
.sl-card-body p{font-size:14.5px;color:var(--text-muted);line-height:1.6;margin-bottom:14px}
.sl-meta{display:flex;align-items:center;gap:20px}
.sl-price,.sl-guarantee{display:flex;align-items:center;gap:6px;font-size:13px;font-weight:500}
.sl-price{color:var(--primary)}
.sl-guarantee{color:var(--text-muted)}
.sl-card-arrow{flex-shrink:0}
.sl-card-arrow span{font-size:14px;font-weight:600;color:var(--primary);background:var(--primary-light);padding:8px 18px;border-radius:100px;white-space:nowrap}
@media(max-width:767px){.sl-card{flex-direction:column;align-items:flex-start;gap:16px}.sl-card-arrow{align-self:flex-end}.page-hero h1{font-size:32px}}
</style>
@endpush
