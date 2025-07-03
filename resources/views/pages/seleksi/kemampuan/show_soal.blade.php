@extends('layouts.app')

@section('title', 'Detail Soal Kemampuan')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<style>
    /* Gaya CSS yang sama dengan show_soal.blade.php bisa ditempatkan di sini atau di file CSS terpisah */
    .section-title {
        color: #3c4b64;
        font-weight: bold;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 1.25rem 1.5rem;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-header h4 {
        margin-bottom: 0;
        font-size: 1.25rem;
        color: #343a40;
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Styles for editable inputs */
    .form-control-editable {
        background-color: #ffffff;
        /* Warna latar belakang putih untuk input yang bisa diedit */
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        width: 100%;
        box-sizing: border-box;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    textarea.form-control-editable {
        min-height: 150px;
        resize: vertical;
    }

    /* Styles for readonly inputs */
    .form-control-plaintext {
        background-color: #f1f5f9;
        /* Warna latar belakang abu-abu untuk input readonly */
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        width: 100%;
        box-sizing: border-box;
        min-height: calc(1.5em + 1.5rem + 2px);
    }

    textarea.form-control-plaintext {
        min-height: 150px;
        resize: vertical;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-back:hover {
        background-color: #5a6268;
        color: #5a6268;
        /* Diubah kembali ke putih */
    }

    .btn-edit {
        background-color: #007bff;
        /* Warna biru Bootstrap primary */
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-edit:hover {
        background-color: #0056b3;
        /* Warna biru yang lebih gelap saat hover */
        color: #0056b3;
        /* Diubah kembali ke putih */
    }

    .btn-save {
        background-color: #28a745;
        /* Warna hijau Bootstrap success */
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-save:hover {
        background-color: #218838;
        color: #218838;
        /* Diubah kembali ke putih */
    }

    .btn-cancel {
        background-color: #dc3545;
        /* Warna merah Bootstrap danger */
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-cancel:hover {
        background-color: #c82333;
        color: #c82333;
        /* Diubah kembali ke putih */
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        /* Posisikan tombol ke kanan */
        gap: 10px;
        /* Jarak antar tombol */
        margin-top: 20px;
        /* Jarak dari form ke tombol */
    }

    /* Hide elements by default */
    .hidden {
        display: none !important;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Detail Soal Kemampuan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kemampuan.index') }}">Kemampuan</a></div>
                <div class="breadcrumb-item">Detail Soal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Soal</h4>
                </div>
                <div class="card-body">
                    <form id="soalForm" action="{{ route('kemampuan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control-plaintext" id="deskripsi" name="deskripsi" readonly>{{ $soal->deskripsi ?? 'Tidak ada deskripsi' }}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <div class="form-group">
                            <label for="tanggal_awal_seleksi">Tanggal Awal Seleksi</label>
                            <input type="date" class="form-control-plaintext" id="tanggal_awal_seleksi" name="tanggal_awal_seleksi"
                                value="{{ \Carbon\Carbon::parse(@$soal->tanggal_mulai)->format('Y-m-d') ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir_seleksi">Tanggal Akhir Seleksi</label>
                            <input type="date" class="form-control-plaintext" id="tanggal_akhir_seleksi" name="tanggal_akhir_seleksi"
                                value="{{ \Carbon\Carbon::parse(@$soal->tanggal_selesai)->format('Y-m-d') ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="soal_text">Soal</label>
                            <textarea class="form-control-plaintext" id="soal_text" name="soal" readonly>{{ $soal->soal ?? 'Tidak ada soal' }}</textarea>
                        </div>

                        <div class="button-group" id="viewModeButtons">
                            <a href="{{ route('kemampuan.index') }}" class="btn btn-back">Kembali ke Daftar</a>
                            <button type="button" class="btn btn-edit" id="editButton">Edit Soal</button>
                        </div>

                        <div class="button-group hidden" id="editModeButtons">
                            <button type="button" class="btn btn-cancel" id="cancelButton">Batal</button>
                            <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
    $(document).ready(function() {
        const form = $('#soalForm');
        const inputs = form.find('textarea, input[type="date"]');
        const viewModeButtons = $('#viewModeButtons');
        const editModeButtons = $('#editModeButtons');
        const editButton = $('#editButton');
        const cancelButton = $('#cancelButton');

        // Store initial values to revert on cancel
        const initialValues = {};
        inputs.each(function() {
            initialValues[this.id] = $(this).val();
        });

        function toggleEditMode(isEdit) {
            inputs.each(function() {
                if (isEdit) {
                    $(this).removeAttr('readonly');
                    $(this).removeClass('form-control-plaintext').addClass('form-control-editable');
                } else {
                    $(this).attr('readonly', 'readonly');
                    $(this).removeClass('form-control-editable').addClass('form-control-plaintext');
                    // Revert to initial values on cancel
                    $(this).val(initialValues[this.id]);
                }
            });

            if (isEdit) {
                viewModeButtons.addClass('hidden');
                editModeButtons.removeClass('hidden');
            } else {
                viewModeButtons.removeClass('hidden');
                editModeButtons.addClass('hidden');
            }
        }

        editButton.on('click', function() {
            toggleEditMode(true);
        });

        cancelButton.on('click', function() {
            toggleEditMode(false);
        });
    });
</script>
@endpush