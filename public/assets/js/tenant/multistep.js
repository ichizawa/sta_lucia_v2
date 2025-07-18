$(document).ready(function () {
    $('#tenantType').change(function () {
        $('#company-docu').empty();
        var div = '';
        if ($(this).val() == 'Individual') {
            div = `
            <div class="form-group col-md-6">
                <label for="">DTI Registration</label>
                <input type="file" name="dti" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (1st)</label>
                <input type="file" name="valid_id1" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (2nd)</label>
                <input type="file" name="valid_id2" class="form-control"/>
            </div>
            `;
        } else {
            div = `
            <div class="form-group col-md-6">
                <label for="">SEC Registration w/ Articles of Incopration</label>
                <input type="file" name="sec_reg" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (1st of Signatory)</label>
                <input type="file" name="valid_idSig1" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (2nd of Signatory)</label>
                <input type="file" name="valid_idSig2" class="form-control"/>
            </div>
            `;
        }
        div += `
            <div class="form-group col-md-6">
                <label for="">BIR COR</label>
                <input type="file" name="bir_cor" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Company Profile</label>
                <input type="file" name="comp_prof" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Menu w/ price list</label>
                <input type="file" name="menu_list" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Store Perspective</label>
                <input type="file" name="store_persp" class="form-control"/>
            </div>
            <hr>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Franchisee/Dealers)</label>
                <input type="file" name="franch_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Car Exhibit, if organizer)</label>
                <input type="file" name="car_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Service/Utilities, if organizer)</label>
                <input type="file" name="service_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Realty, if organizer)</label>
                <input type="file" name="realty_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">HLURB and License to Sell (if direct)</label>
                <input type="file" name="hlurb" class="form-control"/>
            </div>
        `;
        $('#company-docu').append(div);
    });

    var toastrShown = {
        step1: false,
        step2: false,
        step3: false,
    };

    function validateStep(step) {
        var isValid = true;

        $('.form-group').removeClass('has-error');
        $('.form-error').remove();
        $('.form-control').css('border-color', '');
        toastrShown[`step${step}`] = false;
        switch (step) {
            case 1:
                $('.step1 .form-group').each(function () {
                    var input = $(this).find('input, select');
                    if (input.prop('required') && !input.val()) {
                        isValid = false;
                        $(this).addClass('has-error');
                        input.css('border-color', 'red');
                    }
                });
                if (!toastrShown.step1 && !isValid) {
                    toastr.error('Please fill out all required fields in Company Information.');
                    toastrShown.step1 = true;
                }
                break;

            case 2:
                $('.step2 .form-group').each(function () {
                    var input = $(this).find('input, select');
                    if (input.prop('required') && !input.val()) {
                        isValid = false;
                        $(this).addClass('has-error');
                        input.css('border-color', 'red');
                    }
                });
                if (!toastrShown.step2 && !isValid) {
                    toastr.error('Please fill out all required fields in Owner Information.');
                    toastrShown.step2 = true;
                }
                break;

            case 3:
                $('.step3 .form-group').each(function () {
                    var input = $(this).find('input, select');
                    if (input.prop('required') && !input.val()) {
                        isValid = false;
                        $(this).addClass('has-error');
                        input.css('border-color', 'red');
                    }
                });
                if (!toastrShown.step3 && !isValid) {
                    toastr.error(
                        'Please fill out all required fields in Representative Information.',
                    );
                    toastrShown.step3 = true;
                }
                break;
            case 4:
                break;
        }

        return isValid;
    }

    function updateProgressBar(step) {
        var steps = [1, 2, 3];

        steps.forEach(function (s) {
            var $circle = $('#step' + s + '-circle');
            var $line = $('#step' + s + '-line');

            if (s < step) {
                $circle.addClass('completed').removeClass('active');
                $line.addClass('completed').removeClass('active');
            } else if (s === step) {
                $circle.addClass('active').removeClass('completed');
                $line.removeClass('completed').addClass('active');
            } else {
                $circle.removeClass('active completed');
                $line.removeClass('active completed');
            }
        });

        $('.progress-bar-line').each(function (index) {
            if (index < step - 1) {
                $(this).addClass('completed');
            } else if (index === step - 1) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active completed');
            }
        });
    }

    function updateTitle(step) {
        var titles = {
            1: 'Tenant Information',
            2: 'Tenant Documents',
            3: 'Tenant Review',
        };
        $('.card-title').text(titles[step]);
    }

    function populateReview() {
        var selectedSubCategories = $('#sub_category')
            .find('option:selected')
            .map(function () {
                return $(this).data('name');
            })
            .get()
            .join(', ');

        var selectedCategories = $('#category')
            .find('option:selected')
            .map(function () {
                return $(this).data('name');
            })
            .get()
            .join(', ');

        var companyInfo = `
            
            <h2>Company Information</h5>
            <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>Tenant Type:</strong> ${$('#tenantType').val()}</p>
                </div>
                <div class="col-md-6"> 
                    <p><strong>Company Name:</strong> ${$('#tenant_cmpname').val()}</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>Store Name:</strong> ${$('#tenant_strname').val()}</p>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                    <p><strong>Company Address:</strong> ${$('#company_address').val()}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col"> 
                    <p><strong>Category:</strong> ${selectedCategories || 'None'}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col"> 
                <p><strong>Sub Category:</strong> ${selectedSubCategories || 'None'}</p>
                </div>
               
            </div>
           
        `;

        var ownerInfo = `

            <h2>Owner Information</h5>
             <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>First Name:</strong> ${$('#owner_fname').val()}</p>
                </div>
                <div class="col-md-6"> 
                    <p><strong>Last Name:</strong> ${$('#owner_lname').val()}</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>Position:</strong> ${$('#owner_position').val()}</p>
                </div>
                <div class="col-md-6"> 
                    <p><strong>Home Address:</strong> ${$('#owner_address').val()}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Email:</strong> ${$('#owner_email').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Telephone:</strong> ${$('#owner_telephone').val()}</p>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Office Hours:</strong> ${$('#owner_officehrs').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>After Office Hours:</strong> ${$('#owner_aftrofficehrs').val()}</p>
                </div>
               
            </div>
              <div class="row">
                <div class="col"> 
                    <p><strong>Mobile No.:</strong> ${$('#owner_mobile').val()}</p>
                </div>
            </div>
        `;

        var repInfo = `
            <h2>Representative Information</h5>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>First Name:</strong> ${$('#rep_fname').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Last Name:</strong> ${$('#rep_lname').val()}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Position:</strong> ${$('#rep_position').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Home Address:</strong> ${$('#rep_address').val()}</p>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Email:</strong> ${$('#rep_email').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Telephone:</strong> ${$('#rep_telephone').val()}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Office Hours:</strong> ${$('#rep_officehrs').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>After Office Hours:</strong> ${$('#rep_aftrofficehrs').val()}</p>
                </div>
               
            </div>
              <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Mobile No.:</strong> ${$('#rep_mobile').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Password:</strong> ${$('#rep_password').val()}</p>
                </div>
               
            </div>
        `;

        $('#review-company-info').html(companyInfo);
        $('#review-owner-info').html(ownerInfo);
        $('#review-rep-info').html(repInfo);
    }

    function showStep(step) {
        $('.main-step-1, .step4, .step5').hide().removeClass('active');
        $('#next-button1').hide();
        $('#next-button2').hide();
        $('#submit-button').hide();

        switch (step) {
            case 1:
                $('.main-step-1').show().addClass('active');
                // $('.main-step-1').attr('hidden', false);
                // $('.step4').attr('hidden', true);
                $('#next-button1').show();
                break;
            case 2:
                $('.step4').show().addClass('active');
                $('#next-button2').show();
                $('#back-button').show();
                // $('.step4').attr('hidden', false);
                // $('.main-step-1').attr('hidden', true);
                // $('.step5').attr('hidden', true);
                break;
            case 3:
                // $('.step5').show().addClass('active');
                // $('.step4').attr('hidden', true);
                // $('.main-step-1').attr('hidden', true);
                $('.step5').show().addClass('active');
                $('#submit-button').show();
                populateReview();
                break;
        }
        updateProgressBar(step);
        // updateTitle(step);
    }

    $('#next-button1').click(function (event) {
        event.preventDefault();
        // if (validateStep(1)) {
            
        // }
        showStep(2);
    });

    $('#back-button').click(function (event) {
        event.preventDefault();
        showStep(1);
    });

    $('#next-button2').click(function (event) {
        event.preventDefault();
        // if (validateStep(3)) {
            
        // }
        showStep(3);
    });

    $('#back-button1').click(function (event) {
        event.preventDefault();
        showStep(2);
    });

    // $('#next-button3').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(4)) {
    //         showStep(5);
    //     }
    // });

    $('#submit-button').click(function (event) {
        event.preventDefault();
        // if (validateStep(5)) {
            var form = new FormData($('#addTenentsForm')[0]);

            $.ajax({
                url: submintTenantUrl,
                method: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#addTenentsForm').trigger('reset');
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.href = '/admin/tenants';
                    }, 1000);
                },
                error: function (xhr, status, error) {
                    console.error(status);
                },
            });
        // }
    });

    

    // $('#step1-circle').click(function (event) {
    //     event.preventDefault();
    //     showStep(1);
    // });

    // $('#step2-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(1)) {
    //         showStep(2);
    //     }
    // });

    // $('#step3-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(2)) {
    //         showStep(3);
    //     }
    // });

    // $('#step4-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(3)) {
    //         showStep(4);
    //     }
    // });

    // $('#step5-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(4)) {
    //         showStep(5);
    //     }
    // });

    $('#sub_category').select2({
        theme: 'classic',
        placeholder: 'Select an option',
    });

    
    $("#spaceprop").select2({
        theme: 'classic',
        placeholder: 'Select an option',
    });

    $('#category').select2({
        theme: 'classic',
        placeholder: 'Select an option',
    });

    $('#category').on('change', function () {
        var categoryID = $(this).val();
        var subCategorySelect = $('#sub_category');

        // console.log(categoryID);
        if (categoryID && categoryID.length > 0) {
            $.ajax({
                url: getSubCategory,
                type: 'GET',
                data: {
                    categoryID: categoryID,
                },
                success: function (data) {
                    subCategorySelect.empty();
                    $.each(data, function (index, subCategory) {
                        subCategorySelect.append(
                            $('<option></option>')
                                .val(subCategory.id)
                                .text(subCategory.name)
                                .attr('data-name', subCategory.name),
                        );
                    });
                    subCategorySelect.trigger('change.select2');
                },
                error: function (xhr) {
                    console.error('Error fetching sub-categories:', xhr.responseText);
                },
            });
        } else {
            subCategorySelect.empty();
            subCategorySelect.trigger('change.select2');
        }
    });
});


$(document).ready(function () {
    $('#LeasetenantType').change(function () {
        $('#Leasecompany-docu').empty();
        var div = '';
        if ($(this).val() == 'Individual') {
            div = `
            <div class="form-group col-md-6">
                <label for="">DTI Registration</label>
                <input type="file" name="dti" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (1st)</label>
                <input type="file" name="valid_id1" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (2nd)</label>
                <input type="file" name="valid_id2" class="form-control"/>
            </div>
            `;
        } else {
            div = `
            <div class="form-group col-md-6">
                <label for="">SEC Registration w/ Articles of Incopration</label>
                <input type="file" name="sec_reg" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (1st of Signatory)</label>
                <input type="file" name="valid_idSig1" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Valid ID (2nd of Signatory)</label>
                <input type="file" name="valid_idSig2" class="form-control"/>
            </div>
            `;
        }
        div += `
            <div class="form-group col-md-6">
                <label for="">BIR COR</label>
                <input type="file" name="bir_cor" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Company Profile</label>
                <input type="file" name="comp_prof" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Menu w/ price list</label>
                <input type="file" name="menu_list" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Store Perspective</label>
                <input type="file" name="store_persp" class="form-control"/>
            </div>
            <hr>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Franchisee/Dealers)</label>
                <input type="file" name="franch_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Car Exhibit, if organizer)</label>
                <input type="file" name="car_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Service/Utilities, if organizer)</label>
                <input type="file" name="service_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Endorsement Letter (For Realty, if organizer)</label>
                <input type="file" name="realty_letter" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
                <label for="">HLURB and License to Sell (if direct)</label>
                <input type="file" name="hlurb" class="form-control"/>
            </div>
        `;
        $('#Leasecompany-docu').append(div);
    });

    var toastrShown = {
        step1: false,
        step2: false,
        step3: false,
    };

    function validateStep(step) {
        var isValid = true;

        $('.form-group').removeClass('has-error');
        $('.form-error').remove();
        $('.form-control').css('border-color', '');
        toastrShown[`step${step}`] = false;
        switch (step) {
            case 1:
                $('.step1 .form-group').each(function () {
                    var input = $(this).find('input, select');
                    if (input.prop('required') && !input.val()) {
                        isValid = false;
                        $(this).addClass('has-error');
                        input.css('border-color', 'red');
                    }
                });
                if (!toastrShown.step1 && !isValid) {
                    toastr.error('Please fill out all required fields in Company Information.');
                    toastrShown.step1 = true;
                }
                break;

            case 2:
                $('.step2 .form-group').each(function () {
                    var input = $(this).find('input, select');
                    if (input.prop('required') && !input.val()) {
                        isValid = false;
                        $(this).addClass('has-error');
                        input.css('border-color', 'red');
                    }
                });
                if (!toastrShown.step2 && !isValid) {
                    toastr.error('Please fill out all required fields in Owner Information.');
                    toastrShown.step2 = true;
                }
                break;

            case 3:
                $('.step3 .form-group').each(function () {
                    var input = $(this).find('input, select');
                    if (input.prop('required') && !input.val()) {
                        isValid = false;
                        $(this).addClass('has-error');
                        input.css('border-color', 'red');
                    }
                });
                if (!toastrShown.step3 && !isValid) {
                    toastr.error(
                        'Please fill out all required fields in Representative Information.',
                    );
                    toastrShown.step3 = true;
                }
                break;
            case 4:
                break;
        }

        return isValid;
    }

    function updateProgressBar(step) {
        var steps = [1, 2, 3];

        steps.forEach(function (s) {
            var $circle = $('#step' + s + '-circle');
            var $line = $('#step' + s + '-line');

            if (s < step) {
                $circle.addClass('completed').removeClass('active');
                $line.addClass('completed').removeClass('active');
            } else if (s === step) {
                $circle.addClass('active').removeClass('completed');
                $line.removeClass('completed').addClass('active');
            } else {
                $circle.removeClass('active completed');
                $line.removeClass('active completed');
            }
        });

        $('.progress-bar-line').each(function (index) {
            if (index < step - 1) {
                $(this).addClass('completed');
            } else if (index === step - 1) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active completed');
            }
        });
    }

    function updateTitle(step) {
        var titles = {
            1: 'Tenant Information',
            2: 'Tenant Documents',
            3: 'Tenant Review',
        };
        $('.card-title').text(titles[step]);
    }

    function populateReview() {
        var selectedSubCategories = $('#sub_category')
            .find('option:selected')
            .map(function () {
                return $(this).data('name');
            })
            .get()
            .join(', ');

        var selectedCategories = $('#category')
            .find('option:selected')
            .map(function () {
                return $(this).data('name');
            })
            .get()
            .join(', ');

        var companyInfo = `
            
            <h2>Company Information</h5>
            <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>Tenant Type:</strong> ${$('#tenantType').val()}</p>
                </div>
                <div class="col-md-6"> 
                    <p><strong>Company Name:</strong> ${$('#tenant_cmpname').val()}</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>Store Name:</strong> ${$('#tenant_strname').val()}</p>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                    <p><strong>Company Address:</strong> ${$('#company_address').val()}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col"> 
                    <p><strong>Category:</strong> ${selectedCategories || 'None'}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col"> 
                <p><strong>Sub Category:</strong> ${selectedSubCategories || 'None'}</p>
                </div>
               
            </div>
           
        `;

        var ownerInfo = `

            <h2>Owner Information</h5>
             <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>First Name:</strong> ${$('#owner_fname').val()}</p>
                </div>
                <div class="col-md-6"> 
                    <p><strong>Last Name:</strong> ${$('#owner_lname').val()}</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6"> 
                    <p><strong>Position:</strong> ${$('#owner_position').val()}</p>
                </div>
                <div class="col-md-6"> 
                    <p><strong>Home Address:</strong> ${$('#owner_address').val()}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Email:</strong> ${$('#owner_email').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Telephone:</strong> ${$('#owner_telephone').val()}</p>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Office Hours:</strong> ${$('#owner_officehrs').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>After Office Hours:</strong> ${$('#owner_aftrofficehrs').val()}</p>
                </div>
               
            </div>
              <div class="row">
                <div class="col"> 
                    <p><strong>Mobile No.:</strong> ${$('#owner_mobile').val()}</p>
                </div>
            </div>
        `;

        var repInfo = `
            <h2>Representative Information</h5>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>First Name:</strong> ${$('#rep_fname').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Last Name:</strong> ${$('#rep_lname').val()}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Position:</strong> ${$('#rep_position').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Home Address:</strong> ${$('#rep_address').val()}</p>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Email:</strong> ${$('#rep_email').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Telephone:</strong> ${$('#rep_telephone').val()}</p>
                </div>
               
            </div>
             <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Office Hours:</strong> ${$('#rep_officehrs').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>After Office Hours:</strong> ${$('#rep_aftrofficehrs').val()}</p>
                </div>
               
            </div>
              <div class="row">
                <div class="col-md-6"> 
                    <p><strong>Mobile No.:</strong> ${$('#rep_mobile').val()}</p>
                </div>
                 <div class="col-md-6"> 
                    <p><strong>Password:</strong> ${$('#rep_password').val()}</p>
                </div>
               
            </div>
        `;

        $('#review-company-info').html(companyInfo);
        $('#review-owner-info').html(ownerInfo);
        $('#review-rep-info').html(repInfo);
    }

    function showStep(step) {
        $('.main-step-1, .step4, .step5').hide().removeClass('active');
        $('#next-button1').hide();
        $('#next-button2').hide();
        $('#submit-button-lease').hide();

        switch (step) {
            case 1:
                $('.main-step-1').show().addClass('active');
                // $('.main-step-1').attr('hidden', false);
                // $('.step4').attr('hidden', true);
                $('#next-button1').show();
                break;
            case 2:
                $('.step4').show().addClass('active');
                $('#next-button2').show();
                $('#back-button').show();
                // $('.step4').attr('hidden', false);
                // $('.main-step-1').attr('hidden', true);
                // $('.step5').attr('hidden', true);
                break;
            case 3:
                // $('.step5').show().addClass('active');
                // $('.step4').attr('hidden', true);
                // $('.main-step-1').attr('hidden', true);
                $('.step5').show().addClass('active');
                $('#submit-button-lease').show();
                populateReview();
                break;
        }
        updateProgressBar(step);
        // updateTitle(step);
    }

    $('#next-button1').click(function (event) {
        event.preventDefault();
        // if (validateStep(1)) {
            
        // }
        showStep(2);
    });

    $('#back-button').click(function (event) {
        event.preventDefault();
        showStep(1);
    });

    $('#next-button2').click(function (event) {
        event.preventDefault();
        // if (validateStep(3)) {
            
        // }
        showStep(3);
    });

    $('#back-button1').click(function (event) {
        event.preventDefault();
        showStep(2);
    });

    // $('#next-button3').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(4)) {
    //         showStep(5);
    //     }
    // });

    $('#submit-button-lease').click(function (event) {
        event.preventDefault();
        // if (validateStep(5)) {
            var form = new FormData($('#LeaseaddTenentsForm')[0]);

            $.ajax({
                url: submintTenantUrl,
                method: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#LeaseaddTenentsForm').trigger('reset');
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.href = '/lease-admin/tenants';
                    }, 1000);
                },
                error: function (xhr, status, error) {
                    console.error(status);
                },
            });
        // }
    });

    

    // $('#step1-circle').click(function (event) {
    //     event.preventDefault();
    //     showStep(1);
    // });

    // $('#step2-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(1)) {
    //         showStep(2);
    //     }
    // });

    // $('#step3-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(2)) {
    //         showStep(3);
    //     }
    // });

    // $('#step4-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(3)) {
    //         showStep(4);
    //     }
    // });

    // $('#step5-circle').click(function (event) {
    //     event.preventDefault();
    //     if (validateStep(4)) {
    //         showStep(5);
    //     }
    // });

    $('#sub_category').select2({
        theme: 'classic',
        placeholder: 'Select an option',
    });

    
    $("#spaceprop").select2({
        theme: 'classic',
        placeholder: 'Select an option',
    });

    $('#category').select2({
        theme: 'classic',
        placeholder: 'Select an option',
    });

    $('#category').on('change', function () {
        var categoryID = $(this).val();
        var subCategorySelect = $('#sub_category');

        // console.log(categoryID);
        if (categoryID && categoryID.length > 0) {
            $.ajax({
                url: getSubCategory,
                type: 'GET',
                data: {
                    categoryID: categoryID,
                },
                success: function (data) {
                    subCategorySelect.empty();
                    $.each(data, function (index, subCategory) {
                        subCategorySelect.append(
                            $('<option></option>')
                                .val(subCategory.id)
                                .text(subCategory.name)
                                .attr('data-name', subCategory.name),
                        );
                    });
                    subCategorySelect.trigger('change.select2');
                },
                error: function (xhr) {
                    console.error('Error fetching sub-categories:', xhr.responseText);
                },
            });
        } else {
            subCategorySelect.empty();
            subCategorySelect.trigger('change.select2');
        }
    });
});






