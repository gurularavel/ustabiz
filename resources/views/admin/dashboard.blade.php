@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-label">Yeni sifarişlər</div>
        <div class="stat-value">{{ $stats['orders_new'] }}</div>
    </div>
    <div class="stat-card orange">
        <div class="stat-label">İcrada</div>
        <div class="stat-value">{{ $stats['orders_in_progress'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Tamamlanmış</div>
        <div class="stat-value">{{ $stats['orders_done'] }}</div>
    </div>
    <div class="stat-card red">
        <div class="stat-label">Ləğv edilmiş</div>
        <div class="stat-value">{{ $stats['orders_cancelled'] }}</div>
    </div>
    <div class="stat-card gray">
        <div class="stat-label">Cəmi sifarişlər</div>
        <div class="stat-value">{{ $stats['orders_total'] }}</div>
    </div>
    <div class="stat-card gray">
        <div class="stat-label">Xidmətlər</div>
        <div class="stat-value">{{ $stats['services'] }}</div>
    </div>
    <div class="stat-card gray">
        <div class="stat-label">Rəylər</div>
        <div class="stat-value">{{ $stats['testimonials'] }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Son Sifarişlər</span>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Hamısına bax</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ad</th>
                    <th>Telefon</th>
                    <th>Xidmət</th>
                    <th>Status</th>
                    <th>Tarix</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name ?: '—' }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->service?->name ?: '—' }}</td>
                    <td>
                        @php
                            $statusLabels = ['new'=>'Yeni','in_progress'=>'İcrada','done'=>'Tamamlandı','cancelled'=>'Ləğv'];
                        @endphp
                        <span class="badge badge-{{ $order->status }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                    </td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#9ca3af;padding:24px;">Sifariş yoxdur</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
