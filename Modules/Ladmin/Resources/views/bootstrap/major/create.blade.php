<x-ladmin-auth-layout>
    <x-slot name="title">Add New Major</x-slot>
    <form id="create-form" action="{{ route('ladmin.major.store') }}" method="POST">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name" 
                value="{{ old('name') }}" placeholder="Name" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="faculty_id" class="form-label col-lg-3">Faculty <span class="text-danger">*</span></label>
            <div class="col">
                <select name="faculty_id" id="faculty_id" data-placeholder="Select faculty" class="form-select form-control @error('faculty_id') is-invalid @enderror">
                    <option></option>
                    @foreach ($faculties as $faculty)
                        <option value="{{$faculty->id}}">{{ $faculty->name }}</option>
                    @endforeach
                </select>
                @error('faculty_id')
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
            $('#faculty_id').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });

            $(window).ready(function() {
                $('#create-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>