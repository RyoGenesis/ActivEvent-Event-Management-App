@php
    $back = route('ladmin.event.highlight.index');
@endphp
<div class="d-grid gap-2">
  @can(['ladmin.highlight.index'])
      <a href="{{ route('ladmin.event.show', [$id, 'back' => $back]) }}" class="btn btn-sm btn-warning">
        View
      </a>

      <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#remove-modal">
        Remove
      </button>
  @endcan
</div>