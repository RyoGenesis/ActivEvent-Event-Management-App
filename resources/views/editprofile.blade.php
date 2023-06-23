@extends('layouts.app')

@section('content')
    <div class="container text-center mt-3">
        <h2>Edit Profile</h2>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card d-flex justify-content-center" style="width:65rem">
                <div class="form-group btn-reset btn mt-3 me-3">
                    <div class="d-flex justify-content-end">
                        <button name="submit" type="submit" class="btn btn-outline-danger btn-submit btn-sm">
                            <p class="fs-5">Save</p>
                        </button>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-6 px-5 pt-4">
                        <label for="user_name"><h5 class="text-primary">Name</h5></label>
                        <input type="text" id="user_name" value="nama pengguna" class="form-control @error('user_name')
                            is-invalid
                        @enderror">
                        @error('user_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>  
                        @enderror
                    </div>

                    <div class="col-md-6 px-5 pt-4">
                        <label for="major"><h5 class="text-primary">Major</h5></label>
                        <input type="text" value="user_major" id="major" class="form-control @error('major')
                            is-invalid
                        @enderror">
                        @error('major')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 px-5 pt-5">
                        <label for="email"><h5 class="text-primary">Email</h5></label>
                        <input type="email" value="user_email" id="email" class="form-control @error('email')
                            is-invalid
                        @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 px-5 pt-5">
                        <label for="nim"><h5 class="text-primary">Nim</h5></label>
                        <input type="text" value="user_nim" id="nim" class="form-control @error('nim')
                            is-invalid
                        @enderror">
                        @error('nim')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 px-5 pt-5">
                        <label for="DoB"><h5 class="text-primary">DateofBirth</h5></label>
                        <input type="date" value="" id="DoB" class="form-control @error('DoB')
                            is-invalid
                        @enderror">
                        @error('DoB')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 px-5 pt-5">
                        <label for="gender"><h5 class="text-primary">Gender</h5></label>
                        <select class="form-select" id="inputgender">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col px-5 py-5">
                        <label for="passion"><h5 class="text-primary">Passion</h5></label>
                          
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection