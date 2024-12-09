@extends('layouts')

@section('content')

<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Collection</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lists to Collect</h4>
                        <!-- <button class="btn btn-sta ms-auto create-bill me-2" data-bs-toggle="modal"
                            data-bs-target="#collectionModal">
                            <i class="fa fa-plus"></i>
                            Pay Collection
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="collect-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Bill #</th>
                                    <th>Lease #</th>
                                    <th>Remarks</th>
                                    <th>Total Rent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>Account #</th>
                                    <th>Tenant Name</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
       $('#collect-datatables').DataTable({
           pageLength: 10,
       }); 
    });
</script>
@endsection