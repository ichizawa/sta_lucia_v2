@extends('layouts')

@section('content')


@include('client.components.modals.proposal-modal')

<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Proposal</h3>
            <h6 class="op-7 mb-2">Tenant Billing System</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Proposals</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="client" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Proposal ID</th>
                                    <th>Space/s</th>
                                    <th>Total Floor Area/s</th>
                                    <th>Business</th>
                                    <th>Status</th>
                                    <th>View Proposal</th>
                                </tr>
                            </thead>
                            {{-- CCJEDITED --}}
                            <tbody id="proposals_table">
                                <script>
                                    console.log(@json($proposal));
                                </script>

                                @foreach ($proposal as $proposals)
                                        <tr>
                                            <td>{{ ucfirst($proposals->company_name) }}</td>
                                            <td>
                                                @php
                                                    echo $propertyCodes = collect($proposals->space_selected)->pluck('property_code')->implode(', ');
                                                @endphp
                                                {{-- {{ $proposals->space_selected->space_name }} --}}
                                                {{-- @foreach ($proposals->space_selected as $space)
                                                {{ $space['space_name'] }} <br> <!-- Displaying the space name -->
                                             @endforeach --}}

                                            </td>
                                            <td>
                                                {{  $totalSpaceArea = collect($proposals->space_selected)->sum('space_area') . ' sqm' }}
                                            </td>
                                            <td>{{ $proposals->bussiness_nature }}</td>
                                            <td>{!! $proposals->status ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning">Pending</span>' !!}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success showclientProposalContents" id="showclientProposalContents" data-show-proposal-id="{{ $proposals->id }}" data-bs-toggle="modal" data-bs-target="#clientleaseProposal"><i class="fa fa-eye"></i></a>
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
@endsection
