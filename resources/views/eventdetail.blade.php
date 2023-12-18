@extends('layouts.app')
@section('style')
<style>
    @media (max-width: 767px) {
        .mobile-only .modal .modal-sm{
            font-size: 1pt;
        }
    }
</style>
@endsection

@section('title','ActivEvent | "'.$event->name.'" by '.$event->community->display_name)

@section('content')
<div class="container bg-light border border-dark-subtle border-3 mt-4">
    <div class="mb-3 mobile-only">
        <div class="my-3 ps-4">
            <a href="{{ url()->previous() }}" class="fa fa-2xl fa-arrow-left" style="text-decoration:none; color:black"></a>
        </div>
        <div class="text-center">
            <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar acara {{$event->name}}" style="height:20rem" class="img-fluid event-detail-img">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 p-3">
            <div class="my-3 ps-4 desktop-only">
                <a href="{{ url()->previous() }}" class="fa fa-2xl fa-arrow-left" style="text-decoration:none; color:black"></a>
            </div>
            <div class="px-3 px-md-5">
                <h1 class="fw-bold mb-3 desktop-only">{{$event->name}}</h1>
                <h3 class="fw-bold mb-3 mobile-only">{{$event->name}}</h3>
                <p class="detail-text mb-0">posted by {{$event->community->name}}</p>
                <p class="fw-bold text-danger">Registration closing at : {{$event->registration_end->format('j F Y - H:i \W\I\B')}}</p>
                <div class="row pb-3">
                    <div class="col">
                        @if ($event->has_certificate)
                            <span class="d-inline-flex rounded-pill bg-success py-1 px-2 m-1 detail-text text-light">
                                E-Certificate
                            </span>
                        @endif
                        @if ($event->has_sat)
                            <span class="d-inline-flex rounded-pill bg-info py-1 px-2 m-1 detail-text text-dark">
                                SAT Point - {{$event->sat_level->name}} Level
                            </span>
                        @endif
                        @if ($event->has_comserv)
                            <span class="d-inline-flex rounded-pill bg-warning py-1 px-2 m-1 detail-text text-dark">
                                Community Service Hour
                            </span>
                        @endif
                        @if ($event->exclusive_member)
                            <span class="d-inline-flex rounded-pill bg-danger py-1 px-2 m-1 detail-text text-light">
                                Member Exclusive
                            </span>
                        @endif
                        @if ($event->exclusive_major)
                            <span class="d-inline-flex rounded-pill bg-danger py-1 px-2 m-1 detail-text text-light">
                                Target Major(s) Exclusive
                            </span>
                        @endif
                    </div>
                </div>
                <div>
                    <p class="fw-bold detail-title-text">Date and Time</p>
                    <p class="detail-text">{{$event->date->format('l, j F Y - H:i \W\I\B')}}</p>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Event Category</p>
                        <p class="detail-text">{{$event->category->name}}</p>
                    </div>
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Topic</p>
                        <p class="detail-text">{{$event->topic ?? '-'}}</p>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Maximum Slot</p>
                        <p class="detail-text">{{$event->max_slot == -1 ? 'No Limit' : $event->max_slot}}</p>
                    </div>
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Location</p>
                        <p class="detail-text">{{$event->location}}</p>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Speaker</p>
                        <p class="detail-text">{{$event->speaker ?? '-'}}</p>
                    </div>
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Registration Fee</p>
                        <p class="detail-text">{{$event->price == 0 ? 'Free' : 'Rp. '.number_format($event->price,2,',','.')}}</p>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Contact Person</p>
                        <p class="detail-text">{{$event->contact_person ?? '-'}}</p>
                    </div>
                    <div class="col col-md-6">
                        <p class="fw-bold detail-title-text">Targeted Major</p>
                        <p class="detail-text">
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
                        <p class="fw-bold detail-title-text">BGA for this event</p>
                        <p class="detail-text">
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
                    <p class="fw-bold detail-title-text">Description</p>
                    <p class="detail-text text-left">{!!$event->description!!}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6" id="detail-buttons">
            <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" alt="gambar acara {{$event->name}}" class="float-end img-fluid event-detail-img desktop-only">
            <div class="row px-5 px-md-3">
                <div class="col d-flex justify-content-end py-5">
                    @if ($event->deleted_at == null)
                        @if (Auth::check())
                            @if ($registered)
                                @if ($event->date > \Carbon\Carbon::now())
                                    @if ($event->additional_form_link)
                                        <button type="button" class="btn btn-info me-4" data-bs-toggle="modal" data-bs-target="#modalform">
                                        External Form Link
                                        </button>
                                    @endif
                                
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalcancel">
                                        Cancel
                                    </button>
                                @else
                                    <p class="text-danger">Event has begun / ended! You're not able to cancel for this event.</p>
                                @endif
                            @else
                                @if ($event->registration_end > \Carbon\Carbon::now())
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalregister">
                                        Register
                                    </button>
                                @else
                                    <p class="text-danger">Sorry, registration period has ended! You're not able to register for this event.</p>
                                @endif
                            @endif
                        @else
                            @if ($event->registration_end > \Carbon\Carbon::now())
                                <a href="{{route('login')}}" class="btn btn-primary btn-lg">Register</a>
                            @else
                                <p class="text-danger">Sorry, registration period has ended! You're not able to register for this event.</p>
                            @endif
                        @endif
                    @else
                        <p class="text-danger">Sorry, event has been cancelled.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if (Auth::check())
    @if ($registered)
        @if ($event->date > \Carbon\Carbon::now())
            @if ($event->additional_form_link)
                <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="modallabelform" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title detail-text" id="modallabelform">External Form Link</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if (session()->has('form_link'))
                                You succesfully registered to the event!<br>    
                                @endif
                                Please fill out the additional form which can be accessed via the link below to fully complete the registration for this event
                                <div>
                                    <a href="{{$event->additional_form_link}}">{{$event->additional_form_link}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="modal fade" id="modalcancel" tabindex="-1" aria-labelledby="modallabelcancel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title detail-text" id="modallabelcancel">Cancel Registration</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Confirm to Cancel Your Registration?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <form action="{{route('cancelregistration')}}" method="post" id="register-form">
                                @csrf
                                <input type="hidden" name="id" value="{{$event->id}}">
                                <button type="submit" id="cancel-btn" class="btn btn-secondary btn-danger">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if ($event->registration_end > \Carbon\Carbon::now())
            <div class="modal fade" id="modalregister" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title detail-text" id="modallabel">Registration</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Confirm Registration for This Event?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{route('registration')}}" method="post" id="register-form">
                                @csrf
                                <input type="hidden" name="id" value="{{$event->id}}">
                                <button type="submit" id="register-btn" class="btn btn-success">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @if ((session()->has('successful') && !$event->additional_form_link) || session()->has('success_cancel'))
        <div class="modal fade" id="modalnotif" tabindex="-1" aria-labelledby="modallabelnotif" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title detail-text" id="modallabelnotif">Registration</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        @if (session()->has('successful') && session('successful'))
                        You succesfully registered to the event!
                        @elseif (session()->has('successful') && !session('successful'))
                        {{session('error')}}
                        @elseif (session()->has('success_cancel'))
                        Succesfully cancel your registration for this event!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@endsection

@section('scripts')
<script>
    $(window).ready(function() {
        $('#register-form').on('submit', function () {
            $('#register-btn').prop('disabled', true);
        });
        $('#cancel-form').on('submit', function () {
            $('#cancel-btn').prop('disabled', true);
        });
    });
</script>
@if (Auth::check() && ($registered || session()->has('success_cancel') ))
    @if (($registered && $event->date > \Carbon\Carbon::now()) || session()->has('success_cancel'))
        @if ($event->additional_form_link)
            @if (session()->has('form_link'))
                <script defer>
                    $(window).ready(function() {
                        $('#modalform').modal('show');
                    });
                </script>
            @endif
        @elseif((session()->has('successful') && !$event->additional_form_link) || session()->has('success_cancel'))
            <script defer>
                $(window).ready(function() {
                    $('#modalnotif').modal('show');
                });
            </script>
        @endif
    @endif
@endif
@endsection