@php
  if(Route::is('ladmin.event.approval.index')) {
    $back = route('ladmin.event.approval.index');
  } else {
    $back = route('ladmin.event.index');
  }
@endphp
<div class="d-grid gap-2">
  @can(['ladmin.event.index'])
      <a href="{{ route('ladmin.event.show', [$id, 'back' => $back]) }}" class="btn btn-sm btn-warning">
        View
      </a>
  
      @can(['ladmin.approval.approve'])
        @if (Route::is('ladmin.event.approval.index'))
        <button type="button" class="btn btn-sm btn-success" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#approve-modal">
          Approve
        </button>
        @endif
      @endcan
  
      @if (Route::is('ladmin.event.index'))
  
        @if ($status == 'Active')
          <a href="{{ route('ladmin.event.participant.index', [$id, 'back' => $back]) }}" class="btn btn-sm btn-success">
            Participants
          </a>
        @endif
  
        {{-- if event hasn't happened then can edit and cancel the event --}}
        @if (\Carbon\Carbon::now() < $date)
          <a href="{{ route('ladmin.event.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">
            Edit
          </a>
      
          <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
            Cancel
          </button>
        @endif
      @endif
  @endcan
</div>