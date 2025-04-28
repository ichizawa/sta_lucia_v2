@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7">Tenant Billing System</h6>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4" style="margin-top: -20px">
            <div>
                <h3 class="fw-bold mt-3" style="color: #8B7231 !important">Welcome, {{ Auth::user()->name }}!</h3>
            </div>
            <div style="width: 265px">
                <label for="exampleFormControlSelect1" class="mb-1">Select Contract</label>
                <select class="form-select" id="exampleFormControlSelect1">
                    <option>524203</option>
                    <option>225632</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fa-solid fa-marker"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Lease Proposals</p>
                                    <h4 class="card-title">2</h4>
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
                                    <i class="fa-solid fa-award"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Award Notices</p>
                                    <h4 class="card-title">1</h4>
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
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Contracts</p>
                                    <h4 class="card-title">1</h4>
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
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
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
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="background-color: #FFF7F3">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title" style="color: #8B7231">Recent Activity <i class="fas fa-history"></i>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body " style="height: 520px;">
                        <ol class="activity-feed">
                            <li class="feed-item feed-item-secondary">
                                <time class="date" datetime="9-25">March 30</time>
                                <span class="text">Monthly Billing Paid - ₱10,000.00</span>
                            </li>
                            <li class="feed-item feed-item-success">
                                <time class="date" datetime="9-24">March 30</time>
                                <span class="text">Paid ₱10,000 via Check</span>
                            </li>
                            <li class="feed-item feed-item-info">
                                <time class="date" datetime="2025-04-01">April 1</time>
                                <span class="text">New billing statement generated - ₱10,000.00</span>
                            </li>
                            <li class="feed-item feed-item-danger">
                                <time class="date" datetime="2025-04-10">April 10</time>
                                <span class="text">Unpaid notice sent</span>
                            </li>
                            <li class="feed-item feed-item-warning">
                                <time class="date" datetime="2025-03-01">March 1</time>
                                <span class="text">Contract renewed until Dec 2025</span>
                            </li>
                            <li class="feed-item feed-item-info">
                                <time class="date" datetime="2025-02-28">Feb 28</time>
                                <span class="text">New invoice uploaded</span>
                            </li>
                            <li class="feed-item feed-item-danger">
                                <time class="date" datetime="2025-04-10">April 10</time>
                                <span class="text">Unpaid notice sent</span>
                            </li>
                            <li class="feed-item feed-item-danger">
                                <time class="date" datetime="2025-04-10">April 10</time>
                                <span class="text">Unpaid notice sent</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex align-items-center">
                                        <span class="me-3 p-2 text-danger">
                                            <i class="fa-solid fa-triangle-exclamation fa-2x"></i>
                                        </span>
                                        <div>
                                            <h5>
                                                <b><a>₱10,000.00</a></b>
                                            </h5>
                                            <small>Amount due - 4/30/2025</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex align-items-center">
                                        <span class="me-3 p-2 text-warning">
                                            <i class="fa-solid fa-bell fa-2x"></i>
                                        </span>
                                        <div>
                                            <h5>
                                                <b><a>May 30, 2025</a></b>
                                            </h5>
                                            <small>Next Due Date</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mx-auto">
                        <div class="card card-round h-100" style="background-color: #FFE3E3; ">
                            <div class="card-header">
                                <div class="card-title text-danger">Billing Trend <i
                                        class="fa-solid fa-arrow-trend-up"></i></div>
                            </div>
                            <div class="card-body">
                                <canvas id="billingTrendChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const billingTrendCtx = document.getElementById('billingTrendChart').getContext('2d');

        const billingTrendChart = new Chart(billingTrendCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Monthly Billing (₱)',
                    data: [10000, 9500, 11000, 10500, 10000],
                    backgroundColor: '#FFB0B0',
                    borderColor: '#FF8A8A',
                    borderWidth: 2,
                    // fill: true,
                    tension: 0.4
                }]
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
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection
