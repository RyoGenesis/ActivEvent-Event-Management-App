<x-ladmin-auth-layout>
    <x-slot name="title">List of Events</x-slot>
    @can(['ladmin.event.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.event.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Event</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\EventDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>