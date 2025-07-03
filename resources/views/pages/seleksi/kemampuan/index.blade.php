@extends('layouts.app')

@section('title', 'Kemampuan')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
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

    .table tbody td:nth-child(9),
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

    .dropdown-item:hover {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
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

    /* Styling untuk modal konfirmasi (sesuai Administrasi) */
    .modal-backdrop {
        background-color: transparent;
        /* Diubah menjadi transparan sesuai referensi Administrasi */
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
        /* Tetap dipertahankan untuk responsivitas */
        box-sizing: border-box;
        /* Tetap dipertahankan untuk responsivitas */
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

    .modal-title-custom {
        font-size: 25px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .modal-message-custom {
        color: #555;
        margin-bottom: 20px;
        /* Diubah dari 0px menjadi 20px sesuai Administrasi */
        font-size: 15px;
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        /* Diubah dari 0px menjadi 20px sesuai Administrasi */
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

    /* Styling untuk tombol atau link yang dinonaktifkan setelah aksi */
    .dropdown-item.disabled-option {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* New styles for success/error SweetAlert2 modals */
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
            <h1 class="section-title">Tes Kemampuan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Kemampuan</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4 align-items-center">
                <form action="{{ route('kemampuan.index') }}" style="width: 100%;display: flex;" method="GET">
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
                            <th>Posisi</th>
                            <th>Tanggal Tes</th>
                            <th>Soal</th>
                            <th>Jawaban</th>
                            <th>Status</th>
                            <th>Catatan Ditolak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kemampuan as $i => $item)
                        <tr id="row-{{ $item->id }}">
                            <td>{{ $kemampuan->firstItem() + $i }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ $item->nama->email }}</td>
                            <td>{{ @$item->posisi->nama }}</td>
                            <td>
                                {{-- Menampilkan tanggal tes, atau '-' jika kosong --}}
                                @if($item->tanggal_awal_tes_kemampuan && $item->tanggal_akhir_tes_kemampuan)
                                {{ date('d M Y', strtotime($item->tanggal_awal_tes_kemampuan)) }} - {{ date('d M Y', strtotime($item->tanggal_akhir_tes_kemampuan)) }}
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                {{-- Kondisi untuk menampilkan ikon mata Soal --}}
                                @if($item->soal == 'ada')
                                <a href="{{ route('kemampuan.show', $item->id) }}" class="eye-button" aria-label="Lihat Soal">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                {{-- Kondisi untuk menampilkan ikon mata Jawaban --}}
                                @if(!empty($item->jawaban_tes_kemampuan))
                                <a class="eye-button"
                                    href="{{ asset('file?page='.$item->jawaban_tes_kemampuan) }}"
                                    target="_blank"
                                    aria-label="Lihat Jawaban">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td class="status-cell">
                                @if ($item->status_tes_kemampuan == 'diterima')
                                <span class="badge-status badge-lulus">Diterima</span>
                                @elseif ($item->status_tes_kemampuan == 'ditolak')
                                <span class="badge-status badge-ditolak">Ditolak</span>
                                @else
                                <span class="badge-status badge-proses">Proses</span>
                                @endif
                            </td>
                            <td class="catatan-ditolak-cell">
                                @if($item->status_tes_kemampuan == 'ditolak' && $item->catatan_tolak_tes_kemampuan)
                                {{ $item->catatan_tolak_tes_kemampuan }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdown{{ $item->id }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk {{ $item->nama->name }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        @php
                                        $isFinalStatus = ($item->status_tes_kemampuan == 'diterima' || $item->status_tes_kemampuan == 'ditolak');
                                        $isSoalUploaded = ($item->soal == 'ada'); // Asumsi 'ada' berarti soal sudah diunggah
                                        // $isJawabanUploaded = !empty($item->jawaban_tes_kemampuan); // Opsional jika ada logika aksi terkait jawaban

                                        $disableUnggahSoal = $isFinalStatus || $isSoalUploaded;
                                        $disableTerimaTolak = $isFinalStatus || !$isSoalUploaded; // Terima/Tolak memerlukan soal terunggah
                                        @endphp

                                        {{-- Unggah Soal --}}
                                        <a href="{{ route('kemampuan.edit', $item->id) }}" class="dropdown-item {{ $disableUnggahSoal ? 'disabled-option' : '' }}"
                                            {{ $disableUnggahSoal ? 'tabindex="-1" aria-disabled="true"' : '' }}>
                                            <i class="bi bi-cloud-upload"></i> Unggah Soal
                                        </a>
                                        <hr class="dropdown-divider">
                                        {{-- Terima --}}
                                        <button type="button" class="dropdown-item terima-btn {{ $disableTerimaTolak ? 'disabled-option' : '' }}"
                                            data-toggle="modal" data-target="#terimaModal" data-id="{{ $item->id }}"
                                            {{ $disableTerimaTolak ? 'disabled' : '' }}>
                                            <i class="fas fa-check"></i> Terima
                                        </button>
                                        {{-- Tolak --}}
                                        <button type="button" class="dropdown-item tolak-btn {{ $disableTerimaTolak ? 'disabled-option' : '' }}"
                                            data-toggle="modal" data-target="#tolakModal" data-id="{{ $item->id }}"
                                            {{ $disableTerimaTolak ? 'disabled' : '' }}>
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data kemampuan yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="float-right mt-3">
                {{ $kemampuan->links() }}
            </div>

        </div>
    </section>
</div>

{{-- Modal Konfirmasi Terima --}}
<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="terimaModalLabel">Terima Pendaftar?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menerima pendaftar ini?
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary-custom" id="confirmTerimaBtn">Terima</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Tolak --}}
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="tolakModalLabel">Tolak Pendaftar?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menolak pendaftar ini?
                <div class="form-group mt-3">
                    <label for="catatanDitolakInput">Catatan Alasan Ditolak:</label>
                    <textarea class="form-control" id="catatanDitolakInput" rows="3" placeholder="Masukkan alasan penolakan..." required></textarea>
                </div>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-secondary-custom" id="confirmTolakBtn">Tolak</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        var currentKemampuanId; // Variabel untuk menyimpan ID pendaftar kemampuan yang akan diproses

        // --- Handling Terima Pendaftar Kemampuan ---
        $('.terima-btn').on('click', function() {
            if (!$(this).is(':disabled')) {
                currentKemampuanId = $(this).data('id');
                $('#terimaModal').modal('show');
            }
        });

        $('#confirmTerimaBtn').on('click', function() {
            if (currentKemampuanId) {
                updateStatusKemampuan(currentKemampuanId, 'terima');
            } else {
                Swal.fire('Error!', 'ID kemampuan tidak ditemukan untuk aksi terima.', 'error');
            }
        });

        // --- Handling Tolak Pendaftar Kemampuan ---
        $('.tolak-btn').on('click', function() {
            if (!$(this).is(':disabled')) {
                currentKemampuanId = $(this).data('id');
                $('#tolakModal').modal('show');
            }
        });

        $('#confirmTolakBtn').on('click', function() {
            if (currentKemampuanId) {
                var catatan = $('#catatanDitolakInput').val();
                if (catatan.trim() === '') {
                    Swal.fire('Peringatan!', 'Catatan alasan ditolak tidak boleh kosong.', 'warning');
                    return;
                }
                updateStatusKemampuan(currentKemampuanId, 'tolak', catatan);
            } else {
                Swal.fire('Error!', 'ID kemampuan tidak ditemukan untuk aksi tolak.', 'error');
            }
        });

        // --- Fungsi AJAX untuk Update Status Kemampuan ---
        function updateStatusKemampuan(itemId, actionType, catatan = null) {
            var url = '';
            var statusBadgeClass = '';
            var statusBadgeText = '';
            var dataToSend = {
                _token: '{{ csrf_token() }}',
                id: itemId
            };

            if (actionType === 'terima') {
                url = `{{ route('kemampuan.terima') }}`;
                statusBadgeClass = 'badge-lulus';
                statusBadgeText = 'Diterima';
            } else if (actionType === 'tolak') {
                url = `{{ route('kemampuan.tolak') }}`;
                statusBadgeClass = 'badge-ditolak';
                statusBadgeText = 'Ditolak';
                dataToSend.catatan_tolak_tes_kemampuan = catatan;
            } else {
                Swal.fire('Error!', 'Tipe aksi tidak valid.', 'error');
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: dataToSend,
                success: function(response) {
                    if (response.success) {
                        $('#terimaModal').modal('hide');
                        $('#tolakModal').modal('hide');

                        var $row = $('#row-' + itemId);
                        if ($row.length) {
                            var $statusCell = $row.find('.status-cell');
                            $statusCell.empty().append('<span class="badge-status ' + statusBadgeClass + '">' + statusBadgeText + '</span>');

                            var $catatanCell = $row.find('.catatan-ditolak-cell');
                            if (actionType === 'tolak') {
                                $catatanCell.text(catatan || '-');
                            } else {
                                $catatanCell.text('-');
                            }

                            // Nonaktifkan semua tombol aksi terkait (Unggah Soal, Terima, Tolak)
                            $row.find('.dropdown-menu .dropdown-item').each(function() {
                                $(this).prop('disabled', true).addClass('disabled-option');
                                if ($(this).is('a')) {
                                    $(this).attr('tabindex', '-1').attr('aria-disabled', 'true');
                                }
                            });

                            // Show SweetAlert2 success or error modal
                            if (actionType === 'terima') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Diterima!',
                                    text: 'Pendaftar telah berhasil diterima.',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup-custom',
                                        icon: 'swal2-icon-custom',
                                        title: 'swal2-title-custom',
                                        htmlContainer: 'swal2-html-container-custom',
                                        confirmButton: 'swal2-confirm-custom'
                                    }
                                });
                            } else if (actionType === 'tolak') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Berhasil Ditolak!',
                                    text: 'Pendaftar telah berhasil ditolak.',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup-custom',
                                        icon: 'swal2-icon-custom',
                                        title: 'swal2-title-custom',
                                        htmlContainer: 'swal2-html-container-custom',
                                        confirmButton: 'swal2-confirm-custom'
                                    }
                                });
                            }

                        } else {
                            Swal.fire('Informasi!', 'Baris tabel tidak ditemukan, halaman akan dimuat ulang untuk pembaruan.', 'info');
                            location.reload();
                        }
                    } else {
                        Swal.fire('Gagal!', response.message || 'Terjadi kesalahan saat memperbarui status.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error!', 'Terjadi kesalahan saat menghubungi server: ' + xhr.responseText, 'error');
                    console.error(xhr.responseText);
                }
            });
        }

        $('#terimaModal, #tolakModal').on('hidden.bs.modal', function(e) {
            currentKemampuanId = null;
            $('#catatanDitolakInput').val('');

            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $('.modal-backdrop').remove();
        });
    });
</script>
@endpush
