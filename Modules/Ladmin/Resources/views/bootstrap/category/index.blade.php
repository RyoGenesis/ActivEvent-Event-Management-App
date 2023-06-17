<x-ladmin-auth-layout>
    <x-slot name="title">List of Categories</x-slot>
    @can(['ladmin.category.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.category.create', ladmin()->back()) }}" class="btn btn-primary text-white">&plus; Add New Category</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\CategoryDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>