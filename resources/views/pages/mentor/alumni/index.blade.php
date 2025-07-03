@extends('layouts.appmentor')

@section('title', 'Alumni Magang')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<style>
    /* Custom styles provided by the user */
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
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0 5px;
        display: inline-flex;
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

    /* New styles for Export Modal - More modern look */
    .export-modal .modal-content {
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .export-modal .modal-header {
        border-bottom: none;
        padding: 0 0 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .export-modal .modal-header h5 {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0;
    }

    .export-modal .modal-header .close {
        font-size: 2rem;
        color: #95a5a6;
        opacity: 0.7;
        transition: opacity 0.2s ease-in-out;
    }

    .export-modal .modal-header .close:hover {
        opacity: 1;
        color: #7f8c8d;
    }

    .export-modal .modal-body {
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .export-modal .form-group {
        margin-bottom: 20px;
    }

    .export-modal .form-group:last-of-type {
        margin-bottom: 0;
    }

    .export-modal .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #34495e;
        font-size: 15px;
    }

    .export-modal .form-control {
        border-radius: 8px;
        height: 48px;
        font-size: 16px;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
        /* Default padding */
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    /* Specific padding for select elements to adjust arrow position */
    .export-modal .form-group select.form-control {
        padding-right: 30px;
        /* Increased padding on the right for select elements */
    }

    .export-modal .form-control:focus {
        border-color: #85b7d9;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        outline: none;
    }

    .export-modal .date-inputs {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .export-modal .date-inputs>div {
        flex: 1;
        min-width: 180px;
    }

    .export-modal .sort-options {
        display: flex;
        align-items: center;
        margin-top: 5px;
    }

    .export-modal .sort-options .form-check-inline {
        margin-right: 25px;
        display: flex;
        /* Use flex to align radio and label */
        align-items: center;
        /* Vertically center radio and label */
    }

    .export-modal .sort-options .form-check-inline:last-child {
        margin-right: 0;
    }

    .export-modal .sort-options .form-check-input {
        margin-top: 0;
        /* Remove default margin-top */
        margin-right: 8px;
        /* Space between radio button and label */
        transform: scale(1.1);
    }

    .export-modal .sort-options .form-check-label {
        font-size: 16px;
        color: #34495e;
        margin-bottom: 0;
        /* Remove default margin-bottom */
    }

    .export-modal .modal-footer {
        border-top: none;
        padding: 30px 0 0 0;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .export-modal .btn {
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .export-modal .btn-secondary-custom {
        background-color: #ecf0f1;
        color: #34495e;
        border: 1px solid #bdc3c7;
    }

    .export-modal .btn-secondary-custom:hover {
        background-color: #dfe6e9;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .export-modal .btn-primary-custom {
        background-color: #3498db;
        color: #fff;
        border: none;
    }

    .export-modal .btn-primary-custom:hover {
        background-color: #2980b9;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    /* Adjust modal width for this specific modal */
    .export-modal .modal-dialog {
        max-width: 650px;
    }

    /* Reverted Datepicker Styles to a simpler, less opinionated version */
    .ui-datepicker {
        z-index: 9999 !important;
        /* Ensure it's above other elements */
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

                <form action="{{ route('dataalumni.index') }}" method="GET" class="mr-2 mb-2" style="width: 100%;display: flex;flex-direction: row;">
                    <div class="d-flex align-items-center mr-2 mb-2">
                        <label class="mb-0 mr-2">Show</label>
                        <select class="form-control form-control-sm" name="show" style="width: 80px; height: 38px;" onchange="this.form.submit()">
                            @foreach($limit as $limitv)
                            <option value="{{ $limitv }}" {{ request('show') == $limitv ? 'selected' : '' }}>
                                {{ $limitv}}
                            </option>
                            @endforeach
                        </select>
                        <label class="mb-0 ml-2">entries</label>
                    </div>

                    <div style="flex-grow: 1; max-width: 730px;">
                        <div class="position-relative">
                            <span class="position-absolute" style="top: 50%; left: 10px; transform: translateY(-50%); color: #aaa; font-size: 13px;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control pl-4" style="height: 45px; font-size: 13px; padding-left: 30px;"
                                placeholder="Search Nama Pendaftar...">
                        </div>
                    </div>


                    <div style="flex-grow: 1; max-width: 730px;">
                        <select name="position" class="form-control form-control-sm" style="height: 45px;" onchange="this.form.submit()">
                            <option value="">Semua Posisi</option>
                            @foreach($uniquePositions as $position)
                            <option value="{{ $position->id }}" {{ request('position') == $position->id ? 'selected' : '' }}>
                                {{ $position->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center mb-2 rounded"
                        style="height: 45px; font-size: 13px; width: 120px;" data-toggle="modal" data-target="#exportModal">
                        <i class="fas fa-file-pdf mr-2"></i> Export PDF
                    </button>
                </form>

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
                            <td>{{ $alumnimagang->firstItem() + $i }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ @$item->nama->instansi->nama }}</td>
                            <td>{{ @$item->nama->posisi->nama}}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->nama->mulai_magang)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($item->nama->selesai_magang)->translatedFormat('d M Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $alumnimagang->links() }}
                </div>
            </div>

        </div>
    </section>
</div>

<div class="modal fade export-modal" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Filter Export Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dataalumni.export.pdf') }}" method="GET" target="_blank" id="exportForm">
                    <div class="form-group">
                        <div class="date-inputs">
                            <div>
                                <label for="startDate">Tanggal Mulai Magang :</label>
                                <input type="text" autocomplete="off" class="form-control" id="startDate" name="start_date" placeholder="DD/MM/YYYY">
                            </div>
                            <div>
                                <label for="endDate">Tanggal Selesai Magang :</label>
                                <input type="text" autocomplete="off" class="form-control" id="endDate" name="end_date" placeholder="DD/MM/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="positionFilter">Posisi</label>
                        <select class="form-control" id="positionFilter" name="position">
                            <option value="">Semua Data</option>
                            @foreach($uniquePositions as $position)
                            <option value="{{ $position->id }}">{{ $position->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="instansiFilter">Instansi</label>
                        <select class="form-control" id="instansiFilter" name="instansi">
                            <option value="">Semua Data</option>
                            @foreach($uniqueInstansi as $instansi)
                            <option value="{{ $instansi->id }}">{{ $instansi->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sort</label>
                        <div class="sort-options">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_order" id="sortAscending" value="asc" checked>
                                <label class="form-check-label" for="sortAscending">Ascending</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_order" id="sortDescending" value="desc">
                                <label class="form-check-label" for="sortDescending">Descending</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-custom" onclick="resetExportForm()">Reset</button>
                <button type="button" class="btn btn-primary-custom" onclick="submitExportForm()">Export</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    // Inisialisasi datepicker setelah dokumen siap
    $(function() {
        $("#startDate").datepicker({
            dateFormat: 'dd/mm/yy', // Format tanggal yang diinginkan
            changeMonth: true, // Memungkinkan perubahan bulan
            changeYear: true, // Memungkinkan perubahan tahun
            yearRange: 'c-10:c+10', // Rentang tahun (10 tahun ke belakang dan 10 tahun ke depan dari tahun saat ini)
            appendTo: ".export-modal .modal-body" // Memastikan datepicker muncul di dalam modal body
        });
        $("#endDate").datepicker({
            dateFormat: 'dd/mm/yy', // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: 'c-10:c+10',
            appendTo: ".export-modal .modal-body" // Memastikan datepicker muncul di dalam modal body
        });
    });

    // Function to reset the form inside the modal
    function resetExportForm() {
        document.getElementById('exportForm').reset();
        // Optionally, manually set default values if reset() doesn't cover everything
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
        document.getElementById('positionFilter').value = '';
        document.getElementById('instansiFilter').value = '';
        document.getElementById('sortAscending').checked = true; // Ensure Ascending is checked by default
    }

    // Function to submit the form inside the modal
    function submitExportForm() {
        // Get the form element
        const form = document.getElementById('exportForm');
        // Submit the form
        form.submit();
        // Close the modal after submission (optional, depends on desired UX)
        $('#exportModal').modal('hide');
    }
</script>
@endpush
