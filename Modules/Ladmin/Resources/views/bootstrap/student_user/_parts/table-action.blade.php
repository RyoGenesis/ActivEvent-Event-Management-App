@php
    $back = route('ladmin.student_user.index');
@endphp

@can(['ladmin.student_user.index'])
    <a href="{{ route('ladmin.student_user.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#delete-modal">
      Deactivate
    </button>
@endcan