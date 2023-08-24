@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4"><h3>Change Password</h3></div>
    <div class="d-flex justify-content-center">
        <div class="card pt-4" style="width:565pt;border-radius:10%">
            <div class="card-body">
                <form action="{{route("changepassword.update")}}" method="post">
                    @csrf
                    <div class="row mb-3 justify-content-center mb-4">
                        <div class="col-md-8">
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password" placeholder="Current Password">

                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center mb-4">
                        <div class="col-md-8">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password" placeholder="New Password">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center mb-4">
                        <div class="col-md-8">
                            <input id="new_password_confirm" type="password" class="form-control @error('new_password_confirm') is-invalid @enderror" name="new_password_confirm" required autocomplete="new-password" placeholder="New Password Confirmation">

                            @error('new_password_confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row my-4 justify-content-center">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            
        </div>    
    </div>
    
</div>
@endsection
