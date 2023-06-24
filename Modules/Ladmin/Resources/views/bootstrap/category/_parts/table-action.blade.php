@php
    $back = route('ladmin.category.index');
@endphp

@can(['ladmin.category.index'])
    <a href="{{ route('ladmin.category.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete
    </button>
@endcan