@extends('layouts.app')

@section('content')
    <div class="container text-center"><h3>Profile</h3></div>

    <div class="d-flex justify-content-center">
        <div class="card" style="width:50rem">
            <div class="card-body ms-5  ps-5 pe-3">
                <a href="/editprofile" class="fa-solid fa-xl fa-pencil d-flex justify-content-end my-3 pe-3" style="text-decoration: none; color:black"></a>
                <div class="row mb-4">
                    <div class="col">
                        <h5 class="text-primary">Name</h5>
                        <div class="fs-6">{{$user->name}}</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">NIM</h5>
                        <div class="fs-6">{{$user->nim}}</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Phone</h5>
                        <div class="fs-6">{{$user->phone}}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <h5 class="text-primary">Email</h5>
                        <div class="fs-6">{{$user->email}}</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Personal Email</h5>
                        <div class="fs-6"></div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Campus</h5>
                        @empty($user->campus)
                            <div class="fs-6">Empty</div>
                        @else
                            <div class="fs-6">{{$user->campus->name}}</div>
                        @endempty
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <h5 class="text-primary">Faculty</h5>
                        @empty($user->faculty)
                            <div class="fs-6">Empty</div>
                        @else
                            <div class="fs-6">{{$user->faculty->name}}</div>
                        @endempty
                    </div>

                    <div class="col-4">
                        <h5 class="text-primary">Major</h5>
                        @empty($user->major)
                            <div class="fs-6">Empty</div>
                        @else
                            <div class="fs-6">{{$user->major->name}}</div>
                        @endempty
                    </div>
                </div>

                <div>
                    <h5 class="text-primary">Passion</h5>
                    @empty($user->topics)
                        <div class="fs-6">
                            Empty
                        </div>
                    @else
                        <div class="fs-5">
                            {{$user->topics}}
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-3 pt-3">
        <div class="row">
            <div class="col">
                <h3>Your Up Coming Event</h3>
            </div>
            <div class="col">
                <a href="/prevevent" class="btn btn-secondary">History Event</a>
            </div>
        </div>
        <table class="table table-secondary mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Event name</th>
                    <th scope="col">date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="table-light">
                        <th>{{$loop->iteration}}</th>
                        <th>{{$event->name}}</th>
                        <th>{{$event->date}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection