<div class="modal fade" id="utilityReadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="readingForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Meter Reading</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Previous Reading Date</label>
                                <input type="date" id="previous_reading_date" name="previous_reading_date"
                                    class="form-control" placeholder="Enter Previous Reading Date" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Present Reading Date</label>
                                <input type="date" id="present_reading_date" name="present_reading_date"
                                    class="form-control" placeholder="Enter Present Reading Date" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Previous Meter Reading</label>
                                <input type="text" id="previous_reading" name="previous_reading" class="form-control"
                                    placeholder="Enter Previous Meter Reading" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Present Meter Reading</label>
                                <input type="text" id="bill_id" class="form-control" name="bill_id" hidden/>
                                <input type="text" id="utility_id" class="form-control" name="utility_id" hidden/>
                                <input type="text" id="date_reading" class="form-control" name="date_reading" hidden/>

                                <input type="text" class="form-control" id="present_reading" name="present_reading"
                                    placeholder="Enter Present Meter Reading" />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Consumption</label>
                                <input type="text" id="consumption" name="consumption" class="form-control"
                                    placeholder="Enter Consumption" />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Total Reading Charge</label>
                                <input type="text" id="total_reading_charge" name="total_reading_charge"
                                    class="form-control" placeholder="Total Reading Charge" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary backbtn" data-bs-target="#contractUtilityLists"
                        data-bs-toggle="modal">Back</button>
                    <button type="button" class="btn btn-sta createReading">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#utilityReadingModal').on('show.bs.modal', function (e) {
            var bill_id = $(e.relatedTarget).data('id');
            var util_id = $(e.relatedTarget).data('utility-id');
            var date_reading = $(e.relatedTarget).data('date-reading');

            $('.backbtn').attr('data-id', bill_id);
            $('.backbtn').attr('data-date', date_reading);
            
            $('#readingForm')[0].reset();

            $.ajax({
                url: "{{ route('utility.reading.bills') }}",
                type: "GET",
                data: {
                    id: util_id,
                    bill_id: bill_id,
                    date_reading: date_reading
                },
                success: function (data) {
                    console.log(data);
                    $('#previous_reading').val('');
                    $('#previous_reading_date').val('');
                    $('#bill_id').val(bill_id);
                    $('#utility_id').val(data.selected_utility_id);
                    $('#date_reading').val(date_reading);

                    // if(data[0].reading != null){
                    //     $('#previous_reading').val(data[0].reading.present_reading);
                    //     $('#previous_reading_date').val(data[0].reading.present_reading_date);
                    // }else{
                    //     $('#previous_reading').val('');
                    //     $('#previous_reading_date').val('');
                    // }
                    // $('#utility_id').val(data[0].id);
                    // $('#bill_id').val(bill_id);
                    // $('#utility_name').val(data[0].utility_name);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('.createReading').click(function () {
            var form = $('#readingForm')[0];
            var formData = new FormData(form);
            $.ajax({
                url: "{{ route('utility.reading.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    // $(document).ready(function () {
    //     $('#utilityReadingModal').on('show.bs.modal', function (e) {
    //         var id = $(e.relatedTarget).data('id');
    //         var bill_id = $(e.relatedTarget).data('bill-id');
    //         $('#bill_id').val('');
    //         $('#utility_id').val('');
    //         $('#readingForm')[0].reset();

    //         $.ajax({
    //             url: "{{ route('utility.reading.bills') }}",
    //             type: "GET",
    //             data: {
    //                 id: id
    //             },
    //             success: function (data) {
    //                 // console.log(data);
    //                 if(data[0].reading != null){
    //                     $('#previous_reading').val(data[0].reading.present_reading);
    //                     $('#previous_reading_date').val(data[0].reading.present_reading_date);
    //                 }else{
    //                     $('#previous_reading').val('');
    //                     $('#previous_reading_date').val('');
    //                 }
    //                 $('#utility_id').val(data[0].id);
    //                 $('#bill_id').val(bill_id);
    //                 $('#utility_name').val(data[0].utility_name);
    //             },
    //             error: function (xhr, status, error) {
    //                 console.log(xhr.responseText);
    //             }
    //         });
    //     });

    //     $('.createReading').click(function() {
    //         var form = $('#readingForm')[0];
    //         var formData = new FormData(form);

    //         $.ajax({
    //             url: "{{ route('utility.reading.store') }}",
    //             type: "POST",
    //             data: formData,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             dataType: "json",
    //             success: function (data) {
    //                 console.log(data);
    //             },
    //             error: function (xhr, status, error) {
    //                 console.log(xhr.responseText);
    //             }
    //         });
    //     });
    // });
</script>