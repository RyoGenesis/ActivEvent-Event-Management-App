@extends('layouts.app')

@section('content')

<div class="container my-3">
    <h3 class="mb-4">Events containing the word "{{$search}}"</h3>

    {{-- <div class="d-flex me-sm-2">
        <div id="filter" class="border bg-light ms-md-4 ms-sm-2" style="width:10cm">
            <div class="border-bottom h4 text-center">Filter by</div>
            <div class="box border-botom">
                <div class="box-lavel d-flex">
                    SAT
                    <button class="btn ms-auto" type="button" data-bs-target="#location-box" data-bs-toggle="collapse">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div id="location-box" class="collapse show">
                    <div class="my-1">
                        <label class="tick small">Yes
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                    <div class="my-1">
                        <label class="tick small">No
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box border-bottom">
                <div class="box-lavel d-flex align-items-center">
                    Comserv
                    <button class="btn ms-auto" type="button" data-bs-target="#location-box" data-bs-toggle="collapse">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div id="location-box" class="collapse show">
                    <div class="my-1">
                        <label class="tick small">Yes
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                    <div class="my-1">
                        <label class="tick small">No
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box border-bottom">
                <div class="box-lavel d-flex align-items-center">
                    Location
                    <button class="btn ms-auto" type="button" data-bs-target="#location-box" data-bs-toggle="collapse">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div id="location-box" class="collapse show">
                    <div class="my-1">
                        <label class="tick small">Binus Kemanggisan
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                    <div class="my-1">
                        <label class="tick small">Binus Syahdan
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                    <div class="my-1">
                        <label class="tick small">Binus Alam Sutera
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                    <div class="my-1">
                        <label class="tick small">Binus ASO
                            <input type="checkbox">
                            <span class="check"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box border-bottom">
                <div class="box-lavel d-flex align-items-center">
                    Categories
                    <button class="btn ms-auto" type="button" data-bs-target="#location-box" data-bs-toggle="collapse">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div id="location-box" class="collapse show">
                    @foreach ($category as $category)
                        <div class="my-1">
                            <label class="tick small">{{$category->name}}
                                <input type="checkbox">
                                <span class="check"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> --}}
        
    <div id="contentevent" class="p-2 bg-light ms-md-4 ms-sm-2" style="width:150ch">
        <div class="row gap-5">
            @if ($event->isEmpty())
            There's no event named {{$search}}
            @else
            @foreach ($event as $event)
            {{-- <div class="col"> --}}
                <div class="card" style="height:max-content">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$event->image}}" class="img-fluid" alt="gambar-{{$event->name}}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>{{$event->name}}</h4>
                                    <span class="badge rounded-pill text-bg-primary">{{$event->category->name}}</span>
                                    @if ($event->has_sat=='true')
                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                    @endif
                                    @if ($event->has_comserv=='true')
                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                    @endif
                                    @if ($event->has_certificate=='true')
                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                    @endif
                                </div>
                                <p class="card-text fw-light">{{$event->date}}</p>
                                <p class="card-text fw-light">Slot Available {{$event->max_slot}}</p>
                                <small class="card-text">Posted by {{$event->community->name}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
            @endforeach    
            @endif
        
        </div>
    </div>
    {{-- </div> --}}
</div>

@endsection

