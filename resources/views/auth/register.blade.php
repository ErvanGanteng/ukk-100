@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 3rem auto;">
    <div class="card">
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--primary);">Daftar Siswa</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ old('nis') }}" required>
                @error('nis') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar</button>
        </form>
        
        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
            Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none;">Login</a>
        </p>
    </div>
</div>
@endsection
