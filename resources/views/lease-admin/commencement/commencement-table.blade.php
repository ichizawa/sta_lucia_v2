@extends('layouts')

@section('content')
    @include('lease-admin.commencement.commencement-modals.update-commencement-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Commencement</h3>
                <h6 class="op-7 mb-2">Lease Start Overview</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Commencements</h4>
                            <button class="btn btn-sta ms-auto edit-comm-date" data-bs-toggle="modal"
                                data-bs-target="#comm-date-modal">
                                <i class="fa fa-plus"></i>
                                Update Commencement
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="lease_admin_comm_table"
                                class="display table table-striped table-hover commencement-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Proposal Number</th>
                                        <th class="text-center">Tenant Name</th>
                                        <th class="text-center">Date Created</th>
                                        <th class="text-center">Commencement Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proposal as $commence)
                                        <tr>
                                            <td class="text-center">{{ $commence->proposal_uid }}</td>
                                            <td class="text-center">{{ $commence->company->store_name }}</td>
                                            <td class="text-center">{{ date('F d, Y', strtotime($commence->created_at)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $commence->commencement_proposal->commencement_date ? date('F Y', strtotime($commence->commencement_proposal->commencement_date)) : 'N/A' }}
                                            </td>
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
    <script>
        $(document).ready(function() {

            $('#lease_admin_comm_table').DataTable({
                pagelength: 10,
                responsive: true
            });

            var $prop = $('#prop_num').selectize({
                sortField: 'text',
                maxItems: null,
                placeholder: 'Select Proposal Number'
            });

            $('.edit-comm-date').click(function() {
                var data = @json($proposal);
                var select = $prop[0].selectize;
                $.each(data, function(key, value) {
                    if (value.commencement_proposal.commencement_date == null) {
                        select.addOption({
                            value: value.id,
                            text: value.proposal_uid
                        });
                        select.refreshOptions(false);
                    }
                });
            });

            $('#comm-date-form').submit(function(e) {
                e.preventDefault();
                var form = new FormData(this);
                $.ajax({
                    url: "{{ route('lease.admin.commencement.update') }}",
                    type: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#comm-date-modal').modal('hide');
                        if (response.status == 'success') {
                            swal('Success', 'Commencement Date Updated', 'success').then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
