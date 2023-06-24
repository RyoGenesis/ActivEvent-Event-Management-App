@php
    $back = route('ladmin.highlight.index');
@endphp

@can(['ladmin.highlight.index'])
    <a href="{{ route('ladmin.event.show', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-warning">
      View
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#remove-modal">
      Remove
    </button>
@endcan