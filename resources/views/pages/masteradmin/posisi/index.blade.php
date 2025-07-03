@extends('layouts.app')

@section('title', 'Posisi')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
{{-- Memperbaiki atribut xintegrity menjadi integrity --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-publish {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-unpublish {
        background-color: #fce7f3;
        color: #db2777;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
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
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 60px;
        margin: 0 auto 15px;
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
            <h1 class="section-title">Posisi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Posisi</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4">
                <div class="col-md-12">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPosisiModal">
                        <i class="bi bi-plus-lg"></i> Tambah Posisi
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded" id="posisi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi</th>
                            <th>Total Kuota</th>
                            <th>Kuota Tersedia</th>
                            <th>Deskripsi</th>
                            <th>Persyaratan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posisi as $key => $posisiItem)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $posisiItem['nama'] }}</td>
                            <td>{{ $posisiItem['total_kuota'] }}</td>
                            <td>{{ $posisiItem['kuota_tersedia'] }}</td>
                            <td>{{ $posisiItem['deskripsi'] }}</td>
                            <td>{{ $posisiItem['persyaratan'] }}</td>
                            <td>
                                @if ($posisiItem['status'] == 'publish')
                                <span class="badge-status badge-publish">Publish</span>
                                @elseif ($posisiItem['status'] == 'unpublish')
                                <span class="badge-status badge-unpublish">Unpublish</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdownPosisi{{ $posisiItem['id'] }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk {{ $posisiItem['nama'] }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdownPosisi{{ $posisiItem['id'] }}">
                                        {{-- Perbaikan: Menggunakan satu tombol dengan data-status --}}
                                        <a class="dropdown-item toggle-status-btn-posisi" href="#" data-toggle="modal"
                                            data-target="#publishunpublishModal"
                                            data-id="{{ $posisiItem['id'] }}"
                                            data-nama="{{ $posisiItem['nama'] }}"
                                            data-status="{{ $posisiItem['status'] }}">
                                            @if ($posisiItem['status'] == 'publish')
                                            <i class="fas fa-times-circle"></i> Unpublish
                                            @else
                                            <i class="fas fa-check-circle"></i> Publish
                                            @endif
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit-btn-posisi" href="#"
                                            data-toggle="modal" data-target="#editPosisiModal"
                                            data-id="{{ $posisiItem['id'] }}"
                                            data-nama="{{ $posisiItem['nama'] }}"
                                            data-total_kuota="{{ $posisiItem['total_kuota'] }}"
                                            data-kuota_tersedia="{{ $posisiItem['kuota_tersedia'] }}"
                                            data-deskripsi="{{ $posisiItem['deskripsi'] }}"
                                            data-persyaratan="{{ $posisiItem['persyaratan'] }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-btn-posisi" href="#" data-toggle="modal"
                                            data-target="#deleteModalPosisi"
                                            data-id="{{ $posisiItem['id'] }}"
                                            data-nama="{{ $posisiItem['nama'] }}">
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

            {{-- Jika ada pagination --}}
            {{-- <div class="float-right mt-3">
                {{ $posisi->links() }}
        </div> --}}

</div>
</section>
</div>

{{-- Modal Tambah Posisi --}}
<div class="modal fade" id="tambahPosisiModal" tabindex="-1" role="dialog" aria-labelledby="tambahPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPosisiModalLabel">Tambah Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('masterposisi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="total_kuota" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="kuota_tersedia">Kuota Tersedia</label>
                        <input type="number" class="form-control" id="kuota_tersedia" name="kuota_tersedia" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="persyaratan">Persyaratan</label>
                        <textarea class="form-control" id="persyaratan" name="persyaratan" rows="5"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Posisi --}}
<div class="modal fade" id="editPosisiModal" tabindex="-1" role="dialog" aria-labelledby="editPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPosisiModalLabel">Edit Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPosisiForm" method="POST" action="{{ url('masterposisi/sds') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_posisi_id">
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_total_kuota">Total Kuota</label>
                        <input type="number" class="form-control" id="edit_total_kuota" name="total_kuota" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kuota_tersedia">Kuota Tersedia</label>
                        <input type="number" class="form-control" id="edit_kuota_tersedia" name="kuota_tersedia" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_persyaratan">Persyaratan</label>
                        <textarea class="form-control" id="edit_persyaratan" name="persyaratan" rows="5"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL KONFIRMASI Publish/Unpublish --}}
<div class="modal fade" id="publishunpublishModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-success text-white" id="publishUnpublishIcon">
                <i class="fas"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="publishUnpublishTitle"></h5>
            <form id="publishUnpublishForm" method="POST" action="{{ route('masterposisi.publishUnpublish') }}">
                @csrf
                @method('POST')
                <div class="modal-body modal-message-custom">
                    Apakah Anda yakin ingin <span id="actionText"></span> posisi <strong><span id="namaPosisiStatus"></span></strong>?
                    <input type="hidden" name="id" id="statusPosisiId">
                    <input type="hidden" name="status" id="newStatusValue">
                </div>
                <div class="modal-footer modal-buttons-custom">
                    <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-primary-custom" id="submitButtonStatus"></button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Delete Posisi --}}
<div class="modal fade" id="deleteModalPosisi" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalPosisiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-danger text-white">
                <i class="bi bi-trash"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="deleteModalPosisiLabel">Konfirmasi Hapus</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menghapus posisi <strong><span id="namaPosisiDelete"></span></strong>?
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-secondary btn-secondary-custom" form="deleteFormPosisi">Hapus</button>
                <form id="deleteFormPosisi" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Posisi Berhasil Ditambahkan --}}
<div class="modal fade" id="successAddPosisiModal" tabindex="-1" role="dialog" aria-labelledby="successAddPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="successAddPosisiModalLabel">Berhasil!</h5>
            <div class="modal-body modal-message-custom">
                Posisi <strong><span id="namaPosisiBerhasilDitambahkan"></span></strong> berhasil ditambahkan.
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Posisi Berhasil Diperbarui --}}
<div class="modal fade" id="successEditPosisiModal" tabindex="-1" role="dialog" aria-labelledby="successEditPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="successEditPosisiModalLabel">Berhasil Diperbarui!</h5>
            <div class="modal-body modal-message-custom">
                Posisi <strong><span id="namaPosisiBerhasilDiperbarui"></span></strong> berhasil diperbarui.
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Posisi Berhasil Dihapus --}}
<div class="modal fade" id="successDeletePosisiModal" tabindex="-1" role="dialog" aria-labelledby="successDeletePosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="successDeletePosisiModalLabel">Berhasil Dihapus!</h5>
            <div class="modal-body modal-message-custom">
                Posisi <strong><span id="namaPosisiBerhasilDihapus"></span></strong> berhasil dihapus.
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Oke</button>
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

<script>
    $(document).ready(function() {
        // Function to bind all necessary event listeners
        function bindButtonEvents() {
            // Delete button functionality
            $('.delete-btn-posisi').off('click').on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                $('#namaPosisiDelete').text(nama);
                // Set action for the delete form. The form itself will be submitted via AJAX.
                var formAction = '/masterposisi/' + id;
                $('#deleteFormPosisi').attr('action', formAction);
                $('#deleteModalPosisi').modal('show');
            });

            // NEW: Toggle Status (Publish/Unpublish) button functionality
            $('.toggle-status-btn-posisi').off('click').on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var currentStatus = $(this).data('status'); // 'publish' atau 'unpublish'

                var actionText = "";
                var newStatus = "";
                var modalTitle = "";
                var iconClass = "";
                var iconBgClass = "";
                var buttonText = "";
                var buttonClass = "";

                if (currentStatus === 'publish') {
                    actionText = "mengunpublish";
                    newStatus = "unpublish";
                    modalTitle = "Konfirmasi Unpublish";
                    iconClass = "fas fa-times-circle";
                    iconBgClass = "bg-danger"; // Merah untuk unpublish
                    buttonText = "Unpublish";
                    buttonClass = "btn-secondary-custom"; // Merah untuk unpublish
                } else {
                    actionText = "mempublish";
                    newStatus = "publish";
                    modalTitle = "Konfirmasi Publish";
                    iconClass = "fas fa-check-circle";
                    iconBgClass = "bg-success"; // Hijau untuk publish
                    buttonText = "Publish";
                    buttonClass = "btn-primary-custom"; // Biru untuk publish
                }

                $('#publishUnpublishTitle').text(modalTitle);
                $('#actionText').text(actionText);
                $('#namaPosisiStatus').text(nama);
                $('#statusPosisiId').val(id);
                $('#newStatusValue').val(newStatus);

                // Update modal icon
                $('#publishUnpublishIcon').removeClass('bg-success bg-danger').addClass(iconBgClass);
                $('#publishUnpublishIcon i').removeClass().addClass(iconClass);

                // Update submit button text and class
                $('#submitButtonStatus').text(buttonText).removeClass('btn-primary-custom btn-secondary-custom').addClass(buttonClass);

                $('#publishunpublishModal').modal('show');
            });

            // Edit button functionality to populate modal
            $('.edit-btn-posisi').off('click').on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var total_kuota = $(this).data('total_kuota');
                var kuota_tersedia = $(this).data('kuota_tersedia');
                var deskripsi = $(this).data('deskripsi');
                var persyaratan = $(this).data('persyaratan');

                $('#edit_posisi_id').val(id);
                $('#edit_nama').val(nama);
                $('#edit_total_kuota').val(total_kuota);
                $('#edit_kuota_tersedia').val(kuota_tersedia);
                $('#edit_deskripsi').val(deskripsi);
                $('#edit_persyaratan').val(persyaratan);

                // Set action for the edit form. The form itself will be submitted via AJAX.
                var form = $('#editPosisiForm');
                var updateRoute = "{{ route('masterposisi.update', ':id') }}";
                updateRoute = updateRoute.replace(':id', id);
                form.attr('action', updateRoute);

                $('#editPosisiModal').modal('show');
            });
        }

        // Initial binding of events when the page loads
        bindButtonEvents();

        // Handle form submission for Add Posisi using AJAX
        $('#tambahPosisiModal form').on('submit', function(e) {
            e.preventDefault(); // Mencegah submit form secara default

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            var namaPosisi = $('#nama').val(); // Ambil nama posisi dari input form

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    $('#tambahPosisiModal').modal('hide');
                    $('#namaPosisiBerhasilDitambahkan').text(namaPosisi);
                    $('#successAddPosisiModal').modal('show');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memperbarui posisi: ' + xhr.responseText);
                }
            });


        });

        // Handle form submission for Edit Posisi using AJAX
        $('#editPosisiForm').on('submit', function(e) {
            e.preventDefault();

            var id          = $('#edit_posisi_id').val();
            var form        = $(this);
            var formData    = form.serialize();
            var namaPosisi  = $('#edit_nama').val();

            var url = '/masterposisi/' + id;
            console.log('Submitting to:', url);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    $('#editPosisiModal').modal('hide');
                    $('#namaPosisiBerhasilDiperbarui').text(namaPosisi);
                    $('#successEditPosisiModal').modal('show');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memperbarui posisi: ' + xhr.responseText);
                }
            });
        });


        // Handle form submission for Delete Posisi using AJAX
        $('#deleteFormPosisi').on('submit', function(e) {
            e.preventDefault(); // Mencegah submit form secara default

            var form = $(this);
            var ur = form.attr('action');

            console.log(ur);
            var namaPosisi = $('#namaPosisiDelete').text(); // Ambil nama posisi dari teks di modal
            var url = 'sas';

            $.ajax({
                type: 'POST',
                url: ur,
                data: form.serialize(),
                success: function(response) {
                    $('#deleteModalPosisi').modal('hide');
                    $('#namaPosisiBerhasilDihapus').text(namaPosisi);
                    $('#successDeletePosisiModal').modal('show');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memperbarui posisi: ' + xhr.responseText);
                }
            });


        });


        // Event listener for when any modal is fully hidden
        // This ensures the backdrop and modal-open class are removed to prevent freezing
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
