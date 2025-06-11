<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index()
    {
        // Tampilkan berita yang berstatus 'draft' atau 'review'
        $beritas = Berita::whereIn('status', ['draft', 'review'])->get();
        return view('editor.berita.index', compact('beritas'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('editor.berita.show', compact('berita'));
    }

    public function publish($id)
    {
        $berita = Berita::findOrFail($id);

        // Cegah publish jika status sudah 'published'
        if ($berita->status === 'published') {
            return redirect()->back()->with('error', 'Berita sudah dipublish.');
        }

        $berita->status = 'published';
        $berita->save();

        return redirect()->route('editor.berita.index')->with('success', 'Berita berhasil dipublish.');
    }


    public function __construct()
    {
        $this->middleware(['auth', 'role:editor']);
    }

    public function reject($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = 'rejected';
        $berita->save();

        return redirect()->route('editor.berita.index')->with('success', 'Berita ditolak.');
    }

    public function returnToWartawan($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = 'returned';
        $berita->save();

        return redirect()->route('editor.berita.index')->with('success', 'Berita dikembalikan ke wartawan.');
    }


}

