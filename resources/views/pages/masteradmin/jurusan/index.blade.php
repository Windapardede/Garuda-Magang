@extends('layouts.app')

@section('title', 'Jurusan')

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
        display: inline-flex;
        /* Gunakan inline-flex untuk perataan di dalamnya */
        align-items: center;
        /* Ratakan item (ikon) secara vertikal di tengah tombol */
        justify-content: center;
        /* Ratakan item (ikon) secara horizontal di tengah tombol */
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0;
        /* Reset padding agar perataan flex bekerja baik */
        margin: 0;
        /* Reset margin */
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

    .table tbody td {
        padding-top: 10px;
        padding-bottom: 10px;
        vertical-align: middle;
        /* Sejajarkan vertikal konten sel */
        border-bottom: 1px solid #dee2e6;
        /* Sesuaikan warna border jika perlu */
    }

    .table tbody td:first-child {
        text-align: left;
    }

    .table tbody td:last-child {
        text-align: center;
        /* Tengahkan tombol aksi */
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
        /* Pastikan dropdown tidak mengambil baris penuh */
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
        /* Menghapus transparent !important yang menyebabkan masalah */
        /* Hapus baris ini: background-color: transparent !important; */
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
            <h1 class="section-title">Jurusan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Jurusan</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4">
                <div class="col-md-12">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal">
                        <i class="bi bi-plus-lg"></i> Tambah Jurusan
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded" id="jurusan-table"> {{-- Added ID for easier targeting --}}
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jurusan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusan as $key => $jurusanItem) {{-- Changed variable name to avoid conflict --}}
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $jurusanItem['nama'] }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdownJurusan{{ $jurusanItem['id'] }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk {{ $jurusanItem['nama'] }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdownJurusan{{ $jurusanItem['id'] }}">
                                        {{-- MODIFIED: Edit button now triggers modal --}}
                                        <a class="dropdown-item edit-btn-jurusan" href="#"
                                            data-toggle="modal" data-target="#editJurusanModal"
                                            data-id="{{ $jurusanItem['id'] }}"
                                            data-nama="{{ $jurusanItem['nama'] }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-btn-jurusan" href="#" data-toggle="modal"
                                            data-target="#confirmDeleteModal" {{-- MODIFIED: Target a generic confirm modal --}}
                                            data-id="{{ $jurusanItem['id'] }}" data-nama="{{ $jurusanItem['nama'] }}">
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
                {{ $jurusan->links() }}
        </div> --}}

</div>
</section>
</div>

{{-- Modal Tambah Jurusan --}}
<div class="modal fade" id="tambahJurusanModal" tabindex="-1" role="dialog" aria-labelledby="tambahJurusanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJurusanModalLabel">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahJurusan"> {{-- Added ID for AJAX submission --}}
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
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

{{-- NEW: Modal Edit Jurusan --}}
<div class="modal fade" id="editJurusanModal" tabindex="-1" role="dialog" aria-labelledby="editJurusanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJurusanModalLabel">Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editJurusanForm" method="POST" action=""> {{-- Action will be set by JS --}}
                    @csrf
                    @method('PUT') {{-- Use PUT method for update --}}
                    <input type="hidden" name="id" id="edit_jurusan_id">
                    <div class="form-group">
                        <label for="edit_nama_jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control" id="edit_nama_jurusan" name="nama" required>
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

{{-- MODALS GLOBAL CONFIRMATION / SUCCESS / ERROR --}}

{{-- Modal Konfirmasi Generik (untuk Hapus) --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-danger text-white">
                <i class="fas fa-trash"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menghapus jurusan <strong><span id="confirmJurusanNama"></span></strong>?
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-primary-custom" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Berhasil (Success) --}}
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="successModalLabel">Berhasil!</h5>
            <div class="modal-body modal-message-custom">
                <span id="successMessage">Operasi berhasil dilakukan.</span>
            </div>
            <div class="modal-footer modal-buttons-custom" style="justify-content: center;">
                <button type="button" class="btn btn-primary-custom" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Gagal (Error) --}}
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-danger text-white">
                <i class="fas fa-times-circle"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="errorModalLabel">Gagal!</h5>
            <div class="modal-body modal-message-custom">
                <span id="errorMessage">Terjadi kesalahan saat memproses permintaan Anda.</span>
            </div>
            <div class="modal-footer modal-buttons-custom" style="justify-content: center;">
                <button type="button" class="btn btn-primary-custom" data-dismiss="modal">Tutup</button>
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
    // Memastikan jQuery dimuat dengan benar dan $ alias tersedia
    (function($) {
        $(document).ready(function() {
            // Variabel untuk menyimpan ID jurusan yang akan dihapus
            let jurusanToDeleteId = null;

            // Function to bind all necessary event listeners (including for dynamically added rows, if any)
            function bindButtonEvents() {
                // Delete button functionality (opens generic confirm modal)
                $('.delete-btn-jurusan').off('click').on('click', function(e) {
                    e.preventDefault(); // Prevent default link behavior
                    jurusanToDeleteId = $(this).data('id');
                    var nama = $(this).data('nama');
                    $('#confirmJurusanNama').text(nama);
                    $('#confirmDeleteModal').modal('show');
                });

                // NEW: Edit button functionality to populate modal
                $('.edit-btn-jurusan').off('click').on('click', function() {
                    var id = $(this).data('id');
                    var nama = $(this).data('nama');

                    // Populate the edit modal fields
                    $('#edit_jurusan_id').val(id);
                    $('#edit_nama_jurusan').val(nama);

                    // Dynamically update the form action for the edit form
                    var form = $('#editJurusanForm');
                    var updateRoute = "{{ route('jurusan.update', ':id') }}";
                    updateRoute = updateRoute.replace(':id', id);
                    form.attr('action', updateRoute);

                    // Show the edit modal
                    $('#editJurusanModal').modal('show');
                });
            }

            // Initial binding of events when the page loads
            bindButtonEvents();

            // Handle confirm delete button click
            $('#confirmDeleteButton').off('click').on('click', function() {
                $('#confirmDeleteModal').modal('hide'); // Hide confirmation modal

                if (jurusanToDeleteId) {
                    var form = $(this);
                    var ur = form.attr('action');
                    $.ajax({
                        type: 'POST',
                        url: '/jurusan/' + jurusanToDeleteId, // Laravel resource route

                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            $('#successMessage').text(response.message || 'Jurusan berhasil dihapus!');
                            $('#successModal').modal('show');
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan saat memperbarui posisi: ' + xhr.responseText);
                        }
                    });


                }
            });

            // Handle Add Jurusan form submission via AJAX
            $('#formTambahJurusan').off('submit').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: "{{ route('jurusan.store') }}",
                    method: "POST",
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        $('#tambahJurusanModal').modal('hide');
                        $('#successMessage').text(response.message || 'Jurusan berhasil ditambahkan!');
                        $('#successModal').modal('show');
                        $('#formTambahJurusan')[0].reset(); // Reset the form
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat menambahkan jurusan.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = '';
                            for (let key in xhr.responseJSON.errors) {
                                errorMessage += xhr.responseJSON.errors[key][0] + '\n';
                            }
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#errorMessage').text(errorMessage);
                        $('#errorModal').modal('show');
                    }
                });
            });

            // Handle Edit Jurusan form submission via AJAX
            $('#editJurusanForm').off('submit').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                let form = $(this);
                let url = form.attr('action'); // Get action URL from the form

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form.serialize(),
                    success: function(response) {
                        $('#editJurusanModal').modal('hide');
                        $('#successMessage').text(response.message || 'Jurusan berhasil diperbarui!');
                        $('#successModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat memperbarui posisi: ' + xhr.responseText);
                    }
                });


            });

            // Event listener for when success modal is fully hidden
            $('#successModal').on('hidden.bs.modal', function(e) {
                location.reload(); // Reload the page to see changes
            });

            // Ensure backdrop is removed for other modals after closing
            $('#tambahJurusanModal, #editJurusanModal, #confirmDeleteModal, #errorModal').on('hidden.bs.modal', function(e) {
                setTimeout(function() {
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                }, 100);
            });
        });
    })(jQuery); // Meneruskan jQuery sebagai $ ke dalam fungsi
</script>
@endpush
