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
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Template Sertifikat Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Template Sertifikat Penilaian</div>
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
                        <a class="aksi-item" href="{{ route('templatesertifikat.download', $template->id) }}">
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
                    <img src="{{ asset('path/ke/gambar/template.png') }}" alt="Pratinjau Template Sertifikat">
                    {{-- Ganti 'path/ke/gambar/template.png' dengan path gambar template Anda --}}
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
                <form id="ubahTemplateForm" action="{{ route('templatesertifikat.update', isset($template) ? $template->id : '') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="template_file" name="template_file" accept=".docx">
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
                            <code>{#personal}{evaluation_name}</code> dan diakhiri dengan <code>{value}{/personal}</code><br>
                            <code>{#competence}{evaluation_name}</code> dan diakhiri dengan <code>{value}{/competence}</code><br>
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
</script>
@endpush