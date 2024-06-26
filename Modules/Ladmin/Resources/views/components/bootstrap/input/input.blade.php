<div {{ $attributes->merge(['class' => $class]) }}>
    @if ($label)
        <div class="{{ $row[0] ?? null }}">
            <label for="{{ $id }}">
                @foreach ($label as $text)
                    {!! $text !!}
                @endforeach
            </label>
        </div>
    @endif
    @include(ladmin()->component_path('input._' . $type))
</div>
