<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling untuk sidebar */
        .main-sidebar {
            background-color: #4F6079;
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
        }

        /* Sidebar brand */
        .sidebar-brand a {
            display: block;
            padding: 20px;
            text-align: center;
            text-decoration: none;
        }

        .sidebar-brand img {
            max-width: 100%;
            height: auto;
        }

        .sidebar-brand-sm a {
            display: block;
            padding: 10px;
            text-align: center;
            text-decoration: none;
        }

        /* Jarak antara logo dan menu */
        .sidebar-brand {
            margin-bottom: 30px;
            /* Menambahkan jarak bawah dari logo */
        }

        /* Menu list */
        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        /* Nav items */
        .nav-item {
            border-bottom: none;
        }

        /* Teks putih untuk semua link menu */
        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px;
            color: white;
            /* Warna teks putih */
            text-decoration: none;
            /* Menghilangkan garis bawah pada link */
            font-size: 16px;
        }

        .nav-link i {
            margin-right: 10px;
        }

        /* Active menu link */
        .nav-item.active>.nav-link {
            background-color: #3b4b63;
            color: white;
            /* Warna teks putih saat aktif */
        }

        /* Dropdown menu */
        .dropdown-menu {
            background-color: #4F6079;
            list-style-type: none;
            padding: 10px;
            margin: 0;
            display: none;
        }

        /* Menampilkan dropdown saat hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Teks putih dalam dropdown */
        .dropdown-menu li a {
            color: white;
            /* Warna teks putih untuk dropdown */
            text-decoration: none;
            padding: 8px;
            display: block;
        }

        /* Hover effect pada dropdown */
        .dropdown-menu li a:hover {
            background-color: #3b4b63;
        }

        /* Hover effects pada item menu */
        .sidebar-menu .nav-item:hover>.nav-link {
            background-color: #3b4b63;
            color: white !important;
        }

        .sidebar-menu .nav-item:hover>.nav-link i {
            color: white !important;
        }

        .sidebar-menu .nav-item.active>.nav-link i {
            color: white !important;
        }

        /* Warna header menu */
        .menu-header {
            color: white;
            /* Warna teks header putih */
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo_white.png') }}" alt="Smart Intehiiirnship" class="img-fluid" style="max-width: 100%; height: auto;">
                </a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="index.html">
                    <img src="img/logo_white.png" alt="Smart Internaaship" style="max-width: 80%; height: auto;"> <!-- Logo untuk ukuran kecil -->
                </a>
            </div>

            <ul class="sidebar-menu">
                <li class="nav-item active">
                    <a href="{{ url('home') }}" class="nav-link" style="color: white !important;">
                        <i class="fas fa-home" style="color: white !important;"></i> <span>Dashboard</span>
                    </a>
                </li>

                <!-- <li class="menu-header">Laporan</li> -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown text-white">
                        <i class="fas fa-lock" style="color: white !important;"></i> <span>Laporan</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="text-white" href="{{ route('pesertamagangaktif.index') }}">Peserta Magang Aktif</a></li>
                        <li><a class="text-white" href="{{ route('pendaftarmagang.index') }}">Pendaftar Magang</a></li>
                        <li><a class="text-white" href="{{ route('alumnimagang.index') }}">Alumni Magang</a></li>
                    </ul>
                </li>
                </li>

            </ul>
        </aside>
    </div>

</body>

</html>
