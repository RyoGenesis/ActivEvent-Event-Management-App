@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <div>Welcome, {{Auth::user()->name}}</div>
    @endauth
    <div class="container-fluid mb-2">
        <h3 class="mb-4">Popular event</h3>
        <div class="row">
            <div class="col-sm-12">
                <div id="carouselControl" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    @foreach ($event as $event)
                                    @if ($loop->first or $loop->iteration <=3)
                                        <div class="col">
                                            <div class="card">
                                                <img src="{{$event->image}}" alt="gambar {{$event->name}}" class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$event->name}}</h5>
                                                    <p class="card-text">
                                                        <p class="fs-6">
                                                            {{$event->date}}
                                                        </p>
                                                        <p class="fs-6">
                                                            <small class="text-body-secondary">
                                                                Posted by {{$event->community->name}}
                                                            </small> 
                                                        </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="container">
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    @foreach ($event as $event1)
                                        @if ($loop->iteration >2)
                                        <div class="col">
                                            <div class="card h-500">
                                                <img src="{{$event->image}}" alt="gambar {{$event->name}}" class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$event->name}}</h5>
                                                    <p class="card-text">
                                                        <p class="fs-6">
                                                            {{$event->date}}
                                                        </p>
                                                        <p class="fs-6">
                                                            <small class="text-body-secondary">
                                                                Posted by {{$event->community->name}}
                                                            </small> 
                                                        </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselControl" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselControl" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt-2">
        <h3 class="mb-4">Featured Event</h3>
        <div class="row">
            <div class="col-sm-12">
                <div id="carouselControl2" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    @foreach ($event as $event2)
                                    @if ($loop->first or $loop->iteration <=3)
                                        <div class="col">
                                            <div class="card">
                                                <img src="{{$event->image}}" alt="gambar {{$event->name}}" class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$event->name}}</h5>
                                                    <p class="card-text">
                                                        <p class="fs-6">
                                                            {{$event->date}}
                                                        </p>
                                                        <p class="fs-6">
                                                            <small class="text-body-secondary">
                                                                Posted by {{$event->community->name}}
                                                            </small> 
                                                        </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="container">
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    @foreach ($event as $event3)
                                        @if ($loop->iteration >2)
                                        <div class="col">
                                            <div class="card h-500">
                                                <img src="{{$event->image}}" alt="gambar {{$event->name}}" class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$event->name}}</h5>
                                                    <p class="card-text">
                                                        <p class="fs-6">
                                                            {{$event->date}}
                                                        </p>
                                                        <p class="fs-6">
                                                            <small class="text-body-secondary">
                                                                Posted by {{$event->community->name}}
                                                            </small> 
                                                        </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselControl2" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselControl2" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
