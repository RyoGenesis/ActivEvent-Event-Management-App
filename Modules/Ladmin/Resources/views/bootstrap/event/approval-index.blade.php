<x-ladmin-auth-layout>
    <x-slot name="title">Approve Events</x-slot>
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\EventDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>