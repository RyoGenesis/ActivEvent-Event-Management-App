<x-ladmin-auth-layout>
    <x-slot name="title">Highlight An Event</x-slot>
    <form action="{{ route('ladmin.event.highlight.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="event_id" class="form-label col-lg-3">Event <span class="text-danger">*</span></label>
            <div class="col">
                <select name="event_id" id="event_id" data-placeholder="Select event to highlight" class="form-select form-control @error('event_id') is-invalid @enderror">
                    <option></option>
                    @foreach ($events as $event)
                        <option value="{{$event->id}}">{{ '(' . $event->community->display_name . ') ' . $event->name }}</option>
                    @endforeach
                </select>
                @error('event_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="text-end">
            <x-ladmin-button>Submit</x-ladmin-button>
        </div>
    </form>
    <x-slot name="scripts">
        <script>
            $('#event_id').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>