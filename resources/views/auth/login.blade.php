@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-auth">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Login</h3>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row justify-content-center mb-4">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center mb-4">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Log In
                                </button>
                            </div>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" style="text-decoration: none;" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        @endif
                            <p>
                                Don't have an account? <a href="{{ route('register') }}" style="text-decoration: none;">Create One</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
