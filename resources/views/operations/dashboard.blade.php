@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Dashboard</h3>
                <h6 class="op-7 mb-2">Operations System</h6>
            </div>
        </div>
        <div class="row">
            <div>
                <div class="row row-card-no-pd">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fa-solid fa-file-contract"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Work Permits</p>
                                            <h4 class="card-title">50</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                                            <i class="fa-solid fa-helmet-safety"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category text-sm">Constructions</p>
                                            <h4 class="card-title">18</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Prepared Billing</p>
                                            <h4 class="card-title">25/60</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Billing Period</p>
                                            <h4 class="card-title">April 2025</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="row w-100 d-flex justify-content-center align-items-stretch d-flex">
                    <div class="col-md-8">
                        <div class="card card h-80 w-100">
                            <div class="card-header">
                                <div class="card-title">Reading Statuses</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table center-table">
                                        <thead class="">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Contract #</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Reading Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>456258</td>
                                                <td>Company A</td>
                                                <td><span class="badge badge-success">Prepared</span></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>458620</td>
                                                <td>Company B</td>
                                                <td><span class="badge badge-danger">No reading yet</span></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>456258</td>
                                                <td>Company C</td>
                                                <td><span class="badge badge-warning">Some have reading</span></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>785123</td>
                                                <td>Company D</td>
                                                <td><span class="badge badge-danger">No reading yet</span></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>789520</td>
                                                <td>Company E</td>
                                                <td><span class="badge badge-danger">No reading yet</span></td>

                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>126305</td>
                                                <td>Company F</td>
                                                <td><span class="badge badge-success">Prepared</span></td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>120658</td>
                                                <td>Company G</td>
                                                <td><span class="badge badge-warning">Some have reading</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex flex-column">
                        <div class="card card-round w-100 p-1">
                            <div class="card-header">
                                <div class="card-title">Payment Method Breakdown</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center doughnut-chart mt-3">
                                    <canvas id="paymentMethodChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const ctxPie = document.getElementById('paymentMethodChart').getContext('2d');
                            const paymentMethodChart = new Chart(ctxPie, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Electricity', 'Water', 'Waste Disposal'],
                                    datasets: [{
                                        data: [40, 35, 25],
                                        backgroundColor: ['#8E7DBE', '#F39E60', '#B1C29E']
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
