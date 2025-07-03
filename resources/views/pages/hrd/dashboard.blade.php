@extends('layouts.apphrd')

@section('main')
<div class="main-content">
    <div class="section-body">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm text-center border-0 rounded-lg">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #0033cc;">
                                    <i class="fas fa-user-friends fa-2x text-white"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">50</h3>
                            <p class="text-muted mb-1">Total Peserta Magang Aktif</p>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar rounded-pill" style="width: 50%; background-color: #0033cc;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center border-0 rounded-lg">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #6f42c1;">
                                    <i class="fas fa-clipboard-list fa-2x text-white"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">60</h3>
                            <p class="text-muted mb-1">Total Pendaftar Magang</p>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar rounded-pill" style="width: 60%; background-color: #6f42c1;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center border-0 rounded-lg">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #198754;">
                                    <i class="fas fa-graduation-cap fa-2x text-white"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">70</h3>
                            <p class="text-muted mb-1">Total Alumni Magang</p>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar rounded-pill bg-success" style="width: 70%; background-color: #198754;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4"> {{-- Tambahkan margin-top untuk memberi jarak dengan card di atas --}}
                <div class="col-md-12"> {{-- Grafik akan menempati seluruh lebar di bawah card --}}
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
                    data: [10, 15, 12, 18, 20, 25, 22, 28, 30, 35, 32, 40], // Contoh data
                    borderColor: '#0033cc',
                    backgroundColor: '#0033cc',
                    fill: false,
                    tension: 0.3,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Total Pendaftar Magang',
                    data: [20, 25, 23, 30, 35, 40, 38, 45, 50, 55, 52, 60], // Contoh data
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