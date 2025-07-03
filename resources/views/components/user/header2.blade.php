 <!-- Header No AKun -->

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8" />
     <meta
         name="viewport"
         content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <title>Kegiatanku</title>

     <!-- Favicon -->
     <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

     <!-- Bootstrap Icons -->
     <link
         href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
         rel="stylesheet" />

     <!-- Font Awesome -->
     <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
         integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
         crossorigin="anonymous"
         referrerpolicy="no-referrer" />

     <!-- Google Fonts -->
     <link
         href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
         rel="stylesheet" />

     <!-- Core CSS -->
     <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />
 </head>

 <body>
     <!-- Navigation -->
     <nav class="navbar navbar-expand-lg navbar-custom w-100">
         <div
             class="container-fluid px-4 d-flex justify-content-between align-items-center">
             <!-- Logo -->
             <a
                 class="navbar-brand d-flex align-items-center text-decoration-none"
                 href="/">
                 <img src="{{ asset('user/assets/img/logo.png') }}" alt="Smart Internship" height="40" />
             </a>

             <!-- Menu items -->
             <div class="d-flex align-items-center">
                 <a class="nav-link fw-bold text-dark mx-3" href="/">Beranda</a>
                 @auth
                 <a class="nav-link fw-bold text-dark mx-3" href="{{ url('posisiaktf') }}">Posisi</a>
                 @endauth
                 <a
                     class="btn btn-danger text-white fw-bold align-items-right btn-sm"
                     href="signin">
                     <i class="bi bi-person me-2"></i> Masuk ke akun
                 </a>
             </div>
         </div>
     </nav>

     @yield('content')

     <!-- Bootstrap core JS-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

     <!-- jQuery CDN -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Custom Script -->
     <script src="js/scripts.js"></script>
 </body>

 </html>
