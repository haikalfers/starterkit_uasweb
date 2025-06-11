@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Berita</h1>

    <div class="card shadow mb-4">
        @if($berita->gambar)
            <div class="text-center mt-3">
                <img src="{{ asset('storage/' . $berita->gambar) }}" 
                     class="img-fluid rounded" 
                     style="max-width: 800px; height: auto;" 
                     alt="Gambar Berita">
            </div>
        @endif

        <div class="card-body">
            <h4 class="card-title text-primary font-weight-bold mt-3">{{ $berita->judul }}</h4>

            <div class="mb-3">
                <span class="badge badge-info">{{ $berita->kategori->nama ?? 'Tanpa Kategori' }}</span>
                <span class="badge badge-secondary">{{ ucfirst($berita->status) }}</span>
            </div>

            <p class="card-text" style="white-space: pre-line;">{{ $berita->isi }}</p>

            <hr>
            <p class="text-muted"><small>Ditulis oleh: {{ $berita->user->name ?? 'Tidak diketahui' }}</small></p>

            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
