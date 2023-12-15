@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 register-col">
            <div class="card card-auth">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h3>Register New Account</h3>
                    </div>
                    <form method="POST" id="registerForm" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Name*">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required placeholder="Email Address*">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required placeholder="Password*">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required placeholder="NIM*">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="Phone*">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <input id="personal_email" type="email" class="form-control @error('personal_email') is-invalid @enderror" name="personal_email" value="{{ old('personal_email') }}" placeholder="Personal Email Address">
                                @error('personal_email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select data-placeholder="Your Campus Location*" class="form-control form-select @error('campus_id') is-invalid @enderror" id="campus_id" name="campus_id">
                                    <option></option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{$campus->id}}">{{$campus->name}}</option>
                                    @endforeach
                                </select>
                                @error('campus_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select data-placeholder="Your Faculty*" class="form-control form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id">
                                    <option></option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-8">
                                <select data-placeholder="Your Major*" class="form-control form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" disabled>
                                </select>
                                @error('major_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
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
                                        {{ $message }}
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
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col col-md-8">
                                <input class="form-control" name="topics" value="{{ old('topics') }}" id="topics" placeholder="Your Topic Interests">
                                <button class='btn btn-warning tags--removeAllBtn mt-3' type='button'>Remove all topics</button>
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center text-center">
                            <div class="col-md-6">
                                <button id="submitRegister" type="submit" class="btn btn-primary">
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
        $(window).ready(function() {
            $('#registerForm').on('submit', function () {
                $('#submitRegister').prop('disabled', true);
            });
        });

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

        document.getElementById('submitRegister').addEventListener('click', function (event) {
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
            document.getElementById('registerForm').submit();

        });
    </script>
@endsection
