@extends('layouts.app')

@section('title', 'Kemampuan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Soal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kemampuan.index') }}">Kemampuan</a></div>
                <div class="breadcrumb-item active">Tambah Soal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('kemampuan.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('soal') is-invalid @enderror" id="deskripsi" name="deskripsi" style="height:80px" required>{{ old('deskripsi', @$soal->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="id" value="{{ $id }}">

                        <div class="form-group">
                            <label for="tanggal_awal_seleksi">Tanggal Awal Seleksi</label>
                            <input type="date"
                                class="form-control @error('tanggal_awal_seleksi') is-invalid @enderror"
                                id="tanggal_awal_seleksi"
                                name="tanggal_awal_seleksi"
                                value="{{ old('tanggal_awal_seleksi', @$soal->tanggal_mulai) }}"
                                min="{{ date('Y-m-d') }}"
                                required>
                            @error('tanggal_awal_seleksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir_seleksi">Tanggal Akhir Seleksi</label>
                            <input type="date"
                                class="form-control @error('tanggal_akhir_seleksi') is-invalid @enderror"
                                id="tanggal_akhir_seleksi"
                                name="tanggal_akhir_seleksi"
                                value="{{ old('tanggal_akhir_seleksi', @$soal->tanggal_selesai) }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                required>
                            @error('tanggal_akhir_seleksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="soal">Soal</label>
                            <textarea class="form-control @error('soal') is-invalid @enderror" id="soal" name="soal" style="height:330px" required>{{ old('soal', @$soal->soal) }}</textarea>
                            @error('soal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@endpush
