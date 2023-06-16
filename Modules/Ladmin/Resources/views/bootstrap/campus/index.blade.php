<x-ladmin-auth-layout>
    <x-slot name="title">List of Campuses</x-slot>
    @can(['ladmin.campus.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.campus.create', ladmin()->back()) }}" class="btn btn-primary text-white">&plus; Add New Campus</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\CampusDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>