<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Smart Internship')</title> {{-- Menggunakan @yield untuk judul dinamis --}}

    {{-- Bootstrap CSS (PENTING: Pastikan versi ini konsisten dengan JS di bawah) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google Fonts Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- Custom CSS Anda --}}
    <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />

    <style>
        /* Sembunyikan ikon list di tombol MP secara default */
        .profile-mp-button-container .bi-list {
            display: none;
        }

        /* Tampilkan ikon list di tombol MP hanya saat di mobile (ukuran kecil ke bawah) */
        @media (max-width: 991.98px) {

            /* Ini adalah breakpoint 'lg' Bootstrap */
            .profile-mp-button-container .bi-list {
                display: block;
                /* Tampilkan ikon list */
                margin-left: 8px;
                /* Jarak antara MP dan ikon */
            }

            /* Sembunyikan dropdown panah default Bootstrap jika tidak diinginkan */
            .profile-mp-button-container .dropdown-toggle::after {
                display: none;
            }
        }

        /* Untuk desktop, sembunyikan item navigasi di dalam dropdown MP */
        @media (min-width: 992px) {
            .navbar-nav-in-dropdown {
                display: none;
            }
        }
    </style>
</head>

<?php
$cekNotifikasi = \DB::table('notification')
    ->where('user_id', Auth::user()->id)
    ->where('is_viewed', 0)
    ->get();

?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom w-100">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center text-decoration-none">
                <img src="{{ asset('user/assets/img/logo.png') }}" alt="Smart Internship" height="40" />
            </a>

            {{-- Hamburger Toggler Bootstrap: DISINI DIHILANGKAN SECARA KESELURUHAN --}}
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            {{-- Ini adalah navigasi utama yang hanya akan muncul di tampilan desktop (min-width: 992px) --}}
            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ route('posisi.aktif') }}">Posisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ route('kegiatanku.index') }}">Kegiatanku</a>
                    </li>
                </ul>
            </div>

            <div class="navbar-right-elements d-flex align-items-center ms-auto">
                <ul class="navbar-nav flex-row align-items-center me-3">
                    <li class="nav-item notification-item">
                        <a href="{{ route('notifikasiuser.index') }}" class="nav-link text-dark position-relative">
                            <i class="bi bi-bell fs-5"></i>
                            <span
                                class="position-absolute badge rounded-pill bg-danger badge-notif d-none d-lg-block">{{ $cekNotifikasi->count() }}</span>
                            <span class="position-absolute badge rounded-pill bg-danger badge-notif d-lg-none">1</span>
                        </a>
                    </li>
                </ul>

                {{-- Dropdown untuk Profil Pengguna dan Navigasi Mobile --}}
                <div class="dropdown profile-mp-button-container">
                    <a class="user-badge d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="mp-circle">
                            <span
                                class="fw-bold">{{ collect(explode(' ', Auth::user()->name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->implode('') }}</span>
                        </div>
                        {{-- Ikon list ini hanya akan tampil di mobile (d-lg-none) --}}
                        <i class="bi bi-list fs-5 d-lg-none"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                        <li>
                            <h6 class="dropdown-header">Halo, {{ Auth::user()->name }}</h6>
                        </li>

                        {{-- Item navigasi ini hanya tampil di mobile (d-lg-none) --}}

                        <li class="d-lg-none navbar-nav-in-dropdown">
                            <a class="dropdown-item" href="{{ route('posisi.aktif') }}">Posisi</a>
                        </li>
                        <li class="d-lg-none navbar-nav-in-dropdown">
                            <a class="dropdown-item" href="{{ route('kegiatanku.index') }}">Kegiatanku</a>
                        </li>
                        {{-- Pemisah jika item navigasi mobile ditampilkan --}}
                        <li class="d-lg-none">
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class="dropdown-item" href="{{ route('profileuser.index') }}"><i
                                    class="fas fa-user me-2 text-secondary"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="{{ url('change-password') }}"><i
                                    class="fas fa-key me-2 text-secondary"></i>Ganti Kata Sandi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href=""
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <i class="fas fa-sign-out-alt me-2"></i>Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    {{-- Bootstrap JavaScript Bundle (Termasuk Popper.js, penting untuk dropdown) --}}
    {{-- Ini HARUS dimuat sekali dan sebelum tag penutup </body> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- Hapus jQuery jika tidak ada skrip kustom yang memerlukannya, karena Bootstrap 5 tidak bergantung pada jQuery --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- Custom JavaScript Anda (scripts.js) --}}
    <script src="{{ asset('user/js/scripts.js') }}"></script>

    {{-- Untuk skrip dari Start Bootstrap (jika diperlukan) --}}


    {{-- Section untuk script tambahan dari child view, ini harus paling akhir --}}
    @yield('scripts')

</body>

</html>
