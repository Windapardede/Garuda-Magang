@extends('layouts.appmentor')

@section('title', 'Detail Penilaian')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" xintegrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Gaya dari snippet yang Anda berikan, disesuaikan untuk Penilaian Create Blade */
    .main-content {
        margin-top: 30px;
    }

    .card-custom {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
    }

    .card-title-custom {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: bold;
        color: #555;
        margin-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .form-group-custom {
        margin-bottom: 15px;
        flex: 1;
        /* Membuat form-group-custom mengisi ruang yang tersedia */
    }

    .form-group-custom label {
        display: block;
        font-size: 14px;
        color: #777;
        margin-bottom: 5px;
    }

    .form-control-custom {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        font-size: 15px;
        transition: border-color 0.3s ease;
        background-color: #f8f9fa;
        /* Warna latar belakang untuk input readonly */
        cursor: default;
        /* Kursor default untuk readonly */
    }

    /* Hapus fokus untuk readonly */
    .form-control-custom:focus {
        outline: none;
        border-color: #d0d0d0;
        box-shadow: none;
    }

    /* Tombol tambah/hapus tidak diperlukan di halaman detail */
    .btn-add-kriteria,
    .btn-danger-custom {
        display: none;
        /* Sembunyikan tombol tambah dan hapus */
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-secondary-custom {
        background-color: #6c757d;
        /* Menggunakan warna secondary yang konsisten */
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background-color: #5a6268;
    }

    .btn-primary-custom {
        background-color: #1758B9;
        /* Menggunakan warna primary yang konsisten */
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: none;
        /* Sembunyikan tombol simpan */
    }

    .btn-primary-custom:hover {
        background-color: #134a96;
    }

    /* Gaya tambahan untuk menampilkan form berdampingan */
    .row-flex {
        display: flex;
        flex-wrap: wrap;
        margin-left: -15px;
        /* Kompensasi padding kolom */
        margin-right: -15px;
        /* Kompensasi padding kolom */
    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-left: 15px;
        padding-right: 15px;
        box-sizing: border-box;
    }

    /* Menggabungkan kriteria-item dengan input komponen dan nilai */
    .kriteria-item {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Jarak antar komponen input dan tombol */
        margin-bottom: 15px;
    }

    .kriteria-item .nilai-input-group {
        flex: 0 0 120px;
        /* Lebar tetap untuk input nilai */
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Detail Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('penilaian.index') }}">Penilaian</a></div>
                <div class="breadcrumb-item">Detail Penilaian</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-custom">
                <h2 class="card-title-custom">Detail Penilaian</h2>


                {{-- Bagian "Penilaian Untuk" telah dihapus --}}

                <div class="row row-flex">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h3 class="form-section-title">Personal</h3>
                            <div id="personal-criteria-container">
                                @foreach($personalComponents as $item)
                                <div class="kriteria-item">
                                    <div class="form-group-custom">
                                        <label>Komponen Penilaian</label>
                                        <input type="text" class="form-control-custom" value="{{ $item['komponen'] }}" readonly>
                                    </div>
                                    <div class="form-group-custom nilai-input-group">
                                        <label>Nilai</label>
                                        <input type="text" class="form-control-custom" value="{{ $item['nilai'] }}" readonly>
                                    </div>
                                    {{-- Tombol hapus disembunyikan --}}
                                </div>
                                @endforeach
                            </div>
                            {{-- Tombol tambah disembunyikan --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-section">
                            <h3 class="form-section-title">Kompetensi</h3>
                            <div id="kompetensi-criteria-container">
                                @foreach($kompetensiComponents as $item)
                                <div class="kriteria-item">
                                    <div class="form-group-custom">
                                        <label>Komponen Penilaian</label>
                                        <input type="text" class="form-control-custom" value="{{ $item['komponen'] }}" readonly>
                                    </div>
                                    <div class="form-group-custom nilai-input-group">
                                        <label>Nilai</label>
                                        <input type="text" class="form-control-custom" value="{{ $item['nilai'] }}" readonly>
                                    </div>
                                    {{-- Tombol hapus disembunyikan --}}
                                </div>
                                @endforeach
                            </div>
                            {{-- Tombol tambah disembunyikan --}}
                        </div>
                    </div>
                </div>

                {{-- Bagian "Input Mentor" telah dihapus --}}

                <div class="form-actions">
                    <a href="{{ route('penilaianmentor.index') }}" class="btn btn-secondary-custom">Kembali</a>
                    {{-- Tombol simpan disembunyikan --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Tidak ada script jQuery untuk tambah/hapus baris karena ini halaman read-only --}}
<script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
<script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@endpush
