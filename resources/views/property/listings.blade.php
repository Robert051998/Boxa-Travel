@extends('template')

@section('main')
<main>
    <div class="row m-0">
        @include('users.sidebar')
        <div class="col-xl-10 col-lg-9 min-height right-section p-0">
            <div class="container-fluid inner-content">
                <div class="row m-0 mb-3">
                    <div class="col-12 p-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">{{trans('messages.listing_basic.listing')}}</h4>
                            <div>
                                <form action="{{ url('/properties') }}" method="POST" id="listing-form">
                                    {{ csrf_field() }}
                                    <select class="form-control room-list-status" id="listing_select" name="status">
                                        <option value="All" {{ @$status == "All" ? ' selected="selected"' : '' }}>{{trans('messages.filter.all')}}</option>
                                        <option value="Listed" {{ @$status == "Listed" ? ' selected="selected"' : '' }}>{{trans('messages.property.listed')}}</option>
                                        <option value="Unlisted" {{ @$status == "Unlisted" ? ' selected="selected"' : '' }}>{{trans('messages.property.unlisted')}}</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success d-none" role="alert" id="alert">
                    <span id="messages"></span>
                </div>

                <div id="products" class="row m-0 inner-Bookings">
                    <div class="col-12 p-0">
                        @forelse($properties as $property)
                            <div class="d-flex justify-content-between align-items-center booking-details">
                                <div class="booking-info">
                                    <div class="booking-info-img">
                                        <a href="properties/{{ $property->slug }}">
                                            <img class="" src="{{ $property->cover_photo }}" alt="{{ ($property->name == '') ? '' : $property->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center booking-info-text">
                                    <div class="mr-3">
                                        <h4 class="">
                                            <a href="properties/{{ $property->slug }}">
                                                {{ ($property->name == '') ? '' : $property->name }}
                                            </a>
                                        </h4>
                                        <span class="d-flex">
                                            <img src="{{URL::to('images/Location.svg')}}" alt="Location" class="mr-2" /> 
                                            {{$property->property_address->address_line_1}}
                                        </span>
                                        <span class="rating d-flex">
                                            <i class="fa fa-star mr-1"></i>
                                            @php
                                                $review = $property->reviews_count;
                                            @endphp
                                            @if($review)
                                                {{ $property->avg_rating }}
                                            @else
                                                0
                                            @endif
                                            ({{ $review }})
                                        </span>
                                        <div class="d-flex">
									        <div class="w-100">
                                                <ul class="list-inline d-flex justify-content-between mt-2">
                                                    <li class="list-inline-item">
                                                        <div class="vtooltip d-flex align-items-center"> 
                                                            <img src="{{URL::to('images/Union.png')}}" alt="Guests" />
                                                            <span class="m-0 ml-1">{{ $property->accommodates }} {{trans('messages.property_single.guest')}}</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="vtooltip d-flex align-items-center"> 
                                                            <img src="{{URL::to('images/Bed.png')}}" alt="Bed" />
                                                            <span class="m-0 ml-1">{{ $property->bedrooms }} {{trans('messages.property_single.bed')}}</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="vtooltip d-flex align-items-center"> 
                                                            <img src="{{URL::to('images/bathroom.png')}}" alt="Bathrooms" />
                                                            <span class="m-0 ml-1">{{ $property->bathrooms }} {{trans('messages.property_single.bathroom')}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="status text-center">
                                        <div class="d-flex mb-5">
                                            <a href="{{ url('listing/'.$property->id.'/basics') }}" class="mr-5">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.4">
                                                    <path d="M11.4925 2.789H7.75349C4.67849 2.789 2.75049 4.966 2.75049 8.048V16.362C2.75049 19.444 4.66949 21.621 7.75349 21.621H16.5775C19.6625 21.621 21.5815 19.444 21.5815 16.362V12.334" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.9209L16.3011 3.44793C17.2321 2.51793 18.7411 2.51793 19.6721 3.44793L20.8891 4.66493C21.8201 5.59593 21.8201 7.10593 20.8891 8.03593L13.3801 15.5449C12.9731 15.9519 12.4211 16.1809 11.8451 16.1809H8.09912L8.19312 12.4009C8.20712 11.8449 8.43412 11.3149 8.82812 10.9209Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                </svg>
                                            </a>
                                            <div class="main-toggle-switch text-left text-sm-center">
                                                @if($property->steps_completed == 0)
                                                <label class="toggleSwitch large" onclick="">
                                                    <input type="checkbox" id="status" data-id="{{ $property->id}}" data-status="{{$property->status}}"  {{ $property->status == "Listed" ? 'checked' : '' }}/>
                                                    <span>
                                                        <span>{{trans('messages.property.unlisted')}}</span>
                                                        <span>{{trans('messages.property.listed')}}</span>
                                                    </span>
                                                    <a href="#" aria-label="toggle"></a>
                                                </label>
                                                @else
                                                <span class="badge badge-warning">{{ $property->steps_completed }} {{trans('messages.property.step_listed')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="price mt-5 text-right">
                                            <em>{!! moneyFormat( $currentCurrency->symbol, $property->property_price->price) !!}</em>
                                            / {{trans('messages.property_single.night')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center w-100 pt-4 pb-4">
                                <img src="{{ url('img/unnamed.png')}}" class="img-fluid"   alt="Not Found">
                                <p class="text-center fs-6">{{trans('messages.message.empty_listing')}}</p>
                            </div>
                        @endforelse
                    </div>
                    
                </div>
                <div id="products" class="row m-0 mt-5">
                    <div class="col-12 p-0 text-center note">
                        <p>{{trans('messages.message.note_pro')}}</p>
                    </div>
                </div>
                <div class="row justify-content-between overflow-auto  pb-3 mt-4 mb-5">
                    {{ $properties->appends(request()->except('page'))->links('paginate')}}
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@push('scripts')
<script type="text/javascript">
    $(document).on('click', '#status', function(){
        var id = $(this).attr('data-id');
        var datastatus = $(this).attr('data-status');
        var dataURL = APP_URL+'/listing/update_status';
        $('#messages').empty();
        $.ajax({
            url: dataURL,
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
                'status':datastatus,
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $("#status").attr('data-status', data.status)
                $("#messages").append("");
                $("#alert").removeClass('d-none');
                $("#messages").append(data.name+" "+"has been"+" "+data.status+".");
                var header = $('#alert');
                setTimeout(function() {
                    header.addClass('d-none');
                }, 4000);
            }
        });
    });

     $(document).on('change', '#listing_select', function(){

            $("#listing-form").trigger("submit");

    });
</script>
@endpush


