@extends('layouts.appmentor')

@section('title', 'Sertifikat')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Custom styles provided by the user */
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-active {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-inactive {
        background-color: #fce7f3;
        color: #db2777;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        position: relative;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .icon-button:hover {
        background: #e2e8f0;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        text-align: left;
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .main-content {
        margin-top: 30px;
    }

    .table-rounded {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-rounded thead th:first-child {
        border-top-left-radius: 12px;
    }

    .table-rounded thead th:last-child {
        border-top-right-radius: 12px;
    }

    .table-rounded tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    .table-rounded tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    .align-middle {
        vertical-align: middle !important;
    }

    .dropdown-menu.show {
        background-color: #ffffff !important;
        border: none;
        border-radius: 12px !important;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        padding: 10px 0 !important;
        min-width: 150px;
    }

    .dropdown-item {
        color: #334155 !important;
        font-weight: 500 !important;
        padding: 10px 20px !important;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dropdown-item:hover {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
    }

    .dropdown-toggle::after {
        display: none !important;
    }

    /* Modal specific styles */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.2);
        /* Ini adalah backdrop transparan yang kamu minta */
        /* background-color: transparent !important; <- Mengubah ini agar tetap ada sedikit overlay */
    }

    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - (0.5rem * 2));
        width: auto;
        max-width: 90%;
        margin: 0.5rem auto;
    }

    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height: calc(100% - (1.75rem * 2));
            max-width: 450px;
            margin: 1.75rem auto;
        }
    }

    .modal-content-custom {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px 30px;
        /* Padding content di dalam modal */
        text-align: center;
        width: 100%;
        box-sizing: border-box;
    }

    .modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #ffe0b2;
        color: #f57c00;
        display: flex;
        justify-content: center;
        align-items: center;
        /* font-size: 60px; */
        /* Dihapus, akan disesuaikan di .modal-icon i */
        margin: 0 auto 15px;
        /* Jarak antara ikon dan judul */
    }

    /* Penyesuaian ukuran ikon di dalam lingkaran */
    .modal-icon i {
        font-size: 40px;
        /* Ukuran ikon yang lebih besar dan proporsional */
        line-height: 1;
        /* Pastikan line-height agar ikon berada di tengah */
    }

    .modal-icon.bg-success {
        background-color: #c3e6cb !important;
        color: #155724 !important;
    }

    .modal-icon.bg-warning {
        background-color: #ffeeba !important;
        color: #85640a !important;
    }

    .modal-icon.bg-danger {
        background-color: #f8d7da !important;
        color: #721c24 !important;
    }

    .modal-title-custom {
        font-size: 25px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        /* Jarak antara judul dan pesan */
    }

    .modal-message-custom {
        color: #555;
        margin-bottom: 25px;
        /* Jarak antara pesan dan tombol */
        font-size: 15px;
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 0px;
        flex-direction: row-reverse;
        /* Agar tombol "Beri Sertifikat" ada di kanan */
    }

    .btn-primary-custom {
        background-color: #1758B9;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-secondary-custom {
        background-color: #EB2027;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary-custom:hover {
        background-color: #134a96;
    }

    .btn-secondary-custom:hover {
        background-color: #b8181e;
        color: #fff;
    }

    /* Specific styles for the "Check Persyaratan" modal */
    .check-requirements-modal .modal-content {
        display: flex;
        flex-direction: column;
        padding: 20px;
        text-align: left;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .check-requirements-modal .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: none;
        padding: 0 0 15px 0;
        width: 100%;
    }

    .check-requirements-modal .modal-header h5 {
        font-size: 20px;
        font-weight: bold;
        color: #dc3545;
        margin-bottom: 0;
    }

    .check-requirements-modal .modal-header .close {
        font-size: 1.5rem;
        color: #000;
        opacity: 0.5;
        padding: 0;
        margin: 0;
    }

    .check-requirements-modal .modal-body {
        display: flex;
        align-items: flex-start;
        padding: 0;
        width: 100%;
    }

    .check-requirements-modal .modal-body .image-container {
        flex-shrink: 0;
        margin-right: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
    }

    .check-requirements-modal .modal-body .image-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .check-requirements-modal .modal-body .requirements-content {
        flex-grow: 1;
        padding-top: 0;
    }

    .check-requirements-modal .requirements-content p {
        margin-bottom: 10px;
        font-weight: bold;
    }

    .check-requirements-modal .requirements-list {
        list-style: none;
        padding: 0;
        margin-top: 0;
    }

    .check-requirements-modal .requirements-list li {
        margin-bottom: 10px;
        display: flex;
        align-items: flex-start;
        line-height: 1.2;
    }

    .check-requirements-modal .requirements-list input[type="radio"] {
        margin-right: 10px;
        transform: scale(1.2);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .check-requirements-modal .requirements-list label {
        font-size: 16px;
        color: #333;
        margin-bottom: 0;
    }

    /* Adjust modal width for this specific modal */
    .check-requirements-modal .modal-dialog {
        max-width: 600px;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Sertifikat</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Sertifikat</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-rounded" id="tabel-penilaian">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th class="text-center align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($beri as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $item->user_name }}</td>
                        <td class="align-middle">{{ $item->email }}</td>
                        <td class="align-middle">{{ $item->nama_posisi }}</td>
                        <td class="text-center align-middle">
                            <div class="dropdown">
                                <button class="icon-button dropdown-toggle" type="button"
                                    id="aksiDropdownPenilaian{{ $item->id }}" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-align-justify"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="aksiDropdownPenilaian{{ $item->id }}">

                                        <button class="dropdown-item beri-sertifikat-btn"
                                            data-toggle="modal"
                                            data-target="#confirmBeriSertifikatModal"
                                            data-item-id="{{ $item->id }}"
                                            data-item-nama="{{ $item->user_name }}" {{ $item->beri ? 'disabled' : '' }}>
                                            <i class="{{ $item->beri ? '' : 'bi bi-pencil' }}"></i> {{ $item->beri ? 'Sudah Diberikan' : 'Beri Sertifikat' }}
                                        </button>

                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#checkRequirementsModal">
                                        <i class="bi bi-eye-fill"></i> Check Persyaratan
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data penilaian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

{{-- Modal "Check Persyaratan" (yang sudah ada) --}}
<div class="modal fade check-requirements-modal" id="checkRequirementsModal" tabindex="-1" aria-labelledby="checkRequirementsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkRequirementsModalLabel">Check Persyaratan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="image-container">
                    <img src="{{ asset('user/assets/icons/ilustrasi.png') }}" alt="Ilustrasi">
                </div>
                <div class="requirements-content">
                    <p class="font-weight-bold mb-3">Persyaratan :</p>
                    <ul class="requirements-list">
                        <ul>
                            <li><label>Berikan Penilaian Kepada Mentee</label></li>
                            <li><label>Ingatkan Mentee untuk Melakukan update Progress hingga 100%</label></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi "Beri Sertifikat" BARU --}}
<div class="modal fade" id="confirmBeriSertifikatModal" tabindex="-1" role="dialog" aria-labelledby="confirmBeriSertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-body">
                {{-- <div class="modal-icon bg-warning"> --}}
                <div class="modal-icon bg-warning mb-4"> <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5 class="modal-title-custom" id="confirmBeriSertifikatModalLabel">Konfirmasi Beri Sertifikat</h5>
                <p class="modal-message-custom">Apakah Anda yakin ingin memberikan sertifikat <strong id="namaval"></strong> ini?</p>
                <div class="modal-buttons-custom">
                    <button type="button" class="btn btn-secondary-custom" data-dismiss="modal">Batal</button>
                    <form id="beriSertifikatForm" action="{{ route('berisertifikat.store') }}" method="POST">
                        @csrf
                        {{-- Hidden input untuk menyimpan ID yang akan diberikan sertifikat --}}
                        <input type="hidden" name="item_id" id="item_id_to_certify">
                        <input type="hidden" name="nama" id="item_nama_to_certify">
                        <button type="submit" class="btn btn-primary-custom">Beri Sertifikat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successAddPosisiModal" tabindex="-1" role="dialog" aria-labelledby="successAddPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="successAddPosisiModalLabel">Berhasil!</h5>
            <div class="modal-body modal-message-custom">
                Sertifikat <strong><span id="namaPosisiBerhasilDitambahkan"></span></strong> berhasil diberikan.
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

<div id="loadingOverlay" style="
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.4);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
">
    <div style="
        background: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        font-weight: bold;
    ">
        <span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
        &nbsp;Loading...
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Ketika tombol "Beri Sertifikat" di dropdown diklik
        $('.beri-sertifikat-btn').on('click', function() {
            // Ambil ID dari atribut data-item-id
            var itemId = $(this).data('item-id');

            // Set ID ke input tersembunyi di dalam modal konfirmasi
            $('#item_id_to_certify').val(itemId);
            $('#item_nama_to_certify').val($(this).data('item-nama'));
            $('#namaval').text($(this).data('item-nama'));


            // Perhatikan: Karena kamu menggunakan `data-toggle="modal"` dan `data-target="#confirmBeriSertifikatModal"`
            // pada elemen `<a>`, modal akan otomatis muncul.
            // Tidak perlu memanggil $('#confirmBeriSertifikatModal').modal('show'); di sini.
        });


        $('#confirmBeriSertifikatModal form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            var namaPosisi = $('#item_nama_to_certify').val();

            document.getElementById('loadingOverlay').style.display = 'flex';

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    document.getElementById('loadingOverlay').style.display = 'none';
                    $('#confirmBeriSertifikatModal').modal('hide');
                    $('#namaPosisiBerhasilDitambahkan').text(namaPosisi);
                    $('#successAddPosisiModal').modal('show');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memperbarui sertifikat: ' + xhr.responseText);
                }
            });
        });

        $('.modal').on('hidden.bs.modal', function() {
            // Cek apakah ada modal lain yang masih terbuka
            if ($('.modal:visible').length === 0) {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            }

            // Reset form jika modal tambah posisi ditutup
            if ($(this).attr('id') === 'tambahPosisiModal') {
                $(this).find('form')[0].reset();
            }

            // Reload halaman setelah modal sukses ditambahkan, diperbarui, atau dihapus ditutup
            if ($(this).attr('id') === 'successAddPosisiModal' ||
                $(this).attr('id') === 'successEditPosisiModal' ||
                $(this).attr('id') === 'successDeletePosisiModal') {
                location.reload();
            }
        });
    });



</script>
@endpush
