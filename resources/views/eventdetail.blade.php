@extends('layouts.app')

@section('content')
<div class="container bg-light border border-dark-subtle border-3 mt-4">
    <div class="row">
        <div class="col-6 ps-5">
            <div class="mb-4 mt-5">
                <a href="{{ url()->previous() }} " style="text-decoration:none">Go back</a>
            </div>
            <div class="ps-5">
                <h1 class="fw-bold mb-3">{{$event->name}}</h1>
                <p>{{$event->date}}</p>
                <p>created by {{$event->community->name}}</p>
                <div class="row my-3">
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
                <div class="row">
                    <div class="col-6">
                        <h4 class="fw-bold">Category Event</h2>
                        <p class="fs-5">{{$event->category->name}}</p>
                    </div>
                    <div class="col-6 ps-5">
                        <h4 class="fw-bold">Topic Event</h4>
                        <p class="fs-5">{{$event->topic}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 class="fw-bold">Available Slot</h4>
                        <p class="fs-5">{{$event->max_slot}}</p>
                    </div>
                    <div class="col-6 ps-5">
                        <h4 class="fw-bold">Location</h4>
                        <p class="fs-5">{{$event->location}}</p>
                    </div>
                </div>
    
                <div>
                    <h4 class="fw-bold">Description</h4>
                    <p class="fs-5 text-left">{{$event->description}}</p>
                </div>
            </div>
        </div>
        <div class="col-6" style="padding: 0%">
            <img src="{{$event->image}}" alt="gambar {{$event->image}}" style="max-width: 40rem; height:43rem" class="float-end">
        </div>
    </div>
    
    <div class="row">
        <div class="col-4">
        </div>
        <div class="col-8 d-flex justify-content-center py-5">
            @if (Auth::check())
                register
            @else
                <a href="/login" class="btn btn-primary">register</a>
            @endif
        </div>
    </div>

</div>

@endsection