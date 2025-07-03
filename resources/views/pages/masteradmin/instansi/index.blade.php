@extends('layouts.app')

@section('title', 'Mitra')

@push('style')
    {{-- Gaya CSS Anda yang sudah ada --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.2);
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
            /* Warna default ikon */
            display: flex;
            /* Memastikan konten di dalamnya bisa di-center */
            justify-content: center;
            /* Center horizontal */
            align-items: center;
            /* Center vertical */
            margin: 0 auto 15px;
            /* Line-height dihapus dari sini, karena centering oleh flexbox dan pengaturan font-size pada <i> langsung lebih efektif */
        }

        /* === BARU / MODIFIKASI: Mengatur ukuran dan centering ikon di dalam .modal-icon === */
        .modal-icon i {
            font-size: 50px;
            /* Sesuaikan ukuran font ikon ini agar pas di dalam lingkaran */
            line-height: 1;
            /* Penting untuk icon fonts agar tidak ada spasi ekstra vertikal */
            display: block;
            /* Memastikan <i> mengambil ruang penuhnya untuk centering flexbox */
            /* Pastikan tidak ada properti position, top, left, transform di sini, karena parent sudah menggunakan flexbox untuk centering */
        }

        .modal-icon.bg-success {
            background-color: #c3e6cb !important;
            color: #155724 !important;
            /* Warna ikon hijau */
        }

        .modal-icon.bg-warning {
            background-color: #ffeeba !important;
            color: #85640a !important;
            /* Warna ikon kuning */
        }

        .modal-icon.bg-danger {
            background-color: #f8d7da !important;
            color: #721c24 !important;
            /* Warna ikon merah */
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
            margin-top: 0px;
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
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Mitra</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Mitra</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')

                <div class="row mb-4">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahInstansiModal">
                            <i class="bi bi-plus-lg"></i> Tambah Mitra
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-rounded" id="mitra-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mitra</th>
                                <th class="text-center align-middle">Kuota</th>
                                <th class="text-center align-middle">Kuota Tersedia</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instansi as $key => $instansiItem)
                                <tr>
                                    <td class="align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle">{{ $instansiItem['nama'] }}</td>
                                    <td class="text-center align-middle">{{ $instansiItem['kuota'] }}</td>
                                    <td class="text-center align-middle">{{ $instansiItem['kuota_tersedia'] }}</td>
                                    <td class="text-center align-middle">
                                        @if ($instansiItem['is_active'])
                                            <span class="badge-status badge-active">Active</span>
                                        @else
                                            <span class="badge-status badge-inactive">Non Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            <button class="icon-button dropdown-toggle" type="button"
                                                id="aksiDropdownInstansi{{ $instansiItem['id'] }}" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                aria-label="Tampilkan opsi aksi untuk {{ $instansiItem['nama'] }}">
                                                <i class="fas fa-align-justify"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="aksiDropdownInstansi{{ $instansiItem['id'] }}">
                                                <a class="dropdown-item aktifnonaktif-btn-instansi" href="#"
                                                    data-id="{{ $instansiItem['id'] }}" data-nama="{{ $instansiItem['nama'] }}"
                                                    data-status="{{ $instansiItem['is_active'] ? 'active' : 'blacklisted' }}">
                                                    @if ($instansiItem['is_active'])
                                                        <i class="fas fa-ban"></i> Non Aktif
                                                    @else
                                                        <i class="fas fa-check"></i> Aktif
                                                    @endif
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item edit-btn-instansi" href="#"
                                                    data-id="{{ $instansiItem['id'] }}" data-nama="{{ $instansiItem['nama'] }}"
                                                    data-kuota="{{ $instansiItem['kuota'] }}"
                                                    data-kuota_tersedia="{{ $instansiItem['kuota_tersedia'] }}">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-btn-instansi" href="#"
                                                    data-id="{{ $instansiItem['id'] }}" data-nama="{{ $instansiItem['nama'] }}">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </div>

    {{-- MODAL TAMBAH MITRA --}}
    <div class="modal fade" id="tambahInstansiModal" tabindex="-1" role="dialog" aria-labelledby="tambahInstansiModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahInstansiModal">Tambah Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahInstansi" method="POST" action="{{ route('instansi.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Mitra</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Total Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" min="0" required>
                            <div id="totalKuotaError" class="text-danger small"></div> {{-- Tambahkan ini --}}
                        </div>
                        <div class="form-group">
                            <label for="kuota_tersedia">Kuota Tersedia</label>
                            <input type="number" class="form-control" id="kuota_tersedia" name="kuota_tersedia" min="0"
                                required>
                            <div id="kuotaTersediaError" class="text-danger small"></div> {{-- Tambahkan ini --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT MITRA --}}
    <div class="modal fade" id="editInstansiModal" tabindex="-1" role="dialog" aria-labelledby="editInstansiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInstansiModalLabel">Edit Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editInstansiForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit_instansi_id">
                        <div class="form-group">
                            <label for="edit_nama_instansi">Nama Mitra</label>
                            <input type="text" class="form-control" id="edit_nama_instansi" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kuota_instansi">Total Kuota</label>
                            <input type="number" class="form-control" id="edit_kuota_instansi" name="kuota" min="0"
                                required>
                            <div id="editTotalKuotaError" class="text-danger small"></div> {{-- Tambahkan ini --}}
                        </div>
                        <div class="form-group">
                            <label for="edit_kuota_tersedia_instansi">Kuota Tersedia</label>
                            <input type="number" class="form-control" id="edit_kuota_tersedia_instansi"
                                name="kuota_tersedia" min="0" required>
                            <div id="editKuotaTersediaError" class="text-danger small"></div> {{-- Tambahkan ini --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL KONFIRMASI BLACKLIST/UNBLACKLIST --}}
    <div class="modal fade" id="blacklistUnblacklistConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="blacklistUnblacklistConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-custom">
                <div class="modal-icon" id="blacklistUnblacklistModalIcon">
                    {{-- Icon akan diset oleh JS di sini, contoh: <i class="fas fa-ban"></i> --}}
                </div>
                <h5 class="modal-title modal-title-custom" id="blacklistUnblacklistModalTitle"></h5>
                <div class="modal-body modal-message-custom">
                    <span id="blacklistUnblacklistModalMessage"></span>
                    <form id="blacklistUnblacklistForm" action="{{ route('instansi.blacklistunblacklist') }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" id="blacklist_unblacklist_id">
                        <input type="hidden" name="is_active" id="blacklist_unblacklist_status">
                    </form>
                </div>
                <div class="modal-footer modal-buttons-custom">
                    <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                    <button type="submit" id="blacklistUnblacklistConfirmBtn" class="btn btn-secondary btn-secondary-custom"
                        form="blacklistUnblacklistForm"></button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL KONFIRMASI HAPUS --}}
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-custom">
                <div class="modal-icon bg-danger text-white">
                    <i class="bi bi-trash"></i>
                </div>
                <h5 class="modal-title modal-title-custom" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                <div class="modal-body modal-message-custom">
                    Apakah Anda yakin ingin menghapus instansi <strong><span id="namaInstansiDelete"></span></strong>?
                    <form id="deleteFormInstansi" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer modal-buttons-custom">
                    <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-secondary btn-secondary-custom"
                        form="deleteFormInstansi">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL SUKSES (UNIVERSAL) --}}
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-custom">
                <div class="modal-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                </div>
                <h5 class="modal-title modal-title-custom" id="successModalTitle">Berhasil!</h5>
                <div class="modal-body modal-message-custom">
                    <p id="successModalMessage"></p>
                </div>
                <div class="modal-footer modal-buttons-custom">
                    <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(document).ready(function () {

            // Function to show the universal success modal
            function showSuccessModal(title, message) {
                $('#successModalTitle').text(title);
                $('#successModalMessage').text(message);
                $('#successModal').modal('show');
            }

            // Function to reload table data
            function reloadTableData() {
                location.reload();
            }

            // --- Fungsi Validasi Kuota ---
            function validateQuota(totalKuotaInputId, kuotaTersediaInputId, totalErrorDivId, tersediaErrorDivId) {
                const totalKuota = parseInt($(totalKuotaInputId).val());
                const kuotaTersedia = parseInt($(kuotaTersediaInputId).val());
                let isValid = true;

                // Clear previous errors
                $(totalErrorDivId).text('');
                $(tersediaErrorDivId).text('');

                if (isNaN(totalKuota) || totalKuota < 0) {
                    $(totalErrorDivId).text('Total Kuota harus angka positif.');
                    isValid = false;
                }
                if (isNaN(kuotaTersedia) || kuotaTersedia < 0) {
                    $(tersediaErrorDivId).text('Kuota Tersedia harus angka positif.');
                    isValid = false;
                }

                // Hanya cek relasi jika kedua input valid secara angka positif
                if (isValid && totalKuota < kuotaTersedia) {
                    $(totalErrorDivId).text('Total Kuota tidak boleh lebih kecil dari Kuota Tersedia.');
                    $(tersediaErrorDivId).text('Kuota Tersedia tidak boleh lebih besar dari Total Kuota.');
                    isValid = false;
                }

                return isValid;
            }

            // --- Handle Tambah Mitra ---
            $('#formTambahInstansi').on('submit', function (e) {
                // Panggil fungsi validasi sebelum submit
                if (!validateQuota('#kuota', '#kuota_tersedia', '#totalKuotaError', '#kuotaTersediaError')) {
                    e.preventDefault(); // Mencegah form disubmit jika validasi gagal
                    return;
                }

                e.preventDefault(); // Pastikan default behavior form tetap dicegah untuk AJAX

                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        $('#tambahInstansiModal').modal('hide');
                        showSuccessModal('Berhasil!', 'Mitra berhasil ditambahkan.');
                        $('#successModal').on('hidden.bs.modal', function () {
                            reloadTableData();
                        });
                    },
                    error: function (xhr) {
                        var errorMessage = 'Terjadi kesalahan saat menambahkan mitra.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.status === 422) { // Laravel validation error
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = [];
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages.push(errors[key][0]);
                                }
                            }
                            errorMessage = errorMessages.join('<br>'); // Join multiple error messages
                        }
                        alert(errorMessage);
                    }
                });
            });

            // --- Handle Edit Mitra ---
            $('.edit-btn-instansi').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var kuota = $(this).data('kuota');
                var kuota_tersedia = $(this).data('kuota_tersedia');

                $('#edit_instansi_id').val(id);
                $('#edit_nama_instansi').val(nama);
                $('#edit_kuota_instansi').val(kuota);
                $('#edit_kuota_tersedia_instansi').val(kuota_tersedia);

                // Clear previous errors when modal opens
                $('#editTotalKuotaError').text('');
                $('#editKuotaTersediaError').text('');


                var form = $('#editInstansiForm');
                var updateRoute = "{{ route('instansi.update', ':id') }}";
                updateRoute = updateRoute.replace(':id', id);
                form.attr('action', updateRoute);

                $('#editInstansiModal').modal('show');
            });

            $('#editInstansiForm').on('submit', function (e) {
                // Panggil fungsi validasi sebelum submit
                if (!validateQuota('#edit_kuota_instansi', '#edit_kuota_tersedia_instansi', '#editTotalKuotaError', '#editKuotaTersediaError')) {
                    e.preventDefault(); // Mencegah form disubmit jika validasi gagal
                    return;
                }

                e.preventDefault(); // Pastikan default behavior form tetap dicegah untuk AJAX

                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        $('#editInstansiModal').modal('hide');
                        showSuccessModal('Berhasil!', 'Mitra berhasil diperbarui.');
                        $('#successModal').on('hidden.bs.modal', function () {
                            reloadTableData();
                        });
                    },
                    error: function (xhr) {
                        var errorMessage = 'Terjadi kesalahan saat mengedit mitra.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.status === 422) { // Laravel validation error
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = [];
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages.push(errors[key][0]);
                                }
                            }
                            errorMessage = errorMessages.join('<br>'); // Join multiple error messages
                        }
                        alert(errorMessage);
                    }
                });
            });

            // --- Handle Blacklist/Unblacklist ---
            $('.aktifnonaktif-btn-instansi').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var status = $(this).data('status');

                var title, message, iconClass, btnText, newStatusValue;

                if (status === 'active') {
                    title = 'Konfirmasi Non Aktif';
                    message = 'Apakah Anda yakin ingin <strong>Menonktifkan</strong> instansi <strong>' + nama + '</strong>?';
                    iconClass = 'bg-warning fas fa-ban';
                    btnText = 'NonAktif';
                    newStatusValue = 0;
                } else {
                    title = 'Konfirmasi Aktif';
                    message = 'Apakah Anda yakin ingin <strong>Mengaktifkan</strong> instansi <strong>' + nama + '</strong>?';
                    iconClass = 'bg-success fas fa-check';
                    btnText = 'Aktif';
                    newStatusValue = 1;
                }

                $('#blacklistUnblacklistModalTitle').text(title);
                $('#blacklistUnblacklistModalMessage').html(message);

                const modalIconDiv = $('#blacklistUnblacklistModalIcon');
                modalIconDiv.attr('class', 'modal-icon ' + iconClass.split(' ')[0]); // Keep only bg-color class

                const existingIcon = modalIconDiv.find('i');
                const faIconClass = iconClass.split(' ').filter(c => c.startsWith('fa')).join(' ');

                if (existingIcon.length) {
                    existingIcon.attr('class', faIconClass);
                } else {
                    modalIconDiv.html('<i class="' + faIconClass + '"></i>');
                }

                $('#blacklistUnblacklistConfirmBtn').text(btnText);

                $('#blacklist_unblacklist_id').val(id);
                $('#blacklist_unblacklist_status').val(newStatusValue);

                $('#blacklistUnblacklistConfirmationModal').modal('show');
            });

            $('#blacklistUnblacklistForm').on('submit', function (e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        $('#blacklistUnblacklistConfirmationModal').modal('hide');
                        var statusMessage = (response.is_active_updated === 1) ? 'diaktifkan kembali' : 'di-blacklist';
                        showSuccessModal('Berhasil!', 'Mitra berhasil ' + statusMessage + '.');
                        $('#successModal').on('hidden.bs.modal', function () {
                            reloadTableData();
                        });
                    },
                    error: function (xhr) {
                        var errorMessage = 'Terjadi kesalahan saat mengubah status mitra.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
            });

            // --- Handle Hapus Mitra ---
            $('.delete-btn-instansi').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                $('#namaInstansiDelete').text(nama);
                var formAction = "{{ route('instansi.destroy', ':id') }}";
                formAction = formAction.replace(':id', id);
                $('#deleteFormInstansi').attr('action', formAction);

                $('#deleteConfirmationModal').modal('show');
            });

            $('#deleteFormInstansi').on('submit', function (e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        $('#deleteConfirmationModal').modal('hide');
                        showSuccessModal('Berhasil!', 'Mitra berhasil dihapus.');
                        $('#successModal').on('hidden.bs.modal', function () {
                            reloadTableData();
                        });
                    },
                    error: function (xhr) {
                        var errorMessage = 'Terjadi kesalahan saat menghapus mitra.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
            });

            // Handle modal hiding logic for proper backdrop removal
            $(document).on('hidden.bs.modal', function (e) {
                // This ensures the backdrop is removed only if no other modals are open
                if ($('.modal.show').length === 0) {
                    $('.modal-backdrop').remove();
                }
            });
        });
    </script>
@endpush