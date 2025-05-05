@extends('layouts')

@section('content')
    @include('biller.bill.billing-modal.bill-modal')
    <style>
        .rotate-icon {
            transition: transform 0.3s ease;
        }

        .rotate-icon.rotate-up {
            transform: rotate(180deg);
        }
    </style>
    @if (session('status'))
        <script>
            $(document).ready(function() {
                var content = {
                    message: '{{ session('message') }}',
                    title: '{{ session('status') ? 'Warning' : 'Success' }}',
                    icon: "fa fa-bell"
                }

                $.notify(content, {
                    type: '{{ session('status') }}',
                    placement: {
                        from: 'top',
                        align: 'right',
                    },
                    time: 1000,
                    delay: 2000,
                })
            });
        </script>
    @endif
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Billing</h3>
                <h6 class="op-7 mb-2">Tenant Billing Overview</h6>
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
                            <h4 class="card-title">Billing</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('biller.bill.components.period-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
