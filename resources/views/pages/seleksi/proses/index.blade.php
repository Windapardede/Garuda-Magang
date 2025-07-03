@extends('layouts.app')

@section('title', 'Seleksi Proses')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<style>
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-proses {
        background-color: #c7d7fe;
        color: #3b82f6;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0;
        margin: 0;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
    }

    .icon-button:hover {
        background: #e2e8f0;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        vertical-align: middle;
        text-align: center;
    }

    .table thead th:first-child {
        text-align: left;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table tbody td:nth-child(11) {
        /* Kolom Aksi */
        text-align: center;
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
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



    .eye-button {
        background: none;
        border: none;
        color: #000000;
        font-size: 18px;
        cursor: pointer;
    }

    .eye-button:hover {
        color: #000000;
    }



    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height: calc(100% - (1.75rem * 2));
            max-width: 450px;
            margin: 1.75rem auto;
        }
    }
</style>
@endpush

@section('main')


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Seleksi Proses</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Seleksi Proses</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert') {{-- Pastikan alert include berfungsi --}}

            <div class="row mb-4 align-items-center">
                <form action="{{ route('seleksiproses.index') }}" method="GET" style="width: 100%;display: flex;">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="mr-2 mb-0">Show</label>
                        <select class="form-control form-control-sm" style="width: 80px;"  name="show" onchange="this.form.submit()">
                            @foreach($limit as $limitv)
                            <option value="{{ $limitv }}" {{ request('show') == $limitv ? 'selected' : '' }}>
                                {{ $limitv}}
                            </option>
                            @endforeach
                        </select>
                        <label class="ml-2 mb-0">entries</label>
                    </div>

                    <div class="col-md-10">
                        {{-- Form Pencarian (tidak berfungsi dengan data dummy di Blade) --}}

                            <div class="position-relative">
                                <span class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); color: #aaa;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" name="search"
                                    class="form-control pl-5 shadow-sm"
                                    value="{{ request('search') }}"
                                    placeholder="Search Nama Pendaftar..." style="height: 45px;">
                            </div>

                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Posisi</th>
                            <th>Seleksi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proses as $i => $item)
                        <tr >
                            <td>{{ $proses->firstItem() + $i }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ @$item->nama->posisi->nama }}</td>
                            <td>
                                @php $url = ''; @endphp
                                @if($item->status_administrasi == 'belumDiproses')
                                    Seleksi Administrasi
                                    @php $url = 'administrasi'; @endphp
                                @elseif($item->status_tes_kemampuan == 'belumDiproses')
                                    Seleksi Tes kemampuan
                                    @php $url = 'kemampuan'; @endphp
                                @elseif($item->status_wawancara == 'belumDiproses')
                                    Seleksi Wawancara
                                    @php $url = 'wawancara'; @endphp
                                @endif

                            </td>
                            <td>
                                <span class="badge-status badge-proses">Proses</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ url($url.'?status=belumDiproses') }}" class="icon-button" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="float-right mt-3">
                {{ $proses->links() }}
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Pastikan semua library ini dimuat dengan benar --}}
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
        // Tidak ada script khusus yang diperlukan untuk tampilan ini.
    });
</script>
@endpush
