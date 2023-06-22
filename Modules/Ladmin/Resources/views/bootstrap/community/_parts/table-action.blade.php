@php
    $back = route('ladmin.community.index');
@endphp

@can(['ladmin.community.index'])
    <a href="{{ route('ladmin.community.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-outline-primary m-1">
      Edit
    </a>

    <button type="button" class="btn btn-sm btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#action-item-{{$id}}">
      Delete
    </button>
  
    <div class="modal fade" id="action-item-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="action-item-{{$id}}-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form action="{{ route('ladmin.community.destroy') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$id}}">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="action-item-{{$id}}-label">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure to delete this?
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