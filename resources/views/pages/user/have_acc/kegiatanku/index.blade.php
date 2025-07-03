@extends('components.user.header1')

@section('title', 'Kegiatanku')

@section('content')
    <style>
        .btn-color {
            background: #dc3545 !important;
            color: #fff !important;
        }

        .btn-color:hover {
            background: #c82333 !important;
            color: #fff !important;
        }
    </style>
    <section class="notifikasi py-5">
        <div class="container my-5">
            <div class="nav-tabs-box">
                <ul class="nav nav-tabs justify-content-center border-0 mb-0">
                    <li class="nav-item">
                        <a class="nav-link {{ @$statusOpen['pendaftaran'] }}" aria-selected="" data-bs-toggle="tab"
                            href="#status">Status Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ @$statusOpen['kegitan'] }}" aria-selected="" data-bs-toggle="tab"
                            href="#kegiatan">Kegiatan Aktif</a>
                    </li>
                </ul>
            </div>
            @include('layouts.alert-noicon')
            <div class="content-box">
                <div class="tab-content mt-4">
                    <div class="tab-pane fade {{ @$statusOpen['pendaftaranselect'] }}" id="status">
                        @if (count($pengajuan) == 0)
                            <div class="container text-center py-5">
                                <img src="{{ asset('img/no-img.avif') }}" alt="No Activity" style="max-width: 300px;"
                                    class="mb-4">
                                <h2 class="text-secondary mb-3">Belum Ada Kegiatan</h2>
                                <p class="lead">Maaf, kamu belum memiliki kegiatan saat ini. Pastikan kamu sudah
                                    mengajukan posisi magang.</p>
                                <a href="{{ url('posisi') }}" class="btn btn-color mt-3">Ajukan Posisi Magang</a>
                            </div>
                        @else
                            @foreach ($pengajuan as $value)
                                <div class="status-card">
                                    <img src="{{ asset('user/assets/icons/status.png') }}" alt="Programmer"
                                        class="status-img me-3" />
                                    @if ($value->status_administrasi == 'diterima')
                                        <span class="status-badge-diterima">Administrasi Diterima</span>
                                    @elseif($value->status_administrasi == 'ditolak')
                                        <span class="status-badge-ditolak">Administrasi Ditolak</span>
                                    @else
                                        <span class="status-badge">Menunggu Hasil Administrasi</span>
                                    @endif
                                    <div class="interview-content">
                                        <h5 class="fw-bold mb-1">{{ $value->posisi->nama ?? 'N/A' }}</h5>
                                        <p class="mb-2">
                                            @if ($value->status_administrasi == 'diterima')
                                                Selamat, Anda lolos ke tahap selanjutnya.
                                            @elseif($value->status_administrasi == 'ditolak')
                                                Maaf, Anda tidak lolos ke tahap selanjutnya.
                                            @else
                                                Tunggulah hasil seleksi dokumen Anda untuk melanjutkanke tahap seleksi
                                                selanjutnya.
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if ($value->status_administrasi == 'diterima' && !empty($value->tanggal_awal_tes_kemampuan))
                                    <div class="status-card">
                                        <img src="{{ asset('user/assets/icons/status.png') }}" alt="Programmer"
                                            class="status-img me-3" />
                                        @if ($value->status_tes_kemampuan == 'diterima')
                                            <span class="status-badge-diterima">Tes Kemampuan Diterima</span>
                                        @elseif($value->status_tes_kemampuan == 'ditolak')
                                            <span class="status-badge-ditolak">Kemampuan Ditolak</span>
                                        @else
                                            <span class="status-badge">Tes Kemampuan</span>
                                        @endif
                                        <div class="interview-content">
                                            <h5 class="fw-bold mb-1">{{ $value->posisi->nama ?? 'N/A' }}</h5>
                                            <p class="mb-2">
                                                Selamat, Anda lolos ke tahap tes Kemampuan. Pastikan Anda mengikuti seleksi
                                                tes Kemampuan sesuai jadwal yang ditentukan sebagai tahap seleksi akhir.
                                            </p>
                                            <p class="interview-date">Tanggal Tes Kemampuan :
                                                {{ date('d/m/Y', strtotime($value->tanggal_awal_tes_kemampuan)) }} -
                                                {{ date('d/m/Y', strtotime($value->tanggal_akhir_tes_kemampuan)) }} </p>
                                            @if ($value->status_tes_kemampuan == 'diterima')
                                            @elseif($value->status_tes_kemampuan == 'ditolak')
                                            @else
                                                @if (!empty($value->jawaban_tes_kemampuan))
                                                    <div class="button-wrapper"> <button
                                                            class="btn btn-danger link-wawancara" disabled>Link Tes
                                                            Kemampuan</button></div>
                                                @else
                                                    <div class="button-wrapper"> <a
                                                            href="{{ route('user.kegiatanku.soal') }}"
                                                            class="btn btn-danger link-wawancara">Link Tes Kemampuan</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($value->status_tes_kemampuan == 'diterima' && $value->status_tes_kemampuan == 'diterima')
                                    <div class="status-card">
                                        <img src="{{ asset('user/assets/icons/status.png') }}" {{-- Ganti dengan path gambar yang sesuai --}}
                                            alt="Programmer" class="status-img me-3" />
                                        @if ($value->status_wawancara == 'diterima')
                                            <span class="status-badge-diterima">Wawancara Diterima</span>
                                        @elseif($value->status_wawancara == 'ditolak')
                                            <span class="status-badge-ditolak">Wawancara Tidak Lulus</span>
                                        @else
                                            <span class="status-badge">Wawancara</span>
                                        @endif
                                        <div class="interview-content">
                                            <h5 class="fw-bold mb-1">{{ $value->posisi->nama ?? 'N/A' }}</h5>
                                            <p class="mb-2">
                                                Selamat, Anda lolos ke tahap wawancara. Pastikan Anda mengikuti seleksi
                                                wawancara sesuai jadwal yang ditentukan sebagai tahap seleksi akhir.
                                            </p>
                                            @if (!empty($value->tanggal_wawancara) && $value->status_wawancara == 'belumDiproses')
                                                <p class="interview-date">Tanggal Wawancara :
                                                    {{ date('d/m/Y', strtotime($value->tanggal_wawancara)) }}
                                                    {{ $value->jam_wawancara }}</p>
                                                <div class="button-wrapper">
                                                    <a href="{{ $value->link_wawancara }}" target="_blank"
                                                        class="btn btn-danger link-wawancara">Link Wawancara</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (
                                    $value->status == 'diterima' &&
                                        $value->status_wawancara == 'diterima' &&
                                        $value->status_tes_kemampuan == 'diterima' &&
                                        $value->status_administrasi == 'diterima')
                                    <div class="status-card">
                                        <img src="{{ asset('user/assets/icons/status.png') }}" {{-- Ganti dengan path gambar yang sesuai --}}
                                            alt="Programmer" class="status-img me-3" />
                                        <span class="status-badge-diterima">Diterima</span>
                                        <div class="interview-content">
                                            <h5 class="fw-bold mb-1">{{ $value->posisi->nama ?? 'N/A' }}</h5>
                                            <p class="mb-2">
                                                Luar biasa! Kamu berhasil mendapatkan posisi sebagai
                                                {{ $value->posisi->nama ?? 'N/A' }}. Ayo mulai perjalanan hebat ini bersama
                                                kami!
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <div class="tab-pane fade {{ @$statusOpen['kegitanselect'] }}" id="kegiatan">
                        <div class="container mt-4">
                            @if ($status == false)
                                <div class="container text-center py-5">
                                    <img src="{{ asset('img/no-img.avif') }}" alt="No Activity" style="max-width: 300px;"
                                        class="mb-4">
                                    <h2 class="text-secondary mb-3">Belum Ada Kegiatan</h2>
                                    <p class="lead">Maaf, kamu belum memiliki kegiatan saat ini. </p>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <div class="card sidebar-custom">
                                            <img src="{{ asset('user/assets/icons/status.png') }}" alt="Programmer" />
                                            <h6 class="fw-bold mt-2">{{ $pengajuanAktif->posisi->nama }}</h6>

                                            @if ($berisertifikat == true)
                                                <span class="badge badge-accepted mb-2">Alumni</span>
                                            @else
                                                <span class="badge badge-accepted mb-2">Diterima</span>
                                            @endif
                                            <p class="small text-muted mb-1">
                                                Pastikan Anda mengisi laporan progres proyek Anda dan
                                                terima penghargaan berupa sertifikat setelah menyelesaikan
                                                magang.
                                            </p>
                                            <p class="text-muted small">{{ date('d/m/Y', strtotime($user->mulai_magang)) }}
                                                – {{ date('d/m/Y', strtotime($user->selesai_magang)) }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <h4 class="fw-bold">{{ $pengajuanAktif->posisi->nama }}</h4>
                                        <p class="mb-1">Nama : <strong>{{ $user->name }}</strong></p>
                                        <p class="mb-1">
                                            Tanggal Mulai :
                                            <strong>{{ date('d/m/Y', strtotime($user->mulai_magang)) }}</strong>
                                        </p>
                                        <p class="mb-3">
                                            Tanggal Selesai :
                                            <strong>{{ date('d/m/Y', strtotime($user->selesai_magang)) }}</strong>
                                        </p>

                                        <div class="card content-custom mb-2">
                                            <h6 class="fw-bold">Laporan Projek</h6>
                                            <p class="small text-muted">
                                                Perbarui terus presentasi projek Anda, dan pastikan
                                                memberikan yang terbaik dalam setiap aspek.
                                            </p>
                                            <div class="d-flex justify-content-end mb-2">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#tambahLaporanModal"
                                                    @if (is_null(Auth::user()->mentor_id)) disabled @endif>
                                                    + Tambah
                                                </button>

                                            </div>
                                            <div class="table-responsive" style="overflow: visible;">
                                                <table class="table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width: 50%; text-align: left">
                                                                Judul Projek
                                                            </th>
                                                            <th style="width: 15%">Jenis Projek</th>
                                                            <th style="width: 15%">Presentase</th>
                                                            <th style="width: 15%">Status</th>
                                                            <th style="width: 10%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- Loop melalui data proyek yang diteruskan dari controller --}}
                                                        @foreach ($projects as $project)
                                                            <tr>
                                                                <td style="text-align: left">
                                                                    {{ $project->title }}
                                                                </td>
                                                                <td>{{ $project->jenis }}</td>
                                                                <td>{{ $project->persentase }}%</td>
                                                                <td>
                                                                    @if ($project->status == 'proses')
                                                                        <span class="badge bg-primary">Proses</span>
                                                                    @elseif($project->status == 'diterima')
                                                                        <span class="badge bg-success">Selesai</span>
                                                                    @elseif($project->status == 'Revisi')
                                                                        <span
                                                                            class="badge bg-warning text-dark">Revisi</span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-secondary">{{ $project->status }}</span>
                                                                    @endif
                                                                </td>
                                                                <td style="overflow: visible;">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm btn-outline-secondary"
                                                                            type="button"
                                                                            id="dropdownAksi{{ $project->id }}"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false" data-bs-offset="0,5"
                                                                            data-bs-auto-close="outside"
                                                                            data-bs-container="body"
                                                                            data-bs-reference="parent">
                                                                            <i class="fas fa-bars"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-end"
                                                                            aria-labelledby="dropdownAksi{{ $project->id }}">
                                                                            <li>
                                                                                <a class="dropdown-item btn-edit-judul"
                                                                                    href="#" data-bs-toggle="modal"
                                                                                    data-bs-target="#editLaporanModal"
                                                                                    data-id="{{ $project->id }}"
                                                                                    data-judul="{{ $project->title }}"
                                                                                    data-type="{{ $project->jenis }}">
                                                                                    <i
                                                                                        class="fas fa-edit me-2 text-primary"></i>Edit
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('kegiatanku.project.detail', ['id' => $project->id]) }}">
                                                                                    <i
                                                                                        class="fas fa-info-circle me-2 text-info"></i>Detail
                                                                                    Projek
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @if ($testimoni == true)
                                            <div class=" mb-2">
                                                <div class="card p-3 text-center rounded"
                                                    style="border: 1px solid #ddd; border-radius: 10px;  margin-top: 20px;">
                                                    <p class="mb-1 fw-bold" style="text-align: left">Testimoni</p>
                                                    <p class="mb-2 small text-muted" style="text-align: left">
                                                        Silahkan isi Testimoni Terlebih Dahulu Sebelum Mendownload
                                                        Sertifikat.<br>
                                                        <strong>Pastikan Anda Mengisi dengan Kalimat yang Sopan.</strong>
                                                    </p>
                                                    <button {{ $sertifikat == true ? 'disabled' : '' }}
                                                        class="btn btn-danger rounded" style="border-radius: 10px;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#testimoniModal">Testimoni</button>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($sertifikat == true)
                                            <div class="mb-2">
                                                <div class="card p-3 text-center rounded"
                                                    style="border: 1px solid #ddd; border-radius: 10px;  margin-top: 10px;">
                                                    <p class="mb-1 fw-bold" style="text-align: left">Sertifikat</p>
                                                    <p class="mb-2 small text-muted" style="text-align: left">
                                                        Selesaikan proyek magang Anda dengan baik dan raihlah sertifikat
                                                        penghargaan yang akan kami berikan.<br>
                                                        <strong>Pastikan Anda mendownload Sertifikat yang telah kami
                                                            berikan.</strong>
                                                    </p>

                                                    @if ($berisertifikat == true)
                                                        <a href="{{ asset('file?page=' . $ceksertifikat->location) }}"
                                                            class="btn btn-danger rounded"
                                                            style="border-radius: 10px;">Unduh</a>
                                                    @else
                                                        <button type="button" class="btn btn-danger rounded"
                                                            style="border-radius: 10px;" data-bs-toggle="modal"
                                                            data-bs-target="#mentorAdminModal">Unduh</button>
                                                    @endif

                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL TAMBAH JUDUL PROJECT --}}
    <div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="tambahLaporanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahLaporanModalLabel">Tambah Judul Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judulProject" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judulProject" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisProject" class="form-label">Jenis Project</label>
                        <select class="form-select" id="jenisProject" name="type" required>
                            <option value="">Pilih Jenis Project</option>
                            <option value="Main Project">Main Project</option>
                            <option value="Side Project">Side Project</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="simpanTambahProjectBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT JUDUL PROJECT --}}
    <div class="modal fade" id="editLaporanModal" tabindex="-1" aria-labelledby="editLaporanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLaporanModalLabel">Edit Judul Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editJudulProject" class="form-label">Judul</label>
                        <input type="hidden" id="editProjectId">
                        <input type="text" class="form-control" id="editJudulProject">
                    </div>
                    <div class="mb-3">
                        <label for="editJenisProject" class="form-label">Jenis Project</label>
                        <select class="form-select" id="editJenisProject" name="type" required>
                            <option value="">Pilih Jenis Project</option>
                            <option value="Main Project">Main Project</option>
                            <option value="Side Project">Side Project</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="simpanEditBtn">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TESTIMONI (BARU) --}}
    <div class="modal fade" id="testimoniModal" tabindex="-1" aria-labelledby="testimoniModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-end border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <p class="mb-3 fw-bold text-danger">Isi Testimoni terlebih dahulu <br> untuk mengunduh Sertifikat</p>
                    <div class="mb-3 text-start">
                        <label for="testimoniTextarea" class="form-label fw-bold">Testimoni</label>
                        <textarea class="form-control" id="testimoniTextarea" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-danger" id="simpanTestimoniBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL KONFIRMASI BERHASIL --}}
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-end border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <i class="fas fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                    <h5 class="modal-title mb-3" id="successModalLabel">Berhasil!</h5>
                    <p id="successModalMessage"></p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL UNTUK ALERT SERTIFIKAT --}}
    <div class="modal fade" id="mentorAdminModal" tabindex="-1" aria-labelledby="mentorAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mentorAdminModalLabel">Info Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Harap hubungi <strong>mentor</strong> untuk memberikan sertifikat Anda.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('components.user.footer')
@endsection

@section('scripts')
    <script>
        // Fungsi untuk menampilkan modal sukses
        function showSuccessModal(message) {
            document.getElementById('successModalMessage').textContent = message;
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }

        // Fungsi untuk menampilkan modal "Harap hubungi mentor atau admin"
        function showAlertMentorAdminModal() {
            var mentorAdminModal = new bootstrap.Modal(document.getElementById('mentorAdminModal'));
            mentorAdminModal.show();
        }

        // Event listener untuk tombol "Unduh" sertifikat saat berisertifikat == false
        document.querySelector('button[onClick="alertBeluBeri()"]').addEventListener('click', function() {
            showAlertMentorAdminModal();
        });

        // Logika untuk modal Tambah Judul
        const simpanButtonTambah = document.querySelector('#tambahLaporanModal .modal-footer .btn-danger');
        const judulInputTambah = document.getElementById('judulProject');
        const jenisInputTambah = document.getElementById('jenisProject'); // Tambahkan ini

        simpanButtonTambah.addEventListener('click', function() {
            if (judulInputTambah.value.trim() === '') {
                alert('Judul tidak boleh kosong!');
                return;
            }
            if (jenisInputTambah.value.trim() === '') { // Validasi jenis project
                alert('Jenis Project tidak boleh kosong!');
                return;
            }

            console.log('Judul yang akan disimpan (Tambah):', judulInputTambah.value);

            // Data yang akan dikirim
            const data = {
                title: judulInputTambah.value, // Ubah key menjadi 'title' sesuai controller
                type: jenisInputTambah.value, // Tambahkan jenis project
            };

            // Kirim HTTP POST menggunakan fetch
            fetch('/kegiatanku', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        // Coba baca pesan error dari response jika ada
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal menyimpan project');
                        });
                    }
                    return response.json();
                })
                .then(result => {
                    // Tampilkan modal sukses
                    showSuccessModal('Judul project berhasil ditambahkan!');
                    console.log(result);
                    // Tutup modal tambah laporan
                    var myModalEl = document.getElementById('tambahLaporanModal');
                    var modal = bootstrap.Modal.getInstance(myModalEl);
                    if (modal) modal.hide();

                    // Refresh halaman atau update daftar laporan setelah modal sukses ditutup
                    document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                        window.location.href = 'kegiatanku?kegitanaktif=true';
                    }, {
                        once: true
                    });
                })
                .catch(error => {
                    console.error('Error saat menyimpan laporan:', error);
                    alert('Terjadi kesalahan saat menyimpan laporan: ' + error.message);
                });
        });


        // --- Logika untuk modal Edit Judul ---

        const editLaporanModalElement = document.getElementById('editLaporanModal');
        const editProjectIdInput = document.getElementById('editProjectId');
        const editJudulProjectInput = document.getElementById('editJudulProject');
        const editJenisProjectInput = document.getElementById('editJenisProject'); // Tambahkan ini
        const simpanEditBtn = document.getElementById('simpanEditBtn');

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-edit-judul') || event.target.closest('.btn-edit-judul')) {
                event.preventDefault();
                const editButton = event.target.closest('.btn-edit-judul');

                const projectId = editButton.dataset.id;
                const projectJudul = editButton.dataset.judul;
                const projectType = editButton.dataset.type; // Ambil jenis project

                editProjectIdInput.value = projectId;
                editJudulProjectInput.value = projectJudul;
                editJenisProjectInput.value = projectType; // Set nilai jenis project
            }
        });

        simpanEditBtn.addEventListener('click', function() {
            const idToEdit = editProjectIdInput.value;
            const newJudul = editJudulProjectInput.value.trim();
            const newJenis = editJenisProjectInput.value.trim(); // Ambil nilai jenis project baru

            if (newJudul === '') {
                alert('Judul tidak boleh kosong!');
                return;
            }
            if (newJenis === '') { // Validasi jenis project
                alert('Jenis Project tidak boleh kosong!');
                return;
            }

            console.log('Mengedit Proyek ID:', idToEdit);
            console.log('Judul Baru:', newJudul);
            console.log('Jenis Baru:', newJenis);

            const data = {
                title: newJudul, // Ubah key menjadi 'title' sesuai controller
                type: newJenis, // Tambahkan jenis project
                _method: 'PUT', // Penting untuk metode PUT di Laravel
            };

            // Kirim HTTP POST (dengan _method PUT) menggunakan fetch
            fetch('/kegiatanku/' + idToEdit, {
                    method: 'POST', // Gunakan POST, tapi sertakan _method: 'PUT'
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        // Coba baca pesan error dari response jika ada
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal mengedit project');
                        });
                    }
                    return response.json();
                })
                .then(result => {
                    // Tampilkan modal sukses
                    showSuccessModal(`Judul project berhasil diedit menjadi "${newJudul}"!`);
                    console.log(result);
                    // Tutup modal edit laporan
                    var myModalEl = document.getElementById('editLaporanModal');
                    var modal = bootstrap.Modal.getInstance(myModalEl);
                    if (modal) modal.hide();

                    // Refresh halaman atau update daftar laporan setelah modal sukses ditutup
                    document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                        window.location.href = 'kegiatanku?kegitanaktif=true';
                    }, {
                        once: true
                    });
                })
                .catch(error => {
                    console.error('Error saat menyimpan laporan:', error);
                    alert('Terjadi kesalahan saat menyimpan laporan: ' + error.message);
                });
        });

        // Logika untuk modal Testimoni
        const simpanTestimoniBtn = document.getElementById('simpanTestimoniBtn');
        const testimoniTextarea = document.getElementById('testimoniTextarea');

        simpanTestimoniBtn.addEventListener('click', function() {
            const testimoniContent = testimoniTextarea.value.trim();

            if (testimoniContent === '') {
                alert('Testimoni tidak boleh kosong!');
                return;
            }

            const data = {
                testimoni: testimoniContent,
                _method: 'PUT' // Gunakan PUT untuk update
            };

            fetch('/kegiatanku/testimoni', { // Sesuaikan endpoint API untuk menyimpan testimoni
                    method: 'POST', // Kirim sebagai POST, Laravel akan menginterpretasikan _method PUT
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal menyimpan testimoni');
                        });
                    }
                    return response.json();
                })
                .then(result => {
                    showSuccessModal('Testimoni berhasil disimpan!');
                    console.log(result);
                    var myModalEl = document.getElementById('testimoniModal');
                    var modal = bootstrap.Modal.getInstance(myModalEl);
                    if (modal) modal.hide();

                    document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                        window.location.reload(); // Reload halaman setelah testimoni disimpan
                    }, {
                        once: true
                    });
                })
                .catch(error => {
                    console.error('Error saat menyimpan testimoni:', error);
                    alert('Terjadi kesalahan saat menyimpan testimoni: ' + error.message);
                });
        });
    </script>
@endsection
