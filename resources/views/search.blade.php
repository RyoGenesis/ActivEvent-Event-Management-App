@extends('layouts.app')

@section('content')

<div class="container my-3">
    <div class="row">
        <div class="col">
            <h3 class="mb-4">Events containing the word "{{$search}}"</h3>
        </div>

        <div class="col text-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filter
                </button>
                <ul class="dropdown-menu px-3">
                    <form id="formsearch" role="search" method="GET" action="{{route('search')}}">
                        <div class="py-2">
                            <h5>SAT Point</h5>
                            <div class="form-check">
                                <label class="form-check-label"><small>Yes</small></label>
                                <input class="form-check-input" type="checkbox" id="checksat" name="checksat">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label"><small>No</small></label>
                                <input class="form-check-input" type="checkbox" id="checksat" name="checksat">
                            </div>
                        </div>

                        <div class="py-2">
                            <h5>Community Service Hour</h5>
                            <div class="form-check">
                                <label class="form-check-label"><small>Yes</small></label>
                                <input class="form-check-input" type="checkbox" id="checkcomserv" name="checkcomserv">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label"><small>No</small></label>
                                <input class="form-check-input" type="checkbox" id="checkcomserv" name="checkcomserv">
                            </div>
                        </div>

                        <div class="py-2">
                            <h5>E-Certificate</h5>
                            <div class="form-check">
                                <label class="form-check-label"><small>Yes</small></label>
                                <input class="form-check-input" type="checkbox" id="checkcertificate" name="checkcertificate">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label"><small>No</small></label>
                                <input class="form-check-input" type="checkbox" id="checkcertificate" name="checkcertificate">
                            </div>
                        </div>

                        <div class="py-2">
                            <h5>Categories</h5>
                            <div class="row d-flex">
                                @foreach ($categories as $category)
                                    <div class="col-3 mb-2">
                                        <option  class="btn" value="{{$category->id}}">{{$category->name}}</option>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- <div>
                            <h5>Communities</h5>
                            <div class="row d-flex">
                                @foreach ($communities as $community)
                                    <div class="col-3 mb-2">
                                        <option class="btn" value="{{$community->id}}">{{$community->name}}</option>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}

                        {{-- <div>
                            <h5>Community</h5>
                            <div class="row d-flex">
                                @foreach ($communities as $community)
                                    <div class="col-3 mb-2">
                                        <input type="button" name="category" placeholder="{{$community->name}}">
                                        <button class="px-1">{{$community->name}}</button>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                    </form>
                </ul>
                
            </div>
        </div>
    </div>
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
        
    <div id="contentevent" class="p-2 bg-light ms-md-4 ms-sm-2" style="width:100%">
        <div class="row gap-3">
            @if ($events->isEmpty())
            No search result for "{{$search}}"
            @else
            @foreach ($events as $event)
            {{-- <div class="col"> --}}
                <a class="card text-decoration-none text-dark" href="{{ route('eventdetail', ['id'=>$event->id]) }}" style="height:max-content">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-4">
                            <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid" alt="gambar-{{$event->name}}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>{{$event->name}}</h4>
                                    <span class="badge rounded-pill text-bg-info">{{$event->category->name}}</span>
                                    @if ($event->has_sat == 'true')
                                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                                    @endif
                                    @if ($event->has_comserv == 'true')
                                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                    @endif
                                    @if ($event->has_certificate == 'true')
                                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                    @endif
                                </div>
                                <p class="card-text fw-light">{{$event->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                <p class="card-text fw-light">Slot Available: {{$event->max_slot == -1 ? 'No Limit' : $event->max_slot}}</p>
                                <p class="card-text fw-light">Fee: {{$event->price == 0 ? 'Free' : 'Rp. '.number_format($event->price,2,',','.')}}</p>
                                <small class="card-text">Posted by {{$event->community->name}}</small>
                            </div>
                        </div>
                    </div>
                </a>
            {{-- </div> --}}
            @endforeach    
            @endif
        
        </div>
    </div>
    {{-- </div> --}}
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const autoSubmitCheckbox = document.querySelectorAll('.form-check-input');
        const form = document.getElementById('formsearch');
        
        autoSubmitCheckbox.forEach(function(checkbox){
            console.log(checkbox.checked);
            checkbox.addEventListener('change', function(){
                var search = "{{$search}}";
                console.log(search);
                var prevsearch = document.createElement('input');
                prevsearch.type = 'hidden';
                prevsearch.name = 'nama';
                prevsearch.value = search;
                
                form.appendChild(prevsearch);
                console.log(form);         
                form.submit();
            });
        });
    });
</script>
@endsection
