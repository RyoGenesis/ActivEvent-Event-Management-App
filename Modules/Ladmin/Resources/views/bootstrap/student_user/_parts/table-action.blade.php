@php
    $back = route('ladmin.student_user.index');
@endphp
<div class="d-grid gap-2">
  @can(['ladmin.student_user.index'])
      <a href="{{ route('ladmin.student_user.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">
        Edit
      </a>

      <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
        Deactivate
      </button>
  @endcan
</div>