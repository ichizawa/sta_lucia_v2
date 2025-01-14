$(document).ready(function () {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: 'toast-top-right',
        preventDuplicates: false,
        showDuration: '1000',
        hideDuration: '1000',
        timeOut: '5000',
        extendedTimeOut: '1000',
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut',
    };

    var fixedWidth = '200px';

    $('#basic-datatables thead th').css('min-width', fixedWidth);

    $('#basic-datatables tbody td').css('min-width', fixedWidth);

    if (!$.fn.DataTable.isDataTable('#basic-datatables')) {
        $('#basic-datatables').DataTable({});
    }

    $('#client').DataTable({
        pageLength: 10,
    });

    if (!$.fn.DataTable.isDataTable('#multi-filter-select')) {
        $('#multi-filter-select').DataTable({
            pageLength: 10,
        });
    }
});