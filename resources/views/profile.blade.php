@extends('layouts.app')

@section('content')
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="container text-center"><h3>Profile</h3></div>

    <div class="d-flex justify-content-center">
        <div class="card" style="width:50rem">
            <div class="card-body ms-5  ps-5 pe-3">
                <a href="{{route("editprofile")}}" class="fa-solid fa-xl fa-pencil d-flex justify-content-end my-3 pe-3" style="text-decoration: none; color:black"></a>
                <div class="row mb-3">
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
                        @empty($user->email)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->email}}</div>
                        @endempty
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Personal Email</h5>
                        @empty($user->personal_email)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->personal_email}}</div>
                        @endempty
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Campus</h5>
                        @empty($user->campus)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->campus->name}}</div>
                        @endempty
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <h5 class="text-primary">Faculty</h5>
                        @empty($user->faculty)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->faculty->name}}</div>
                        @endempty
                    </div>

                    <div class="col-4">
                        <h5 class="text-primary">Major</h5>
                        @empty($user->major)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->major->name}}</div>
                        @endempty
                    </div>

                    <div class="col-4">
                        <h5 class="text-primary">Communities</h5>
                        <div class="fs-6">
                            @forelse ($user->communities as $community)
                                @if ($loop->last)
                                    {{$community->display_name}}
                                @else
                                    {{$community->display_name}}, 
                                @endif
                            @empty
                                -
                            @endforelse
                        </div>
                    </div>
                </div>

                <div>
                    <h5 class="text-primary mb-3">Interested Topics</h5>
                    @if(!$user->topics)
                        <div class="fs-6">-</div>
                    @else
                        @foreach ($topicInterests as $topic)
                            <span class="rounded-pill border border-3 border-success text-success p-1 me-2 fs-6 fw-bold">
                                {{$topic}}
                            </span>                           
                        @endforeach
                    @endempty
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-3 pt-3">
        <div class="row">
            <div class="col">
                <h3>Your Upcoming Event</h3>
            </div>
            <div class="col">
                <a href="{{route('historyevent')}}" class="btn btn-secondary">History Event</a>
            </div>
        </div>
        @if ($upcomingEvents->isEmpty())
        <div class="mx-auto py-5 text-center">
            <p class="fs-5">You currently don't have any upcoming event</p>
        </div>
        @else
        <table class="table table-secondary mt-5">
            <thead>
                <tr>
                    <th scope="col" class="fs-4">#</th>
                    <th scope="col" class="fs-4">Event name</th>
                    <th scope="col" class="fs-4">Date</th>
                    <th scope="col" class="fs-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upcomingEvents as $event)
                    <tr class="table-light">
                        <th>{{$loop->iteration}}</th>
                        <th>{{$event->name}}</th>
                        <th>{{$event->date}}</th>
                        <th class="row justify-content-center">
                            <div class="col-2">
                                <a href="/eventdetail/{{$event->id}}" class="btn btn-primary">View</a>
                            </div>
                            <div class="col-2">
                                <form action="{{route('cancelregistration')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$event->id}}">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcancel">
                                        Cancel
                                    </button>
        
                                    <div class="modal fade" id="modalcancel" tabindex="-1" aria-labelledby="modallabelcancel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modallabelcancel">Cancel Registration</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Confirm to Cancel Your Registration?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <form action="{{route('cancelregistration')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$event->id}}">
                                                <button type="submit" class="btn btn-secondary btn-danger">yes</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                           
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection