@extends('admin.layouts.app')

@section('title', $faq->exists ? 'FAQ Düzəlt' : 'Yeni FAQ')

@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-sm">← Geri</a>
</div>

<div class="card" style="max-width:640px;">
    <div class="card-header">
        <span class="card-title">{{ $faq->exists ? 'FAQ-ı Düzəlt' : 'Yeni FAQ əlavə et' }}</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
            @csrf
            @if($faq->exists) @method('PUT') @endif

            <div class="form-group">
                <label class="form-label">Sual *</label>
                <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Cavab *</label>
                <textarea name="answer" class="form-control" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Sıra</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
                </div>
                <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:18px;">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                        Aktiv
                    </label>
                </div>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">💾 Yadda saxla</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Ləğv et</a>
            </div>
        </form>
    </div>
</div>

@endsection
