@extends('layouts.app')

@section('title', 'Əlaqə – USTAM.AZ')

@section('content')

{{-- HERO --}}
<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ana səhifə</a>
            <span class="breadcrumb-sep">›</span>
            <span>Əlaqə</span>
        </nav>
        <h1>{{ \App\Models\Setting::get('contact_hero_title', 'Əlaqə') }}</h1>
        <p>{{ \App\Models\Setting::get('contact_hero_desc', 'Sualınız var? Zəng edin və ya aşağıdakı formu doldurun. 5 dəqiqəyə cavab alacaqsınız.') }}</p>
    </div>
</section>

{{-- CONTACT MAIN --}}
<section class="section">
    <div class="container">
        <div class="contact-page-grid">

            {{-- INFO --}}
            <div class="contact-info-col fade-in">
                @php
                    $addr = \App\Models\Setting::get('address', 'H. Zərdabi 78V, Bakı, Azərbaycan');
                    $phone = \App\Models\Setting::get('phone', '+994 55 234 56 78');
                    $phoneClean = preg_replace('/\D/', '', $phone);
                    $email = \App\Models\Setting::get('email', 'info@ustam.az');
                    $hours = \App\Models\Setting::get('working_hours', 'Hər gün: 08:00 – 22:00');
                    $whatsapp = \App\Models\Setting::get('whatsapp_url', 'https://wa.me/994552345678');
                    $facebook = \App\Models\Setting::get('facebook_url', '#');
                    $instagram = \App\Models\Setting::get('instagram_url', '#');
                @endphp
                <h2>{{ \App\Models\Setting::get('contact_h2', 'Bizimlə əlaqə saxlayın') }}</h2>
                <p class="contact-intro">{{ \App\Models\Setting::get('contact_intro', 'Bakının istənilən rayonunda xidmət göstəririk. Zəng edin, operator 5 dəqiqəyə geri əlaqə saxlayacaq.') }}</p>

                <div class="cp-items">
                    <div class="cp-item">
                        <div class="cp-icon">📍</div>
                        <div>
                            <strong>Ünvan</strong>
                            <span>{{ $addr }}</span>
                        </div>
                    </div>
                    <div class="cp-item">
                        <div class="cp-icon">📞</div>
                        <div>
                            <strong>Telefon</strong>
                            <a href="tel:+{{ $phoneClean }}">{{ $phone }}</a>
                        </div>
                    </div>
                    <div class="cp-item">
                        <div class="cp-icon">📱</div>
                        <div>
                            <strong>WhatsApp</strong>
                            <a href="{{ $whatsapp }}" target="_blank">{{ $phone }}</a>
                        </div>
                    </div>
                    <div class="cp-item">
                        <div class="cp-icon">✉️</div>
                        <div>
                            <strong>E-mail</strong>
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </div>
                    </div>
                    <div class="cp-item">
                        <div class="cp-icon">⏰</div>
                        <div>
                            <strong>İş saatları</strong>
                            <span>{{ $hours }}</span>
                        </div>
                    </div>
                </div>

                <div class="cp-social">
                    <h4>Sosial şəbəkələr</h4>
                    <div class="cp-social-links">
                        <a href="{{ $facebook }}" class="cp-social-link" title="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                            Facebook
                        </a>
                        <a href="{{ $instagram }}" class="cp-social-link" title="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/></svg>
                            Instagram
                        </a>
                        <a href="{{ $whatsapp }}" class="cp-social-link" title="WhatsApp" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="contact-form-col fade-in" style="animation-delay:.15s">
                <div class="contact-form-card">
                    <h3>{{ \App\Models\Setting::get('contact_form_title', 'Sifariş / Müraciət') }}</h3>
                    <p>{{ \App\Models\Setting::get('contact_form_desc', 'Formu doldurun, operator sizinlə ən qısa zamanda əlaqə saxlayacaq.') }}</p>
                    <form id="contactPageForm" style="margin-top:24px">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label>Adınız</label>
                                <input type="text" name="name" class="form-control" placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label>Telefon *</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+994 XX XXX XX XX" data-phone required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Xidmət növü</label>
                            <select name="service_id" class="form-control">
                                <option value="">Xidmət seçin...</option>
                                @php $navServices = \App\Models\Service::where('is_active',true)->orderBy('sort_order')->get(); @endphp
                                @foreach($navServices as $service)
                                    <option value="{{ $service->id }}">{{ $service->icon }} {{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ünvan</label>
                            <input type="text" name="address" class="form-control" placeholder="Küçə, ev nömrəsi, mərtəbə">
                        </div>
                        <div class="form-group">
                            <label>Problem haqqında</label>
                            <textarea name="note" class="form-control" rows="4" placeholder="Texnikanız haqqında qısaca yazın..."></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitContactForm()" style="width:100%;justify-content:center;padding:16px">
                            Müraciət Göndər →
                        </button>
                        <p class="form-note">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Məlumatlarınız tam gizli saxlanılır
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAP --}}
<section class="section section-alt" style="padding:0">
@php $mapUrl = \App\Models\Setting::get('map_url', ''); @endphp
@if($mapUrl)
    <iframe src="{{ $mapUrl }}"
            width="100%" height="340" style="border:0;display:block;max-height:45vw;min-height:180px;" allowfullscreen
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@else
    <div class="map-placeholder">
        <div class="map-label">
            <div class="map-pin">📍</div>
            <div>
                <strong>USTAM.AZ Mərkəzi Ofis</strong>
                <span>{{ \App\Models\Setting::get('address', 'H. Zərdabi 78V, Bakı') }}</span>
            </div>
        </div>
    </div>
@endif
</section>

@endsection

@push('styles')
<style>
.page-hero{background:linear-gradient(135deg,var(--dark) 0%,var(--dark-2) 60%,#0A1628 100%);padding:70px 0 80px;color:var(--white)}
.page-hero h1{font-size:48px;font-weight:900;letter-spacing:-1.5px;margin:16px 0 14px}
.page-hero p{font-size:17px;color:rgba(255,255,255,0.65);max-width:560px}
.contact-page-grid{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:start}
.contact-info-col h2{font-size:30px;font-weight:800;color:var(--dark);letter-spacing:-.5px;margin-bottom:14px}
.contact-intro{font-size:15px;color:var(--text-muted);line-height:1.7;margin-bottom:32px}
.cp-items{display:flex;flex-direction:column;gap:16px;margin-bottom:36px}
.cp-item{display:flex;align-items:flex-start;gap:14px}
.cp-icon{width:46px;height:46px;background:var(--primary-light);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.cp-item strong{display:block;font-size:13px;font-weight:600;color:var(--text-muted);margin-bottom:3px;text-transform:uppercase;letter-spacing:.4px}
.cp-item span,.cp-item a{font-size:15px;font-weight:500;color:var(--dark)}
.cp-item a{color:var(--primary)}
.cp-social h4{font-size:14px;font-weight:700;color:var(--dark);margin-bottom:14px}
.cp-social-links{display:flex;gap:12px;flex-wrap:wrap}
.cp-social-link{display:flex;align-items:center;gap:8px;padding:10px 18px;border:1.5px solid var(--border);border-radius:100px;font-size:14px;font-weight:500;color:var(--text);transition:all 0.2s}
.cp-social-link:hover{border-color:var(--primary);color:var(--primary)}
.contact-form-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--radius);padding:36px}
.contact-form-card h3{font-size:22px;font-weight:800;color:var(--dark);margin-bottom:8px}
.contact-form-card p{font-size:14.5px;color:var(--text-muted)}
textarea.form-control{resize:vertical;min-height:100px}
.form-note{display:flex;align-items:center;gap:6px;font-size:12.5px;color:var(--text-muted);margin-top:12px;justify-content:center}
.map-placeholder{height:320px;background:linear-gradient(135deg,var(--bg) 0%,#e8ecf5 100%);display:flex;align-items:center;justify-content:center;position:relative}
.map-label{display:flex;align-items:center;gap:14px;background:var(--white);padding:16px 24px;border-radius:16px;box-shadow:var(--shadow-md)}
.map-pin{font-size:32px}
.map-label strong{display:block;font-size:15px;font-weight:700;color:var(--dark)}
.map-label span{font-size:13.5px;color:var(--text-muted)}
@media(max-width:1199px){.contact-page-grid{gap:48px}}
@media(max-width:991px){.contact-page-grid{grid-template-columns:1fr;gap:36px}.page-hero h1{font-size:36px}.page-hero{padding:52px 0 62px}.contact-intro{margin-bottom:20px}}
@media(max-width:767px){.page-hero h1{font-size:26px}.page-hero p{font-size:15px}.map-placeholder{height:220px}.contact-form-card{padding:24px}.contact-form-card h3{font-size:18px}.cp-items{gap:12px}.cp-icon{width:40px;height:40px;font-size:18px}}
@media(max-width:480px){.page-hero h1{font-size:22px}.contact-form-card{padding:18px}.contact-form-card h3{font-size:16px}.cp-social-link{padding:8px 14px;font-size:12px}.map-placeholder{height:180px}}
</style>
@endpush

@push('scripts')
<script>
function submitContactForm() {
    const form = document.getElementById('contactPageForm');
    const data = new FormData(form);
    fetch('{{ route("order.store") }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json'},
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            alert('Müraciətiniz qəbul edildi! Operator sizinlə ən qısa zamanda əlaqə saxlayacaq.');
            form.reset();
        } else {
            alert('Zəhmət olmasa telefon nömrənizi daxil edin.');
        }
    })
    .catch(() => alert('Xəta baş verdi. Zəhmət olmasa birbaşa zəng edin.'));
}
</script>
@endpush
