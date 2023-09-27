@extends('layouts.app')

@section('title','ActivEvent | Search')

@section('content')

<div class="container my-3">
    <div class="mb-3">
        <h3>Search results for "{{$search}}"</h3>
        @if (isset($request->has_sat))
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> SAT Point : {{$request->has_sat}}</span>
        @endif
        @if (isset($request->has_comserv))
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> Community Service Hour : {{$request->has_comserv}}</span>
        @endif
        @if (isset($request->has_certificate))
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> E-Certificate : {{$request->has_certificate}}</span>
        @endif
        @if (isset($request->price))
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> Registration Fee : {{$request->price}}</span>
        @endif
        @if (isset($request->max_slot))
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> Registration Limit : {{$request->max_slot}}</span>
        @endif
        @if (isset($request->exclusivity))
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> Exclusivity : {{$request->exclusivity}}</span>
        @endif
        @if ($selectedCategories)
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> Category :
                @foreach ($selectedCategories as $category)
                    @if ($loop->last)
                        {{$category->display_name}}
                    @else
                        {{$category->display_name}}, 
                    @endif
                @endforeach
            </span>
        @endif
        @if ($selectedCommunities)
            <span class="badge badge-filter text-bg-secondary m-1"><i class="fa-solid fa-filter"></i> Community :
                @foreach ($selectedCommunities as $community)
                    @if ($loop->last)
                        {{$community->display_name}}
                    @else
                        {{$community->display_name}}, 
                    @endif
                @endforeach
            </span>
        @endif
    </div>
    <div class="p-1 mb-3">
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
            <i class="fa-solid fa-filter"></i> Filter Options <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="collapse" id="collapseFilter">
            <form id="formsearch" role="search" method="GET" action="{{route('search')}}">
                <div class="container-fluid rounded-bottom p-3" style="border:1px solid lightgrey;">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="fs-3 mb-0">Search Filter</p>
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-sm btn-primary fs-6" type="submit" id="submitfilter">Filter</button>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-6 col-md-4 mb-2" id="filterSat">
                            <label class="form-label fw-bold fs-5">SAT Point</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_sat" name="has_sat" value="Yes" {{ (isset($request->has_sat) && $request->has_sat == "Yes")? "checked" : "" }}>
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_sat" name="has_sat" value="No" {{ (isset($request->has_sat) && $request->has_sat == "No")? "checked" : "" }}>
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-2" id="filterComserv">
                            <label class="form-label fw-bold fs-5">Community Service Hour</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_comserv" name="has_comserv" value="Yes" {{ (isset($request->has_comserv) && $request->has_comserv == "Yes")? "checked" : "" }}>
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_comserv" name="has_comserv" value="No" {{ (isset($request->has_comserv) && $request->has_comserv == "No")? "checked" : "" }}>
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-2" id="filterCertificate">
                            <label class="form-label fw-bold fs-5">E-Certificate</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_certificate" name="has_certificate" value="Yes" {{ (isset($request->has_certificate) && $request->has_certificate == "Yes")? "checked" : "" }}>
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_certificate" name="has_certificate" value="No" {{ (isset($request->has_certificate) && $request->has_certificate == "No")? "checked" : "" }}>
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-2" id="filterPrice">
                            <label class="form-label fw-bold fs-5">Registration Fee</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price" name="price" value="Free" {{ (isset($request->price) && $request->price == "Free")? "checked" : "" }}>
                                <label class="form-check-label">Free</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price" name="price" value="Paid" {{ (isset($request->price) && $request->price == "Paid")? "checked" : "" }}>
                                <label class="form-check-label">Paid</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-2" id="filterSlot">
                            <label class="form-label fw-bold fs-5">Registration Limit</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="max_slot" name="max_slot" value="No Limit" {{ (isset($request->max_slot) && $request->max_slot == "No Limit")? "checked" : "" }}>
                                <label class="form-check-label">No Limit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="max_slot" name="max_slot" value="Limited" {{ (isset($request->max_slot) && $request->max_slot == "Limited")? "checked" : "" }}>
                                <label class="form-check-label">Limited</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-2" id="filterExclusive">
                            <label class="form-label fw-bold fs-5">Participation Exclusivity</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="exclusivity" name="exclusivity" value="For Everyone" {{ (isset($request->exclusivity) && $request->exclusivity == "For Everyone")? "checked" : "" }}>
                                <label class="form-check-label">For Everyone</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="exclusivity" name="exclusivity" value="Exclusive" {{ (isset($request->exclusivity) && $request->exclusivity == "Exclusive")? "checked" : "" }}>
                                <label class="form-check-label">Exclusive</label>
                            </div>
                        </div>
                        <div class="col-12 mb-2" id="filterCategory">
                            <label class="form-label fw-bold fs-5" for="categories">Category</label>
                            <select name="categories[]" id="categories" data-placeholder="Select category" class="form-select form-control" multiple>
                                @foreach ($availCategories as $category)
                                    <option value="{{$category->id}}" {{ (isset($request->categories) && in_array($category->id, $request->categories)) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-2" id="filterCommunity">
                            <label class="form-label fw-bold fs-5" for="communities">Community</label>
                            <select name="communities[]" id="communities" data-placeholder="Select community" class="form-select form-control" multiple>
                                @foreach ($availCommunities as $community)
                                    <option value="{{$community->id}}" {{ (isset($request->communities) && in_array($community->id, $request->communities)) ? 'selected' : '' }}>{{ $community->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
    <div class="paginating">
        {{$events->links()}}
    </div>
</div>

@endsection

@section('scripts')
<script>
    const form = document.getElementById('formsearch');
    document.getElementById('formsearch').addEventListener('submit', function(event){
        event.preventDefault();
        var searchvalue = "{{$search}}";
        console.log(searchvalue);
        var prevsearch = document.createElement('input');
            prevsearch.type = 'hidden';
            prevsearch.name = 'search';
            prevsearch.value = searchvalue;
            console.log(prevsearch);
            form.appendChild(prevsearch);
            form.submit();
    });

    $("input:checkbox").on('click', function() {
        var $cb = $(this);
        if ($cb.is(":checked")) {
            var group = "input:checkbox[name='" + $cb.attr("name") + "']";
            
            //check off every checkbox in the group , then check the selected one
            $(group).prop("checked", false);
            $cb.prop("checked", true);
        }
    });

    $(document).ready(function() {
        $('#categories').select2({
            theme: "bootstrap-5",
            width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            allowClear: true,
        });
        
        $('#communities').select2({
            theme: "bootstrap-5",
            width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            allowClear: true,
        });
    });
</script>
@endsection
