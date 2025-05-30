<div class="modal fade" id="addUtilityModalAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{route('admin.add.utility')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Create Utility</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>
