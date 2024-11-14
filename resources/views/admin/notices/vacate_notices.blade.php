@extends('layouts')


@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Vacate Notice</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Notices</h4>
                        <!-- <button class="btn btn-outline-info btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Add Utitlity
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Nature of Business</th>
                                    <th>Vacate Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Mixed Temptation</td>
                                    <td>Food, Chinese Cuisine</td>
                                    <td>October 10, 2024</td>
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