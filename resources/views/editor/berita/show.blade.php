@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('editor.berita.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Tinjauan</a>

    <h3>{{ $berita->judul }}</h3>

    <p><strong>Status:</strong> {{ $berita->status }}</p>

    @if ($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid mb-3" style="max-height: 300px;">
    @endif

    <p>{!! nl2br(e($berita->isi)) !!}</p>

    <form action="{{ route('editor.berita.publish', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin mempublikasikan berita ini?')">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-success">Publish</button>
    </form>

    <form action="{{ route('editor.berita.reject', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak berita ini?')">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-danger">Tolak</button>
    </form>

    <form action="{{ route('editor.berita.return', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Kembalikan ke wartawan?')">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-warning">Kembalikan ke Wartawan</button>
    </form>

</div>
@endsection
