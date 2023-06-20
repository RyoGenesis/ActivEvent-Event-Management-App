<x-ladmin-auth-layout>
    <x-slot name="title">List of Students</x-slot>
    @can(['ladmin.student_user.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.student_user.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Student</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\StudentUserDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>