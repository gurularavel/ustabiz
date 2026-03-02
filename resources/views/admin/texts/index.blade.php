@extends('admin.layouts.app')

@section('title', 'Mətn İdarəetməsi')

@section('content')
<form method="POST" action="{{ route('admin.texts.update') }}">
    @csrf
    @method('PUT')

    <div style="display:flex;flex-direction:column;gap:20px;">
        @foreach($sections as $sectionTitle => $fields)
            <div class="card">
                <div class="card-header">
                    <span class="card-title">{{ $sectionTitle }}</span>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        @foreach($fields as $field)
                            @php
                                $key = $field['key'];
                                $type = $field['type'] ?? 'text';
                                $value = old($key, $settings[$key] ?? $field['default']);
                            @endphp
                            <div class="form-group" style="{{ $type === 'textarea' ? 'grid-column:1 / -1;' : '' }}">
                                <label class="form-label">{{ $field['label'] }}</label>
                                @if($type === 'textarea')
                                    <textarea name="{{ $key }}" class="form-control" rows="3">{{ $value }}</textarea>
                                @else
                                    <input type="text" name="{{ $key }}" class="form-control" value="{{ $value }}">
                                @endif
                                <div class="form-hint">Açar: <code>{{ $key }}</code></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top:20px;">
        <button type="submit" class="btn btn-primary">💾 Mətnləri saxla</button>
    </div>
</form>
@endsection

@push('styles')
<style>
@media (max-width: 768px) {
    .card .card-body > div {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endpush

