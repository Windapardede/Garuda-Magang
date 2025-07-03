@extends('layouts.appmentor')

@section('title', 'Penilaian')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
{{-- Memperbaiki atribut xintegrity menjadi integrity --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" xintegrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* CSS yang sama persis seperti sebelumnya */
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-active {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-inactive {
        background-color: #fce7f3;
        color: #db2777;
    }

    /* Mengambil gaya .icon-button dari posisi.blade.php untuk konsistensi */
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
        margin: 0 5px;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
    }

    .icon-button:hover {
        background: #e2e8f0;
    }

    /* Menyesuaikan dropdown-toggle agar menggunakan gaya icon-button */
    .dropdown-toggle.icon-dropdown-action {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0;
        /* Menghilangkan padding bawaan tombol Bootstrap */

        /* Kunci untuk centering ikon yang lebih baik */
        display: flex;
        align-items: center;
        /* Rata tengah vertikal */
        justify-content: center;
        /* Rata tengah horizontal */
        position: relative;
        /* Diperlukan untuk transform atau penyesuaian mikro */
    }

    .dropdown-toggle.icon-dropdown-action i {
        font-size: 18px;
        color: #64748b;
        line-height: 1;
        /* Penting untuk menghilangkan spasi vertikal font */
        /* Jika masih belum sempurna, coba salah satu dari ini (uncomment dan sesuaikan nilai): */
        /* transform: translateY(0.5px); */
        /* Geser sedikit ke bawah */
        /* margin-top: -1px; */
        /* Geser sedikit ke atas */
    }

    .dropdown-toggle.icon-dropdown-action:hover {
        background: #e2e8f0;
    }

    .dropdown-toggle.icon-dropdown-action::after {
        display: none !important;
        /* Menghilangkan ikon panah default dropdown Bootstrap */
    }


    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        text-align: left;
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
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

    .align-middle {
        vertical-align: middle !important;
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
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Penilaian</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')
            {{-- Bagian ini dikosongkan karena tombol "Tambah Penilaian" dihapus --}}
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-rounded" id="tabel-penilaian">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Mentor</th>
                        <th class="text-center align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($penilaianmentor as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="align-middle">
                            {{ $item['user_name'] }}
                        </td>
                        <td class="align-middle">
                            {{ $item['email'] }}
                        </td>
                        <td class="align-middle">
                            {{ $item['nama_posisi'] }}
                        </td>
                        <td class="align-middle">
                            {{ $item['nama'] }}
                        </td>
                        <td class="text-center align-middle">
                            <div class="dropdown">
                                {{-- Menggunakan kelas icon-dropdown-action untuk meniru gaya icon-button dari posisi.blade.php --}}
                                <button class="dropdown-toggle icon-dropdown-action" type="button" id="aksiDropdownPenilaian{{ $item['id'] }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bars"></i> {{-- Menggunakan fas fa-bars untuk ikon menu burger --}}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdownPenilaian{{ $item['id'] }}">
                                    {{-- Mengarahkan ke halaman create --}}
                                    <a href="{{ route('penilaianmentor.create', 'id='.$item['id']) }}" class="dropdown-item">
                                        <i class="bi bi-pencil"></i> Input Nilai
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    {{-- Mengarahkan ke halaman show --}}
                                    <a href="{{ route('penilaianmentor.show', $item['id']) }}" class="dropdown-item">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data penilaian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Jika ada pagination --}}
        {{-- <div class="float-right mt-3">
            {{ $penilaian->links() }}
</div> --}}

</section>
</div>
@endsection

@push('scripts')
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
    // Script tambahan jika diperlukan untuk fungsionalitas lain
</script>
@endpush
