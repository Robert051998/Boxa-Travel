@extends('template')

@section('main')
<main class="listing_detail">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-12">
        <h3 class="mb-5">{{trans('messages.trips_receipt.receipt')}} # {{ $booking->id }}</h3>
      </div>
    </div>
    <div class="row mb-5 receipt-conf">
      <div class="col-12">
        <div class="card">
          <div class="card-header pt-3 pb-3">
            <strong class="">{{trans('messages.trips_receipt.customer_receipt')}}</strong>
            <span class="float-right"> <strong class="">{{trans('messages.trips_receipt.confirmation_code')}} :</strong> {{ $booking->code }}</span>
          </div>

          <div class="card-body ">
            <div class="row m-0">
              <div class="col-6 l-pad-none p-0">
              <img src="{{@$logo}}">
            </div>
            <!-- <div class="col-6 print-div text-right p-0" id="print-div">
              <a href="#" onclick="print_receipt()" class="btn vbtn-outline-success m-0 button">PDF</a>
            </div> -->
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 mt-3 mb-3">
              <div class="p-0">
                <span> <strong class="font-weight-700">{{trans('messages.trips_receipt.name')}} :</strong> {{ $booking->users->full_name }}</span>
              </div>
            </div>
            <div class="col-md-6 text-right pr-0">
              <h4></h4>
            </div>
          </div>

          <div class="row border m-0 p-3 listing-info host-details receipt">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-3"><!-- card pt-4 mb-5 mt-2 rounded-3 -->
              <h4>{{trans('messages.trips_receipt.accommodatoin_address')}}</h4>
              <h5>{{ @$booking->properties->name }}</h5>
              <p class="text-lead">
                {{ @$booking->properties->property_address->address_line_1 }}<br>
                {{ @$booking->properties->property_address->city }}, {{ @$booking->properties->property_address->state }} {{ @$booking->properties->property_address->postal_code }}<br>
                {{ @$booking->properties->property_address->country_name }}
              </p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-3">
              <h4>{{trans('messages.trips_receipt.travel_destination')}}</h4>
              <p>{{ @$booking->properties->property_address->city }}</p>
              <h4>{{trans('messages.trips_receipt.accommodation_host')}}</h4>
              <p>{{ @$booking->properties->users->full_name }}</p>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-3">
              <h4>{{trans('messages.trips_receipt.duration')}}</h4>
              <p>{{ $booking->total_night }} {{trans('messages.trips_receipt.night')}}</p>
              <h4>{{trans('messages.trips_receipt.check_in')}}</h4>
              <p>{{ $booking->startdate_dmy }}<br>{{trans('messages.trips_receipt.flexible_check_time')}}</p>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-3">
              <h4>{{trans('messages.trips_receipt.accommodation_type')}}</h4>
              <p>{{ @$booking->properties->property_type_name }}</p>
              <h4>{{trans('messages.trips_receipt.check_out')}}</h4>
              <p>{{ $booking->enddate_dmy }}<br>{{trans('messages.trips_receipt.flexible_check_out')}}</p>
            </div>
          </div>
          <div class="row receipt-table">
            <div class="col-12">
              <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover p-0 m-0">
                  <thead>
                    <tr>
                      <th colspan="6">{{trans('messages.trips_receipt.booking_charge')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($date_price)
                      @foreach($date_price as $datePrice )
                        <tr>
                          <td>{{ onlyFormat($datePrice->date) }}</td>
                          <td class="text-right">
                            <div> 
                              
                              <span class="ml-2"></span>
                            </div>
                            
                            <div>
                                
                                <span class="ml-2">{!! $booking->currency->symbol.$datePrice->price !!}</span>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    <tr>
                      <td>{{ $booking->total_night }} {{trans('messages.trips_receipt.night')}}</td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                            
                            <span class="ml-2">{!! $booking->currency->symbol.$booking->per_night * $booking->total_night !!} </span>
                        </div>
                      </td>
                    </tr>
                    @if($booking->guest_charge)
                    <tr>
                      <td class="">{{trans('messages.trips_receipt.additional_guest_fee')}} </td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                            
                            <span class="ml-2">{!! $booking->currency->symbol.$booking->guest_charge !!}</span>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if($booking->cleaning_charge)
                    <tr>
                      <td class=""> {{trans('messages.trips_receipt.cleaning_fee')}} </td>
                      <td class="text-right">
                        <div>                           
                          <span class="ml-2"></span>
                        </div>                        
                        <div>                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->cleaning_charge !!}</span>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if($booking->pets_charge)
                    <tr>
                      <td class=""> {{trans('messages.home.pets')}} </td>
                      <td class="text-right">
                        <div>                           
                          <span class="ml-2"></span>
                        </div>                        
                        <div>                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->pets_charge !!}</span>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if($booking->security_money)
                    <tr>
                      <td class=""> {{trans('messages.trips_receipt.security_fee')}} </td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->security_money !!}</span>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if($booking->iva_tax)
                    <tr>
                      <td class=""> I.V.A Tax  </td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->iva_tax !!}</span>
                        </div>
                      </td>
                    </tr>
                    @endif
                    @if($booking->accomodation_tax)
                    <tr>
                      <td class="">Accomadation Tax </td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->accomodation_tax !!}</span>
                        </div>
                      </td>
                    </tr>
                    @endif
                    <tr>
                      <td>{{trans('messages.trips_receipt.service_fee')}}</td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->service_charge !!}</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>{{trans('messages.trips_receipt.total')}}</td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                          
                          <span class="ml-2">{!! $booking->currency->symbol.$booking->total !!}</span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                
                <table class="table table-clear">
                  <tbody>
                    <tr>
                      <td class="left">{{trans('messages.trips_receipt.payment_received')}}:{{ $booking->receipt_date }}</td>
                      <td class="text-right">
                        <div> 
                          
                          <span class="ml-2"></span>
                        </div>
                        
                        <div>
                          
                          <span class="ml-2">{!! $booking->transaction_id ?  $booking->currency->symbol.$booking->total: 0 !!}</span>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script ttype="text/javascript">
  function print_receipt()
  {
    document.getElementById("print-div").classList.add("d-none");
    document.getElementById("footer").classList.add("d-none");
    window.print();

     $("#print-div").removeClass("d-none");
  }

</script>
@stop
