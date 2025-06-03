@extends('layouts')

@section('content')
@include('admin.components.modals.proposal-modal')
@include('admin.components.modals.counter-proposals-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3 title">Lease Proposal</h3>
            <h6 class="op-7 mb-2">Lease Proposal Summary</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Mall Lease Proposal</h4>
                        <a href="{{ route('lease.admin.leases.add.proposal') }}" class="btn btn-sta ms-auto">
                            <i class="fa fa-plus"></i>
                            Create New Lease Proposal
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Proposed To</th>
                                    <th class="text-center">Space/s</th>
                                    <th class="text-center">Total Floor Area/s</th>
                                    <th class="text-center">Tenant Type</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">View Proposal</th>
                                </tr>
                            </thead>
                            <tbody id="proposals_table">
                                @foreach ($proposal as $proposals)
                                <tr>
                                    <td class="text-center">{{ ucfirst($proposals->company_name) }}</td>
                                    <td class="text-center">
                                        @php
                                        echo $propertyCodes = collect($proposals->space_selected)
                                        ->pluck('property_code')
                                        ->implode(', ');
                                        @endphp
                                    </td>
                                    <td class="text-center">
                                        {{ $totalSpaceArea = collect($proposals->space_selected)->sum('space_area') . ' sqm' }}
                                    </td>
                                    <td class="text-center">{{ $proposals->tenant_type }}</td>
                                    <td class="text-center">{!! $proposals->status
                                        ? '<span class="badge bg-success">Approved</span>'
                                        : '<span class="badge bg-warning">Pending</span>' !!}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-success showProposalContents"
                                            id="showProposalContents" data-show-proposal-id="{{ $proposals->id }}"
                                            data-bs-toggle="modal" data-bs-target="#leaseProposal"><i
                                                class="fa fa-eye"></i></a>
                                        <a class="btn btn-sm btn-warning editProposalContents"
                                            data-edit-proposal-id="{{ $proposals->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editProposal"><i class="fa fa-pen"></i></a>
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
@if (session('success'))
<script>
    $(document).ready(function() {
        var content = {
            message: '{{ session('
            success ') }}',
            title: '{{ session('
            success ') }}',
            icon: "fa fa-bell"
        };

        $.notify(content, {
            type: 'success',
            placement: {
                from: 'top',
                align: 'right',
            },
            time: 1000,
            delay: 1200,
        });
    });
</script>
@endif
@endsection
