@extends('layouts.appmentor')

@section('title', 'Detail Monitoring')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    xintegrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg=="
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
        /* Untuk menjadi containing block bagi ikon yang diposisikan absolute */
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0 5px;
        display: inline-flex;
        /* Atau display: inline-block; jika tidak ingin flexbox mempengaruhi layout lain */
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
        background-color: transparent !important;
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

    /* --- Perubahan CSS untuk Modal yang Lebih Modern --- */
    .modal-content-custom {
        border-radius: 16px;
        /* Lebih besar untuk tampilan modern */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        /* Bayangan yang lebih lembut */
        padding: 0;
        /* Hapus padding di sini, akan diatur di dalam header/body/footer */
        text-align: center;
        width: 100%;
        box-sizing: border-box;
        overflow: hidden;
        /* Pastikan border-radius terlihat */
    }

    .modal-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        /* Padding lebih besar */
        border-bottom: 1px solid #e0e0e0;
        /* Garis pemisah yang lebih halus */
        background-color: #f8f8f8;
        /* Latar belakang header yang sedikit berbeda */
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .modal-header-custom .close-button {
        background: none;
        border: none;
        font-size: 28px;
        /* Ukuran ikon tutup lebih besar */
        cursor: pointer;
        color: #888;
        /* Warna abu-abu yang lebih lembut */
        transition: color 0.2s ease-in-out;
        padding: 0;
        /* Hapus padding default */
        line-height: 1;
        /* Pastikan ikon tidak terpotong */
    }

    .modal-header-custom .close-button:hover {
        color: #333;
        /* Perubahan warna saat hover */
    }

    .modal-title-custom {
        font-size: 24px;
        /* Ukuran judul lebih besar */
        font-weight: 700;
        /* Lebih tebal */
        color: #333;
        margin-bottom: 0;
        /* Hapus margin bawah */
    }

    .modal-body-custom {
        padding: 25px;
        /* Padding lebih besar */
        text-align: left;
    }

    .modal-body-custom textarea {
        width: 100%;
        min-height: 150px;
        /* Tinggi textarea lebih besar */
        padding: 15px;
        /* Padding textarea lebih besar */
        border: 1px solid #c0c0c0;
        /* Border lebih jelas */
        border-radius: 10px;
        /* Radius lebih lembut */
        font-size: 16px;
        /* Ukuran font lebih besar */
        resize: vertical;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08);
        /* Bayangan dalam untuk efek input */
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .modal-body-custom textarea:focus {
        border-color: #1758B9;
        /* Warna border saat fokus */
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08), 0 0 0 3px rgba(23, 88, 185, 0.2);
        /* Efek fokus */
        outline: none;
        /* Hapus outline default browser */
    }

    .modal-footer-custom {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        /* Jarak antar tombol lebih besar */
        padding: 20px 25px;
        /* Padding lebih besar */
        border-top: 1px solid #e0e0e0;
        /* Garis pemisah yang lebih halus */
        background-color: #f8f8f8;
        /* Latar belakang footer yang sedikit berbeda */
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .btn-primary-custom,
    .btn-secondary-custom {
        padding: 12px 25px;
        /* Padding tombol lebih besar */
        font-size: 16px;
        /* Ukuran font tombol lebih besar */
        border-radius: 8px;
        /* Radius tombol lebih lembut */
        font-weight: 600;
        text-transform: uppercase;
        /* Teks uppercase */
        letter-spacing: 0.5px;
        /* Jarak antar huruf */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Bayangan tombol */
        transition: all 0.3s ease-in-out;
        /* Transisi yang lebih halus */
    }

    .btn-primary-custom {
        background-color: #1e293b;
        color: #fff;
    }

    .btn-primary-custom:hover {
        background-color: #1e293b;
        transform: translateY(-2px);
        /* Efek angkat saat hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary-custom {
        background-color: #EB2027;
        color: #fff;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Detail Monitoring</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('monitoring.index') }}">Monitoring</a></div>
                <div class="breadcrumb-item">Detail Monitoring</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th class="text-center align-middle">Presentasi</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailmonitoring as $key => $item)
                        <tr>
                            <td class="align-middle">{{ $key + 1 }}</td>
                            <td class="align-middle">{{ $item->deskripsi}}</td>
                            <td class="text-center align-middle">{{ $item->persentasi ?? '-' }}%</td>
                            <td class="text-center align-middle">
                                @if($item->status == 'proses')
                                    <span class="badge bg-warning text-dark">{{$item->status}}</span>
                                @elseif($item->status == 'diterima')
                                    <span class="badge bg-success text-white">{{$item->status}}</span>
                                @elseif($item->status == 'revisi')
                                    <span class="badge bg-danger text-white">{{$item->status}}</span>

                                @endif

                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" aria-label="Tampilkan opsi aksi untuk {{ $item->nama }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item terima-btn" href="#" data-id="{{ $item->id }}" data-nama="{{ $item->deskripsi }}">
                                            <i class="fas fa-check"></i> Diterima
                                        </a>
                                        <a class="dropdown-item tolak-btn" href="#"
                                            data-detail-id="{{ $item->id }}" data-detail-catatan="{{ $item->revisi }}">
                                            <i class="fas fa-times"></i> Revisi
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

<div class="modal fade" id="revisiModal" tabindex="-1" aria-labelledby="revisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <h5 class="modal-title-custom" id="revisiModalLabel">Catatan Revisi</h5>
                <button type="button" class="close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body-custom">
                <form id="formRevisi">
                    <input type="hidden" id="revisiDetailId" name="detail_id">
                    <div class="mb-3">
                        <textarea class="form-control" id="catatanRevisi" name="catatan_revisi" rows="5" placeholder="1. Jelaskan revisi secara jelas dan spesifik.&#10;2. Tulis revisi dalam bentuk poin-poin terpisah.&#10;3. Lakukan review ulang pastikan tidak ada kesalahan dalam penulisan"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary-custom" id="simpanRevisiBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="terimaModalLabel">Terima Project?</h5>
            <div class="modal-body modal-message-custom">
                <input type="hidden" id="terimaId" name="terimaid">
                Apakah Anda yakin ingin menerima Detail project <label id="namadetail"></label> ini?
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-primary-custom" id="confirmTerimaBtn">Terima</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan semua tombol revisi di dropdown
        const revisiLinks = document.querySelectorAll('.tolak-btn');

        // Mendapatkan elemen modal dan input
        const revisiModalElement = $('#revisiModal'); // Menggunakan jQuery untuk modal Bootstrap 4
        const revisiDetailIdInput = document.getElementById('revisiDetailId'); // Mengubah ID input
        const catatanRevisiTextarea = document.getElementById('catatanRevisi');
        const simpanRevisiBtn = document.getElementById('simpanRevisiBtn');
        const simpanTerimaBtn = document.getElementById('confirmTerimaBtn');

        revisiLinks.forEach(link => {
            link.addEventListener('click', function() {
                const detailId = this.dataset.detailId;
                revisiDetailIdInput.value = detailId;
                catatanRevisiTextarea.value = this.dataset.detailCatatan; // Kosongkan textarea setiap kali modal dibuka
                revisiModalElement.modal('show'); // Tampilkan modal menggunakan jQuery
            });
        });

        const terimaLinks = document.querySelectorAll('.terima-btn');
        terimaLinks.forEach(link => {
            link.addEventListener('click', function() {
                console.log(this.dataset.nama);
                const modal = $('#terimaModal');
                const detailId = this.dataset.id;
                document.getElementById('terimaId').value = detailId;
                document.getElementById('namadetail').value = this.dataset.nama;
                modal.modal('show');
            });
        });

        simpanRevisiBtn.addEventListener('click', function() {
            const detailId = revisiDetailIdInput.value;
            const catatanRevisi = catatanRevisiTextarea.value;

            // Di sini Anda akan mengirim data catatan revisi ke backend
            // Anda bisa menggunakan Fetch API atau Axios untuk mengirim data
            console.log('Mengirim catatan revisi untuk Detail ID:', detailId);
            console.log('Catatan Revisi:', catatanRevisi);

            // Contoh penggunaan Fetch API (Anda perlu menyesuaikan URL dan method)

            fetch('/detailproject', { // Sesuaikan URL API Anda
                method: 'POST', // Atau PUT, tergantung API Anda
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    detail_id: detailId,
                    catatan_revisi: catatanRevisi,
                    jenis: 'revisi'
                })
            })
            .then(response => response.json())
            .then(data => {
                revisiModalElement.modal('hide');
                alert('Catatan revisi berhasil disimpan (simulasi)!');
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
                // Tampilkan pesan error kepada pengguna
            });



        });

        simpanTerimaBtn.addEventListener('click', function() {
            const detailId = document.getElementById('terimaId').value;

            // Di sini Anda akan mengirim data catatan revisi ke backend
            // Anda bisa menggunakan Fetch API atau Axios untuk mengirim data
            console.log('Mengirim catatan revisi untuk Detail ID:', detailId);
            console.log('Catatan Revisi:', catatanRevisi);

            // Contoh penggunaan Fetch API (Anda perlu menyesuaikan URL dan method)

            fetch('/detailproject', { // Sesuaikan URL API Anda
                method: 'POST', // Atau PUT, tergantung API Anda
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    detail_id: detailId,
                    jenis: 'terima'
                })
            })
            .then(response => response.json())
            .then(data => {
                revisiModalElement.modal('hide');
                alert('Project berhasil diterima!');
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
                // Tampilkan pesan error kepada pengguna
            });



        });
    });
</script>
@endpush
