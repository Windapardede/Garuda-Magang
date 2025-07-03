@extends('components.user.header1')

@section('title', 'Notifikasi')

@section('content')

<?php
    $notif =\DB::table('notification')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

    $update['is_viewed'] = 1;
    \DB::table('notification')->where('user_id', Auth::user()->id)->update($update);
?>

<!-- Notifikasi -->
<section class="notifikasi py-5">
    <div class="container-fluid px-4 d-flex flex-column align-items-center">
        <!-- Kotak Judul -->
        <div class="judul-notifikasi p-3 mb-3">
            <h2 class="fw-bold m-0">Notifikasi</h2>
        </div>

        <!-- Kotak Isi Notifikasi -->
        <div class="notifikasi-container p-4">
            <!-- Notifikasi Aktif -->
            <!-- <div class="notifikasi-card aktif">
                <i class="bi bi-bell-fill"></i>
                <div class="konten">
                    <p>Jangan lupa membuat perkembangan project akhir Anda</p>
                    <small>08 Maret 2024, 11:11</small>
                </div>
            </div> -->

            <!-- Notifikasi Lain -->
            @foreach($notif as $item)

                <div class="notifikasi-card">
                    <i class="bi bi-bell-fill"></i>
                    <div class="konten">
                        <p>{{$item->subtitle}}</p>
                        <small>{{ date('d M Y', strtotime($item->created_at)) }}, {{ date('H:i', strtotime($item->created_at)) }}</small>
                    </div>
                </div>

            @endforeach

            <!-- <div class="notifikasi-card">
                <i class="bi bi-bell-fill"></i>
                <div class="konten">
                    <p>Jangan lupa membuat perkembangan project akhir Anda</p>
                    <small>08 Maret 2024, 11:11</small>
                </div>
            </div> -->
        </div>
    </div>
</section>

@include('components.user.footer')
@endsection
