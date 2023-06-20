<x-ladmin-auth-layout>
    <x-slot name="title">Add New Student</x-slot>
    <form action="{{ route('ladmin.student_user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name" 
                value="{{ old('name') }}" placeholder="Name" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="email" class="form-label col-lg-3">E-mail Address <span class="text-danger">*</span></label>
            <x-ladmin-input id="email" type="email" class="col" required name="email"
                value="{{ old('email') }}" placeholder="E-mail Address" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="nim" class="form-label col-lg-3">NIM <span class="text-danger">*</span></label>
            <x-ladmin-input id="nim" type="text" class="col" required name="nim"
                value="{{ old('nim') }}" placeholder="NIM" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="campus_id" class="form-label col-lg-3">Campus <span class="text-danger">*</span></label>
            <div class="col">
                <select name="campus_id" id="campus_id" data-placeholder="Select campus" class="form-select form-control @error('campus_id') is-invalid @enderror">
                    @foreach ($campuses as $campus)
                        <option value="{{$campus->id}}">{{ $campus->name }}</option>
                    @endforeach
                </select>
                @error('campus_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="faculty_id" class="form-label col-lg-3">Faculty <span class="text-danger">*</span></label>
            <div class="col">
                <select name="faculty_id" id="faculty_id" data-placeholder="Select faculty" class="form-select form-control @error('faculty_id') is-invalid @enderror">
                    @foreach ($faculties as $faculty)
                        <option value="{{$faculty->id}}">{{ $faculty->name }}</option>
                    @endforeach
                </select>
                @error('faculty_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="major_id" class="form-label col-lg-3">Major <span class="text-danger">*</span></label>
            <div class="col">
                <select name="major_id" id="major_id" data-placeholder="Select major" class="form-select form-control @error('major_id') is-invalid @enderror" disabled>
                </select>
                @error('major_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="communities" class="form-label col-lg-3">Associated communities <span class="text-danger">*</span></label>
            <div class="col">
                <select name="communities[]" id="communities" data-placeholder="Select communities" class="form-select form-control @error('communities') is-invalid @enderror" multiple>
                    @foreach ($communities as $community)
                        <option value="{{$community->id}}">{{ $community->name }}</option>
                    @endforeach
                </select>
                @error('communities')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="text-end">
            <x-ladmin-button>Submit</x-ladmin-button>
        </div>
    </form>
    <x-slot name="scripts">
        <script>
            $('#campus_id').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });

            $('#faculty_id').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });

            $('#major_id').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });

            $('#communities').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            $(document).ready(function() {
                $('#faculty_id').change(function() {
                    $.ajax({
                        url : '{{ env("APP_URL") }}' + '/api/faculty-majors',
                        type : 'get',
                        data : {
                            id: $(this).val(),
                        },
                        success : function (response) {
                            var majorId = $("#major_id");
                            majorId.html('');
                            $.each(response, function (i, item) {
                                majorId.append("<option value='" + item['id'] + "'>" + item['name'] + "</option>");
                            });
                            majorId.prop('disabled',false);
                        },
                        error: function(err) {
                        }
                    })
                });
            });
        </script>
        {{-- <script src="{{asset('/js/custom-js-admin.js')}}"></script> --}}
    </x-slot>
</x-ladmin-auth-layout>