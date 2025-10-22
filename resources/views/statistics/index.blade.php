@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Thống kê vòng quay</h1>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Tổng lượt quay</h5>
                    <h2>{{ number_format($totalSpins) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Tổng người chơi</h5>
                    <h2>{{ number_format($totalUsers) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ lượt quay 30 ngày -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Biểu đồ lượt quay 30 ngày gần nhất</h5>
        </div>
        <div class="card-body">
            <canvas id="spinChart" height="100"></canvas>
        </div>
    </div>

    <!-- Biểu đồ phân bố theo giờ -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Phân bố lượt quay theo giờ (7 ngày qua)</h5>
        </div>
        <div class="card-body">
            <canvas id="hourlyChart" height="100"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Thống kê phần thưởng -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Thống kê phần thưởng</h5>
                </div>
                <div class="card-body">
                    <canvas id="prizeChart" height="200"></canvas>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Phần thưởng</th>
                                    <th>Số lần</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prizeStats as $p)
                                    <tr>
                                        <td>{{ $p->result }}</td>
                                        <td>{{ number_format($p->total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lượt quay 7 ngày -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Lượt quay 7 ngày gần nhất</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Số lượt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentDailyStats as $d)
                                    <tr>
                                        <td>{{ $d->date }}</td>
                                        <td>{{ number_format($d->total) }}</td>
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

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Biểu đồ lượt quay theo ngày
    new Chart(document.getElementById('spinChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Lượt quay',
                data: @json($chartData['spins']),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Biểu đồ phân bố theo giờ
    new Chart(document.getElementById('hourlyChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: Array.from({length: 24}, (_, i) => i + 'h'),
            datasets: [{
                label: 'Lượt quay',
                data: @json($hourlyData),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Biểu đồ phần thưởng
    new Chart(document.getElementById('prizeChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: @json($prizeStats->pluck('result')),
            datasets: [{
                data: @json($prizeStats->pluck('total')),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(199, 199, 199, 0.8)',
                    'rgba(83, 102, 255, 0.8)',
                    'rgba(40, 159, 64, 0.8)',
                    'rgba(210, 199, 199, 0.8)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
});
</script>
@endpush
