@extends('admin.layouts.app')

@section('title', 'Sifarişlər')

@section('content')

{{-- Filters --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
            <input type="text" name="search" class="form-control" placeholder="Ad, telefon axtar..." value="{{ request('search') }}" style="max-width:220px;">
            <select name="status" class="form-control" style="max-width:180px;">
                <option value="">Bütün statuslar</option>
                <option value="new" {{ request('status')=='new'?'selected':'' }}>Yeni</option>
                <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>İcrada</option>
                <option value="done" {{ request('status')=='done'?'selected':'' }}>Tamamlandı</option>
                <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Ləğv edildi</option>
            </select>
            <button type="submit" class="btn btn-primary">Axtar</button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Sıfırla</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Sifarişlər ({{ $orders->total() }})</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ad</th>
                    <th>Telefon</th>
                    <th>Xidmət</th>
                    <th>Ünvan</th>
                    <th>Qeyd</th>
                    <th>Status</th>
                    <th>Tarix</th>
                    <th>Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name ?: '—' }}</td>
                    <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                    <td>{{ $order->service?->name ?: '—' }}</td>
                    <td>{{ $order->address ?: '—' }}</td>
                    <td style="max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $order->note ?: '—' }}</td>
                    <td>
                        @php $statusLabels = ['new'=>'Yeni','in_progress'=>'İcrada','done'=>'Tamamlandı','cancelled'=>'Ləğv']; @endphp
                        <span class="badge badge-{{ $order->status }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                    </td>
                    <td style="white-space:nowrap;">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.status', $order) }}" style="display:flex;gap:6px;align-items:center;">
                            @csrf @method('PUT')
                            <select name="status" class="form-control" style="padding:4px 8px;font-size:12px;">
                                <option value="new"         {{ $order->status=='new'?'selected':'' }}>Yeni</option>
                                <option value="in_progress" {{ $order->status=='in_progress'?'selected':'' }}>İcrada</option>
                                <option value="done"        {{ $order->status=='done'?'selected':'' }}>Tamamlandı</option>
                                <option value="cancelled"   {{ $order->status=='cancelled'?'selected':'' }}>Ləğv</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">✓</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:#9ca3af;padding:24px;">Sifariş tapılmadı</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div style="padding:0 20px 16px;">
        {{ $orders->links() }}
    </div>
    @endif
</div>

@endsection
