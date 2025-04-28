@extends('layouts')

@section('content')
    @include('admin.components.modals.view-tenant-files-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Tenants</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Ceo / President / Owner</h4>

                            <a href="{{ route('admin.add.tenants') }}" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Tenants
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Store Representative</th>
                                        <th class="text-center">Store Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Documents Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tenant-show-table">
                                    @foreach ($owners as $owner)
                                                        @foreach ($owner->companies as $company)
                                                                            @foreach ($owner->representatives as $rep)
                                                                                                <!-- {{ $rep }} -->
                                                                                                <tr>
                                                                                                    <td class="text-center">
                                                                                                        {{ $company->company_name }}
                                                                                                    </td>
                                                                                                    <td class="text-center">
                                                                                                        {{ ucFirst($rep->rep_fname) . ' ' . ucFirst($rep->rep_lname) }}
                                                                                                    </td>
                                                                                                    <td class="text-center">
                                                                                                        {{ $company->store_name }}

                                                                                                    </td>
                                                                                                    <td class="text-center">
                                                                                                        {{ $company->company_address }}
                                                                                                    </td>
                                                                                                    <td class="text-center">
                                                                                                        {{ $rep->rep_address }}

                                                                                                    </td class="text-center">
                                                                                                    <td>
                                                                                                        {{ $rep->rep_email }}
                                                                                                    </td>
                                                                                                    <td class="text-center">
                                                                                                        {!! $rep->status
                                                                                ? '<span class="badge bg-success">Active</span>'
                                                                                : '<span class="badge bg-warning">Pending</span>' !!}
                                                                                                    </td>
                                                                                                    <td class="text-center">
                                                                                                        {!! $owner->doc_status
                                                                                ? '<span class="badge bg-success">Approved</span>'
                                                                                : '<span class="badge bg-warning">Pending</span>' !!}
                                                                                                    </td>

                                                                                                    <td>
                                                                                                        <div class="d-flex gap-2">
                                                                                                            <a class="btn btn-warning btn-sm view_documents"
                                                                                                                data-owner-id="{{ $company->owner_id }}"
                                                                                                                data-company-name="{{ $company->company_name }}"
                                                                                                                data-tenant-type="{{ $company->tenant_type }}" data-bs-toggle="modal"
                                                                                                                data-docu-status="{{ $owner->doc_status }}"
                                                                                                                data-bs-target="#tenantDocuments">
                                                                                                                <i class="fa fa-pen" aria-hidden="true"></i>
                                                                                                            </a>
                                                                                                            <a class="btn btn-danger btn-sm deleteTenant"
                                                                                                                onClick="delete_tenant_func({{ $company->owner_id }})">
                                                                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </td>

                                                                                                </tr>
                                                                            @endforeach
                                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (e) {
            $('.view_documents').click(function () {
                var owner_id = $(this).data('owner-id');
                var tenant_type = $(this).data('tenant-type');
                var company_name = $(this).data('company-name');
                var docu_status = $(this).data('docu-status');
                $('#tenant-documents').empty();
                $('#tenant-doc-stats').empty();

                $.ajax({
                    url: "{{ route('admin.tenant.documents') }}",
                    type: "GET",
                    data: {
                        owner_id: owner_id
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#tenant-documents').empty();

                        var checkFalse = true;

                        $.each(data[0].documents, function (key, value) {
                            if (tenant_type == 'Individual') {
                                if (key === 'sec_reg' || key === 'valid_idSig1' ||
                                    key === 'valid_idSig2') {
                                    return true;
                                }
                            } else {
                                if (key === 'dti_reg' || key === 'valid_id1' || key ===
                                    'valid_id2') {
                                    return true;
                                }
                            }
                            if (value == null) {
                                checkFalse = false;
                            }
                        });
                        if (checkFalse) {
                            if (data[0].status !== 1) {
                                $('#tenant-doc-stats').append(`
                                                    <button type="button" class="btn btn-primary approveTenantDocuments" data-owner-id="${owner_id}">Approve Documents</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                `);
                            }
                        }
                        if (data[0].status !== 1) {
                            $('#tenant-doc-stats').append(`
                                                <button type="button" class="btn btn-primary approveTenantDocuments" data-owner-id="${owner_id}">Approve Documents</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            `);
                        }

                        $('.approveTenantDocuments').click(function () {
                            var owner_id = $(this).data('owner-id');
                            $.ajax({
                                url: "{{ route('admin.tenant.documents.approve') }}",
                                type: "POST",
                                data: {
                                    ownerid: owner_id,
                                },
                                dataType: "json",
                                success: function (data) {
                                    //    console.log(data);
                                    $('#tenant-show-table').find('td').eq(7)
                                        .html(
                                            '<span class="badge bg-success">Approved</span>'
                                        );
                                    $('#tenantDocuments').modal('hide');
                                },
                                error: function (xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        });

                        $.each(data, function (key, value) {
                            var documentid = value.document_id;
                            $.each(value.documents, function (key, value) {
                                const keyMappings = {
                                    dti_reg: 'DTI Registration',
                                    valid_id1: 'Valid ID 1',
                                    valid_id2: 'Valid ID 2',
                                    sec_reg: 'SEC Registration',
                                    valid_idSig1: 'Valid ID Signature 1',
                                    valid_idSig2: 'Valid ID Signature 2',
                                    bir_cor: 'BIR COR',
                                    comp_prof: 'Company Profile',
                                    menu_list: 'Menu List',
                                    store_persp: 'Store Perspective',
                                    franch_letter: 'Franchise Letter',
                                    car_letter: 'CAR Letter',
                                    service_letter: 'Service Letter',
                                    realty_letter: 'Realty Letter',
                                    hlurb: 'HLURB',
                                };

                                if (key === 'id' || key === 'created_at' ||
                                    key === 'updated_at' || key === 'status') {
                                    return true;
                                }

                                if (tenant_type == 'Individual') {
                                    if (key === 'sec_reg' || key ===
                                        'valid_idSig1' || key === 'valid_idSig2'
                                    ) {
                                        return true;
                                    }
                                } else {
                                    if (key === 'dti_reg' || key ===
                                        'valid_id1' || key === 'valid_id2') {
                                        return true;
                                    }
                                }

                                var documentStatus;

                                if (value == null) {
                                    documentStatus =
                                        '<span class="badge bg-warning">Not Uploaded</span>';
                                } else {
                                    documentStatus =
                                        '<span class="badge bg-success">Uploaded</span>';
                                }

                                var newKeyName = keyMappings[key] || key;

                                var tr = `
                                                    <tr>
                                                        <td class="text-center">${newKeyName}</td>
                                                        <td class="text-center">${documentStatus}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-sta btn-sm viewDocument"
                                                            data-document-name="${value}"
                                                            data-company_name="${company_name}"
                                                            data-documents-id="${key}"
                                                            data-tenant-doc-id="${documentid}"
                                                            data-owner-id="${owner_id}"
                                                            data-bs-target="#tenantCheckDocument" data-bs-toggle="modal">
                                                                <i class="fa fa-pen" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                `;
                                $('#tenant-documents').append(tr);


                            });

                        });

                        $('.viewDocument').click(function () {
                            var documentName = $(this).data('document-name');
                            var company_name = $(this).data('company_name');
                            var documents_id = $(this).data('documents-id');
                            var tenant_doc_id = $(this).data('tenant-doc-id');
                            var owner_id = $(this).data('owner-id');
                            $('#tenant-documents-pdf').empty();
                            $('#tenant-documents-footer').empty();

                            if (documentName == null) {
                                $('#tenant-documents-footer').append(`
                                                    <button class="btn btn-primary" id="upload-File">Upload</button>
                                                    <button class="btn btn-secondary" data-bs-target="#tenantDocuments" data-bs-toggle="modal">Back</button>
                                                    <input type="text" id="tenant-documents-id" name="tenant_doc_id" value="${tenant_doc_id}" hidden>
                                                    <input type="text" id="tenant-documents-id2" name="tenant_doc_id2" value="${documents_id}" hidden>
                                                    <input type="text" id="tenant-documents-owner-id" name="tenant_doc_owner_id" value="${owner_id}" hidden>
                                                    <input type="file" id="tenant-documents-file" name="tenant_doc_file" style="display: none;"/>
                                                `);
                                $('#tenant-documents-pdf').append(`
                                                    <img class="" src="https://as1.ftcdn.net/v2/jpg/08/43/39/72/1000_F_843397211_gPMOVXz9VjqN4uSxqQqwY2U1HgACwmAE.jpg" width="40%" height="100%" style="border: none;">
                                                `);
                            } else {
                                var fileExtension = documentName.split('.').pop()
                                    .toLowerCase();

                                $('#tenant-documents-footer').append(`
                                                    <button class="btn btn-secondary" data-bs-target="#tenantDocuments" data-bs-toggle="modal">Back</button>
                                                `);
                                if (['jpg', 'jpeg', 'png', 'gif'].includes(
                                    fileExtension)) {
                                    $('#tenant-documents-pdf').append(`
                                                        <img src="{{ asset('storage/tenant_documents') }}/${company_name}/${documentName}" width="100%" height="100%" style="border: none; object-fit: cover;">
                                                    `);
                                } else if (fileExtension === 'pdf') {
                                    $('#tenant-documents-pdf').append(`
                                                        <iframe id="tenant-documents-pdf" src="{{ asset('storage/tenant_documents') }}/${company_name}/${documentName}" width="100%" height="100%" style="border: none;"></iframe>
                                                    `);
                                } else {
                                    $('#tenant-documents-pdf').append(`
                                                        <p>Unsupported file type</p>
                                                    `);
                                }
                            }

                            $('#upload-File').click(function () {
                                $('#tenant-documents-file').trigger('click');
                                var tenant_doc_id = $('#tenant-documents-id')
                                    .val();
                                var tenant_doc_id2 = $('#tenant-documents-id2')
                                    .val();
                                var owner_id = $('#tenant-documents-owner-id')
                                    .val();
                                $('#tenant-documents-file').on('change',
                                    function () {
                                        var e = this.files[0];
                                        var formData = new FormData();
                                        formData.append('tenant_doc_id',
                                            tenant_doc_id);
                                        formData.append('tenant_doc_id2',
                                            tenant_doc_id2);
                                        formData.append(
                                            'tenant_doc_owner_id',
                                            owner_id);
                                        formData.append('tenant_doc_file',
                                            e);
                                        $.ajax({
                                            url: "{{ route('admin.submit.documents') }}",
                                            type: "POST",
                                            processData: false,
                                            contentType: false,
                                            data: formData,
                                            success: function (
                                                data) {
                                                window.location
                                                    .reload();
                                                // console.log(data);
                                            },
                                            error: function (xhr,
                                                status, error) {
                                                console.log(xhr
                                                    .responseText
                                                );
                                            }
                                        });
                                    });
                            });
                        });

                    }
                });

            });

        });

        function delete_tenant_func(tenant_id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('admin.delete.tenants') }}",
                        type: 'POST',
                        data: {
                            id: tenant_id
                        },
                        success: function (response) {
                            console.log(response);
                            $.notify({
                                content: response.status,
                                title: 'Success!',
                                icon: "fa fa-bell"
                            }, {
                                type: 'success',
                                placement: {
                                    from: 'top',
                                    align: 'right',
                                },
                                time: 1000,
                                delay: 1500,
                            });
                        },
                        error: function (xhr, status, error) {
                            $.notify({
                                content: 'Something went wrong, please try again!',
                                title: 'Error!',
                                icon: "fa fa-bell"
                            }, {
                                type: 'danger',
                                placement: {
                                    from: 'top',
                                    align: 'right',
                                },
                                time: 1000,
                                delay: 1500,
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection