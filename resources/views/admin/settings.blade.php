@extends('admin.layouts.app')

@section('title', 'Tənzimləmələr')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')

    {{-- SAYt BAŞLIĞI + TEXNİKİ BAXIM --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
        <div class="card">
            <div class="card-header"><span class="card-title">🌐 Sayt başlığı</span></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Sayt adı / başlığı</label>
                    <input type="text" name="site_title" class="form-control"
                           value="{{ old('site_title', $settings['site_title'] ?? 'USTAM.AZ – Bakıda Peşəkar Ev Texnikası Təmiri') }}"
                           placeholder="USTAM.AZ – Bakıda Peşəkar Ev Texnikası Təmiri">
                    <div class="form-hint">Brauzer sekmesinde və axtarış nəticələrində görünür</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><span class="card-title">🔧 Texniki baxım rejimi</span></div>
            <div class="card-body">
                @php $isMaintenance = ($settings['maintenance_mode'] ?? '0') === '1'; @endphp
                <label class="maintenance-toggle" for="maintenance_toggle">
                    <div class="mt-left">
                        <div class="mt-title">Saytı bağla</div>
                        <div class="mt-desc">Aktiv olduqda yalnız admin girişi olan istifadəçilər saytı görə bilər. Digərlərinə "İşlər aparılır" səhifəsi göstərilir.</div>
                    </div>
                    <div class="mt-switch {{ $isMaintenance ? 'on' : '' }}" id="mt_switch">
                        <div class="mt-knob"></div>
                    </div>
                    <input type="hidden" name="maintenance_mode" value="0" id="maintenance_hidden">
                    <input type="checkbox" id="maintenance_toggle" name="maintenance_mode" value="1"
                           {{ $isMaintenance ? 'checked' : '' }}
                           style="position:absolute;opacity:0;pointer-events:none;">
                </label>
                @if($isMaintenance)
                <div style="margin-top:14px;padding:10px 14px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2);border-radius:8px;font-size:13px;color:#ef4444;display:flex;align-items:center;gap:8px;">
                    <span>⚠️</span> Sayt hal-hazırda bağlıdır. Ziyarətçilər texniki baxım səhifəsini görür.
                </div>
                @else
                <div style="margin-top:14px;padding:10px 14px;background:rgba(16,185,129,0.08);border:1px solid rgba(16,185,129,0.2);border-radius:8px;font-size:13px;color:#10b981;display:flex;align-items:center;gap:8px;">
                    <span>✅</span> Sayt açıqdır. Bütün ziyarətçilər saytı görə bilər.
                </div>
                @endif
            </div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">Əlaqə məlumatları</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings['phone'] ?? '') }}" placeholder="(050) 555-20-26">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ünvan</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $settings['address'] ?? '') }}" placeholder="H. Zərdabi 78V, Bakı">
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-poçt</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email'] ?? '') }}" placeholder="info@ustam.az">
                    </div>
                    <div class="form-group">
                        <label class="form-label">İş saatları</label>
                        <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $settings['working_hours'] ?? '') }}" placeholder="Hər gün: 08:00 – 22:00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Xəritə embed URL</label>
                        <input type="text" name="map_url" class="form-control"
                               value="{{ old('map_url', $settings['map_url'] ?? '') }}"
                               placeholder="https://www.google.com/maps/embed?pb=...">
                        <div class="form-hint">
                            Google Maps → "Paylaş" → "Xəritəni yerlə" → iframe içindəki <code>src="..."</code> linkini yapışdırın
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">Sosial şəbəkələr</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Facebook URL</label>
                        <input type="text" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Instagram URL</label>
                        <input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp URL</label>
                        <input type="text" name="whatsapp_url" class="form-control" value="{{ old('whatsapp_url', $settings['whatsapp_url'] ?? '') }}" placeholder="https://wa.me/994...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">YouTube URL</label>
                        <input type="text" name="youtube_url" class="form-control" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">💾 Tənzimləmələri saxla</button>
</form>

@endsection

@push('styles')
<style>
.maintenance-toggle {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    cursor: pointer;
    user-select: none;
    position: relative;
}
.mt-left { flex: 1; }
.mt-title { font-size: 14px; font-weight: 600; color: #111827; margin-bottom: 4px; }
.mt-desc { font-size: 12.5px; color: var(--text-muted); line-height: 1.5; }
.mt-switch {
    width: 48px; height: 26px; flex-shrink: 0;
    background: #d1d5db; border-radius: 100px;
    position: relative; transition: background .25s;
    margin-top: 2px;
}
.mt-switch.on { background: #ef4444; }
.mt-knob {
    position: absolute;
    top: 3px; left: 3px;
    width: 20px; height: 20px;
    background: #fff; border-radius: 50%;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    transition: left .25s;
}
.mt-switch.on .mt-knob { left: 25px; }
</style>
@endpush

@push('scripts')
<script>
document.getElementById('maintenance_toggle').addEventListener('change', function() {
    const sw = document.getElementById('mt_switch');
    const hidden = document.getElementById('maintenance_hidden');
    if (this.checked) {
        sw.classList.add('on');
        hidden.disabled = true;
    } else {
        sw.classList.remove('on');
        hidden.disabled = false;
    }
});
document.getElementById('mt_switch').addEventListener('click', function() {
    const cb = document.getElementById('maintenance_toggle');
    cb.checked = !cb.checked;
    cb.dispatchEvent(new Event('change'));
});
</script>
@endpush
