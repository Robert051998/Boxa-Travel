@extends('template')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endpush

@section('main')
<main>
	<input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}">
	
	<section class="search">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form id="front-search-form" method="post" action="{{url('search')}}">
						{{ csrf_field() }}
						<input class="adult_guests_value" name="adults" type="hidden" value="1" />
						<input class="children_guests_value" name="children" type="hidden" value="0" />
						<input class="infant_guests_value" name="infants" type="hidden" value="0" />
						<input class="pets_guests_value" name="pets" type="hidden" value="0" />
						<div class="input-group search-field">
							<input class="form-control" id="front-search-field" placeholder="{{trans('messages.home.where_want_to_go')}}" autocomplete="off" name="location" type="text" required>
						</div>
						<div class="d-flex data-range" id="daterange-btn">
							<div class="input-group date" >
								<input class="form-control checkinout" name="checkin" id="startDate" type="text" placeholder="{{trans('messages.search.check_in')}}" autocomplete="off" readonly="readonly" required>
							</div>

							<div class="input-group date enddate">
								<input class="form-control checkinout" name="checkout" id="endDate" placeholder="{{trans('messages.search.check_out')}}" type="text" readonly="readonly" required>
							</div>
						</div>
						
						<div class="input-group guest-field">
							<div class="form-control"  data-toggle="popover-click">
								<b>{{trans('messages.home.who')}}</b>
								<span id="guest_text">1 {{trans('messages.home.guest')}}s,</span>
								<i class="far fa-times-circle d-none"></i>
							</div>
							<div id="popover_content_wrapper" class="guests-popover" style="display: none">
								<div class="search-filter stepper-adults d-flex justify-content-between align-items-center">
									
									<div>
										<h4>{{trans('messages.home.adults')}}</h4>
										<span>{{trans('messages.home.age')}}s 13 {{trans('messages.home.or')}} {{trans('messages.home.above')}}</span>
									</div>
									<div class="d-flex align-items-center">
										<button type="button" class="btn decrease adult guests" value="-" disabled="true">
											<i class="fa fa-minus"></i>
										</button>
										<h5 class="adult-guests-value">1</h5>
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
										<button type="button" class="btn decrease children guests" value="-" disabled="">
											<i class="fa fa-minus"></i>
										</button>
										<h5 class="children-guests-value">0</h5>
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
										<button type="button" class="btn decrease infant guests" value="-" disabled="">
											<i class="fa fa-minus"></i>
										</button>
										<h5 class="infant-guests-value">0</h5>
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
										<button type="button" class="btn decrease pets guests" value="-" disabled="">
											<i class="fa fa-minus"></i>
										</button>
										<h5 class="pets-guests-value">0</h5>
										<button type="button" class="btn increase pets guests" value="+">
											<i class="fa fa-plus"></i>
										</button>
									</div>
								</div>								
							</div>
						</div>
					
						<button type="submit" class="btn vbtn-default d-flex align-items-center justify-content-center">
							<img src="{{URL::to('images/Search.svg')}}" alt="Search" class="mr-2" /><span>{{trans('messages.home.search')}}</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<section class="hero-banner magic-ball" style="background-image: url('{{ BANNER_URL }}');">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12">
					<div class="banner-img"></div>
					<div class="banner-text">
						<div class="container">
							<div class="row">
								<div class="col-12 col-md-4 col-sm-12">
									<div class="inner-text">
										<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M25.008 10.4083C25.6909 9.62228 26.0979 9.05763 26.5988 8.59241C30.6039 4.87811 36.3854 3.96079 41.3322 6.23252C46.2264 8.47798 49.2466 13.3572 49.0234 18.8067C48.879 22.3503 47.5715 25.4981 45.0446 27.9612C41.4672 31.4466 37.7511 34.797 34.0236 38.123C31.6244 40.2653 29.1013 42.2687 26.6213 44.321C25.5877 45.1764 24.5128 45.2439 23.5617 44.4166C17.6957 39.3085 11.8166 34.2173 6.0182 29.0323C3.31501 26.6105 1.64545 23.5584 1.12208 19.8929C0.0997047 12.7325 5.68241 5.69413 12.8972 5.08446C17.2868 4.71303 21.0142 6.06368 24.0963 9.2002C24.3777 9.48722 24.5859 9.84364 25.008 10.4083ZM44.7745 18.0076C44.7445 17.7056 44.737 17.1372 44.6244 16.5913C43.9134 13.1471 41.8706 10.8041 38.5502 9.71795C35.1548 8.60742 32.0727 9.36528 29.4239 11.7589C28.4972 12.5956 27.6531 13.5223 26.7582 14.3965C25.6308 15.4976 24.434 15.4995 23.3047 14.3965C22.4324 13.5467 21.6032 12.65 20.7103 11.8208C18.2641 9.55475 15.3884 8.71997 12.1412 9.53036C5.4104 11.2074 3.07302 19.1556 7.68588 24.6145C8.37059 25.4249 9.09656 26.2128 9.89007 26.9125C14.7393 31.1877 19.6204 35.4292 24.4734 39.7025C24.9555 40.1264 25.2481 39.9895 25.6552 39.6406C27.5086 38.0592 29.4258 36.5491 31.2379 34.9208C34.8359 31.6848 38.432 28.4395 41.9268 25.091C43.8234 23.2751 44.7388 20.9228 44.7763 18.0057L44.7745 18.0076Z" fill="#40C79E"/>
										</svg>
										<span class="ml-3">{{trans('messages.home.implementing')}}</span>
									</div>
								</div>
								<div class="col-12 col-md-4 col-sm-12">
									<div class="inner-text">
										<svg width="50" height="51" viewBox="0 0 50 51" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M39.8733 21.5569C37.3014 17.9611 34.7331 14.3633 32.1631 10.7637C30.304 8.16034 28.445 5.55694 26.5859 2.95539C25.8768 1.96106 25.2342 1.5 24.564 1.5C23.8937 1.5 23.2326 1.97402 22.5031 2.99427L18.8387 8.12146C15.5594 12.7098 12.1691 17.4537 8.84355 22.1254C6.79934 25.001 5.8476 28.2876 6.0198 31.8965C6.49382 41.9194 14.9188 49.487 25.6194 49.5H25.6342C32.6501 49.1186 38.2457 45.2875 41.3953 38.7142C44.2561 32.7408 43.7451 26.9693 39.8751 21.5569H39.8733ZM36.1182 39.8956C32.1723 44.7302 27.0266 46.5485 21.2366 45.1542C15.3169 43.7284 11.4803 39.7641 10.1378 33.6926C9.39534 30.3337 10.0656 27.1581 12.1321 24.2529C15.0928 20.0904 18.1128 15.8632 21.0329 11.7766L24.114 7.46227C24.2399 7.28637 24.3695 7.11416 24.5232 6.91234C24.538 6.89382 24.551 6.8753 24.5658 6.85494L32.5908 18.0888C33.0093 18.6758 33.4277 19.2776 33.8333 19.859C34.7128 21.1218 35.6219 22.4272 36.5866 23.6604C40.3251 28.4432 40.1362 34.9683 36.1145 39.8956H36.1182Z" fill="#40C79E"/>
											<path d="M33.4539 29.3876C32.3522 29.3098 31.6967 30.0449 31.6115 31.4336C31.5911 31.7706 31.5541 32.1095 31.493 32.4409C31.006 35.1036 28.647 38.057 24.5179 38.2495C23.3995 38.3014 22.7181 39.042 22.7792 39.9975C22.8403 40.9566 23.6198 41.5991 24.7012 41.5788C30.1339 41.4806 34.7722 36.97 34.9537 31.6077C35.0018 30.1986 34.5019 29.4598 33.4502 29.3857L33.4539 29.3876Z" fill="#40C79E"/>
										</svg>
										<span class="ml-3">{{trans('messages.home.conserving')}}</span>
									</div>
								</div>
								<div class="col-12 col-md-4 col-sm-12">
									<div class="inner-text">
										<svg width="50" height="51" viewBox="0 0 50 51" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M46.3504 8.53118C42.1819 8.51798 37.7466 8.7061 33.5312 10.1698C29.403 11.6038 27.1106 13.8579 26.3219 17.2672C25.6977 19.9636 25.9024 22.5758 26.9294 25.0329C27.062 25.3514 27.0385 25.4619 26.8891 25.6831C25.701 27.4323 24.7243 29.391 23.9188 31.6352C23.303 29.0197 22.4253 25.9867 21.0543 23.0758C21.0576 23.023 21.0845 22.8877 21.1852 22.6666C21.3261 22.3547 21.4906 22.0494 21.6651 21.7276C21.9772 21.15 22.2994 20.5527 22.4874 19.8959C23.0059 18.084 23.4406 15.348 22.5646 12.6055C21.7104 9.92722 19.8376 7.94702 16.9982 6.71929C12.1384 4.61697 6.99491 4.4734 2.55459 4.50311C1.65007 4.50971 1.04427 5.14502 1.01238 6.12523C0.993926 6.69619 0.995604 7.3018 1.02078 7.92391C1.16845 11.749 1.44534 15.8002 3.03789 19.584C4.518 23.0989 6.81032 25.1385 10.0474 25.82C12.3431 26.3035 14.5834 26.2227 16.7096 25.5791C17.2063 25.4289 17.6745 25.2491 18.1713 25.061C18.225 25.0412 18.277 25.0197 18.3307 24.9999C18.381 25.1105 18.4297 25.2194 18.4767 25.3283C20.2035 29.2953 21.1936 33.6848 21.593 39.1419C21.6853 40.4158 21.7205 41.7211 21.7557 42.9851C21.7692 43.4835 21.7826 43.9818 21.7994 44.4802C21.8447 45.7987 22.3867 46.4785 23.4154 46.5C23.4305 46.5 23.4456 46.5 23.459 46.5C23.8937 46.5 24.2528 46.368 24.5297 46.1073C24.8955 45.7624 25.0801 45.2129 25.0952 44.429C25.0952 44.3927 25.0952 44.3548 25.0952 44.3168C25.0952 44.2838 25.0919 44.2492 25.0952 44.2162C25.1858 43.4059 25.2647 42.5808 25.3402 41.7855C25.5131 39.9818 25.6926 38.1171 26.0098 36.3201C26.5149 33.462 27.5872 30.7078 29.1982 28.1237C29.2066 28.1286 29.2133 28.1336 29.2217 28.1402C29.6094 28.3976 30.0105 28.6633 30.4417 28.8795C31.2103 29.2639 31.853 29.5148 32.4639 29.6682C34.3501 30.1451 37.1727 30.5247 39.9114 29.6303C42.5796 28.7573 44.5582 26.8943 45.7899 24.0907C47.8271 19.4537 47.9983 14.6203 48 10.0658C48 9.16484 47.3204 8.53448 46.3487 8.53118H46.3504ZM35.7564 21.4091C36.5552 20.8992 37.4261 20.4438 38.1947 20.0411C38.7585 19.7458 40.0792 19.056 39.3929 17.7028C39.0572 17.0395 38.3105 16.4157 36.6659 17.2111C33.9104 18.5444 31.5006 20.2887 29.4986 22.4009C28.7032 19.8415 29.648 16.1748 31.6517 14.6929C32.9254 13.7507 34.486 13.0873 36.5602 12.6055C38.9264 12.0559 41.4721 11.7853 44.7461 11.7408C44.7327 12.013 44.7193 12.2837 44.7058 12.5526C44.6538 13.6022 44.6051 14.5939 44.5179 15.5972C44.2662 18.4652 43.7829 20.5956 42.9488 22.5032C42.051 24.556 40.2689 26.1039 38.0554 26.7507C35.8151 27.4059 33.4238 27.056 31.4939 25.7936C31.3664 25.7095 31.2405 25.6088 31.1046 25.495C32.3733 23.9322 33.8987 22.5906 35.7547 21.4075L35.7564 21.4091ZM9.74201 13.2441C9.12614 13.9866 9.23354 14.9041 10.0072 15.5263C10.4502 15.8827 10.915 16.2094 11.3664 16.5246C11.5695 16.6665 11.7709 16.8084 11.9722 16.9537C13.8954 18.3415 15.4728 20.0395 16.7801 22.1336C14.9006 23.0824 12.7375 23.2738 10.7573 22.6468C8.65458 21.9817 6.95128 20.4487 6.08033 18.4421C4.76468 15.4058 4.49618 12.1649 4.3334 9.10379C4.31159 8.69454 4.31662 8.2853 4.32333 7.81005C4.32333 7.76385 4.32333 7.71764 4.32501 7.67144C4.63714 7.68629 4.9476 7.69949 5.25134 7.71269C6.40086 7.7622 7.48493 7.8084 8.56564 7.96187C10.3126 8.20939 12.3347 8.52128 14.236 9.09719C18.9432 10.5229 20.6247 13.7556 19.3728 18.9801C19.3141 19.2226 19.2234 19.4669 19.1127 19.7325C17.495 17.2688 15.2798 15.1847 11.9571 12.9998C11.1399 12.4635 10.3126 12.5543 9.74201 13.2424V13.2441Z" fill="#40C79E"/>
										</svg>
										<span class="ml-3">{{trans('messages.home.contributing')}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="mt-4 display-off" id="property_type_div" >
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="icon-slider">
						<div>
							<a href="{{ url('/').'/search?property_type=1&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Apartment.svg')}}" alt="Apartment" />
								<span>{{trans('messages.home.apartment')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=2&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/House.svg')}}" alt="House" />
								<span>{{trans('messages.home.house')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=3&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Bungalow.svg')}}" alt="Bungalow" />
								<span>{{trans('messages.home.bungalow')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=4&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Cabin.svg')}}" alt="Cabin" />
								<span>{{trans('messages.home.cabin')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=5&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Hotel.svg')}}" alt="Hotel" />
								<span>{{trans('messages.home.hotel')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=6&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Motel.svg')}}" alt="Motel" />
								<span>{{trans('messages.home.motel')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=7&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Caravan.svg')}}" alt="Caravan" />
								<span>{{trans('messages.home.caravan')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=8&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Hut.svg')}}" alt="Camping" />
								<span>{{trans('messages.home.camping')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=9&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Boat.svg')}}" alt="Boat" />
								<span>{{trans('messages.home.boat')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=10&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Cottage.svg')}}" alt="Cottage" />
								<span>{{trans('messages.home.cottage')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=11&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/Chalet.svg')}}" alt="Chalet" />
								<span>{{trans('messages.home.chalet')}}</span>
							</a>
						</div>
						<div>
							<a href="{{ url('/').'/search?property_type=12&guest=0&children=0&infants=0&pets=0'}}">
								<img src="{{URL::to('images/BreadBreakfast.svg')}}" alt="Bread & Breakfast" />
								<span>{{trans('messages.home.bed')}}</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- @if(!$properties->isEmpty())
		<section class="listing">
			<div class="container-fluid">
				<div class="row">
					@foreach($properties as $property)
						@include('property.preview')
					@endforeach
				</div>
			</div>
		</section>
	@endif -->
	@if(!$similar->isEmpty())
	<section class="listing">
        <div class="container-fluid">
            @if(count($similar)!= 0)

            <div class="row">
                @foreach($similar->slice(0, 40) as $row_similar)
                    @include('property.preview', ['property' => $row_similar])
                @endforeach
            </div>
            @endif
        </div>
    </section> 
	@endif
</main>
@stop
@push('scripts')
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places&callback=callbackMap'></script>
	<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
    @auth
        <script src="{{ url('js/sweetalert.min.js') }}"></script>
    @endauth
	<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{ url('js/front.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/daterangecustom.js')}}"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript">
		$('[data-toggle="popover-click"]').popover({
			html: true,
			trigger: 'click',
			placement: 'bottom',
			sanitize: false,
			content: function () { return $('#popover_content_wrapper').html(); }
		});

		$(document).on('click', '#deny', function() {
			$('[data-toggle="popover-click"]').popover("hide");
		});
    
		$(function() {
			$("#property_type_div").removeClass('display-off');
			dateRangeBtn(moment(),moment(), null, '{{$date_format}}');
		});
		$(document).ready(function(){
			$('.icon-slider').slick({
				slidesToShow: 8,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2000,
				responsive: [
					{
					breakpoint: 1300,
						settings: {
							slidesToShow: 6
						}
					},
					{
					breakpoint: 991,
						settings: {
							slidesToShow: 4
						}
					},
					{
					breakpoint: 767,
						settings: {
							slidesToShow: 3
						}
					},
					{
					breakpoint: 600,
						settings: {
							slidesToShow: 2
						}
					}
				]
			});
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
                        className: "btn btn-outline-danger",
                        closeModal: true,
                    },
                    confirm: {
                        text: "{{trans('messages.general.yes')}}",
                        value: true,
                        visible: true,
                        className: "btn vbtn-outline-success",
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
                                    $(that).css('color', '#1dbf73');
									$(that).addClass("active");;
                                    $(that).attr("data-status", 1);
                                    swal('success', '{{trans('messages.success.favourite_add_success')}}');

                                } else {
									$(that).removeClass("active");;
                                    $(that).css('color', 'black');
                                    $(that).attr("data-status", 0);
                                    swal('success', '{{trans('messages.success.favourite_remove_success')}}');


                                }
                            }
                        });

                    }
                });
        });
        @endauth
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
	</script>
@endpush

