@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:50rem; border-radius:10%">
                <div class="card-body">
                    <div class="card-title text-center my-4">
                        <h3>Register New Account</h3>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name*">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address*">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password*">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autocomplete="nim" autofocus placeholder="NIM*">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone*">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="personal_email" type="email" class="form-control @error('personal_email') is-invalid @enderror" name="personal_email" value="{{ old('personal_email') }}" autocomplete="personal_email" placeholder="Personal Email Address">
                                @error('personal_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select class="form-control form-select @error('campus_id') is-invalid @enderror" id="campus_id" name="campus_id">
                                    <option selected disabled>Your Campus Location*</option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{$campus->id}}">{{$campus->name}}</option>
                                    @endforeach
                                </select>
                                @error('campus_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select class="form-control form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id">
                                    <option selected disabled>Your Faculty*</option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select class="form-control form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" disabled>
                                    <option selected disabled>Your Major*</option>
                                </select>
                                @error('major_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select data-placeholder="Your Communities" class="form-control form-select @error('communities') is-invalid @enderror" id="communities" name="communities[]" multiple>
                                    @foreach ($communities as $community)
                                        <option value="{{$community->id}}">{{$community->display_name}}</option>
                                    @endforeach
                                </select>
                                @error('communities')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select data-placeholder="Your Preferred Event Categories" class="form-control form-select @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->display_name}}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input class="form-control" name="topics" value="{{ old('topics') }}" id="topics" placeholder="Your Topic Interests">
                                <button class='btn btn-warning tags--removeAllBtn mt-3' type='button'>Remove all topics</button>
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                        <div class="text-center">
                            <p>
                                Already have an account? <a href="/login" style="text-decoration: none;">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#communities').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            $('#categories').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

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
                        majorId.append('<option value="" selected disabled>Your Major</option>');
                        $.each(response, function (i, item) {
                            majorId.append("<option value='" + item['id'] + "'>" + item['name'] + "</option>");
                        });
                        majorId.prop('disabled',false);
                    },
                    error: function(err) {
                    }
                });
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
