@extends('layouts.app')

@section('title','ActivEvent | Featured Events')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Featured Events</small>
  </div>
    <h3 class="mb-4">Featured Events</h3>
    <div class="row gap-3" id="card-event-row">
      @forelse ($featuredevents as $featuredevent)
        <a class="card card-event" href="{{ route('eventdetail', ['id'=>$featuredevent->id]) }}" style="height:max-content">
          <div class="row g-0 allign-item-center">
              <div class="col-md-4">
                <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid" alt="gambar-{{$featuredevent->name}}">
              </div>
              <div class="col-md-8">
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
            </div>
        </a>
      @empty
        <div class="mx-auto py-5 text-center">
          <p class="fs-4">No featured event at the moment.</p>
        </div>
      @endforelse
    </div>

    <div class="paginating">
      {{$featuredevents->links()}}
    </div>
</div>
@endsection
