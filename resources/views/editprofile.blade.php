@extends('layouts.app')

@section('content')
    <div class="container text-center mt-3">
        <h2>Edit Profile</h2>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <form action="{{route('editprofile.update')}}" method="POST" enctype="multipart/form-data" id="formeditprofile">
            @csrf
            <div class="card d-flex justify-content-center" style="width:65rem">
                <div class="form-group btn-reset btn mt-3 me-3">
                    <div class="d-flex justify-content-end">
                        <button id='submitbtn' type="submit" class="btn btn-outline-danger btn-submit btn-sm">
                            {{ __('Save') }}          
                        </button>
                    </div>
                </div>
                <div class="form-group row g-3 mt-3">
                    <div class="col-md-6 px-5 pt-4">
                        <label for="name"><h5 class="text-primary">Name</h5></label>
                        <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 px-5 pt-4">
                        <label for="nim"><h5 class="text-primary">Nim</h5></label>
                        <input type="text" value="{{$user->nim}}" id="nim" name="nim"
                        disabled='true' class="form-control @error('nim') is-invalid @enderror">
                        @error('nim')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form group row g-3">
                    <div class="col-md-6 px-5 pt-5">
                        <label for="phone"><h5 class="text-primary">Phone</h5></label>
                        <input type="text" value="{{$user->phone}}" id="phone" name="phone" class="form-control @error('phone')
                            is-invalid
                        @enderror">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 px-5 pt-5">
                        <label for="email"><h5 class="text-primary">Email</h5></label>
                        <input type="email" value="{{$user->email}}" id="email" name="email" disabled= 'true' class="form-control @error('email')
                            is-invalid
                        @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row g-3">
                    <div class="col-md-6 px-5 pt-5">
                        <label for="personal_email"><h5 class="text-primary">Personal Email</h5></label>
                        <input type="email" value="{{$user->personal_email}}" name="personal_email" id="personal_email" class="form-control @error('personal_email')
                            is-invalid
                        @enderror">
                        @error('personal_email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 px-5 pt-5">
                        <label for="campus_id"><h5 class="text-primary">Campus</h5></label>
                        <select data-placeholder="Select campus" class="form-control form-select @error('campus_id') is-invalid @enderror" id="campus_id" name="campus_id">
                            <option></option>
                            @foreach ($campuses as $campus)
                                <option value="{{$campus->id}}" {{ $campus->id == $user->campus_id ? 'selected' : '' }}>
                                    {{$campus->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('campus_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row g-3">
                    <div class="col-md-6 px-5 pt-5">
                        <label for="faculty_id"><h5 class="text-primary">Faculty</h5></label>
                        <select class="form-control form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id">
                            <option></option>
                            @foreach ($faculties as $faculty)
                                <option value="{{$faculty->id}}" {{ $faculty->id == $user->faculty_id ? 'selected' : '' }}>
                                    {{$faculty->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6 px-5 pt-5">
                        <label for="major_id"><h5 class="text-primary">Major</h5></label>
                        <select data-placeholder="Select major" class="form-control form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" disabled>
                        </select>
                        @error('major_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row g-3">
                    <div class="col px-5 pt-5">
                        <label for="communities"><h5 class="text-primary">Communities</h5></label>
                        <select data-placeholder="Select communities" class="form-select form-control @error('communities') is-invalid @enderror" name="communities[]" id="communities" multiple>
                            @foreach ($communities as $community)
                                <option value="{{$community->id}}" {{ in_array($community->id, $userCommunities) ? 'selected' : '' }}>{{ $community->name }}</option>
                            @endforeach
                        </select>
                        @error('communities')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                @if($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
                @endif

                <div class="form-group row g-3">
                    <div class="col px-5 py-5">
                        <label for="topics"><h5 class="text-primary">Topic Interests</h5></label>
                        <input class="form-control" name="topics" value="{{$user->topics}}" multiple id="topics">
                        <button class='btn btn-warning tags--removeAllBtn mt-3' type='button'>Remove all tags</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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
                    var userMajor = {{$user->major_id}};
                    majorId.html('');
                    majorId.append("<option></option>");
                    $.each(response, function (i, item) {
                        var selected = (item['id'] == userMajor ? ' selected' : '');
                        majorId.append("<option value='" + item['id'] + "'" + selected +">" + item['name'] + "</option>");
                });
                    majorId.prop('disabled',false);
                },
                    error: function(err) {
                }
             })
        }

        getMajorFaculty();
        
        $('#faculty_id').change(function() {
            getMajorFaculty();
        });
    });

    var input = document.querySelector("input[name=topics]");
    tagify = new Tagify(input, {
      maxTags: 10,
      dropdown: {
        maxItems: 20,           // <- maximum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
      }
    });
    document.querySelector('.tags--removeAllBtn')
    .addEventListener('click', tagify.removeAllTags.bind(tagify))

    document.getElementById('submitbtn').addEventListener('click', function (event) {
        event.preventDefault();

        if(input.value) {
            var dataInput = JSON.parse(input.value);
            var dataArray = [];
            console.log(dataInput);
    
            dataInput.forEach(function(item){
                console.log(item.value) 
                dataArray.push(item.value);
            });
    
            input.value = dataArray;
        }
        
        console.log(dataArray);
        document.getElementById('formeditprofile').submit();

    });
</script>

@endsection

