<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::id())
                        ->with(['kategori', 'tanggapan'])
                        ->latest()
                        ->get();

        return view('student.history', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $history = Pengaduan::where('user_id', Auth::id())->latest()->take(5)->get();
        return view('student.dashboard', compact('kategoris', 'history'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pengaduans', 'public');
        }

        Pengaduan::create([
            'user_id' => Auth::id(),
            'kategori_id' => $validated['kategori_id'],
            'judul' => $validated['judul'],
            'isi_laporan' => $validated['isi_laporan'],
            'foto' => $path,
            'tgl_pengaduan' => now(),
            'status' => 'pending'
        ]);

        return redirect()->route('student.history')->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function show(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }
        return view('student.show', compact('pengaduan'));
    }
}
