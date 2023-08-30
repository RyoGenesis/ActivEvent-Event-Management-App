@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:50rem; border-radius:10%">
                <div class="card-body">
                    <div class="card-title text-center my-4">
                        <h3>{{ __('Sign Up') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row my-4 justify-content-center">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            {{-- <label for="nim" class="col-md-4 col-form-label text-md-end">{{ __('Nim') }}</label> --}}

                            <div class="col-md-8">
                                <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autocomplete="nim" autofocus placeholder="NIM">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            {{-- <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label> --}}

                            <div class="col-md-8">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            {{-- <label for="campus" class="col-md-4 col-form-label text-md-end">{{ __('Campus') }}</label> --}}
                            <div class="col-md-8">
                                <select class="form-control form-select @error('campus_id') is-invalid @enderror" id="campus_id" name="campus_id">
                                    {{-- loop pake kampus nanti --}}
                                    <option value="" selected disabled>
                                        <p class="fw-lighter">Your Campus Location</p>
                                    </option>
                                    @foreach ($campus as $campus)
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
                            {{-- <label for="faculty" class="col-md-4 col-form-label text-md-end">{{ __('Faculty') }}</label> --}}
                            <div class="col-md-8">
                                <select class="form-control form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id">
                                    <option value="" selected disabled>Your Faculty</option>
                                    @foreach ($faculty as $faculty)
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
                            {{-- <label for="major" class="col-md-4 col-form-label text-md-end">{{ __('Major') }}</label> --}}
                            <div class="col-md-8">
                                <select class="form-control form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" disabled>
                                    <option value="" selected disabled>Your Major</option>
                                </select>
                                @error('major_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Account') }}
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
    </script>
@endsection
