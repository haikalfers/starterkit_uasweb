@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <a href="{{ route('wartawan.dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
    <h3>Daftar Berita Anda</h3>
    <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>

    @foreach ($beritas as $berita)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $berita->judul }}</h5>
                <p>Status: 
                    @if ($berita->status == 'draft')
                        <span class="badge bg-secondary text-white">Draft</span>
                    @elseif ($berita->status == 'review')
                        <span class="badge bg-warning text-white">Menunggu Review</span>
                    @elseif ($berita->status == 'published')
                        <span class="badge bg-success text-white">Dipublikasikan</span>
                    @elseif ($berita->status == 'rejected')
                        <span class="badge bg-danger text-white">Ditolak</span>
                    @elseif ($berita->status == 'returned')
                        <span class="badge bg-info text-white">Dikembalikan</span>
                    @endif
                </p>

                <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('berita.preview', $berita->id) }}" class="btn btn-info btn-sm">Preview</a>
                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
