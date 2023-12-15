<x-ladmin-auth-layout>
    <x-slot name="title">Admin Details</x-slot>
    
    <form id="edit-form" action="{{ route('ladmin.admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include( ladmin()->view_path('admin._parts._form'), ['admin' => $admin] )

        @include(ladmin()->view_path('admin._parts._role'), ['admin' => $admin])

        <input type="hidden" name="id" value="{{ $admin->id }}">

        <div class="text-end">
            <x-ladmin-button id="submit-btn">Update</x-ladmin-button>
        </div>

    </form>
    <x-slot name="scripts">
        <script>
            $('#roles').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            $(window).ready(function() {
                $('#edit-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>
