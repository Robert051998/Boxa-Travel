<div class="col-lg-6 col-xl-5 listing m-0">
    <div class="listing-info">
        <div class="col-12 p-0 m-0">
            <a href="{{ url('/') }}/properties/{{$result->slug}}">
                <img class="card-img-top p-2 rounded" src="{{$result->cover_photo}}" alt="{{$result->name}}" height="180px">
            </a>
            <div class="card-body p-0 pt-4 pb-4">
                <div class="listing_name">
                    <a href="{{ url('/') }}/properties/{{$result->slug}}">{{ $result->name }}</a>
                    <p class="mt-2">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{$result->property_address->address_line_1}}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}
                    </p>        
                </div>
                <div class="listing-info mt-4 text-center">
                    <p class="mb-2">
                        <strong class="">{{ $result->property_type_name }}</strong>
                        {{trans('messages.payment.for')}}
                        <strong class="">{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong>
                    </p>
                    <div class=""><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>
                </div>

                <div class="listing-info mt-4 payment-details {{ (isset($payment) &&  $payment == 'card') ? 'euro-actvie' : 'boxa-price'}}">

                    @foreach( $price_list->date_with_price as $date_price)
                    <div class="d-none justify-content-between align-items-center">
                        <div>{{ $date_price->date }}</div>
                        <div>
                            <div class="boxa-price d-flex">
                                <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                <span class="ml-2 light-grey">{!! $date_price->boxa_price !!}</span>
                            </div>
                            
                            <div class="euro-price">
                                <span class="ml-2 light-grey">{!! $date_price->price !!}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between align-items-center">
                        <div>{{trans('messages.payment.night')}}</div>
                        <div>{{ $nights }}</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div> {{ $nights }} {{trans('messages.payment.nights')}}</div>
                        <div>
                            <div class="boxa-price d-flex">
                                <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                <span class="ml-2 light-grey">{!! $price_list->total_night_price_boxa !!}</span>
                            </div>
                            
                            <div class="euro-price">    
                                <span class="ml-2 light-grey">{!! $price_list->total_night_price_with_symbol !!}</span>
                            </div>
                        </div>
                    </div>

                    @if($price_list->service_fee)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.payment.service_fee')}}</div>
                            <div>
                                <div class="boxa-price d-flex">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!! $price_list->service_fee_boxa !!}</span>
                                </div>
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!! $price_list->service_fee_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($price_list->additional_guest)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.payment.additional_guest_fee')}}</div>
                            <div>
                                <div class="boxa-price d-flex">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!! $price_list->additional_guest_boxa !!}</span>
                                </div>
                                
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!! $price_list->additional_guest_fee_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($price_list->security_fee)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.payment.security_deposit')}}</div>
                            <div>
                                <div class="boxa-price d-flex">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!! $price_list->security_fee_boxa !!}</span>
                                </div>
                                
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!! $price_list->security_fee_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($price_list->cleaning_fee)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.payment.cleaning_fee')}}</div>
                            <div>
                                <div class="boxa-price d-flex">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!! $price_list->cleaning_fee_boxa !!}</span>
                                </div>
                                
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!! $price_list->cleaning_fee_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($price_list->pets_price)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.home.pets')}}</div>
                            <div>
                                <div class="boxa-price d-flex">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!! $price_list->pets_price_boxa !!}</span>
                                </div>
                                
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!! $price_list->pets_price_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($price_list->iva_tax)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.property_single.iva_tax')}}</div>
                            <div>
                                <div class="boxa-price d-flex">
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!!  $price_list->iva_tax_boxa !!}</span>
                                </div>
                                
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!!  $price_list->iva_tax_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($price_list->accomodation_tax)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{{trans('messages.property_single.accommodatiton_tax')}}</div>
                            <div>
                                <div class="boxa-price d-flex">>
                                    <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                    <span class="ml-2 light-grey">{!! $price_list->accomodation_tax_boxa !!}</span>
                                </div>
                                
                                <div class="euro-price">
                                    <span class="ml-2 light-grey">{!! $price_list->accomodation_tax_with_symbol !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <div>{{trans('messages.payment.total')}}</div>
                        <div>
                            <div class="boxa-price d-flex">
                                <img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
                                <span class="ml-2 text-green">{!! $price_list->total_boxa !!}</span>
                            </div>
                            
                            <div class="euro-price">
                                <span class="ml-2 text-green">{!! $price_list->total_with_symbol !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>