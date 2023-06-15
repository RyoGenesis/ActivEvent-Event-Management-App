<x-ladmin-auth-layout>
    <x-slot name="title">List of Majors</x-slot>
    @can(['ladmin.major.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.major.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Major</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\MajorDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>