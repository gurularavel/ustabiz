@extends('admin.layouts.app')

@section('title', $member->exists ? 'Əməkdaşı Düzəlt' : 'Yeni Əməkdaş')

@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary btn-sm">← Geri</a>
</div>

<div class="card" style="max-width:580px;">
    <div class="card-header">
        <span class="card-title">{{ $member->exists ? 'Əməkdaşı Düzəlt' : 'Yeni Əməkdaş əlavə et' }}</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}">
            @csrf
            @if($member->exists) @method('PUT') @endif

            <div class="form-row">
                <div class="form-group" style="flex:0 0 auto;">
                    <label class="form-label">Emoji</label>
                    <div class="icon-picker-group" style="flex-direction:column;align-items:flex-start;gap:6px;">
                        <div class="icon-current" id="icon_display_emoji"
                             onclick="openIconPicker('emoji')"
                             title="Emoji seçmək üçün klikləyin"
                             style="font-size:32px;width:64px;height:64px;">{{ old('emoji', $member->emoji ?? '👨‍🔧') }}</div>
                        <button type="button" class="btn btn-secondary btn-sm"
                                onclick="openIconPicker('emoji')">Seç</button>
                        <input type="hidden" name="emoji" id="icon_val_emoji"
                               value="{{ old('emoji', $member->emoji ?? '👨‍🔧') }}">
                    </div>
                </div>
                <div class="form-group" style="flex:1;">
                    <label class="form-label">Ad Soyad *</label>
                    <input type="text" name="name" class="form-control" required
                           value="{{ old('name', $member->name ?? '') }}"
                           placeholder="Murad Əliyev">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Vəzifə / İxtisas *</label>
                <input type="text" name="role" class="form-control" required
                       value="{{ old('role', $member->role ?? '') }}"
                       placeholder="Soyuducu mütəxəssisi">
            </div>

            <div class="form-group">
                <label class="form-label">Təcrübə</label>
                <input type="text" name="experience" class="form-control"
                       value="{{ old('experience', $member->experience ?? '') }}"
                       placeholder="8 il təcrübə · Samsung, LG, Bosch">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Sıra</label>
                    <input type="number" name="sort_order" class="form-control"
                           value="{{ old('sort_order', $member->sort_order ?? 0) }}">
                </div>
                <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:18px;">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>
                        Aktiv
                    </label>
                </div>
            </div>

            {{-- Preview --}}
            <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:16px;margin-bottom:18px;text-align:center;">
                <div style="font-size:42px;margin-bottom:8px;" id="prev_emoji">{{ $member->emoji ?? '👨‍🔧' }}</div>
                <div style="font-size:15px;font-weight:700;color:#111;" id="prev_name">{{ $member->name ?? 'Ad Soyad' }}</div>
                <div style="font-size:13px;color:#FF6B35;margin:4px 0;" id="prev_role">{{ $member->role ?? 'Vəzifə' }}</div>
                <div style="font-size:12px;color:#9ca3af;" id="prev_exp">{{ $member->experience ?? '' }}</div>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">💾 Yadda saxla</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Ləğv et</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Live preview for text fields
['name','role','experience'].forEach(function(field) {
    var el = document.querySelector('[name="' + field + '"]');
    if (!el) return;
    var targets = { name:'prev_name', role:'prev_role', experience:'prev_exp' };
    el.addEventListener('input', function() {
        document.getElementById(targets[field]).textContent = el.value || '';
    });
});
// Live preview for emoji (hidden input, updated by icon picker)
var emojiInput = document.getElementById('icon_val_emoji');
if (emojiInput) {
    emojiInput.addEventListener('input', function() {
        document.getElementById('prev_emoji').textContent = this.value || '👨‍🔧';
    });
}
</script>
@endpush
