<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling untuk navbar */
        .navbar {
            background-color: #ffffff;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-nav {
            margin-left: auto;
        }

        /* Styling untuk dropdown menu */
        .navbar .dropdown-menu {
            border-radius: 5px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link {
            color: #333;
            font-size: 1rem;
        }

        .navbar .dropdown .nav-link-user {
            color: #333;
            font-weight: bold;
        }

        .navbar .dropdown-item {
            font-size: 0.9rem;
        }

        .navbar .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .navbar .dropdown-divider {
            margin: 0.5rem 0;
        }

        .icon-bell-wrapper {
            position: relative;
            display: inline-block;
        }

        .icon-bell {
            font-size: 20px;
            color: #d1d3e2;
        }

        .badge-counter {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            min-width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            padding: 2px;
        }

        /* Menghilangkan panah di dropdown-toggle */
        .nav-link.dropdown-toggle::after {
            display: none !important;
        }

        .nav-item .img-profile {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        /* Topbar Dropdown Notifikasi */
        .topbar .dropdown {
            position: static;
        }

        .topbar .dropdown .dropdown-menu {
            width: 20rem;
            /* Lebar tetap */
            right: 0.75rem;
            border: none;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
            /* Background putih */
        }

        .topbar .dropdown-list {
            padding: 0;
            overflow: hidden;
        }

        .topbar .dropdown-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem;
            white-space: normal;
            border-bottom: 1px solid #e3e6f0;
            color: #5a5c69;
            text-decoration: none;
            background-color: #fff;
            /* Pastikan item putih */
        }

        .topbar .dropdown-item:last-child {
            border-bottom: none;
        }

        .topbar .dropdown-item:hover {
            background-color: #f8f9fc;
            /* Hover abu muda */
        }

        .topbar .dropdown-item .icon-circle {
            width: 2.5rem;
            height: 2.5rem;
            text-align: center;
            line-height: 2.5rem;
            border-radius: 50%;
            flex-shrink: 0;
            margin-right: 1rem;
            color: #fff;
            /* Icon text putih */
        }

        /* Icon Circle Colors */
        .topbar .icon-circle.bg-primary {
            background-color: #4e73df;
            /* Biru */
        }

        .topbar .icon-circle.bg-success {
            background-color: #1cc88a;
            /* Hijau */
        }

        .topbar .icon-circle.bg-warning {
            background-color: #f6c23e;
            /* Kuning */
        }

        .topbar .dropdown-item .icon-circle i {
            font-size: 1rem;
            color: #fff;
        }

        .topbar .dropdown-item .small {
            font-size: 0.75rem;
            color: #858796;
            margin-bottom: 0.25rem;
            display: block;
        }

        .topbar .dropdown-item .font-weight-bold {
            font-weight: 700;
            color: #5a5c69;
        }

        .topbar .dropdown-header {
            background-color: #4e73df;
            /* Header biru */
            color: white;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: bold;
        }

        /* Footer di dropdown (Show All Alerts) */
        .topbar .dropdown-footer {
            text-align: center;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            color: #6c757d;
            background-color: #f8f9fc;
            text-decoration: none;
            display: block;
        }

        .topbar .dropdown-footer:hover {
            background-color: #eaecf4;
            color: #5a5c69;
        }

        .topbar .dropdown {
            position: relative;
            /* supaya dropdown-menu bisa posisi absolute */
        }

        .topbar .dropdown-menu {
            right: 0;
            left: auto;
            top: 100%;
            margin-top: 0.5rem;
            display: none;
            /* Awalnya hidden */
        }

        .topbar .dropdown.show .dropdown-menu {
            display: block;
            /* Muncul saat diklik */
        }





        /* Responsive Navbar */
        @media (max-width: 768px) {
            .navbar .navbar-nav {
                flex-direction: row;
            }
        }
    </style>
</head>

<?php
    $cekNotifikasi  = \DB::table('notification')->where('user_id', Auth::user()->id)->where('is_viewed', 0)->get();
    $notif          = \DB::table('notification')->where('user_id', Auth::user()->id)->where('is_viewed', 0)->limit(3)->get();

?>

<body>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle Button for Mobile -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Navbar Right Items -->
                <ul class="navbar-nav ml-auto">

                    <!-- Alerts Dropdown -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="icon-bell-wrapper">
                                <i class="fas fa-bell icon-bell"></i>
                                <span class="badge-counter">{{ $cekNotifikasi->count() }}</span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                             @foreach($notif as $item)
                                <!-- Notifikasi 3 -->
                                <a class="dropdown-item d-flex align-items-start" href="#">
                                    <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                    <div class="small">{{ date('d M Y', strtotime($item->created_at)) }} , {{ date('H:i', strtotime($item->created_at)) }}</div>
                                        {{$item->subtitle}}
                                    </div>
                                </a>
                            @endforeach

                            @if($cekNotifikasi->count() > 0)
                            <a class="dropdown-footer" href="{{ url('notifikasi') }}">Show All Alerts</a>
                            @endif
                        </div>
                    </li>


                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('file?page='.Auth::user()->image) ?? asset('img/profile.svg')}}" alt="Profile" />
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">

                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profilementor.index') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                                <span>Profile</span>
                            </a>

                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profilementor.password.change.form') }}">
                                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-600"></i>
                                <span>Ganti Kata Sandi</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item d-flex align-items-center text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>



                </ul>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JS dan jQuery (wajib kalau pakai data-toggle) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>
