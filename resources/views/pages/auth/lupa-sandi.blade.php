@extends('layouts.lupasandi') {{-- Asumsi ini adalah layout utama Anda --}}

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center custom-container-height">
    <div class="card p-4 shadow-lg custom-card-width custom-card-height rounded-lg">
        <h2 class="mb-4 text-center fw-bold custom-title-spacing">Lupa Kata Sandi</h2>

        {{-- Alert untuk pesan error (misalnya email tidak terdaftar) --}}
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show custom-alert-success" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show custom-alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{-- Icon peringatan --}}
            {{ session('error') }}
            @if(str_contains(session('error'), 'Tidak Terdaftar'))
            <a href="{{ route('register') }}" class="alert-link ms-2">Daftar</a> {{-- Link ke halaman daftar --}}
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST"> {{-- Sesuaikan dengan route pengiriman email reset password Anda --}}
            @csrf

            <div class="mb-4"> {{-- Margin bawah sedikit lebih besar --}}
                <label for="email" class="form-label text-muted custom-label">Masukkan Email Yang Terdaftar</label>
                <input type="email" class="form-control form-control-md @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-grid mt-4"> {{-- Margin atas lebih besar untuk tombol --}}
                <button type="submit" class="btn btn-danger btn-lg py-2 rounded-pill custom-btn-kirim">Kirim</button>
            </div>
        </form>
    </div>
</div>

@endsection
