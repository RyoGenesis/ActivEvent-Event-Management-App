<x-ladmin-auth-layout>
    <x-slot name="title">Edit Student</x-slot>
    <form id="edit-form" action="{{ route('ladmin.student_user.update', $userStudent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name" 
                value="{{ old('name', $userStudent->name) }}" placeholder="Name" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="email" class="form-label col-lg-3">E-mail Address <span class="text-danger">*</span></label>
            <x-ladmin-input id="email" type="email" class="col" required name="email"
                value="{{ old('email', $userStudent->email) }}" placeholder="E-mail Address" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="nim" class="form-label col-lg-3">NIM <span class="text-danger">*</span></label>
            <x-ladmin-input id="nim" type="text" class="col" required name="nim"
                value="{{ old('nim', $userStudent->nim) }}" placeholder="NIM" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="campus_id" class="form-label col-lg-3">Campus <span class="text-danger">*</span></label>
            <div class="col">
                <select name="campus_id" id="campus_id" data-placeholder="Select campus" class="form-select form-control @error('campus_id') is-invalid @enderror">
                    <option></option>
                    @foreach ($campuses as $campus)
                        <option value="{{$campus->id}}" {{ $campus->id == old('campus_id',$userStudent->campus_id) ? 'selected' : '' }}>{{ $campus->name }}</option>
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
                    <option></option>
                    @foreach ($faculties as $faculty)
                        <option value="{{$faculty->id}}" {{ $faculty->id == old('faculty_id',$userStudent->faculty_id) ? 'selected' : '' }}>{{ $faculty->name }}</option>
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
            <label for="communities" class="form-label col-lg-3">Associated communities</label>
            <div class="col">
                <select name="communities[]" id="communities" data-placeholder="Select communities" class="form-select form-control @error('communities') is-invalid @enderror" multiple>
                    @foreach ($communities as $community)
                        <option value="{{$community->id}}" {{ in_array($community->id, old('communities',$userCommunities)) ? 'selected' : '' }}>{{ $community->name }}</option>
                    @endforeach
                </select>
                @error('communities')
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
            $(window).ready(function() {
                $('#edit-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });

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

            function getMajorFaculty() {
                var facultyEl = $('#faculty_id');
                $.ajax({
                    url : '{{ env("APP_URL") }}' + '/api/faculty-majors',
                    type : 'get',
                    data : {
                        id: facultyEl.val(),
                    },
                    success : function (response) {
                        var majorId = $("#major_id");
                        var studentMajor = {{old('major_id',$userStudent->major_id)}};
                        majorId.html('');
                        majorId.append("<option></option>");
                        $.each(response, function (i, item) {
                            var selected = (item['id'] == studentMajor ? ' selected' : '');
                            majorId.append("<option value='" + item['id'] + "'" + selected +">" + item['name'] + "</option>");
                        });
                        majorId.prop('disabled',false);
                    },
                        error: function(err) {
                    }
                })
            }

            getMajorFaculty();

            $(document).ready(function() {
                $('#faculty_id').change(function() {
                    getMajorFaculty();
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>