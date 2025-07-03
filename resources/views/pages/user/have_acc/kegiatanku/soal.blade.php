@extends('components.user.header1')

@section('title', 'Soal Tes Kemampuan')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/custom-user.css') }}">
<style>
    .modal-backdrop.fade.show {
        opacity: 0.5;
    }

    .modern-modal .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .modern-modal .modal-header {
        background-color: #f8f9fa;
        border-bottom: none;
        padding: 20px 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .modern-modal .modal-header .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
        margin-top: 10px;
    }

    .modern-modal .modal-body {
        padding: 25px;
        text-align: center;
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.6;
    }

    .modern-modal .modal-footer {
        border-top: none;
        padding: 20px 25px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .modern-modal .btn {
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .modern-modal .btn-cancel {
        background-color: #6c757d;
        color: #fff;
    }

    .modern-modal .btn-cancel:hover {
        background-color: #5a6268;
        color: #fff;
    }

    .modern-modal .btn-confirm {
        background-color: #dc3545;
        color: #fff;
    }

    .modern-modal .btn-confirm:hover {
        background-color: #c82333;
        color: #fff;
    }

    .modern-modal .modal-icon {
        font-size: 3.5rem;
        color: #dc3545;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<?php
// $soal = (object) [
//     'id' => 1,
//     'deskripsi' => 'Anda diminta untuk menganalisis studi kasus ini dan memberikan solusi inovatif. Jawaban harus mencakup analisis masalah, alternatif solusi, rekomendasi, dan rencana implementasi.',
//     'tanggal_awal_tes_kemampuan' => '2025-05-20 09:00:00',
//     'tanggal_akhir_tes_kemampuan' => '2025-05-27 17:00:00',
//     'soal' => "Studi Kasus:\n\nSebuah perusahaan startup 'FutureTech' bergerak di bidang pengembangan aplikasi mobile AI. Mereka baru saja meluncurkan produk beta mereka yang bertujuan untuk membantu UMKM mengelola inventaris dan penjualan secara otomatis.\n\nDalam 3 bulan terakhir, FutureTech menghadapi beberapa tantangan:\n1.  <strong>Tingkat adopsi rendah:</strong> Hanya 10% dari UMKM yang mendaftar benar-benar aktif menggunakan aplikasi.\n2.  <strong>Umpan balik negatif:</strong> Banyak pengguna mengeluhkan antarmuka yang rumit dan fitur yang tidak intuitif.\n3.  <strong>Persaingan ketat:</strong> Munculnya kompetitor baru dengan produk serupa yang lebih murah dan user-friendly.\n\nTugas Anda:\n\nSebagai konsultan eksternal, berikan analisis komprehensif mengenai akar masalah yang dihadapi FutureTech. Kemudian, usulkan strategi inovatif yang mencakup:\n\na.  <strong>Peningkatan Produk:</strong> Bagaimana meningkatkan UX/UI dan menambahkan fitur yang lebih relevan?\nB.  <strong>Strategi Pemasaran:</strong> Bagaimana menarik lebih banyak UMKM dan meningkatkan tingkat adopsi?\nC.  <strong>Model Bisnis:</strong> Pertimbangkan apakah model bisnis saat ini (freemium) sudah optimal atau perlu perubahan.\n\nSertakan juga proyeksi dampak dari strategi yang Anda usulkan dalam 6 bulan ke depan (misalnya, peningkatan adopsi, kepuasan pengguna).",
// ];
?>

<div class="section-body">
    <div class="card">
        @include('layouts.alert-noicon')
        <div class="card-header">
            <h4>Soal Tes Kemampuan</h4>
        </div>
        <div class="card-body">
            @if(isset($soal))
            <div class="form-group">
                <label for="deskripsi">Deskripsi Soal</label>
                <div class="content-display" id="deskripsi">
                    {!! nl2br(e($soal->deskripsi ?? 'Tidak ada deskripsi soal.')) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan Tes</label>
                <div class="content-display" id="tanggal_pelaksanaan">
                    {{ date('d/m/Y', strtotime($soal->tanggal_mulai)) }} s/d {{ date('d/m/Y', strtotime($soal->tanggal_selesai)) }}
                </div>
            </div>

            <div class="form-group">
                <label for="soal_text">Soal</label>
                <div class="content-display soal-text" id="soal_text">
                    {!! Str::markdown($soal->soal ?? 'Soal tidak tersedia.') !!}
                </div>
            </div>

            <hr>

            <h4>Unggah dan Kirim Jawaban Anda (Format PDF)</h4>
            <form id="uploadForm" action="{{ route('user.kegiatanku.upload_jawaban') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="soal_id" value="{{ $soal->id }}">

                <div class="form-group">
                    <label for="file_jawaban">File Jawaban</label>
                    <div class="custom-file-upload @error('file_jawaban') is-invalid @enderror">
                        <input type="file" class="custom-file-input" id="file_jawaban" name="file_jawaban" accept=".pdf">
                        <span class="custom-file-label" id="file-name">Pilih File PDF</span>
                    </div>
                    @error('file_jawaban')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <small class="form-text text-muted">Unggah jawaban Anda dalam format <strong>PDF</strong> dengan ukuran maksimal 5MB.</small>
                    @if(isset($kemampuan->jawaban_tes_kemampuan))
                    <small>File saat ini: <a href="{{ asset('file?page='.$kemampuan->jawaban_tes_kemampuan) ?? asset('#')}}" target="_blank">{{ $kemampuan->jawaban_tes_kemampuan }}</a></small>
                    @endif
                </div>

                <div class="d-flex justify-content-end mt-2">
                    <button type="button" id="submitButton" class="btn btn-danger">
                        <i class="bi bi-send"></i> Kirim Jawaban
                    </button>
                </div>
            </form>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle-fill me-2"></i> Belum ada soal tes kemampuan yang tersedia saat ini.
            </div>
            @endif
        </div>
    </div>
</div>
</section>
</div>

<div class="modal fade modern-modal" id="konfirmasiKirimModal" tabindex="-1" aria-labelledby="konfirmasiKirimModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="bi bi-exclamation-triangle-fill modal-icon"></i>
                <h5 class="modal-title" id="konfirmasiKirimModalLabel">Konfirmasi Pengiriman Jawaban</h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda <strong>yakin</strong> ingin mengirimkan jawaban ini?</p>
                <p>Pastikan Anda telah memeriksa kembali jawaban Anda dengan teliti.</p>
                <p class="text-danger"><small>Jawaban yang sudah dikirim tidak dapat diubah.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Batal</button>
                <button type="submit" form="uploadForm" name="submit_type" value="kirim" class="btn btn-confirm">Ya, Kirim Sekarang!</button>
            </div>
        </div>
    </div>
</div>

@include('components.user.footer')
@endsection

<script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_jawaban');
        const fileNameDisplay = document.getElementById('file-name');
        const customFileUpload = fileInput.closest('.custom-file-upload');
        const submitButton = document.getElementById('submitButton');

        if (fileInput && fileNameDisplay && customFileUpload) {
            function updateFileNameDisplay() {
                const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Pilih File PDF';
                fileNameDisplay.textContent = fileName;
                customFileUpload.classList.remove('is-invalid');
                const invalidFeedback = customFileUpload.nextElementSibling;
                if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                    invalidFeedback.style.display = 'none';
                }
            }

            fileInput.addEventListener('change', updateFileNameDisplay);

            if (customFileUpload.classList.contains('is-invalid')) {
                if (!fileInput.files[0]) {
                    fileNameDisplay.textContent = 'Pilih File PDF';
                } else {
                    updateFileNameDisplay();
                }
                const invalidFeedback = customFileUpload.nextElementSibling;
                if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                    invalidFeedback.style.display = 'block';
                }
            } else {
                updateFileNameDisplay();
            }
        }

        if (submitButton) {
            submitButton.addEventListener('click', function(event) {
                if (!fileInput.files[0]) {
                    if (customFileUpload) {
                        customFileUpload.classList.add('is-invalid');
                        let invalidFeedback = customFileUpload.nextElementSibling;
                        if (!invalidFeedback || !invalidFeedback.classList.contains('invalid-feedback')) {
                            invalidFeedback = document.createElement('div');
                            invalidFeedback.classList.add('invalid-feedback');
                            customFileUpload.parentNode.insertBefore(invalidFeedback, customFileUpload.nextSibling);
                        }
                        invalidFeedback.textContent = 'Anda harus mengunggah file jawaban terlebih dahulu.';
                        invalidFeedback.style.display = 'block';
                    }
                    return;
                }

                $('#konfirmasiKirimModal').modal('show');
            });
        }
    });
</script>
