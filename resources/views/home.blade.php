@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-primary alert-dismissible fade show d-flex align-items-center" role="alert">
        <div>
            Welcome to ActivEvent! Find information about events and activities happening at the university and communities, register to events, and manage your participations here! Explore your interests and be active!
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @auth
        <div class="fs-5 mb-4">Welcome, {{Auth::user()->name}}</div>
    @endauth
    <div class="container-fluid mb-4">
        <div class="row mb-4">
            <h3 class="col-8">Featured events</h3>
            <a href="{{route('featuredevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($featuredEvents->isEmpty())
                <div class="text-dark mx-auto py-5 my-4 text-center">
                    No featured event yet
                </div>
            @else
                <div id="carouselControlFE" class="carousel carousel-dark slide desktop-only" data-bs-interval="false">
                    <div class="carousel-inner">                         
                        @foreach ($featuredEvents as $key => $featuredevent)
                            @if ($key % 3 == 0)
                            <div class="carousel-item {{$key === 0  ? 'active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                            @endif
                                    <div class="col">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$featuredevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$featuredevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$featuredevent->name}}">{{$featuredevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$featuredevent->category->name}}</span>
                                                    @if ($featuredevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($featuredevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($featuredevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$featuredevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$featuredevent->max_slot == -1 ? 'No Limit' : $featuredevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$featuredevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @if ($loop->last || $key == 2)
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @if ($featuredEvents->count() > 3)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlFE" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlFE" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
                <div id="carouselControlFEmini" class="carousel carousel-dark slide mobile-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($featuredEvents as $key => $featuredevent)
                            <div class="carousel-item{{$key === 0  ? ' active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    <div class="col-12 col-md-4">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$featuredevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$featuredevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$featuredevent->name}}">{{$featuredevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$featuredevent->category->name}}</span>
                                                    @if ($featuredevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($featuredevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($featuredevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$featuredevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$featuredevent->max_slot == -1 ? 'No Limit' : $featuredevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$featuredevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>     
                                </div>
                            </div>
                        @endforeach                                     
                    </div>
                    @if ($featuredEvents->count() > 1)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlFEmini" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlFEmini" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>

    <div class="container-fluid mb-4">
        <div class="row mb-4">
            <h3 class="col-8">Latest events</h3>
            <a href="{{route('latestevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($latestEvents->isEmpty())
                <div class="text-dark mx-auto py-5 my-4 text-center">
                    No new event yet
                </div>
            @else
                <div id="carouselControlLE" class="carousel carousel-dark slide desktop-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($latestEvents as $key => $latestevent)
                            @if ($key % 3 == 0)
                            <div class="carousel-item {{$key === 0  ? 'active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                            @endif
                                    <div class="col">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$latestevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$latestevent->image ? asset('storage/'.$latestevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$latestevent->name}}">
        
                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$latestevent->name}}">{{$latestevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$latestevent->category->name}}</span>
                                                    @if ($latestevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($latestevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($latestevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$latestevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$latestevent->max_slot == -1 ? 'No Limit' : $latestevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$latestevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @if ($loop->last || $key == 2)
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @if ($latestEvents->count() > 3)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlLE" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlLE" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
                <div id="carouselControlLEmini" class="carousel carousel-dark slide mobile-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($latestEvents as $key => $activelatestevent)
                            <div class="carousel-item{{$key === 0  ? ' active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    <div class="col-12 col-md-4">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$activelatestevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$activelatestevent->image ? asset('storage/'.$activelatestevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$activelatestevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$latestevent->name}}">{{$activelatestevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$activelatestevent->category->name}}</span>
                                                    @if ($activelatestevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($activelatestevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($activelatestevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$activelatestevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$activelatestevent->max_slot == -1 ? 'No Limit' : $activelatestevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$activelatestevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>     
                                </div>
                            </div>
                        @endforeach       
                    </div>
                    @if ($latestEvents->count() > 1)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlLEmini" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlLEmini" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>

    <div class="container-fluid mb-4">
        <div class="row mb-4">
            <h3 class="col-8">Popular events</h3>
            <a href="{{route('popularevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($popularEvents->isEmpty())
                <div class="text-dark mx-auto py-5 my-4 text-center">
                    No event yet
                </div>
            @else
                <div id="carouselControlPE" class="carousel carousel-dark slide desktop-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($popularEvents as $key => $popularevent)
                            @if ($key % 3 == 0)
                            <div class="carousel-item{{$key === 0  ? ' active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                            @endif
                                    <div class="col">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$popularevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$popularevent->image ? asset('storage/'.$popularevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$popularevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$popularevent->name}}">{{$popularevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$popularevent->category->name}}</span>
                                                    @if ($popularevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($popularevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($popularevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$popularevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$popularevent->max_slot == -1 ? 'No Limit' : $popularevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$popularevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @if ($loop->last || $key == 2)
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @if ($popularEvents->count() > 3)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlPE" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlPE" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
                <div id="carouselControlPEmini" class="carousel carousel-dark slide mobile-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($popularEvents as $key => $popularevent)
                            <div class="carousel-item{{$key === 0  ? ' active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    <div class="col-12 col-md-4">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$popularevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$popularevent->image ? asset('storage/'.$popularevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$popularevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$popularevent->name}}">{{$popularevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$popularevent->category->name}}</span>
                                                    @if ($popularevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($popularevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($popularevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$popularevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$popularevent->max_slot == -1 ? 'No Limit' : $popularevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$popularevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>     
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($popularEvents->count() > 1)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlPEmini" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlPEmini" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>

    @if(Auth::check())
    <div class="container-fluid mb-4">
        <div class="row mb-4">
            <h3 class="col-8">Recommended for you</h3>
            <a href="{{route('recommendedevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($recommendedEvents->isEmpty())
                <div class="text-dark mx-auto py-5 my-4 text-center">
                    There's no event recommended for you yet 
                </div>
            @else
                <div id="carouselControlRec" class="carousel carousel-dark slide desktop-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($recommendedEvents as $key => $recommendedevent)
                            @if ($key % 3 == 0)
                            <div class="carousel-item{{$key === 0  ? ' active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                            @endif
                                    <div class="col">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$recommendedevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$recommendedevent->image ? asset('storage/'.$recommendedevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$recommendedevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$recommendedevent->name}}">{{$recommendedevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$recommendedevent->category->name}}</span>
                                                    @if ($recommendedevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($recommendedevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($recommendedevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$recommendedevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$recommendedevent->max_slot == -1 ? 'No Limit' : $recommendedevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$recommendedevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @if ($loop->last || $key == 2)
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @if ($recommendedEvents->count() > 3)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlRec" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlRec" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
                <div id="carouselControlRecmini" class="carousel carousel-dark slide mobile-only" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($recommendedEvents as $key => $recommendedevent)
                            <div class="carousel-item{{$key === 0  ? ' active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    <div class="col-12 col-md-4">
                                        <a class="card carousel-card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$recommendedevent->id]) }}" style="height:max-content">
                                            <div class="row g-0 align-item-center">
                                                <img src="{{$recommendedevent->image ? asset('storage/'.$recommendedevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top card-img-home img-fluid" alt="gambar-{{$recommendedevent->name}}">

                                                <div class="card-body">
                                                    <div class="card-title">
                                                    <h4 class="card-event-name" title="{{$recommendedevent->name}}">{{$recommendedevent->name}}</h4>
                                                    <span class="badge rounded-pill text-bg-info">{{$recommendedevent->category->name}}</span>
                                                    @if ($recommendedevent->has_sat == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                    @endif
                                                    @if ($recommendedevent->has_comserv == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                    @endif
                                                    @if ($recommendedevent->has_certificate == 'true')
                                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                    @endif
                                                    </div>
                                                    <p class="card-text fw-light">{{$recommendedevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                    <p class="card-text fw-light">Slot Limit: {{$recommendedevent->max_slot == -1 ? 'No Limit' : $recommendedevent->max_slot}}</p>
                                                    <small class="card-text">Posted by {{$recommendedevent->community->name}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>     
                                </div>
                            </div>
                        @endforeach                                  
                    </div>
                    @if ($recommendedEvents->count() > 1)
                        <button class="carousel-control-prev control-home" type="button" data-bs-target="#carouselControlRecmini" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next control-home" type="button" data-bs-target="#carouselControlRecmini" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(() => {
    $(document.body).on('click', '.card[data-clickable=true]', (e) => {
      var href = $(e.currentTarget).data('href');
      window.location = href;
    });
  })
</script>
@endsection
