@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="{{ route('utility.dashboard') }}">Utility Dashboard</a>
                <h6 class="op-7 mb-2">Overview of all utilities</h6>
            </div>
        </div>

        <div class="row">
            {{-- Example statistic card --}}
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fa-solid fa-bolt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Utilities</p>
                                    <h4 class="card-title">{{ $totalUtilities }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- add more cards/graphs as needed --}}
        </div>
    </div>
@endsection
