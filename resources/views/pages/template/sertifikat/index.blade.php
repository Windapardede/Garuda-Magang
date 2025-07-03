@extends('layouts.app')

@section('title', 'Template Sertifikat')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
@push('style')
<style>
    .template-container {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .template-preview {
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 20px;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .template-preview img {
        max-width: 100%;
        height: auto;
    }

    .action-bar {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
    }

    .aksi-container {
        position: relative;
        display: inline-block;
    }

    .aksi-button {
        padding: 8px 20px;
        border: none;
        border-radius: 6px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .aksi-button:hover {
        background-color: #0056b3;
    }

    .aksi-menu {
        position: absolute;
        top: calc(100% + 5px);
        right: 0;
        background-color: #ffffff !important;
        border: none;
        border-radius: 12px !important;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        padding: 10px 0 !important;
        margin-top: 0;
        min-width: 150px;
        z-index: 1000;
        display: none;
        transform-origin: top right;
        animation: growDown 300ms ease-in-out forwards;
    }

    .aksi-menu.show {
        display: block;
    }

    .aksi-item {
        color: #334155 !important;
        font-weight: 500 !important;
        padding: 10px 20px !important;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        clear: both;
        text-align: left;
        white-space: nowrap;
        background-color: transparent;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .aksi-item:hover,
    .aksi-item:focus {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
    }

    .aksi-divider {
        height: 1px;
        margin: 0.5rem 0;
        overflow: hidden;
        background-color: #e9ecef;
    }

    .aksi-message {
        padding: 0.75rem 1.25rem;
        font-size: 0.875rem;
        color: #6c757d;
    }

    @keyframes growDown {
        0% {
            transform: scaleY(0);
        }

        80% {
            transform: scaleY(1.1);
        }

        100% {
            transform: scaleY(1);
        }
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 10px;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    .modal-backdrop.fade {
        opacity: 0 !important;
    }
</style>

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

<!-- Loading Spinner -->
<div id="loading-spinner" style="
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(255, 255, 255, 0.7);
    z-index: 9999;
">
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    ">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>



<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Template Sertifikat</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Template Sertifikat</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="action-bar">
                <div class="aksi-container">
                    <button class="btn btn-primary" type="button" id="aksiButton" aria-haspopup="true" aria-expanded="false">
                        <i class="mr-0.5"></i> Aksi
                    </button>
                    <div class="aksi-menu" aria-labelledby="aksiButton">
                        <a class="aksi-item" href="#" data-toggle="modal" data-target="#ubahTemplateModal">
                            <i class="bi bi-pencil mr-2"></i> Ubah
                        </a>
                        <a class="aksi-item" href="#" data-toggle="modal" data-target="#formatTemplateModal">
                            <i class="bi bi-layout-text-window-reverse mr-2"></i> Format Template
                        </a>
                        @if(isset($template))
                        <a class="aksi-item" href="{{ asset('file?page='.$template->file) ?? asset('#')}}">
                            <i class="bi bi-download mr-2"></i> Template
                        </a>
                        @else
                        <a class="aksi-item disabled" href="#" style="pointer-events: none; color: #6c757d;">
                            <i class="bi bi-download mr-2"></i> Template
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="template-container">
                @if(isset($template))
                <div class="template-preview">
                    <img src="{{ asset('img/gb-template.png') }}" alt="Pratinjau Template Sertifikat">

                </div>

                <div class="mt-3 text-right">
                    {{-- Tombol Aksi yang lama sudah benar --}}
                </div>
                @else
                <p>Belum ada template sertifikat. Silakan tambahkan template baru.</p>
                @endif
            </div>
    </section>
</div>

<div class="modal fade" id="ubahTemplateModal" tabindex="-1" role="dialog" aria-labelledby="ubahTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahTemplateModalLabel">Ubah Template Sertifikat:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubahTemplateForm" action="{{ route('templatesertifikat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="template_file" name="template_file" accept=".docx" required>
                            <label class="custom-file-label" for="template_file">Choose File</label>
                        </div>
                        <small class="form-text text-muted">Hanya file .docx yang diterima</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="ubahTemplateForm">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formatTemplateModal" tabindex="-1" role="dialog" aria-labelledby="formatTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formatTemplateModalLabel">Format Template Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Contoh Template:</strong></p>
                        <img src="{{ asset('path/ke/gambar/contoh_format_template.png') }}" alt="Contoh Format Template" class="img-fluid">
                        <small class="form-text text-muted">Pastikan template Anda mengikuti format ini.</small>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Persyaratan:</strong></p>
                        <ul>
                            <li>Pastikan di dalam sertifikat terdapat placeholder.</li>
                            <li><code>#\{personal\}\{evaluation_name\}</code> dan diakhiri dengan <code>\{value\}\{/personal\}</code></li>
                            <li><code>#\{competence\}\{evaluation_name\}</code> dan diakhiri dengan <code>\{value\}\{/competence\}</code></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                Template Berhasil Diperbaiki
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#aksiButton').on('click', function() {
            $('.aksi-menu').toggleClass('show');
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('.aksi-container').length) {
                $('.aksi-menu').removeClass('show');
            }
        });

        // Event listener untuk menampilkan modal ubah template tanpa backdrop
        $('.aksi-item[href*="templatesertifikat.edit"]').on('click', function(e) {
            e.preventDefault();
            $('#ubahTemplateModal').modal({
                backdrop: false
            });
            $('#ubahTemplateModal').modal('show');
        });

        // Event listener untuk menampilkan modal format template tanpa backdrop
        $('.aksi-item:contains("Format Template")').on('click', function(e) {
            e.preventDefault();
            $('#formatTemplateModal').modal({
                backdrop: false
            });
            $('#formatTemplateModal').modal('show');
        });

        // Script untuk menampilkan nama file yang dipilih pada input file kustom
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });

    $('#ubahTemplateModal form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this)[0]; // ambil DOM asli
        var url = $(this).attr('action');
        var formData = new FormData(form);

        $('#loading-spinner').fadeIn();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#ubahTemplateModal').modal('hide');
                $('#successAddPosisiModal').modal('show');
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat memperbarui posisi: ' + xhr.responseText);
            },
            complete: function() {
                // Sembunyikan loading spinner
                $('#loading-spinner').fadeOut();
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
</script>
@endpush
