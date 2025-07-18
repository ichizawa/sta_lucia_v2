@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Tenants</h3>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Tenant Form</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress-bar-container mb-4">
                            <div class="progress-bar-circle active" id="step1-circle">1</div>
                            <div class="progress-bar-line active" id="step1-line"></div>
                            <div class="progress-bar-circle" id="step2-circle">2</div>
                            <div class="progress-bar-line" id="step2-line"></div>
                            <div class="progress-bar-circle" id="step3-circle">3</div>
                        </div>
                        <form id="LeaseaddTenentsForm" action="{{route('lease.submit.tenants')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="form-group col-md-6 main-step-1">
                                        <div class="step1">
                                            <div class="row">
                                                <div class="d-flex justify-content-start">
                                                    <h6 class="card-title">Tenant Information</h6>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="LeasetenantType">Tenant Type</label>
                                                    <select name="tenant_type" class="form-control" id="LeasetenantType"
                                                        required>
                                                        <option value="" selected hidden>Select Tenant Type</option>
                                                        <option value="Corporate">Corporate</option>
                                                        <option value="Individual">Individual</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="tenantcompany">Company Name</label>
                                                    <input name="tenant_company" type="text" class="form-control"
                                                        id="tenant_cmpname" placeholder="Company Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tenantstore">Store Name</label>
                                                    <input name="tenant_storename" type="text" class="form-control"
                                                        id="tenant_strname" placeholder="Store Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress">Company Address</label>
                                                    <input name="companyaddress" type="text" class="form-control"
                                                        id="company_address" placeholder="Company Address" required>
                                                </div>

                                            </div>
                                            <div class="row mb">
                                                <div class="col-md-12">
                                                    <label for="" class="d-block"
                                                        style="font-size: 16px; font-weight: 600;">Business Type</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="category">Category</label>
                                                    <select name="category[]" class="form-control" id="category" multiple
                                                        required>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                data-id="{{ $category->id }}"
                                                                data-name="{{ $category->name }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="sub_category">Sub Category</label>
                                                    <select name="sub_category[]" class="form-control" id="sub_category"
                                                        required multiple>
                                                    </select>
                                                </div>
                                                
                                                <!-- <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-primary" id="next-button">Next</button>
                                                    </div> -->

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 main-step-1">
                                        <div class="step2">
                                            <div class="row">
                                                <div class="d-flex justify-content-start">
                                                    <h6 class="card-title">Authorized Signatory</h6>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="">First Name</label>
                                                    <input type="text" class="form-control" id="owner_fname"
                                                        name="ownerfname" placeholder="First Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Last Name</label>
                                                    <input type="text" class="form-control" id="owner_lname"
                                                        name="ownerlname" placeholder="Last Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Position</label>
                                                    <input type="text" class="form-control" id="owner_position"
                                                        name="ownerposition" placeholder="Position" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Address</label>
                                                    <input type="text" class="form-control" id="owner_address"
                                                        name="owneraddress" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Email</label>
                                                    <input type="email" class="form-control" id="owner_email"
                                                        name="owneremail" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Telephone</label>
                                                    <input type="tel" class="form-control" id="owner_telephone"
                                                        name="ownertelephone" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Office Hours</label>
                                                    <input type="time" class="form-control" id="owner_officehrs"
                                                        name="ownerofficehrs" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">After Office Hours</label>
                                                    <input type="time" class="form-control" id="owner_aftrofficehrs"
                                                        name="ownerafterofficehrs" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Mobile No.</label>
                                                    <input type="tel" class="form-control" id="owner_mobile"
                                                        name="ownermobile" required>
                                                </div>
                                            </div>
                                            <!-- <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary" id="next-button1">Next</button>
                                                </div> -->
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 main-step-1">
                                        <div class="step3">
                                            <div class="row">
                                                <div class="d-flex justify-content-start">
                                                    <h6 class="card-title">Contact Person</h6>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="">First Name</label>
                                                    <input type="text" class="form-control" id="rep_fname"
                                                        name="repfname" placeholder="First Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Last Name</label>
                                                    <input type="text" class="form-control" id="rep_lname"
                                                        name="replname" placeholder="Last Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Position</label>
                                                    <input type="text" class="form-control" id="rep_position"
                                                        name="rep_position" placeholder="Position" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Address</label>
                                                    <input type="text" class="form-control" id="rep_address"
                                                        name="repaddress" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Email</label>
                                                    <input type="email" class="form-control" id="rep_email"
                                                        name="repemail" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Telephone</label>
                                                    <input type="tel" class="form-control" id="rep_telephone"
                                                        name="reptelephone" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Office Hours</label>
                                                    <input type="time" class="form-control" id="rep_officehrs"
                                                        name="repofficehrs" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">After Office Hours</label>
                                                    <input type="time" class="form-control" id="rep_aftrofficehrs"
                                                        name="repafterofficehrs" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Mobile No.</label>
                                                    <input type="tel" class="form-control" id="rep_mobile"
                                                        name="repmobile" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Password</label>
                                                    <input type="password" class="form-control" id="rep_password"
                                                        name="reppassword" required>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="button" class="btn btn-primary"
                                                    id="next-button1">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="step4" style="display: none">
                                <div class="row" id="Leasecompany-docu">

                                </div>
                                <!-- <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" id="next-button2">Next</button>
                                    </div> -->
                                <div class="row d-flex justify-content-between">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" id="back-button">Back</button>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" id="next-button2">Next</button>
                                    </div>
                                </div>
                            </div>

                            <div class="step5" style="display: none">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="review-section">
                                                <div id="review-company-info" class="review-box mb-4"></div>
                                                <div id="review-owner-info" class="review-box mb-4"></div>
                                                <div id="review-rep-info" class="review-box mb-4"></div>
                                            </div>
                                            <!-- <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn " id="submit-button"
                                                        style="margin-top: 10px; background-color: #304F23; color: white;">Submit</button>
                                                </div> -->
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"
                                                id="back-button1">Back</button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn " id="submit-button-lease"
                                                style="background-color: #304F23; color: white;">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .progress-bar-container {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .progress-bar-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ddd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            text-align: center;
            font-size: 16px;
            transition: background 0.3s, color 0.3s, transform 0.3s;
            transform: scale(1);
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            z-index: 1;
        }

        .progress-bar-circle.completed {
            background: #28a745;
            color: #fff;
            /* transform: scale(1.2); */
        }



        .progress-bar-circle.active {
            background: #007bff;
            color: #fff;
            transform: scale(1.2);
        }

        .progress-bar-circle:not(.completed)::before {
            content: attr(data-step);
            font-size: 16px;
        }

        .progress-bar-line {
            flex: 1;
            height: 5px;
            background: #ddd;
            transition: background 0.3s;
            position: relative;
            margin: 0 10px;
            z-index: 0;
        }

        .progress-bar-line.completed {

            background: #28a745;
        }

        .progress-bar-line.active {
            background: #007bff;
        }

        @keyframes flipIn {
            from {
                transform: rotateY(-90deg);
                opacity: 0;
            }

            to {
                transform: rotateY(0deg);
                opacity: 1;
            }
        }

        .step2,
        .step3,
        .step4 {
            /* animation: flipIn 0.6s ease-out; */
        }

        .step4 .step5 {
            display: none;
        }

        .step4 .container {
            background-color: aliceblue;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .review-section {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
        }

        .review-box {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .review-box:last-of-type {
            border-bottom: none;
        }

        .review-box h5 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.25rem;
            color: #333;
        }

        .review-box p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .review-section p {
            font-size: 20px !important;
        }


        .select2-container--bootstrap {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-container--bootstrap .select2-selection {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            height: 38px;
            padding: 0.375rem 0.75rem;
        }

        .select2-container--bootstrap .select2-selection--multiple {
            border-radius: 0.25rem;
            padding: 0;
        }

        .select2-container--bootstrap .select2-selection--multiple .select2-selection__rendered {
            padding: 0.375rem 0.75rem;
        }

        .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice {
            border-radius: 0.25rem;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            margin: 0.2rem;
            padding: 0.2rem 0.5rem;
        }

        .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice__remove {
            cursor: pointer;
            margin-left: 0.5rem;
            color: #495057;
        }

        .select2-container--bootstrap .select2-results {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.1);
        }

        .select2-container--bootstrap .select2-results__option {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .select2-container--bootstrap .select2-results__option--highlighted {
            background-color: #007bff;
            color: #ffffff;
        }

        .select2-container--bootstrap .select2-selection__rendered span {
            display: inline-block;
            line-height: 1.5;
            vertical-align: middle;
        }

        .select2-container--bootstrap .select2-selection__rendered {
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .select2-container--bootstrap .select2-selection__rendered .select2-selection__placeholder {
            color: #6c757d;
        }

        .select2-container--bootstrap .select2-selection__rendered .select2-selection__choice {
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            margin-right: 0.25rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
@endsection

<script>
    var submintTenantUrl = "{{ route('lease.submit.tenants') }}";
    var getSubCategory = "{{ route('lease.get.sub.category') }}";
    // $('#tenants_table').DataTable({});
</script>
