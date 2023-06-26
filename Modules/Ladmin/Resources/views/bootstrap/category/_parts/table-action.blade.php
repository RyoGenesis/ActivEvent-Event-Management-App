@php
    $back = route('ladmin.category.index');
@endphp
<div class="d-grid gap-2 d-sm-block">
  @can(['ladmin.category.index'])
      <a href="{{ route('ladmin.category.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">
        Edit
      </a>

      <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
        Delete
      </button>
  @endcan
</div>