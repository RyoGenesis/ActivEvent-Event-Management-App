@extends('layouts.app')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small>Featured event</small>
  </div>
    <h3 class="mb-4">Featured Event</h3>
    @foreach ($latestevents as $latestevent)
      <div class="card mb-4 mx-auto" style="max-width: 1100px">
        <div class="row g-0">
            <div class="col-md-4">
              <img src="{{$latestevent->image}}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title">{{$latestevent->name}}</h3>
                <div class='card-text'>
                  <p class="my-2">
                    @if ($latestevent->has_certificate == 'true')
                        <span class="rounded-pill p-1 me-2" style="background-color: #fd7e14">
                            <small>E-certificate</small>
                        </span>
                    @endif 
                
                    @if ($latestevent->has_comserv == 'true')
                        <span class="rounded-pill p-1 me-2" style="background-color: #fd7e14">
                            <small>Community Service Hour</small>
                        </span>
                    @endif

                    @if ($latestevent->has_sat == 'true')
                        <span class="rounded-pill p-1 me-2" style="background-color: #fd7e14">
                            <small>SAT Point</small>
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
      </div>
    @endforeach
</div>
@endsection