<x-ladmin-auth-layout>
    <x-slot name="title">Edit Role</x-slot>
    <form action="{{ route('ladmin.role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Role Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name"
                value="{{ old('name', $role->name) }}" placeholder="Role Name" />
        </div>
        <div class="text-end">
            <x-ladmin-button>Update</x-ladmin-button>
        </div>
    </form>
</x-ladmin-auth-layout>