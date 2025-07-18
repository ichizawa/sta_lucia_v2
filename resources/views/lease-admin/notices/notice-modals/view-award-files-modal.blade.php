<div class="modal fade" id="viewFilesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header brown-border-top">
                <h5 class="modal-title">Check Award Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover table-responsive" id="viewFilesTable">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <!-- <th>File Status</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-end">
                        <div class="col-auto">
                            <a class="btn btn-sta uploadFile" data-bs-toggle="modal"
                                data-bs-target="#uploadFilesModal">Upload File</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="checkfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View File</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#viewFilesModal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid h-100 d-flex justify-content-center align-items-center text-center">
                    <iframe src="" id="view-notice-pdf" width="100%" height="100%"
                        style="border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#viewFilesModal">Back</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadFilesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.award.submit', 'upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Files</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#viewFilesModal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_name">File Name</label>
                                    <input type="text" name="file_name" id="file_name" class="form-control"
                                        placeholder="Enter File Name">
                                    <input type="text" name="owner_id" id="owner_id" class="form-control" hidden />
                                    <input type="text" name="award_notice_id" id="aw_id" class="form-control"
                                        hidden />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_path">File Path</label>
                                    <input type="file" name="file_path" id="file_path" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#viewFilesModal">Back</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.filesModalTable').click(function() {
            var data = $(this).data('award-data');
            $('#viewFilesTable tbody').empty();

            $.ajax({
                url: "{{ route('admin.award.get', 'get') }}",
                type: "GET",
                data: {
                    noticeid: data.award_notice_id,
                },
                dataType: "json",
                success: function(data) {
                    $.each(data.data, function(key, value) {
                        $('#viewFilesTable tbody').append(`
                            <tr>
                                <td>${value.file_name}</td>
                                <td>
                                    <a class="btn btn-sm btn-success viewingFile" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#checkfileModal"
                                    
                                    data-file-path="${value.file_path}" 
                                    data-comp-name="${value.company_name}">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                        `);
                    });

                    $('.viewingFile').click(function() {
                        var file = $(this).data('file-path');
                        var comp = $(this).data('comp-name');

                        $('#view-notice-pdf').attr('src',
                            "{{ asset('storage/tenant_documents/') }}" + "/" +
                            comp + "/" + file);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        });

        $('.uploadFile').click(function() {
            var data = $('.filesModalTable').data('award-data');

            $('#owner_id').val(data.tenant_id);
            $('#aw_id').val(data.award_notice_id);
        });
    });
</script>
