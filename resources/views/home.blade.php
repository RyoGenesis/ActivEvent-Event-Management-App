@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <div class="fs-5 mb-4">Welcome, {{Auth::user()->name}}</div>
    @endauth
    <div class="container-fluid mb-4">
        <div class="row mb-4">
            <h3 class="col-8">Featured event</h3>
            <a href="{{route('featuredevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($featuredEvents->isEmpty())
                <div class="text-dark mx-auto py-5 text-center">
                    No Featured Event Yet
                </div>
            @else
                <div id="carouselControlFE" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner">                                
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($featuredEvents as $featuredevent)
                                        @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true" data-href="/eventdetail/{{$featuredevent->id}}">
                                                    <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$featuredevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$featuredevent->name}}</h5>
                                                        <div class="card-text">
                                                            <div class="my-2" style="display: flex">
                                                                @if ($featuredevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate                                
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($featuredevent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($featuredevent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </div>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$featuredevent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$featuredevent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            @if ($featuredEvents->count() > 3)
                                <div class="carousel-item">
                                    <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                        @foreach ($featuredEvents as $fevent)
                                            @if ($loop->iteration > 3)
                                                <div class="col">
                                                    <div class="card h-100" style="min-height: 27rem">
                                                        <img src="{{$fevent->image ? asset('storage/'.$fevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$fevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-3">{{$fevent->name}}</h5>
                                                            <div class="card-text">
                                                                <p class="my-2" style="">
                                                                @if ($fevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate         
                                                                    </span>
                                                                @endif
                                                                    
                                                                @if ($fevent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                            
                                                                @if ($fevent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                                </p>
                                                                <p class="fs-6 mt-4 mb-1">
                                                                    {{$fevent->date->format('l, j F Y - H:i \W\I\B')}}
                                                                </p>
                                                                <p class="fs-6" >
                                                                    Posted by {{$fevent->community->name}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>     
                                            @endif                                   
                                        @endforeach 
                                    </div>
                                </div>
                            @endif
                    </div>
                    @if ($featuredEvents->count() > 3)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControlFE" data-bs-slide="prev" style="left: -75pt">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControlFE" data-bs-slide="next" style="right: -75pt">
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
            <h3 class="col-8">Latest event</h3>
            <a href="{{route('latestevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($latestEvents->isEmpty())
                <div class="text-dark mx-auto py-5 text-center">
                    No Event Yet
                </div>
            @else
                <div id="carouselControlLE" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner">                                
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($latestEvents as $activelatestevent)
                                        @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true", data-href="/eventdetail/{{$activelatestevent->id}}">
                                                    <img src="{{$activelatestevent->image ? asset('storage/'.$activelatestevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$activelatestevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$activelatestevent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($activelatestevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate          
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($activelatestevent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($activelatestevent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$activelatestevent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$activelatestevent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif                                   
                                    @endforeach
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($latestEvents as $latestevent)
                                        @if ($loop->iteration > 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true" data-href="/eventdetail/{{$latestevent->id}}">
                                                    <img src="{{$latestevent->image ? asset('storage/'.$latestevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$latestevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$latestevent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($latestevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate      
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($latestevent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($latestevent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$latestevent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$latestevent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif                                   
                                    @endforeach 
                                </div>
                            </div>
                    </div>
                    @if ($latestEvents->count() > 3)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControlLE" data-bs-slide="prev" style="left: -75pt">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControlLE" data-bs-slide="next" style="right: -75pt">
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
            <h3 class="col-8">Popular event</h3>
            <a href="{{route('popularevent')}}" class="col-4 text-end fs-5" style="text-decoration: none;">Show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($popularEvents->isEmpty())
                <div class="text-dark mx-auto py-5 text-center">
                    No Event Yet
                </div>
            @else
                <div id="carouselControlPE" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner">                                
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($popularEvents as $popularEvent)
                                        @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true", data-href="/eventdetail/{{$popularEvent->id}}">
                                                    <img src="{{$popularEvent->image ? asset('storage/'.$popularEvent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$popularEvent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$popularEvent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($popularEvent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate          
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($popularEvent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($popularEvent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$popularEvent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$popularEvent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif                                   
                                    @endforeach
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($popularEvents as $popularEvent)
                                        @if ($loop->iteration > 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true" data-href="/eventdetail/{{$popularEvent->id}}">
                                                    <img src="{{$popularEvent->image ? asset('storage/'.$popularEvent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$popularEvent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$popularEvent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($popularEvent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate      
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($popularEvent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($popularEvent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$popularEvent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$popularEvent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif                                   
                                    @endforeach 
                                </div>
                            </div>
                    </div>
                    @if ($popularEvents->count() > 3)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControlPE" data-bs-slide="prev" style="left: -75pt">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControlPE" data-bs-slide="next" style="right: -75pt">
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
                <div class="text-dark mx-auto py-5 text-center">
                    There's no event recommended for you yet 
                </div>
            @else
                <div id="carouselControlRec" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner">                                
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($recommendedEvents as $recommendedEvent)
                                    @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true", data-href="/eventdetail/{{$recommendedEvent->id}}">
                                                    <img src="{{$recommendedEvent->image ? asset('storage/'.$recommendedEvent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$recommendedEvent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$recommendedEvent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($recommendedEvent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate          
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($recommendedEvent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($recommendedEvent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$recommendedEvent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$recommendedEvent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif                                   
                                    @endforeach
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($recommendedEvents as $recEvent)
                                        @if ($loop->iteration > 3)
                                            <div class="col">
                                                <div class="card h-100" style="min-height: 27rem" data-clickable="true" data-href="/eventdetail/{{$recEvent->id}}">
                                                    <img src="{{$recEvent->image ? asset('storage/'.$recEvent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$recEvent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$recEvent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($recEvent->has_certificate == 'true')
                                                                    <span span class="rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                                                                        E-Certificate      
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($recEvent->has_sat == 'true')
                                                                    <span class="rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($recEvent->has_comserv == 'true')
                                                                    <span class="rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-4 mb-1">
                                                                {{$recEvent->date->format('l, j F Y - H:i \W\I\B')}}
                                                            </p>
                                                            <p class="fs-6" >
                                                                Posted by {{$recEvent->community->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                        @endif                                   
                                    @endforeach 
                                </div>
                            </div>

                    </div>
                    @if ($recommendedEvents->count() > 3)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControlRec" data-bs-slide="prev" style="left: -75pt">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControlRec" data-bs-slide="next" style="right: -75pt">
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
