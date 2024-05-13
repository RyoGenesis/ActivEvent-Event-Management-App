@php
    $back = route('ladmin.sat_level.index');
@endphp

@can(['ladmin.sat_level.index'])
    <a href="{{ route('ladmin.sat_level.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete
    </button>
@endcan