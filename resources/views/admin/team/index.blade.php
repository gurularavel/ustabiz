@extends('admin.layouts.app')

@section('title', 'Komanda')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">Komanda üzvləri ({{ $members->total() }})</span>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-sm">+ Yeni əməkdaş</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sıra</th>
                    <th>Emoji</th>
                    <th>Ad Soyad</th>
                    <th>Vəzifə</th>
                    <th>Təcrübə</th>
                    <th>Status</th>
                    <th>Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->sort_order }}</td>
                    <td style="font-size:24px;">{{ $member->emoji }}</td>
                    <td><strong>{{ $member->name }}</strong></td>
                    <td>{{ $member->role }}</td>
                    <td style="font-size:13px;color:#6b7280;">{{ $member->experience ?: '—' }}</td>
                    <td>
                        <span class="badge {{ $member->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $member->is_active ? 'Aktiv' : 'Deaktiv' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-secondary btn-sm">✏️ Düzəliş</a>
                        <form method="POST" action="{{ route('admin.team.destroy', $member) }}" style="display:inline;" onsubmit="return confirm('Silmək istədiyinizə əminsiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:#9ca3af;padding:24px;">Əməkdaş yoxdur</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($members->hasPages())
    <div style="padding:8px 20px 16px;">
        {{ $members->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>

@endsection
