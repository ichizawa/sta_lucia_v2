<style>
  .form-control.highlight {
    border: 2px solid #8F8258 !important;
  }

  .billnumber {
    color: red !important;
    font-weight: bold !important;
  }
</style>
<form id="cashierOptionsForm" method="POST">
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvasCashier" aria-labelledby="offcanvasResponsiveLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Prepare Bill</h5>
      <button type="button" id="closeCashier" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="container-fluid mt--3">
        <div class="row">
          <!-- <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Tenant Account</label>
              <select id="tnt_search" class="form-control" name="tenant_id" placeholder="Search Tenant" name="tenant_id"
                required>
                <option value="" selected hidden disabled></option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Select Contract</label>
              <select id="cntr_search" class="form-control" name="contract_id" placeholder="Search Contract"
                name="tenant_contract" required>
                <option value="" selected hidden disabled></option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Bill Number</label>
              <input type="text" class="form-control billnumber" name="bill_num" id="bill_num"
                placeholder="Billing Number" readonly />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Total Tenant Sales</label>
              <input type="text" class="form-control" name="sales" id="sales" placeholder="Total Tenant Sales" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label class="form-label">Basic Rent <small class="form-text text-muted">(per sqm)</small></label>
              <input type="text" class="form-control" id="basic_rent" name="brent" placeholder="Basic Rent" readonly />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label class="form-label">Total Basic Rent</label>
              <input type="text" class="form-control" name="total_brent" id="total_brent" placeholder="Total Basic Rent"
                readonly />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label class="form-label">MGR</label>
              <input type="text" class="form-control" name="mgr" id="mgr" placeholder="Minimum Guaranteed Rent"
                readonly />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label class="form-label ">Total MGR</label>
              <input type="text" class="form-control" name="total_mgr" id="total_mgr"
                placeholder="Total Minimum Guaranteed Rent" readonly />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Total Payable Rent (with 5% from sales)</label>
              <input type="text" class="form-control" name="payable_rent" id="total_payable"
                placeholder="Total Basic Rent" readonly />
            </div>
          </div>
          <input name="total_amount_payable" id="total_amount_payable" hidden/> -->
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-label">Remarks</label>
              <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks...." />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Date From</label>
              <input type="month" class="form-control" name="dateFrom" placeholder="Enter Total Sales" required />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Date To</label>
              <input type="month" class="form-control" name="dateTo" placeholder="Enter Total Sales" required />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="offcanvas-foot p-3">
      <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-success">Prepare Bill</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- <script>
  $(document).ready(function (e) {
    $('#tnt_search').selectize({
      sortField: 'text'
    });

    $('#cntr_search').selectize({
      sortField: 'text'
    });

    var tenants = $('#tnt_search')[0].selectize;
    var proposals = $('#cntr_search')[0].selectize;

    $('.create-bill').click(function (e) {
      var data = @json($companies);
      $('#sales').closest('.col-md-12').show();
      $('#total_payable').closest('.col-sm-12').show();
      $('#total_mgr').removeClass('highlight');
      $('#total_payable').removeClass('highlight');
      $('#total_brent').removeClass('highlight');
      tenants.clearOptions();

      $.each(data, function (key, value) {
        tenants.addOption({
          value: value.owner_id,
          text: value.store_name,
          data: {
            prop: value,
          }
        });
      });
    });

    $('#tnt_search').change(function () {
      var data = $('#tnt_search')[0].selectize.options[$(this).val()]?.data?.prop;
      proposals.clearOptions();
      if (data == undefined || data == null) {
        tenants.clearOptions();
      } else {
        $.each(data.proposals, function (key, value) {
          proposals.addOption({
            value: value.id,
            text: value.proposal_uid,
            data: {
              soa: value,
              acc_id: data.acc_id,
            }
          });
        });
      }
    });

    $('#cntr_search').change(function () {
      var data = $('#cntr_search')[0].selectize.options[$(this).val()]?.data;
      const date = new Date();
      const datetoday = ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2) + '-' + date.getFullYear();
      if (data !== undefined && data !== null) {
        $('#bill_num').val(data?.acc_id + '-' + data?.soa.proposal_uid + '-' + data?.soa.id);
        $('#basic_rent').val(data.soa.brent);
        $('#total_brent').val(data.soa.total_rent)
        $('#mgr').val(data.soa.min_mgr);
        $('#total_mgr').val(data.soa.total_mgr);
        if (data.soa.min_mgr == 0) {
          $('#sales').closest('.col-md-12').hide();
          $('#total_payable').closest('.col-sm-12').hide();
          $('#total_brent').addClass('highlight');
          $('#sales').val(0);
          $('#total_payable').val(0);
          $('#total_amount_payable').val(data.soa.total_rent);
        }
      } else {
        $('#cashierOptionsForm')[0].reset();
      }
    });

    $('#sales').keyup(function () {
      var sales = $(this).val();
      var total_rent = $('#total_brent').val();
      var total_mgr = $('#total_mgr').val();
      var total = (parseFloat(sales) * 0.05) + parseFloat(total_rent);
      if (sales !== '') {
        $('#total_payable').val(total.toFixed(2));
        if (total_mgr >= total) {
          $('#total_mgr').addClass('highlight');
          $('#total_payable').removeClass('highlight');
          $('#total_amount_payable').val(total_mgr);
        } else {
          $('#total_mgr').removeClass('highlight');
          $('#total_payable').addClass('highlight');
          $('#total_amount_payable').val(total);
        }
      } else {
        $('#total_payable').val('');
        $('#total_mgr').removeClass('highlight');
        $('#total_payable').removeClass('highlight');
        $('#total_amount_payable').val('');
      }
    });

    $('#cashierOptionsForm').submit(function (e) {
      e.preventDefault();
      var form = new FormData(this);
      $.ajax({
        url: "{{ route('bill.cashier.prepare') }}",
        type: 'POST',
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          console.log(data);
          $('#closeCashier').click();
          var content = {
            message: 'Bill Prepared Successfully!',
            title: "Bill Prepared!",
            icon: "fa fa-bell"
          };

          $.notify(content, {
            type: 'success',
            placement: {
              from: 'top',
              align: 'right',
            },
            time: 1000,
            delay: 2000,
          });
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script> -->