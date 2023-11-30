@extends('layouts.app')

@section('title','ActivEvent | Your Profile')

@section('content')
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" color="white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container mb-3">
            <a href="/home" style="text-decoration: none">Home</a> > <small>Profile</small>
        <h3 class="text-center">Profile</h3>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card profile-card">
            <div class="card-body ms-2 ps-5 pe-3">
                <a href="{{route("editprofile")}}" class="fa-solid fa-xl fa-pencil d-flex justify-content-end my-3 pe-3" style="text-decoration: none; color:black"></a>
                <div class="row">
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Name</h5>
                        <div class="fs-6">{{$user->name}}</div>
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">NIM</h5> 
                        <div class="fs-6">{{$user->nim}}</div>
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Phone</h5>
                        <div class="fs-6">{{$user->phone}}</div>
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Email</h5>
                        @empty($user->email)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->email}}</div>
                        @endempty
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Personal Email</h5>
                        @empty($user->personal_email)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->personal_email}}</div>
                        @endempty
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Campus</h5>
                        @empty($user->campus)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->campus->name}}</div>
                        @endempty
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Faculty</h5>
                        @empty($user->faculty)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->faculty->name}}</div>
                        @endempty
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
                        <h5 class="text-primary">Major</h5>
                        @empty($user->major)
                            <div class="fs-6">-</div>
                        @else
                            <div class="fs-6">{{$user->major->name}}</div>
                        @endempty
                    </div>
                    <div class="col-6 col-sm-4 mb-3">
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
                <div class="mb-3">
                    <h5 class="text-primary">Preferred Event Category</h5>
                    <div class="fs-6">
                        @forelse ($user->categories as $category)
                            @if ($loop->last)
                                {{$category->display_name}}
                            @else
                                {{$category->display_name}}, 
                            @endif
                        @empty
                            -
                        @endforelse
                    </div>
                </div>

                <div>
                    <h5 class="text-primary mb-2">Topic Interests</h5>
                    @if(!$user->topics)
                        <div class="fs-6">-</div>
                    @else
                        @foreach ($topicInterests as $topic)
                            <span class="d-inline-flex rounded-pill bg-info text-light px-2 py-1 m-1 fs-6">
                                {{$topic}}
                            </span>
                        @endforeach
                    @endempty
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-4 pt-md-3">
        <div class="row">
            <div class="col" id="upcoming">
                <h3>Your Upcoming Events</h3>
            </div>
            <div class="col">
                <a href="{{route('eventhistory')}}" class="btn btn-secondary">Event History</a>
            </div>
        </div>
        @if ($upcomingEvents->isEmpty())
        <div class="mx-auto py-5 text-center">
            <p class="fs-5">You currently don't have any upcoming event</p>
        </div>
        @else
        <div class="table-responsive-sm px-0 px-md-5 mt-3">
            <table id="upcomingEvents" class="table table-secondary pt-2">
                <thead>
                    <tr>
                        <th scope="col" class="fs-5">#</th>
                        <th scope="col" class="fs-5">Event name</th>
                        <th scope="col" class="fs-5">Held by</th>
                        <th scope="col" class="fs-5">Date</th>
                        <th scope="col" class="fs-5">Status</th>
                        <th scope="col" class="fs-5">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($upcomingEvents as $event)
                        <tr class="table-light">
                            <th></th>
                            <th>{{$event->name}}</th>
                            <th>{{$event->community->display_name}}</th>
                            <th>{{$event->date->format('l, j F Y - H:i \W\I\B')}}</th>
                            <th>
                                @if ($event->pivot->status == 'Registered')
                                <p class="text-success">
                                    {{$event->pivot->status}}
                                </p>
                                @else
                                <p class="text-danger">
                                    {{$event->pivot->status}}
                                </p>
                                <p>
                                    Reasoning : {{$event->pivot->reasoning}}
                                </p>
                                @endif
                            </th>
                            <th class="d-grid gap-1">
                                <a href="/eventdetail/{{$event->id}}" class="btn btn-primary">View</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcancel">
                                    Cancel
                                </button>
                                <form action="{{route('cancelregistration')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$event->id}}">
        
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
                                                <button type="submit" class="btn btn-secondary btn-danger">Yes</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        {{-- only when rejected event is present --}}
        @if (!$rejectedEvents->isEmpty())
        <div class="row mt-2">
            <div class="col" id="rejected-and-cancelled">
                <h3>Rejected and Cancelled Events</h3>
            </div>
        </div>
        <div class="table-responsive-sm px-0 px-md-5 mt-3">
            <table id="rejectedEvents" class="table table-secondary pt-2">
                <thead>
                    <tr>
                        <th scope="col" class="fs-5">#</th>
                        <th scope="col" class="fs-5">Event name</th>
                        <th scope="col" class="fs-5">Held by</th>
                        <th scope="col" class="fs-5">Date</th>
                        <th scope="col" class="fs-5">Status</th>
                        <th scope="col" class="fs-5">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rejectedEvents as $event)
                        <tr class="table-light">
                            <th></th>
                            <th>{{$event->name}}</th>
                            <th>{{$event->community->display_name}}</th>
                            <th>{{$event->date->format('l, j F Y - H:i \W\I\B')}}</th>
                            <th>
                                @if ($event->pivot->status == 'Rejected')
                                <p class="text-danger">
                                    {{$event->pivot->status}}
                                </p>
                                <p>
                                    Reasoning : {{$event->pivot->reasoning}}
                                </p>
                                @else
                                <p class="text-danger">
                                    Cancelled
                                </p>
                                @endif
                            </th>
                            <th class="d-grid gap-1">
                                <a href="/eventdetail/{{$event->id}}" class="btn btn-primary">View</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
@if (!$upcomingEvents->isEmpty())
    <script>
        $(document).ready(function() {
            const table = $('#upcomingEvents').DataTable( {
                dom: 'frtp',
                "lengthMenu": 10,
                "columnDefs": [
                    { "searchable": false, "targets": [0,5] },
                    { "orderable": false, "targets": [0,5]}
                ]
            } );

            table.on('order.dt search.dt', function () {
                let i = 1;
    
                table.cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            }).draw();
        }); 

    </script>
@endif
@if (!$rejectedEvents->isEmpty())
    <script>
        $(document).ready(function() {
            const rejectTable = $('#rejectedEvents').DataTable( {
                dom: 'frtp',
                "lengthMenu": 10,
                "columnDefs": [
                    { "searchable": false, "targets": [0,5] },
                    { "orderable": false, "targets": [0,5]}
                ]
            } );

            rejectTable.on('order.dt search.dt', function () {
                let i = 1;
    
                table.cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            }).draw();
        });
    </script>
@endif
@endsection