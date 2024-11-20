@extends('layouts')

@section('content')
@include('biller.reading.reading-modal.reading-modal')
@include('biller.reading.reading-modal.input-reading-modal')
@include('biller.reading.reading-modal.lists-utility')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Utility Reading</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <!-- <input type="date" class="form-control" name="filter_year" id="filter_year"/> -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">List of Billings</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('biller.reading.components.reading-table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection