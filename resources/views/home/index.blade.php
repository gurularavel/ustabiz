@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_title', 'USTA.BİZ.AZ – Bakıda Peşəkar Ev Texnikası Təmiri'))

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg-shapes">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
    </div>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content fade-in">
                <div class="hero-label">
                    <span class="hero-label-dot"></span>
                    {{ \App\Models\Setting::get('hero_label', 'Bakıda №1 Texnika Təmiri') }}
                </div>
                <h1>{{ \App\Models\Setting::get('hero_title', 'Evinizin texnikası') }}<br><span>{{ \App\Models\Setting::get('hero_title_span', 'etibarlı əllərdədir') }}</span></h1>
                <p class="hero-desc">{{ \App\Models\Setting::get('hero_desc', '') }}</p>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <strong>{{ \App\Models\Setting::get('hero_stat1_value', '15 000+') }}</strong>
                        <span>{{ \App\Models\Setting::get('hero_stat1_label', 'Müştəri') }}</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <strong>{{ \App\Models\Setting::get('hero_stat2_value', '12 il') }}</strong>
                        <span>{{ \App\Models\Setting::get('hero_stat2_label', 'Təcrübə') }}</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <strong>{{ \App\Models\Setting::get('hero_stat3_value', '98%') }}</strong>
                        <span>{{ \App\Models\Setting::get('hero_stat3_label', 'Müvəffəqiyyət') }}</span>
                    </div>
                </div>
                <div class="hero-trust">
                    <div class="trust-avatars">
                        <div class="trust-avatar" style="background:#2f96dc">E</div>
                        <div class="trust-avatar" style="background:#2f96dc">L</div>
                        <div class="trust-avatar" style="background:#22C55E">R</div>
                    </div>
                    @php
                        $heroTrustCount = \App\Models\Setting::get('hero_trust_count', '240+');
                        $heroTrustText = str_replace(':count', $heroTrustCount, site_text('home_hero_trust_text', 'Son 7 gündə :count müştəriyə xidmət göstərdik'));
                    @endphp
                    <p>{!! str_replace($heroTrustCount, '<strong>' . e($heroTrustCount) . '</strong>', e($heroTrustText)) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section class="section section-alt" id="xidmetler">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ \App\Models\Setting::get('services_label', '🔧 Xidmətlərimiz') }}</div>
            <h2>{{ \App\Models\Setting::get('services_title', 'Hansı texnikaya baxırıq?') }}</h2>
            <p>{{ \App\Models\Setting::get('services_desc', '12 xidmət növü, 40+ marka, bütün model sərisi — Bakı ərazisindəki bütün müraciətlər qəbul edilir.') }}</p>
        </div>
        <div class="services-grid">
            @foreach($services as $service)
            <a href="{{ route('services.show', $service->slug) }}" class="service-card fade-in">
                <div class="service-card-icon">{{ $service->icon }}</div>
                <div class="service-card-body">
                    <h3>{{ $service->name }}</h3>
                    <p>{{ Str::limit($service->description, 80) }}</p>
                </div>
                <div class="service-card-footer">
                    <span class="service-price">{{ $service->price_from }} AZN-dən</span>
                    <span class="service-arrow">→</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA BANNER --}}
<section class="cta-banner">
    <div class="container">
        <div class="cta-banner-inner">
            <div class="cta-banner-text">
                <h2>{{ \App\Models\Setting::get('cta_title', 'İndi zəng edin – ') }}<span>{{ \App\Models\Setting::get('cta_title_span', '30 dəqiqəyə') }}</span> cavab alın!</h2>
                <p>{{ \App\Models\Setting::get('cta_desc', 'Pulsuz diaqnostika, münasib qiymətlər, 12 ay zəmanət. Ustalarımız Bakının bütün rayonlarına gedir.') }}</p>
            </div>
            <div class="cta-banner-actions">
                @php $phone = \App\Models\Setting::get('phone', '+994552345678'); $phoneClean = preg_replace('/\D/', '', $phone); @endphp
                <a href="tel:+{{ $phoneClean }}" class="btn btn-primary">
                    📞 {{ $phone }}
                </a>
                <a href="{{ \App\Models\Setting::get('whatsapp_url', 'https://wa.me/994552345678') }}" class="btn btn-outline" target="_blank">
                    💬 {{ site_text('home_cta_whatsapp_btn', 'WhatsApp') }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ADVANTAGES --}}
<section class="section" id="ustunlukler">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ \App\Models\Setting::get('adv_label', '⭐ Üstünlüklər') }}</div>
            <h2>{{ \App\Models\Setting::get('adv_title', 'Niyə bizi seçirsiniz?') }}</h2>
            <p>{{ \App\Models\Setting::get('adv_desc', 'Hər il minlərlə müştəri bizə etibar edir. Bu güvənin arxasında ciddi tərəfdaşlıq dayanır.') }}</p>
        </div>
        <div class="adv-grid">
            @foreach($advantages as $adv)
            <div class="adv-card fade-in">
                <div class="adv-icon">{{ $adv->icon }}</div>
                <h3>{{ $adv->title }}</h3>
                <p>{{ $adv->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="section section-alt" id="proses">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ \App\Models\Setting::get('steps_label', '📋 Proses') }}</div>
            <h2>{{ \App\Models\Setting::get('steps_title', 'Necə işləyirik?') }}</h2>
            <p>{{ \App\Models\Setting::get('steps_desc', 'Sadə, şəffaf, rahat. Sifariş verməkdən işin tamamlanmasına qədər 4 addım.') }}</p>
        </div>
        <div class="steps-grid">
            <div class="step-card fade-in">
                <div class="step-num">1</div>
                <div class="step-icon">{{ \App\Models\Setting::get('step1_icon', '📞') }}</div>
                <h3>{{ \App\Models\Setting::get('step1_title', 'Sifariş verin') }}</h3>
                <p>{{ \App\Models\Setting::get('step1_desc', 'Zəng edin və ya formu doldurun. Operator 5 dəqiqəyə geri zəng edir.') }}</p>
            </div>
            <div class="step-card fade-in" style="animation-delay:0.1s">
                <div class="step-num">2</div>
                <div class="step-icon">{{ \App\Models\Setting::get('step2_icon', '🚗') }}</div>
                <h3>{{ \App\Models\Setting::get('step2_title', 'Usta gəlir') }}</h3>
                <p>{{ \App\Models\Setting::get('step2_desc', 'Sifarişdən sonra 1-2 saata usta evinizə gəlir. Fövqəladə hallarda daha tez.') }}</p>
            </div>
            <div class="step-card fade-in" style="animation-delay:0.2s">
                <div class="step-num">3</div>
                <div class="step-icon">{{ \App\Models\Setting::get('step3_icon', '🔍') }}</div>
                <h3>{{ \App\Models\Setting::get('step3_title', 'Pulsuz diaqnostika') }}</h3>
                <p>{{ \App\Models\Setting::get('step3_desc', 'Usta texnikanızı yoxlayır, problemi tapır. Diaqnostika tamamilə pulsuzdur.') }}</p>
            </div>
            <div class="step-card fade-in" style="animation-delay:0.3s">
                <div class="step-num">4</div>
                <div class="step-icon">{{ \App\Models\Setting::get('step4_icon', '✅') }}</div>
                <h3>{{ \App\Models\Setting::get('step4_title', 'Təmir + Zəmanət') }}</h3>
                <p>{{ \App\Models\Setting::get('step4_desc', 'İş tamamlanır, 12 aylıq yazılı zəmanət verilir. Ödəniş yalnız sonra.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="section" id="reylər">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ \App\Models\Setting::get('reviews_label', '💬 Rəylər') }}</div>
            <h2>{{ \App\Models\Setting::get('reviews_title', 'Müştərilərimiz nə deyir?') }}</h2>
            <p>{{ \App\Models\Setting::get('reviews_desc', '15 000-dən çox müştərinin real rəyləri. Ürəkdən gələn sözlər.') }}</p>
        </div>
        <div class="reviews-grid">
            @foreach($testimonials as $t)
            <div class="review-card fade-in">
                <div class="review-stars">{{ str_repeat('★', $t->stars) }}</div>
                <p class="review-text">"{{ $t->text }}"</p>
                <div class="review-author">
                    <div class="review-avatar">{{ $t->avatar_initial }}</div>
                    <div>
                        <strong>{{ $t->name }}</strong>
                        <span>{{ $t->date }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="stats-bar">
            <div class="stat-item">
                <strong>{{ \App\Models\Setting::get('reviews_stat1_value', '15 000+') }}</strong>
                <span>{{ \App\Models\Setting::get('reviews_stat1_label', 'Müştəri') }}</span>
            </div>
            <div class="stat-item">
                <strong>{{ \App\Models\Setting::get('reviews_stat2_value', '4.9 / 5') }}</strong>
                <span>{{ \App\Models\Setting::get('reviews_stat2_label', 'Ortalama reytinq') }}</span>
            </div>
            <div class="stat-item">
                <strong>{{ \App\Models\Setting::get('reviews_stat3_value', '98%') }}</strong>
                <span>{{ \App\Models\Setting::get('reviews_stat3_label', 'Müvəffəqiyyət dərəcəsi') }}</span>
            </div>
            <div class="stat-item">
                <strong>{{ \App\Models\Setting::get('reviews_stat4_value', '12 il') }}</strong>
                <span>{{ \App\Models\Setting::get('reviews_stat4_label', 'Bazar təcrübəsi') }}</span>
            </div>
        </div>
    </div>
</section>

{{-- PARTNERS --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ \App\Models\Setting::get('partners_label', '🤝 Brendlər') }}</div>
            <h2>{{ \App\Models\Setting::get('partners_title', 'Xidmət göstərdiyimiz markalar') }}</h2>
            <p>{{ \App\Models\Setting::get('partners_desc', '40+ aparıcı dünya markasının texnikasını təmir edirik. Orijinal ehtiyat hissələri.') }}</p>
        </div>
        <div class="partners-grid">
            @foreach($partners as $partner)
            <div class="partner-chip">{{ $partner }}</div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="section" id="faq">
    <div class="container">
        <div class="section-header">
            <div class="section-label">{{ \App\Models\Setting::get('faq_label', '❓ Suallar') }}</div>
            <h2>{{ \App\Models\Setting::get('faq_title', 'Tez-tez verilən suallar') }}</h2>
            <p>{{ \App\Models\Setting::get('faq_desc', 'Ən çox soruşulan sualların cavablarını burada tapa bilərsiniz.') }}</p>
        </div>
        <div class="faq-list">
            @foreach($faqs as $i => $faq)
            <div class="faq-item {{ $i === 0 ? 'active' : '' }}" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>{{ $faq->question }}</span>
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">{{ $faq->answer }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* HERO */
.hero{background:var(--white);color:var(--dark);padding:90px 0 100px;position:relative;overflow:hidden}
@php $heroBgDesktop=\App\Models\Setting::get('hero_bg_desktop','');$heroBgMobile=\App\Models\Setting::get('hero_bg_mobile',''); @endphp
@if($heroBgDesktop).hero{background-image:url('{{ asset($heroBgDesktop) }}');background-size:contain;background-position:bottom right;background-repeat:no-repeat}@media(max-width:767px){.hero{padding-bottom:280px;background-size:166%;background-position:89% bottom}}@endif
.hero-bg-shapes{position:absolute;inset:0;pointer-events:none}
.hero-shape{position:absolute;border-radius:50%}
.hero-shape-1{width:600px;height:600px;background:radial-gradient(circle,rgba(47,150,220,0.18) 0%,transparent 70%);top:-100px;right:-100px}
.hero-shape-2{width:400px;height:400px;background:radial-gradient(circle,rgba(47,150,220,0.4) 0%,transparent 70%);bottom:-50px;left:10%}
.hero-grid{display:grid;grid-template-columns:1fr;max-width:760px;position:relative;z-index:1}
.hero-label{display:inline-flex;align-items:center;gap:8px;background:rgba(47,150,220,0.18);border:1px solid rgba(47,150,220,0.35);border-radius:100px;padding:6px 16px;font-size:13px;font-weight:500;color:var(--primary);margin-bottom:24px}
.hero-label-dot{width:8px;height:8px;background:var(--primary);border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:0.4}}
.hero-content.fade-in h1{font-size:70px;font-weight:900;line-height:1.05;letter-spacing:-2px;margin-bottom:20px}
.hero-content.fade-in h1 span{color:var(--primary)}
.hero-desc{font-size:17px;color:var(--text-muted);margin-bottom:36px;line-height:1.7;max-width:500px}
.hero-stats{display:flex;align-items:center;gap:24px;margin-bottom:28px}
.hero-stat strong{display:block;font-size:26px;font-weight:800;color:var(--dark)}
.hero-stat span{font-size:13px;color:var(--text-muted)}
.hero-stat-divider{width:1px;height:40px;background:var(--border)}
.hero-trust{display:flex;align-items:center;gap:12px}
.trust-avatars{display:flex}
.trust-avatar{width:36px;height:36px;border-radius:50%;border:2px solid var(--white);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;color:#fff;margin-left:-8px}
.trust-avatar:first-child{margin-left:0}
.hero-trust p{font-size:14px;color:var(--text-muted)}
.hero-trust strong{color:var(--primary)}
/* SERVICES */
.services-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.service-card{background:var(--white);border-radius:var(--radius);padding:28px 24px;border:1.5px solid var(--border);display:flex;flex-direction:column;gap:14px;transition:all 0.3s}
.service-card:hover{border-color:var(--primary);box-shadow:var(--shadow-md);transform:translateY(-4px)}
.service-card-icon{width:60px;height:60px;background:var(--primary-light);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px}
.service-card-body h3{font-size:16px;font-weight:700;color:var(--dark);margin-bottom:8px}
.service-card-body p{font-size:13.5px;color:var(--text-muted);line-height:1.55}
.service-card-footer{margin-top:auto;display:flex;align-items:center;justify-content:space-between}
.service-price{font-size:13px;font-weight:600;color:var(--primary);background:var(--primary-light);padding:4px 12px;border-radius:100px}
.service-arrow{font-size:18px;color:var(--text-muted);transition:transform 0.2s}
.service-card:hover .service-arrow{transform:translateX(4px);color:var(--primary)}
/* CTA BANNER */
.cta-banner{background:linear-gradient(135deg,var(--navy) 0%,#0D1F3C 100%);padding:60px 0}
.cta-banner-inner{display:flex;align-items:center;justify-content:space-between;gap:40px}
.cta-banner-text h2{font-size:34px;font-weight:800;color:#fff;letter-spacing:-1px;margin-bottom:10px}
.cta-banner-text h2 span{color:var(--primary)}
.cta-banner-text p{font-size:16px;color:rgba(255,255,255,0.65)}
.cta-banner-actions{display:flex;gap:14px;flex-shrink:0}
/* ADVANTAGES */
.adv-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:20px}
.adv-card{background:var(--white);border-radius:var(--radius);padding:30px 22px;border:1.5px solid var(--border);text-align:center;transition:all 0.3s}
.adv-card:hover{border-color:var(--primary);box-shadow:var(--shadow-sm);transform:translateY(-3px)}
.adv-icon{font-size:36px;margin-bottom:16px}
.adv-card h3{font-size:15px;font-weight:700;color:var(--dark);margin-bottom:10px}
.adv-card p{font-size:13.5px;color:var(--text-muted);line-height:1.6}
/* HOW IT WORKS */
.steps-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;position:relative}
.steps-grid::before{content:'';position:absolute;top:56px;left:12%;right:12%;height:2px;background:linear-gradient(90deg,var(--primary),var(--navy));z-index:0}
.step-card{text-align:center;background:var(--white);border-radius:var(--radius);padding:32px 20px;border:1.5px solid var(--border);position:relative;z-index:1;transition:all 0.3s}
.step-card:hover{border-color:var(--primary);box-shadow:var(--shadow-sm)}
.step-num{position:absolute;top:-16px;left:50%;transform:translateX(-50%);width:32px;height:32px;background:var(--primary);border-radius:50%;font-size:13px;font-weight:800;color:#fff;display:flex;align-items:center;justify-content:center;border:3px solid var(--bg)}
.step-icon{font-size:40px;margin:8px 0 14px}
.step-card h3{font-size:15px;font-weight:700;color:var(--dark);margin-bottom:10px}
.step-card p{font-size:13.5px;color:var(--text-muted);line-height:1.6}
/* TESTIMONIALS */
.reviews-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:50px}
.review-card{background:var(--white);border-radius:var(--radius);padding:28px;border:1.5px solid var(--border);transition:all 0.3s}
.review-card:hover{border-color:var(--primary);box-shadow:var(--shadow-sm)}
.review-stars{color:#F59E0B;font-size:16px;letter-spacing:2px;margin-bottom:14px}
.review-text{font-size:14.5px;color:var(--text-muted);line-height:1.7;margin-bottom:20px;font-style:italic}
.review-author{display:flex;align-items:center;gap:12px}
.review-avatar{width:42px;height:42px;background:linear-gradient(135deg,var(--primary),var(--navy));border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;color:#fff;flex-shrink:0}
.review-author strong{display:block;font-size:14px;font-weight:600;color:var(--dark)}
.review-author span{font-size:12.5px;color:var(--text-muted)}
.stats-bar{display:grid;grid-template-columns:repeat(4,1fr);background:var(--navy);border-radius:var(--radius);overflow:hidden}
.stat-item{padding:30px;text-align:center;border-right:1px solid rgba(255,255,255,0.1)}
.stat-item:last-child{border-right:none}
.stat-item strong{display:block;font-size:30px;font-weight:800;color:var(--white);margin-bottom:6px}
.stat-item span{font-size:13.5px;color:rgba(255,255,255,0.55)}
/* PARTNERS */
.partners-grid{display:flex;flex-wrap:wrap;gap:14px;justify-content:center}
.partner-chip{background:var(--white);border:1.5px solid var(--border);border-radius:12px;padding:14px 28px;font-size:15px;font-weight:700;color:var(--text-muted);transition:all 0.3s}
.partner-chip:hover{border-color:var(--primary);color:var(--primary)}
/* RESPONSIVE */
@media(max-width:1199px){.hero-content.fade-in h1{font-size:60px}.adv-grid{grid-template-columns:repeat(3,1fr)}.services-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:991px){.hero-content.fade-in h1{font-size:52px}.hero{padding:72px 0 80px}.cta-banner-inner{flex-direction:column;text-align:center}.cta-banner-actions{justify-content:center}.services-grid{grid-template-columns:repeat(2,1fr)}.adv-grid{grid-template-columns:repeat(2,1fr)}.steps-grid{grid-template-columns:repeat(2,1fr)}.steps-grid::before{display:none}.reviews-grid{grid-template-columns:repeat(2,1fr)}.stats-bar{grid-template-columns:repeat(2,1fr)}.stat-item:nth-child(2){border-right:none}.stat-item:nth-child(3){border-top:1px solid rgba(255,255,255,0.1)}.stat-item{padding:22px}}
@media(max-width:767px){.hero{padding:52px 0 60px}.hero-content.fade-in h1{font-size:52px;letter-spacing:-1px}.hero-desc{font-size:15px}.hero-stats{flex-wrap:wrap;gap:10px 18px}.hero-stat-divider{display:none}.hero-stat strong{font-size:18px}.services-grid{grid-template-columns:repeat(2,1fr)}.adv-grid{grid-template-columns:1fr 1fr}.steps-grid{grid-template-columns:1fr}.reviews-grid{grid-template-columns:1fr}.stats-bar{grid-template-columns:1fr 1fr}.cta-banner{padding:40px 0}.cta-banner-text h2{font-size:22px}.stat-item{padding:18px}.partner-chip{padding:10px 18px;font-size:13px}}
@media(max-width:480px){.hero{padding:40px 0 48px}.hero-content.fade-in h1{font-size:40px}.services-grid{grid-template-columns:1fr}.adv-grid{grid-template-columns:1fr}.stats-bar{grid-template-columns:1fr}.stat-item{border-right:none;border-top:1px solid rgba(255,255,255,0.1);padding:14px 12px}.stat-item strong{font-size:24px}.cta-banner{padding:32px 0}.cta-banner-text h2{font-size:18px}.partner-chip{padding:8px 14px;font-size:12px}.review-card{padding:20px}}
</style>
@endpush

