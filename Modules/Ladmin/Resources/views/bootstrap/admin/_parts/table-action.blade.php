@php
    $back = route('ladmin.admin.index');
@endphp

<div class="d-grid gap-2 d-sm-block">
    @can(['ladmin.admin.index'])
        <a href="{{ route('ladmin.admin.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">Edit</a>
    @endcan
    @can(['ladmin.admin.deactivate'])
        @if ($id != 1)
            @if ($deactivated_at == null)
                <button type="button" class="btn btn-sm btn-danger" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#deactivate-modal">
                    Deactivate
                </button>
            @else
                @if ($community['deleted_at'] == null)
                    <button type="button" class="btn btn-sm btn-warning" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#reactivate-modal">
                        Re-activate
                    </button>
                @endif
            @endif
        @endif
    @endcan
</div>