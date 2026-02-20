@extends('admin.layouts.app')

@section('title', 'Xidmətlər')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">Xidmətlər ({{ $services->total() }})</span>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">+ Yeni xidmət</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sıra</th>
                    <th>İkon</th>
                    <th>Ad</th>
                    <th>Slug</th>
                    <th>Qiymət (AZN)</th>
                    <th>Status</th>
                    <th>Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->sort_order }}</td>
                    <td style="font-size:22px;">{{ $service->icon }}</td>
                    <td>{{ $service->name }}</td>
                    <td><code style="font-size:12px;background:#f3f4f6;padding:2px 6px;border-radius:4px;">{{ $service->slug }}</code></td>
                    <td>{{ $service->price_from ? number_format($service->price_from, 0) : '—' }}</td>
                    <td>
                        <span class="badge {{ $service->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $service->is_active ? 'Aktiv' : 'Deaktiv' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">✏️ Düzəliş</a>
                        <form method="POST" action="{{ route('admin.services.duplicate', $service) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" title="Dublikat et">⧉ Kopya</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:#9ca3af;padding:24px;">Xidmət yoxdur</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($services->hasPages())
    <div style="padding:8px 20px 16px;">
        {{ $services->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>

@endsection
