@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 style="margin: 0; color: var(--primary);">Dashboard Admin</h2>
            <div>
                <!-- Could add filters here later -->
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $pengaduan)
                        <tr style="{{ $pengaduan->status === 'pending' ? 'background-color: #fef2f2;' : '' }}">
                            <td>{{ $pengaduan->tgl_pengaduan }}</td>
                            <td>
                                <div style="font-weight: 500;">{{ $pengaduan->user->name }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $pengaduan->user->nis }}</div>
                            </td>
                            <td>{{ $pengaduan->judul }}</td>
                            <td>{{ $pengaduan->kategori->nama_kategori }}</td>
                            <td>
                                <span class="badge badge-{{ $pengaduan->status }}">
                                    {{ ucfirst($pengaduan->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.show', $pengaduan->id) }}" class="btn btn-primary" style="font-size: 0.8rem; padding: 0.25rem 0.75rem;">
                                    Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                                Belum ada data pengaduan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
