@extends('layouts')
@section('content')
    @include('admin.components.modals.view-tenant-files-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Tenants</h3>
                <h6 class="op-7 mb-2">Tenants Overview</h6>

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

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            // helper functions (unchanged)
            function capitalize(s) {
                return s ? s.charAt(0).toUpperCase() + s.slice(1) : '';
            }

            function orNA(value) {
                return (value === null || value === undefined || value === '') ? 'N/A' : value;
            }

            // Initialize DataTable exactly as before:
            var dtTenant = $('#multi-filter-select').DataTable({
                processing: false,
                serverSide: false,
                ajax: {
                    url: "{{ route('admin.tenants.data') }}",
                    dataSrc: ''
                },
                columns: [{
                        data: 'company_name',
                        name: 'company_name',
                        render: function(data) {
                            return orNA(data);
                        }
                    },
                    {
                        data: null,
                        name: 'rep_name',
                        render: function(row) {
                            var fname = orNA(row.rep_fname);
                            var lname = orNA(row.rep_lname);
                            if (fname === 'N/A' && lname === 'N/A') return 'N/A';
                            var parts = [];
                            if (row.rep_fname) parts.push(capitalize(row.rep_fname));
                            if (row.rep_lname) parts.push(capitalize(row.rep_lname));
                            return parts.length ? parts.join(' ') : 'N/A';
                        }
                    },
                    {
                        data: 'store_name',
                        name: 'store_name',
                        render: function(data) {
                            return orNA(data);
                        }
                    },
                    {
                        data: 'company_address',
                        name: 'company_address',
                        render: function(data) {
                            return orNA(data);
                        }
                    },
                    {
                        data: 'rep_address',
                        name: 'rep_address',
                        render: function(data) {
                            return orNA(data);
                        }
                    },
                    {
                        data: 'rep_email',
                        name: 'rep_email',
                        render: function(data) {
                            return orNA(data);
                        }
                    },
                    {
                        data: 'rep_status',
                        name: 'rep_status',
                        render: function(val) {
                            if (val === null || val === undefined) {
                                return '<span class="badge bg-secondary">N/A</span>';
                            }
                            return val ?
                                '<span class="badge bg-success">Active</span>' :
                                '<span class="badge bg-warning">Pending</span>';
                        }
                    },
                    {
                        data: 'doc_status',
                        name: 'doc_status',
                        render: function(val) {
                            if (val === null || val === undefined) {
                                return '<span class="badge bg-secondary">N/A</span>';
                            }
                            return val ?
                                '<span class="badge bg-success">Approved</span>' :
                                '<span class="badge bg-warning">Pending</span>';
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(row) {
                            return `
          <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-warning btn-sm view_documents"
                    data-owner-id="${row.owner_id}"
                    data-company-name="${row.company_name}"
                    data-tenant-type="${row.tenant_type}"
                    data-docu-status="${row.doc_status}"
                    data-bs-toggle="modal"
                    data-bs-target="#tenantDocuments">
              <i class="fa fa-pen"></i>
            </button>
            <button class="btn btn-danger btn-sm deleteTenant"
                    data-owner-id="${row.owner_id}">
              <i class="fa fa-trash"></i>
            </button>
          </div>`;
                        }
                    }
                ],
                autoWidth: false,
                responsive: true,
                language: {
                    info: "_START_-_END_ of _TOTAL_ tenants",
                    searchPlaceholder: "Search tenants",
                    paginate: {
                        next: '<i class="dw dw-right-chevron"></i>',
                        previous: '<i class="dw dw-left-chevron"></i>'
                    }
                },
                order: [
                    [2, 'asc']
                ]
            });

            // Delegate “view_documents” clicks (so it works on Ajax‐loaded rows)
            $('#multi-filter-select').on('click', '.view_documents', function() {
                var owner_id = $(this).data('owner-id');
                var tenant_type = $(this).data('tenant-type');
                var company_name = $(this).data('company-name');
                var docu_status = $(this).data('docu-status');

                // Clear previous contents
                $('#tenant-documents').empty();
                $('#tenant-doc-stats').empty();

                $.ajax({
                    url: "{{ route('admin.tenant.documents') }}",
                    type: "GET",
                    data: {
                        owner_id: owner_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#tenant-documents').empty();
                        $('#tenant-doc-stats').empty();

                        var checkFalse = true;
                        $.each(data[0].documents, function(key, value) {
                            if (tenant_type === 'Individual') {
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

                        // Always append a “Close” button
                        $('#tenant-doc-stats').append(`
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          `);

                        // Only show “Approve Documents” if not already approved (status ≠ 1) AND all required files exist
                        if (!checkFalse && data[0].status !== 1) {
                            $('#tenant-doc-stats').prepend(`
              <button type="button" class="btn btn-primary approveTenantDocuments" data-owner-id="${owner_id}">
                Approve Documents
              </button>
            `);
                        } else if (data[0].status !== 1 && checkFalse) {
                            // If all files are present but status ≠ 1, still show Approve
                            $('#tenant-doc-stats').prepend(`
              <button type="button" class="btn btn-primary approveTenantDocuments" data-owner-id="${owner_id}">
                Approve Documents
              </button>
            `);
                        }

                        // Bind approve button (delegate in case it’s dynamic)
                        $('#tenant-doc-stats').off('click', '.approveTenantDocuments').on(
                            'click', '.approveTenantDocuments',
                            function() {
                                var oid = $(this).data('owner-id');
                                $.ajax({
                                    url: "{{ route('admin.tenant.documents.approve') }}",
                                    type: "POST",
                                    data: {
                                        ownerid: oid
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        console.log(response);
                                        $.notify({
                                            content: "Documents successfully approved!",
                                            title: 'Success!',
                                            text: 'Successfully approved tenant documents.',
                                            icon: "fa fa-bell"
                                        }, {
                                            type: 'success',
                                            placement: {
                                                from: 'top',
                                                align: 'right'
                                            },
                                            time: 1000,
                                            delay: 1500,
                                        });

                                        // Update DataTable cell
                                        dtTenant.rows().every(function(rowIdx,
                                            tableLoop, rowLoop) {
                                            var d = this.data();
                                            if (d.owner_id == oid) {
                                                d.doc_status = 1;
                                                this.invalidate();
                                            }
                                        });
                                        dtTenant.draw(false);
                                        $('#tenantDocuments').modal('hide');
                                    },
                                    error: function(xhr, status, error) {
                                        $.notify({
                                            content: 'Something went wrong, please try again!',
                                            title: 'Error!',
                                            icon: "fa fa-bell"
                                        }, {
                                            type: 'danger',
                                            placement: {
                                                from: 'top',
                                                align: 'right'
                                            },
                                            time: 1000,
                                            delay: 1500,
                                        });
                                    }
                                });
                            });





                        // Build the list of document rows
                        $.each(data, function(key, value) {
                            var documentid = value.document_id;
                            $.each(value.documents, function(field, filename) {
                                // Skip the meta‐fields
                                if (field === 'id' || field === 'created_at' ||
                                    field === 'updated_at' || field === 'status'
                                    ) {
                                    return true;
                                }
                                // Skip irrelevant fields based on tenant type
                                if (tenant_type === 'Individual' && (field ===
                                        'sec_reg' || field === 'valid_idSig1' ||
                                        field === 'valid_idSig2')) {
                                    return true;
                                }
                                if (tenant_type !== 'Individual' && (field ===
                                        'dti_reg' || field === 'valid_id1' ||
                                        field === 'valid_id2')) {
                                    return true;
                                }

                                var displayName;
                                switch (field) {
                                    case 'dti_reg':
                                        displayName = 'DTI Registration';
                                        break;
                                    case 'valid_id1':
                                        displayName = 'Valid ID 1';
                                        break;
                                    case 'valid_id2':
                                        displayName = 'Valid ID 2';
                                        break;
                                    case 'sec_reg':
                                        displayName = 'SEC Registration';
                                        break;
                                    case 'valid_idSig1':
                                        displayName = 'Valid ID Signature 1';
                                        break;
                                    case 'valid_idSig2':
                                        displayName = 'Valid ID Signature 2';
                                        break;
                                    case 'bir_cor':
                                        displayName = 'BIR COR';
                                        break;
                                    case 'comp_prof':
                                        displayName = 'Company Profile';
                                        break;
                                    case 'menu_list':
                                        displayName = 'Menu List';
                                        break;
                                    case 'store_persp':
                                        displayName = 'Store Perspective';
                                        break;
                                    case 'franch_letter':
                                        displayName = 'Franchise Letter';
                                        break;
                                    case 'car_letter':
                                        displayName = 'CAR Letter';
                                        break;
                                    case 'service_letter':
                                        displayName = 'Service Letter';
                                        break;
                                    case 'realty_letter':
                                        displayName = 'Realty Letter';
                                        break;
                                    case 'hlurb':
                                        displayName = 'HLURB';
                                        break;
                                    default:
                                        displayName = field;
                                }

                                var statusBadge = filename == null ?
                                    '<span class="badge bg-warning">Not Uploaded</span>' :
                                    '<span class="badge bg-success">Uploaded</span>';

                                var tr = `
                <tr>
                  <td class="text-center">${displayName}</td>
                  <td class="text-center">${statusBadge}</td>
                  <td class="text-center">
                    <a class="btn btn-sta btn-sm viewDocument"
                       data-document-name="${filename}"
                       data-company_name="${company_name}"
                       data-documents-id="${field}"
                       data-tenant-doc-id="${documentid}"
                       data-owner-id="${owner_id}"
                       data-bs-target="#tenantCheckDocument"
                       data-bs-toggle="modal">
                      <i class="fa fa-pen" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>`;
                                $('#tenant-documents').append(tr);
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Delegate delete button click (unchanged)
            $('#multi-filter-select').on('click', '.deleteTenant', function() {
                delete_tenant_func($(this).data('owner-id'));
            });

            // Pusher: reload DataTable when tenant.documents channel fires
            Pusher.logToConsole = true;
            const pusher = new Pusher('1eedc3e004154aadb5dc', {
                cluster: 'ap1',
                forceTLS: true
            });
            const channel = pusher.subscribe('tenant.documents');
            channel.bind('tenant.document.changed', function() {
                dtTenant.ajax.reload(null, false);
            });
        });
    </script>
@endsection
