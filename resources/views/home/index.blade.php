@extends('layouts.app')

@section('title', 'USTAM.AZ – Bakıda Peşəkar Ev Texnikası Təmiri')

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
                        <div class="trust-avatar" style="background:#FF6B35">E</div>
                        <div class="trust-avatar" style="background:#0A3161">L</div>
                        <div class="trust-avatar" style="background:#22C55E">R</div>
                    </div>
                    <p>Son 7 gündə <strong>{{ \App\Models\Setting::get('hero_trust_count', '240+') }}</strong> müştəriyə xidmət göstərdik</p>
                </div>
            </div>
            <div class="hero-form-wrap fade-in" style="animation-delay:0.2s">
                <div class="hero-form-card">
                    <div class="hf-header">
                        <div class="hf-icon">🔧</div>
                        <div>
                            <h3>{{ \App\Models\Setting::get('hero_form_title', 'Usta Çağır') }}</h3>
                            <p>{{ \App\Models\Setting::get('hero_form_subtitle', 'Pulsuz diaqnostika + 12 ay zəmanət') }}</p>
                        </div>
                    </div>
                    <form class="hf-body" id="orderForm">
                        @csrf
                        <div class="form-group">
                            <label>Xidmət növü</label>
                            <select name="service_id" class="form-control" required>
                                <option value="">Xidmət seçin...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->icon }} {{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                            <label>Ünvan</label>
                            <input type="text" name="address" class="form-control" placeholder="Küçə, ev nömrəsi">
                        </div>
                        <button type="button" class="btn btn-primary" style="width:100%;justify-content:center;padding:16px" onclick="submitOrder()">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012.18 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.15a16 16 0 006.91 6.91l1.51-1.51a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                            Usta Çağır – Pulsuz
                        </button>
                    </form>
                    <div class="hf-footer">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Məlumatlarınız tam gizli saxlanılır
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section class="section section-alt" id="xidmetler">
    <div class="container">
        <div class="section-header">
            <div class="section-label">🔧 Xidmətlərimiz</div>
            <h2>Hansı texnikaya baxırıq?</h2>
            <p>12 xidmət növü, 40+ marka, bütün model sərisi — Bakı ərazisindəki bütün müraciətlər qəbul edilir.</p>
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
                <h2>İndi zəng edin – <span>30 dəqiqəyə</span> cavab alın!</h2>
                <p>Pulsuz diaqnostika, münasib qiymətlər, 12 ay zəmanət. Ustalarımız Bakının bütün rayonlarına gedir.</p>
            </div>
            <div class="cta-banner-actions">
                <a href="tel:+994552345678" class="btn btn-primary">
                    📞 +994 55 234 56 78
                </a>
                <a href="https://wa.me/994552345678" class="btn btn-outline" target="_blank">
                    💬 WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ADVANTAGES --}}
<section class="section" id="ustunlukler">
    <div class="container">
        <div class="section-header">
            <div class="section-label">⭐ Üstünlüklər</div>
            <h2>Niyə bizi seçirsiniz?</h2>
            <p>Hər il minlərlə müştəri bizə etibar edir. Bu güvənin arxasında ciddi tərəfdaşlıq dayanır.</p>
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
            <div class="section-label">📋 Proses</div>
            <h2>Necə işləyirik?</h2>
            <p>Sadə, şəffaf, rahat. Sifariş verməkdən işin tamamlanmasına qədər 4 addım.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card fade-in">
                <div class="step-num">1</div>
                <div class="step-icon">📞</div>
                <h3>Sifariş verin</h3>
                <p>Zəng edin və ya formu doldurun. Operator 5 dəqiqəyə geri zəng edir.</p>
            </div>
            <div class="step-card fade-in" style="animation-delay:0.1s">
                <div class="step-num">2</div>
                <div class="step-icon">🚗</div>
                <h3>Usta gəlir</h3>
                <p>Sifarişdən sonra 1-2 saata usta evinizə gəlir. Fövqəladə hallarda daha tez.</p>
            </div>
            <div class="step-card fade-in" style="animation-delay:0.2s">
                <div class="step-num">3</div>
                <div class="step-icon">🔍</div>
                <h3>Pulsuz diaqnostika</h3>
                <p>Usta texnikanızı yoxlayır, problemi tapır. Diaqnostika tamamilə pulsuzdur.</p>
            </div>
            <div class="step-card fade-in" style="animation-delay:0.3s">
                <div class="step-num">4</div>
                <div class="step-icon">✅</div>
                <h3>Təmir + Zəmanət</h3>
                <p>İş tamamlanır, 12 aylıq yazılı zəmanət verilir. Ödəniş yalnız sonra.</p>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="section" id="reylər">
    <div class="container">
        <div class="section-header">
            <div class="section-label">💬 Rəylər</div>
            <h2>Müştərilərimiz nə deyir?</h2>
            <p>15 000-dən çox müştərinin real rəyləri. Ürəkdən gələn sözlər.</p>
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
                <strong>15 000+</strong>
                <span>Müştəri</span>
            </div>
            <div class="stat-item">
                <strong>4.9 / 5</strong>
                <span>Ortalama reytinq</span>
            </div>
            <div class="stat-item">
                <strong>98%</strong>
                <span>Müvəffəqiyyət dərəcəsi</span>
            </div>
            <div class="stat-item">
                <strong>12 il</strong>
                <span>Bazar təcrübəsi</span>
            </div>
        </div>
    </div>
</section>

{{-- PARTNERS --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-label">🤝 Brendlər</div>
            <h2>Xidmət göstərdiyimiz markalar</h2>
            <p>40+ aparıcı dünya markasının texnikasını təmir edirik. Orijinal ehtiyat hissələri.</p>
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
            <div class="section-label">❓ Suallar</div>
            <h2>Tez-tez verilən suallar</h2>
            <p>Ən çox soruşulan sualların cavablarını burada tapa bilərsiniz.</p>
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

{{-- CONTACT --}}
<section class="section section-alt" id="elaqe">
    <div class="container">
        <div class="section-header">
            <div class="section-label">📬 Əlaqə</div>
            <h2>Bizimlə əlaqə saxlayın</h2>
            <p>Hər hansı sualınız varsa, zəng edin. Və ya formu doldurun, biz sizə zəng edək.</p>
        </div>
        <div class="contact-grid">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-item-icon">📍</div>
                    <div>
                        <strong>Ünvan</strong>
                        <span>H. Zərdabi 78V, Bakı, Azərbaycan</span>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">📞</div>
                    <div>
                        <strong>Telefon</strong>
                        <span><a href="tel:+994552345678">+994 55 234 56 78</a></span>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">⏰</div>
                    <div>
                        <strong>İş saatları</strong>
                        <span>Hər gün: 08:00 – 22:00</span>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">✉️</div>
                    <div>
                        <strong>E-mail</strong>
                        <span><a href="mailto:info@ustam.az">info@ustam.az</a></span>
                    </div>
                </div>
            </div>
            <div class="contact-form-wrap">
                <form id="contactForm">
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
                        <label>Xidmət</label>
                        <select name="service_id" class="form-control">
                            <option value="">Xidmət seçin...</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->icon }} {{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Qeyd</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Problem haqqında qısaca yazın..."></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" style="width:100%;justify-content:center;padding:16px" onclick="submitOrder('contactForm')">
                        Müraciət göndər →
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* HERO */
.hero{background:linear-gradient(135deg,var(--dark) 0%,var(--dark-2) 55%,#0A1628 100%);color:var(--white);padding:90px 0 100px;position:relative;overflow:hidden}
.hero-bg-shapes{position:absolute;inset:0;pointer-events:none}
.hero-shape{position:absolute;border-radius:50%}
.hero-shape-1{width:600px;height:600px;background:radial-gradient(circle,rgba(255,107,53,0.12) 0%,transparent 70%);top:-100px;right:-100px}
.hero-shape-2{width:400px;height:400px;background:radial-gradient(circle,rgba(10,49,97,0.4) 0%,transparent 70%);bottom:-50px;left:10%}
.hero-grid{display:grid;grid-template-columns:1fr 440px;gap:80px;align-items:center;position:relative;z-index:1}
.hero-label{display:inline-flex;align-items:center;gap:8px;background:rgba(255,107,53,0.15);border:1px solid rgba(255,107,53,0.3);border-radius:100px;padding:6px 16px;font-size:13px;font-weight:500;color:var(--primary);margin-bottom:24px}
.hero-label-dot{width:8px;height:8px;background:var(--primary);border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:0.4}}
.hero-content h1{font-size:58px;font-weight:900;line-height:1.05;letter-spacing:-2px;margin-bottom:20px}
.hero-content h1 span{color:var(--primary)}
.hero-desc{font-size:17px;color:rgba(255,255,255,0.7);margin-bottom:36px;line-height:1.7;max-width:500px}
.hero-stats{display:flex;align-items:center;gap:24px;margin-bottom:28px}
.hero-stat strong{display:block;font-size:26px;font-weight:800;color:var(--white)}
.hero-stat span{font-size:13px;color:rgba(255,255,255,0.5)}
.hero-stat-divider{width:1px;height:40px;background:rgba(255,255,255,0.15)}
.hero-trust{display:flex;align-items:center;gap:12px}
.trust-avatars{display:flex}
.trust-avatar{width:36px;height:36px;border-radius:50%;border:2px solid var(--dark);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;color:#fff;margin-left:-8px}
.trust-avatar:first-child{margin-left:0}
.hero-trust p{font-size:14px;color:rgba(255,255,255,0.6)}
.hero-trust strong{color:var(--primary)}
/* HERO FORM CARD */
.hero-form-card{background:var(--white);border-radius:24px;overflow:hidden;box-shadow:0 40px 80px rgba(0,0,0,0.4)}
.hf-header{background:linear-gradient(135deg,var(--primary),var(--primary-dark));padding:24px 28px;display:flex;align-items:center;gap:14px}
.hf-icon{width:46px;height:46px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px}
.hf-header h3{font-size:19px;font-weight:700;color:#fff;margin:0 0 4px}
.hf-header p{font-size:13px;color:rgba(255,255,255,0.8);margin:0}
.hf-body{padding:24px 28px}
.hf-footer{padding:14px 28px;background:var(--bg);border-top:1px solid var(--border);display:flex;align-items:center;gap:8px;justify-content:center;font-size:13px;color:var(--text-muted)}
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
/* CONTACT */
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start}
.contact-item{display:flex;align-items:flex-start;gap:16px;margin-bottom:24px}
.contact-item-icon{width:48px;height:48px;background:var(--primary-light);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.contact-item strong{display:block;font-size:14px;font-weight:600;color:var(--dark);margin-bottom:4px}
.contact-item span{font-size:15px;color:var(--text-muted)}
.contact-item a{color:var(--primary)}
.contact-form-wrap{background:var(--white);border-radius:var(--radius);padding:36px;border:1.5px solid var(--border)}
textarea.form-control{resize:vertical;min-height:90px}
/* RESPONSIVE */
@media(max-width:1199px){.hero-grid{grid-template-columns:1fr 380px;gap:50px}.hero-content h1{font-size:46px}.adv-grid{grid-template-columns:repeat(3,1fr)}.services-grid{grid-template-columns:repeat(3,1fr)}.contact-grid{gap:40px}}
@media(max-width:991px){.hero-grid{grid-template-columns:1fr}.hero-form-wrap{max-width:500px}.hero-content h1{font-size:38px}.hero{padding:72px 0 80px}.cta-banner-inner{flex-direction:column;text-align:center}.cta-banner-actions{justify-content:center}.services-grid{grid-template-columns:repeat(2,1fr)}.adv-grid{grid-template-columns:repeat(2,1fr)}.steps-grid{grid-template-columns:repeat(2,1fr)}.steps-grid::before{display:none}.reviews-grid{grid-template-columns:repeat(2,1fr)}.stats-bar{grid-template-columns:repeat(2,1fr)}.stat-item:nth-child(2){border-right:none}.stat-item:nth-child(3){border-top:1px solid rgba(255,255,255,0.1)}.contact-grid{grid-template-columns:1fr}.stat-item{padding:22px}.contact-form-wrap{padding:28px}}
@media(max-width:767px){.hero{padding:52px 0 60px}.hero-content h1{font-size:28px;letter-spacing:-1px}.hero-desc{font-size:15px}.hero-stats{flex-wrap:wrap;gap:10px 18px}.hero-stat-divider{display:none}.hero-stat strong{font-size:18px}.services-grid{grid-template-columns:repeat(2,1fr)}.adv-grid{grid-template-columns:1fr 1fr}.steps-grid{grid-template-columns:1fr}.reviews-grid{grid-template-columns:1fr}.stats-bar{grid-template-columns:1fr 1fr}.cta-banner{padding:40px 0}.cta-banner-text h2{font-size:22px}.stat-item{padding:18px}.contact-form-wrap{padding:20px}.partner-chip{padding:10px 18px;font-size:13px}.hf-body{padding:18px 20px}.hf-header{padding:18px 22px}}
@media(max-width:480px){.hero{padding:40px 0 48px}.hero-content h1{font-size:24px}.services-grid{grid-template-columns:1fr}.adv-grid{grid-template-columns:1fr}.stats-bar{grid-template-columns:1fr}.stat-item{border-right:none;border-top:1px solid rgba(255,255,255,0.1);padding:14px 12px}.stat-item strong{font-size:24px}.cta-banner{padding:32px 0}.cta-banner-text h2{font-size:18px}.contact-form-wrap{padding:16px}.partner-chip{padding:8px 14px;font-size:12px}.review-card{padding:20px}.hf-body{padding:14px 16px}.hf-header{padding:16px 18px}.hf-footer{padding:12px 16px}}
</style>
@endpush

@push('scripts')
<script>
function submitOrder(formId) {
    const form = document.getElementById(formId || 'orderForm');
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
