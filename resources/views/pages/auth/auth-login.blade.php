@extends('layouts.auth')

@section('title', 'Masuk')

@push('style')
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f5f7fa;
        }

        .login-modal {
            width: 100%;
            max-width: 400px;
        }

        .logo {
            max-width: 120px;
            margin-bottom: 20px;
            /* Menambahkan jarak antara logo dan konten di bawahnya */
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 37px;
            cursor: pointer;
            color: #6c757d;
        }
    </style>
@endpush

@section('main')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-modal text-center p-4 shadow bg-white rounded position-relative">
            <!-- Logo -->
            <img src="{{ asset('img/logo_red.png') }}" alt="Smart Internship" class="mb-2 img-fluid logo">

            <!-- Judul -->
            <h4 class="fw-bold mb-4 text-start text-black">Masuk</h4>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Masukkan email aktif" required>
                </div>

                <!-- Password -->
                <div class="mb-3 text-start position-relative">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Masukkan kata sandi" required>
                    <i class="bi bi-eye toggle-password" onclick="togglePassword()"></i>
                </div>

                <!-- Lupa Password -->
                <div class="mb-3 text-end">
                    <a href="{{ url('lupa-sandi') }}" class="text-decoration-none">Lupa Kata Sandi</a>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="register" class="btn btn-outline-dark w-50 me-2">Daftar</a>
                    <button type="submit" class="btn btn-danger w-50 ms-2">Masuk</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>
@endpush
