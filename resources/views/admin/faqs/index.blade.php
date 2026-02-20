@extends('admin.layouts.app')

@section('title', 'FAQ')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">FAQ ({{ $faqs->count() }})</span>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">+ Yeni FAQ</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sıra</th>
                    <th>Sual</th>
                    <th>Cavab</th>
                    <th>Status</th>
                    <th>Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td>{{ $faq->id }}</td>
                    <td>{{ $faq->sort_order }}</td>
                    <td style="max-width:240px;">{{ $faq->question }}</td>
                    <td style="max-width:260px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $faq->answer }}</td>
                    <td>
                        <span class="badge {{ $faq->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $faq->is_active ? 'Aktiv' : 'Deaktiv' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-secondary btn-sm">✏️</a>
                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" style="display:inline;" onsubmit="return confirm('Silmək istədiyinizə əminsiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#9ca3af;padding:24px;">FAQ yoxdur</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
