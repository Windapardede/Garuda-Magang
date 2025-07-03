@extends('layouts.apphrd')

@section('title', 'Alumni Magang')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        position: relative;
        /* Untuk menjadi containing block bagi ikon yang diposisikan absolute */
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0 5px;
        display: inline-flex;
        /* Atau display: inline-block; jika tidak ingin flexbox mempengaruhi layout lain */
        align-items: center;
        justify-content: center;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .icon-button:hover {
        background: #e2e8f0;
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

    .dropdown-toggle::after {
        display: none !important;
    }

    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.2);
        background-color: transparent !important;
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

    @media (max-width: 768px) {
        .flex-wrap .form-control {
            margin-bottom: 10px;
        }
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Alumni Magang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Alumni Magang</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <!-- Show entries -->
                <div class="d-flex align-items-center mr-2 mb-2">
                    <label class="mb-0 mr-2">Show</label>
                    <select class="form-control form-control-sm" style="width: 80px; height: 38px;">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <label class="mb-0 ml-2">entries</label>
                </div>

                <!-- Search -->
                <form action="{{ route('alumnimagang.index') }}" method="GET" class="mr-2 mb-2" style="flex-grow: 1; max-width: 730px;">
                    <div class="position-relative">
                        <span class="position-absolute" style="top: 50%; left: 10px; transform: translateY(-50%); color: #aaa; font-size: 13px;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control pl-4" style="height: 45px; font-size: 13px; padding-left: 30px;"
                            placeholder="Search Nama Pendaftar...">
                    </div>
                </form>

                <!-- Filter posisi -->
                <form action="{{ route('alumnimagang.index') }}" method="GET" class="mr-2 mb-2">
                    <select name="position" class="form-control form-control-sm" style="height: 45px;" onchange="this.form.submit()">
                        <option value="">Semua Posisi</option>
                        @foreach($alumnimagang as $item)
                        <option value="{{ $item->id }}" {{ request('position') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama->posisi->nama }}
                        </option>
                        @endforeach
                    </select>
                </form>

                <!-- Export PDF -->
                <a href="{{ route('alumnimagang.export.pdf') }}"
                    class="btn btn-primary btn-sm d-flex align-items-center justify-content-center mb-2 rounded"
                    style="height: 45px; font-size: 13px; width: 120px;" target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>

            </div>



            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Posisi</th>
                            <th>Periode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnimagang as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ $item->nama->instansi->nama }}</td>
                            <td>{{ $item->nama->posisi->nama}}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->periode->tanggal_pegajuan)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($item->periode->tanggal_selesai)->translatedFormat('d M Y') }}
                            </td>
                            @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')


@endpush