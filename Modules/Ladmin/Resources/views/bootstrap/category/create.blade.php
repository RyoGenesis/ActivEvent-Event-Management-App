<x-ladmin-auth-layout>
    <x-slot name="title">Add New Category</x-slot>
    <form id="create-form" action="{{ route('ladmin.category.store') }}" method="POST">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name" 
                value="{{ old('name') }}" placeholder="Name" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="display_name" class="form-label col-lg-3">Display Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="display_name" type="text" class="col" required name="display_name" 
                value="{{ old('display_name') }}" placeholder="Display Name" />
        </div>
        <div class="text-end">
            <x-ladmin-button id="submit-btn">Submit</x-ladmin-button>
        </div>
    </form>

    <x-slot name="scripts">
        <script>
            $(window).ready(function() {
                $('#create-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>