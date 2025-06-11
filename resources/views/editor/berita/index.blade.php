@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Berita Menunggu Tinjauan</h3>

    <a href="{{ route('editor.dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($beritas as $berita)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $berita->judul }}</h5>
                <p>Status: <strong>{{ $berita->status }}</strong></p>
                <a href="{{ route('editor.berita.show', $berita->id) }}" class="btn btn-info btn-sm">Tinjau</a>
            </div>
        </div>
    @empty
        <p>Tidak ada berita yang perlu ditinjau.</p>
    @endforelse
</div>
@endsection
