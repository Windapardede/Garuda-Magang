@extends('components.user.header1')

@section('title', 'Kegiatanku')

@section('content')
<section class="notifikasi py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card p-4 text-center shadow">
                    <img src="{{ asset('user/assets/img/berhasil-daftar.png') }}"
                        alt="Berhasil Daftar"
                        class="img-fluid mb-4 mx-auto d-block"
                        style="max-width: 250px;" />
                    <h4 class="fw-bold">Akun Anda Telah Terdaftar!</h4>
                    <p class="text-muted mb-4">Silakan Lengkapi Profil Anda!</p>
                    <a href="{{ url('profileuser/'.Auth::id().'/edit') }}" class="btn btn-danger w-100">Profile</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.user.footer')
@endsection
