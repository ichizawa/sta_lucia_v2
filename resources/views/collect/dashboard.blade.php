@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Dashboard</h3>
                <h6 class="op-7 mb-2">Tenant Billing System</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fa-solid fa-money-bills"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Collected Bill this Month</p>
                                    <h4 class="card-title">58</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pending Payments</p>
                                    <h4 class="card-title">60</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Overdue Payments</p>
                                    <h4 class="card-title">30</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Tenants Paid</p>
                                    <h4 class="card-title">48/60</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex">
                <div class="d-flex justify-content-between w-100 align-items-stretch">
                    <div class="col-md-8 me-4">
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">Monthly Billing Collection Summary</div>
                                    <div class="card-tools">
                                        <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                            <span class="btn-label">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            Export
                                        </a>
                                        <a href="#" class="btn btn-label-info btn-round btn-sm">
                                            <span class="btn-label">
                                                <i class="fa fa-print"></i>
                                            </span>
                                            Print
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <canvas id="billingBarChart"></canvas>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const ctx = document.getElementById('billingBarChart').getContext('2d');
                                    const billingBarChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                                            datasets: [{
                                                    label: 'Paid (₱)',
                                                    data: [120000, 150000, 130000, 145000, 160000, 170000, 155000, 180000],
                                                    backgroundColor: '#36A2EB'
                                                },
                                                {
                                                    label: 'Unpaid (₱)',
                                                    data: [20000, 15000, 25000, 18000, 10000, 8000, 12000, 5000],
                                                    backgroundColor: '#FF6384'
                                                }
                                            ]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        callback: function(value) {
                                                            return value.toLocaleString();
                                                        }
                                                    },
                                                    title: {
                                                        display: false,
                                                        text: 'Amount in PHP'
                                                    }
                                                },
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Month'
                                                    }
                                                }
                                            },
                                            plugins: {
                                                title: {
                                                    display: false,
                                                    text: 'Billing Collection Summary (Paid | Unpaid)'
                                                },
                                                legend: {
                                                    position: 'bottom'
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 ms-2">
                        <div class="card card-round p-1">
                            <div class="card-header">
                                <div class="card-title">Payment Method Breakdown</div>
                            </div>
                            <div class="card-body">
                                <div style="height: 364px;"
                                    class="d-flex justify-content-center align-items-center collect-doughnut-chart">
                                    <canvas id="paymentMethodChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            const ctxPie = document.getElementById('paymentMethodChart').getContext('2d');
                            const paymentMethodChart = new Chart(ctxPie, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Cash', 'Bank Transfer', 'Check'],
                                    datasets: [{
                                        data: [40, 35, 25],
                                        backgroundColor: ['#4CAF50', '#2196F3', '#FFC107']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom'
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    return context.label + ': ' + context.parsed + '%';
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
