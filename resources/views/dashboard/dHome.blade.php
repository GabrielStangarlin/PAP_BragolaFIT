@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Home')

@section('dContent')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('dashboard.user') }}" class="card-link">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Utilizadores</h6>
                                <h3 class="mb-0">{{ $userCount }}</h3>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('dashboard.products') }}" class="card-link">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Produtos (Variedade)</h6>
                                <h3 class="mb-0">{{ $productCount }}</h3>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/db/list/order" class="card-link">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Encomendas</h6>
                                <h3 class="mb-0">{{ $orderCount }}</h3>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mt-5 col-xl-8 col-lg-7">
            <div class="card shadow">
                <canvas class="mt-3" style="max-height: 400px;" id="myChart"></canvas>
            </div>
        </div>
        <div class="mt-5 col-xl-4 col-lg-5">
            <div class="card shadow">
                <canvas class="mt-3" style="max-height: 400px;" id="myDoughnutChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/product-subcategories')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.name);
                    const productCounts = data.map(item => item.product_count);

                    const ctx = document.getElementById('myChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Variedade de Produtos',
                                data: productCounts,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1 // Define o incremento de 1 em 1
                                    }
                                }
                            }
                        }
                    });
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myDoughnutChart').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Utilizadores', 'Encomendas'],
                    datasets: [{
                        data: [{{ $userCount }}, {{ $orderCount }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        }
                    }
                }
            });
        });
    </script>
@endsection
