@php
    $back = route('ladmin.faculty.index');
@endphp

@can(['ladmin.faculty.index'])
    <a href="{{ route('ladmin.faculty.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete
    </button>
@endcan