@extends('admin.layouts.app')

@section('title', 'Portfolio')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
    <div style="color:var(--text-muted);font-size:14px;">Cəmi: {{ $items->total() }} element</div>
    <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary">+ Yeni element</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:72px;">Şəkil</th>
                    <th>Başlıq</th>
                    <th>Xidmət</th>
                    <th style="width:80px;">Video</th>
                    <th style="width:80px;">Status</th>
                    <th style="width:80px;">Sıra</th>
                    <th style="width:120px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        @if($item->thumbnail_url)
                        <img src="{{ $item->thumbnail_url }}" alt=""
                             style="width:60px;height:40px;object-fit:cover;border-radius:6px;display:block;">
                        @else
                        <div style="width:60px;height:40px;background:var(--border);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:20px;">🔧</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:14px;">{{ $item->title }}</div>
                        @if($item->description)
                        <div style="font-size:12px;color:var(--text-muted);margin-top:2px;">{{ Str::limit($item->description, 60) }}</div>
                        @endif
                    </td>
                    <td>
                        @if($item->service)
                        <span style="font-size:13px;">{{ $item->service->icon }} {{ $item->service->name }}</span>
                        @else
                        <span style="color:var(--text-muted);font-size:12px;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($item->youtube_id)
                        <span style="background:#fee2e2;color:#991b1b;font-size:11px;font-weight:600;padding:3px 8px;border-radius:6px;">
                            {{ $item->is_short ? 'Shorts' : 'YouTube' }}
                        </span>
                        @else
                        <span style="color:var(--text-muted);font-size:12px;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $item->is_active ? 'Aktiv' : 'Gizli' }}
                        </span>
                    </td>
                    <td style="color:var(--text-muted);font-size:13px;">{{ $item->sort_order }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.portfolio.edit', $item) }}" class="btn btn-secondary btn-sm">Düzəlt</a>
                            <form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}"
                                  onsubmit="return confirm('Bu elementi silmək istədiyinizdən əminsiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);">
                        Portfolio hələ əlavə edilməyib.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($items->hasPages())
<div style="margin-top:16px;">{{ $items->links('vendor.pagination.admin') }}</div>
@endif

@endsection
