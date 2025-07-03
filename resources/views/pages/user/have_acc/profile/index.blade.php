@extends('components.user.header1')

@section('title', 'Profile')

@section('content')

<section class="notifikasi py-5">
    <div class="container mt-5 poppins">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold" style="margin-top: 30px">Profile</h4>
            <a href="{{ route('profileuser.edit', Auth::id()) }}" class="text-decoration-none">
                <i class="bi bi-pencil-square me-1" style="margin-top: 30px"></i> Edit Profile
            </a>
        </div>

        @include('layouts.alert-noicon')

        <!-- Data Pribadi -->
        <div class="card p-4 mb-4">
            <h5 class="fw-semibold mb-4">Data Pribadi</h5>
            <div class="card-content">
                <div class="text-center mb-4">
                    <img src="{{ asset('file?page='.$user->image) ?? asset('default-profile.png') }}" class="rounded-circle profile-img" alt="Foto Profil">
                </div>
                <div class="row gx-5 gy-3">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Nama :</strong> {{ $user->name ?? '-' }}</p>
                        <p class="mb-2"><strong>NIM :</strong> {{ $user->nim ?? '-' }}</p>
                        <p class="mb-0"><strong>Agama :</strong> {{ $user->religion ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Email :</strong> {{ $user->email ?? '-' }}</p>
                        <p class="mb-2"><strong>No.Telepon :</strong> {{ $user->phone ?? '-' }}</p>
                        <p class="mb-0"><strong>Jenis Kelamin :</strong> {{ $user->gender ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Akademik -->
        <div class="card p-4 mb-4">
            <h5 class="fw-semibold mb-4">Data Akademik</h5>
            <div class="card-content">
                <div class="row gx-5 gy-3">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Asal Institusi :</strong> {{ $user->instansi->nama ?? '-' }}</p>
                        <p class="mb-0"><strong>Curriculum Vitae :</strong>
                            @if($user->cv)
                                <a href="{{ asset('file?page=' . $user->cv) }}" target="_blank" class="ms-1">{{ $user->cv }} <i class="bi bi-box-arrow-up-right"></i></a>
                            @else
                                <span class="ms-1">-</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Jurusan :</strong> {{ $user->jurusan->nama ?? '-' }}</p>
                        <p class="mb-0"><strong>Surat Rekomendasi :</strong>
                            @if($user->surat)
                                <a href="{{ asset('file?page=' . $user->surat) }}" target="_blank" class="ms-1">{{ $user->surat }} <i class="bi bi-box-arrow-up-right"></i></a>
                            @else
                                <span class="ms-1">-</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Periode Magang -->
        <div class="card p-4 mb-4">
            <h5 class="fw-semibold mb-4">Periode Magang</h5>
            <div class="card-content">
                <div class="row gx-5 gy-3">
                    <div class="col-md-6">
                        <p class="mb-0"><strong>Tanggal Mulai Magang :</strong>
                            {{ $user->mulai_magang ? date('d/m/Y', strtotime($user->mulai_magang)) : '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-0"><strong>Tanggal Selesai Magang :</strong>
                            {{ $user->selesai_magang ? date('d/m/Y', strtotime($user->selesai_magang)) : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('components.user.footer')
@endsection
