<x-ladmin-auth-layout>
    <x-slot name="title">List of Available SAT Levels</x-slot>
    @can(['ladmin.sat_level.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.sat_level.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\SatLevelDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>