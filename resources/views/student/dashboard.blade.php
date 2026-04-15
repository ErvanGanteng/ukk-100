@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">

        <!-- Form Aspirasi -->
        <div>
            <div class="card">
                <div style="border-bottom: 1px solid var(--border); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                    <h2 style="margin: 0; color: var(--primary);">Sampaikan Aspirasi Anda</h2>
                    <p style="margin: 0.5rem 0 0; color: var(--text-muted);">Ceritakan masalah fasilitas sekolah yang anda temui.</p>
                </div>

                <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Judul Laporan</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: AC di Lab Komputer Bocor" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" rows="5" placeholder="Jelaskan detail permasalahan..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Foto Bukti (Opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        Kirim Aspirasi
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar / Recent History -->
        <div>
            <div class="card" style="background-color: var(--primary); color: white;">
                <h3 style="margin-top: 0;">Halo, {{ Auth::user()->name }}!</h3>
                <p>Status: Siswa</p>
                <div style="margin-top: 2rem;">
                    <a href="{{ route('student.history') }}" class="btn" style="background: white; color: var(--primary); width: 100%; box-sizing: border-box;">
                        Lihat Riwayat Saya
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 style="margin-top: 0; font-size: 1.25rem;">Aspirasi Terakhir</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                    @forelse($history as $item)
                        <div style="border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">
                            <div style="font-weight: 500;">{{ $item->judul }}</div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.25rem;">
                                <span class="badge badge-{{ $item->status }}" style="font-size: 0.75rem;">{{ ucfirst($item->status) }}</span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); font-size: 0.9rem;">Belum ada aspirasi.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
