@extends('layouts.app')

@section('title', 'Profil Pengguna')

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
        /* margin-bottom: 0px; <-- Hapus atau ubah ini */
        margin-bottom: 15px;
        /* Tambahkan jarak di bawah setiap grup input */
        display: flex;
        flex-direction: column;
        gap: 6px;
        /* Jarak antara label dan input dalam satu grup */
    }

    .profile-info-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0;
        color: #4a4a4a;
        font-size: 1em;
    }

    .profile-info-group .form-control-plaintext {
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

    .profile-info-group .form-control-plaintext:focus {
        border-color: #6c5ce7;
        outline: none;
    }

    .profile-info-group .form-control-plaintext::-moz-selection {
        background-color: #6c5ce7;
        color: white;
    }

    .profile-info-group .form-control-plaintext::selection {
        background-color: #6c5ce7;
        color: white;
    }

    /* Tombol Aksi */
    .profile-actions {
        margin-top: 5px;
        /* Mungkin ingin sesuaikan ini jika perlu jarak ekstra di atas tombol */
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

    .btn-save {
        background-color: #1e293b;
        color: white;
    }

    .btn-save:hover {
        background-color: #1e293b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-cancel {
        background-color: #dc3545;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
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
            <h1 class="section-title">Profile Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>

        <div class="section-body">
            {{-- Menampilkan alert dari session jika ada --}}
            @include('layouts.alert')

            <div class="profile-container" id="profileContainer">
                <form id="profileForm" action="{{ route('profilementor.update') }}" method=" POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="profile-photo-wrapper">
                        {{-- Gunakan ID unik untuk gambar agar mudah diakses di JS --}}
                        <img src="{{ asset('file?page='.$user->image) ?? asset('images/profile_placeholder.jpg')}}" alt="Foto Profil" class="profile-photo" id="profilePhoto">
                        <span class="profile-photo-camera-icon" id="cameraIcon">
                            <i class="fas fa-camera"></i>
                        </span>
                        {{-- Input file tersembunyi untuk upload foto --}}
                        <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*">
                    </div>

                    <div class="profile-info-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control-plaintext" id="nama_lengkap" name="name" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="profile-info-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" class="form-control-plaintext" id="posisi" name="posisi" value="{{ $user->position }}" readonly>
                    </div>

                    <div class="profile-info-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control-plaintext" id="email" name="email" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="profile-actions">
                        <button type="button" class="btn-action btn-edit-profile" id="editProfileBtn">
                            <i class="fas fa-edit"></i> Edit Profil
                        </button>
                        <button type="submit" class="btn-action btn-save" id="saveProfileBtn" style="display: none;">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="button" class="btn-action btn-cancel" id="cancelEditBtn" style="display: none;">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
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

        // Handle form submission (AJAX)
        profileForm.on('submit', function(e) {
            e.preventDefault();

            var form = $(this)[0];
            var url = $(this).attr('action');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert("Profile berhasil diubah");
                    location.reload();
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
    });
</script>
@endpush
