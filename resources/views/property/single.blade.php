@extends('template')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ url('css/glyphicon.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('js/ninja/ninja-slider.min.css') }}" />

@endpush
@section('main')
<main class="listing_detail">
    <input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}">
    <div class="container-fluid p-0 mb-5">
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center inner-Bookings">
                    <div class="property_info">
                        <h3>{{ $result->name }}</h3>
                        <span class="d-flex">
                            <img src="{{URL::to('images/Location.svg')}}" alt="Location" class="mr-2" /> 
                            {{$result->property_address->city }} @if($result->property_address->city !=''),@endif {{
                                $result->property_address->state}} @if($result->property_address->state !=''),@endif {{
                                $result->property_address->countries->name }}
                        </span>
                        @if($result->green_score)
                            <div class="vtooltip">
                                <span class="vtooltiptext">
                                    {{trans('messages.home.leaf_tooltip')}} 
                                </span>
                                @for($i=1;$i<=5;$i = $i + 1 )
                                    @if ($result->green_score >= ($i -0.5))												
                                        <img src="{{URL::to('images/LeafGreen.svg')}}" alt="LeafGreen" class="img-fluid" />
                                    @else 
                                        <img src="{{URL::to('images/LeafGreen_inactive.svg')}}" alt="LeafGreen" class="img-fluid" />
                                    @endif
                                @endfor																		
                            </div>
                        @endif
                    </div>
                    <span class="btn btn-outline-danger cursor-pointer m-0 ml-5" onclick="lightbox(0)">{{trans('messages.home.view_gallery')}}</span>
                </div>
            </div>
        </div>
        @if(count($property_photos) > 0)
            <div class="row main-gallery mb-5">
                @php $i=0 @endphp

                @foreach($property_photos as $row_photos)
                
                @if($i < 4) 
                    <div class="col-6 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <img src="{{$row_photos->photo}}" alt="property-photo" class="img-fluid cursor-pointer" onclick="lightbox({{$i}})" />
                    </div>            
                @else
                    @php break; @endphp
                @endif
            @php $i++ @endphp
            @endforeach
        </div>
        @endif
        
        <div class="row" id="mainDiv">
            <div class="col-lg-7 col-xl-8">
                <div id="sideDiv">
                    <div class="row justify-content-between mb-5">
                        <div class="col-12 col-sm-4 mb-3">
                            <div class="pro-results">
                                <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                                <div>{{ $result->space_type_name }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <div class="pro-results">
                                <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                                <div> {{ $result->accommodates }} {{trans('messages.property_single.guest')}} </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="pro-results">
                                <i class="fa fa-bed fa-2x" aria-hidden="true"></i>
                                <div>
                                    {{ $result->beds}} {{trans('messages.property_single.bed')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5" id="listMargin">
                    <div class="col-12 mb-5">
                        <h3 class="mb-2">{{trans('messages.property_single.about_list')}} </h3>
                        <p class="inner-text">{{ $property_description->summary }}</p>
                    </div>
                    <div class="col-12">
                        <div class="listing-info">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h4>{{trans('messages.property_single.the_space')}}</h4>
                                <div class="listing-content">
                                    @if(@$result->bed_types->name != NULL)
                                        <div>{{trans('messages.property_single.bed_type')}}:{{ @$result->bed_types->name }}</div>
                                    @endif
                                    <div>{{trans('messages.property_single.property_type')}}: {{$result->property_type_name }}</div>
                                    <div>{{trans('messages.property_single.accommodate')}}: {{@$result->accommodates }}</div>
                                    <div>{{trans('messages.property_single.bedroom')}}: {{@$result->bedrooms }}</div>
                                    <div>{{trans('messages.property_single.bathroom')}}: {{@$result->bathrooms }}</div>
                                    <div>{{trans('messages.property_single.bed')}}: {{@$result->beds }}</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-5">    
                                @if(count($safety_amenities) !=0)
                                    <h4>{{trans('messages.property_single.safety_feature')}}</h4>
                                    <div class="listing-content">
                                        @foreach($safety_amenities as $row_safety)
                                        <div>
                                            @if($row_safety->status == null)
                                            <del>
                                                @endif
                                                {{ $row_safety->title }}
                                                @if($row_safety->status == null)
                                            </del>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center status mb-3">    
                                <h4 class="Accepted w-100 text-center">
                                    <i class="fa fa-times mr-2" aria-hidden="true"></i>
                                    {{trans('messages.home.free_cancellation')}}
                                </h4>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3 class="mb-5">{{trans('messages.home.certifications')}}</h3>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">                           
                        <div class="listing-info Certifications amenities">
                            <div class="Certifications-images">
                                @foreach($certifications as $certification_row)
                                    @if (in_array($certification_row->id, $property_certifications) )
                                        <img src="{{URL::to('images/certifications/').'/'.$certification_row->id.'.png'}}" alt="{{$certification_row->name}}" class="img-fluid" />
                                    @endif
                                @endforeach
                            </div>
                            @if (! empty($result->other_certifications))
                            @foreach(explode(',',$result->other_certifications) as $certification)                            
                                <div class="amenities-listing">
                                    <div class="d-flex justify-content-between align-items-center">                                            
                                        <span>                                            
                                            {{ $certification }}                                                
                                        </span>
                                    </div>
                                </div>                            
                            @endforeach
                            @endif

                        </div>
                        <h4 class="w-100 text-green mt-4 mb-4">{{trans('messages.home.eco-friendly')}}</h4>
                        <div class="listing-info amenities">
                           <div>                                

                                @php $i = 1 @endphp
                                @php $count = round(count($amenities)/2) @endphp
                                @foreach($eco_friendly as $all_amenities)
                                
                                    <div class="amenities-listing">
                                        <div class="d-flex justify-content-between align-items-center">                                            
                                            <span>
                                                @if($all_amenities->status == null)
                                                <del>
                                                    @endif
                                                    {{ $all_amenities->title }}
                                                    @if($all_amenities->status == null)
                                                </del>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @php $i++ @endphp                                
                                @endforeach
                                <br />
                                <a href="https://help.boxatravel.com/guest/sustainable-tourism/" target="_blank" class="btn btn-outline-dark btn-lg m-0">+ {{trans('messages.home.learn_more')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3 class="mb-5">{{trans('messages.property_single.amenity')}}</h3>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">                           
                        <div class="listing-info amenities">
                            @php $i = 1 @endphp
                            @php $count = round(count($amenities)/2) @endphp
                            @foreach($amenities as $all_amenities)
                            @if($i < 6)
                                <div class="amenities-listing">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="icon icon-{{ $all_amenities->symbol }}" aria-hidden="true"></i>
                                        <span>
                                            @if($all_amenities->status == null)
                                            <del>
                                                @endif
                                                {{ $all_amenities->title }}
                                                @if($all_amenities->status == null)
                                            </del>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @php $i++ @endphp
                            @endif
                            @endforeach

                            <button type="button" class="btn btn-outline-dark btn-lg m-0" data-toggle="modal" data-target="#exampleModalCenter">
                                + {{trans('messages.property_single.more')}}
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal calender_modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header p-4">
                                        <h5 class="modal-title " id="exampleModalLongTitle">{{trans('messages.property_single.amenity')}}</h5>
                                        <button type="button" class="close filter-cancel" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4 m-0">
                                        <div class="listing-info amenities">
                                            @php $i = 1 @endphp
                                            @foreach($amenities as $all_amenities)
                                            @if($i > 6)
                                            <div class="amenities-listing">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <i class="icon icon-{{ $all_amenities->symbol }}" aria-hidden="true"></i>
                                                    @if($all_amenities->status == null)
                                                    <del>
                                                        @endif
                                                        {{ $all_amenities->title }}
                                                        @if($all_amenities->status == null)
                                                    </del>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @php $i++ @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="mb-5">{{trans('messages.home.map')}}</h3>
                        <div id="room-detail-map" class="single-map-w"></div>
                    </div>
                </div>
                @if(@$property_description->about_place !='' ||
                $property_description->place_is_great_for !='' ||
                $property_description->guest_can_access !='' ||
                $property_description->interaction_guests !='' || $property_description->other ||
                $property_description->about_neighborhood || $property_description->get_around)
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="mb-5">{{trans('messages.property_single.description')}}</h3>
                    </div>
                    <div class="col-12">
                        @if($property_description->about_place)
                        <strong>{{trans('messages.property_single.about_place')}}</strong>
                        <p class="inner-text mb-3">{{ $property_description->about_place}}</p>
                        @endif

                        @if($property_description->place_is_great_for)
                        <strong>{{trans('messages.property_single.place_great_for')}}</strong>
                        <p class="inner-text mb-3">{{ $property_description->place_is_great_for}} </p>
                        @endif

                        <a href="javascript:void(0)" id="description_trigger" data-rel="description" class="more-btn">+ {{trans('messages.property_single.more')}}</a>
                        <div class="d-none" id='description_after'>
                            @if($property_description->interaction_guests)
                            <strong>{{trans('messages.property_single.interaction_guest')}}</strong>
                            <p class="inner-text mb-3">{{ $property_description->interaction_guests}}</p>
                            @endif

                            @if($property_description->about_neighborhood)
                            <strong>{{trans('messages.property_single.about_neighborhood')}}</strong>
                            <p class="inner-text mb-3">{{ $property_description->about_neighborhood}}</p>
                            @endif

                            @if($property_description->guest_can_access)
                            <strong>{{trans('messages.property_single.guest_access')}}</strong>
                            <p class="inner-text mb-3">{{ $property_description->guest_can_access}}</p>
                            @endif

                            @if($property_description->get_around)
                            <strong>{{trans('messages.property_single.get_around')}}</strong>
                            <p class="inner-text mb-3">{{ $property_description->get_around}}</p>
                            @endif

                            @if($property_description->other)
                            <strong>{{trans('messages.property_single.other')}}</strong>
                            <p class="inner-text mb-3">{{ $property_description->other}}</p>
                            @endif
                            <a href="javascript:void(0)" id="description_less" data-rel="description" class="less-btn">- {{trans('messages.home.less')}}</a>
                        </div>
                    </div>
                </div>
                @endif
                
                @if(!$result->reviews->count())
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h3>{{ trans('messages.reviews.no_reviews_yet') }}</h3>
                    </div>
                </div>
                @else
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <div>
                                <h3>{{trans_choice('messages.property_single.review',$result->guest_review) }}</h3>
                            </div>
                            <div class="review-rating ml-3">
                                <span><i class="fa fa-star"></i> {{sprintf("%.1f",$result->avg_rating)}} ({{ $result->guest_review }})</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="listing-info">
                            <div class="row review-summary justify-content-between m-0">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4>{{ trans('messages.reviews.accuracy') }}</h4>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <progress max="5" value="{{$result->accuracy_avg_rating}}">
                                                <div class="progress-bar">
                                                    <span></span>
                                                </div>
                                            </progress>
                                            <span class="ml-3">{{sprintf("%.1f",$result->accuracy_avg_rating)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4>{{ trans('messages.reviews.location') }}</h4>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <progress max="5" value="{{$result->location_avg_rating}}">
                                                <div class="progress-bar">
                                                    <span></span>
                                                </div>
                                            </progress>
                                            <span class="ml-3">{{sprintf("%.1f",$result->location_avg_rating)}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4 class="text-truncate">{{ trans('messages.reviews.communication') }}</h4>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <progress max="5" value="{{$result->communication_avg_rating}}">
                                                <div class="progress-bar">
                                                    <span></span>
                                                </div>
                                            </progress>
                                            <span class="ml-3">{{sprintf("%.1f",$result->communication_avg_rating)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4>{{ trans('messages.reviews.checkin') }}</h4>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <progress max="5" value="{{$result->checkin_avg_rating}}">
                                                <div class="progress-bar">
                                                    <span></span>
                                                </div>
                                            </progress>
                                            <span class="ml-3">{{sprintf("%.1f",$result->checkin_avg_rating)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4>{{ trans('messages.reviews.cleanliness') }}</h4>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <progress max="5" value="{{$result->cleanliness_avg_rating}}">
                                                <div class="progress-bar">
                                                    <span></span>
                                                </div>
                                            </progress>
                                            <span class="ml-3">{{sprintf("%.1f",$result->cleanliness_avg_rating)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h4>{{ trans('messages.reviews.value') }}</h4>
                                        </div>
                                        <div class="d-flex align-items-center">                                            
                                            <progress max="5" value="{{$result->value_avg_rating}}">
                                                <div class="progress-bar">
                                                    <span></span>
                                                </div>
                                            </progress>
                                            <span  class="ml-3">{{sprintf("%.1f",$result->value_avg_rating)}}</span>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3 mb-0">
                                    @foreach($result->reviews as $row_review)
                                    @if($row_review->reviewer == 'guest')
                                    <div class="listing-info host-details mb-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="media-photo-badge text-center">
                                                <a href="{{ url('users/show/'.$row_review->users->id) }}">
                                                    <img alt="{{ $row_review->users->first_name }}" class="" src="{{ $row_review->users->profile_src }}" title="{{ $row_review->users->first_name }}">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ url('users/show/'.$row_review->users->id) }}">
                                                    <h5>{{ $row_review->users->full_name }}</h5>
                                                </a>
                                                <p><i class="far fa-clock"></i> {{dateFormat($row_review->created_at) }}</p>
                                            </div>
                                        </div>
                                        <div class="background text-15">
                                            @for($i=1; $i <=5 ; $i++) @if($row_review->rating >= $i)
                                                <i class="fa fa-star"></i>
                                                @else
                                                <i class="fa fa-star blank"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p>{{ $row_review->message }}</p>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--@if($result->users->reviews->count() - $result->reviews->count())
                            <div class="row">
                                <div class="col-md-12">
                                    <a target="blank" class="btn vbtn-outline-success" href="{{ url('users/show/'.$result->users->id) }}">
                                        {{ trans('messages.reviews.view_other_reviews') }}</span>
                                    </a>
                                </div>
                            </div>
                            @endif-->
                        </div>
                    </div>
                </div>

                @endif
                <!--popup slider-->
                <div class="d-none" id="showSlider">
                    <div id="ninja-slider">
                        <div class="slider-inner">
                            <ul>
                                @foreach($property_photos as $row_photos)
                                <li>
                                    <a class="ns-img" href="{{$row_photos->photo}}" aria-label="photo"></a>
                                </li>
                                @endforeach
                            </ul>
                            <div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5 mt-5">
                    <div class="col-12">
                        <h3 class="mb-5">{{trans('messages.property_single.about_host')}}</h3>
                    </div>
                    <div class="col-12">
                        <div class="listing-info host-details">
                            <div class="d-flex align-items-center">
                                <div class="media-photo-badge text-center">
                                    <img alt="{{ $result->users->first_name }}" src="{{ $result->users->profile_src }}" title="{{ $result->users->first_name }}">
                                </div>
                                <div>
                                   <h5>{{ $result->users->full_name }}</h5>
                                    <p>{{trans('messages.users_show.member_since')}} {{ date('F Y',strtotime($result->users->created_at)) }}</p>
                                </div>
                            </div>
                            @if($result->users->reviews->count())
                            <div class="col-md-12 p-0">
                                <p>
                                    <a href="{{ url('users/show/'.$result->users->id) }}" class="btn btn vbtn-outline-success">{{trans('messages.reviews.view_other_reviews') }}</a>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div id="sticky-anchor" class="d-none d-md-block"></div>
                <div class="listing-info sticky-sidebar">
                    <div id="booking-price">
                        <div id="booking-banner">
                            <div class="price d-flex justify-content-between align-items-center w-100 mb-3">
                                <div class="boxa-price d-flex">
                                    <em>{!! moneyFormat($symbol, numberFormat($result->property_price->price,2)) !!}</em>
                                </div>
                                <div class="price">{{trans('messages.home.OR')}}</div>
                                <div class="boxa-price d-flex" data-toggle="tooltip" data-placement="top" title="{!! getBoxaPrice( $result->property_price->price) !!}">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid">
                                    <em class="ml-2 boxa-value">{!! getBoxaPrice( $result->property_price->price) !!}</em>
                                </div>
                                <div id="per_night" class="per-night ml-2">
                                    / {{trans('messages.property_single.per_night')}}
                                </div>
                                <div id="per_month" class="per-month display-off ml-2">
                                    / {{trans('messages.property_single.per_month')}}
                                </div>
                            </div>
                        </div>
                        <form accept-charset="UTF-8" method="post" action="{{ url('payments/book/'.$property_id) }}" id="booking_form" class="">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">                                    
                                    <div class="row mb-3" id="daterange-btn">
                                        <div class="col-12 mb-3">
                                            <label>{{trans('messages.property_single.check_in')}}</label>
                                            <input class="form-control" id="startDate" name="checkin" value="{{ $checkin ? $checkin : onlyFormat(date('d-m-Y')) }}" placeholder="dd-mm-yyyy" type="text" required>
                                        </div>
                                        <input type="hidden" id="property_id" value="{{ $property_id }}">
                                        <input type="hidden" id="room_blocked_dates" value="">
                                        <input type="hidden" id="calendar_available_price" value="">
                                        <input type="hidden" id="room_available_price" value="">
                                        <input type="hidden" id="price_tooltip" value="">
                                        <input type="hidden" id="url_checkin" value="{{$checkin}}">
                                        <input type="hidden" id="url_checkout" value="{{$checkout }}">
                                        <input type="hidden" id="url_guests" value="{{ $guests }}">
                                        <input type="hidden" id="url_children" value="{{ $children }}">
                                        <input type="hidden" id="url_infants" value="{{ $infants }}">
                                        <input type="hidden" id="url_pets" value="{{ $pets }}">
                                        <input type="hidden" name="booking_type" id="booking_type" value="{{ $result->booking_type }}">

                                        <div class="col-12">
                                            <label>{{trans('messages.property_single.check_out')}}</label>
                                            <input class="form-control" id="endDate" name="checkout" value="{{ $checkout ? $checkout : onlyFormat(date('d-m-Y', time() + 86400)) }}" placeholder="dd-mm-yyyy" type="text" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>{{trans('messages.property_single.guest')}}</label>
                                            <select id="number_of_guests" class="form-control change-price" name="number_of_guests">
                                                @for($i=1;$i<= $result->accommodates;$i++)
                                                    <option value="{{ $i }}" <?=$guests==$i?'selected':''?>>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>{{trans('messages.home.children')}}</label>
                                            <select id="number_of_children" class="form-control change-price" name="number_of_children">
                                                @for($i=0;$i <= 3;$i++)
                                                    <option value="{{ $i }}" <?=$children==$i?'selected':''?>>{{ $i }}</option>
                                                    @endfor
                                                    <option value="4" <?=$children> 3?'selected':''?>>3+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>{{trans('messages.home.infants')}}</label>
                                            <select id="number_of_infants" class="form-control change-price" name="number_of_infants">
                                                @for($i=0;$i <= 3;$i++)
                                                    <option value="{{ $i }}" <?=$infants==$i?'selected':''?>>{{ $i }}</option>
                                                @endfor
                                                    <option value="4" <?=$infants > 3?'selected':''?>>3+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>{{trans('messages.home.pets')}}</label>
                                            <select id="number_of_pets" class="form-control change-price" name="number_of_pets">
                                                @for($i=0;$i <= 3;$i++)
                                                    <option value="{{ $i }}" <?=$pets==$i?'selected':''?>>{{ $i }}</option>
                                                @endfor
                                                    <option value="4" <?=$pets> 3?'selected':''?>>3+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>{{trans('messages.home.payment_type')}}</label>
                                            <select id="payment_type" class="form-control" name="payment_type" onChange="changePricing()">
                                                <option value="Boxa">Boxa</option>
                                                <option value="Euro" selected>Euro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="book_it" class="row mt-4">
                                <div class="col-12 w-100 js-subtotal-container booking-subtotal panel-padding-fit ">
                                    <div id="loader" class="display-off single-load">
                                        <img src="{{URL::to('/')}}/front/img/green-loader.gif" alt="loader">
                                    </div>
                                    <div class="table-responsive price-table-scroll">
                                        <table class="table table-bordered price_table" id="booking_table">
                                            <tbody>
                                                <div id="append_date">

                                                </div>
                                                <tr>
                                                    <td class="">
                                                       <span id="total_night_count" value="">0</span>
                                                       
                                                        {{trans('messages.property_single.night')}}<span id="total_night_count_text"></span>
                                                    </td>                                                    
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span class="ml-2" id="total_night_price_boxa"> 0 </span>
                                                        </div>
                                                        <div class="euro-price">
                                                            <span id="total_night_price" class="ml-2" value=""> 0 </span>
                                                            <span id="custom_price" class="fa fa-info-circle" data-html="true" data-toggle="tooltip" data-placement="top"title=""></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="">
                                                        {{trans('messages.property_single.service_fee')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="service_fee_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        <div class="euro-price">
                                                            
                                                            <span id="service_fee" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="additional_price">
                                                    <td class="">
                                                        {{trans('messages.property_single.additional_guest_fee')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="additional_guest_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="additional_guest" class="ml-2" value=""> 0 </span> 
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="security_price">
                                                    <td class="">
                                                        {{trans('messages.property_single.security_fee')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="security_fee_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="security_fee" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="cleaning_price">
                                                    <td class="">
                                                        {{trans('messages.property_single.cleaning_fee')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="cleaning_fee_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="cleaning_fee" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="pets_price">
                                                    <td class="">
                                                        {{trans('messages.home.pets')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="pets_price_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="pets_price" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="iva_tax">
                                                    <td class="">
                                                        {{trans('messages.property_single.iva_tax')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="iva_tax_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="iva_tax" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="accomodation_tax">
                                                    <td class="">
                                                        {{trans('messages.property_single.accommodatiton_tax')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="accomodation_tax_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="accomodation_tax" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="">
                                                        {{trans('messages.home.discount')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="discount_boxa" class="ml-2" value="">0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="discount" class="ml-2" value="">0 </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="">
                                                        {{trans('messages.property_single.total')}}
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="boxa-price"> 
                                                            <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                                            <span id="total_boxa" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                        
                                                        <div class="euro-price">
                                                            
                                                            <span id="total" class="ml-2" value=""> 0 </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="book_it_disabled" class="col-12 text-center d-none">
                                    <p id="book_it_disabled_message" class="icon-rausch">
                                        {{trans('messages.property_single.date_not_available')}}
                                    </p>
                                    <a href="{{URL::to('/')}}/search?location={{$result->property_address->city }}" class="btn btn-large btn-block" id="view_other_listings_button">
                                        {{trans('messages.property_single.view_other_list')}}
                                    </a>
                                </div>

                                <div id="minimum_disabled" class="col-12 text-center d-none">
                                    <p class="icon-rausch text-danger">
                                        {{trans('messages.property_single.you_have_book')}} 
                                        <span id="minimum_disabled_message"></span>
                                        {{trans('messages.property_single.night_dates')}}
                                    </p>
                                    <a href="{{URL::to('/')}}/search?location={{$result->property_address->city }}" class="btn btn-large btn-block" id="view_other_listings_button">
                                        {{trans('messages.property_single.view_other_list')}}
                                    </a>
                                </div>

                                <div class="book_btn col-md-12 text-center {{ ($result->host_id == @Auth::guard('users')->user()->id || $result->status == 'Unlisted') ? 'display-off' : '' }}">
                                    <button type="submit" class="btn vbtn-outline-success " id="save_btn">
                                        <i class="spinner fa fa-spinner fa-spin d-none"></i>
                                        <span class="{{ ($result->booking_type != 'instant') ? '' : 'display-off' }}">
                                            {{trans('messages.property_single.request_book')}} 
                                        </span>
                                        <span class="{{ ($result->booking_type == 'instant') ? '' : 'display-off' }}">
                                            <i class="icon icon-bolt text-beach h4"></i>
                                            {{trans('messages.property_single.instant_book')}}
                                        </span>
                                    </button>
                                </div>
                                            
                                <p class="col-md-12 text-center mt-4 mb-4">{{trans('messages.home.share_on')}} ....</p>

                                <ul class="list-inline text-center d-flex align-items-center justify-content-center w-100">
                                    <li class="list-inline-item">
                                        @php
                                        echo '<iframe src="https://www.facebook.com/plugins/share_button.php?href='.$shareLink.'&layout=button&size=large&mobile_iframe=true&width=73&height=28&appId" width="76" height="28" class="overflow-hidden border-0" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
                                        @endphp
                                    </li>

                                    <li class="list-inline-item">
                                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=" .$title data-size="large" aria-label="tweet">Tweet</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareLink }}&title={{ $title }}&summary={{ $property_description->summary }}" aria-label="linkedin" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="shareButton">
                                            <i class="fab fa-linkedin-in"></i> {{trans('messages.home.share')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <input id="hosting_id" name="hosting_id" type="hidden" value="{{ $result->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="listing m-0">
        <div class="container-fluid p-0">
            @if(count($similar)!= 0)
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-5">{{trans('messages.property_single.similar_list')}}</h3>
                </div>
            </div>

            <div class="row">
                @foreach($similar->slice(0, 8) as $row_similar)
                    @include('property.preview', ['property' => $row_similar])
                @endforeach
            </div>
            @endif
        </div>
    </section> 
</main>

@push('scripts')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places&callback=callbackMap'></script>
@auth
<script src="{{ url('js/sweetalert.min.js') }}"></script>
@endauth
<script type="text/javascript" src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ninja/ninja-slider.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/daterangecustom.js')}}"></script>

<script type="text/javascript">
    let back = 0;
	$(function() {
		var checkin = $('#startDate').val();
		var checkout = $('#endDate').val();
		var page = 'single'
		dateRangeBtn(checkin,checkout,page, '{{$date_format}}');

	});

$("#view-calendar").on("click", function() {
	return $("#startDate").trigger("select");
})


@auth
$(document).on('click', '.book_mark_change', function(event){
    event.preventDefault();
    var property_id = $(this).data("id");
    var property_status = $(this).data("status");
    var user_id = "{{Auth::id()}}";
    var dataURL = APP_URL+'/add-edit-book-mark';
    var that = this;
    if (property_status == "1")
    {
        var title = "{{trans('messages.favourite.remove')}}";

    } else {

        var title = "{{trans('messages.favourite.add')}}";
    }

    swal({
        title: title,
        icon: "warning",
        buttons: {
            cancel: {
                text: "{{trans('messages.general.no')}}",
                value: null,
                visible: true,
                className: "btn btn-outline-danger text-16 font-weight-700  pt-3 pb-3 pl-5 pr-5",
                closeModal: true,
            },
            confirm: {
                text: "{{trans('messages.general.yes')}}",
                value: true,
                visible: true,
                className: "btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5",
                closeModal: true
            }
        },
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: dataURL,
                    data:{
                        "_token": "{{ csrf_token() }}",
                        'id':property_id,
                        'user_id':user_id,
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {

                        $(that).removeData('status')
                        if(data.favourite.status == 'Active') {
                            $(that).css('color', 'forestgreen');
                            $(that).attr("data-status", 1);
                            $(that).addClass("active");;
                            swal('success', '{{trans('messages.success.favourite_add_success')}}');

                        } else {
                            $(that).css('color', 'black');
                            $(that).attr("data-status", 0);
                            $(that).removeClass("active");;
                            swal('success', '{{trans('messages.success.favourite_remove_success')}}');


                        }
                    }
                });

            }
        });
});
@endauth


$(function(){
	var checkin     = $('#url_checkin').val();
	var checkout    = $('#url_checkout').val();
	var guest       = $('#url_guests').val();
	var children    = $('#url_children').val();
	var infants     = $('#url_infants').val();
	var pets        = $('#url_pets').val();
	price_calculation(checkin, checkout, guest, children, infants, pets);
});

$('.change-price').on('change', function(){	
	price_calculation('', '', '', '', '', '');
});

function price_calculation(checkin, checkout, guest, children, infants, pets){	
	var checkin = checkin != '' ? checkin:$('#startDate').val();
	var checkout = checkout != '' ? checkout:$('#endDate').val();
	var guest = guest != ''? guest : $('#number_of_guests').val();
	var children = children != '' ? children : $('#number_of_children').val();
	var infants = infants != '' ? infants : $('#number_of_infants').val();	
	var pets = pets != ''? pets:$('#number_of_pets').val();

    
	if(checkin != '' && checkout != '' &&  guest != ''){
	var property_id     = $('#property_id').val();
	var dataURL = '{{url("property/get-price")}}';
		$.ajax({
			url: dataURL,
			data: {
				"_token": "{{ csrf_token() }}",
				'checkin': checkin,
				'checkout': checkout,
				'guest_count': parseInt(guest) + parseInt(children) + parseInt(infants),
				'pets_count': pets,
				'property_id': property_id,
			},
			type: 'post',
			dataType: 'json',
			beforeSend: function (){
				// $('.price_table').addClass('d-none');
				show_loader();
			},
			success: function (result) {
				$('.append_date').remove();
				if(result.status == 'Not available'){
					$('.book_btn').addClass('d-none');
					$('.booking-subtotal').addClass('d-none');
					$('#book_it_disabled').removeClass('d-none');
				}
				else if(result.status == 'minimum stay')
				{
					$('.book_btn').addClass('d-none');
					$('.booking-subtotal').addClass('d-none');
					$('#book_it_disabled').addClass('d-none');
					$('#minimum_disabled').removeClass('d-none');
					$('#minimum_disabled_message').text(result.minimum);


				}
				else
				{

					//showing custom price in info icon
					if(!jQuery.isEmptyObject(result.different_price_dates)){
						var output = "{{trans('messages.listing_price.custom_price')}} <br/>";
						for (var ical_date in result.different_price_dates) {
							output += "{{__('messages.account_transaction.date')}}: "+ical_date+" | {{__('messages.utility.price')}}: "+"{{$symbol}}"+ result.different_price_dates[ical_date]+" <br>";
						}

						$("#custom_price").attr("data-original-title", output);
						$('#custom_price').tooltip({ 'placement': 'top' });
						$('#custom_price').show();

					}else{
						$('#custom_price').addClass('d-none');
					}


					var append_date = ""

					for(var i=0; i<result.date_with_price.length; i++){
                        append_date +='<tr class="append_date">'
                                    + '<td class="">'+ result.date_with_price[i]['date']+'</td>'
                                    + '<td class="text-right"><div class="boxa-price"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid"><span  id="" value="" class="ml-2">' + result.date_with_price[i]['boxa_price'] +'</span></div>'
                                    + '<div class="euro-price"><span  id="" value="" class="ml-2">' + result.date_with_price[i]['price'] +'</span></div></td>'
                                + '</tr>';
					}

					var tableBody = $("table tbody");
	                tableBody.first().prepend(append_date);


					$('.additional_price').removeClass('d-none');
					$('.security_price').removeClass('d-none');
					$('.cleaning_price').removeClass('d-none');
					$('.iva_tax').removeClass('d-none');
					$('.accomodation_tax').removeClass('d-none');
					$("#total_night_count").html(result.total_nights);
                    $("#total_night_count_text").html(result.total_nights_text);
					$('#total_night_price').html(result.total_night_price_with_symbol);
					$('#total_night_price_boxa').html(result.total_night_price_boxa);
					$('#service_fee').html(result.service_fee_with_symbol);
					$('#service_fee_boxa').html(result.service_fee_boxa);
					$('#discount').html(result.discount_with_symbol);
					$('#discount_boxa').html(result.discount_boxa);

					if(result.iva_tax != 0) {
                        $('#iva_tax').html(result.iva_tax_with_symbol);
                        $('#iva_tax_boxa').html(result.iva_tax_boxa);
                    } else {
                        $('.iva_tax').addClass('d-none');
                    }
					if(result.accomodation_tax != 0) {
                        $('#accomodation_tax').html(result.accomodation_tax_with_symbol);
                        $('#accomodation_tax_boxa').html(result.accomodation_tax_boxa);
                    } else {
                        $('.accomodation_tax').addClass('d-none');
                    }

					if(result.additional_guest != 0){
                        $('#additional_guest').html(result.additional_guest_fee_with_symbol);
                        $('#additional_guest_boxa').html(result.additional_guest_boxa);
                    } 
					else {
                        $('.additional_price').addClass('d-none');
                    }
					if(result.security_fee != 0){
                        $('#security_fee').html(result.security_fee_with_symbol);
                        $('#security_fee_boxa').html(result.security_fee_boxa);
                    } else {
                        $('.security_price').addClass('d-none');
                    }
					if(result.cleaning_fee != 0) {
                        $('#cleaning_fee').html(result.cleaning_fee_with_symbol);
                        $('#cleaning_fee_boxa').html(result.cleaning_fee_boxa);
                    } else {
                        $('.cleaning_price').addClass('d-none');
                    }
                    console.log("🚀 ~ file: single.blade.php:1136 ~ price_calculation ~ result.pets_price:", result.pets_price)
					if(result.pets_price != 0) {
                        console.log("🚀 ~ file: single.blade.php:113 ~ price_calculation ~ result.pets_price:", result.pets_price)
                        $('#pets_price').html(result.pets_price_with_symbol);
                        $('#pets_price_boxa').html(result.pets_price_boxa);
                        $('.pets_price').removeClass('d-none');
                    } else {
                        $('.pets_price').addClass('d-none');
                    }
					$('#total').html(result.total_with_symbol);
					$('#total_boxa').html(result.total_boxa);
					//$('#total_night_price').html(result.total_night_price);

					$('.booking-subtotal').removeClass('d-none');
					$('#book_it_disabled').addClass('d-none');
					$('#minimum_disabled').addClass('d-none');
					$('.book_btn').removeClass('d-none');
				}

				var host = "{{ ($result->host_id == @Auth::guard('users')->user()->id) ? '1' : '' }}";
				if(host == '1') $('.book_btn').addClass('d-none');
			},
			error: function (request, error) {
				// This callback function will trigger on unsuccessful action
				console.log(error);
			},
			complete: function(){
				$('.price_table').removeClass('d-none');
				hide_loader();
			}
		});
	}
}


$("#save_btn").on("click", function (e)
{
    $("#save_btn").attr("disabled", true);
    $(".spinner").removeClass('d-none');
    $('#booking_form').submit();
});

window.onbeforeunload = function (evt) {
    if(back) {
        $("#save_btn").attr("disabled", false);
        $(".spinner").addClass('d-none');
        back = 0;
    }
    else {
        back++;
    }

}


$('.more-btn').on('click', function(){
	var name = $(this).attr('data-rel');
	$('#'+name+'_trigger').addClass('d-none');
	$('#'+name+'_after').removeClass('d-none');
});

$('.less-btn').on('click', function(){
	var name = $(this).attr('data-rel');
	$('#'+name+'_trigger').removeClass('d-none');
	$('#'+name+'_after').addClass('d-none');
});

setTimeout(function(){

	$('#room-detail-map').locationpicker({
		location: {
			latitude: "{{$result->property_address->latitude}}",
			longitude: "{{ $result->property_address->longitude }}"
		},
		radius: 0,
		addressFormat: "",
		markerVisible: false,
		markerInCenter: false,
		enableAutocomplete: true,
		scrollwheel: false,
		oninitialized: function (component) {
			setCircle($(component).locationpicker('map').map);
		}

	});

}, 5000);

function setCircle(map){
	var citymap = {
	loccenter: {
		center: {lat: 41.878, lng: -87.629},
		population: 240
	},
	};

	var cityCircle = new google.maps.Circle({
		strokeColor: '#329793',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#329793',
		fillOpacity: 0.35,
		map: map,
		center: {lat: {{$result->property_address->latitude}}, lng: {{ $result->property_address->longitude }} },
		radius: citymap['loccenter'].population
	});
}

function lightbox(idx) {
	//show the slider's wrapper: this is required when the transitionType has been set to "slide" in the ninja-slider.js
	$('#showSlider').removeClass("d-none");
	nslider.init(idx);
	$("#ninja-slider").addClass("fullscreen");
}

function fsIconClick(isFullscreen) { //fsIconClick is the default event handler of the fullscreen button
	if (isFullscreen) {
		$('#showSlider').addClass("d-none");
	}
}

function show_loader(){
	$('#loader').removeClass('d-none');
	$('#pagination').addClass('d-none');
}

function hide_loader(){
	$('#loader').addClass('d-none');
	$('#pagination').removeClass('d-none');
}

window.twttr = (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
	if (d.getElementById(id)) return t;
	js = d.createElement(s);
	js.id = id;
	js.src = "https://platform.twitter.com/widgets.js";
	fjs.parentNode.insertBefore(js, fjs);
	t._e = [];
	t.ready = function(f) {
		t._e.push(f);
	};

	return t;
	}(document, "script", "twitter-wjs"));
function changePricing() {
    $.ajax({
        type: "POST",
        url: APP_URL + "/set_session",
        data: {
            "_token": "{{ csrf_token() }}",
            my_currency:$("#payment_type").val()
        },
        success:function(){

        }
    });
    if ($("#payment_type").val() == 'Euro') {
        $("#booking_form").addClass('euro-actvie').removeClass('boxa-actvie');
    } else {
        $("#booking_form").removeClass('euro-actvie').addClass('boxa-actvie');
    }
}
$(document).ready(function(){
    changePricing();
})
</script>
@endpush
@stop