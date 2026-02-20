<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'USTA.AZ – Eviniz üçün professional xidmət')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @stack('styles')
</head>
<body>

{{-- TOPBAR --}}
<div class="topbar">
    <div class="container">
        <div class="topbar-inner">
            <div class="topbar-left">
                <div class="topbar-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ \App\Models\Setting::get('address', 'H. Zərdabi 78V, Bakı, Azərbaycan') }}
                </div>
                <div class="topbar-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ \App\Models\Setting::get('working_hours', 'Hər gün: 08:00 – 22:00') }}
                </div>
                <div class="topbar-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    {{ \App\Models\Setting::get('email', 'info@ustam.az') }}
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-social">
                    <a href="{{ \App\Models\Setting::get('facebook_url', '#') }}" title="Facebook"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
                    <a href="{{ \App\Models\Setting::get('instagram_url', '#') }}" title="Instagram"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
                    <a href="{{ \App\Models\Setting::get('whatsapp_url', '#') }}" title="WhatsApp"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
                </div>
                {{-- <button class="lang-btn active">AZ</button> --}}
                {{-- <button class="lang-btn">RU</button> --}}
            </div>
        </div>
    </div>
</div>

{{-- HEADER --}}
<header class="header">
    <div class="container">
        <div class="header-inner">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <span class="logo-text">USTA<span>.AZ</span></span>
            </a>

            <nav class="nav">
                <div class="dropdown">
                    <a href="{{ route('services.index') }}" class="nav-link has-dropdown {{ request()->routeIs('services.*') ? 'active' : '' }}">
                        Xidmətlər
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </a>
                    <div class="dropdown-menu">
                        @foreach(\App\Models\Service::where('is_active',true)->orderBy('sort_order')->get() as $s)
                        <a href="{{ route('services.show', $s->slug) }}" class="dropdown-item">
                            <div class="dropdown-item-icon">{{ $s->icon }}</div>
                            {{ $s->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Haqqımızda</a>
                <a href="{{ route('portfolio') }}" class="nav-link {{ request()->routeIs('portfolio') ? 'active' : '' }}">Portfolio</a>
                <a href="{{ route('home') }}#how-it-works" class="nav-link">Necə işləyir</a>
                <a href="{{ route('home') }}#faq" class="nav-link">FAQ</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Əlaqə</a>
            </nav>

            <div class="header-cta">
                <a href="tel:0505552026" class="header-phone">
                    <div class="header-phone-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0A3161" stroke-width="2.2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 015.19 12 19.79 19.79 0 012.12 3.33A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    (050) 555-20-26
                </a>
                <a href="{{ route('contact') }}" class="btn btn-primary">Sifariş et</a>
            </div>

            <div class="burger" id="burgerBtn" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</header>

{{-- MOBILE MENU --}}
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <a href="{{ route('home') }}" class="logo" onclick="toggleMenu()">
            <div class="logo-icon" style="width:36px;height:36px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
            </div>
            <span class="logo-text">USTA<span>.AZ</span></span>
        </a>
        <div class="mobile-menu-close"><button class="close-btn" onclick="toggleMenu()">✕</button></div>
    </div>
    <nav class="mobile-nav">
        <a href="{{ route('services.index') }}" class="mobile-nav-link" onclick="toggleMenu()">🔧 Xidmətlər</a>
        <a href="{{ route('about') }}" class="mobile-nav-link" onclick="toggleMenu()">ℹ️ Haqqımızda</a>
        <a href="{{ route('portfolio') }}" class="mobile-nav-link" onclick="toggleMenu()">🖼️ Portfolio</a>
        <a href="{{ route('home') }}#how-it-works" class="mobile-nav-link" onclick="toggleMenu()">📋 Necə işləyir</a>
        <a href="{{ route('home') }}#faq" class="mobile-nav-link" onclick="toggleMenu()">❓ FAQ</a>
        <div class="mobile-nav-divider"></div>
        <a href="{{ route('contact') }}" class="mobile-nav-link" onclick="toggleMenu()">📞 Əlaqə</a>
    </nav>
    <div class="mobile-contact">
        <p>Bizimlə əlaqə saxlayın:</p>
        <a href="tel:{{ preg_replace('/\D/', '', \App\Models\Setting::get('phone', '0505552026')) }}"
           class="btn btn-primary"
           style="font-size:15px;padding:14px 20px;width:100%;justify-content:center;">
            📞 {{ \App\Models\Setting::get('phone', '(050) 555-20-26') }}
        </a>
    </div>
</div>

{{-- MAIN CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a href="{{ route('home') }}" class="logo footer-logo">
                    <div class="logo-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <span class="logo-text">USTA<span style="color:#FF6B35">.AZ</span></span>
                </a>
                <p class="footer-desc">Bakı şəhərinin ən etibarlı ev texnikası təmir xidməti. 4+ il təcrübə, 4000+ uğurlu sifariş.</p>
                <div class="footer-social">
                    <a href="{{ \App\Models\Setting::get('facebook_url', '#') }}" class="social-link" title="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
                    <a href="{{ \App\Models\Setting::get('instagram_url', '#') }}" class="social-link" title="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/></svg></a>
                    <a href="{{ \App\Models\Setting::get('youtube_url', '#') }}" class="social-link" title="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.4a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg></a>
                    <a href="{{ \App\Models\Setting::get('whatsapp_url', '#') }}" class="social-link" title="WhatsApp"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Keçidlər</h4>
                <div class="footer-links">
                    <a href="{{ route('services.index') }}" class="footer-link">Xidmətlər</a>
                    <a href="{{ route('about') }}" class="footer-link">Haqqımızda</a>
                    <a href="{{ route('home') }}#how-it-works" class="footer-link">Necə işləyir</a>
                    <a href="{{ route('home') }}#faq" class="footer-link">FAQ</a>
                    <a href="{{ route('contact') }}" class="footer-link">Əlaqə</a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Xidmətlər</h4>
                <div class="footer-links">
                    @foreach(\App\Models\Service::where('is_active',true)->orderBy('sort_order')->take(6)->get() as $s)
                    <a href="{{ route('services.show', $s->slug) }}" class="footer-link">{{ $s->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="footer-col">
                <h4>Əlaqə</h4>
                <div class="footer-contact-item">
                    <div class="footer-contact-item-icon">📍</div>
                    <div><div class="footer-contact-label">Ünvan</div><div class="footer-contact-val">{{ \App\Models\Setting::get('address', 'H. Zərdabi 78V, Bakı') }}</div></div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-item-icon">📞</div>
                    <div><div class="footer-contact-label">Telefon</div><div class="footer-contact-val">{{ \App\Models\Setting::get('phone', '(050) 555-20-26') }}</div></div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-item-icon">✉️</div>
                    <div><div class="footer-contact-label">E-poçt</div><div class="footer-contact-val">{{ \App\Models\Setting::get('email', 'info@ustam.az') }}</div></div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-item-icon">🕐</div>
                    <div><div class="footer-contact-label">İş saatları</div><div class="footer-contact-val">{{ \App\Models\Setting::get('working_hours', 'Hər gün 08:00 – 22:00') }}</div></div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© {{ date('Y') }} USTA.AZ — Bütün hüquqlar qorunur.</p>
            <div class="footer-bottom-links">
                <a href="#">Məxfilik siyasəti</a>
                <a href="#">İstifadə şərtləri</a>
            </div>
        </div>
    </div>
</footer>

{{-- FLOATING CALL BUTTON --}}
<div class="float-call">
    <a href="tel:0505552026" title="Zəng edin">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 015.19 12 19.79 19.79 0 012.12 3.33A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
    </a>
</div>

<script src="{{ asset('assets/js/common.js') }}"></script>
@stack('scripts')
</body>
</html>
