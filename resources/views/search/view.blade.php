@extends('maptemplate')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link href="{{ url('css/bootstrap-slider.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('main')
<main class="listing_detail p-0">
    <section class="m-0">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <!-- Filter section start-->
                <div class="col-md-7 hidden-pod filter-h p-4" id="listCol">
                    <div class="d-flex justify-content-between mb-4">
                        <h3>{{trans('messages.search.results_for')}} <strong>{{$location}}</strong></h3>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('messages.trips_active.location')}}
                                        </button>

                                        <div class="w-100">
                                            <div class="dropdown-menu dropdown-menu-location" aria-labelledby="dropdownMenuButton">
                                                <div class="row">
                                                    <form id="front-search-form" method="post" action="{{url('search')}}">
                                                        {{ csrf_field() }}                                                        
                                                        <div class="row m-0">
                                                            <div class="col-md-12 form-group">
                                                                <h3 class="font-weight-700">{{trans('messages.header.where_are_you_going')}} </h3>
                                                                <div class="input-group">
                                                                    <input class="form-control p-3" id="front-search-field" value="{{$location}}" autocomplete="off" name="location" type="text" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 form-group date-range">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex form-group" id="daterange-btn">
                                                                            <div class="pr-3">
                                                                                <h3 class="font-weight-700">{{trans('messages.search.check_in')}}</h3>
                                                                                <div class="input-group date" >
                                                                                    <input class="form-control checkinout" name="checkin" id="startDate" type="text" placeholder="{{trans('messages.search.check_in')}}" value="{{$checkin}}" autocomplete="off" readonly="readonly" required>
                                                                                  
                                                                                </div>
                                                                            </div>

                                                                            <div>
                                                                                <h3 class="font-weight-700">{{trans('messages.search.check_out')}}</h3>
                                                                                <div class="input-group date">
                                                                                    <input class="form-control checkinout" name="checkout" id="endDate" type="text" placeholder="{{trans('messages.search.check_out')}}"  value="{{$checkout}}" readonly="readonly" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button class="btn vbtn-outline-success w-100 m-0" type="submit">
                                                                    <i class="fa fa-search mr-3" aria-hidden="true"></i>
                                                                    {{trans('messages.header.find_place')}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-inline-item ">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownGuestType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('messages.search.guest')}}
                                        </button>
                                        <div class="w-100">
                                            <div class="dropdown-menu dropdown-menu-location" aria-labelledby="dropdownGuestType">
                                                <input class="adult_guests_value" name="adults" type="hidden" value="{{$guest}}" />
                                                <input class="children_guests_value" name="children" type="hidden" value="{{$children}}" />
                                                <input class="infant_guests_value" name="infants" type="hidden" value="{{$infants}}" />
                                                <input class="pets_guests_value" name="pets" type="hidden" value="{{$pets}}" />
                                                <div class="row">
                                                    <div id="popover_content_wrapper" class="col-md-12 popover-body">
                                                    
                                                        <div class="search-filter stepper-adults d-flex justify-content-between align-items-center">
                                                            
                                                            <div>
                                                                <h4>{{trans('messages.home.adults')}}</h4>
										                        <span>{{trans('messages.home.age')}}s 13 {{trans('messages.home.or')}} {{trans('messages.home.above')}}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn decrease adult guests" value="-" {{ ($guest == 0) ? 'disabled="true"' : ''}} >
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                                <h5 class="adult-guests-value">{{$guest}}</h5>
                                                                <button type="button" class="btn increase adult guests" value="+">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="search-filter stepper-childrens d-flex justify-content-between align-items-center">
                                                        
                                                            <div>
                                                                <h4>{{trans('messages.home.children')}}</h4>
										                        <span>{{trans('messages.home.age')}}s 2–12</span>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn decrease children guests" value="-" {{ ($children == 0) ? 'disabled="true"' : ''}}>
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                                <h5 class="children-guests-value">{{$children}}</h5>
                                                                <button type="button" class="btn increase children guests" value="+">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="search-filter stepper-infants d-flex justify-content-between align-items-center">
                                                            
                                                            <div>
                                                                <h4>{{trans('messages.home.infants')}}</h4>
										                        <span>{{trans('messages.home.under')}} 2</span>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn decrease infant guests" value="-" {{ ($infants == 0) ? 'disabled="true"' : ''}}>
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                                <h5 class="infant-guests-value">{{$infants}}</h5>
                                                                <button type="button" class="btn increase infant guests" value="+">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="search-filter stepper-pets d-flex justify-content-between align-items-center">									
                                                            <div>
                                                                <h4>{{trans('messages.home.pets')}}</h4>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn decrease pets guests" value="-" d{{ ($pets == 0) ? 'disabled="true"' : ''}}>
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                                <h5 class="pets-guests-value">{{$pets}}</h5>
                                                                <button type="button" class="btn increase pets guests" value="+">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <button class="btn vbtn-outline-success w-100" id="btnRoom">{{trans('messages.utility.submit')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item ">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownRoomType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{trans('messages.search.room_type')}}
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-room-type" aria-labelledby="dropdownRoomType">
                                        <div class="row">
                                            @foreach($space_type as $rws=>$value)
                                                <div class="col-md-12">
                                                    @if($rws==1)
                                                        <div class="d-flex justify-content-between form-group">
                                                            <div>
                                                                <i class="icon icon-entire-place"></i> {{ $value }}
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" id="space_type_{{ $rws }}" name="space_type[]" value="{{ $rws }}" class="form-check-input" {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($rws==2)
                                                        <div class="d-flex justify-content-between form-group">
                                                            <div>
                                                                <i class="icon icon-private-room"></i> {{ $value }}
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" id="space_type_{{ $rws }}" name="space_type[]" value="{{ $rws }}" class="form-check-input" {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($rws==3)
                                                        <div class="d-flex justify-content-between ">
                                                            <div>
                                                                <i class="icon icon-shared-room"></i> {{ $value }}
                                                            </div>
                                                            <div>
                                                                <input type="checkbox"  id="space_type_{{ $rws }}" name="space_type[]" value="{{ $rws }}" class="form-check-input" {{ in_array($rws, $space_type_selected)?'checked':'' }}>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            <div class="col-md-12 text-right">
                                                <button class="btn vbtn-outline-success w-100" id="btnRoom">{{trans('messages.utility.submit')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                               
                                <li class="list-inline-item ">
                                    <button type="button" id="more_filters" class="btn btn-outline-danger m-0 filter" data-toggle="modal" data-target="#exampleModalCenter">
                                        {{ trans('messages.search.more_filters') }}
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="">
                            <div class="show-map d-none" id="showMap">
                                <a href="#" class="btn show-map"><i class="fas fa-map-marked-alt"></i> {{ trans('messages.search.show_map') }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- No result found section start -->
                    <div class="row m-0">
                        <div id="loader" class="display-off loader-img position-center">
                            <img src="{{URL::to('/')}}/front/img/green-loader.gif" alt="loader">
                        </div>
                    </div>

                    <div class="row m-0">
                        <div id="properties_show" class="col-12 w-100 search-listing">
                            <div class="text-center justify-content-center w-100 position-center">
                                <!-- not found image -->
                            </div>
                        </div>
                    </div>
                    <!-- No result found section end -->

                    <!-- Pagination start -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div id="pagination">
                                <ul class="pager pagination mb-3" id="pager">
                                <!--Pagination -->
                                </ul>
                                <div class=""><span id="page-from">0</span> – <span id="page-to">0</span> {{ trans('messages.search.of') }} <span id="page-total">0</span> {{trans('messages.search.rentals')}}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination end -->
                </div>
                <!-- Filter section end -->

                <!--Map section start -->
                <div class="col-md-5 p-0" id="mapCol">
                    <div class="map-close" id="closeMap"><i class="fas fa-times text-24 p-3  text-center"></i></div>
                    <div id="map_view" class="map-view"></div>
                </div>
                <!--Map section end -->
            </div>

                <!-- Modal -->
                <div class="modal calender_modal z-index-high" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg " role="document">
                        <div class="modal-content">
                            <div class="modal-header p-4">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('messages.search.more_filters') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body modal-body-filter p-4">
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <h5 class="mb-4" for="user_birthdate">{{ trans('messages.search.size') }}</h5>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="select col-sm-4">
                                                <select name="min_bedrooms" class="form-control" id="map-search-min-bedrooms">
                                                    <option value="">{{ trans('messages.search.bedrooms') }}</option>
                                                    @for($i=1;$i<=10;$i++)
                                                        <option value="{{ $i }}" {{ ($bedrooms==$i)?'selected':''}}>
                                                            {{ $i }} {{ trans('messages.search.bedrooms') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="select col-sm-4">
                                                <select name="min_bathrooms" class="form-control" id="map-search-min-bathrooms">
                                                    <option value="">{{ trans('messages.search.bathrooms') }}</option>
                                                    @for($i=0.5;$i<=8;$i+=0.5)
                                                        <option class="bathrooms" value="{{ $i }}" {{ $bathrooms == $i?'selected':''}}>
                                                            {{ ($i == '8') ? $i.'+' : $i }} {{ trans('messages.search.bathrooms') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="select col-sm-4">
                                                <select name="min_beds" class="form-control" id="map-search-min-beds">
                                                    <option value="">{{ trans('messages.search.beds') }}</option>
                                                    @for($i=1;$i<=16;$i++)
                                                        <option value="{{ $i }}" {{ $beds == $i?'selected':''}}>
                                                            {{ ($i == '16') ? $i.'+' : $i }} {{ trans('messages.search.beds') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        <h5 class="" for="user_birthdate">{{ trans('messages.search.amenities') }}</h5>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row">
                                            @php $row_inc = 1 @endphp

                                            @foreach($amenities as $row_amenities)
                                                @if($row_inc <= 4)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="amenities[]" value="{{ $row_amenities->id }}" class="form-check-input mt-2 amenities_array" id="map-search-amenities-{{ $row_amenities->id }}">
                                                            <label class="form-check-label" for="exampleCheck1"> {{ $row_amenities->title }}</label>
                                                        </div>
                                                    </div>
                                                @endif

                                                @php $row_inc++ @endphp
                                            @endforeach

                                            <div class="collapse" id="amenities-collapse">
                                                <div class="row m-0">
                                                    @php $amen_inc = 1 @endphp
                                                    @foreach($amenities as $row_amenities)
                                                        @if($amen_inc > 4)
                                                            <div class="col-md-6 mb-3">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="amenities[]" value="{{ $row_amenities->id }}" class="form-check-input mt-2 amenities_array" id="map-search-amenities-{{ $row_amenities->id }}" ng-checked="{{ (in_array($row_amenities->id, $amenities_selected)) ? 'true' : 'false' }}">
                                                                    <label class="form-check-label" for="exampleCheck1"> {{ $row_amenities->title }}</label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @php $amen_inc++ @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="cursor-pointer btn btn-outline-danger m-0 filter" data-toggle="collapse" data-target="#amenities-collapse" >
                                            <span class="mr-2">Show all amenities</span>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-sm-12 mb-4">
                                        <h5 class="" for="user_birthdate">{{ trans('messages.search.property_type') }}</h5>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row ">
                                            @php $pro_inc = 1 @endphp
                                            @foreach($property_type as $row_property_type =>$value_property_type)
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="property_type[]" value="{{ $row_property_type }}" class="form-check-input mt-2" id="map-search-property_type-{{ $row_property_type }}"  {{ (in_array(strval($row_property_type), $property_type_selected)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="exampleCheck1"> {{ $value_property_type}}</label>
                                                </div>
                                            </div>
                                                
                                                @php $pro_inc++ @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                
                            </div>

                            <div class="modal-footer">
                                <div class="w-100 d-flex justify-content-between m-0">
                                    <button class="btn btn-outline-danger m-0"  data-dismiss="modal">{{ trans('messages.search.cancel') }}</button>
                                    <button class="btn vbtn-outline-success filter-apply m-0" data-dismiss="modal">{{ trans('messages.search.apply_filter') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</main>
    @push('scripts')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places&callback=callbackMap'></script>
	<script type="text/javascript" src="{{ url('js/front.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery-ui.js') }}"></script>
    @auth
        <script src="{{ url('js/sweetalert.min.js') }}"></script>
    @endauth
	<!-- daterangepicker -->
	<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
    <script src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/daterangecustom.js')}}"></script>
    <script type="text/javascript">
		$(function() {
            var checkin = $('#startDate').val();
            var checkout = $('#endDate').val();
			dateRangeBtn(checkin,checkout, null, '{{$date_format}}');
		});
	</script>
    <script>
        $.fn.slider = null;
    </script>
    <script src="{{ url('js/bootstrap-slider.min.js') }}"></script>
    <script type="text/javascript">
        var markers      = [];
        var allowRefresh = true;
        var loadPage = '{{url("search/result")}}';

        $("#price-range").slider();


        // $("#price-range").on("slideStop", function(slideEvt) {
        //     var range       = $('#price-range').attr('data-value');
        //     range           = range.split(',');
        //     var min_price       = range[0];
        //     var max_price       = range[1];
        //     $('#minPrice').html(min_price);
        //     $('#maxPrice').html(max_price);
        // });

        $('#header-search-form').on('change', function(){
            allowRefresh = true;
            deleteMarkers();
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
        });

        $("#search-pg-checkin").datepicker({
            dateFormat:"{{ Session::get('front_date_format_type')}}",
            minDate: 0,
            onSelect: function(e) {
                var t = $("#search-pg-checkin").datepicker("getDate");
                t.setDate(t.getDate() + 1), $("#search-pg-checkout").datepicker("option", "minDate", t), setTimeout(function() {
                    $("#search-pg-checkout").datepicker("show")
                }, 20);
                allowRefresh = true;
                loadPage = '{{url("search/result")}}';
                getProperties($('#map_view').locationpicker('map').map);
            }
        });

        $("#search-pg-checkout").datepicker({
            dateFormat:"{{ Session::get('front_date_format_type')}}",
            minDate: 1,
            onClose: function() {
                var e = $("#checkin").datepicker("getDate"),
                    t = $("#header-search-checkout").datepicker("getDate");
                if (e >= t) {
                    var a = $("#search-pg-checkout").datepicker("option", "minDate");
                    $("#search-pg-checkout").datepicker("setDate", a)
                }
            }, onSelect: function(){
                allowRefresh = true;
                loadPage = '{{url("search/result")}}';
                getProperties($('#map_view').locationpicker('map').map);
            }
        });

        $(document.body).on('click', '.page-data', function(e){
            e.preventDefault();
            var hr = $(this).attr('href');
            loadPage = hr;
            allowRefresh = true;
            getProperties($('#map_view').locationpicker('map').map, hr);
        });

        function addMarker(map, features){

            var infowindow = new google.maps.InfoWindow();
            for (var i = 0, feature; feature = features[i]; i++) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(feature.latitude, feature.longitude),
                    icon: feature.icon !== undefined ? feature.icon : undefined,
                    map: map,
                    title: feature.title !== undefined? feature.title : undefined,
                    content: feature.content !== undefined? feature.content : undefined,
                });
                markers.push(marker);

                google.maps.event.addListener(marker, 'click', function (e) {

                    if(this.content){
                        infowindow.setContent(this.content);
                        infowindow.open(map, this);
                    }
                });
                

            }
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        function moneyFormat(symbol, value) {
            var symbolPosition = '<?php echo currencySymbolPosition(); ?>';
            if (symbolPosition == "before") {
            val = symbol + ' ' + value;
            } else {
                val = value + ' ' + symbol;
            }
            return val;
        }

        function getProperties(map,url){

            if(loadPage) {
                url = url||'';
            p = map;
            var a = p.getZoom(),
                t = p.getBounds(),
                o = t.getSouthWest().lat(),
                i = t.getSouthWest().lng(),
                s = t.getNorthEast().lat(),
                r = t.getNorthEast().lng(),
                l = t.getCenter().lat(),
                n = t.getCenter().lng();

            // var range       = $('#price-range').attr('data-value');
            // range           = range.split(',');
            var map_details = a + "~" + t + "~" + o + "~" + i + "~" + s + "~" + r + "~" + l + "~" + n;
            var location    = $('#front-search-field').val();

            //Input Search value set
            $('#header-search-form').val(location);
            //Input Search value set
            // var min_price       = range[0];
            // var max_price       = range[1];
            // $('#minPrice').html(min_price);
            // $('#maxPrice').html(max_price);

            var amenities       = getCheckedValueArray('amenities');
            var property_type   = getCheckedValueArray('property_type');
            var book_type       = getCheckedValueArray('book_type');
            var space_type      = getCheckedValueArray('space_type');
            var beds            = $('#map-search-min-beds').val();
            var bathrooms       = $('#map-search-min-bathrooms').val();
            var bedrooms        = $('#map-search-min-bedrooms').val();
            var checkin         = $('#startDate').val();
            var checkout        = $('#endDate').val();
            var guest           = parseInt(parseInt($(".adult_guests_value").val()) + parseInt($(".children_guests_value").val()));
            var guest_value     = (($(".adult_guests_value").val()));
            var infants_value   = $('.infant_guests_value').val();
            var pets_value      = $('.pets_guests_value').val();
            var children_value  = ($(".children_guests_value").val());
            //var map_details = map_details;
            var dataURL = loadPage;
            // if(url != '') dataURL = url;

            if($('#more_filters').css('display') != 'none'){
                $.ajax({
                    url: dataURL,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'location': location,
                        // 'min_price': min_price,
                        // 'max_price': max_price,
                        'amenities': amenities,
                        'property_type': property_type,
                        'book_type':book_type,
                        'space_type': space_type,
                        'beds': beds,
                        'bathrooms': bathrooms,
                        'bedrooms': bedrooms,
                        'checkin': checkin,
                        'checkout': checkout,
                        'guest': guest,
                        'infants': infants_value,
                        'pets': pets_value,
                        'map_details': map_details
                    },
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function (){
                        $('#properties_show').html("");
                        show_loader();
                    },
                    success: function (result) {
                        $('#page-total').html(result.total);
                        $('#page-from').html(result.from);
                        $('#page-to').html(result.to);

                        allowRefresh = false;

                        var pager = '';
                        if(result.total > 0) {
                            if(result.current_page > 1 ) pager +=  '<li class="page-item"><a class="page-data page-link" href="'+result.prev_page_url+'">Previous</a></li>';
                            if(result.current_page){
                                for(var i=1; i<= result.last_page; i++){
                                    if(result.current_page == i) {
                                        pager +=  '<li class="page-item active"><a  href="'+APP_URL+'/search/result?page='+i+'" class="page-data page-link">'+i+'</a></li>';
                                    } else {
                                        pager +=  '<li class="page-item"><a  href="'+APP_URL+'/search/result?page='+i+'" class="page-data page-link">'+i+'</a></li>';

                                    }
                                }
                            }

                            if(result.next_page_url) pager +=  '<li class="page-item"><a class="page-data page-link" href="'+result.next_page_url+'">Next</a></li>';
                            $('#pager').html(pager);
                            $('#pagination').removeClass('d-none');
                        } else {
                            $('#pagination').addClass('d-none');
                        }


                        var properties = result.data;
                        var room_point = [];
                        var room_div   = "";
                        for (var key in properties) {
                            if (properties.hasOwnProperty(key)) {
                                room_point[key] = {
                                    latitude: properties[key].property_address.latitude,
                                    longitude: properties[key].property_address.longitude,
                                    title: properties[key].name,

                                    content: '<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest_value+'&children='+children_value+'&infants='+infants_value+'&pets='+pets_value+'" class="media-cover" target="_blank">'
                                    +'<img class="map-property-img" src="'+properties[key].cover_photo+'"alt="'+properties[key].name+'">'
                                    +'</a>'
                                    +'<div class="map-property-name">'
                                        +'<div class="col-xs-12 p-1">'
                                            +'<div class="location-title"><h5>'+properties[key].name+'</h5></div>'
                                        +'</div>'
                                    +'</div>'
                                };

                                var avg_rating = properties[key].avg_rating;
                                reviews_count = 0;
                                if(properties[key].reviews_count == 1) reviews_count = properties[key].reviews_count;
                                else if(properties[key].reviews_count > 0) reviews_count = properties[key].reviews_count;

                                    var moneySymbol = properties[key].property_price.default_symbol;
                                    var price       = properties[key].property_price.price;
                                    var symbolWithPrice = moneyFormat(moneySymbol, price);
                                    var color = properties[key].book_mark ? '#1dbf73' : '';
                                    var colDiv ='col-md-6 col-lg-4';
                                    var divCol = $('#listCol').hasClass('col-md-7');
                                    if (divCol == false) {
                                        room_div +='<div class="col-sm-6 col-md-12 col-lg-12  p-0 mb-4">'
                                                    +'<div class=" row  border rounded-3">'
                                                        +'<div class="col-lg-5">'
                                                            +'<div class="img-event">'
                                                                +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest_value+'&children='+children_value+'&infants='+infants_value+'&pets='+pets_value+'" target="_blank">'
                                                                    +'<img class="room-image-container200 rounded" src="'+properties[key].cover_photo+'" alt="'+properties[key].name+'">'
                                                                +'</a>'
                                                            +'</div>'
                                                        +'</div>'

                                                        +'<div class="col-lg-7">'
                                                            +'<div class="row justify-content-between">'
                                                                +'<div class="col-sm-12 pl-0">'
                                                                    +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest_value+'&children='+children_value+'&infants='+infants_value+'&pets='+pets_value+'" target="_blank">'
                                                                        +'<p class="mb-0 text-18 text-color font-weight-700 text-color-hover text">' +properties[key].name+'</p>'
                                                                    +'</a>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<p class="text-muted">'
                                                                +'<i class="fas fa-map-marker-alt"></i>'
                                                                +' ' + properties[key].property_address.address_line_1
                                                            +'</p>'

                                                            +'<div class="review-0">'
                                                                +'<div class="d-flex justify-content-between">'
                                            +'<div class="d-flex">'
                                            +'<div class="d-flex align-items-center">'
                                            +'<span><i class="fa fa-star secondary-text-color"></i>'+' '+ avg_rating
                                            +' '+ '('+reviews_count+')</span>'
                                            +'</div>'
                                            +'<div>'
                                            @auth
                                            //+'<a class="btn btn-sm book_mark_change" data-status="'+properties[key].book_mark +'" data-id="'+properties[key].id+'" style="color:'+ color +'">'
                                            //+'<span style="font-size: 22px;">'
                                            //+'<i class="fas fa-heart pl-2"></i></span></a>'
                                            @endauth
                                            +'</div>'
                                            +'</div>'

                                                                    +'<div class="price">'
                                                                        +'<em>'+symbolWithPrice+'</em> / {{trans('messages.property_single.night')}}'
                                                                    +'</div>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<ul class="list-inline mt-2 pb-3">'
                                                                +'<li class="list-inline-item border rounded-3 p-1 pl-3 pr-3">'
                                                                    +'<p class="text-center mb-0">'
                                                                        +'<img src="{{ url('images/Union.svg')}}" class="img-fluid mr-1" alt=" {{trans('messages.home.guest')}}">'
                                                                        +properties[key].accommodates
                                                                        +'<span class=" font-weight-700"> {{trans('messages.home.guest')}}</span>'
                                                                    +'</p>'
                                                                +'</li>'
                                                                +'<li class="list-inline-item  border rounded-3 p-1  pl-3 pr-3">'
                                                                    +'<p  class="text-center mb-0" >'
                                                                        +'<img src="{{ url('images/Bedrooms.svg')}}" class="img-fluid mr-1" alt="{{trans('messages.property_single.bedroom')}}">'
                                                                        +properties[key].bedrooms
                                                                        +'<span class=" font-weight-700"> {{trans('messages.property_single.bedroom')}}</span>'
                                                                    +'</p>'
                                                                +'</li>'
                                                                +'<li class="list-inline-item  border rounded-3 p-1  pl-3 pr-3">'
                                                                    +'<p  class="text-center mb-0">'
                                                                        +'<img src="{{ url('images/Bathroom.svg')}}" class="img-fluid mr-1" alt="{{trans('messages.property_single.bathroom')}}">'
                                                                        +properties[key].bathrooms
                                                                        +'<span class="text-14 font-weight-700"> {{trans('messages.property_single.bathroom')}}</span>'
                                                                    +'</p>'
                                                                +'</li>'
                                                            +'</ul>'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                    } else{
                                        room_div +='<div class="col-sm-6 col-md-12 col-lg-12  p-0 mb-4">'
                                                    +'<div class=" row  border rounded-3">'
                                                        +'<div class="col-lg-5">'
                                                            +'<div class="img-event">'
                                                                +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest_value+'&children='+children_value+'&infants='+infants_value+'&pets='+pets_value+'" target="_blank">'
                                                                    +'<img class="room-image-container200 rounded" src="'+properties[key].cover_photo+'" alt="'+properties[key].name+'">'
                                                                +'</a>'
                                                            +'</div>'
                                                        +'</div>'

                                                        +'<div class="col-lg-7">'
                                                            +'<div class="row justify-content-between">'
                                                                +'<div class="col-sm-12 pl-0">'
                                                                    +'<a href="'+APP_URL+'/properties/'+properties[key].slug+'?checkin='+checkin+'&checkout='+checkout+'&guests='+guest_value+'&children='+children_value+'&infants='+infants_value+'&pets='+pets_value+'" target="_blank">'
                                                                        +'<p class="mb-0 text-18 text-color font-weight-700 text-color-hover text">' +properties[key].name+'</p>'
                                                                    +'</a>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<p class="text-muted">'
                                                                +'<i class="fas fa-map-marker-alt"></i>'
                                                                +' ' + properties[key].property_address.address_line_1
                                                            +'</p>'

                                                            +'<div class="review-0">'
                                                                +'<div class="d-flex justify-content-between">'
                                            +'<div class="d-flex">'
                                            +'<div class="d-flex align-items-center">'
                                            +'<span><i class="fa fa-star secondary-text-color"></i>'+' '+ avg_rating
                                            +' '+ '('+reviews_count+')</span>'
                                            +'</div>'
                                            +'<div>'
                                            @auth
                                            //+'<a class="btn btn-sm book_mark_change" data-status="'+properties[key].book_mark +'" data-id="'+properties[key].id+'" style="color:'+ color +'">'
                                            //+'<span style="font-size: 22px;">'
                                            //+'<i class="fas fa-heart pl-2"></i></span></a>'
                                            @endauth
                                            +'</div>'
                                            +'</div>'

                                                                    +'<div class="price">'
                                                                        +'<em>'+symbolWithPrice+'</em> / {{trans('messages.property_single.night')}}'
                                                                    +'</div>'
                                                                +'</div>'
                                                            +'</div>'

                                                            +'<ul class="list-inline mt-2 pb-3">'
                                                                +'<li class="list-inline-item border rounded-3 p-1 pl-3 pr-3">'
                                                                    +'<p class="text-center mb-0">'
                                                                        +'<img src="{{ url('images/Union.svg')}}" class="img-fluid mr-1" alt=" {{trans('messages.home.guest')}}">'
                                                                        +properties[key].accommodates
                                                                        +'<span class=" font-weight-700"> {{trans('messages.home.guest')}}</span>'
                                                                    +'</p>'
                                                                +'</li>'
                                                                +'<li class="list-inline-item  border rounded-3 p-1  pl-3 pr-3">'
                                                                    +'<p  class="text-center mb-0" >'
                                                                        +'<img src="{{ url('images/Bedrooms.svg')}}" class="img-fluid mr-1" alt="{{trans('messages.property_single.bedroom')}}">'
                                                                        +properties[key].bedrooms
                                                                        +'<span class=" font-weight-700"> {{trans('messages.property_single.bedroom')}}</span>'
                                                                    +'</p>'
                                                                +'</li>'
                                                                +'<li class="list-inline-item  border rounded-3 p-1  pl-3 pr-3">'
                                                                    +'<p  class="text-center mb-0">'
                                                                        +'<img src="{{ url('images/Bathroom.svg')}}" class="img-fluid mr-1" alt="{{trans('messages.property_single.bathroom')}}">'
                                                                        +properties[key].bathrooms
                                                                        +'<span class="text-14 font-weight-700"> {{trans('messages.property_single.bathroom')}}</span>'
                                                                    +'</p>'
                                                                +'</li>'
                                                            +'</ul>'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                    }
                                }
                            }

                            if(room_div != '') $('#properties_show').html(room_div);
                            else $('#properties_show').html(' <div class="text-center justify-content-center w-100 position-center"><img src="{{ url('img/not-found.png')}}" class="img-fluid not-found" alt="not-found"><h4 class="text-center text-20 font-weight-700">{{trans('messages.search.no_result_found')}}</h4></div>');

                            //deleteMarkers();
                            addMarker(map, room_point);
                            
                        },
                        error: function (request, error) {
                            allowRefresh = false;
                            // This callback function will trigger on unsuccessful action
                            console.log(error);
                        },
                        complete: function(){
                            hide_loader();
                        }
                });
            }

            }


        }

        $('#btnBook, #btnRoom, #btnPrice, .filter-apply').on('click', function(){
            allowRefresh = true;
            deleteMarkers();
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
            $('.room_filter').addClass('display-off');
            $('#more_filters').show();
            $('.dropdown-menu-price').removeClass('show');
        });


        function getCheckedValueArray(field_name){
            var array_Value = '';
            array_Value = $('input[name="' + field_name + '[]"]:checked').map(function() {
                return this.value;
            })
                .get()
                .join(',');

            return array_Value;
        }


        // $(document.body).on('scroll','#map_view',function(){
        //     allowRefresh = true;
        //     loadPage = '{{url("search/result")}}';
        //     getProperties($('#map_view').locationpicker('map').map);
        // });

        $('#map_view').locationpicker({
            location: {
                latitude: {{"$lat"}},
                longitude: {{"$long"}}
            },
            radius: 0,
            zoom: {{($lat == 0) ? 18 : 12 }},
            //zoom: 12,
            addressFormat: "",
            markerVisible: false,
            markerInCenter: false,
            inputBinding: {
                latitudeInput: $('#latitude'),
                longitudeInput: $('#longitude'),
                locationNameInput: $('#address_line_1')
            },
            enableAutocomplete: true,
            draggable: true,
            onclick: function (currentLocation, radius, isMarkerDropped) {
                if (allowRefresh == true) {
                    getProperties($(this).locationpicker('map').map);
                }
            },

            oninitialized: function (component) {
                var addressComponents = $(component).locationpicker('map').location.addressComponents;
            }
        });

        $('.slider-selection').trigger('click');

        function show_loader(){
            $('#loader').removeClass('display-off');
            $('#pagination').hide();
        }

        function hide_loader(){
            $('#loader').addClass('display-off');
            $('#pagination').show();
        }

        // Map Close
        $('#closeMap').on('click', function(){
            $('#listCol').removeClass('col-md-7');
            $('#listCol').addClass('col-md-12');
            $('#mapCol').addClass('d-none');
            $('#showMap').removeClass('d-none');

            allowRefresh = true;
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);

        });
        // Map show
        $('#showMap').on('click', function(){
            $('#listCol').removeClass('col-md-12');
            $('#listCol').addClass('col-md-7');
            $('#mapCol').removeClass('d-none');
            $('#showMap').addClass('d-none');
            allowRefresh = true;
            loadPage = '{{url("search/result")}}';
            getProperties($('#map_view').locationpicker('map').map);
        });

        $( window ).on( "load", function() {
                allowRefresh = true;
                loadPage = '{{url("search/result")}}';
                getProperties($('#map_view').locationpicker('map').map);
                google.maps.event.addListener($('#map_view').locationpicker('map').map, 'zoom_changed', function (e) {
                        allowRefresh = true;
                        loadPage = '{{url("search/result")}}';
                        getProperties($('#map_view').locationpicker('map').map);
                });
        });
        $(document).on('click', '.guests', function(event){
			if ($(this).hasClass('increase')) {
				const guest_type = $(this).attr('class').replace('btn', '').replace('guests', '').replace('increase', '').trim();
				const guest_val = parseInt($("."+guest_type+"_guests_value").val()) + 1;
				$("."+guest_type+"_guests_value").val(guest_val);
				$("."+guest_type+"-guests-value").text(guest_val);
				$(".decrease.guests."+guest_type).attr('disabled', false)
			} else {
				const guest_type = $(this).attr('class').replace('btn', '').replace('guests', '').replace('decrease', '').trim();
				const guest_val = parseInt($("."+guest_type+"_guests_value").val()) - 1;
				$("."+guest_type+"_guests_value").val(guest_val);
				$("."+guest_type+"-guests-value").text(guest_val);
				if (guest_val == 0) {
					$(this).attr('disabled', true)
				}
			}
			let guest_text = parseInt($(".adult_guests_value").val()) + " guests,";			
			if ($(".children_guests_value").val() > 0) {
				guest_text = guest_text + " " + $(".children_guests_value").val() + " children,";
			}
			if ($(".infant_guests_value").val() > 0) {
				guest_text = guest_text + " " + $(".infant_guests_value").val() + " infants,";
			}
			if ($(".pets_guests_value").val() > 0) {
				guest_text = guest_text + " " + $(".pets_guests_value").val() + " pets";
			}
			$("#guest_text").text(guest_text);
		})
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });        

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
    </script>
    @endpush
@endsection
