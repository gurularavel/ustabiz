@extends('admin.layouts.app')

@section('title', $testimonial->exists ? 'Rəyi Düzəlt' : 'Yeni Rəy')

@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm">← Geri</a>
</div>

<div class="card" style="max-width:640px;">
    <div class="card-header">
        <span class="card-title">{{ $testimonial->exists ? 'Rəyi Düzəlt' : 'Yeni Rəy əlavə et' }}</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
            @csrf
            @if($testimonial->exists) @method('PUT') @endif

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Ad *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required placeholder="Elnur Həsənov">
                </div>
                <div class="form-group">
                    <label class="form-label">Avatar ilkin * <span class="form-hint" style="display:inline;">(1-2 hərf)</span></label>
                    <input type="text" name="avatar_initial" class="form-control" value="{{ old('avatar_initial', $testimonial->avatar_initial) }}" required maxlength="5" placeholder="E">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tarix *</label>
                    <input type="text" name="date" class="form-control" value="{{ old('date', $testimonial->date) }}" required placeholder="12 yanvar 2024">
                </div>
                <div class="form-group">
                    <label class="form-label">Ulduz sayı *</label>
                    <select name="stars" class="form-control" required>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('stars', $testimonial->stars ?? 5) == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }} ({{ $i }})</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Mətn *</label>
                <textarea name="text" class="form-control" rows="5" required>{{ old('text', $testimonial->text) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Sıra</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}">
                </div>
                <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:18px;">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
                        Aktiv
                    </label>
                </div>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">💾 Yadda saxla</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Ləğv et</a>
            </div>
        </form>
    </div>
</div>

@endsection
