@extends('layouts.app')
@section('style')
<style>
    @media(min-width: 768px){
        .desktop-only{
            display:block;
        }
        .mobile-only{
            display:none;
        }
    }
</style>

<style>
    @media (max-width: 767px) {
        .desktop-only {
            display: none;
        }
        .mobile-only {
            display:block;
        }
        
        .mobile-only .modal .modal-sm{
            font-size: 1pt;
        }
        /* .mobile-only #eventinformation h1{
            font-size:15pt;
        }
        .mobile-only #eventinformation  */
    }
</style>
@endsection

@section('title',{{'ActivEvent | "'.$event->name.'" by '.$event->community->display_name}})

@section('content')
<div class="container bg-light border border-dark-subtle border-3 mt-4 desktop-only">
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
                        <p class="fs-5">{{$event->category->name}}</p>
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
            <div class="row px-3">
                <div class="col d-flex justify-content-end py-5">
                    @if (Auth::check())
                        @if ($registered)
                            @if ($event->additional_form_link)
                                 <button type="button" class="btn btn-info me-4" data-bs-toggle="modal" data-bs-target="#modalform">
                                External Form Link
                                </button>

                                <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="modallabelform" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modallabelform">External Form Link</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Please fill out the external form which can be accessed via the link below 
                                                <div>
                                                    <a href="{{$event->additional_form_link}}">{{$event->additional_form_link}}</a>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                           
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcancel">
                                Cancel
                            </button>

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
                                                <button type="submit" class="btn btn-secondary btn-danger">yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        @else
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalregister">
                                Register
                            </button>
                            
                            <div class="modal fade" id="modalregister" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modallabel">Registration Event</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Confirm Registration for This Event?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{route('registration')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$event->id}}">
                                        <button type="submit" class="btn btn-success">Register</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{route('login')}}" class="btn btn-primary btn-lg">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-light border border-dark-subtle border-3 mt-4 mobile-only">
    <div class="mb-3">
        <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar acara {{$event->name}}" style="height:20rem" class="float-end img-fluid">
    </div>
    <div id="event-information" class="px-3">
        <h3 class="fw-bold mb-3">{{$event->name}}</h3>
        <p class="fs-6 mb-0">posted by {{$event->community->name}}</p>
        <p class="fw-bold text-danger">Registration closing at : {{$event->registration_end->format('j F Y - H:i \W\I\B')}}</p>
        <div class="row pb-3">
            <div class="col">
                @if ($event->has_certificate)
                    <span class="d-inline-flex rounded-pill bg-success py-1 px-2 m-1 fs-6 text-light">
                        E-Certificate
                    </span>
                @endif
                @if ($event->has_sat)
                    <span class="d-inline-flex rounded-pill bg-info py-1 px-2 m-1 fs-6 text-dark">
                        SAT Point - {{$event->sat_level->name}} Level
                    </span>
                @endif
                @if ($event->has_comserv)
                    <span class="d-inline-flex rounded-pill bg-warning py-1 px-2 m-1 fs-6 text-dark">
                        Community Service Hour
                    </span>
                @endif
                @if ($event->exclusive_member)
                    <span class="d-inline-flex rounded-pill bg-danger py-1 px-2 m-1 fs-6 text-light">
                        Member Exclusive
                    </span>
                @endif
                @if ($event->exclusive_major)
                    <span class="d-inline-flex rounded-pill bg-danger py-1 px-2 m-1 fs-6 text-light">
                        Target Major(s) Exclusive
                    </span>
                @endif
            </div>
        </div>
        <div>
            <h5 class="fw-bold">Date and Time</h5>
            <p class="fs-6 custom-fs-5">{{$event->date->format('l, j F Y - H:i \W\I\B')}}</p>
        </div>
        <div class="row py-1">
            <div class="col col-md-6">
                <h5 class="fw-bold">Event Category</h2>
                <p class="fs-6">{{$event->category->name}}</p>
            </div>
            <div class="col col-md-6">
                <h5 class="fw-bold">Topic</h5>
                <p class="fs-6">{{$event->topic ?? '-'}}</p>
            </div>
        </div>
        <div class="row py-1">
            <div class="col col-md-6">
                <h5 class="fw-bold">Maximum Slot</h5>
                <p class="fs-6">{{$event->max_slot == -1 ? 'No Limit' : $event->max_slot}}</p>
            </div>
            <div class="col col-md-6">
                <h5 class="fw-bold">Location</h5>
                <p class="fs-6">{{$event->location}}</p>
            </div>
        </div>
        <div class="row py-1">
            <div class="col col-md-6">
                <h5 class="fw-bold">Speaker</h5>
                <p class="fs-6">{{$event->speaker ?? '-'}}</p>
            </div>
            <div class="col col-md-6">
                <h5 class="fw-bold">Registration Fee</h5>
                <p class="fs-6">{{$event->price == 0 ? 'Free' : 'Rp. '.number_format($event->price,2,',','.')}}</p>
            </div>
        </div>
        <div class="row py-1">
            <div class="col col-md-6">
                <h5 class="fw-bold">Contact Person</h5>
                <p class="fs-6">{{$event->contact_person ?? '-'}}</p>
            </div>
            <div class="col col-md-6">
                <h5 class="fw-bold">Targeted Major</h5>
                <p class="fs-6">
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
                    <h5 class="fw-bold">BGA for this event</h5>
                    <p class="fs-6">
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
            <h5 class="fw-bold">Description</h5>
            <p class="fs-6 text-left">{!!$event->description!!}</p>
        </div>
    </div>
    <div class="row px-5">
        <div class="col d-flex justify-content-end py-5">
            @if (Auth::check())
                @if ($registered)
                    @if ($event->additional_form_link)
                         <button type="button" class="btn btn-info me-4" data-bs-toggle="modal" data-bs-target="#modalform">
                        External Form Link
                        </button>

                        <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="modallabelform" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6" id="modallabelform">External Form Link</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Please fill out the external form which can be accessed via the link below 
                                        <div>
                                            <a href="{{$event->additional_form_link}}">{{$event->additional_form_link}}</a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                   
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcancel">
                        Cancel
                    </button>

                    <div class="modal fade" id="modalcancel" tabindex="-1" aria-labelledby="modallabelcancel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="modallabelcancel">Cancel Registration</h1>
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
                                        <button type="submit" class="btn btn-secondary btn-danger">yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                @else
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalregister">
                        Register
                    </button>
                    
                    <div class="modal fade" id="modalregister" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-6" id="modallabel">Registration Event</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Confirm Registration for This Event?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{route('registration')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$event->id}}">
                                <button type="submit" class="btn btn-success btn">Register</button>
                            </form>
                        </div>
                        </div>
                    </div>
                @endif
            @else
                <a href="{{route('login')}}" class="btn btn-primary btn">Register</a>
            @endif
        </div>
    </div>
</div>

@endsection