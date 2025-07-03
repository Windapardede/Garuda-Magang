@extends('layouts.app')

@section('main')
<style>
    /* New modern card styles */
    .card.modern-card {
        border-radius: 1rem;
        /* Sudut lebih bulat */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08), 0 6px 6px rgba(0, 0, 0, 0.05);
        /* Shadow lebih lembut dan terangkat */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        /* Efek transisi saat hover */
        border: none;
        /* Hilangkan border bawaan */
        overflow: hidden;
        /* Pastikan konten tidak keluar dari radius */
    }

    .card.modern-card:hover {
        transform: translateY(-5px);
        /* Sedikit terangkat saat hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15), 0 8px 8px rgba(0, 0, 0, 0.08);
        /* Shadow sedikit lebih jelas saat hover */
    }

    /* Tambahkan style untuk link yang membungkus card */
    .card-link {
        text-decoration: none;
        /* Hilangkan garis bawah pada link */
        color: inherit;
        /* Warisi warna teks dari parent */
        display: block;
        /* Agar link memenuhi seluruh area card */
    }

    .card.modern-card .card-body {
        padding: 1.5rem;
        /* Padding internal lebih besar */
    }

    .card.modern-card .icon-circle {
        width: 60px;
        /* Ukuran lingkaran ikon lebih besar */
        height: 60px;
        /* Ukuran lingkaran ikon lebih besar */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 0.75rem;
        /* Jarak bawah ikon */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* Shadow ringan pada ikon */
    }

    .card.modern-card .icon-circle i {
        font-size: 2.2rem;
        /* Ukuran ikon di dalam lingkaran */
    }

    .card.modern-card h3 {
        font-size: 2.2rem;
        /* Ukuran angka lebih besar */
        font-weight: 700;
        /* Lebih tebal */
        color: #343a40;
        /* Warna teks yang kuat */
        margin-bottom: 0.25rem;
        /* Jarak angka ke teks di bawahnya */
    }

    .card.modern-card p.text-muted {
        font-size: 0.95rem;
        /* Ukuran teks deskripsi */
        color: #6c757d;
        /* Warna abu-abu yang lebih lembut */
        margin-bottom: 1rem;
        /* Jarak ke progress bar */
    }

    .card.modern-card .progress {
        height: 10px;
        /* Progress bar sedikit lebih tinggi */
        border-radius: 5px;
        /* Progress bar lebih bulat */
        background-color: #e9ecef;
        /* Warna latar belakang progress bar */
    }

    .card.modern-card .progress-bar {
        border-radius: 5px;
        /* Progress bar lebih bulat */
    }

    /* Override some specific colors if needed (optional) */
    .bg-blue-custom {
        background-color: #0033cc !important;
    }

    .bg-purple-custom {
        background-color: #6f42c1 !important;
    }

    .bg-green-custom {
        background-color: #198754 !important;
    }
</style>

<div class="main-content">
    <div class="section-body">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    {{-- Card untuk Total Peserta Magang Aktif --}}
                    <a href="{{ route('pesertamagangaktif.index') }}" class="card-link"> {{-- Tambahkan tag <a> dan href="#" --}}
                        <div class="card modern-card text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <div class="icon-circle bg-blue-custom">
                                        <i class="fas fa-user-friends text-white"></i>
                                    </div>
                                </div>
                                <h3 class="mb-0">{{$data['magang_aktif']}}</h3>
                                <p class="text-muted mb-1">Total Peserta Magang Aktif</p>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%; background-color: #0033cc;"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    {{-- Card untuk Total Pendaftar Magang --}}
                    <a href="{{ route('pendaftarmagang.index') }}" class="card-link"> {{-- Tambahkan tag <a> dan href="#" --}}
                        <div class="card modern-card text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <div class="icon-circle bg-purple-custom">
                                        <i class="fas fa-clipboard-list text-white"></i>
                                    </div>
                                </div>
                                <h3 class="mb-0">{{$data['total_pendaftar']}}</h3>
                                <p class="text-muted mb-1">Total Pendaftar Magang</p>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 60%; background-color: #6f42c1;"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    {{-- Card untuk Total Seleksi Proses --}}
                    <a href="{{ route('seleksiproses.index') }}" class="card-link"> {{-- Tambahkan tag <a> dan href="#" --}}
                        <div class="card modern-card text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <div class="icon-circle bg-purple-custom">
                                        <i class="fas fa-hourglass text-white"></i>
                                    </div>
                                </div>
                                <h3 class="mb-0">{{$data['total_proses']}}</h3>
                                <p class="text-muted mb-1">Total Seleksi Proses</p>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 60%; background-color: #6f42c1;"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    {{-- Card untuk Total Alumni Magang --}}
                    <a href="{{ route('alumnimagang.index') }}" class="card-link"> {{-- Tambahkan tag <a> dan href="#" --}}
                        <div class="card modern-card text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <div class="icon-circle bg-green-custom">
                                        <i class="fas fa-graduation-cap text-white"></i>
                                    </div>
                                </div>
                                <h3 class="mb-0">{{$data['total_alumni']}}</h3>
                                <p class="text-muted mb-1">Total Alumni Magang</p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width: 70%; background-color: #198754;"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-body">
                            <canvas id="magangChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('magangChart').getContext('2d');
    const magangChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                    label: 'Total Peserta Magang Aktif',
                    data: {!! json_encode($data['grafik']['dataAktif']) !!},
                    borderColor: '#0033cc',
                    backgroundColor: '#0033cc',
                    fill: false,
                    tension: 0.3,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Total Pendaftar Magang',
                    data: {!! json_encode($data['grafik']['dataPendaftar']) !!},
                    borderColor: '#dc3545',
                    backgroundColor: '#dc3545',
                    fill: false,
                    tension: 0.3,
                    pointRadius: 3,
                    pointHoverRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
</script>
@endpush
