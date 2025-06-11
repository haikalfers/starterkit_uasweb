@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Berita Terpublikasi</h3>

    @forelse ($beritas as $berita)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $berita->judul }}</h5>
                <p>{{ Str::limit($berita->isi, 150) }}</p>
                <p><small>Kategori: {{ $berita->kategori->nama ?? '-' }} | Penulis: {{ $berita->user->name ?? '-' }}</small></p>
                <a href="{{ route('berita.preview', $berita->id) }}" class="btn btn-sm btn-info">Lihat Selengkapnya</a>
            </div>
        </div>
    @empty
        <p>Belum ada berita yang dipublikasikan.</p>
    @endforelse
</div>
@endsection
