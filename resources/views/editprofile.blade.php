@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h4>Profile Edit</h4>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="row g-4">
                    <div class="col-md-3">
                        <img src="" alt="">
                    </div>
                    <div class="cold-md-8">
                        <div class="form-group-row">
                            {{-- <div class="col g-1">
                                <div class="form-group row py-3"> --}}
                            <label for="name" class="form-label">name :</label>
                            {{-- <div class="col-5"> --}}
                                <input type="text" name="name" id="name" value="nama user" class="form-control @error('name')
                                    is-invalid  
                                @enderror">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            {{-- </div> --}}
                                {{-- </div>
                            </div> --}}

                            <div class="col g-1">
                                <div class="form-group row py-3">
                                    <label for="nim" class="col-3 col-form-label">nim :</label>
                                    <div class="col-5">
                                        <input type="text" name="name" id="name" value="nim user" class="form-control @error('name')
                                          is-invalid  
                                        @enderror">
                                        @error('nim')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection