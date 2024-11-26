<div class="modal fade" id="utilityListModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="billReadingForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Utility Reading Lists</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="utilityreading-datatable" class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tenant #</th>
                                </tr>
                            </thead>
                            <tbody id="utilityTableList">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="appendInputHere">
                    <input type="text" name="dateToRead" id="dateToRead" hidden/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sta prepareBilling">Prepare Bill</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.prepareBilling').click(function () {
            var form = $('#billReadingForm')[0];
            var formdata = new FormData(form);

            $.ajax({
               url: "{{ route('utility.reading.save') }}",
               method: 'POST',
               data: formdata,
               contentType: false,
               cache: false,
               processData: false,
               dataType: 'json',
               success: function (response) {
                   console.log(response);
               },
               error: function (status, xhr, error) {
                   console.log(xhr.responseText);
               }
            });
        });
    });
</script>