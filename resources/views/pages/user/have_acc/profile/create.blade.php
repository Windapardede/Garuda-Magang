@extends('components.user.header1')

@section('title', 'Tambah Profile')

@section('content')
<section class="notifikasi py-5">
    <div class="container mt-5 poppins">
        <div class="mb-4">
            <h4 class="fw-bold" style="margin-top: 80px">Tambah Profile</h4>
        </div>

        @php
        $user = (object) [
            'nim' => '', 'phone' => '', 'agama' => '', 'gender' => '',
            'institution' => '', 'jurusan' => '', 'cv' => null, 'surat' => null,
            'start_date' => '', 'end_date' => '',
        ];
        $today = date('Y-m-d');
        @endphp

        <form id="profileForm" action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="text-center mb-4 position-relative" style="width: 120px; margin: auto;">
                <label for="photo" class="upload-photo-label" title="Pilih Foto Profil" style="cursor: pointer;">
                    <img id="photoPreview" src="{{ asset('default-profile.png') }}" alt="Foto Profil" class="profile-img" />
                    <div class="camera-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera">
                            <path d="M23 19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                            <circle cx="12" cy="13" r="4"></circle>
                        </svg>
                    </div>
                </label>
                <input type="file" id="photo" name="photo" accept="image/*" class="d-none" onchange="previewPhoto(event)" required>
            </div>

            <div class="card p-4 mb-4">
                <h5 class="fw-semibold mb-4">Data Pribadi</h5>
                <div class="row gx-5 gy-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label"><strong>Nama :</strong></label>
                        <input type="text" name="name" id="name" value="{{ old('name', 'Nama Pengguna') }}" class="form-control" disabled>

                        <label for="nim" class="form-label mt-3"><strong>NIM :</strong><span class="text-danger">*</span></label>
                        <input type="text" name="nim" id="nim" value="{{ old('nim', $user->nim) }}" class="form-control" required>

                        <label for="agama" class="form-label mt-3"><strong>Agama :</strong><span class="text-danger">*</span></label>
                        <select name="agama" id="agama" class="form-select" required>
                            <option value="" disabled selected hidden style="color: #6c757d;">Pilih Agama</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu', 'Lainnya'] as $agama)
                                <option value="{{ $agama }}" {{ old('agama', $user->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label"><strong>Email :</strong></label>
                        <input type="email" name="email" id="email" value="{{ old('email', 'email@example.com') }}" class="form-control" disabled>

                        <label for="phone" class="form-label mt-3"><strong>No.Telepon :</strong><span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>

                        <label for="gender" class="form-label mt-3"><strong>Jenis Kelamin :</strong><span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="" disabled selected hidden style="color: #6c757d;">Pilih Jenis Kelamin</option>
                            @foreach(['Laki-laki', 'Perempuan', 'Lainnya'] as $gender)
                                <option value="{{ $gender }}" {{ old('gender', $user->gender) == $gender ? 'selected' : '' }}>{{ $gender }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card p-4 mb-4">
                <h5 class="fw-semibold mb-4">Data Akademik</h5>
                <div class="row gx-5 gy-3">
                    <div class="col-md-6">
                        <label for="institution" class="form-label"><strong>Asal Institusi :</strong><span class="text-danger">*</span></label>
                        <select name="institution" id="institution" class="form-select" required>
                            <option value="" disabled selected hidden style="color: #6c757d;">Pilih Institusi</option>
                            @foreach(['Politeknik Caltex Riau', 'Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Universitas Airlangga'] as $institusi)
                                <option value="{{ $institusi }}" {{ old('institution', $user->institution) == $institusi ? 'selected' : '' }}>{{ $institusi }}</option>
                            @endforeach
                        </select>

                        <label for="cv" class="form-label mt-3"><strong>Curriculum Vitae (PDF) :</strong><span class="text-danger">*</span></label>
                        <input type="file" name="cv" id="cv" accept="application/pdf" class="form-control" onchange="validateFile(this)" required>
                        <small class="text-muted fst-italic">* Maksimal file 10MB, hanya format PDF</small>
                    </div>

                    <div class="col-md-6">
                        <label for="jurusan" class="form-label"><strong>Jurusan :</strong><span class="text-danger">*</span></label>
                        <select name="jurusan" id="jurusan" class="form-select" required>
                            <option value="" disabled selected hidden style="color: #6c757d;">Pilih Jurusan</option>
                            @foreach(['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen', 'Akuntansi'] as $jurusan)
                                <option value="{{ $jurusan }}" {{ old('jurusan', $user->jurusan) == $jurusan ? 'selected' : '' }}>{{ $jurusan }}</option>
                            @endforeach
                        </select>

                        <label for="surat" class="form-label mt-3"><strong>Surat Institusi (PDF) :</strong><span class="text-danger">*</span></label>
                        <input type="file" name="surat" id="surat" accept="application/pdf" class="form-control" onchange="validateFile(this)" required>
                        <small class="text-muted fst-italic">* Maksimal file 10MB, hanya format PDF</small>
                    </div>
                </div>
            </div>

            <div class="card p-4 mb-4">
                <h5 class="fw-semibold mb-4">Periode Magang</h5>
                <div class="row gx-5 gy-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label"><strong>Tanggal Mulai Magang :</strong><span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $user->start_date) }}" class="form-control" required min="{{ $today }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label"><strong>Tanggal Selesai Magang :</strong><span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $user->end_date) }}" class="form-control" required min="{{ $today }}">
                    </div>
                </div>
            </div>

            <div class="text-center">
                <div class="col-md-4 mx-auto">
                    <button type="submit" class="btn btn-danger w-50">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    function validateFile(input) {
        const file = input.files[0];
        if (file) {
            const isPdf = file.type === 'application/pdf';
            const isTooLarge = file.size > 10 * 1024 * 1024;
            if (!isPdf) {
                alert("File harus dalam format PDF.");
                input.value = '';
            } else if (isTooLarge) {
                alert("Ukuran file maksimal 10MB.");
                input.value = '';
            }
        }
    }
    function previewPhoto(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@include('components.user.footer')
@endsection
