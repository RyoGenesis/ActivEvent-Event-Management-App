<x-ladmin-auth-layout>
    <x-slot name="title">List of Communities</x-slot>
    @can(['ladmin.community.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.community.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Community</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\CommunityDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
</x-ladmin-auth-layout>