@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Dashboard Wartawan</h2>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Kelola Berita</h5>
                    <p class="card-text">Tambah dan kelola berita kamu.</p>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-primary">Kelola Berita</a>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Daftar Berita Terpublikasi</h4>

    <div class="row">
        @forelse($beritas as $berita)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="gambar berita" style="height: 180px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $berita->judul }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($berita->isi, 100) }}</p>
                        <p class="mt-auto mb-2">
                            <strong>Status:</strong>
                            @php
                                $statusBadge = [
                                    'draft' => 'secondary',
                                    'review' => 'warning text-dark',
                                    'published' => 'success',
                                    'rejected' => 'danger',
                                    'returned' => 'info text-dark',
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusBadge[$berita->status] ?? 'light' }}">
                                {{ ucfirst($berita->status) }}
                            </span>
                        </p>
                        <a href="{{ route('berita.preview', $berita->id) }}" class="btn btn-outline-primary btn-sm">Lihat Preview</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada berita yang dipublikasikan.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
