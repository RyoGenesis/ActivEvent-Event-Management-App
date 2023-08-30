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
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$featuredevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$featuredevent->name}}">

                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$featuredevent->name}}</h4>
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
                                                            <p class="card-text fw-light">Slot Available: {{$featuredevent->max_slot == -1 ? 'No Limit' : $featuredevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$featuredevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
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
                                                    <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$fevent->id]) }}" style="height:max-content">
                                                        <div class="row g-0 allign-item-center">
                                                            <img src="{{$fevent->image ? asset('storage/'.$fevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$fevent->name}}">
    
                                                            <div class="card-body">
                                                                <div class="card-title">
                                                                <h4>{{$fevent->name}}</h4>
                                                                <span class="badge rounded-pill text-bg-info">{{$fevent->category->name}}</span>
                                                                @if ($fevent->has_sat == 'true')
                                                                    <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                                @endif
                                                                @if ($fevent->has_comserv == 'true')
                                                                    <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                                @endif
                                                                @if ($fevent->has_certificate == 'true')
                                                                    <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                                @endif
                                                                </div>
                                                                <p class="card-text fw-light">{{$fevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                                <p class="card-text fw-light">Slot Available: {{$fevent->max_slot == -1 ? 'No Limit' : $fevent->max_slot}}</p>
                                                                <small class="card-text">Posted by {{$fevent->community->name}}</small>
                                                            </div>
                                                        </div>
                                                    </a>
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
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$activelatestevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$activelatestevent->image ? asset('storage/'.$activelatestevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$activelatestevent->name}}">

                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$activelatestevent->name}}</h4>
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
                                                            <p class="card-text fw-light">Slot Available: {{$activelatestevent->max_slot == -1 ? 'No Limit' : $activelatestevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$activelatestevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
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
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$latestevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$latestevent->image ? asset('storage/'.$latestevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$latestevent->name}}">

                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$latestevent->name}}</h4>
                                                            <span class="badge rounded-pill text-bg-info">{{$activelatestevent->category->name}}</span>
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
                                                            <p class="card-text fw-light">Slot Available: {{$latestevent->max_slot == -1 ? 'No Limit' : $latestevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$latestevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
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
                                    @foreach ($popularEvents as $popularevent)
                                        @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$popularevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$popularevent->image ? asset('storage/'.$popularevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$popularevent->name}}">

                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$popularevent->name}}</h4>
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
                                                            <p class="card-text fw-light">Slot Available: {{$popularevent->max_slot == -1 ? 'No Limit' : $popularevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$popularevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>     
                                        @endif                                   
                                    @endforeach
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                                    @foreach ($popularEvents as $pevent)
                                        @if ($loop->iteration > 3)
                                            <div class="col">
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$pevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$pevent->image ? asset('storage/'.$pevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$pevent->name}}">

                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$pevent->name}}</h4>
                                                            <span class="badge rounded-pill text-bg-info">{{$pevent->category->name}}</span>
                                                            @if ($pevent->has_sat == 'true')
                                                                <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                            @endif
                                                            @if ($pevent->has_comserv == 'true')
                                                                <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                            @endif
                                                            @if ($pevent->has_certificate == 'true')
                                                                <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                            @endif
                                                            </div>
                                                            <p class="card-text fw-light">{{$pevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                            <p class="card-text fw-light">Slot Available: {{$pevent->max_slot == -1 ? 'No Limit' : $latestevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$pevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
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
                                    @foreach ($recommendedEvents as $recommendedevent)
                                    @if ($loop->iteration <= 3)
                                            <div class="col">
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$recommendedevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$recommendedevent->image ? asset('storage/'.$recommendedevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$recommendedevent->name}}">

                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$recommendedevent->name}}</h4>
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
                                                            <p class="card-text fw-light">Slot Available: {{$recommendedevent->max_slot == -1 ? 'No Limit' : $latestevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$recommendedevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
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
                                                <a class="card text-decoration-none text-dark h-100" href="{{ route('eventdetail', ['id'=>$recevent->id]) }}" style="height:max-content">
                                                    <div class="row g-0 allign-item-center">
                                                        <img src="{{$recevent->image ? asset('storage/'.$recevent->image) : asset('images/No-Image-Placeholder.png')}}" class="card-img-top img-fluid" alt="gambar-{{$recevent->name}}">
                                                        <div class="card-body">
                                                            <div class="card-title">
                                                            <h4>{{$recevent->name}}</h4>
                                                            <span class="badge rounded-pill text-bg-info">{{$recevent->category->name}}</span>
                                                            @if ($recevent->has_sat == 'true')
                                                                <span class="badge rounded-pill text-bg-primary">SAT</span>
                                                            @endif
                                                            @if ($recevent->has_comserv == 'true')
                                                                <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                                            @endif
                                                            @if ($recevent->has_certificate == 'true')
                                                                <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                                            @endif
                                                            </div>
                                                            <p class="card-text fw-light">{{$recevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                                            <p class="card-text fw-light">Slot Available: {{$recevent->max_slot == -1 ? 'No Limit' : $recevent->max_slot}}</p>
                                                            <small class="card-text">Posted by {{$recevent->community->name}}</small>
                                                        </div>
                                                    </div>
                                                </a>
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
