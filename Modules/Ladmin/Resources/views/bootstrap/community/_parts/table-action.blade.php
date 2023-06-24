@php
    $back = route('ladmin.community.index');
@endphp

@can(['ladmin.community.index'])
    <a href="{{ route('ladmin.community.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary m-1">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger m-1" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete
    </button>
@endcan