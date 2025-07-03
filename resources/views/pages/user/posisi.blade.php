@extends('components.user.header2')

@section('title', 'posisi')
<link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />
{{-- Pastikan Anda juga mengimpor Bootstrap CSS dan JS jika belum di header2 --}}
{{-- Contoh: --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Jika ada style spesifik yang hanya untuk halaman ini, letakkan di sini */
    .magang-card {
        margin-bottom: 20px;
    }

    .container-p {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
        margin-top: 10px;
    }

    /* Styling untuk judul dan peringatan */
    .page-header {
        text-align: center;
        margin-top: 50px;
        /* Jarak dari header atas */
        margin-bottom: 80px;
        /* Jarak ke konten bawah */
    }

    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        color: #343a40;
        margin-top: 120px;
        margin-bottom: 20px;
    }

    .alert-warning-custom {
        background-color: #fff3cd;
        border-color: #ffecb5;
        color: #856404;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.05rem;
        max-width: 600px;
        /* Batasi lebar peringatan */
        margin: 0 auto;
        /* Tengah secara horizontal */
        display: flex;
        align-items: center;
        justify-content: center;
        /* Tengah konten */
        gap: 10px;
        /* Jarak antara ikon dan teks */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        /* Sedikit bayangan */
    }

    .alert-warning-custom i {
        font-size: 1.5rem;
        /* Ukuran ikon */
    }


    /* Modal Custom Styles to match the image */
    .modal-content-custom {
        border-radius: 15px;
        overflow: hidden;
        /* Ensure rounded corners for child elements */
    }

    .modal-header-custom {
        border-bottom: none !important;
        /* Menghapus garis bawah */
        padding: 1rem 1.5rem;
        position: relative;
    }

    .modal-header-custom .btn-close {
        position: absolute;
        top: 20px;
        right: 25px;
        z-index: 10;
        /* Custom close button color/style if needed */
    }

    .modal-body-custom {
        display: flex;
        flex-direction: column;
        padding: 0;
        /* Remove default padding */
    }

    .modal-body-content {
        display: flex;
        flex-direction: column;
        padding: 0 2rem 2rem 2rem;
        /* Adjusted padding */
    }

    @media (min-width: 768px) {
        .modal-body-content {
            flex-direction: row;
            padding: 0 2rem 2rem 2rem;
            /* Adjusted padding for larger screens */
        }
    }

    .modal-body-content .left-section {
        flex: 1;
        text-align: center;
        padding-right: 0;
        /* No padding-right by default */
    }

    @media (min-width: 768px) {
        .modal-body-content .left-section {
            padding-right: 30px;
            /* Add padding-right on larger screens */
        }
    }

    .modal-body-content .left-section h2 {
        font-size: 2.2em;
        /* Larger title */
        font-weight: bold;
        margin-bottom: 5px;
        color: #343a40;
    }

    .modal-body-content .left-section .kuota-info {
        font-size: 1.1em;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .modal-body-content .left-section img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 20px;
        /* Space between kuota and image */
    }

    .modal-body-content .right-section {
        flex: 2;
        /* Take more space */
        padding-top: 20px;
        /* Space from top on mobile */
    }

    @media (min-width: 768px) {
        .modal-body-content .right-section {
            padding-top: 0;
            /* No padding-top on larger screens */
        }
    }


    .modal-body-content .right-section h4 {
        color: #dc3545;
        /* Red color for section titles */
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.5em;
    }

    .modal-body-content .right-section p {
        font-size: 0.95em;
        line-height: 1.6;
        color: #495057;
        margin-bottom: 20px;
    }

    .modal-body-content .right-section h5 {
        color: #343a40;
        margin-top: 25px;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 1.2em;
    }

    .modal-body-content .right-section ul {
        list-style: none;
        padding-left: 0;
    }

    .modal-body-content .right-section ul li {
        margin-bottom: 8px;
        color: #6c757d;
        position: relative;
        padding-left: 20px;
        /* Space for bullet point */
    }

    .modal-body-content .right-section ul li::before {
        content: '\2022';
        /* Unicode for bullet point */
        color: #dc3545;
        /* Red bullet point */
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    /* Tahapan Seleksi Section */
    .stages-section-modal {
        background-color: #f8f9fa;
        /* Light grey background */
        padding: 30px 20px;
        border-top: 1px solid #e9ecef;
        text-align: center;
    }

    .stages-section-modal h4 {
        color: #dc3545;
        /* Red color */
        font-weight: bold;
        margin-bottom: 30px;
        font-size: 1.8em;
    }

    .stage-flow {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        /* Allow wrapping on small screens */
        gap: 15px;
        /* Gap between items */
    }

    .stage-item-modal {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
        /* Prevent shrinking */
        min-width: 100px;
        /* Minimum width for each stage item */
    }

    .stage-item-modal .number {
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 50px;
        /* Larger circle */
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 1.5em;
        /* Larger number */
        margin-bottom: 10px;
    }

    .stage-item-modal .text {
        color: #343a40;
        font-size: 0.9em;
        font-weight: 500;
        white-space: nowrap;
        /* Prevent text wrapping */
    }

    .arrow-modal {
        font-size: 2.5em;
        /* Larger arrow */
        color: #6c757d;
        margin: 0 10px;
        /* Space around arrow */
    }

    @media (max-width: 767.98px) {
        .arrow-modal {
            display: none;
            /* Hide arrows on small screens */
        }

        .stage-flow {
            flex-direction: column;
            /* Stack stages vertically on small screens */
            gap: 20px;
        }
    }

    /* ************************************** */
    /* NEW STYLES FOR MODERN CONFIRMATION MODAL */
    /* ************************************** */
    #confirmAjukanModal .modal-dialog {
        max-width: 420px;
        /* Slightly wider */
    }

    #confirmAjukanModal .modal-content {
        border-radius: 15px;
        /* Rounded corners */
        padding: 30px 20px;
        /* More padding */
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
        border: none;
        background-color: #fff;
    }

    #confirmAjukanModal .modal-header {
        border-bottom: none;
        padding: 0;
        display: block;
        /* Make it a block for icon and title alignment */
        margin-bottom: 20px;
        position: relative;
    }

    #confirmAjukanModal .modal-header .btn-close {
        /* *** PERBAIKAN DI SINI *** */
        position: absolute;
        top: 2px;
        /* Sesuaikan posisi dari atas */
        right: 2px;
        /* Sesuaikan posisi dari kanan agar di dalam */
        font-size: 1.2rem;
        color: #888;
        background-color: #f0f0f0;
        border-radius: 50%;
        padding: 5px;
        opacity: 0.8;
        transition: opacity 0.2s ease;
        z-index: 10;
        /* Pastikan di atas elemen lain */
    }

    #confirmAjukanModal .modal-header .btn-close:hover {
        opacity: 1;
        background-color: #e0e0e0;
    }

    #confirmAjukanModal .modal-header .modal-title {
        font-weight: 700;
        color: #343a40;
        font-size: 1.8rem;
        /* Larger title */
        margin-top: 15px;
        /* Space for icon */
    }

    #confirmAjukanModal .modal-body {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 30px;
        line-height: 1.6;
        padding: 0 10px;
        /* Add horizontal padding */
    }

    /* Icon for confirmation modal */
    .modal-icon {
        font-size: 3.5rem;
        color: #dc3545;
        /* Your primary red color */
        margin-bottom: 15px;
        display: block;
        text-align: center;
    }

    #confirmAjukanModal .modal-footer {
        border-top: none;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    #confirmAjukanModal .btn-group {
        width: 100%;
        max-width: 300px;
        /* Max width for buttons */
        display: flex;
        gap: 12px;
    }

    #confirmAjukanModal .btn {
        flex: 1;
        padding: 12px 15px;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.2s ease-in-out;
        font-size: 1rem;
    }

    #confirmAjukanModal .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    #confirmAjukanModal .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        transform: translateY(-2px);
    }

    #confirmAjukanModal .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    #confirmAjukanModal .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-2px);
    }

    .btn-color {
        background: #dc3545 !important;
        color: #fff !important;
    }

    .btn-color:hover {
        background: #c82333 !important;
        color: #fff !important;
    }
</style>


@section('content')
{{-- Bagian Judul dan Peringatan --}}
<div class="container page-header">
    <h1>Posisi Magang</h1>
    <div class="alert-warning-custom">
        <i class="bi bi-exclamation-triangle-fill"></i>
        Anda hanya bisa mendaftar 1 kali untuk posisi magang. Pastikan pilihan Anda sudah tepat!
    </div>
</div>

<section class="container-p">
    {{-- Loop untuk menampilkan setiap posisi dari data yang diambil dari database --}}
    @foreach ($user as $posisi) {{-- Menggunakan $user karena di controller index() Anda menggunakan compact('user') --}}
    <div class="magang-card">
        <div class="card-body">
            <h5 class="card-title">
                {{ $posisi->nama }}
                <span class="kuota">Kuota: {{ $posisi->kuota_tersedia }}</span>
            </h5>
            <p class="card-text">
                {{ Str::limit($posisi->deskripsi, 150) }}
            </p>
            <div class="btn-wrapper">
                {{-- Tombol untuk menampilkan modal dengan data dinamis dari database --}}
                <a href="#" class="lihat-link" data-bs-toggle="modal" data-bs-target="#detailPosisiModal"
                    data-nama="{{ $posisi->nama }}"
                    data-kuota="{{ $posisi->kuota_tersedia }}"
                    data-deskripsi="{{ $posisi->deskripsi }}"
                    data-persyaratan="{{ $posisi->persyaratan }}"
                    data-tahapan="{{ $posisi->tahapan_seleksi }}"> {{-- Pastikan kolom tahapan_seleksi ada di tabel `posisi` Anda --}}
                    Lihat Selengkapnya
                </a>
                <button class="btn-ajukan" disabled>Ajukan</button>
            </div>
        </div>
    </div>
    @endforeach
</section>

{{-- MODAL DINAMIS UNTUK SEMUA POSISI --}}
<div class="modal fade" id="detailPosisiModal" tabindex="-1" aria-labelledby="detailPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-custom">
                <div class="modal-body-content">
                    <div class="left-section">
                        <h2 id="modalPosisiTitle"></h2>
                        <p class="kuota-info" id="modalPosisiKuota"></p>
                        <img src="{{ asset('user/assets/icons/posisi.png') }}" alt="Ilustrasi Posisi">
                    </div>
                    <div class="right-section">
                        <h4>Gambaran Pekerjaan :</h4>
                        <p id="modalPosisiDeskripsi"></p>
                        <h5>Persyaratan:</h5>
                        <ul id="modalPosisiPersyaratan">
                            {{-- Persyaratan akan diisi oleh JavaScript --}}
                        </ul>
                    </div>
                </div>

                <div class="stages-section-modal">
                    <h4>Tahapan Seleksi</h4>
                    <div class="stage-flow">
                        <div class="stage-item-modal">
                            <div class="number">1</div>
                            <div class="text">Seleksi Administrasi</div>
                        </div>
                        <div class="arrow-modal">→</div>
                        <div class="stage-item-modal">
                            <div class="number">2</div>
                            <div class="text">Seleksi Kemampuan</div>
                        </div>
                        <div class="arrow-modal">→</div>
                        <div class="stage-item-modal">
                            <div class="number">3</div>
                            <div class="text">Wawancara</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailPosisiModal = document.getElementById('detailPosisiModal');
        detailPosisiModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-bs-* attributes
            const nama = button.getAttribute('data-nama');
            const kuota = button.getAttribute('data-kuota');
            const deskripsi = button.getAttribute('data-deskripsi');
            const persyaratan = button.getAttribute('data-persyaratan');
            const tahapan = button.getAttribute('data-tahapan');

            // Update the modal's content
            const modalTitle = detailPosisiModal.querySelector('#modalPosisiTitle');
            const modalKuota = detailPosisiModal.querySelector('#modalPosisiKuota');
            const modalDeskripsi = detailPosisiModal.querySelector('#modalPosisiDeskripsi');
            const modalPersyaratan = detailPosisiModal.querySelector('#modalPosisiPersyaratan');
            const modalTahapanSeleksi = detailPosisiModal.querySelector('#modalTahapanSeleksi');

            modalTitle.textContent = nama;
            modalKuota.textContent = `Kuota Tersedia: ${kuota}`;
            modalDeskripsi.textContent = deskripsi;

            // Clear previous list items
            modalPersyaratan.innerHTML = '';
            // Split persyaratan by new line and create list items
            if (persyaratan) {
                persyaratan.split('\n').forEach(item => {
                    if (item.trim() !== '') {
                        const li = document.createElement('li');
                        li.textContent = item.trim();
                        modalPersyaratan.appendChild(li);
                    }
                });
            }

            // Clear previous stage items
            modalTahapanSeleksi.innerHTML = '';
            // Split tahapan_seleksi by new line and create stage items
            if (tahapan) {
                const tahapanArray = tahapan.split('\n').filter(item => item.trim() !== '');
                tahapanArray.forEach((item, index) => {
                    const stageItem = document.createElement('div');
                    stageItem.classList.add('stage-item-modal');
                    stageItem.innerHTML = `<div class="number">${index + 1}</div><div class="text">${item.trim()}</div>`;
                    modalTahapanSeleksi.appendChild(stageItem);

                    // Add arrow if it's not the last item
                    if (index < tahapanArray.length - 1) {
                        const arrow = document.createElement('div');
                        arrow.classList.add('arrow-modal');
                        arrow.textContent = '→';
                        modalTahapanSeleksi.appendChild(arrow);
                    }
                });
            }
        });
    });
</script>


@include('components.user.footer')
@endsection