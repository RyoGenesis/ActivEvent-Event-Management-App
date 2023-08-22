@extends('layouts.app')

@section('content')
    <div class="container text-center mt-3">
        <h2>Edit Profile</h2>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <form action="{{route('editprofile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card d-flex justify-content-center" style="width:65rem">
                <div class="form-group btn-reset btn mt-3 me-3">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-danger btn-submit btn-sm">
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
                        <select class="form-control form-select @error('campus_id') is-invalid @enderror" id="campus_id" name="campus_id">
                            <option value="{{$user->campus->id}}">
                                <p class="fw-lighter">{{$user->campus->name}}</p>
                            </option>
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

                <div class="form-group row g-3">
                    <div class="col-md-6 px-5 pt-5">
                        <label for="faculty_id"><h5 class="text-primary">Faculty</h5></label>
                        <select class="form-control form-select @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id">
                            <option value="{{$user->faculty->id}}">
                                <p class="fw-lighter">{{$user->faculty->name}}</p>
                            </option>
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

                    <div class="col-md-6 px-5 pt-5">
                        <label for="major_id"><h5 class="text-primary">Major</h5></label>
                        <select class="form-control form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id">
                            <option value="{{$user->major->id}}">
                                <p class="fw-lighter">{{$user->major->name}}</p>
                            </option>
                            @foreach ($majors as $major)
                                <option value="{{$major->id}}">{{$major->name}}</option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
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
                        <label for="passion"><h5 class="text-primary">Passion</h5></label>
                        <input class="form-control" name="topics" value="name, name1 ">
                        <button class='tags--removeAllBtn mt-3' type='button'>Remove all tags</button>

                    </div>
                </div>
            </div>  
        </form>
    </div>
@endsection

@section('scripts')
<script>
    var input = document.querySelector("input[name=topics]");
    tagify = new Tagify(input, {
      whitelist: ["nama3, nama4, nama5"],
      maxTags: 10,
      dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
      }
    });
    document.querySelector('.tags--removeAllBtn')
    .addEventListener('click', tagify.removeAllTags.bind(tagify))

</script>
@endsection

