@php
    $back = route('ladmin.admin.index');
@endphp

@can(['ladmin.admin.index'])
    <a href="{{ route('ladmin.admin.edit', [$id, 'back' => $back]) }}" class="btn btn-sm btn-primary">View</a>
@endcan