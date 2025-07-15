<div class="modal fade" id="leaseProposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="height: 84vh;">
                    <iframe id="proposal-pdf" src="" width="100%" height="100%" style="border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="rejectNewProposal" class="btn btn-danger">Reject</button>
                <button type="button" id="approveNewProposal" class="btn btn-success">Approve</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Revised Leased Proposals</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Proposals</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                    <div class="container-fluid" id="counterProposalBTN">
                        <div class="row justify-content-end">
                            <div class="col-auto ">
                                <a class="btn btn-sta counterProposalsAdd" data-bs-toggle="modal" id="counterProposalsAdd" data-bs-target="#counterProposals">Add Revised Leased Proposal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-sta">Save changes</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="viewCounterProposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Revised Leased Proposals</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="height: 84vh;">
                    <iframe id="counter-proposal-pdf" src="" width="100%" height="100%" style="border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer" id="counter-proposal-footer">
                <button type="button" id="rejectCounter" class="btn btn-danger">Reject</button>
                <button type="button" id="approveCounter" class="btn btn-success">Approve</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.showProposalContents').click(function (e) {

            $('#exampleModalLabel').empty();
            var proposal_id = $(this).data('show-proposal-id');
            $('#proposal-pdf').attr('src', '');
            $('#rejectNewProposal').attr('disabled', false);
            $('#approveNewProposal').attr('disabled', false);
            
            $.ajax({
                url: "{{ route('lease.show.proposal') }}",
                type: "GET",
                data: {
                    proposal_id: proposal_id
                },
                success: function (data) {
                    // console.log(data);
                    if (data.pdf_url) {
                        $('#proposal-pdf').attr('src', data.pdf_url + '#zoom=125');
                    }

                    $('#rejectNewProposal').attr('data-proposal-id', proposal_id);
                    $('#approveNewProposal').attr('data-proposal-id', proposal_id);
                    var Title = $('#exampleModalLabel');
                    if(data.document_status.status == 0){
                        Title.append(`Lease Proposal <span class="badge bg-danger">Files still not uploaded!</span>`);
                        $('#rejectNewProposal').attr('disabled', true);
                        $('#approveNewProposal').attr('disabled', true);
                    }else{
                        // $('.editProposalContents').hide();
                        Title.append(`Lease Proposal`);
                        if (data.data[0].status == 1) {
                            $('#rejectNewProposal').hide();
                            $('#approveNewProposal').hide();
                        } else {
                            $('#rejectNewProposal').show();
                            $('#approveNewProposal').show();
                        }
                    }
                    
                }
            });
        });

        $('#approveNewProposal').click(function() {
            var proposal_id = $(this).data('proposal-id');
            swal({
                title: "Are you sure?",
                text: "You want to approve this proposal!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel", "Confirm"],
            }).then((willDelete) => {
                if (willDelete) {
                    proposalOptions(proposal_id, 1, 'new');
                }
            });
        });

        $('#rejectNewProposal').click(function() {
            var proposal_id = $(this).data('proposal-id');
            swal({
                title: "Are you sure?",
                text: "You want to reject this proposal!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel", "Confirm"],
            }).then((willDelete) => {
                if (willDelete) {
                    // proposalOptions(proposal_id, 2);
                }
            });
        });

        $('.editProposalContents').click(function (e) {
            // e.preventDefault();
            $('.table-group-divider').empty();
            $('#counterProposalBTN').show();
            var proposal_id = $(this).data('edit-proposal-id');
            $('#counterProposalsAdd').data('counter-prop-id', proposal_id);

            $.ajax({
                url: "{{ route('lease.show.proposal') }}",
                type: "GET",
                data: {
                    proposal_id: proposal_id
                },
                success: function (data) {
                    if(data.data[0].is_counter == 1){
                        $('#counterProposalBTN').hide();
                    }
                    
                    $('#counter-proposal-footer').show();
                    if (!data.counter_proposal) {
                        $.each(data.counter_proposals, function (key, value) {
                            
                            $('.table-group-divider').append(
                                `<tr>
                                <td>Counter Proposal #${value.id}</td>
                                <td>${value.status == 0 ? '<span class="badge bg-warning">Pending</span>' : '<span class="badge bg-success">Approved</span>'}</td>
                                <td>
                                    <a class="btn btn-sm btn-success getCounterProposal" data-counter-proposal-id="${value.id}" data-bs-toggle="modal" data-bs-target="#viewCounterProposal">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                </td>
                            </tr>`
                            );
                        });

                        $('.getCounterProposal').click(function () {
                            var counterProposal_id = $(this).data('counter-proposal-id');
                            $.ajax({
                                url: "{{ route('lease.show.counter.proposal') }}",
                                type: "GET",
                                data: {
                                    counter_proposal_id: counterProposal_id
                                },
                                success: function (data) {
                                    $('#counter-proposal-pdf').attr('src', data.pdf_url + '#zoom=175');
                                    $('#approveCounter').attr('data-counter-proposal-id', counterProposal_id);

                                    if (data.prop.status == 1) {
                                        $('#counter-proposal-footer').hide();
                                    }
                                }
                            });
                        });
                    }
                    
                }
            });
        });

        $('#approveCounter').click(function () {
            var proposal_id = $(this).data('counter-proposal-id');
            swal({
                title: "Are you sure?",
                text: "You want to approve this counter proposal!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel", "Confirm"],
            }).then((willApprove) => {
                if (willApprove) {
                    proposalOptions(proposal_id, 1, 'counter');
                }
            });
        });

        function proposalOptions(proposal_id, option, set) {
            $.ajax({
                url: "{{ url('admin/leases/lease-option-proposal') }}" + '/' + set,
                type: "GET",
                data: {
                    proposal_id: proposal_id,
                    option: option
                },
                success: function (data) {
                    $('#leaseProposal').modal('hide');
                    $('#viewCounterProposal').modal('hide');
                    // $('#editProposal').modal('show');

                    var content = {
                        message: `${data.message}`,
                        title: `${data.status}`,
                        icon: "fa fa-bell"
                    };

                    $.notify(content, {
                        type: `${data.status}`,
                        placement: {
                            from: 'top',
                            align: 'right',
                        },
                        time: 1000,
                        delay: 1200,
                        z_index: 10000
                    });
                    
                    if(set == 'new'){
                        var row = $('a[data-show-proposal-id="' + proposal_id + '"]').closest('tr');
                        row.find('td:nth-child(5)').html('<span class="badge bg-success">Approved</span>');
                    }
                }
            });
        }

    });
</script>