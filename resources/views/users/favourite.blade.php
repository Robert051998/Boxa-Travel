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
                            <h4 class="m-0">Favourite</h4>
                        </div>
                    </div>
                </div>
                @if(Session::has('message'))
                    <div class="alert alert-success text-center" role="alert" id="alert">
                        <span id="messages">{{ Session::get('message') }}</span>
                    </div>
                @endif
                <div class="row m-0 inner-Bookings">
                    <div class="col-12 p-0">
                        @forelse($bookings as $booking)
                            @if (!is_null($booking->properties))
                            <div class="d-flex justify-content-between align-items-center booking-details">
                                <div class="booking-info">
                                    <div class="booking-info-img">
										<a href="{{ url('/') }}/properties/{{ $booking->properties->slug }}">
											<img src="{{ $booking->properties->cover_photo }}" alt="{{ $booking->properties->name }}">
										</a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center booking-info-text">
                                    <div class="mr-3">
                                        <h4 class="">
                                            <a href="{{ url('/properties/'.$booking->properties->slug) }}">
                                                {{ $booking->properties->name}}
                                            </a>
                                        </h4>
                                        <span class="d-flex"><img src="{{URL::to('images/Location.svg')}}" alt="Location" class="mr-2" />  {{ $booking->properties->property_address->address_line_1 }}</span>
                                    </div>
                                    <div class="status text-center">
                                        <span data-status="{{$booking->properties->book_mark}}"  data-id="{{$booking->properties->id}}" class="btn btn-heart book_mark_change cursor-pointer active" style="font-size: 22px; color: #1dbf73;">                                            
                                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.87187 9.59832C0.798865 6.24832 2.05287 2.41932 5.56987 1.28632C7.41987 0.689322 9.46187 1.04132 10.9999 2.19832C12.4549 1.07332 14.5719 0.693322 16.4199 1.28632C19.9369 2.41932 21.1989 6.24832 20.1269 9.59832C18.4569 14.9083 10.9999 18.9983 10.9999 18.9983C10.9999 18.9983 3.59787 14.9703 1.87187 9.59832Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M15 4.70001C16.07 5.04601 16.826 6.00101 16.917 7.12201" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <div class="text-center w-100 pt-4 pb-4">
                                <img src="{{ url('img/unnamed.png')}}" alt="notfound" class="img-fluid">
                                <p class="text-center fs-6">You don't have any Favourite listing yet—but when you do, you’ll find them here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="row justify-content-between overflow-auto pb-3 mt-4 mb-5">
                    {{ $bookings->appends(request()->except('page'))->links('paginate')}}
                </div>
            </div>
        </div>
    </div>
</main>
@stop
@push('scripts')
<script src="{{ url('js/sweetalert.min.js') }}"></script>
<script type="text/javascript">
    $(document).on('change', '#trip_select', function(){

        $("#my-trip-form").trigger("submit");

    });

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
</script>

@endpush
