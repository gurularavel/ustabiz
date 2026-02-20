@extends('layouts.app')

@section('title', $service->name . ' – USTAM.AZ')

@section('content')

{{-- SERVICE HERO --}}
<section class="service-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ana səhifə</a>
            <span class="breadcrumb-sep">›</span>
            <a href="{{ route('services.index') }}">Xidmətlər</a>
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
                        Pulsuz diaqnostika
                    </div>
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        12 ay yazılı zəmanət
                    </div>
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        Sifarişdən 2 saata usta
                    </div>
                    <div class="service-hero-feature">
                        <div class="check-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        Orijinal ehtiyat hissələri
                    </div>
                </div>
                <div class="service-hero-btns">
                    <a href="tel:+994552345678" class="btn btn-primary">
                        📞 Zəng et
                    </a>
                    <a href="#sifaris" class="btn btn-outline">
                        Sifariş ver →
                    </a>
                </div>
                <div class="price-badge">
                    <div>
                        <div class="price-badge-label">Başlanğıc qiymət</div>
                        <div class="price-badge-value">{{ $service->price_from }} AZN</div>
                    </div>
                </div>
            </div>

            {{-- QUICK ORDER CARD --}}
            <div class="quick-order-card" id="sifaris">
                <div class="qo-header">
                    <h3>Sifariş ver</h3>
                    <p>Pulsuz diaqnostika + 12 ay zəmanət</p>
                </div>
                <div class="qo-body">
                    <form id="serviceOrderForm">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <div class="form-group">
                            <label>Adınız</label>
                            <input type="text" name="name" class="form-control" placeholder="Ad Soyad">
                        </div>
                        <div class="form-group">
                            <label>Telefon *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+994 XX XXX XX XX" data-phone required>
                        </div>
                        <div class="form-group">
                            <label>Ünvan</label>
                            <input type="text" name="address" class="form-control" placeholder="Küçə, ev nömrəsi">
                        </div>
                        <div class="form-group">
                            <label>Problem haqqında</label>
                            <textarea name="note" class="form-control" rows="3" placeholder="Problemin qısa təsviri..."></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitServiceOrder()" style="width:100%;justify-content:center;padding:15px">
                            Usta Çağır – Pulsuz Diaqnostika
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
            <div class="section-label">🔍 Problemlər</div>
            <h2>Hansı problemləri həll edirik?</h2>
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
            <div class="section-label">📋 Proses</div>
            <h2>Necə işləyirik?</h2>
            <p>Sadə, şəffaf, rahat. Sifarişdən işin tamamlanmasına qədər 4 addım.</p>
        </div>
        <div class="process-grid">
            <div class="process-step fade-in">
                <div class="process-num">1</div>
                <div style="font-size:30px;margin-bottom:12px">📞</div>
                <h4>Zəng / Sifariş</h4>
                <p>Zəng edin və ya formu doldurun. Operator 5 dəqiqəyə cavab verir.</p>
            </div>
            <div class="process-step fade-in" style="animation-delay:.1s">
                <div class="process-num">2</div>
                <div style="font-size:30px;margin-bottom:12px">🚗</div>
                <h4>Usta gəlir</h4>
                <p>1-2 saata sertifikatlı usta evinizə gəlir.</p>
            </div>
            <div class="process-step fade-in" style="animation-delay:.2s">
                <div class="process-num">3</div>
                <div style="font-size:30px;margin-bottom:12px">🔍</div>
                <h4>Pulsuz diaqnostika</h4>
                <p>Problem müəyyən edilir, qiymət söylənir. Razılıq olmasa ödəniş yoxdur.</p>
            </div>
            <div class="process-step fade-in" style="animation-delay:.3s">
                <div class="process-num">4</div>
                <div style="font-size:30px;margin-bottom:12px">✅</div>
                <h4>Təmir + Zəmanət</h4>
                <p>İş tamamlanır, 12 aylıq yazılı zəmanət verilir.</p>
            </div>
        </div>
    </div>
</section>

{{-- ADVANTAGES --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">⭐ Üstünlüklər</div>
            <h2>{{ $service->name }} üzrə üstünlüklərimiz</h2>
        </div>
        <div class="service-adv-grid">
            <div class="service-adv-card fade-in">
                <div class="service-adv-icon">💰</div>
                <h4>Sərfəli qiymət</h4>
                <p>{{ $service->price_from }} AZN-dən başlayan qiymətlər. Gizli ödəniş yoxdur.</p>
            </div>
            <div class="service-adv-card fade-in" style="animation-delay:.1s">
                <div class="service-adv-icon">🏆</div>
                <h4>12 ay zəmanət</h4>
                <p>Bütün işlərə yazılı zəmanət. Eyni problem yenidən olarsa – pulsuz.</p>
            </div>
            <div class="service-adv-card fade-in" style="animation-delay:.2s">
                <div class="service-adv-icon">⚙️</div>
                <h4>Orijinal hissələr</h4>
                <p>Yalnız orijinal ehtiyat hissələri. Keyfiyyətsiz hissə istifadə olunmur.</p>
            </div>
            <div class="service-adv-card fade-in" style="animation-delay:.3s">
                <div class="service-adv-icon">👨‍🔧</div>
                <h4>Peşəkar ustalar</h4>
                <p>4+ il təcrübəsi olan sertifikatlı ustalar. Hər usta sahə mütəxəssisidir.</p>
            </div>
        </div>
    </div>
</section>

{{-- BRANDS --}}
@if($service->brands && count($service->brands) > 0)
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">🤝 Brendlər</div>
            <h2>Hansı markaları təmir edirik?</h2>
            <p>{{ $service->name }} üzrə xidmət göstərdiyimiz aparıcı dünya markaları.</p>
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
            <h2>Tez-tez verilən suallar</h2>
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
            <div class="section-label">🔧 Digər xidmətlər</div>
            <h2>Digər xidmətlərimiz</h2>
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
            <h2>{{ $service->name }} üçün indi usta çağırın!</h2>
            <p>Pulsuz diaqnostika, {{ $service->price_from }} AZN-dən başlayan qiymətlər, 12 ay zəmanət.<br>Bakının bütün rayonlarına gedirik.</p>
            <div class="service-cta-btns">
                <a href="tel:+994552345678" class="btn-white">📞 +994 55 234 56 78</a>
                <a href="#sifaris" class="btn btn-outline">Sifariş ver →</a>
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
            alert('Müraciətiniz qəbul edildi! Operator sizinlə ən qısa zamanda əlaqə saxlayacaq.');
            form.reset();
        } else {
            alert('Zəhmət olmasa telefon nömrənizi daxil edin.');
        }
    })
    .catch(() => alert('Xəta baş verdi. Birbaşa zəng edin: +994 55 234 56 78'));
}
</script>
@endpush
