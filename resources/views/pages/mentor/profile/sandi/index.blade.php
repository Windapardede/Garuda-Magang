@extends('layouts.appmentor')

@section('title', 'Ubah Kata Sandi')

@push('style')
{{-- Google Fonts: Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
{{-- Font Awesome for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* CSS Umum dari Testimoni (disederhanakan untuk relevansi) */
    .main-content {
        margin-top: 30px;
    }

    /* Modern & Soft Styling - Disesuaikan untuk Tampilan Melebar */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
    }

    .profile-container {
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        max-width: 90%;
        width: 100%;
        margin: 40px auto;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 20px;
        /* Sesuaikan nilai ini untuk mengatur jarak antar field groups (misal: 20px) */
        box-sizing: border-box;
    }

    /* Styling untuk judul "Foto Profil" */
    .profile-container h3 {
        margin-bottom: 0;
        color: #4a4a4a;
        font-weight: 600;
        width: 100%;
        text-align: center;
    }

    .profile-photo-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid #6c5ce7;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-photo-wrapper:hover {
        transform: scale(1.03);
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .profile-photo-camera-icon {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background-color: #fff;
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        font-size: 1.2em;
        color: #6c5ce7;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .profile-photo-camera-icon:hover {
        background-color: #f0f0f0;
    }

    /* Input file tersembunyi untuk foto profil */
    #profilePhotoInput {
        display: none;
    }

    /* Informasi Profil */
    .profile-info-group {
        width: 100%;
        text-align: left;
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .profile-info-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0;
        color: #4a4a4a;
        font-size: 1em;
    }

    .profile-info-group .form-control-plaintext,
    .profile-info-group .form-control-input {
        /* Tambahkan .form-control-input di sini */
        background-color: #f2f4f6;
        border: 1px solid #e0e0e0;
        padding: 14px 18px;
        border-radius: 12px;
        font-size: 1.05em;
        color: #333;
        width: 100%;
        box-sizing: border-box;
        cursor: default;
        transition: border-color 0.3s ease;
    }

    .profile-info-group .form-control-plaintext:focus,
    .profile-info-group .form-control-input:focus {
        /* Tambahkan .form-control-input di sini */
        border-color: #6c5ce7;
        outline: none;
    }

    .profile-info-group .form-control-plaintext::-moz-selection,
    .profile-info-group .form-control-input::-moz-selection {
        /* Tambahkan .form-control-input di sini */
        background-color: #6c5ce7;
        color: white;
    }

    .profile-info-group .form-control-plaintext::selection,
    .profile-info-group .form-control-input::selection {
        /* Tambahkan .form-control-input di sini */
        background-color: #6c5ce7;
        color: white;
    }

    /* Styling untuk Password Fields */
    .password-input-group {
        position: relative;
    }

    .password-input-group .form-control-input {
        padding-right: 50px;
        /* Ruang untuk ikon mata */
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        font-size: 1.1em;
        transition: color 0.2s ease;
    }

    .toggle-password:hover {
        color: #333;
    }

    /* Tombol Aksi */
    .profile-actions {
        margin-top: 5px;
        width: 100%;
        text-align: right;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-action {
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-size: 1.05em;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-edit-profile {
        background-color: #1e293b;
        color: white;
    }

    .btn-edit-profile:hover {
        background-color: #1e293b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
    }

    /* Tombol Simpan pada gambar terlihat seperti ini */
    .btn-save-password {
        background-color: #1e293b;
        /* Warna abu-abu yang lebih kalem */
        color: white;
        border-radius: 8px;
        /* Sedikit lebih kotak sesuai gambar */
        padding: 12px 25px;
        /* Sesuaikan padding */
        font-weight: 500;
        /* Sedikit lebih ringan */
        font-size: 1em;
        margin-left: auto;
        /* Untuk menempatkan tombol di kanan */
        margin-right: auto;
        /* Untuk menempatkan tombol di kanan */
        display: block;
        /* Agar margin auto bekerja */
        width: fit-content;
        /* Sesuai konten */
    }

    .btn-save-password:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-action i {
        font-size: 1em;
    }

    .section-header h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: #333;
    }

    .breadcrumb-item {
        font-family: 'Poppins', sans-serif;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Ubah Kata Sandi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Ubah Kata Sandi</div>
            </div>
        </div>

        <div class="section-body">
            {{-- Menampilkan alert dari session jika ada --}}
            @include('layouts.alert')

            <div class="profile-container" id="profileContainer">

                {{-- Form Ganti Kata Sandi --}}
                <form id="passwordForm" action="{{ route('profileadmin.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="profile-info-group">
                        <label for="current_password">Kata Sandi Sekarang</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control-input" id="current_password" name="current_password" required>
                            <span class="toggle-password" data-target="current_password">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-group">
                        <label for="new_password">Kata Sandi Baru</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control-input" id="new_password" name="new_password" required>
                            <span class="toggle-password" data-target="new_password">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-group">
                        <label for="new_password_confirmation">Masukkan Ulang Kata Sandi Baru</label>
                        <div class="password-input-group">
                            <input type="password" class="form-control-input" id="new_password_confirmation" name="new_password_confirmation" required>
                            <span class="toggle-password" data-target="new_password_confirmation">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-action btn-save-password">Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Skrip standar dari template Anda --}}
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
        const profileContainer = $('#profileContainer');
        const profileForm = $('#profileForm');
        const inputs = profileForm.find('.form-control-plaintext');
        const editProfileBtn = $('#editProfileBtn');
        const saveProfileBtn = $('#saveProfileBtn');
        const cancelEditBtn = $('#cancelEditBtn');
        const cameraIcon = $('#cameraIcon');
        const profilePhotoInput = $('#profilePhotoInput');
        const profilePhoto = $('#profilePhoto'); // Menggunakan ID karena sudah ditambahkan di HTML
        let originalProfileValues = {}; // Untuk menyimpan nilai awal input
        let originalProfilePhotoSrc = profilePhoto.attr('src'); // Simpan URL foto profil asli

        // Simpan nilai awal saat halaman dimuat
        inputs.each(function() {
            originalProfileValues[this.id] = $(this).val();
        });

        // Fungsi untuk mengaktifkan mode edit
        function enableEditMode() {
            profileContainer.addClass('edit-mode');
            inputs.prop('readonly', false);
            editProfileBtn.hide();
            saveProfileBtn.show();
            cancelEditBtn.show();
        }

        // Fungsi untuk menonaktifkan mode edit
        function disableEditMode() {
            profileContainer.removeClass('edit-mode');
            inputs.prop('readonly', true);
            editProfileBtn.show();
            saveProfileBtn.hide();
            cancelEditBtn.hide();

            // Reset nilai input ke nilai awal jika dibatalkan
            inputs.each(function() {
                $(this).val(originalProfileValues[this.id]);
            });

            // Reset foto profil ke foto asli
            profilePhoto.attr('src', originalProfilePhotoSrc);
            profilePhotoInput.val(''); // Kosongkan input file
        }

        // Event listener untuk tombol "Edit Profil"
        editProfileBtn.on('click', function() {
            enableEditMode();
        });

        // Event listener untuk tombol "Batal"
        cancelEditBtn.on('click', function() {
            disableEditMode();
        });

        // Event listener untuk ikon kamera
        cameraIcon.on('click', function() {
            if (profileContainer.hasClass('edit-mode')) {
                profilePhotoInput.click();
            }
        });

        // Event listener saat file foto dipilih
        profilePhotoInput.on('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePhoto.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission (AJAX) for profile update
        profileForm.on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: profileForm.attr('action'),
                method: profileForm.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Perbarui nilai originalProfileValues dengan nilai baru
                        inputs.each(function() {
                            originalProfileValues[this.id] = $(this).val();
                        });

                        // Perbarui URL foto profil asli jika ada perubahan
                        if (response.profile_photo_url) {
                            profilePhoto.attr('src', response.profile_photo_url);
                            originalProfilePhotoSrc = response.profile_photo_url;
                        }

                        // Tampilkan pesan sukses (Anda bisa menggunakan alert, modal, atau toast)
                        alert(response.message || 'Profil berhasil diperbarui!');
                        disableEditMode(); // Kembali ke mode non-edit
                        // window.location.href = "#"; // Jika tidak ada redirect spesifik, ini mungkin tidak diperlukan
                    } else {
                        alert('Gagal menyimpan profil: ' + (response.message || 'Terjadi kesalahan.'));
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Validasi error dari Laravel
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Validasi gagal:\n';
                        for (const key in errors) {
                            errorMessage += `- ${errors[key][0]}\n`;
                        }
                        alert(errorMessage);
                    } else {
                        alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
                    }
                }
            });
        });

        // --- JavaScript untuk Toggle Password ---
        $('.toggle-password').on('click', function() {
            const targetId = $(this).data('target');
            const passwordField = $('#' + targetId);
            const icon = $(this).find('i');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('far fa-eye').addClass('far fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('far fa-eye-slash').addClass('far fa-eye');
            }
        });

        // Handle form submission for password update
        $('#passwordForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert(response.message || 'Kata sandi berhasil diperbarui!');
                        // Kosongkan field password setelah berhasil
                        $('#current_password').val('');
                        $('#new_password').val('');
                        $('#new_password_confirmation').val('');
                    } else {
                        alert('Gagal memperbarui kata sandi: ' + (response.message || 'Terjadi kesalahan.'));
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Validasi error dari Laravel
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Validasi gagal:\n';
                        for (const key in errors) {
                            errorMessage += `- ${errors[key][0]}\n`;
                        }
                        alert(errorMessage);
                    } else {
                        alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
                    }
                }
            });
        });
    });
</script>
@endpush