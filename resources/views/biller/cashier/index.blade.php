@extends('layouts')

@section('content')
@include('biller.cashier.cashier-modals.cashier-options-modal')
@include('biller.cashier.cashier-modals.cashier-ledger-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Biller</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
            <!-- <button class="btn btn-sta ms-auto create-bill me-2" data-bs-toggle="offcanvas"
                aria-controls="offcanvasResponsive" data-create-bill="{{ $companies }}"
                data-bs-target="#offCanvasCashier">
                <i class="fa fa-plus"></i>
                Create Bill
            </button> -->
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tenant Accounts</h4>
                        <button class="btn btn-sta ms-auto create-bill me-2" data-bs-toggle="offcanvas"
                            aria-controls="offcanvasResponsive" data-bs-target="#offCanvasCashier">
                            <i class="fa fa-plus"></i>
                            Create Bill
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="cashier-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Account #</th>
                                    <th>Tenant Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $accounts)   
                                    <tr id="accounts-bill" data-account-info="{{ $accounts->owner_id }}">
                                        <td>{{ $accounts->acc_id }}</td>
                                        <td>{{ $accounts->store_name }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning viewLedger" data-account-uid="{{ $accounts->owner_id }}" data-bs-toggle="modal"
                                                data-bs-target="#cashierLedgerModal">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Account #</th>
                                    <th>Tenant Name</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Total Payments</h4>
                        <button class="btn btn-sta btn-sm ms-auto" id="clearDetails">
                            <!-- <i class="fa fa-minus"></i> -->
                            Clear
                        </button>
                    </div>
                </div>
                <form id="detailsForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Account Name</label>
                                    <input type="text" id="acc_name" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" id="acc_num" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Total Bill</label>
                                    <input type="text" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tenant Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="cashier-details">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#cashier-datatables').DataTable({
            pageLength: 5,
            initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select class="form-select"><option value="#" selected hidden>Select Filter</option><option value="">All</option></select>',
                        )
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append(
                                    '<option value="' + d + '">' + d + '</option>',
                                );
                            });
                    });
            },
        });

        $('#cashier-details').empty();
        $('#accounts-bill').click(function () {
            var acc_uid = $(this).data('account-info');
            var datas = @json($companies);

            $.map(datas, function (accountInfo, index) {
                if (accountInfo.owner_id == acc_uid) {
                    const latestProposal = accountInfo.proposals[accountInfo.proposals.length - 1];

                    $('#acc_name').val(accountInfo.company_name);
                    $('#acc_num').val(accountInfo.acc_id);

                    let cashierDetailsHtml = `
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Space Code</label>
                                <input type="text" class="form-control" id="space_code" value="" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Space Type</label>
                                <input type="text" class="form-control" id="space_type" value="" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Space Area (sqm)</label>
                                <input type="text" class="form-control" id="space_area" value="" readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Basic Rent</label>
                                <input type="text" class="form-control" value="${latestProposal.brent}" readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Discount <small class="form-text text-muted">(only applicable for space rent)</small></label>
                                <input type="text" class="form-control" value="${latestProposal.discount}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Minimum Guaranteed Rent</label>
                                <input type="text" class="form-control" value="${latestProposal.min_mgr}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total Rent</label>
                                <input type="text" class="form-control" value="${latestProposal.total_rent}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total MGR (Minimum Guaranteed Rent)</label>
                                <input type="text" class="form-control" value="${latestProposal.total_mgr}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Rent Deposit</label>
                                <input type="text" class="form-control" value="${latestProposal.rent_deposit}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Security Deposit</label>
                                <input type="text" class="form-control" value="${latestProposal.sec_dep}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Escalation Rate</label>
                                <input type="text" class="form-control" value="${latestProposal.escalation_rate}%" readonly />
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Other Charges</h4>
                        </div>`;

                    $.each(accountInfo.charges, function (index, charge) {
                        cashierDetailsHtml += `
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">${charge.charge_name}</label>
                                <input type="text" class="form-control" value="${charge.charge_fee}" readonly />
                            </div>
                        </div>`;
                    });

                    $.each(accountInfo.utilities, function (index, utility) {
                        cashierDetailsHtml += `
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">${utility.utility_name}</label>
                                <input type="text" class="form-control" value="${utility.utility_price}" readonly />
                            </div>
                        </div>`;
                    });

                    $('#cashier-details').html(cashierDetailsHtml);

                    $.map(accountInfo.leases, function (proposal, index) {
                        if (proposal.proposal_id = latestProposal.id) {
                            $('#space_code').val(proposal.property_code);
                            $('#space_type').val(proposal.space_type);
                            $('#space_area').val(proposal.space_area + ' sqm');
                        }
                    });
                }

            });

        });

        $('#clearDetails').click(function () {
            $('#detailsForm')[0].reset();
            $('#cashier-details').empty();
        });

    });
</script>
@endsection