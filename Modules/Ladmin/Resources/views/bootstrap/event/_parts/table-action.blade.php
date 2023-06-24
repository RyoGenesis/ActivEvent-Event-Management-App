@php
    $back = route('ladmin.event.index');
@endphp

@can(['ladmin.event.index'])
    <a href="{{ route('ladmin.event.show', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-warning">
      View
    </a>

    @can(['ladmin.approval.approve'])
    @if (Route::is('ladmin.event.approval.index'))
    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#action-item-approve-{{$id}}">
      Approve
    </button>
    @endif
    @endcan

    @if (Route::is('ladmin.event.index'))
    <a href="{{ route('ladmin.event.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Cancel
    </button>
    @endif
@endcan