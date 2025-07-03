@extends('layouts.appmentor')

@section('title', 'Input Penilaian')

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
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #1758B9;
        /* Menggunakan warna primary yang konsisten */
        box-shadow: 0 0 0 0.2rem rgba(23, 88, 185, 0.3);
    }

    .btn-add-kriteria {
        background-color: #e0e0e0;
        color: #333;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        width: 100%;
        text-align: center;
    }

    .btn-add-kriteria:hover {
        background-color: #c0c0c0;
    }

    .btn-danger-custom {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 10px;
        /* Jarak dari input */
        display: flex;
        /* Untuk centering ikon */
        align-items: center;
        justify-content: center;
        height: 40px;
        /* Menyesuaikan tinggi dengan input */
    }

    .btn-danger-custom:hover {
        background-color: #d32f2f;
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-secondary-custom {
        background-color: #b0bec5;
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
        background-color: #b0bec5;
    }

    .btn-primary-custom {
        background-color: #333A48;
        /* Menggunakan warna primary yang konsisten */
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
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
        /* Mengubah dari flex-end ke center untuk perataan vertikal */
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
            <h1 class="section-title">Input Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('penilaian.index') }}">Penilaian</a></div>
                <div class="breadcrumb-item">Input Penilaian</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-custom">
                <h2 class="card-title-custom">Form Penilaian</h2> {{-- Ini Nama Posisi, nanti diganti dengan data dari controller --}}

                <form action="{{ route('penilaianmentor.store', 'id='.$id) }}" method="POST">
                    @csrf
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
                                            <input type="text" name="personal_komponen[]" disabled class="form-control-custom" placeholder="Komponen Penilaian" value="{{ $item['komponen'] }}" required>
                                        </div>
                                        <div class="form-group-custom nilai-input-group">
                                            <label>Nilai</label>
                                            <input type="number" name="personal_nilai[]" disabled class="form-control-custom" placeholder="Nilai" min="0" max="100" value="{{ $item['nilai'] }}" required>
                                        </div>
                                        <button type="button" class="btn-danger-custom remove-kriteria-btn" disabled>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn-add-kriteria" id="add-personal-kriteria" disabled>
                                    + Tambah Kriteria Lainnya
                                </button>
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
                                            <input type="text" name="kompetensi_komponen[]" class="form-control-custom" placeholder="Komponen Penilaian" value="{{ $item['komponen'] }}" required>
                                        </div>
                                        <div class="form-group-custom nilai-input-group">
                                            <label>Nilai</label>
                                            <input type="number" name="kompetensi_nilai[]" class="form-control-custom" placeholder="Nilai" min="0" max="100" value="{{ $item['nilai'] }}" required>
                                        </div>
                                        <button type="button" class="btn-danger-custom remove-kriteria-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn-add-kriteria" id="add-kompetensi-kriteria">
                                    + Tambah Kriteria Lainnya
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian "Input Mentor" telah dihapus --}}

                    <div class="form-actions">
                        <a href="{{ route('penilaianmentor.index') }}" class="btn btn-secondary-custom">Kembali</a>
                        <button type="submit" class="btn btn-primary-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
<script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        // Fungsi untuk menambahkan input kriteria baru
        function addKriteriaInput(containerId, type) {
            const container = document.getElementById(containerId);
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'kriteria-item';
            newInputGroup.innerHTML = `
                <div class="form-group-custom">
                    <label>Komponen Penilaian</label>
                    <input type="text" name="${type}_komponen[]" class="form-control-custom" placeholder="Komponen Penilaian" required>
                </div>
                <div class="form-group-custom nilai-input-group">
                    <label>Nilai</label>
                    <input type="number" name="${type}_nilai[]" class="form-control-custom" placeholder="Nilai" min="0" max="100" required>
                </div>
                <button type="button" class="btn-danger-custom remove-kriteria-btn">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            container.appendChild(newInputGroup);
        }

        // Event listener untuk tombol "Tambah Kriteria Lainnya"
        $('#add-personal-kriteria').on('click', function() {
            addKriteriaInput('personal-criteria-container', 'personal');
        });

        $('#add-kompetensi-kriteria').on('click', function() {
            addKriteriaInput('kompetensi-criteria-container', 'kompetensi');
        });

        // Event listener untuk tombol hapus kriteria (delegated event)
        $(document).on('click', '.remove-kriteria-btn', function() {
            const container = $(this).closest('.form-section').find('.kriteria-item').parent();
            $(this).closest('.kriteria-item').remove();

            // Jika semua baris dihapus, tambahkan satu baris kosong
            if (container.children().length === 0) {
                const type = container.attr('id').includes('personal') ? 'personal' : 'kompetensi';
                addKriteriaInput(container.attr('id'), type);
            }
        });
    });
</script>
@endpush
