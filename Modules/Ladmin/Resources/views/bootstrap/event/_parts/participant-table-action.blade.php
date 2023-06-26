<div class="d-grid gap-2">
  @can(['ladmin.event.participant'])
    <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#reject-modal">
        Reject
    </button>
  @endcan
</div>