<x-ladmin-auth-layout>
    <x-slot name="title">Add New Admin</x-slot>

    <form id="create-form" action="{{ route('ladmin.admin.store') }}" method="POST">
        @csrf

        @include(ladmin()->view_path('admin._parts._form'), ['admin' => ladmin()->admin()])
        @include(ladmin()->view_path('admin._parts._role'), ['admin' => ladmin()->admin()])
        
        <div class="text-end">
            <x-ladmin-button id="submit-btn">Submit</x-ladmin-button>
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
                $('#create-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>
