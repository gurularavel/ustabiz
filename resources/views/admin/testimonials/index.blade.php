@extends('admin.layouts.app')

@section('title', 'Rəylər')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">Rəylər ({{ $testimonials->count() }})</span>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">+ Yeni rəy</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sıra</th>
                    <th>Ad</th>
                    <th>İlkin</th>
                    <th>Ulduz</th>
                    <th>Tarix</th>
                    <th>Mətn</th>
                    <th>Status</th>
                    <th>Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->sort_order }}</td>
                    <td>{{ $t->name }}</td>
                    <td>
                        <div style="width:32px;height:32px;border-radius:50%;background:#FF6B35;color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;">{{ $t->avatar_initial }}</div>
                    </td>
                    <td>{{ str_repeat('★', $t->stars) }}</td>
                    <td style="white-space:nowrap;">{{ $t->date }}</td>
                    <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $t->text }}</td>
                    <td>
                        <span class="badge {{ $t->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $t->is_active ? 'Aktiv' : 'Deaktiv' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-secondary btn-sm">✏️</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" style="display:inline;" onsubmit="return confirm('Silmək istədiyinizə əminsiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:#9ca3af;padding:24px;">Rəy yoxdur</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
