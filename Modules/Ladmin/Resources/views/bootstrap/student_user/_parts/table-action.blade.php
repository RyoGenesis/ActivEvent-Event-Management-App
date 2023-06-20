@php
    $back = route('ladmin.student_user.index');
@endphp

@can(['ladmin.student_user.index'])
    <a href="{{ route('ladmin.student_user.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#action-item-{{$id}}">
      Deactivate
    </button>
  
    <div class="modal fade" id="action-item-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="action-item-{{$id}}-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form action="{{ route('ladmin.student_user.destroy', [$id]) }}" method="post">
              @csrf
              @method('DELETE')
              <div class="modal-header border-0">
                <h5 class="modal-title" id="action-item-{{$id}}-label">Delete</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure to deactivate this user account?
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-sm btn-danger">Yes</button>
              </div>
            </form>
          </div>
        </div>
    </div>
@endcan