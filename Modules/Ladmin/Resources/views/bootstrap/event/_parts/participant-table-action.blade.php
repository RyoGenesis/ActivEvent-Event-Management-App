<div class="d-grid gap-2">
  @can(['ladmin.event.participant'])
    @if (\Carbon\Carbon::now() < $maxRejectDate)
      <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#reject-modal">
          Reject
      </button>
    @endif
  @endcan
</div>