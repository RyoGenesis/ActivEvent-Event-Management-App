@extends('layouts.app')

@section('content')
<div class="container bg-light border border-dark-subtle border-3 mt-4">
    <div class="row">
        <div class="col-6 p-3">
            <div class="my-3 ps-4">
                <a href="{{ url()->previous() }}" class="fa fa-2xl fa-arrow-left" style="text-decoration:none; color:black"></a>
            </div>
            <div class="px-5">
                <h1 class="fw-bold mb-3">{{$event->name}}</h1>
                <p class="fs-5 mb-0">posted by {{$event->community->name}}</p>
                <p class="fw-bold text-danger">Registration closing at : {{$event->registration_end->format('j F Y - H:i \W\I\B')}}</p>
                <div class="row pb-3">
                    <div class="col">
                        @if ($event->has_certificate)
                            <span class="d-inline-flex rounded-pill bg-success py-1 px-2 m-1 fs-5 text-light">
                                E-Certificate
                            </span>
                        @endif
                        @if ($event->has_sat)
                            <span class="d-inline-flex rounded-pill bg-info py-1 px-2 m-1 fs-5 text-dark">
                                SAT Point - {{$event->sat_level->name}} Level
                            </span>
                        @endif
                        @if ($event->has_comserv)
                            <span class="d-inline-flex rounded-pill bg-warning py-1 px-2 m-1 fs-5 text-dark">
                                Community Service Hour
                            </span>
                        @endif
                        @if ($event->exclusive_member)
                            <span class="d-inline-flex rounded-pill bg-danger py-1 px-2 m-1 fs-5 text-light">
                                Member Exclusive
                            </span>
                        @endif
                        @if ($event->exclusive_major)
                            <span class="d-inline-flex rounded-pill bg-danger py-1 px-2 m-1 fs-5 text-light">
                                Target Major(s) Exclusive
                            </span>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="fw-bold">Date and Time</h4>
                    <p class="fs-5">{{$event->date->format('l, j F Y - H:i \W\I\B')}}</p>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Event Category</h2>
                        <p class="fs-5">{{$event->category->display_name}}</p>
                    </div>
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Topic</h4>
                        <p class="fs-5">{{$event->topic ?? '-'}}</p>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Maximum Slot</h4>
                        <p class="fs-5">{{$event->max_slot == -1 ? 'No Limit' : $event->max_slot}}</p>
                    </div>
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Location</h4>
                        <p class="fs-5">{{$event->location}}</p>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Speaker</h4>
                        <p class="fs-5">{{$event->speaker ?? '-'}}</p>
                    </div>
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Registration Fee</h4>
                        <p class="fs-5">{{$event->price == 0 ? 'Free' : 'Rp. '.number_format($event->price,2,',','.')}}</p>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Contact Person</h4>
                        <p class="fs-5">{{$event->contact_person ?? '-'}}</p>
                    </div>
                    <div class="col col-md-6">
                        <h4 class="fw-bold">Targeted Major</h4>
                        <p class="fs-5">
                            @forelse ($event->majors as $major)
                                @if ($loop->last)
                                    {{$major->name}}
                                @else
                                    {{$major->name}}, 
                                @endif
                            @empty
                                Open to everyone
                            @endforelse
                        </p>
                    </div>
                </div>
                @if ($event->has_sat)
                <div class="row py-1">
                    <div class="col">
                        <h4 class="fw-bold">BGA for this event</h4>
                        <p class="fs-5">
                            @forelse ($event->bgas as $bga)
                                @if ($loop->last)
                                    {{$bga->name}}
                                @else
                                    {{$bga->name}}, 
                                @endif
                            @empty
                                -
                            @endforelse
                        </p>
                    </div>
                </div>
                @endif
                <div>
                    <h4 class="fw-bold">Description</h4>
                    <p class="fs-5 text-left">{!!$event->description!!}</p>
                </div>
            </div>
        </div>
        <div class="col-6" style="padding: 0%">
            <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar acara {{$event->name}}" style="height:43rem" class="float-end img-fluid">
            <div class="row">
                <div class="col d-flex justify-content-center py-5">
                    @if (Auth::check())
                        {{-- wip for register event--}}
                        @if ($registered)
                            <form action="{{route('cancelregistration')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$event->id}}">
                                <button type="submit" class="btn btn-lg btn-danger">Cancel</button>
                            </form>
                        @else
                            <form action="{{route('registration')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$event->id}}">
                                <button type="submit" class="btn btn-lg btn-primary">Register</button>
                            </form>
                        @endif
                    @else
                        <a href="{{route('login')}}" class="btn btn-primary btn-lg">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection