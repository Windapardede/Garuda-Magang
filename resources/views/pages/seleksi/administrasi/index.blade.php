@extends('layouts.app')

@section('title', 'Administrasi')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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

    .badge-diterima {
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

    /* Hapus atau nonaktifkan .icon-button.disabled jika tidak lagi digunakan */
    /* .icon-button.disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background-color: #e2e8f0;
    }

    .icon-button.disabled i {
        color: #94a3b8;
    } */

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

    .dropdown-item.disabled {
        /* CSS untuk dropdown item disabled */
        color: #94a3b8 !important;
        /* Warna teks saat disabled */
        background-color: transparent !important;
        cursor: not-allowed;
    }

    .dropdown-item.disabled:hover {
        background-color: transparent !important;
        color: #94a3b8 !important;
    }

    .dropdown-toggle::after {
        display: none !important;
    }

    .modal-backdrop {
        background-color: transparent;
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
        margin-bottom: 0px;
        font-size: 15px;
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
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

    .dropdown {
        display: inline-block;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Administrasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Administrasi</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4 align-items-center">
                <form action="{{ route('administrasi.index') }}" style="width: 100%;display: flex;" method="GET">
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
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Catatan Ditolak</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($administrasi as $i => $item)
                        <tr id="row-{{ $item->id }}">
                            <td>{{ $administrasi->firstItem() + $i }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ $item->nama->email }}</td>
                            <td>{{ $item->nama->phone }}</td>
                            <td>{{ @$item->posisi->nama }}</td>
                            <td>{{ @$item->nama->instansi->nama }}</td>
                            <td>
                                {{ date('d M Y', strtotime(@$item->periode->created_at)) }} -
                                {{ \Carbon\Carbon::parse(@$item->periode->tanggal_selesai)->translatedFormat('d M Y') }}
                            </td>
                            <td class="status-cell">
                                @if($item->status_administrasi == 'proses')
                                <span class="badge-status badge-proses">Proses</span>
                                @elseif($item->status_administrasi == 'diterima')
                                <span class="badge-status badge-diterima">Diterima</span>
                                @elseif($item->status_administrasi == 'ditolak')
                                <span class="badge-status badge-ditolak">Ditolak</span>
                                @else
                                <span class="badge-status badge-proses">Proses</span>
                                @endif
                            </td>
                            <td class="catatan-ditolak-cell">
                                @if($item->status_administrasi == 'ditolak' && $item->catatan_tolak_administrasi)
                                {{ $item->catatan_tolak_administrasi ?? '-' }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button" id="dokumenDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dokumenDropdown{{ $item->id }}">
                                        <a class="dropdown-item" href="{{asset('file?page='.$item->nama->cv)}}" target="_blank"><i class="fas fa-file-alt"></i> CV</a>
                                        <a class="dropdown-item" href="{{asset('file?page='.$item->nama->surat)}}" target="_blank"><i class="fas fa-file-alt"></i> Surat Instansi</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    {{-- Tombol dropdown utama (hamburger) tetap AKtIF --}}
                                    <button class="icon-button dropdown-toggle" type="button" id="aksiDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        {{-- Tombol Terima: Tambahkan kelas 'disabled' dan atribut 'disabled' jika status sudah diterima atau ditolak --}}
                                        <button type="button" class="dropdown-item terima-btn {{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? 'disabled' : '' }}"
                                            data-toggle="{{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? '' : 'modal' }}"
                                            data-target="{{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? '' : '#terimaModal' }}"
                                            data-id="{{ $item->id }}"
                                            {{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? 'disabled' : '' }}>
                                            <i class="fas fa-check text-success mr-2"></i> Terima
                                        </button>
                                        {{-- Tombol Tolak: Tambahkan kelas 'disabled' dan atribut 'disabled' jika status sudah diterima atau ditolak --}}
                                        <button type="button" class="dropdown-item tolak-btn {{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? 'disabled' : '' }}"
                                            data-toggle="{{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? '' : 'modal' }}"
                                            data-target="{{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? '' : '#tolakModal' }}"
                                            data-id="{{ $item->id }}"
                                            {{ ($item->status_administrasi == 'diterima' || $item->status_administrasi == 'ditolak') ? 'disabled' : '' }}>
                                            <i class="fas fa-times text-danger mr-2"></i> Tolak
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data administrasi yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="float-right mt-3">
                {{ $administrasi->links() }}
            </div>
        </div>
    </section>
</div>

{{-- MODAL TERIMA --}}
<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-primary-custom" id="confirmTerimaBtn">Terima</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
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
                    <textarea class="form-control" id="catatanDitolakInput" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmTolakBtn">Tolak</button>
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

{{-- CDN SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        var currentPengajuanId;

        $('.unggah-wawancara-btn').on('click', function() {
            var id = $(this).data('id');
            $('#unggah_wawancara_id').val(id);
            $('#unggahWawancaraModal').modal('show');
        });

        $('#unggahWawancaraModal').on('hidden.bs.modal', function(e) {
            $('#unggah_wawancara_id').val('');
            if ($('#unggahWawancaraForm').length) {
                $('#unggahWawancaraForm')[0].reset();
            }
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        });

        $('#unggahWawancaraModal').on('shown.bs.modal', function() {
            $(this).find('#tanggal_awal_seleksi').focus();
        });

        // --- Handling Terima Pendaftar ---
        // Hanya aktifkan jika tombol tidak memiliki kelas 'disabled'
        $(document).on('click', '.terima-btn:not(.disabled)', function() {
            currentPengajuanId = $(this).data('id');
            $('#terimaModal').modal('show');
        });

        $('#confirmTerimaBtn').on('click', function() {
            if (currentPengajuanId) {
                updateStatus(currentPengajuanId, 'terima');
            } else {
                console.error('ID pendaftar tidak ditemukan untuk aksi terima.');
            }
        });

        // --- Handling Tolak Pendaftar ---
        // Hanya aktifkan jika tombol tidak memiliki kelas 'disabled'
        $(document).on('click', '.tolak-btn:not(.disabled)', function() {
            currentPengajuanId = $(this).data('id');
            $('#tolakModal').modal('show');
        });

        $('#confirmTolakBtn').on('click', function() {
            if (currentPengajuanId) {
                var catatan = $('#catatanDitolakInput').val();
                updateStatus(currentPengajuanId, 'tolak', catatan);
            } else {
                console.error('ID pendaftar tidak ditemukan untuk aksi tolak.');
            }
        });

        // --- Fungsi AJAX untuk Update Status ---
        function updateStatus(itemId, actionType, catatan = null) {
            var url = '';
            var statusToSet = '';
            var successTitle = '';
            var successText = '';
            var dataToSend = {
                _token: '{{ csrf_token() }}',
                _method: 'POST',
                id: itemId
            };

            if (actionType === 'terima') {
                url = `{{ route('administrasi.terima') }}`;
                statusToSet = 'diterima';
                successTitle = 'Berhasil Diterima!';
                successText = 'Pendaftar telah berhasil diterima.';
            } else if (actionType === 'tolak') {
                url = `{{ route('administrasi.tolak') }}`;
                statusToSet = 'ditolak';
                successTitle = 'Berhasil Ditolak!';
                successText = 'Pendaftar telah berhasil ditolak.';
                dataToSend.catatan_tolak_administrasi = catatan;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan!',
                    text: 'Tipe aksi tidak valid.',
                });
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
                            $statusCell.empty();

                            if (statusToSet === 'diterima') {
                                $statusCell.append('<span class="badge-status badge-diterima">Diterima</span>');
                                $row.find('.catatan-ditolak-cell').text('-');
                            } else if (statusToSet === 'ditolak') {
                                $statusCell.append('<span class="badge-status badge-ditolak">Ditolak</span>');
                                $row.find('.catatan-ditolak-cell').text(catatan || '-');
                            }

                            // Hanya disable item "Terima" dan "Tolak" di dalam dropdown
                            $row.find('.terima-btn, .tolak-btn').addClass('disabled').prop('disabled', true).attr('data-toggle', '').attr('data-target', '');

                            Swal.fire({
                                icon: 'success',
                                title: successTitle,
                                text: successText,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Informasi',
                                text: 'Perubahan berhasil disimpan, halaman akan dimuat ulang.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal memperbarui status: ' + (response.message || 'Terjadi kesalahan.'),
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Jaringan!',
                        text: 'Terjadi kesalahan saat menghubungi server: ' + xhr.responseText,
                    });
                    console.error(xhr.responseText);
                }
            });
        }

        $('#terimaModal, #tolakModal').on('hidden.bs.modal', function(e) {
            currentPengajuanId = null;
            $('#catatanDitolakInput').val('');
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
            $('.modal-backdrop').remove();
        });
    });
</script>
@endpush
