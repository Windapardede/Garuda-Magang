@extends('layouts.app')

@section('title', 'Wawancara')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
{{-- Tambahkan link SweetAlert2 CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    /* CSS yang sudah ada sebelumnya, tidak diubah */
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-proses {
        background-color: #c7d7fe;
        color: #3b82f6;
    }

    .badge-lulus {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-ditolak {
        background-color: #fecaca;
        color: #ef4444;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0;
        margin: 0;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
    }

    .icon-button:hover {
        background: #e2e8f0;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        vertical-align: middle;
        text-align: center;
    }

    .table thead th:first-child {
        text-align: left;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table tbody td:nth-child(10),
    .table tbody td:nth-child(11) {
        text-align: center;
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
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

    .dropdown {
        display: inline-block;
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

    .dropdown-item:hover:not(.disabled),
    .dropdown-item:active:not(.disabled) {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
    }

    .dropdown-item.disabled {
        color: #adb5bd !important;
        /* Warna abu-abu untuk disabled */
        cursor: not-allowed;
        background-color: transparent !important;
    }

    .dropdown-toggle::after {
        display: none !important;
    }

    .eye-button {
        background: none;
        border: none;
        color: #000000;
        font-size: 18px;
        cursor: pointer;
    }

    .eye-button:hover {
        color: #000000;
    }

    /* --- CSS PERBAIKAN UNTUK LAYOUT FILTER DAN PENCARIAN --- */
    .table-controls {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .table-controls .form-group {
        margin-bottom: 0;
    }

    .table-controls .form-control {
        height: 45px;
    }

    .table-controls .input-group {
        flex-grow: 1;
    }

    .input-group-text {
        border-radius: 0.25rem;
    }

    .input-group .form-control:first-child {
        border-top-left-radius: 0.25rem !important;
        border-bottom-left-radius: 0.25rem !important;
    }

    .input-group .form-control:last-child {
        border-top-right-radius: 0.25rem !important;
        border-bottom-right-radius: 0.25rem !important;
    }

    /* --- PERBAIKAN CSS BACKDROP MODAL DI SINI --- */
    /* Mengatur backdrop agar tetap terlihat jika dibutuhkan, tapi dengan styling yang tepat */
    .modal-backdrop.show {
        opacity: 0.5;
        /* Sesuaikan opasitas sesuai keinginan Anda */
        background-color: rgba(0, 0, 0, 0.5);
        /* Warna backdrop */
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
        font-size: 60px;
        margin: 0 auto 15px;
    }

    /* Icon untuk Modal Sukses */
    .modal-icon.success-icon {
        background-color: #d4edda;
        color: #28a745;
        font-size: 50px;
        /* Lebih kecil sedikit untuk ikon check */
    }

    .modal-title-custom {
        font-size: 25px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .modal-message-custom {
        color: #555;
        margin-bottom: 20px;
        /* Disesuaikan untuk konsistensi */
        font-size: 15px;
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        /* Disesuaikan untuk konsistensi */
        flex-direction: row-reverse;
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

    /* New styles for success/error SweetAlert2 modals (copied from Kemampuan) */
    .swal2-icon.swal2-success {
        border-color: #a5dc86;
        color: #a5dc86;
    }

    .swal2-icon.swal2-error {
        border-color: #f27474;
        color: #f27474;
    }

    .swal2-title {
        font-size: 25px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .swal2-html-container {
        color: #555;
        font-size: 15px;
        margin-bottom: 20px;
    }

    .swal2-confirm.swal2-styled {
        background-color: #1758B9 !important;
        color: #fff !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 10px 20px !important;
        font-size: 15px !important;
        cursor: pointer !important;
        transition: background-color 0.2s ease-in-out !important;
    }

    .swal2-confirm.swal2-styled:hover {
        background-color: #134a96 !important;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Wawancara</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Wawancara</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4 align-items-center">
                <form action="{{ route('wawancara.index') }}" style="width: 100%;display: flex;" method="GET">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="mr-2 mb-0">Show</label>
                        <select class="form-control form-control-sm" name="show" style="width: 80px;" onchange="this.form.submit()">
                            @foreach($limit as $limitv)
                            <option value="{{ $limitv }}" {{ request('show') == $limitv ? 'selected' : '' }}>
                                {{ $limitv}}
                            </option>
                            @endforeach
                        </select>
                        <label class="ml-2 mb-0">entries</label>
                    </div>

                    <div class="col-md-8">

                        <div class="position-relative">
                            <span class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); color: #aaa;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control pl-5 shadow-sm"
                                placeholder="Search Nama Pendaftar..." style="height: 45px;">
                        </div>

                    </div>

                    <div class="col-md-2">

                        <select name="status" class="form-control form-control-sm shadow-sm" style="height: 45px;" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="belumDiproses" {{ request('status') == 'belumDiproses' ? 'selected' : '' }}>Proses</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>

                    </div>
                </form>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Telephone</th>
                            <th>Posisi</th>
                            <th>Asal Institusi</th>
                            <th class="text-center">Tanggal Wawancara</th>
                            <th class="text-center">Link Wawancara</th>
                            <th class="text-center">Status</th>
                            <th>Catatan Ditolak</th>
                            <th>Catatan Diterima</th> {{-- Menambahkan kolom Catatan Diterima --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wawancara as $item)
                        <tr id="row-{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ $item->nama->email }}</td>
                            <td>{{ $item->nama->phone }}</td>
                            <td>{{ @$item->nama->posisi->nama }}</td>
                            <td>{{ @$item->nama->instansi->nama }}</td>
                            <td class="text-center">
                                {{-- Modifikasi di sini: Tampilkan tanggal hanya jika tidak kosong dan valid --}}
                                @php
                                $displayDate = '-';
                                if (!empty($item->tanggal_wawancara) && $item->tanggal_wawancara !== '0000-00-00') {
                                try {
                                $parsedDate = \Carbon\Carbon::parse($item->tanggal_wawancara);
                                if ($parsedDate->isValid()) {
                                $displayDate = $parsedDate->translatedFormat('d M Y');
                                } else {
                                // Explicitly set to '-' if Carbon considers it invalid after parsing
                                $displayDate = '-';
                                }
                                } catch (\Throwable $e) { // Use \Throwable to catch all errors and exceptions
                                // Ensure it's explicitly '-' on any parsing error
                                $displayDate = '-';
                                }
                                }
                                echo $displayDate;
                                @endphp
                            </td>
                            <td>
                                @if ($item->link_wawancara)
                                <a href="{{ $item->link_wawancara }}" target="_blank" class="eye-button"
                                    title="Lihat Link Wawancara">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->status_wawancara == 'diterima')
                                <span class="badge-status badge-lulus">Diterima</span>
                                @elseif ($item->status_wawancara == 'ditolak')
                                <span class="badge-status badge-ditolak">Ditolak</span>
                                @else
                                <span class="badge-status badge-proses">Proses</span>
                                @endif
                            </td>
                            <td>
                                {{-- Menampilkan catatan ditolak --}}
                                @if ($item->status_wawancara == 'ditolak' && $item->catatan_tolak_wawancara)
                                {{ $item->catatan_tolak_wawancara }}
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                {{-- Menampilkan catatan diterima --}}
                                @if ($item->status_wawancara == 'diterima' && $item->catatan_terima_wawancara)
                                {{ $item->catatan_terima_wawancara }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="icon-button dropdown-toggle"
                                        id="aksiDropdown{{ $item->id }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk {{ $item->nama->name }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        @php
                                        $isFinalStatus = ($item->status_wawancara == 'diterima' || $item->status_wawancara == 'ditolak');
                                        // Cek apakah link_wawancara tidak kosong dan tidak null
                                        $hasLink = !empty($item->link_wawancara);
                                        // $disableTerimaTolak = $isFinalStatus || ($item->status_wawancara == 'proses' && !$hasLink); // Logika sebelumnya
                                        $disableTerimaTolak = !$hasLink || $isFinalStatus; // Logika baru: disabled jika belum ada link ATAU sudah final
                                        @endphp
                                        <button type="button" class="dropdown-item unggah-btn" data-toggle="modal"
                                            data-target="#unggahWawancaraModal" data-id="{{ $item->id }}"
                                            data-tanggal="{{ !empty($item->tanggal_wawancara) && \Carbon\Carbon::parse($item->tanggal_wawancara)->isValid() ? \Carbon\Carbon::parse($item->tanggal_wawancara)->format('Y-m-d') : '' }}"
                                            data-jam="{{ $item->jam_wawancara ? \Carbon\Carbon::parse($item->jam_wawancara)->format('H:i') : '' }}"
                                            data-link="{{ $item->link_wawancara }}"
                                            @if ($isFinalStatus) disabled @endif>
                                            <i class="fas fa-upload"></i> Unggah Wawancara
                                        </button>
                                        <hr class="dropdown-divider">
                                        <button type="button" class="dropdown-item terima-btn" data-toggle="modal"
                                            data-target="#terimaModal" data-id="{{ $item->id }}"
                                            data-catatan="{{ $item->catatan_terima_wawancara }}"
                                            @if ($disableTerimaTolak) disabled @endif>
                                            <i class="fas fa-check"></i> Terima
                                        </button>
                                        <button type="button" class="dropdown-item tolak-btn" data-toggle="modal"
                                            data-target="#tolakModal" data-id="{{ $item->id }}"
                                            data-catatan="{{ $item->catatan_tolak_wawancara }}"
                                            @if ($disableTerimaTolak) disabled @endif>
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="float-right mt-3">
                {{ $wawancara->withQueryString()->links() }}
            </div>

        </div>
    </section>
</div>

{{-- Modal Unggah Wawancara (tetap menggunakan Bootstrap modal) --}}
<div class="modal fade" id="unggahWawancaraModal" tabindex="-1" role="dialog"
    aria-labelledby="unggahWawancaraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                <i class="fas fa-upload"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="unggahWawancaraModalLabel">Unggah Data Wawancara</h5>
            <div class="modal-body modal-message-custom text-left">
                <form id="unggahForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="wawancara_id" id="unggah_wawancara_id">
                    <div class="form-group">
                        <label for="tanggalWawancaraInput">Tanggal Wawancara:</label>
                        <input type="date" class="form-control" id="tanggalWawancaraInput"
                            name="tanggal_wawancara" required>
                    </div>
                    <div class="form-group">
                        <label for="jamWawancaraInput">Jam Wawancara:</label>
                        <input type="time" class="form-control" id="jamWawancaraInput" name="jam_wawancara"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="linkWawancaraInput">Link Wawancara:</label>
                        <input type="url" class="form-control" id="linkWawancaraInput" name="link_wawancara"
                            placeholder="Masukkan link Google Meet, Zoom, dll." required>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom"
                    data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-primary-custom" form="unggahForm">Unggah</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Terima (tetap menggunakan Bootstrap modal untuk konfirmasi awal) --}}
<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                <i class="fas fa-question"></i> {{-- Mengganti ikon ke tanda tanya --}}
            </div>
            <h5 class="modal-title modal-title-custom" id="terimaModalLabel">Terima Wawancara?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menerima wawancara ini?
                <div class="form-group mt-3">
                    <label for="catatanDiterimaInput">Catatan Alasan Diterima (Opsional):</label>
                    <textarea class="form-control" id="catatanDiterimaInput" rows="3"
                        placeholder="Masukkan alasan Penerimaan..."></textarea>
                </div>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom"
                    data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-primary-custom" id="confirmTerimaBtn">Terima</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tolak (tetap menggunakan Bootstrap modal untuk konfirmasi awal) --}}
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                <i class="fas fa-question"></i> {{-- Mengganti ikon ke tanda tanya --}}
            </div>
            <h5 class="modal-title modal-title-custom" id="tolakModalLabel">Tolak Wawancara?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menolak wawancara ini?
                <div class="form-group mt-3">
                    <label for="catatanDitolakInput">Catatan Alasan Ditolak (Opsional):</label>
                    <textarea class="form-control" id="catatanDitolakInput" rows="3"
                        placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom"
                    data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-primary-custom" {{-- Diubah ke primary untuk konsistensi --}}
                    id="confirmTolakBtn">Tolak</button>
            </div>
        </div>
    </div>
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
{{-- Tambahkan SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var currentWawancaraId;
    var currentRow; // Menyimpan referensi ke baris tabel saat ini

    $(document).ready(function() {
        // Mendapatkan tanggal hari ini
        const today = new Date();
        // Menambahkan 1 hari ke tanggal hari ini untuk mendapatkan tanggal minimal besok
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);

        const year = tomorrow.getFullYear();
        const month = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
        const day = String(tomorrow.getDate()).padStart(2, '0');
        const minDate = `${year}-${month}-${day}`;

        // Set atribut min pada input tanggal wawancara
        $('#tanggalWawancaraInput').attr('min', minDate);

        // Fungsi untuk membersihkan backdrop modal
        function cleanModalBackdrop() {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', ''); // Pastikan padding-right direset
        }

        // Fungsi untuk menonaktifkan semua tombol aksi dalam dropdown (untuk status final)
        function disableAllActionButtons(rowElement) { // Nama fungsi diubah agar lebih jelas
            $(rowElement).find('.dropdown-item').prop('disabled', true).addClass('disabled');
        }

        // Fungsi untuk mengatur status disabled/enabled tombol aksi per baris
        function initializeRowButtonStates(rowElement) {
            const statusText = $(rowElement).find('.badge-status').text().trim();

            // Perbaikan: Ambil teks dari sel link wawancara dan cek apakah ada tag <a> dengan href valid
            const $linkCell = $(rowElement).find('td:nth-child(8)');
            const $linkAnchor = $linkCell.find('a');
            const hasLink = $linkAnchor.length > 0 && $linkAnchor.attr('href') && $linkAnchor.attr('href') !== '#';

            const $unggahBtn = $(rowElement).find('.unggah-btn');
            const $terimaBtn = $(rowElement).find('.terima-btn');
            const $tolakBtn = $(rowElement).find('.tolak-btn');

            if (statusText === 'Diterima' || statusText === 'Ditolak') {
                // Jika status final, nonaktifkan semua tombol
                disableAllActionButtons(rowElement); // Panggil fungsi baru
            } else if (statusText === 'Proses') {
                // Jika status 'Proses'
                $unggahBtn.prop('disabled', false).removeClass('disabled'); // Unggah selalu aktif di status proses

                if (hasLink) {
                    // Jika link sudah ada, aktifkan Terima dan Tolak
                    $terimaBtn.prop('disabled', false).removeClass('disabled');
                    $tolakBtn.prop('disabled', false).removeClass('disabled');
                } else {
                    // Jika link belum ada, nonaktifkan Terima dan Tolak
                    $terimaBtn.prop('disabled', true).addClass('disabled');
                    $tolakBtn.prop('disabled', true).addClass('disabled');
                }
            }
        }

        // --- Inisialisasi status tombol saat halaman dimuat ---
        $('tr[id^="row-"]').each(function() {
            initializeRowButtonStates(this);
        });

        // --- Handling Unggah Wawancara ---
        $('#unggahWawancaraModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            currentWawancaraId = button.data('id');
            currentRow = button.closest('tr');
            var tanggal = button.data('tanggal');
            var jam = button.data('jam');
            var link = button.data('link');

            $('#unggah_wawancara_id').val(currentWawancaraId);

            // Logika untuk mengisi input tanggal di modal:
            // Jika tanggal dari data kosong atau '0000-00-00', biarkan input kosong.
            // Jika tanggal ada dan valid, gunakan tanggal tersebut.
            // Atribut 'min' sudah mengelola batasan tanggal H+1, jadi tidak perlu mengatur nilai ke minDate di sini
            if (!tanggal || tanggal === '0000-00-00') {
                $('#tanggalWawancaraInput').val('');
            } else {
                $('#tanggalWawancaraInput').val(tanggal);
            }

            $('#jamWawancaraInput').val(jam);
            $('#linkWawancaraInput').val(link);
            $('#unggahForm').attr('action', '/wawancara/' + currentWawancaraId + '/unggah');
        });

        // Submit form Unggah Wawancara via AJAX
        $('#unggahForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            const formAction = $(this).attr('action');

            $.ajax({
                url: formAction,
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#unggahWawancaraModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Diunggah!',
                        text: 'Link wawancara berhasil diunggah.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'swal2-popup-custom',
                            icon: 'swal2-icon-custom',
                            title: 'swal2-title-custom',
                            htmlContainer: 'swal2-html-container-custom',
                            confirmButton: 'swal2-confirm-custom'
                        }
                    }).then(() => {
                        // Perbarui tampilan link wawancara di tabel
                        var newLinkHtml = '<a href="' + $('#linkWawancaraInput').val() + '" target="_blank" class="eye-button" title="Lihat Link Wawancara"><i class="fas fa-eye"></i></a>';
                        currentRow.find('td:nth-child(8)').html(newLinkHtml);

                        // Perbarui tampilan tanggal wawancara di tabel dengan validasi yang kuat
                        var inputDateVal = $('#tanggalWawancaraInput').val(); // Ini adalah string YYYY-MM-DD dari input
                        var newTanggalFormatted = '-';
                        if (inputDateVal) {
                            // Pastikan moment.js mem-parse string YYYY-MM-DD dengan format yang benar
                            var parsedMomentDate = moment(inputDateVal, 'YYYY-MM-DD');
                            if (parsedMomentDate.isValid()) {
                                newTanggalFormatted = parsedMomentDate.format('DD MMM YYYY'); // Format sesuai dengan Blade
                            }
                        }
                        currentRow.find('td:nth-child(7)').empty().text(newTanggalFormatted); // Gunakan empty().text() untuk pembaruan yang bersih

                        // Perbarui atribut data-tanggal pada tombol Unggah Wawancara di baris ini
                        currentRow.find('.unggah-btn').data('tanggal', inputDateVal);

                        // Setelah unggah, panggil ulang inisialisasi tombol untuk baris ini
                        initializeRowButtonStates(currentRow);
                    });
                },
                error: function(xhr) {
                    console.error("Error uploading interview link:", xhr.responseText);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat mengunggah link wawancara. Silakan coba lagi.', 'error');
                }
            });
        });

        $('#unggahWawancaraModal').on('hidden.bs.modal', function(e) {
            $('#unggahForm').attr('action', '');
            $('#unggah_wawancara_id').val('');
            $('#tanggalWawancaraInput').val(''); // Pastikan tanggal juga dikosongkan saat modal disembunyikan
            $('#jamWawancaraInput').val('');
            $('#linkWawancaraInput').val('');
            cleanModalBackdrop();
        });

        // --- Handling Terima Pendaftar ---
        $('.terima-btn').on('click', function() {
            if ($(this).hasClass('disabled')) return; // Mencegah aksi jika disabled
            currentWawancaraId = $(this).data('id');
            currentRow = $(this).closest('tr');
            var catatanDiterima = $(this).data('catatan');
            $('#catatanDiterimaInput').val(catatanDiterima);
            $('#terimaModal').modal('show');
        });

        $('#confirmTerimaBtn').on('click', function() {
            if (currentWawancaraId) {
                var catatan = $('#catatanDiterimaInput').val();

                $.ajax({
                    url: '/wawancara/' + currentWawancaraId + '/terima',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        catatan_terima_wawancara: catatan
                    },
                    success: function(response) {
                        $('#terimaModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Diterima!',
                            text: 'Wawancara telah berhasil diterima.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'swal2-popup-custom',
                                icon: 'swal2-icon-custom',
                                title: 'swal2-title-custom',
                                htmlContainer: 'swal2-html-container-custom',
                                confirmButton: 'swal2-confirm-custom'
                            }
                        }).then(() => {
                            currentRow.find('td:nth-child(9)').html('<span class="badge-status badge-lulus">Diterima</span>');
                            currentRow.find('td:nth-child(11)').text(catatan);
                            // Setelah terima, disable semua tombol
                            disableAllActionButtons(currentRow); // Panggil fungsi baru
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menerima pendaftar. Silakan coba lagi.', 'error');
                    }
                });
            } else {
                console.error('ID wawancara tidak ditemukan untuk aksi terima.');
            }
        });

        $('#terimaModal').on('hidden.bs.modal', function(e) {
            $('#catatanDiterimaInput').val('');
            cleanModalBackdrop();
        });

        // --- Handling Tolak Pendaftar ---
        $('.tolak-btn').on('click', function() {
            if ($(this).hasClass('disabled')) return; // Mencegah aksi jika disabled
            currentWawancaraId = $(this).data('id');
            currentRow = $(this).closest('tr');
            var catatanDitolak = $(this).data('catatan');
            $('#catatanDitolakInput').val(catatanDitolak);
            $('#tolakModal').modal('show');
        });

        $('#confirmTolakBtn').on('click', function() {
            if (currentWawancaraId) {
                var catatan = $('#catatanDitolakInput').val();

                $.ajax({
                    url: '/wawancara/' + currentWawancaraId + '/tolak',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        catatan_tolak_wawancara: catatan
                    },
                    success: function(response) {
                        $('#tolakModal').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Berhasil Ditolak!',
                            text: 'Wawancara telah berhasil ditolak.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'swal2-popup-custom',
                                icon: 'swal2-icon-custom',
                                title: 'swal2-title-custom',
                                htmlContainer: 'swal2-html-container-custom',
                                confirmButton: 'swal2-confirm-custom'
                            }
                        }).then(() => {
                            currentRow.find('td:nth-child(9)').html('<span class="badge-status badge-ditolak">Ditolak</span>');
                            currentRow.find('td:nth-child(10)').text(catatan);
                            // Setelah tolak, disable semua tombol
                            disableAllActionButtons(currentRow); // Panggil fungsi baru
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menolak pendaftar. Silakan coba lagi.', 'error');
                    }
                });
            } else {
                console.error('ID wawancara tidak ditemukan untuk aksi tolak.');
            }
        });

        $('#tolakModal').on('hidden.bs.modal', function(e) {
            $('#catatanDitolakInput').val('');
            cleanModalBackdrop();
        });
    })
</script>
@endpush
