<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class PublikBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('status', 'published')->latest()->get();
        return view('berita.published', compact('beritas'));
    }
}
