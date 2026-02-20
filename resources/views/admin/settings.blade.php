@extends('admin.layouts.app')

@section('title', 'Tənzimləmələr')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')

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
                        <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp URL</label>
                        <input type="url" name="whatsapp_url" class="form-control" value="{{ old('whatsapp_url', $settings['whatsapp_url'] ?? '') }}" placeholder="https://wa.me/994...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">YouTube URL</label>
                        <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">💾 Tənzimləmələri saxla</button>
</form>

@endsection
