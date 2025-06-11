@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Manajemen Pengguna</h5>
                    <p class="card-text">Kelola role dan data pengguna sistem.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">Kelola Role User</a>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Daftar Berita Terpublikasi</h4>

    <div class="row">
        @foreach($beritas as $berita)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="gambar">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $berita->judul }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($berita->isi, 100) }}</p>
                        <span class="badge bg-success mb-2">Published</span>
                        <a href="{{ route('berita.preview', $berita->id) }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Preview</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
