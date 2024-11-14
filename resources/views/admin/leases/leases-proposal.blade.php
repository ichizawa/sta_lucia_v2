@extends('layouts')

@section('content')
@include('admin.components.modals.proposal-modal')
<!-- @include('admin.components.modals.lease-documents-modal') -->
@include('admin.components.modals.counter-proposals-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Lease Proposal</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Mall Lease Proposal</h4>
                        <a href="{{ route('leases.add.proposal') }}" class="btn btn-sta ms-auto">
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
                                    <th>Proposed To</th>
                                    <th>Space/s</th>
                                    <th>Total Floor Area/s</th>
                                    <th>Tenant Type</th>
                                    <th>Status</th>
                                    <th>View Proposal</th>
                                </tr>
                            </thead>
                            <tbody id="proposals_table">
                                @foreach ($proposal as $proposals)
                                        <tr>
                                            <td>{{ ucfirst($proposals->company_name) }}</td>
                                            <td>
                                                @php
                                                    echo $propertyCodes = collect($proposals->space_selected)->pluck('property_code')->implode(', ');
                                                @endphp
                                            </td>
                                            <td>
                                                {{  $totalSpaceArea = collect($proposals->space_selected)->sum('space_area') . ' sqm' }}
                                            </td>
                                            <td>{{ $proposals->tenant_type }}</td>
                                            <td>{!! $proposals->status ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning">Pending</span>' !!}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success showProposalContents" id="showProposalContents" data-show-proposal-id="{{ $proposals->id }}" data-bs-toggle="modal" data-bs-target="#leaseProposal"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-warning editProposalContents" data-edit-proposal-id="{{ $proposals->id }}" data-bs-toggle="modal" data-bs-target="#editProposal"><i class="fa fa-pen"></i></a>
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
        $(document).ready(function () {
            var content = {
                message: '{{ session('success') }}',
                title: '{{ session('success') }}',
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
