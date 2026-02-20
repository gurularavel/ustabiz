@extends('admin.layouts.app')

@section('title', 'Ana Səhifə – Hero Bölməsi')

@section('content')

<form method="POST" action="{{ route('admin.pages.hero.update') }}">
    @csrf @method('PUT')

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- SOL SÜTUN --}}
        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">🏷️ Başlıq bölməsi</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Üst label mətni</label>
                        <input type="text" name="hero_label" class="form-control"
                               value="{{ old('hero_label', $s['hero_label'] ?? 'Bakıda №1 Texnika Təmiri') }}">
                        <div class="form-hint">Nümunə: Bakıda №1 Texnika Təmiri</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">H1 – Birinci sətir</label>
                        <input type="text" name="hero_title" class="form-control"
                               value="{{ old('hero_title', $s['hero_title'] ?? 'Evinizin texnikası') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">H1 – İkinci sətir <span class="form-hint" style="display:inline;">(narıncı)</span></label>
                        <input type="text" name="hero_title_span" class="form-control"
                               value="{{ old('hero_title_span', $s['hero_title_span'] ?? 'etibarlı əllərdədir') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Təsvir mətni</label>
                        <textarea name="hero_desc" class="form-control" rows="3">{{ old('hero_desc', $s['hero_desc'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📊 Statistika (3 rəqəm)</span></div>
                <div class="card-body">
                    @foreach([['1','Müştəri'],['2','Təcrübə'],['3','Müvəffəqiyyət']] as [$n,$def])
                    <div style="border:1px solid var(--border);border-radius:8px;padding:14px;margin-bottom:12px;">
                        <div style="font-size:12px;font-weight:600;color:var(--text-muted);margin-bottom:10px;">Stat {{ $n }}</div>
                        <div class="form-row">
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Dəyər</label>
                                <input type="text" name="hero_stat{{ $n }}_value" class="form-control"
                                       value="{{ old('hero_stat'.$n.'_value', $s['hero_stat'.$n.'_value'] ?? '') }}"
                                       placeholder="15 000+">
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label">Mətn</label>
                                <input type="text" name="hero_stat{{ $n }}_label" class="form-control"
                                       value="{{ old('hero_stat'.$n.'_label', $s['hero_stat'.$n.'_label'] ?? $def) }}"
                                       placeholder="{{ $def }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- SAĞ SÜTUN --}}
        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">🤝 Etibar mətni</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Müştəri sayı <span class="form-hint" style="display:inline;">(qalın)</span></label>
                        <input type="text" name="hero_trust_count" class="form-control"
                               value="{{ old('hero_trust_count', $s['hero_trust_count'] ?? '240+') }}"
                               placeholder="240+">
                        <div class="form-hint">Göründüyü yer: "Son 7 gündə <strong>240+</strong> müştəriyə xidmət göstərdik"</div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">📋 Forma kartı</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Forma başlığı</label>
                        <input type="text" name="hero_form_title" class="form-control"
                               value="{{ old('hero_form_title', $s['hero_form_title'] ?? 'Usta Çağır') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Forma alt mətni</label>
                        <input type="text" name="hero_form_subtitle" class="form-control"
                               value="{{ old('hero_form_subtitle', $s['hero_form_subtitle'] ?? 'Pulsuz diaqnostika + 12 ay zəmanət') }}">
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">👁️ Önizləmə</span></div>
                <div class="card-body" style="background:#12121E;border-radius:8px;padding:20px;color:#fff;">
                    <div style="font-size:11px;color:#FF6B35;margin-bottom:8px;">● <span id="prev_label">{{ $s['hero_label'] ?? 'Bakıda №1 Texnika Təmiri' }}</span></div>
                    <div style="font-size:22px;font-weight:800;line-height:1.2;margin-bottom:8px;">
                        <span id="prev_title">{{ $s['hero_title'] ?? 'Evinizin texnikası' }}</span><br>
                        <span style="color:#FF6B35;" id="prev_span">{{ $s['hero_title_span'] ?? 'etibarlı əllərdədir' }}</span>
                    </div>
                    <div style="font-size:12px;color:rgba(255,255,255,.6);" id="prev_desc">{{ Str::limit($s['hero_desc'] ?? '', 80) }}</div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">💾 Yadda saxla</button>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
document.querySelectorAll('[name="hero_label"],[name="hero_title"],[name="hero_title_span"],[name="hero_desc"]').forEach(function(el) {
    el.addEventListener('input', function() {
        var n = el.name;
        if (n === 'hero_label')      document.getElementById('prev_label').textContent = el.value;
        if (n === 'hero_title')      document.getElementById('prev_title').textContent = el.value;
        if (n === 'hero_title_span') document.getElementById('prev_span').textContent  = el.value;
        if (n === 'hero_desc')       document.getElementById('prev_desc').textContent  = el.value.substring(0, 80);
    });
});
</script>
@endpush
