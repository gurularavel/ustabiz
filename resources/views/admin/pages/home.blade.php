@extends('admin.layouts.app')

@section('title', 'Ana Səhifə – Məzmun')

@section('content')

<form method="POST" action="{{ route('admin.pages.home.update') }}">
    @csrf @method('PUT')

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- SOL SÜTUN --}}
        <div>

            {{-- XİDMƏTLƏR BÖLMƏSİ --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">🔧 Xidmətlər bölməsi başlığı</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="services_label" class="form-control"
                               value="{{ old('services_label', $s['services_label'] ?? '🔧 Xidmətlərimiz') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="services_title" class="form-control"
                               value="{{ old('services_title', $s['services_title'] ?? 'Hansı texnikaya baxırıq?') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="services_desc" class="form-control" rows="2">{{ old('services_desc', $s['services_desc'] ?? '12 xidmət növü, 40+ marka, bütün model sərisi — Bakı ərazisindəki bütün müraciətlər qəbul edilir.') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- CTA BANNER --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📣 CTA Banner</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Başlıq – əsas hissə</label>
                        <input type="text" name="cta_title" class="form-control"
                               value="{{ old('cta_title', $s['cta_title'] ?? 'İndi zəng edin – ') }}">
                        <div class="form-hint">Nümunə: "İndi zəng edin – "</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq – narıncı hissə</label>
                        <input type="text" name="cta_title_span" class="form-control"
                               value="{{ old('cta_title_span', $s['cta_title_span'] ?? '30 dəqiqəyə') }}">
                        <div class="form-hint">Bu hissə narıncı rənglə göstərilir</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="cta_desc" class="form-control" rows="2">{{ old('cta_desc', $s['cta_desc'] ?? 'Pulsuz diaqnostika, münasib qiymətlər, 12 ay zəmanət. Ustalarımız Bakının bütün rayonlarına gedir.') }}</textarea>
                    </div>
                    <div class="form-hint" style="padding:10px;background:#f9fafb;border-radius:8px;border:1px solid var(--border);">
                        💡 Telefon və WhatsApp düymələri <strong>Tənzimləmələr</strong> səhifəsindəki nömrədən götürülür.
                    </div>
                </div>
            </div>

            {{-- ÜSTÜNLÜKLƏR --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">⭐ Üstünlüklər bölməsi başlığı</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="adv_label" class="form-control"
                               value="{{ old('adv_label', $s['adv_label'] ?? '⭐ Üstünlüklər') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="adv_title" class="form-control"
                               value="{{ old('adv_title', $s['adv_title'] ?? 'Niyə bizi seçirsiniz?') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="adv_desc" class="form-control" rows="2">{{ old('adv_desc', $s['adv_desc'] ?? 'Hər il minlərlə müştəri bizə etibar edir. Bu güvənin arxasında ciddi tərəfdaşlıq dayanır.') }}</textarea>
                    </div>
                    <div class="form-hint" style="padding:10px;background:#f9fafb;border-radius:8px;border:1px solid var(--border);">
                        💡 Üstünlük kartlarını <a href="{{ route('admin.services.index') }}" style="color:var(--accent);">Xidmətlər</a> bölməsindən idarə edin.
                    </div>
                </div>
            </div>

            {{-- PROSES (4 ADDIM) --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📋 "Necə işləyirik?" bölməsi</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="steps_label" class="form-control"
                               value="{{ old('steps_label', $s['steps_label'] ?? '📋 Proses') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="steps_title" class="form-control"
                               value="{{ old('steps_title', $s['steps_title'] ?? 'Necə işləyirik?') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="steps_desc" class="form-control" rows="2">{{ old('steps_desc', $s['steps_desc'] ?? 'Sadə, şəffaf, rahat. Sifariş verməkdən işin tamamlanmasına qədər 4 addım.') }}</textarea>
                    </div>

                    @foreach([
                        ['1', '📞', 'Sifariş verin', 'Zəng edin və ya formu doldurun. Operator 5 dəqiqəyə geri zəng edir.'],
                        ['2', '🚗', 'Usta gəlir', 'Sifarişdən sonra 1-2 saata usta evinizə gəlir. Fövqəladə hallarda daha tez.'],
                        ['3', '🔍', 'Pulsuz diaqnostika', 'Usta texnikanızı yoxlayır, problemi tapır. Diaqnostika tamamilə pulsuzdur.'],
                        ['4', '✅', 'Təmir + Zəmanət', 'İş tamamlanır, 12 aylıq yazılı zəmanət verilir. Ödəniş yalnız sonra.'],
                    ] as [$n, $defIcon, $defTitle, $defDesc])
                    <div style="border:1px solid var(--border);border-radius:8px;padding:14px;margin-top:14px;">
                        <div style="font-size:12px;font-weight:600;color:var(--text-muted);margin-bottom:10px;">{{ $n }}-ci addım</div>
                        <div class="form-row">
                            <div class="form-group" style="max-width:100px;margin-bottom:0;">
                                <label class="form-label">İkon</label>
                                <input type="text" name="step{{ $n }}_icon" class="form-control"
                                       value="{{ old('step'.$n.'_icon', $s['step'.$n.'_icon'] ?? $defIcon) }}"
                                       style="font-size:20px;text-align:center;">
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Başlıq</label>
                                <input type="text" name="step{{ $n }}_title" class="form-control"
                                       value="{{ old('step'.$n.'_title', $s['step'.$n.'_title'] ?? $defTitle) }}">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:10px;margin-bottom:0;">
                            <label class="form-label">Açıqlama</label>
                            <textarea name="step{{ $n }}_desc" class="form-control" rows="2">{{ old('step'.$n.'_desc', $s['step'.$n.'_desc'] ?? $defDesc) }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- SAĞ SÜTUN --}}
        <div>

            {{-- RƏYLƏR --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">💬 Rəylər bölməsi</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="reviews_label" class="form-control"
                               value="{{ old('reviews_label', $s['reviews_label'] ?? '💬 Rəylər') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="reviews_title" class="form-control"
                               value="{{ old('reviews_title', $s['reviews_title'] ?? 'Müştərilərimiz nə deyir?') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="reviews_desc" class="form-control" rows="2">{{ old('reviews_desc', $s['reviews_desc'] ?? '15 000-dən çox müştərinin real rəyləri. Ürəkdən gələn sözlər.') }}</textarea>
                    </div>
                    <div style="font-size:12px;font-weight:600;color:var(--text-muted);margin:14px 0 10px;">Statistika paneli (4 rəqəm)</div>
                    @foreach([
                        ['1','15 000+','Müştəri'],
                        ['2','4.9 / 5','Ortalama reytinq'],
                        ['3','98%','Müvəffəqiyyət dərəcəsi'],
                        ['4','12 il','Bazar təcrübəsi'],
                    ] as [$n,$defVal,$defLbl])
                    <div style="border:1px solid var(--border);border-radius:8px;padding:12px;margin-bottom:10px;">
                        <div class="form-row">
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Dəyər {{ $n }}</label>
                                <input type="text" name="reviews_stat{{ $n }}_value" class="form-control"
                                       value="{{ old('reviews_stat'.$n.'_value', $s['reviews_stat'.$n.'_value'] ?? $defVal) }}"
                                       placeholder="{{ $defVal }}">
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Mətn {{ $n }}</label>
                                <input type="text" name="reviews_stat{{ $n }}_label" class="form-control"
                                       value="{{ old('reviews_stat'.$n.'_label', $s['reviews_stat'.$n.'_label'] ?? $defLbl) }}"
                                       placeholder="{{ $defLbl }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- BRENDLƏR --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">🤝 Brendlər bölməsi başlığı</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="partners_label" class="form-control"
                               value="{{ old('partners_label', $s['partners_label'] ?? '🤝 Brendlər') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="partners_title" class="form-control"
                               value="{{ old('partners_title', $s['partners_title'] ?? 'Xidmət göstərdiyimiz markalar') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="partners_desc" class="form-control" rows="2">{{ old('partners_desc', $s['partners_desc'] ?? '40+ aparıcı dünya markasının texnikasını təmir edirik. Orijinal ehtiyat hissələri.') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- FAQ --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">❓ FAQ bölməsi başlığı</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="faq_label" class="form-control"
                               value="{{ old('faq_label', $s['faq_label'] ?? '❓ Suallar') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="faq_title" class="form-control"
                               value="{{ old('faq_title', $s['faq_title'] ?? 'Tez-tez verilən suallar') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="faq_desc" class="form-control" rows="2">{{ old('faq_desc', $s['faq_desc'] ?? 'Ən çox soruşulan sualların cavablarını burada tapa bilərsiniz.') }}</textarea>
                    </div>
                    <div class="form-hint" style="padding:10px;background:#f9fafb;border-radius:8px;border:1px solid var(--border);">
                        💡 FAQ suallarını <a href="{{ route('admin.faqs.index') }}" style="color:var(--accent);">FAQ</a> bölməsindən idarə edin.
                    </div>
                </div>
            </div>

            {{-- ƏLAQƏ BÖLMƏSİ (ev səhifəsi) --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📬 Əlaqə bölməsi başlığı (ev səhifəsi)</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text" name="home_contact_label" class="form-control"
                               value="{{ old('home_contact_label', $s['home_contact_label'] ?? '📬 Əlaqə') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="home_contact_title" class="form-control"
                               value="{{ old('home_contact_title', $s['home_contact_title'] ?? 'Bizimlə əlaqə saxlayın') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir</label>
                        <textarea name="home_contact_desc" class="form-control" rows="2">{{ old('home_contact_desc', $s['home_contact_desc'] ?? 'Hər hansı sualınız varsa, zəng edin. Və ya formu doldurun, biz sizə zəng edək.') }}</textarea>
                    </div>
                    <div class="form-hint" style="padding:10px;background:#f9fafb;border-radius:8px;border:1px solid var(--border);">
                        💡 Telefon, ünvan, e-mail məlumatları <a href="{{ route('admin.settings') }}" style="color:var(--accent);">Tənzimləmələr</a> səhifəsindən idarə olunur.
                    </div>
                </div>
            </div>

            {{-- SAXLA --}}
            <div style="position:sticky;bottom:20px;">
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:15px;">
                    💾 Dəyişiklikləri saxla
                </button>
            </div>

        </div>
    </div>
</form>

@endsection
