@extends('layouts.app')

@section('content')
<div class="container bg-light border border-dark-subtle border-3 mt-4">
    <div class="row">
        <div class="col-6 ps-5">
            <div class="my-5 ps-4">
                <a href="{{ url()->previous() }}" class="fa fa-2xl fa-arrow-left" style="text-decoration:none; color:black"></a>
            </div>
            <div class="ps-5">
                <h1 class="fw-bold mb-3">{{$event->name}}</h1>
                <p class="fs-5">created by {{$event->community->name}}</p>
                <h4 class="fw-bold">Date and Time</h4>
                <p class="fs-5">{{$event->date}}</p>
                <div class="row py-3">
                    <div class="col">
                        @if ($event->has_certificate == 'true')
                            <span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-5 fw-bold">
                                E-Certificate                                
                            </span>
                        @endif
                        
                        @if ($event->has_sat == 'true')
                            <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-5 fw-bold">
                                SAT Point
                            </span>
                        @endif 

                        @if ($event->has_comserv == 'true')
                            <span class="rounded-pill border border-3 border-warning text-warning p-1 me-2 fs-5 fw-bold">
                                Community Service Hour
                            </span>
                        @endif 
                    </div>
                </div> 
                <div class="row py-3">
                    <div class="col-6">
                        <h4 class="fw-bold">Category Event</h2>
                        <p class="fs-5">{{$event->category->name}}</p>
                    </div>
                    <div class="col-6 ps-5">
                        <h4 class="fw-bold">Topic Event</h4>
                        <p class="fs-5">{{$event->topic}}</p>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-6">
                        <h4 class="fw-bold">Maximum Slot</h4>
                        <p class="fs-5">{{$event->max_slot == -1 ? 'No Limit' : $event->max_slot}}</p>
                    </div>
                    <div class="col-6 ps-5">
                        <h4 class="fw-bold">Location</h4>
                        <p class="fs-5">{{$event->location}}</p>
                    </div>
                </div>

                <div class="row py-3">
                    <div class="col-6">
                        <h4 class="fw-bold">Speaker</h4>
                        @empty($event->speaker)
                            <div class="fs-6">-</div>
                        @else  
                            <div class="fs-6">{{$event->speaker}}</div>
                        @endempty
                    </div>
                    <div class="col-6 ps-5">
                        <h4 class="fw-bold">Contact Person</h4>
                        @empty($event->contact_person)
                            <div class="fs-6">-</div>
                        @else  
                            <div class="fs-6">{{$event->contact_person}}</div>
                        @endempty
                    </div>
                </div>
    
                <div>
                    <h4 class="fw-bold">Description</h4>
                    <p class="fs-5 text-left">{!!$event->description!!}</p>
                </div>
            </div>
        </div>
        <div class="col-6" style="padding: 0%">
            <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar acara {{$event->name}}" style="max-width: 40rem; height:43rem" class="float-end">
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