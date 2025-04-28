<div class="modal fade" id="editAwardNoticeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content h-100">
            <form action="{{ route('operation.notice.options', 'award') }}" method="POST"
                class="d-flex flex-column h-100">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Award Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 flex-grow-1">
                    <div class="container-fluid h-100 p-0 d-flex justify-content-center align-items-center text-center">
                        <iframe id="award-notice-pdf" width="100%" height="100%" style="border: none;"></iframe>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" id="checkFileFooter">
                    <input type="text" name="award_notice_id" id="award_notice_id" value="" hidden />
                    <select name="status_award" class="form-select w-25" required>
                        <option hidden selected>Select Option</option>
                        <option value="1">Approve</option>
                        <option value="3">Reject</option>
                    </select>
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.approversModal').click(function() {
            var data = $(this).data('approvers');
            $('#checkFileFooter').show();

            var pdfFileName = `award_notice_${data.id}.pdf`;
            var filePath = "{{ asset('storage/tenant_documents/') }}" + "/" + data.company_name +
                "/award_notice/" + pdfFileName;
            $('#award_notice_id').val(data.award_notice_id);

            $.get(filePath)
                .done(function() {
                    $('#award-notice-pdf').attr('src', filePath + '#zoom=150');
                })
                .fail(function() {
                    $('#award-notice-pdf').attr('src', '');
                });

            if (data.award_notice_status == 1) {
                $('#checkFileFooter').hide();
            } else {
                $('#checkFileFooter').show();
            }

        });

        @if (session('modal_open'))
            var content = {
                message: '{{ session('status') }}',
                title: 'Success',
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
        @endif
    });
</script>
