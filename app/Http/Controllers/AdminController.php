<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\article;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:1024',
        ]);

        $foto = $request->file('foto');
        $namaFoto = uniqid() . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('article', $namaFoto);

        article::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => $namaFoto,
        ]);

        return redirect()->route('admin.article.index')->with('success', 'Artikel edukasi lingkungan berhasil dibuat!');
    }
}

