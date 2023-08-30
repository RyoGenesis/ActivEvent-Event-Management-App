@extends('layouts.app')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Featured Event</small>
  </div>
    <h3 class="mb-4">Featured Event</h3>
    <div class="row gap-3">
      @foreach ($featuredevents as $featuredevent)
        <a class="card text-decoration-none text-dark" href="{{ route('eventdetail', ['id'=>$featuredevent->id]) }}" style="height:max-content">
          <div class="row g-0 allign-item-center">
              <div class="col-md-4">
                <img src="{{$featuredevent->image ? asset('storage/'.$featuredevent->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid" alt="gambar-{{$featuredevent->name}}">
              </div>
              <div class="col-md-8">
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
            </div>
        </a>
      @endforeach
    </div>

    <div class="paginating">
      {{$featuredevents->links()}}
    </div>
</div>
@endsection
