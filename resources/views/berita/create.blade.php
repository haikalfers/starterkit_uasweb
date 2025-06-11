@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Berita</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required value="{{ old('judul') }}">
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Berita</label>
            <textarea name="isi" class="form-control" rows="5" required>{{ old('isi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select" id="kategoriSelect" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-3" id="kategoriLainnyaInput" style="display: none;">
            <label for="kategori_lainnya" class="form-label">Tulis Kategori Baru</label>
            <input type="text" name="kategori_lainnya" class="form-control">
        </div>

        <script>
            document.getElementById('kategoriSelect').addEventListener('change', function () {
                const value = this.value;
                document.getElementById('kategoriLainnyaInput').style.display = (value === 'lainnya') ? 'block' : 'none';
            });
        </script>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan sebagai Draft</button>
        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
