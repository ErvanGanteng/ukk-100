@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('student.history') }}" class="btn btn-secondary" style="margin-bottom: 1rem;">&larr; Kembali</a>
    
    <div style="display: grid; grid-template-columns: 3fr 2fr; gap: 2rem;">
        
        <!-- Detail Pengaduan -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <h2 style="margin: 0; color: var(--primary);">{{ $pengaduan->judul }}</h2>
                    <p style="color: var(--text-muted); margin: 0.25rem 0;">
                        {{ $pengaduan->kategori->nama_kategori }} • {{ $pengaduan->tgl_pengaduan }}
                    </p>
                </div>
                <span class="badge badge-{{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span>
            </div>

            <div style="background: #f9fafb; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <h4 style="margin-top: 0; margin-bottom: 0.5rem;">Isi Laporan:</h4>
                <p style="white-space: pre-wrap; margin: 0; color: #374151;">{{ $pengaduan->isi_laporan }}</p>
            </div>

            @if($pengaduan->foto)
                <div style="margin-top: 1rem;">
                    <h4 style="margin-bottom: 0.5rem;">Bukti Foto:</h4>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Bukti" style="max-width: 100%; border-radius: 0.5rem; border: 1px solid var(--border);">
                </div>
            @endif
        </div>

        <!-- Tanggapan -->
        <div class="card" style="{{ $pengaduan->tanggapan ? 'border: 2px solid var(--success);' : '' }}">
            <h3 style="margin-top: 0;">Tanggapan Admin</h3>
            <div style="border-top: 1px solid var(--border); margin: 1rem 0;"></div>

            @if($pengaduan->tanggapan)
                <div style="margin-bottom: 1rem;">
                    <div style="font-weight: 500; color: var(--primary); margin-bottom: 0.25rem;">
                        {{ $pengaduan->tanggapan->user->name ?? 'Admin' }}
                    </div>
                    <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">
                        {{ $pengaduan->tanggapan->tgl_tanggapan }}
                    </div>
                    <div style="background: #f0fdf4; padding: 1rem; border-radius: 0.5rem; border: 1px solid #bbf7d0; color: #166534;">
                        {{ $pengaduan->tanggapan->tanggapan }}
                    </div>
                </div>
                <div style="text-align: center; margin-top: 2rem;">
                    <span style="font-size: 3rem;">✅</span>
                    <p style="font-weight: 500; color: var(--success);">Masalah Telah Ditanggapi</p>
                </div>
            @else
                <div style="text-align: center; padding: 2rem 0; color: var(--text-muted);">
                    <p>Belum ada tanggapan dari pihak sekolah.</p>
                    <p>Mohon menunggu, laporan anda sedang dipelajari.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
