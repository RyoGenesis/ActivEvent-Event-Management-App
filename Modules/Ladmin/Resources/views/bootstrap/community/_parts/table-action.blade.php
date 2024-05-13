@php
    $back = route('ladmin.community.index');
@endphp

<div class="d-grid gap-2">
@can(['ladmin.community.index'])
    <a href="{{ route('ladmin.community.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Delete
    </button>
@endcan
</div>