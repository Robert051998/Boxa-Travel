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
							<h4 class="m-0">{{ trans('messages.users_show.review_you') }}</h4>
						</div>
					</div>
				</div>
               <div class="row m-0">
                    <div class="col-md-12 p-0 mt-2">
                        <div class="row justify-content-center m-0">
                            <div class="col-md-12 p-0">
                                <ul class="nav navbar-expand-lg navbar-light list-bacground border rounded-3 p-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ $write ?? ' '}} text-color" data-toggle="tab" href="#tabs-1" role="tab">{{ trans('messages.reviews.write_review') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $you ?? ' '}} text-color" data-toggle="tab" href="#tabs-2" role="tab">{{ trans('messages.reviews.passed_review') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $expired ?? ' '}} text-color" data-toggle="tab" href="#tabs-3" role="tab">{{ trans('messages.reviews.expired_review') }}</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-5">
                                    <div class="tab-pane {{ $write ?? ' '}}" id="tabs-1" role="tabpanel">
                                        <div class="row m-0 inner-Bookings">
                                            <div class="col-md-12 p-0">
                                                @forelse($reviewsToWrite as $writeReview)                                      
                                                    <div class="d-flex justify-content-between align-items-center booking-details">
                                                        <div class="booking-info">
                                                            <div class="booking-info-img">
                                                                <a href="{{ url('/') }}/properties/{{ $writeReview->properties->slug }}">
                                                                    <img class="img-fluid" src="{{ $writeReview->properties->cover_photo }}" alt="img">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center booking-info-text">
                                                            <div class="mr-3">
                                                                <h4 class="">
                                                                    <a href="{{ url('/') }}/properties/{{ $writeReview->properties->slug }}">
                                                                        {{$writeReview->properties->name }}
                                                                    </a>
                                                                </h4>
                                                                <span class="d-flex align-items-center">
                                                                    <img src="{{URL::to('images/Calendar.svg')}}" alt="Calendar" class="mr-2">
                                                                    {{ date(' M d, Y', strtotime($writeReview->start_date)) }}  -  {{ date(' M d, Y', strtotime($writeReview->end_date)) }}
                                                                </span>
                                                                <span class="d-flex align-items-center">
                                                                    <i class="fas fa-exclamation-triangle  text-warning mr-2"></i> 
                                                                    <span>{{ trans('messages.reviews.you_have') }} <b> {{ str_replace('+','',$writeReview->review_days) }} {{ ($writeReview->review_days > 1) ? trans_choice('messages.reviews.day',2) : trans_choice('messages.reviews.day',1) }} </b> {{ trans('messages.reviews.to_submit_public_review') }}  <b> {{Auth::user()->id == $writeReview->user_id ? $writeReview->host->full_name : $writeReview->users->full_name }}</b>.</span>
                                                                </span>
                                                                <a class="btn btn-outline-danger m-0" href="{{ url('/') }}/reviews/edit/{{ $writeReview->id }}">{{ trans('messages.reviews.write_review') }}</a>
                                                            </div>
                                                            <div class="status text-center">
                                                                <a href="{{ url('/') }}/users/show/{{ $writeReview->user_id == Auth::id()  ? $writeReview->host_id : $writeReview->user_id }}">
                                                                    <div class="user-details">
                                                                        <div class="user-img">
                                                                            <img src="{{Auth::user()->id == $writeReview->user_id ? $writeReview->host->profile_src : $writeReview->users->profile_src }}">
                                                                        </div>
                                                                        <div class="user-name mt-2">
                                                                            {{Auth::user()->id == $writeReview->user_id ? $writeReview->host->full_name : $writeReview->users->full_name }} 
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="row jutify-content-center w-100 mb-4">
                                                        <div class="text-center w-100">
                                                            <img src="{{ url('img/unnamed.png')}}" class="img-fluid"  alt="notfound">
                                                            <p class="text-center fs-6">{{ trans('messages.reviews.nobody_to_review') }}</p>
                                                        </div>
                                                    </div>       
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="row justify-content-between overflow-auto pb-3 mt-4">
                                            {{ $reviewsToWrite->appends(['write' => $reviewsToWrite->currentPage()])->links('paginate') }} 
                                        </div>                 
                                    </div>

                                    <div class="tab-pane {{ $you ?? ' '}}" id="tabs-2" role="tabpanel">
                                        <div class="row m-0 inner-Bookings">
                                            <div class="col-md-12 p-0">
                                                @forelse($reviewsByYou as $pastReview)
                                                <div class="d-flex justify-content-between align-items-center booking-details">
                                                    <div class="booking-info">
                                                        <div class="booking-info-img">
                                                            <a href="{{ url('/') }}/properties/{{ $pastReview->properties->slug }}">
                                                                <img class="img-fluid" src="{{ $pastReview->properties->cover_photo }}" alt="img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center booking-info-text">
                                                        <div class="mr-3">
                                                            <h4 class="">
                                                                <a href="{{ url('/') }}/properties/{{ $pastReview->properties->slug }}">{{ $pastReview->properties->name }}</a> 
                                                            </h4>
                                                            <span class="d-flex align-items-center">
                                                                <img src="{{URL::to('images/Calendar.svg')}}" alt="Calendar" class="mr-2">
                                                                {{$pastReview->bookings->date_range}}
                                                            </span>
                                                            <span class="d-flex align-items-center">
                                                                {{ str_limit($pastReview->message,80) }}
                                                            </span>
                                                            <span class="d-flex">
                                                                <i class="far fa-clock mr-2"></i> 
                                                                {{ $pastReview->created_at->diffForHumans() }}
                                                            </span>
                                                            <button class="btn btn-outline-danger m-0 review_detials " data-name="{{ $pastReview->properties->name }}" data-toggle="modal"  data-id="{{ $pastReview->id }}" data-target="#myModal" >
                                                                {{ trans('messages.reviews.view_details') }}
                                                            </button>
                                                        </div>
                                                    </div> 
                                                    <div class="status text-center">  
                                                        <a href="{{ url('/') }}/users/show/{{ $pastReview->users_from->id }}"> 
                                                            <div class="user-details">
                                                                <div class="user-img">
                                                                    <img src="{{ $pastReview->users_from->profile_src }}" alt="{{ $pastReview->users_from->first_name }}" >
                                                                </div>
                                                                <div class="user-name mt-2">
                                                                    {{ $pastReview->users_from->full_name }}
                                                                </div>
                                                            </div>
                                                        </a> 
                                                    </div>
                                                </div>                     
                                                @empty
                                                   <div class="row jutify-content-center w-100 mb-4">
                                                        <div class="text-center w-100">
                                                            <img src="{{ url('img/unnamed.png')}}" class="img-fluid"  alt="notfound">
                                                            <p class="text-center fs-6">{{ trans('messages.reviews.nobody_to_review') }}</p>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>  
                                        <div class="row justify-content-between overflow-auto pb-3 mt-4">
                                            {{ $reviewsByYou->appends(['you' => $reviewsByYou->currentPage()])->links('paginate') }} 
                                        </div>
                                    </div>

                                    <div class="tab-pane {{ $expired ?? ' '}}" id="tabs-3" role="tabpanel">
                                        <div class="row m-0 inner-Bookings">
                                            <div class="col-md-12 p-0">
                                                @forelse($expiredReviews as $expired)    
                                                <div class="d-flex justify-content-between align-items-center booking-details">
                                                    <div class="booking-info">
                                                        <div class="booking-info-img">
                                                            <a href="{{ url('/') }}/properties/{{ $expired->properties->slug }}">
                                                                <img class="img-fluid" src="{{ $expired->properties->cover_photo }}" alt="img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center booking-info-text">
                                                        <div class="mr-3">
                                                            <h4 class="">
                                                                <a href="{{ url('/') }}/properties/{{ $expired->properties->slug }}">
                                                                    {{$expired->properties->name}}
                                                                </a>
                                                            </h4>
                                                            <span class="d-flex align-items-center">
                                                                <img src="{{URL::to('images/Calendar.svg')}}" alt="Calendar" class="mr-2">
                                                                {{$expired->date_range}}
                                                            </span>
                                                            <span class="d-flex align-items-center">
                                                                <i class="far fa-frown-open text-danger mr-2"></i>
                                                                {{ trans('messages.reviews.expired_reviews_desc') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="status text-center">
                                                        @if(Auth::user()->id == $expired->users->id)
                                                            <a href="{{ url('/') }}/users/show/{{ $expired->host->id }}">
                                                                <div class="user-details">
                                                                    <div class="user-img">
                                                                        <img src="{{ $expired->host->profile_src }}" alt="{{ $expired->host->first_name }}">
                                                                    </div>
                                                                    <div class="user-name mt-2">
                                                                        {{ $expired->host->first_name}}
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('/') }}/users/show/{{ $expired->users->id }}">
                                                                <div class="user-details">
                                                                    <div class="user-img">
                                                                        <img src="{{ $expired->users->profile_src }}" alt="{{ $expired->users->first_name }}">
                                                                    </div>
                                                                    <div class="user-name mt-2">
                                                                        {{ $expired->users->first_name}}
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>                  
                                                @empty
                                                    <div class="row jutify-content-center w-100 mb-4">
                                                        <div class="text-center w-100">
                                                            <img src="{{ url('img/unnamed.png')}}" class="img-fluid"  alt="notfound">
                                                            <p class="text-center fs-6">{{ trans('messages.reviews.nobody_to_review') }}</p>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div> 
                                        <div class="row justify-content-between overflow-auto pb-3 mt-4">
                                            {{ $expiredReviews->appends(['expired' => $expiredReviews->currentPage()])->links('paginate')}}                                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal calender_modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title " id="name" >Property </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-4">
                <div id="heading">
                </div>
            </div>
            
            <div class="modal-footer">
                <pre> </pre>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
  

    $(document).on('click', '#new', function(){
        console.log('hellow');
    })

    $(document).on('click', '.review_detials', function(){
        var id = $(this).data("id");
        var name = $(this).data("name");
        $('#name').html(name);
        var dataURL = APP_URL+'/reviews/details';
        $.ajax({
            url: dataURL,
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            type: 'post',
            dataType: 'text',
            success: function(data) {
                $('#heading').html(data);          
            }
        })
    });
</script>
@endpush