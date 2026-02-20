@extends('layouts.app')

@section('title', 'Haqqımızda – USTAM.AZ')

@section('content')

{{-- HERO --}}
<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ana səhifə</a>
            <span class="breadcrumb-sep">›</span>
            <span>{{ $s['about_hero_title'] ?? 'Haqqımızda' }}</span>
        </nav>
        <h1>{{ $s['about_hero_title'] ?? 'Haqqımızda' }}</h1>
        <p>{{ $s['about_hero_desc'] ?? '2012-ci ildən Bakıda fəaliyyət göstərən, ev texnikası təmirinin etibarlı ünvanı.' }}</p>
    </div>
</section>

{{-- ABOUT STORY --}}
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about-text fade-in">
                <div class="section-label">{{ $s['about_story_label'] ?? '📖 Hekayəmiz' }}</div>
                <h2>{{ $s['about_story_title'] ?? '12 illik etimad' }}</h2>
                <div>{!! $s['about_story_content'] ?? '' !!}</div>
                <div class="about-values">
                    @for($i = 1; $i <= 3; $i++)
                    @php
                        $icon  = $s['about_value'.$i.'_icon']  ?? '';
                        $title = $s['about_value'.$i.'_title'] ?? '';
                        $text  = $s['about_value'.$i.'_text']  ?? '';
                    @endphp
                    @if($title)
                    <div class="about-value">
                        <div class="about-value-icon">{{ $icon }}</div>
                        <div>
                            <strong>{{ $title }}</strong>
                            <span>{{ $text }}</span>
                        </div>
                    </div>
                    @endif
                    @endfor
                </div>
            </div>
            <div class="about-stats-col fade-in" style="animation-delay:.15s">
                @for($i = 1; $i <= 4; $i++)
                @php
                    $val   = $s['about_stat'.$i.'_value'] ?? '';
                    $label = $s['about_stat'.$i.'_label'] ?? '';
                @endphp
                @if($val)
                <div class="about-stat-card">
                    <strong>{{ $val }}</strong>
                    <span>{{ $label }}</span>
                </div>
                @endif
                @endfor
            </div>
        </div>
    </div>
</section>

{{-- TEAM --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">👨‍🔧 Komanda</div>
            <h2>{{ $s['about_team_title'] ?? 'Peşəkar komandamız' }}</h2>
            <p>{{ $s['about_team_desc'] ?? 'Hər usta öz sahəsinin mütəxəssisidir. Minimum 4 il iş təcrübəsi tələb edirik.' }}</p>
        </div>
        <div class="team-grid">
            @forelse($members as $i => $member)
            <div class="team-card fade-in" @if($i>0) style="animation-delay:{{ $i*0.1 }}s" @endif>
                <div class="team-avatar">{{ $member->emoji }}</div>
                <h3>{{ $member->name }}</h3>
                <span>{{ $member->role }}</span>
                <p>{{ $member->experience }}</p>
            </div>
            @empty
            <p style="color:#9ca3af;font-size:14px;">Komanda üzvü əlavə edilməyib.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- CERTIFICATES --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">📜 Sertifikatlar</div>
            <h2>Rəsmi sertifikatlar</h2>
            <p>Ustalarımız dünya markalarının rəsmi xidmət mərkəzlərindən sertifikat almışdır.</p>
        </div>
        <div class="cert-grid">
            @foreach(['Samsung', 'LG', 'Bosch', 'Arçelik', 'Siemens', 'Mitsubishi'] as $brand)
            <div class="cert-card fade-in">
                <div class="cert-icon">🏅</div>
                <strong>{{ $brand }}</strong>
                <span>Rəsmi Servis Sertifikatı</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="section section-alt">
    <div class="container">
        <div class="service-cta">
            <h2>{{ $s['about_cta_title'] ?? 'Bizimlə əlaqə saxlayın' }}</h2>
            <p>{{ $s['about_cta_desc'] ?? 'Texnikanız üçün peşəkar yardıma ehtiyacınız varsa, biz buradayıq.' }}</p>
            <div class="service-cta-btns">
                <a href="tel:{{ preg_replace('/\D/', '', \App\Models\Setting::get('phone', '0505552026')) }}" class="btn-white">📞 {{ \App\Models\Setting::get('phone', '(050) 555-20-26') }}</a>
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
.about-grid{display:grid;grid-template-columns:1fr 340px;gap:70px;align-items:start}
.about-text .section-label{margin-bottom:14px}
.about-text h2{font-size:38px;font-weight:800;color:var(--dark);letter-spacing:-1px;margin-bottom:20px;line-height:1.2}
.about-text p,.about-text div>p{font-size:15.5px;color:var(--text-muted);line-height:1.75}
.about-values{margin-top:32px;display:flex;flex-direction:column;gap:16px}
.about-value{display:flex;align-items:flex-start;gap:14px}
.about-value-icon{width:44px;height:44px;background:var(--primary-light);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.about-value strong{display:block;font-size:14px;font-weight:700;color:var(--dark);margin-bottom:2px}
.about-value span{font-size:13.5px;color:var(--text-muted)}
.about-stats-col{display:flex;flex-direction:column;gap:14px}
.about-stat-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:24px;text-align:center;transition:all 0.3s}
.about-stat-card:hover{border-color:var(--primary);box-shadow:var(--shadow-sm)}
.about-stat-card strong{display:block;font-size:32px;font-weight:800;color:var(--primary);margin-bottom:6px}
.about-stat-card span{font-size:13.5px;color:var(--text-muted)}
.team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.team-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--radius);padding:30px 20px;text-align:center;transition:all 0.3s}
.team-card:hover{border-color:var(--primary);box-shadow:var(--shadow-sm);transform:translateY(-3px)}
.team-avatar{font-size:50px;margin-bottom:16px}
.team-card h3{font-size:16px;font-weight:700;color:var(--dark);margin-bottom:6px}
.team-card span{display:block;font-size:13px;font-weight:600;color:var(--primary);margin-bottom:8px}
.team-card p{font-size:13px;color:var(--text-muted)}
.cert-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:16px}
.cert-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:20px 14px;text-align:center;transition:all 0.3s}
.cert-card:hover{border-color:var(--primary);box-shadow:var(--shadow-sm)}
.cert-icon{font-size:30px;margin-bottom:10px}
.cert-card strong{display:block;font-size:14px;font-weight:700;color:var(--dark);margin-bottom:4px}
.cert-card span{font-size:12px;color:var(--text-muted)}
@media(max-width:1199px){.cert-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:991px){.about-grid{grid-template-columns:1fr}.team-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:767px){.page-hero h1{font-size:32px}.cert-grid{grid-template-columns:repeat(2,1fr)}.team-grid{grid-template-columns:repeat(2,1fr)}}
</style>
@endpush
