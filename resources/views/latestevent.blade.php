@extends('layouts.app')

@section('title','ActivEvent | Latest Events')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Latest Events</small>
  </div>
    <h3 class="mb-4">Latest Events</h3>
    <div class="row gap-3 mb-3" id="card-event-row">
      @forelse ($latestevents as $latestevent)
        <a class="card card-event" href="{{ route('eventdetail', ['id'=>$latestevent->id])}}">
          <div class="row g-0 allign-item-center">
              <div class="col-md-4 img-event">
                <img src="{{$latestevent->image ? asset('storage/'.$latestevent->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid card-event-img" alt="gambar-{{$latestevent->name}}">
              </div>
              <div class="col-md-8">
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
            </div>
        </a>
      @empty
        <div class="mx-auto py-5 text-center">
          <p class="fs-4">No new event at the moment.</p>
        </div>
      @endforelse
    </div>

    <div class="paginating">
      {{$latestevents->links()}}
    </div>
</div>
@endsection
