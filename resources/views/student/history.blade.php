@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 style="margin: 0; color: var(--primary);">Riwayat Aspirasi</h2>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Buat Baru</a>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $pengaduan)
                        <tr>
                            <td>{{ $pengaduan->tgl_pengaduan }}</td>
                            <td>{{ $pengaduan->kategori->nama_kategori }}</td>
                            <td>{{ $pengaduan->judul }}</td>
                            <td>
                                <span class="badge badge-{{ $pengaduan->status }}">
                                    {{ ucfirst($pengaduan->status) }}
                                </span>
                            </td>
                            <td>
                                @if($pengaduan->tanggapan)
                                    <span style="color: var(--success); font-weight: 500;">Sudah Ditanggapi</span>
                                @else
                                    <span style="color: var(--text-muted);">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.show', $pengaduan->id) }}" class="btn btn-secondary" style="font-size: 0.8rem; padding: 0.25rem 0.5rem;">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                                Belum ada data aspirasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
