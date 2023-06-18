<x-ladmin-auth-layout>
    <x-slot name="title">Edit Faculty</x-slot>
    <form action="{{ route('ladmin.faculty.update', $faculty->id) }}" method="POST">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name"
                value="{{ old('name', $faculty->name) }}" placeholder="Name" />
        </div>
        <div class="text-end">
            <x-ladmin-button>Update</x-ladmin-button>
        </div>
    </form>
</x-ladmin-auth-layout>