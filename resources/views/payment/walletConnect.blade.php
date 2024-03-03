@extends('template')
@section('main')
<main class="listing_detail">
	<div class="container-fluid p-0">
        @if(Session::has('message'))
            <div class="row mt-5">
                <div class="col-md-12 text-13 alert mb-0 {{ Session::get('alert-class') }} alert-dismissable fade in  text-center opacity-1">
                    <a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif
        <div class="row mb-5">
            <div class="col-lg-6 col-xl-7 mb-5 pb-5">
                <h3 class="mb-5">Pay with BOXA</h3>
                <form action="{{URL::to('payments/wallet-request')}}" method="post" id="payment-form">
                    <input type="hidden" name="transactionHash" id="transactionHash" value="" />
                    {{ csrf_field() }}
                    <div class="form-row form-group p-0 m-0">
                        <h4 for="card-element">Wallet Connect</h4>                
                    </div>
                    <div class="col-sm-12 text-center mt-4 p-0 wallet-connect-button">
                        <w3m-core-button icon="hide" label=" Connect Your Web 3 Wallet" balance="hide"></w3m-core-button>                                              
                        <button type="button" id="payWithBoxaButton" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 btn-block display-off" onClick="transactionCall('{{$price_list->total_boxa_without_format}}')">
                            <i class="spinner fa fa-spinner fa-spin d-none"></i> Pay with Boxa
                        </button>                        
                    </div>
                </form>
                @if(!is_null( Session::get('user_boxa_account') ) )
                <div class="row  mt-4" id="boxaViewDiv">
                    <div class="col-lg-12 col-xl-6">
                        <div class="d-flex listing-info wallet-details">
                            <div class="wallet-icon mr-3">
                                <img src="{{URL::to('images/wallet_icon.svg')}}" alt="Wallet Address" class="img-fluid" />
                            </div>
                            <div class="wallet-content">
                                <h4 class="mb-2">Wallet Address:</h4>
                                <p>{{Session::get('user_boxa_account')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-6 ">
                        <div class="d-flex listing-info wallet-details">
                            <div class="wallet-icon mr-3">
                                <img src="{{URL::to('images/boxa-wallet.svg')}}" alt="Wallet Address" class="img-fluid" />
                            </div>
                            <div class="wallet-content">
                                <h4 class="mb-2">Boxa Balance:</h4>
                                <h3 class="m-0">{{Session::get('user_boxa_balance')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right mt-3">
                        <button type="button" id="disconnectBoxaButton" class="btn btn-outline-danger text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" onClick="disconnectWallet()">
                            <i class="spinner fa fa-spinner fa-spin d-none"></i> Disconnect
                        </button>  
                    </div>
                </div>
                @endif
            </div>
            @include('payment.rightSection')
        </div>
    </div>
    
</main>
<script>
    function sendUserBoxaAccount(account, balance) {
        $.ajax({
            type: "POST",
            url: APP_URL + "/set_session",
            data: {
                "_token": "{{ csrf_token() }}",
                'task': 'setUserBoxaAccount',
                'user_boxa_account': account,
                'user_boxa_balance': balance
            },
            success: function(msg) {
                console.log("🚀 ~ file: walletConnect.blade.php:54 ~ sendUserBoxaAccount ~ msg", msg)
                window.location.href = APP_URL + "/payments/wallet-connect";

            },
        });
    }
</script>
@stop
