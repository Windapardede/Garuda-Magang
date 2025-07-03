@extends('layouts.app')

@section('title', 'Tambah Template Kriteria Penilaian')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<style>
    .main-content {
        margin-top: 30px;
    }

    .card-custom {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
    }

    .card-title-custom {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: bold;
        color: #555;
        margin-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .form-group-custom {
        margin-bottom: 15px;
    }

    .form-group-custom label {
        display: block;
        font-size: 14px;
        color: #777;
        margin-bottom: 5px;
    }

    .form-control-custom {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }

    .btn-add-kriteria {
        background-color: #e0e0e0;
        color: #333;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .btn-add-kriteria:hover {
        background-color: #c0c0c0;
    }

    .btn-danger-custom {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 10px;
    }

    .btn-danger-custom:hover {
        background-color: #d32f2f;
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-secondary-custom {
        background-color: #b0bec5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background-color: #78909c;
    }

    .btn-primary-custom {
        background-color: #333A48;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary-custom:hover {
        background-color: #333A48;
    }

    .kriteria-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    /* Gaya tambahan untuk menampilkan form berdampingan */
    .row-flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        /* Menambahkan jarak antara kolom */
    }

    .col-md-6 {
        flex: 0 0 calc(50% - 10px);
        /* Lebar 50% dikurangi jarak antar kolom */
        max-width: calc(50% - 10px);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: bold;
        color: #555;
        margin-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    #personal-criteria-container,
    #kompetensi-criteria-container {
        margin-bottom: 15px;
    }

    .kriteria-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-group-custom {
        margin-right: 10px;
        /* Memberi jarak pada input dan button */
        flex: 1;
        /* Membuat input mengisi ruang yang tersedia */
    }

    .form-control-custom {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }

    .btn-danger-custom {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-danger-custom:hover {
        background-color: #d32f2f;
    }

    .btn-add-kriteria {
        background-color: #e0e0e0;
        color: #333;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        width: 100%;
        /* Lebar penuh */
        text-align: center;
        /* Teks tengah */
    }

    .btn-add-kriteria:hover {
        background-color: #c0c0c0;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Tambah Template Kriteria Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kriteriapenilaian.index') }}">Template Kriteria Penilaian</a></div>
                <div class="breadcrumb-item">Tambah Template Kriteria Penilaian</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')
            <div class="card card-custom">
                <h2 class="card-title-custom">{{$item->nama}}</h2> {{-- Ini Nama Posisi, nanti diganti dengan data dari controller --}}

                <form action="{{ route('kriteriapenilaian.edit.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="row row-flex">
                        <div class="col-md-6">
                            <div class="form-section">
                                <h3 class="form-section-title">Personal</h3>
                                <div id="personal-criteria-container">
                                    <div class="kriteria-item">
                                        <div class="form-group-custom">
                                            <label>Komponen Penilaian</label>
                                            <input type="text" name="personal[]" class="form-control-custom" required>
                                        </div>
                                        <button type="button" class="btn-danger-custom remove-kriteria-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn-add-kriteria" id="add-personal-kriteria">
                                    + Tambah Kriteria Lainnya
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-section">
                                <h3 class="form-section-title">Kompetensi</h3>
                                <div id="kompetensi-criteria-container">
                                    <div class="kriteria-item">
                                        <div class="form-group-custom">
                                            <label>Komponen Penilaian</label>
                                            <input type="text" name="kompetensi[]" class="form-control-custom" required>
                                        </div>
                                        <button type="button" class="btn-danger-custom remove-kriteria-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn-add-kriteria" id="add-kompetensi-kriteria">
                                    + Tambah Kriteria Lainnya
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('kriteriapenilaian.index') }}" class="btn btn-secondary-custom">Kembali</a>
                        <button type="submit" class="btn btn-primary-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    var dataitem = @json($itemKriterial);


    $(document).ready(function() {

        // Fungsi untuk menambahkan input kriteria baru
        function addKriteriaInput(containerId, inputName) {
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'kriteria-item';
            newInputGroup.innerHTML = `
                    <div class="form-group-custom">
                        <label>Komponen Penilaian</label>
                        <input type="text" name="${inputName}[]" class="form-control-custom" required>
                    </div>
                    <button type="button" class="btn-danger-custom remove-kriteria-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
            document.getElementById(containerId).appendChild(newInputGroup);
        }

        // Event listener untuk tombol "Tambah Kriteria Lainnya"
        $('#add-personal-kriteria').on('click', function() {
            addKriteriaInput('personal-criteria-container', 'personal');
        });

        $('#add-kompetensi-kriteria').on('click', function() {
            addKriteriaInput('kompetensi-criteria-container', 'kompetensi');
        });

        // Event listener untuk tombol hapus kriteria
        $(document).on('click', '.remove-kriteria-btn', function() {
            $(this).closest('.kriteria-item').remove();
        });

        if( dataitem.length > 0) {
            $('.kriteria-item').remove();
        }

        dataitem.forEach(function(item) {
            // Tambahkan input kriteria personal
            if (item.evaluation_type === 'personal') {
                addKriteriaInput('personal-criteria-container', 'personal');
                $('#personal-criteria-container .kriteria-item:last-child input').val(item.evaluation_name);
            }
            // Tambahkan input kriteria kompetensi
            else if (item.evaluation_type === 'competence') {
                addKriteriaInput('kompetensi-criteria-container', 'kompetensi');
                $('#kompetensi-criteria-container .kriteria-item:last-child input').val(item.evaluation_name);
            }
        });
    });
</script>
@endpush
