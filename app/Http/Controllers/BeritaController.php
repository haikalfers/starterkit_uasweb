<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategori = Kategori::all(); // Ambil semua kategori dari tabel
        return view('berita.create', compact('kategori'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'required',
        ]);

        // Cek apakah kategori "Lainnya" dipilih
        if ($request->kategori_id === 'lainnya') {
            $request->validate([
                'kategori_lainnya' => 'required|string|max:255'
            ]);

            // Simpan kategori baru ke database
            $kategoriBaru = Kategori::create([
                'nama' => $request->kategori_lainnya
            ]);

            $kategori_id = $kategoriBaru->id;
        } else {
            $kategori_id = $request->kategori_id;
        }

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('gambar_berita', 'public');
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_berita', 'public');
        }

        // Simpan berita
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $kategori_id,
            'gambar' => $gambarPath,
            'user_id' => auth()->id(),
            'status' => 'draft'
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan sebagai draft.');
    }




    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        // Pastikan hanya wartawan yang membuat berita yang bisa mengeditnya
        if (auth()->user()->id !== $berita->user_id) {
            abort(403, 'Tidak diizinkan.');
        }

        $kategori = Kategori::all();

        return view('berita.edit', compact('berita', 'kategori'));
    }


    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        if (auth()->user()->id !== $berita->user_id) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;

        if ($request->kategori_id === 'lainnya') {
            $kategoriBaru = Kategori::create(['nama' => $request->kategori_baru]);
            $berita->kategori_id = $kategoriBaru->id;
        } else {
            $berita->kategori_id = $request->kategori_id;
        }

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_berita', 'public');
            $berita->gambar = $gambarPath;

        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita diperbarui.');
    }


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (auth()->user()->id !== $berita->user_id) {
            abort(403);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita dihapus.');
    }

    public function preview($id)
    {
        $berita = Berita::findOrFail($id);

        return view('berita.preview', compact('berita'));
    }


}
