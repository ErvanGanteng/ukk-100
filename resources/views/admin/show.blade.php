@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="margin-bottom: 1rem;">&larr; Kembali</a>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        
        <!-- Detail Laporan -->
        <div class="card">
            <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <h2 style="margin: 0; color: var(--primary);">{{ $pengaduan->judul }}</h2>
                    <span class="badge badge-{{ $pengaduan->status }}" style="font-size: 1rem;">{{ ucfirst($pengaduan->status) }}</span>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 0.5rem; color: var(--text-muted);">
                    <span>Oleh: <strong>{{ $pengaduan->user->name }}</strong> ({{ $pengaduan->user->nis }})</span>
                    <span>•</span>
                    <span>{{ $pengaduan->kategori->nama_kategori }}</span>
                    <span>•</span>
                    <span>{{ $pengaduan->tgl_pengaduan }}</span>
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <h4 style="margin-bottom: 0.5rem;">Isi Laporan:</h4>
                <div style="background: #f9fafb; padding: 1.5rem; border-radius: 0.5rem;">
                    {{ $pengaduan->isi_laporan }}
                </div>
            </div>

            @if($pengaduan->foto)
                <div>
                    <h4 style="margin-bottom: 0.5rem;">Bukti Foto:</h4>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Bukti" style="max-width: 100%; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                </div>
            @endif
        </div>

        <!-- Actions Panel -->
        <div>
            <!-- Update Status -->
            <div class="card" style="margin-bottom: 2rem;">
                <h3 style="margin-top: 0;">Update Status</h3>
                <form action="{{ route('admin.status.update', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Beri Tanggapan -->
            <div class="card">
                <h3 style="margin-top: 0;">Berikan Tanggapan</h3>
                
                @if($pengaduan->tanggapan)
                    <div style="background: #f0fdf4; padding: 1rem; border-radius: 0.5rem; border: 1px solid #bbf7d0; margin-bottom: 1rem;">
                        <div style="font-weight: 500; color: #166534; margin-bottom: 0.5rem;">Tanggapan Terkirim:</div>
                        {{ $pengaduan->tanggapan->tanggapan }}
                        <div style="font-size: 0.75rem; color: #166534; margin-top: 0.5rem; text-align: right;">
                            {{ $pengaduan->tanggapan->tgl_tanggapan }}
                        </div>
                    </div>
                @else
                    <form action="{{ route('admin.feedback.store', $pengaduan->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="tanggapan" class="form-control" rows="4" placeholder="Tulis tanggapan atau tindakan yang diambil..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Tanggapan</button>
                    </form>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
