<x-ladmin-auth-layout>
    <x-slot name="title">Add New Community</x-slot>
    <form id="create-form" action="{{ route('ladmin.community.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="row d-flex align-items-center mb-3">
            <label for="majors" class="form-label col-lg-3">Associated Majors</label>
            <div class="col">
                <select name="majors[]" id="majors" data-placeholder="Select majors" class="form-select form-control @error('majors') is-invalid @enderror" multiple>
                    @foreach ($majors as $major)
                        <option value="{{$major->id}}" {{ in_array($major->id, old('majors',[])) ? 'selected' : '' }}>{{ $major->name }}</option>
                    @endforeach
                </select>
                @error('majors')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="text-end">
            <x-ladmin-button id="submit-btn">Submit</x-ladmin-button>
        </div>
    </form>
    <x-slot name="scripts">
        <script>
            $('#majors').select2({
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