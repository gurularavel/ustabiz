@extends('admin.layouts.app')

@section('title', $service->exists ? 'Xidməti Düzəlt: ' . $service->name : 'Yeni Xidmət')

@section('content')

<div style="margin-bottom:16px;display:flex;align-items:center;gap:10px;">
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm">← Geri</a>
    @if($service->exists)
    <form method="POST" action="{{ route('admin.services.duplicate', $service) }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-secondary btn-sm">⧉ Bu xidməti kopya et</button>
    </form>
    @endif
</div>

<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">Əsas məlumat</span></div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ad *</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Slug *</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug) }}" required>
                            <div class="form-hint">URL: /xidmetler/slug</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">İkon *</label>
                            <div class="icon-picker-group">
                                <div class="icon-current" id="icon_display_icon"
                                     onclick="openIconPicker('icon')"
                                     title="İkon seçmək üçün klikləyin">{{ old('icon', $service->icon) ?: '🔧' }}</div>
                                <div>
                                    <button type="button" class="btn btn-secondary btn-sm"
                                            onclick="openIconPicker('icon')">İkon seç...</button>
                                    <div class="form-hint" style="margin-top:5px;">Klikləyib seçin</div>
                                </div>
                                <input type="hidden" name="icon" id="icon_val_icon"
                                       value="{{ old('icon', $service->icon) ?: '🔧' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Qiymət (AZN)</label>
                            <input type="number" name="price_from" class="form-control" value="{{ old('price_from', $service->price_from) }}" step="0.01">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Qısa təsvir</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $service->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hero təsviri</label>
                        <textarea name="hero_desc" class="form-control" rows="3">{{ old('hero_desc', $service->hero_desc) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">JSON sahələr</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Problemlər (JSON array)</label>
                        <textarea name="problems" class="form-control" rows="5" style="font-family:monospace;font-size:12px;">{{ old('problems', json_encode($service->problems, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea>
                        <div class="form-hint">Nümunə: ["Soyuducu soyutmur","Kompressor işləmir"]</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Brendlər (JSON array)</label>
                        <textarea name="brands" class="form-control" rows="4" style="font-family:monospace;font-size:12px;">{{ old('brands', json_encode($service->brands, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea>
                        <div class="form-hint">Nümunə: ["Samsung","LG","Bosch"]</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">FAQ (JSON array of objects)</label>
                        <textarea name="faqs" class="form-control" rows="8" style="font-family:monospace;font-size:12px;">{{ old('faqs', json_encode($service->faqs, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea>
                        <div class="form-hint">Nümunə: [{"q":"Sual?","a":"Cavab"}]</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header"><span class="card-title">Parametrlər</span></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Sıra</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                            Aktiv
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">💾 Yadda saxla</button>
        </div>
    </div>
</form>

@endsection
