@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <div class="fs-5 mb-4">Welcome, {{Auth::user()->name}}</div>
    @endauth
    <div class="container-fluid mb-4">
        <div class="row mb-4">
            <h3 class="col-8">Featured event</h3>
            <a href="/featuredevent" class="col-4 text-end fs-5" style="text-decoration: none; color: black">show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($featuredevents->isEmpty())
                <div class="text-dark mx-auto text-center">
                    No Featured Event Yet
                </div>
            @else
                <div id="carouselControlFE" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner">                                
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($featuredevents as $featuredevent)
                                        @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <div class="card" style="height: 27rem" data-clickable="true" data-href="/eventdetail/{{$featuredevent->id}}">
                                                    <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$featuredevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$featuredevent->name}}</h5>
                                                        <div class="card-text">
                                                            <div class="my-2" style="display: flex">
                                                                @if ($featuredevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                                                                        E-Certificate                                
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($featuredevent->has_sat == 'true')
                                                                    <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($featuredevent->has_comserv == 'true')
                                                                    <span class="rounded-pill border border-2 border-warning text-warning p-1 fs-6 fw-bold">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </div>
                                                            <p class="fs-6 mt-2">
                                                                {{$featuredevent->date}}
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
                            
                            @if ($featuredevents->count() > 3)
                                <div class="carousel-item">
                                    <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                        @foreach ($featuredevents as $fevent)
                                            @if ($loop->iteration > 3)
                                                <div class="col">
                                                    <div class="card" style="height: 27rem">
                                                        <img src="{{$fevent->image ? asset('storage/'.$fevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$fevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-3">{{$fevent->name}}</h5>
                                                            <div class="card-text">
                                                                <p class="my-2" style="">
                                                                @if ($fevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                                                                        E-Certificate         
                                                                    </span>
                                                                @endif
                                                                    
                                                                @if ($fevent->has_sat == 'true')
                                                                    <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                            
                                                                @if ($fevent->has_comserv == 'true')
                                                                    <span class="rounded-pill border border-3 border-warning text-warning p-1 fs-6 fw-bold">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                                </p>
                                                                <p class="fs-6 mt-2">
                                                                    {{$fevent->date}}
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
                    @if ($featuredevents->count() > 3)
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
            <a href="/latestevent" class="col-4 text-end fs-5" style="text-decoration: none; color: black">show more</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
            @if ($latestevents->isEmpty())
                <div class="text-dark mx-auto text-center">
                    No Featured Event Yet
                </div>
            @else
                <div id="carouselControl" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner">                                
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($latestevents as $activelatestevent)
                                        @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <div class="card" style="height: 27rem" data-clickable="true", data-href="/eventdetail/{{$activelatestevent->id}}">
                                                    <img src="{{$activelatestevent->image ? asset('storage/'.$activelatestevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$activelatestevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$activelatestevent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($activelatestevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                                                                        E-Certificate          
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($activelatestevent->has_sat == 'true')
                                                                    <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($activelatestevent->has_comserv == 'true')
                                                                    <span class="rounded-pill border border-3 border-warning text-warning p-1 me-2 fs- fw-bold">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-2">
                                                                {{$activelatestevent->date}}
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
                                    @foreach ($latestevents as $latestevent)
                                        @if ($loop->iteration > 3)
                                            <div class="col">
                                                <div class="card" style="height: 27rem" data-clickable="true" data-href="/eventdetail/{{$latestevent->id}}">
                                                    <img src="{{$latestevent->image ? asset('storage/'.$latestevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$latestevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">{{$latestevent->name}}</h5>
                                                        <div class="card-text">
                                                            <p class="my-2">
                                                                @if ($latestevent->has_certificate == 'true')
                                                                    <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                                                                        E-Certificate      
                                                                    </span>
                                                                @endif
                                                                
                                                                @if ($latestevent->has_sat == 'true')
                                                                    <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                                                                        SAT Point
                                                                    </span>
                                                                @endif 
                                        
                                                                @if ($latestevent->has_comserv == 'true')
                                                                    <span class="rounded-pill border border-3 border-warning text-warning p-1 me-2 fs- fw-bold">
                                                                        Community Service Hour
                                                                    </span>
                                                                @endif 
                                                            </p>
                                                            <p class="fs-6 mt-2">
                                                                {{$latestevent->date}}
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
                    @if ($latestevents->count() > 3)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControl" data-bs-slide="prev" style="left: -75pt">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControl" data-bs-slide="next" style="right: -75pt">
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
        <h3 class="mb-4">Populer event</h3>
    </div>

    @if(Auth::check())
        @foreach ($topicInterests as $topicinterest)
            <div class="container-fluid mb-4">
                <div class="row mb-4">
                    <h3 class="col-8">Because You Intrested In "{{$topicinterest}}"</h3>
                    <a href="" class="col-4 text-end fs-5" style="text-decoration: none; color: black">show more</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    @if ($recomendedevents[$topicinterest]->isEmpty())
                        <div class="text-dark mx-auto text-center">
                            There's no Event Match with Your Interest
                        </div>
                    @else
                        <div id="carouselControl{{$topicinterest}}" class="carousel carousel-dark slide" data-bs-interval="false">
                            <div class="carousel-inner">                                
                                    <div class="carousel-item active">
                                        <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                            @foreach ($recomendedevents[$topicinterest] as $recommendedevent)
                                            @if ($loop->iteration <= 3)
                                                    <div class="col">
                                                        <div class="card" style="height: 27rem" data-clickable="true", data-href="/eventdetail/{{$recommendedevent->id}}">
                                                            <img src="{{$recommendedevent->image ? asset('storage/'.$recommendedevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$recommendedevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                            <div class="card-body">
                                                                <h5 class="card-title mb-3">{{$recommendedevent->name}}</h5>
                                                                <div class="card-text">
                                                                    <p class="my-2">
                                                                        @if ($recommendedevent->has_certificate == 'true')
                                                                            <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                                                                                E-Certificate          
                                                                            </span>
                                                                        @endif
                                                                        
                                                                        @if ($recommendedevent->has_sat == 'true')
                                                                            <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                                                                                SAT Point
                                                                            </span>
                                                                        @endif 
                                                
                                                                        @if ($recommendedevent->has_comserv == 'true')
                                                                            <span class="rounded-pill border border-3 border-warning text-warning p-1 me-2 fs- fw-bold">
                                                                                Community Service Hour
                                                                            </span>
                                                                        @endif 
                                                                    </p>
                                                                    <p class="fs-6 mt-2">
                                                                        {{$recommendedevent->date}}
                                                                    </p>
                                                                    <p class="fs-6" >
                                                                        Posted by {{$recommendedevent->community->name}}
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
                                            @foreach ($recomendedevents as $recevent)
                                                @if ($loop->iteration > 3)
                                                    <div class="col">
                                                        <div class="card" style="height: 27rem" data-clickable="true" data-href="/eventdetail/{{$recevent->id}}">
                                                            <img src="{{$recevent->image ? asset('storage/'.$recevent->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar {{$recevent->name}}" class="card-img-top img-fluid" style="height: 15rem">
                                                            <div class="card-body">
                                                                <h5 class="card-title mb-3">{{$recevent->name}}</h5>
                                                                <div class="card-text">
                                                                    <p class="my-2">
                                                                        @if ($recevent->has_certificate == 'true')
                                                                            <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                                                                                E-Certificate      
                                                                            </span>
                                                                        @endif
                                                                        
                                                                        @if ($recevent->has_sat == 'true')
                                                                            <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                                                                                SAT Point
                                                                            </span>
                                                                        @endif 
                                                
                                                                        @if ($recevent->has_comserv == 'true')
                                                                            <span class="rounded-pill border border-3 border-warning text-warning p-1 me-2 fs- fw-bold">
                                                                                Community Service Hour
                                                                            </span>
                                                                        @endif 
                                                                    </p>
                                                                    <p class="fs-6 mt-2">
                                                                        {{$recevemt->date}}
                                                                    </p>
                                                                    <p class="fs-6" >
                                                                        Posted by {{$recevent->community->name}}
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
                            @if ($recomendedevents[$topicinterest]->count() > 3)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControl{{$topicinterest}}" data-bs-slide="prev" style="left: -75pt">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselControl{{$topicinterest}}" data-bs-slide="next" style="right: -75pt">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    @endif
                    </div>
                </div>
            </div>

        @endforeach
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
