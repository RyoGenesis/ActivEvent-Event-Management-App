<x-ladmin-auth-layout>
    <x-slot name="title">List of Faculties</x-slot>
    @can(['ladmin.faculty.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.faculty.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Faculty</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\FacultyDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>