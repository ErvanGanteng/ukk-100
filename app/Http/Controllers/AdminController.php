<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with(['user', 'kategori', 'tanggapan'])->latest()->get();
        return view('admin.dashboard', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['user', 'kategori', 'tanggapan.user']);
        return view('admin.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $pengaduan->update(['status' => $validated['status']]);

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    public function storeFeedback(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'tanggapan' => 'required|string',
        ]);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => Auth::id(),
            'tanggapan' => $validated['tanggapan'],
            'tgl_tanggapan' => now(),
        ]);

        // Auto update status to proses if pending
        if ($pengaduan->status == 'pending') {
            $pengaduan->update(['status' => 'proses']);
        }
        
        // Or maybe selesai? The prompt implies feedback might close it, but usually feedback is part of process.
        // Let's leave status update manual for flexibility or update to 'selesai' if requested.
        // For now, just adding feedback.
        
        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}
