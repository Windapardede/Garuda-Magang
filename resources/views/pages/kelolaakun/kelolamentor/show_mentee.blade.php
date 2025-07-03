@extends('layouts.app')

{{-- Judul Halaman --}}
@section('title', 'Detail Mentor - Data Mentee')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- Tambahkan link CSS Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- Link CSS untuk tema Bootstrap 4 dari Select2 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
<style>
    /* Gaya umum yang sudah ada */
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
        vertical-align: middle;
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
        min-width: 100px;
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

    /* **SOLUSI PENTING:** Backdrop modal */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.4) !important;
        /* Warna hitam dengan transparansi 40% */
        /* Z-index default Bootstrap adalah 1040. Kita tidak perlu mengubahnya kecuali ada konflik. */
    }

    /* Penyesuaian Modal Secara Global */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100% - (1rem * 2));
        width: auto;
        max-width: 480px;
        /* Sedikit lebih kecil agar mirip gambar referensi */
        margin: 1.75rem auto;
        /* Z-index default Bootstrap adalah 1050, jadi modal seharusnya selalu di atas backdrop. */
        /* Tambahkan ini jika modal tidak terlihat atau tidak bisa diklik */
        position: relative;
        /* Penting untuk z-index bekerja pada elemen ini */
        z-index: 1051;
        /* Pastikan ini lebih tinggi dari modal-backdrop (1040) dan lebih tinggi dari elemen lain yang mungkin tumpang tindih */
    }

    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height: calc(100% - (3.5rem * 2));
            max-width: 480px;
            margin: 1.75rem auto;
        }
    }

    .modal-content {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border: none;
        background-color: #ffffff;
        /* **PENTING**: Pastikan modal tetap terang */
        /* Pastikan tidak ada properti seperti `opacity` atau `filter` yang membuat modal ikut gelap */
        opacity: 1;
        /* Pastikan opacity penuh */
        filter: none;
        /* Pastikan tidak ada filter yang diterapkan */
    }

    .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 20px 25px;
        /* Padding yang konsisten dengan gambar referensi */
        background-color: transparent;
        /* Pastikan header modal tidak gelap */
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.25rem;
        /* Ukuran font judul modal, sekitar 20px */
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0;
    }

    .modal-header .close {
        padding: 0;
        margin: -1rem -1rem -1rem auto;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: none;
        opacity: .5;
    }

    .modal-header .close:hover {
        opacity: .75;
    }

    .modal-body {
        padding: 25px;
    }

    .modal-body .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .modal-body label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #495057;
        font-size: 15px;
    }

    .modal-body .form-control,
    .modal-body .select2-container .select2-selection--single {
        border-radius: 6px;
        /* Sesuai gambar referensi */
        padding: 10px 15px;
        border: 1px solid #ced4da;
        font-size: 16px;
        height: auto;
    }

    /* Penyesuaian khusus untuk Select2 agar visualnya menyatu */
    .select2-container--bootstrap4 .select2-selection--single {
        border-radius: 6px !important;
        /* Pastikan border-radius Select2 sama */
        height: auto !important;
        padding: 10px 15px !important;
        font-size: 16px !important;
        display: flex !important;
        align-items: center !important;
    }

    .select2-container--bootstrap4 .select2-selection__arrow {
        height: auto !important;
        right: 15px !important;
    }

    .select2-container--bootstrap4 .select2-selection__placeholder {
        color: #6c757d !important;
    }


    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 15px 25px;
        background-color: transparent;
        /* Pastikan footer modal tidak gelap */
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        justify-content: flex-end;
        /* Tombol ke kanan */
        gap: 10px;
    }

    /* Tombol Batal (btn-secondary) - warna abu-abu */
    .modal-footer .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .modal-footer .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .modal-footer .btn-secondary:active,
    .modal-footer .btn-secondary:focus {
        background-color: #4e555b !important;
        /* Lebih gelap saat aktif/fokus */
        border-color: #474e54 !important;
        box-shadow: none !important;
        /* Hapus shadow default focus */
    }

    /* Tombol Simpan (btn-primary) - warna biru gelap */
    .modal-footer .btn-primary {
        background-color: #3C4B64;
        /* Warna biru gelap yang konsisten dengan header tabel */
        border-color: #3C4B64;
        color: #fff;
    }

    .modal-footer .btn-primary:hover {
        background-color: #2e3b52;
        /* Lebih gelap saat hover */
        border-color: #2e3b52;
    }

    .modal-footer .btn-primary:active,
    .modal-footer .btn-primary:focus {
        background-color: #1e2735 !important;
        /* Lebih gelap lagi saat aktif/fokus */
        border-color: #1a222c !important;
        box-shadow: none !important;
    }


    /* Override gaya modal konfirmasi yang ada agar mengikuti gaya baru */
    .modal-content-custom {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border: none;
        padding: 25px;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
    }

    .modal-icon {
        width: 60px;
        height: 60px;
        font-size: 30px;
        margin: 0 auto 15px;
    }

    .modal-title-custom {
        font-size: 1.25rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 10px;
    }

    .modal-message-custom {
        color: #555;
        margin-bottom: 25px;
        font-size: 16px;
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 0px;
        flex-direction: row;
    }

    /* Gaya tombol custom (untuk modal konfirmasi) agar sesuai dengan btn-secondary/primary Bootstrap */
    .btn-primary-custom {
        /* Ini akan menjadi Batal */
        background-color: #6c757d;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary-custom:hover {
        background-color: #5a6268;
    }

    .btn-primary-custom:active,
    .btn-primary-custom:focus {
        background-color: #4e555b !important;
        border-color: #474e54 !important;
        box-shadow: none !important;
    }


    .btn-secondary-custom {
        /* Ini akan menjadi Hapus */
        background-color: #dc3545;
        /* Warna merah Bootstrap untuk Hapus */
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-secondary-custom:hover {
        background-color: #c82333;
    }

    .btn-secondary-custom:active,
    .btn-secondary-custom:focus {
        background-color: #a71d2a !important;
        /* Lebih gelap saat aktif/fokus */
        border-color: #9c1a25 !important;
        box-shadow: none !important;
    }


    /* Align text in table */
    .table td,
    .table th {
        vertical-align: middle;
    }

    .text-center {
        text-align: center;
    }

    .mentor-info {
        margin-bottom: 20px;
        font-size: 1.1rem;
        color: #495057;
    }

    /* CSS tambahan untuk memastikan tidak ada konflik */
    body.modal-open {
        overflow: hidden;
        /* Mencegah scroll pada body saat modal terbuka */
        padding-right: 0px !important;
        /* Mengatasi shifting body jika scrollbar hilang */
    }

    /* Pastikan modal muncul dengan benar di atas semua elemen */
    .modal.fade.show {
        display: block;
        /* Pastikan modal terlihat */
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Mentee</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kelolamentor.index') }}">Kelola Mentor</a></div>
                <div class="breadcrumb-item">Data Mentee</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            @if(isset($currentMentor))
            <div class="mentor-info">
                Menampilkan mentee untuk Mentor: <strong>{{ $currentMentor->nama ?? 'Nama Mentor Tidak Ditemukan' }}</strong>
                ({{ $currentMentor->posisi_mentor ?? 'Posisi Tidak Diketahui' }})
            </div>
            @else
            <div class="alert alert-warning">Informasi mentor tidak tersedia.</div>
            @endif

            <div class="row mb-3">
                <div class="col-md-12">
                    <button class="btn btn-primary" id="btnTambahMentee">
                        <i class="bi bi-plus-lg"></i> Tambah Mentee
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Institusi</th>
                            <th>Posisi</th>
                            <th>Periode</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Mentees as $mentee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mentee->name ?? 'N/A' }}</td>
                            <td>{{ $mentee->instansi->nama ?? 'N/A' }}</td>
                            <td>{{ $mentee->posisi->nama ?? 'N/A' }}</td>
                            <td>
                                {{ isset($mentee->mulai_magang) ? \Carbon\Carbon::parse($mentee->mulai_magang)->isoFormat('D MMMYYYY') : 'N/A' }}
                                -
                                {{ isset($mentee->selesai_magang) ? \Carbon\Carbon::parse($mentee->selesai_magang)->isoFormat('D MMMYYYY') : 'N/A' }}
                            </td>
                            <td class="text-center">
                                <button class="icon-button btn-hapus-mentee"
                                    data-mentee-id="{{ $mentee->id }}"
                                    data-mentee-nama="{{ $mentee->name ?? 'Mentee' }}"
                                    title="Hapus Mentee">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada mentee untuk mentor ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

{{-- Modal Tambah Mentee --}}
<div class="modal fade" id="modalTambahMentee" tabindex="-1" role="dialog" aria-labelledby="modalTambahMenteeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMenteeLabel">Tambah Mentee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahMentee" action="{{ isset($currentMentor) ? route('kelolamentor.mentee.store', $currentMentor->id) : '#' }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="selectMentee">Pilih Mentee</label>
                        <select class="form-control" id="selectMentee" name="mentee_id" required>
                            <option value="">-- Pilih Mentee --</option>
                            {{-- Options akan diisi via JavaScript dari data $availableMentees --}}
                            @foreach($availableMentees as $mentee)
                            <option value="{{ $mentee->nama->id }}">{{ $mentee->nama->name }} ({{ @$mentee->posisi->nama }})</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="formTambahMentee">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus Mentee --}}
<div class="modal fade" id="modalKonfirmasiHapusMentee" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon bg-danger">
                <i class="fas fa-trash"></i>
            </div>
            <h5 class="modal-title modal-title-custom" id="modalKonfirmasiHapusLabel">Konfirmasi Hapus</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menghapus mentee <strong id="namaMenteeHapus"></strong> dari mentor ini?
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary-custom" data-dismiss="modal">Batal</button>
                <form id="hapusFormMentee" method="POST" action="#" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary-custom">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- Standard Stisla JS --}}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('library/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('library/tooltip.js/dist/umd/tooltip.min.js') }}"></script>
<script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('library/moment/locale/id.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>

{{-- Select2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Custom JS --}}
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>



<script>
    // Set locale moment.js ke Indonesia
    moment.locale('id');

    $(document).ready(function() {
        // Inisialisasi Select2 pada dropdown mentee


        // Reset form when modal is shown
        $('#modalTambahMentee').on('show.bs.modal', function() {
            $('#formTambahMentee')[0].reset();

            //  $('#selectMentee').select2({
            //     theme: 'bootstrap4', // Menggunakan tema Bootstrap 4 untuk Select2
            //     placeholder: '-- Pilih Mentee --',
            //     allowClear: true // Memungkinkan pengguna untuk menghapus pilihan
            // });

            // Reset Select2
            $('#selectMentee').val(null).trigger('change');
        });

        // --- Modal Tambah Mentee ---
        $('#btnTambahMentee').on('click', function() {
            $('#modalTambahMentee').modal('show');
        });

        // --- Submit Form Tambah Mentee (Contoh AJAX) ---
        $('#formTambahMentee').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            form.find('button[type="submit"]').prop('disabled', true).text('Menyimpan...');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    $('#modalTambahMentee').modal('hide');
                    alert(response.message || 'Mentee berhasil ditambahkan!');
                    location.reload(); // Reload halaman untuk melihat perubahan
                },
                error: function(xhr, status, error) {
                    let errorMessage = 'Gagal menambahkan mentee.\n';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            errorMessage += xhr.responseJSON.message + '\n';
                        }

                        if (xhr.responseJSON.errors) {
                            for (const key in xhr.responseJSON.errors) {
                                if (xhr.responseJSON.errors.hasOwnProperty(key)) {
                                    xhr.responseJSON.errors[key].forEach(msg => {
                                        errorMessage += '- ' + msg + '\n';
                                    });
                                }
                            }
                        }
                    } else {
                        errorMessage += 'Terjadi kesalahan tidak dikenal.';
                    }

                    alert(errorMessage);
                    form.find('button[type="submit"]').prop('disabled', false).text('Simpan');
                },
                complete: function() {
                    form.find('button[type="submit"]').prop('disabled', false).text('Simpan');
                }
            });

        });


        // --- Modal Konfirmasi Hapus Mentee ---
        $('.table-responsive').on('click', '.btn-hapus-mentee', function() {
            var menteeId = $(this).data('mentee-id');
            var menteeNama = $(this).data('mentee-nama');
            var mentorId = window.location.pathname.split('/')[2];

            if (!mentorId) {
                alert('Error: Mentor ID tidak ditemukan di URL.');
                return;
            }

            var deleteUrl = `/kelolamentor/${mentorId}/mentee/${menteeId}`;

            $('#namaMenteeHapus').text(menteeNama);
            $('#hapusFormMentee').attr('action', deleteUrl);

            $('#modalKonfirmasiHapusMentee').modal('show');
        });

        // --- Konfirmasi Hapus Mentee via AJAX ---
        $('#modalKonfirmasiHapusMentee').on('submit', '#hapusFormMentee', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var submitButton = form.find('button[type="submit"]')


            submitButton.prop('disabled', true).text('Menghapus...');

            $.ajax({
                type: 'POST',
                url: url, // Tetap POST karena @method('DELETE') akan mengubahnya
                data: form.serialize(),
                success: function(response) {
                    $('#modalKonfirmasiHapusMentee').modal('hide');
                    alert(response.message || 'Mentee berhasil dihapus!');
                    const menteeIdToDelete = url.split('/').pop();
                    $('button.btn-hapus-mentee[data-mentee-id="' + menteeIdToDelete + '"]').closest('tr').fadeOut(300, function() {
                        $(this).remove();
                        // Perbarui nomor urut setelah penghapusan
                        $('table.table-rounded tbody tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                        });
                        // Jika tidak ada baris lagi, tampilkan pesan "Belum ada mentee"
                        if ($('table.table-rounded tbody tr').length === 0) {
                            $('table.table-rounded tbody').append('<tr><td colspan="6" class="text-center">Belum ada mentee untuk mentor ini.</td></tr>');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var errorMessage = 'Gagal menghapus mentee.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            if (jsonResponse.message) {
                                errorMessage = jsonResponse.message;
                            }
                        } catch (e) {
                            console.error("Could not parse error response:", xhr.responseText);
                        }
                    }
                    console.error('AJAX Error:', status, error, xhr.responseText);
                    alert(errorMessage);
                    submitButton.prop('disabled', false).text('Hapus');
                },
                complete: function() {
                    location.reload();
                    submitButton.prop('disabled', false).text('Hapus');
                }
            });
        });

        // Event listener untuk memastikan class `modal-open` dihapus dari body
        // ketika *semua* modal ditutup.
        $(document).on('hidden.bs.modal', function(e) {
            // Cek jika tidak ada modal lain yang sedang ditampilkan

            if ($('.modal.show').length === 0) {
                $('body').removeClass('modal-open');
                $('body').css('padding-right', ''); // Hapus padding-right yang mungkin ditambahkan
            }
        });
    });
</script>
