@php
    $back = route('ladmin.campus.index');
@endphp

@can(['ladmin.campus.index'])
    <a href="{{ route('ladmin.campus.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete
    </button>
@endcan