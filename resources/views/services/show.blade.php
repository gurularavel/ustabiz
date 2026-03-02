@extends('layouts.app')

@section('title', $service->name . ' – ' . \App\Models\Setting::get('site_title', 'USTA.BİZ.AZ'))

@section('content')

{{-- SERVICE HERO --}}
<section class="service-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">{{ site_text('about_breadcrumb_home', 'Ana səhifə') }}</a>
            <span class="breadcrumb-sep">›</span>
            <a href="{{ route('services.index') }}">{{ site_text('ui_nav_services', 'Xidmətlər') }}</a>
            <span class="breadcrumb-sep">›</span>
            <span>{{ $service->name }}</span>
        </nav>

        <div class="service-hero-grid">
            <div class="service-hero-content">
                <div class="service-hero-badge">
                    {{ $service->icon }} {{ $service->name }}
                </div>
                <h1>{{ $service->name }}<br><span>Bakıda</span></h1>
                <p class="service-hero-desc">
                    {{ $service->hero_desc ?? $service->description }}
                </p>
                <div class="service-hero-features">
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        {{ site_text('service_show_badge_diagnosis', 'Pulsuz diaqnostika') }}
                    </div>
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        {{ site_text('service_show_badge_warranty', '12 ay yazılı zəmanət') }}
                    </div>
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        {{ site_text('service_show_badge_fast', 'Sifarişdən 2 saata usta') }}
                    </div>
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        {{ site_text('service_show_badge_parts', 'Orijinal ehtiyat hissələri') }}
                    </div>
                </div>
                <div class="service-hero-btns">
                    @php $phone = \App\Models\Setting::get('phone', '+994 55 234 56 78'); $phoneClean = preg_replace('/\D/', '', $phone); @endphp
                    <a href="tel:+{{ $phoneClean }}" class="btn btn-primary">
                        {{ site_text('service_show_call_btn', '📞 Zəng et') }}
                    </a>
                    <a href="#sifaris" class="btn btn-outline">
                        {{ site_text('service_show_order_btn', 'Sifariş ver →') }}
                    </a>
                </div>
                <div class="price-badge">
                    <div>
                        <div class="price-badge-label">{{ site_text('service_show_price_label', 'Başlanğıc qiymət') }}</div>
                        <div class="price-badge-value">{{ $service->price_from }} AZN</div>
                    </div>
                </div>
            </div>

            {{-- QUICK ORDER CARD --}}
            <div class="quick-order-card" id="sifaris">
                <div class="qo-header">
                    <h3>{{ site_text('service_show_form_title', 'Sifariş ver') }}</h3>
                    <p>{{ site_text('service_show_form_subtitle', 'Pulsuz diaqnostika + 12 ay zəmanət') }}</p>
                </div>
                <div class="qo-body">
                    <form id="serviceOrderForm">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <div class="form-group">
                            <label>{{ site_text('home_form_name_label', 'Adınız') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ site_text('home_form_name_placeholder', 'Ad Soyad') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ site_text('home_form_phone_label', 'Telefon *') }}</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+994 XX XXX XX XX" data-phone required>
                        </div>
                        <div class="form-group">
                            <label>{{ site_text('home_form_address_label', 'Ünvan') }}</label>
                            <input type="text" name="address" class="form-control" placeholder="{{ site_text('home_form_address_placeholder', 'Küçə, ev nömrəsi') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ site_text('home_contact_note_label', 'Qeyd') }}</label>
                            <textarea name="note" class="form-control" rows="3" placeholder="{{ site_text('service_show_problem_placeholder', 'Problemin qısa təsviri...') }}"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitServiceOrder()" style="width:100%;justify-content:center;padding:15px">
                            {{ site_text('home_form_submit', 'Usta Çağır – Pulsuz') }}
                        </button>
                    </form>
                </div>
                <div class="qo-footer">
                    ✅ Diaqnostika <strong>pulsuzdur</strong>. Ödəniş iş tamamlandıqdan sonra.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROBLEMS --}}
@if($service->problems && count($service->problems) > 0)
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ site_text('service_show_problem_label', 'Problemlər') }}</div>
            <h2>{{ site_text('service_show_problem_title', 'Hansı problemləri həll edirik?') }}</h2>
            <p>{{ $service->name }} ilə bağlı ən çox rast gəlinən problemlər.</p>
        </div>
        <div class="problems-grid">
            @foreach($service->problems as $problem)
            <div class="problem-card fade-in">
                <div class="problem-icon">{{ $problem['icon'] ?? '🔧' }}</div>
                <div>
                    <h4>{{ $problem['title'] }}</h4>
                    <p>{{ $problem['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- PROCESS --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ site_text('service_show_process_label', 'Proses') }}</div>
            <h2>{{ site_text('service_show_process_title', 'Necə işləyirik?') }}</h2>
            <p>{{ site_text('service_show_process_desc', 'Sadə, şəffaf, rahat. Sifarişdən işin tamamlanmasına qədər 4 addım.') }}</p>
        </div>
        <div class="process-grid">
            <div class="process-step fade-in">
                <div class="process-num">1</div>
                <div style="font-size:30px;margin-bottom:12px">📞</div>
                <h4>{{ site_text('service_show_step1_title', 'Zəng / Sifariş') }}</h4>
                <p>{{ site_text('service_show_step1_desc', 'Zəng edin və ya formu doldurun. Operator 5 dəqiqəyə cavab verir.') }}</p>
            </div>
            <div class="process-step fade-in" style="animation-delay:.1s">
                <div class="process-num">2</div>
                <div style="font-size:30px;margin-bottom:12px">🚗</div>
                <h4>{{ site_text('service_show_step2_title', 'Usta gəlir') }}</h4>
                <p>{{ site_text('service_show_step2_desc', '1-2 saata sertifikatlı usta evinizə gəlir.') }}</p>
            </div>
            <div class="process-step fade-in" style="animation-delay:.2s">
                <div class="process-num">3</div>
                <div style="font-size:30px;margin-bottom:12px">🔍</div>
                <h4>{{ site_text('service_show_step3_title', 'Pulsuz diaqnostika') }}</h4>
                <p>{{ site_text('service_show_step3_desc', 'Problem müəyyən edilir, qiymət söylənir. Razılıq olmasa ödəniş yoxdur.') }}</p>
            </div>
            <div class="process-step fade-in" style="animation-delay:.3s">
                <div class="process-num">4</div>
                <div style="font-size:30px;margin-bottom:12px">✅</div>
                <h4>{{ site_text('service_show_step4_title', 'Təmir + Zəmanət') }}</h4>
                <p>{{ site_text('service_show_step4_desc', 'İş tamamlanır, 12 aylıq yazılı zəmanət verilir.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ADVANTAGES --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ site_text('service_show_adv_label', '⭐ Üstünlüklər') }}</div>
            <h2>{{ $service->name }} üzrə üstünlüklərimiz</h2>
        </div>
        <div class="service-adv-grid">
            <div class="service-adv-card fade-in">
                <div class="service-adv-icon">💰</div>
                <h4>{{ site_text('service_show_adv1_title', 'Sərfəli qiymət') }}</h4>
                <p>{{ str_replace(':price', $service->price_from, site_text('service_show_adv1_desc', ':price AZN-dən başlayan qiymətlər. Gizli ödəniş yoxdur.')) }}</p>
            </div>
            <div class="service-adv-card fade-in" style="animation-delay:.1s">
                <div class="service-adv-icon">🏆</div>
                <h4>{{ site_text('service_show_adv2_title', '12 ay zəmanət') }}</h4>
                <p>{{ site_text('service_show_adv2_desc', 'Bütün işlərə yazılı zəmanət. Eyni problem yenidən olarsa – pulsuz.') }}</p>
            </div>
            <div class="service-adv-card fade-in" style="animation-delay:.2s">
                <div class="service-adv-icon">⚙️</div>
                <h4>{{ site_text('service_show_adv3_title', 'Orijinal hissələr') }}</h4>
                <p>{{ site_text('service_show_adv3_desc', 'Yalnız orijinal ehtiyat hissələri. Keyfiyyətsiz hissə istifadə olunmur.') }}</p>
            </div>
            <div class="service-adv-card fade-in" style="animation-delay:.3s">
                <div class="service-adv-icon">👨‍🔧</div>
                <h4>{{ site_text('service_show_adv4_title', 'Peşəkar ustalar') }}</h4>
                <p>{{ site_text('service_show_adv4_desc', '4+ il təcrübəsi olan sertifikatlı ustalar. Hər usta sahə mütəxəssisidir.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- BRANDS --}}
@if($service->brands && count($service->brands) > 0)
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ site_text('service_show_brands_label', '🤝 Brendlər') }}</div>
            <h2>{{ site_text('service_show_brands_title', 'Hansı markaları təmir edirik?') }}</h2>
            <p>{{ str_replace(':service', $service->name, site_text('service_show_brands_desc', ':service üzrə xidmət göstərdiyimiz aparıcı dünya markaları.')) }}</p>
        </div>
        <div class="brands-grid">
            @foreach($service->brands as $brand)
            <div class="brand-chip">{{ $brand }}</div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FAQ --}}
@if($service->faqs && count($service->faqs) > 0)
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">❓ FAQ</div>
            <h2>{{ site_text('service_show_faq_title', 'Tez-tez verilən suallar') }}</h2>
        </div>
        <div class="faq-list">
            @foreach($service->faqs as $i => $faq)
            <div class="faq-item {{ $i === 0 ? 'active' : '' }}" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>{{ $faq['q'] }}</span>
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">{{ $faq['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- OTHER SERVICES --}}
@if($otherServices->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ site_text('service_show_other_label', '🔧 Digər xidmətlər') }}</div>
            <h2>{{ site_text('service_show_other_title', 'Digər xidmətlərimiz') }}</h2>
        </div>
        <div class="other-services-grid">
            @foreach($otherServices->take(8) as $other)
            <a href="{{ route('services.show', $other->slug) }}" class="other-service-card">
                <span>{{ $other->icon }}</span>
                <span>{{ $other->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="section section-alt">
    <div class="container">
        <div class="service-cta">
            <h2>{{ $service->name }} {{ site_text('service_show_cta_suffix', 'üçün indi usta çağırın!') }}</h2>
            <p>{{ str_replace(':price', $service->price_from, site_text('service_show_cta_desc', 'Pulsuz diaqnostika, :price AZN-dən başlayan qiymətlər, 12 ay zəmanət. Bakının bütün rayonlarına gedirik.')) }}</p>
            <div class="service-cta-btns">
                <a href="tel:+{{ $phoneClean }}" class="btn-white">📞 {{ $phone }}</a>
                <a href="#sifaris" class="btn btn-outline">{{ site_text('service_show_order_btn', 'Sifariş ver →') }}</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/service.css') }}">
<style>
textarea.form-control{resize:vertical;min-height:80px}
</style>
@endpush

@push('scripts')
<script>
function submitServiceOrder() {
    const form = document.getElementById('serviceOrderForm');
    const data = new FormData(form);
    fetch('{{ route("order.store") }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json'},
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            alert(@json(site_text('alert_success', 'Müraciətiniz qəbul edildi! Operator sizinlə ən qısa zamanda əlaqə saxlayacaq.')));
            form.reset();
        } else {
            alert(@json(site_text('alert_phone_required', 'Zəhmət olmasa telefon nömrənizi daxil edin.')));
        }
    })
    .catch(() => alert(@json(site_text('alert_generic_error', 'Xəta baş verdi. Zəhmət olmasa birbaşa zəng edin.'))));
}
</script>
@endpush
