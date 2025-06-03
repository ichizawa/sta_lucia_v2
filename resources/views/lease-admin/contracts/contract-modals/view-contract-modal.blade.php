<div class="modal fade" id="viewContractModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">View Contract</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid h-100 d-flex justify-content-center align-items-center text-center">
                    <iframe src="" id="view-contract-pdf" width="100%" height="100%"
                        style="border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.viewContract').click(function() {
            $.ajax({
                url: "{{ route('admin.view.contract') }}",
                type: "GET",
                data: {
                    id: $(this).data('contract-id')
                },
                success: function(data) {
                    $('#view-contract-pdf').attr('src', data.filedir + '#zoom=150');
                    // console.log(data);
                }
            });
        });
    });
</script>
