@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Activity Log</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Logs</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date & Time</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">2025-04-07 09:00 AM</td>
                                        <td class="text-center">Feiah Macs</td>
                                        <td class="text-center">Tenant</td>
                                        <td class="text-center">Downloaded Lease Contract</td>
                                        <td class="text-center">Lease ID: 1024</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2025-03-07 09:00 PM</td>
                                        <td class="text-center">Christopher Evans</td>
                                        <td class="text-center">Lease Admin</td>
                                        <td class="text-center">Sample Action</td>
                                        <td class="text-center">Sample Details</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2025-03-07 9:00 PM</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">Admin</td>
                                        <td class="text-center">Sample Action</td>
                                        <td class="text-center">Sample Details</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2025-04-10 02:15 PM</td>
                                        <td class="text-center">Shane Dizon</td>
                                        <td class="text-center">Tenant</td>
                                        <td class="text-center">Uploaded Proposal</td>
                                        <td class="text-center">Sample Details</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
