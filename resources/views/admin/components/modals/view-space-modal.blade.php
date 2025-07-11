<style>
    .modal-body {
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    .modal-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .row {
        padding: 10px 0;
    }

    p {
        margin: 0;
    }
</style>
<div class="modal fade" id="viewSpaceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0">View Space</h5>
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary editInputs">Edit</button>
                <button type="button" hidden class="btn btn-primary saveInputs">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
