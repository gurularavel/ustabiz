@extends('admin.layouts.app')

@section('title', 'Əlaqə Səhifəsi')

@section('content')

<form method="POST" action="{{ route('admin.pages.contact.update') }}">
    @csrf @method('PUT')

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- SOL SÜTUN --}}
        <div>

            {{-- HERO --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">🏷️ Səhifə hero bölməsi</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Başlıq (H1)</label>
                        <input type="text" name="contact_hero_title" class="form-control"
                               value="{{ old('contact_hero_title', $s['contact_hero_title'] ?? 'Əlaqə') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alt mətn</label>
                        <textarea name="contact_hero_desc" class="form-control" rows="3">{{ old('contact_hero_desc', $s['contact_hero_desc'] ?? 'Sualınız var? Zəng edin və ya aşağıdakı formu doldurun. 5 dəqiqəyə cavab alacaqsınız.') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- MƏLUMAт KÜTƏSİ --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📋 Əlaqə məlumatları bloku</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Başlıq (H2)</label>
                        <input type="text" name="contact_h2" class="form-control"
                               value="{{ old('contact_h2', $s['contact_h2'] ?? 'Bizimlə əlaqə saxlayın') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Giriş mətni</label>
                        <textarea name="contact_intro" class="form-control" rows="3">{{ old('contact_intro', $s['contact_intro'] ?? 'Bakının istənilən rayonunda xidmət göstəririk. Zəng edin, operator 5 dəqiqəyə geri əlaqə saxlayacaq.') }}</textarea>
                    </div>
                    <div class="form-hint" style="padding:10px;background:#f9fafb;border-radius:8px;border:1px solid var(--border);">
                        💡 Telefon, ünvan, e-mail, iş saatları və sosial şəbəkə linkləri <a href="{{ route('admin.settings') }}" style="color:var(--accent);">Tənzimləmələr</a> səhifəsindən idarə olunur.
                    </div>
                </div>
            </div>

        </div>

        {{-- SAĞ SÜTUN --}}
        <div>

            {{-- FORMA --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📝 Müraciət forması</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Forma başlığı</label>
                        <input type="text" name="contact_form_title" class="form-control"
                               value="{{ old('contact_form_title', $s['contact_form_title'] ?? 'Sifariş / Müraciət') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Forma alt mətni</label>
                        <textarea name="contact_form_desc" class="form-control" rows="3">{{ old('contact_form_desc', $s['contact_form_desc'] ?? 'Formu doldurun, operator sizinlə ən qısa zamanda əlaqə saxlayacaq.') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ÖNİZLƏMƏ --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">👁️ Cari məlumatlar</span></div>
                <div class="card-body">
                    @php
                        $items = [
                            ['📍', 'Ünvan', \App\Models\Setting::get('address', '—')],
                            ['📞', 'Telefon', \App\Models\Setting::get('phone', '—')],
                            ['✉️', 'E-mail', \App\Models\Setting::get('email', '—')],
                            ['⏰', 'İş saatları', \App\Models\Setting::get('working_hours', '—')],
                        ];
                    @endphp
                    @foreach($items as [$icon, $label, $val])
                    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--border);">
                        <span style="font-size:20px;width:28px;text-align:center;">{{ $icon }}</span>
                        <div>
                            <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;">{{ $label }}</div>
                            <div style="font-size:14px;color:#111827;">{{ $val }}</div>
                        </div>
                    </div>
                    @endforeach
                    <div style="margin-top:14px;">
                        <a href="{{ route('admin.settings') }}" class="btn btn-outline" style="width:100%;justify-content:center;">
                            ⚙️ Tənzimləmələrə keç
                        </a>
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
