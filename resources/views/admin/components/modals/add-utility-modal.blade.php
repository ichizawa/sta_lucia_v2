<div class="modal fade" id="addUtilityModalAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{route('admin.add.utility')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Create Utility</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <label>Utility Name</label>
                <input type="text" class="form-control" name="utility_name" placeholder="Enter Utility Name" required />
              </div>
              <div class="col-md-6">
                <label>Utility Type</label>
                <input type="text" class="form-control" name="utility_type" placeholder="Enter Utility Type" required />
              </div>
              <div class="col-md-12">
                <label>Utility Price</label>
                <input type="number" class="form-control" name="utility_price" placeholder="Enter Utility Price" required />
              </div>
              <div class="col-md-12">
                <label>Utility Description</label>
                <textarea class="form-control" name="utility_description" placeholder="Enter Utility Description" rows="4" required></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Utility</button>
        </div>
      </form>
    </div>
  </div>
</div>