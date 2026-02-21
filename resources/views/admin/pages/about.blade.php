@extends('admin.layouts.app')

@section('title', 'Haqqımızda Səhifəsi')

@section('content')

<form method="POST" action="{{ route('admin.pages.about.update') }}">
    @csrf @method('PUT')

    {{-- PAGE HERO --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card-header"><span class="card-title">🎯 Səhifə Hero bölməsi</span></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Başlıq (H1)</label>
                    <input type="text" name="about_hero_title" class="form-control"
                           value="{{ old('about_hero_title', $s['about_hero_title'] ?? 'Haqqımızda') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Alt mətn</label>
                    <input type="text" name="about_hero_desc" class="form-control"
                           value="{{ old('about_hero_desc', $s['about_hero_desc'] ?? '2012-ci ildən Bakıda fəaliyyət göstərən, ev texnikası təmirinin etibarlı ünvanı.') }}">
                </div>
            </div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">

        {{-- STORY --}}
        <div class="card">
            <div class="card-header"><span class="card-title">📖 Hekayə bölməsi</span></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Section label</label>
                    <input type="text" name="about_story_label" class="form-control"
                           value="{{ old('about_story_label', $s['about_story_label'] ?? '📖 Hekayəmiz') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">H2 başlığı</label>
                    <input type="text" name="about_story_title" class="form-control"
                           value="{{ old('about_story_title', $s['about_story_title'] ?? '12 illik etimad') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Məzmun (HTML redaktor)</label>
                    <textarea name="about_story_content" class="form-control summernote">{{ old('about_story_content', $s['about_story_content'] ?? '<p>USTA.BİZ.AZ 2012-ci ildə 3 nəfərlik kiçik bir komanda ilə fəaliyyətə başladı. Bu gün 50-dən çox sertifikatlı usta, 15 000-dən çox razı müştəri və Bakının bütün rayonlarını əhatə edən xidmət şəbəkəmiz var.</p><p>Bizim üçün hər sifariş yalnız bir iş deyil — bu, müştərimizin evinə olan hörmətimizdir. Orijinal hissələr, yazılı zəmanət, şəffaf qiymətlər — bunlar sadəcə söz deyil, bizim prinsiplərimizdir.</p>') }}</textarea>
                </div>
            </div>
        </div>

        {{-- VALUES --}}
        <div class="card">
            <div class="card-header"><span class="card-title">💎 Dəyərlər (3 kart)</span></div>
            <div class="card-body">
                @foreach([
                    ['1', '🏆', 'Keyfiyyət', 'Hər işdə peşəkarlıq standartlarına riayət edirik'],
                    ['2', '🤝', 'Etimad',    'Şəffaf qiymətlər, gizli ödəniş yoxdur'],
                    ['3', '🚀', 'Sürət',     '2 saata usta, günün istənilən saatında'],
                ] as [$n, $defIcon, $defTitle, $defText])
                <div style="border:1px solid var(--border);border-radius:8px;padding:12px;margin-bottom:12px;">
                    <div style="font-size:11px;font-weight:600;color:var(--text-muted);margin-bottom:8px;">Dəyər {{ $n }}</div>
                    <div style="display:grid;grid-template-columns:60px 1fr 2fr;gap:8px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">İkon</label>
                            <input type="text" name="about_value{{ $n }}_icon" class="form-control"
                                   value="{{ old('about_value'.$n.'_icon', $s['about_value'.$n.'_icon'] ?? $defIcon) }}" maxlength="10">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">Başlıq</label>
                            <input type="text" name="about_value{{ $n }}_title" class="form-control"
                                   value="{{ old('about_value'.$n.'_title', $s['about_value'.$n.'_title'] ?? $defTitle) }}">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">Mətn</label>
                            <input type="text" name="about_value{{ $n }}_text" class="form-control"
                                   value="{{ old('about_value'.$n.'_text', $s['about_value'.$n.'_text'] ?? $defText) }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">

        {{-- STATS --}}
        <div class="card">
            <div class="card-header"><span class="card-title">📊 Statistika kartları (4 kart)</span></div>
            <div class="card-body">
                @foreach([
                    ['1','15 000+','Xidmət göstərilən müştəri'],
                    ['2','50+','Sertifikatlı usta'],
                    ['3','12 il','Bazar təcrübəsi'],
                    ['4','98%','Müştəri məmnuniyyəti'],
                ] as [$n,$defVal,$defLabel])
                <div style="border:1px solid var(--border);border-radius:8px;padding:12px;margin-bottom:12px;">
                    <div style="font-size:11px;font-weight:600;color:var(--text-muted);margin-bottom:8px;">Stat {{ $n }}</div>
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">Dəyər</label>
                            <input type="text" name="about_stat{{ $n }}_value" class="form-control"
                                   value="{{ old('about_stat'.$n.'_value', $s['about_stat'.$n.'_value'] ?? $defVal) }}">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">Mətn</label>
                            <input type="text" name="about_stat{{ $n }}_label" class="form-control"
                                   value="{{ old('about_stat'.$n.'_label', $s['about_stat'.$n.'_label'] ?? $defLabel) }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📣 CTA bölməsi</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Başlıq</label>
                        <input type="text" name="about_cta_title" class="form-control"
                               value="{{ old('about_cta_title', $s['about_cta_title'] ?? 'Bizimlə əlaqə saxlayın') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mətn</label>
                        <textarea name="about_cta_desc" class="form-control" rows="3">{{ old('about_cta_desc', $s['about_cta_desc'] ?? 'Texnikanız üçün peşəkar yardıma ehtiyacınız varsa, biz buradayıq.') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TEAM: ayrıca idarə olunur --}}
    <div class="card" style="margin-bottom:20px;border-color:#FF6B35;">
        <div class="card-body" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
            <span style="font-size:28px;">👨‍🔧</span>
            <div style="flex:1;">
                <div style="font-weight:600;margin-bottom:4px;">Komanda üzvləri ayrıca idarə olunur</div>
                <div style="font-size:13px;color:#6b7280;">Əməkdaş əlavə etmək, düzəliş etmək və silmək üçün Komanda səhifəsinə keçin.</div>
            </div>
            <a href="{{ route('admin.team.index') }}" class="btn btn-primary btn-sm">Komandaya keç →</a>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" style="min-width:200px;">💾 Yadda saxla</button>
</form>

@endsection
