@extends('components.user.header1')

@section('title', 'Kegiatanku')

@section('content')
<section class="notifikasi py-5">
    <div class="container my-5">
        <div class="nav-tabs-box">
            <ul class="nav nav-tabs justify-content-center border-0 mb-0">
                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="tab" href="#status">Status Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#kegiatan">Kegiatan Aktif</a>
                </li>
            </ul>
        </div>

        <div class="content-box">
            <div class="tab-content mt-4">
                <div class="tab-pane fade " id="status">
                    <div class="status-card">
                        <img
                            src="{{ asset('user/assets/icons/status.png') }}" {{-- Ganti dengan path gambar yang sesuai --}}
                            alt="Programmer"
                            class="status-img me-3" />
                        {{-- Ini adalah badge "Administrasi" yang ditambahkan --}}
                        <span class="status-badge">Administrasi</span>
                        <div class="interview-content">
                            <h5 class="fw-bold mb-1">Programmer</h5>
                            <p class="mb-2">
                                Tunggulah hasil seleksi dokumen Anda untuk melanjutkanke tahap seleksi selanjutnya.
                            </p>
                        </div>
                    </div>

                    <div class="status-card">
                        <img
                            src="{{ asset('user/assets/icons/status.png') }}" {{-- Ganti dengan path gambar yang sesuai --}}
                            alt="Programmer"
                            class="status-img me-3" />
                        <span class="status-badge">Tes Kemampuan</span>
                        <div class="interview-content">
                            <h5 class="fw-bold mb-1">Programmer</h5>
                            <p class="mb-2">
                                Selamat, Anda lolos ke tahap tes Kemampuan. Pastikan Anda mengikuti seleksi tes Kemampuan sesuai jadwal yang ditentukan sebagai tahap seleksi akhir.
                            </p>
                            <p class="interview-date">Tanggal Tes Kemampuan : 25/05/2025 - 28/05/2025 </p>
                            <div class="button-wrapper"> <a href="{{ route('user.kegiatanku.soal') }}" class="btn btn-danger link-wawancara">Link Tes Kemampuan</a>
                            </div>
                        </div>
                    </div>

                    <div class="status-card">
                        <img
                            src="{{ asset('user/assets/icons/status.png') }}" {{-- Ganti dengan path gambar yang sesuai --}}
                            alt="Programmer"
                            class="status-img me-3" />
                        <span class="status-badge">Wawancara</span>
                        <div class="interview-content">
                            <h5 class="fw-bold mb-1">Programmer</h5>
                            <p class="mb-2">
                                Selamat, Anda lolos ke tahap wawancara. Pastikan Anda mengikuti seleksi wawancara sesuai jadwal yang ditentukan sebagai tahap seleksi akhir.
                            </p>
                            <p class="interview-date">Tanggal Wawancara : 30/07/2023</p>
                            <div class="button-wrapper"> <a href="#" class="btn btn-danger link-wawancara">Link Wawancara</a>
                            </div>
                        </div>
                    </div>

                    <div class="status-card">
                        <img
                            src="{{ asset('user/assets/icons/status.png') }}" {{-- Ganti dengan path gambar yang sesuai --}}
                            alt="Programmer"
                            class="status-img me-3" />
                        <span class="status-badge-diterima">Diterima</span>
                        <div class="interview-content">
                            <h5 class="fw-bold mb-1">Programmer</h5>
                            <p class="mb-2">
                                Luar biasa! Kamu berhasil mendapatkan posisi sebagai Programmer. Ayo mulai perjalanan hebat ini bersama kami!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="kegiatan">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="card sidebar-custom">
                                    <img src="{{ asset('user/assets/icons/status.png') }}" alt="Programmer" />
                                    <h6 class="fw-bold mt-2">{{$pengajuanAktif->posisi->nama}}</h6>
                                    <span class="badge badge-accepted mb-2">Diterima</span>
                                    <p class="small text-muted mb-1">
                                        Pastikan Anda mengisi laporan progres proyek Anda dan
                                        terima penghargaan berupa sertifikat setelah menyelesaikan
                                        magang.
                                    </p>
                                    <p class="text-muted small">{{ date('d/m/Y', strtotime($user->mulai_magang)) }} – {{ date('d/m/Y', strtotime($user->selesai_magang)) }}</p>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="d-flex align-items-center mb-3">
                                    <a href="{{ url('kegiatanku?kegitanaktif=true') }}" class="btn btn-light btn-sm me-2">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                    <h4 class="fw-bold mb-0">Detail Project</h4>
                                </div>
                                <h4 class="fw-bold">{{$pengajuanAktif->posisi->nama}}</h4>
                                <p class="mb-1">Nama : <strong>{{ $user->name }}</strong></p>
                                <p class="mb-1">
                                    Tanggal Mulai : <strong>{{ date('d/m/Y', strtotime($user->mulai_magang)) }}</strong>
                                </p>
                                <p class="mb-3">
                                    Tanggal Selesai : <strong>{{ date('d/m/Y', strtotime($user->selesai_magang)) }}</strong>
                                </p>

                                <div class="card content-custom mb-2">
                                    <h6 class="fw-bold">Laporan Projek</h6>
                                    <p class="small text-muted">
                                        Perbarui terus presentasi projek Anda, dan pastikan
                                        memberikan yang terbaik dalam setiap aspek.
                                    </p>
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tambahLaporanModal">
                                            + Tambah
                                        </button>
                                    </div>
                                    <div class="table-responsive" style="overflow: visible;">
                                        <table
                                            class="table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50%; text-align: left">
                                                        Deskripsi
                                                    </th>
                                                    <th style="width: 15%">Presentase</th>
                                                    <th style="width: 15%">Status</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detailProject as $item)
                                                <tr>
                                                    <td style="text-align: left">
                                                        {{$item->deskripsi}}
                                                    </td>
                                                    <td>{{$item->persentasi}}%</td>
                                                    <td>
                                                        @if($item->status == 'proses')
                                                        <span class="badge bg-warning text-dark">{{$item->status}}</span>
                                                        @elseif($item->status == 'diterima')
                                                        <span class="badge bg-success">{{$item->status}}</span>
                                                        @elseif($item->status == 'revisi')
                                                        <span class="badge bg-danger">{{$item->status}}</span>

                                                        @endif
                                                    </td>
                                                    <td style="overflow: visible;">
                                                        {{-- Tombol langsung memicu modal Revisi --}}
                                                        <button
                                                            {{ $item->status == 'diterima' ? 'disabled' : '' }}
                                                            class="btn btn-sm btn-outline-secondary btn-revisi-laporan"
                                                            type="button"
                                                            data-bs-toggle="modal"
                                                            data-id="{{$item->id}}"
                                                            data-status="{{$item->status}}"
                                                            data-deskripsi="{{$item->deskripsi}}"
                                                            data-persentase="{{$item->persentasi}}"
                                                            data-catatan-revisi="{{$item->revisi}}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH LAPORAN PROJECT --}}
<div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="tambahLaporanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLaporanModalLabel">Tambah Laporan Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="deskripsiLaporan" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsiLaporan" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label for="persentaseLaporan" class="form-label">Persentase (%)</label>
                    <input type="number" class="form-control" id="persentaseLaporan" min="0" max="100">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="simpanLaporanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT LAPORAN PROJECT --}}
<div class="modal fade" id="editLaporanModal" tabindex="-1" aria-labelledby="editLaporanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLaporanModalLabel">Edit Laporan Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editDeskripsiLaporan" class="form-label">Deskripsi</label>
                    <input type="hidden" id="editProjectId">
                    <textarea class="form-control" id="editDeskripsiLaporan" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label for="editPersentaseLaporan" class="form-label">Persentase (%)</label>
                    <input type="number" class="form-control" id="editPersentaseLaporan" min="0" max="100">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="simpanEditBtn">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL KHUSUS REVISI --}}
<div class="modal fade" id="modalRevisi" tabindex="-1" aria-labelledby="modalRevisiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-3 pb-0 border-0 d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-4 pb-4">
                <div class="alert alert-warning d-flex align-items-center mb-4" role="alert" style="background-color: #FFF2CD; border-color: #FFDE7D;">
                    <i class="fas fa-exclamation-triangle me-3" style="color: #F8BC00;"></i>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: #333;">Catatan Revisi :</h6>
                        <p class="mb-0 small" id="catatanRevisiText" style="color: #555;">Persentase yang diinputkan tidak sesuai dengan penjelasan saat meeting</p>
                    </div>
                </div>

                <input type="hidden" id="revisiProjectId">

                <div class="mb-3">
                    <label for="revisiPersentase" class="form-label">Persentase :</label>
                    <input type="number" class="form-control" id="revisiPersentase" min="0" max="100" placeholder="Masukkan persentase baru">
                </div>
                <div class="mb-3">
                    <label for="revisiKeterangan" class="form-label">Keterangan :</label>
                    <textarea class="form-control" id="revisiKeterangan" rows="3" placeholder="Tambahkan keterangan atau penjelasan"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-end border-0 pt-0 pb-3 pe-4">
                <button type="button" class="btn btn-danger" id="simpanRevisiBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- TOAST CONTAINER (Dibiarkan untuk notifikasi error, jika ingin dihapus, semua validasi error harus pakai modal konfirmasi) --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Terjadi kesalahan!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

{{-- MODAL KONFIRMASI BERHASIL --}}
<div class="modal fade" id="successConfirmationModal" tabindex="-1" aria-labelledby="successConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                <h4 class="fw-bold mb-3" id="successConfirmationMessage"></h4>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" style="
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.4);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
">
    <div style="
        background: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        font-weight: bold;
    ">
        <span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
        &nbsp;Loading...
    </div>
</div>


@include('components.user.footer')
@endsection

@section('scripts')
<script>
    // Pastikan Font Awesome sudah terhubung di proyek Anda untuk ikon centang.
    // Contoh: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    // Inisialisasi Toast untuk pesan error (jika masih diperlukan)
    const liveToastElement = document.getElementById('liveToast');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(liveToastElement);

    // Fungsi pembantu untuk menampilkan toast error
    function showToastError(message) {
        liveToastElement.querySelector('.toast-body').textContent = message;
        liveToastElement.classList.remove('bg-success', 'bg-warning'); // Hapus kelas warna lain
        liveToastElement.classList.add('bg-danger'); // Atur menjadi merah untuk error
        toastBootstrap.show();
    }


    // Modal Konfirmasi Berhasil
    const successConfirmationModalElement = document.getElementById('successConfirmationModal');
    const successConfirmationModal = new bootstrap.Modal(successConfirmationModalElement);
    const successConfirmationMessage = document.getElementById('successConfirmationMessage');

    function showSuccessConfirmationModal(message) {
        successConfirmationMessage.textContent = message;
        successConfirmationModal.show();
    }

    // Modal Tambah Laporan Project
    const tambahLaporanModalElement = document.getElementById('tambahLaporanModal');
    const tambahLaporanModal = new bootstrap.Modal(tambahLaporanModalElement);
    const simpanLaporanBtn = document.getElementById('simpanLaporanBtn');
    const deskripsiLaporanInput = document.getElementById('deskripsiLaporan');
    const persentaseLaporanInput = document.getElementById('persentaseLaporan');

    // Modal Edit Laporan Project
    const editLaporanModalElement = document.getElementById('editLaporanModal');
    const editLaporanModal = new bootstrap.Modal(editLaporanModalElement);
    const simpanEditBtn = document.getElementById('simpanEditBtn');
    const editProjectIdInput = document.getElementById('editProjectId');
    const editDeskripsiLaporanInput = document.getElementById('editDeskripsiLaporan');
    const editPersentaseLaporanInput = document.getElementById('editPersentaseLaporan');

    // Modal Khusus Revisi
    const modalRevisiElement = document.getElementById('modalRevisi');
    const modalRevisi = new bootstrap.Modal(modalRevisiElement);
    const revisiProjectIdInput = document.getElementById('revisiProjectId');
    const catatanRevisiText = document.getElementById('catatanRevisiText');
    const revisiPersentaseInput = document.getElementById('revisiPersentase');
    const revisiKeteranganInput = document.getElementById('revisiKeterangan');
    const simpanRevisiBtn = document.getElementById('simpanRevisiBtn');

    // Logika untuk menyimpan laporan project baru
    simpanLaporanBtn.addEventListener('click', function() {
        const deskripsi = deskripsiLaporanInput.value.trim();
        const persentase = persentaseLaporanInput.value;

        if (deskripsi === '') {
            showToastError('Deskripsi tidak boleh kosong!');
            return;
        }
        if (persentase === '' || isNaN(persentase) || persentase < 0 || persentase > 100) {
            showToastError('Persentase harus berupa angka antara 0 dan 100!');
            return;
        }

        document.getElementById('loadingOverlay').style.display = 'flex';

        const data = {
            deskripsi: deskripsi,
            persentase: persentase,
        };

        fetch('/kegiatanku/project-detail/{{$id}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal menyimpan project');
                return response.json();
            })
            .then(result => {
                console.log('Deskripsi yang akan disimpan:', deskripsi);
                console.log('Persentase yang akan disimpan:', persentase);

                document.getElementById('loadingOverlay').style.display = 'none';

                // Sembunyikan modal tambah laporan
                tambahLaporanModalElement.addEventListener('hidden.bs.modal', function handler() {
                    showSuccessConfirmationModal('Berhasil Menambahkan Laporan Project!'); // Tampilkan modal konfirmasi setelah modal input tersembunyi
                    // Setelah modal konfirmasi tertutup, baru reload halaman
                    successConfirmationModalElement.addEventListener('hidden.bs.modal', function reloadHandler() {
                        location.reload();
                        successConfirmationModalElement.removeEventListener('hidden.bs.modal', reloadHandler);
                    });
                    tambahLaporanModalElement.removeEventListener('hidden.bs.modal', handler); // Hapus listener setelah dijalankan
                });
                tambahLaporanModal.hide(); // Panggil hide() untuk menutup modal
            })
            .catch(error => {
                console.error('Error saat menyimpan laporan:', error);
                showToastError('Terjadi kesalahan saat menyimpan laporan.');
            });
    });

    // Logika untuk menyimpan perubahan laporan project
    simpanEditBtn.addEventListener('click', function() {
        const deskripsi = editDeskripsiLaporanInput.value.trim();
        const persentase = editPersentaseLaporanInput.value;
        const id = editProjectIdInput.value;

        if (deskripsi === '') {
            showToastError('Deskripsi tidak boleh kosong!');
            return;
        }
        if (persentase === '' || isNaN(persentase) || persentase < 0 || persentase > 100) {
            showToastError('Persentase harus berupa angka antara 0 dan 100!');
            return;
        }

        document.getElementById('loadingOverlay').style.display = 'flex';

        const data = {
            deskripsi: deskripsi,
            persentase: persentase,
            id: id,
            _method: 'PUT'
        };

        fetch('/kegiatanku/project-detail/{{$id}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal menyimpan project');
                return response.json();
            })
            .then(result => {
                console.log('Deskripsi yang akan disimpan:', deskripsi);
                console.log('Persentase yang akan disimpan:', persentase);

                document.getElementById('loadingOverlay').style.display = 'none';

                // Sembunyikan modal edit laporan
                editLaporanModalElement.addEventListener('hidden.bs.modal', function handler() {
                    showSuccessConfirmationModal('Berhasil Memperbarui Laporan Project!'); // Tampilkan modal konfirmasi
                    // Setelah modal konfirmasi tertutup, baru reload halaman
                    successConfirmationModalElement.addEventListener('hidden.bs.modal', function reloadHandler() {
                        location.reload();
                        successConfirmationModalElement.removeEventListener('hidden.bs.modal', reloadHandler);
                    });
                    editLaporanModalElement.removeEventListener('hidden.bs.modal', handler);
                });
                editLaporanModal.hide(); // Panggil hide() untuk menutup modal
            })
            .catch(error => {
                console.error('Error saat menyimpan laporan:', error);
                showToastError('Terjadi kesalahan saat menyimpan laporan.');
            });
    });

    // Logika untuk menampilkan modal edit atau revisi
    document.addEventListener('click', function(event) {
        const targetElement = event.target.closest('.btn-revisi-laporan');
        if (targetElement) {
            event.preventDefault();

            const projectId = targetElement.dataset.id;
            const projectDeskripsi = targetElement.dataset.deskripsi;
            const projectPersentase = targetElement.dataset.persentase;
            const catatanRevisi = targetElement.dataset.catatanRevisi;
            const projectStatus = targetElement.dataset.status;

            if (projectStatus === 'revisi') {
                revisiProjectIdInput.value = projectId;
                catatanRevisiText.textContent = catatanRevisi;
                revisiPersentaseInput.value = projectPersentase;
                revisiKeteranganInput.value = projectDeskripsi;
                modalRevisi.show();
            } else {
                editProjectIdInput.value = projectId;
                editDeskripsiLaporanInput.value = projectDeskripsi;
                editPersentaseLaporanInput.value = projectPersentase;
                editLaporanModal.show();
            }
        }
    });

    // Logika untuk menyimpan revisi laporan project
    simpanRevisiBtn.addEventListener('click', function() {
        const idToEdit = revisiProjectIdInput.value;
        const newPersentase = revisiPersentaseInput.value;
        const newKeterangan = revisiKeteranganInput.value.trim();

        if (newPersentase === '' || isNaN(newPersentase) || newPersentase < 0 || newPersentase > 100) {
            showToastError('Persentase harus berupa angka antara 0 dan 100!');
            return;
        }
        if (newKeterangan === '') {
            showToastError('Keterangan tidak boleh kosong!');
            return;
        }

        document.getElementById('loadingOverlay').style.display = 'flex';

        const data = {
            deskripsi: newKeterangan,
            persentase: newPersentase,
            revisi: 'ya',
            id: idToEdit,
            _method: 'PUT'
        };

        fetch('/kegiatanku/project-detail/{{$id}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal menyimpan project');
                return response.json();
            })
            .then(result => {

                document.getElementById('loadingOverlay').style.display = 'none';

                modalRevisiElement.addEventListener('hidden.bs.modal', function handler() {
                    showSuccessConfirmationModal('Revisi laporan proyek berhasil disimpan!');
                    successConfirmationModalElement.addEventListener('hidden.bs.modal', function reloadHandler() {
                        location.reload();
                        successConfirmationModalElement.removeEventListener('hidden.bs.modal', reloadHandler);
                    });
                    modalRevisiElement.removeEventListener('hidden.bs.modal', handler);
                });
                modalRevisi.hide(); // Panggil hide() untuk menutup modal
            })
            .catch(error => {
                console.error('Error saat menyimpan laporan:', error);
                showToastError('Terjadi kesalahan saat menyimpan laporan revisi.');
            });
    });

    // Penanganan penutupan modal revisi agar tidak freeze (ini sudah ada dan sudah baik)
    modalRevisiElement.addEventListener('hidden.bs.modal', function() {
        if (document.body.classList.contains('modal-open')) {
            document.body.classList.remove('modal-open');
        }
        document.body.style.overflow = '';
        const modalBackdrop = document.querySelector('.modal-backdrop');
        if (modalBackdrop) {
            modalBackdrop.remove();
        }
    });

    // Logika untuk menutup dropdown saat modal tampil (ini sudah ada dan sudah baik)
    function closeAllOpenDropdowns() {
        const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
        openDropdowns.forEach(dropdown => {
            const dropdownInstance = bootstrap.Dropdown.getInstance(dropdown.previousElementSibling);
            if (dropdownInstance) {
                dropdownInstance.hide();
            }
        });
    }

    const allModals = [tambahLaporanModalElement, editLaporanModalElement, modalRevisiElement, successConfirmationModalElement];
    allModals.forEach(modal => {
        if (modal) {
            modal.addEventListener('show.bs.modal', function() {
                closeAllOpenDropdowns();
            });
        }
    });
</script>
@endsection
