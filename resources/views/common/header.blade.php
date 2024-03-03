<!--================ Header Menu Area start =================-->
<?php
    $lang = Session::get('language');
?>
    @vite(['resources/js/app.js', 'resources/css/app.css'])



<input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type') ?? 'dd-mm-yy'}}">
<header class="header_area  animated fadeIn">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid container-fluid-90">
                <a class="navbar-brand logo_h" aria-label="logo" href="{{ url('/') }}"><img src="{{URL::to('images/boxa-travel-logo.svg')}}" alt="logo" class="img-fluid"></a>
				<!-- Trigger Button -->
                <div class="d-flex d-xl-none d-lg-none d-md-flex d-sm-flex">
                    <div class="dropdown languages">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" type="button" id="languages" data-toggle="dropdown" aria-label="user-profile" aria-haspopup="true" aria-expanded="false">
                        {{Session::get('language') == 'sl' ? 'SL' : 'ENG' }}
                        </a>
                        <div class="dropdown-menu drop-down-menu-left p-0 drop-width " aria-labelledby="languages">
                            <a class="language_footer list-group-item border-0 {{Session::get('language_name') == 'en' ? 'active' : '' }}" href="#" aria-label="Language" data-lang="en">
                                <img src="{{URL::to('images/en.svg')}}" alt="English" width="24px" />
                                <span class="ml-2">ENG</span>
                            </a>
                            <a class="language_footer list-group-item border-0 {{Session::get('language_name') == 'sl' ? 'active' : '' }}" href="#" aria-label="Language" data-lang="sl">
                                <img src="{{URL::to('images/slovenia.svg')}}" alt="Slovenia" width="24px" />
                                <span class="ml-2">SL</span>
                            </a>
                        </div>
                    </div>
                        <a href="#" aria-label="navbar" class="navbar-toggler p-0" data-toggle="modal" data-target="#left_modal">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </div>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <div class="nav navbar-nav menu_nav align-items-center justify-content-end w-100">
                            @if(Request::segment(1) != 'help')
                                <div class="nav-item">
                                    <a class="nav-link btn vbtn-outline-success m-0 mr-3" href="{{ url('property/create') }}" aria-label="property-create">
                                        {{trans('messages.header.list_space')}}
                                    </a>
                                </div> 
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" type="button" id="languages" data-toggle="dropdown" aria-label="user-profile" aria-haspopup="true" aria-expanded="false">
                                        {{Session::get('language') == 'sl' ? 'SL' : 'ENG' }}
                                    </a>
                                    <div class="dropdown-menu drop-down-menu-left p-0 drop-width " aria-labelledby="languages">
                                        <a class="language_footer list-group-item border-0 {{Session::get('language') == 'en' ? 'active' : '' }}" href="#" aria-label="Language"  data-lang="en">
                                            <img src="{{URL::to('images/en.svg')}}" alt="English" width="24px" />
                                            <span class="ml-2">ENG</span>
                                        </a>
                                        <a class="language_footer list-group-item border-0 {{Session::get('language') == 'sl' ? 'active' : '' }}" href="#" aria-label="Language" data-lang="sl">
                                            <img src="{{URL::to('images/slovenia.svg')}}" alt="Slovenia" width="24px" />
                                            <span class="ml-2">SL</span>
                                        </a>
                                    </div>
                                </div>                          
                            @endif
                            
                        @if(!Auth::check())
                            <div class="nav-item">
                                <a class="nav-link" href="{{ url('signup') }}" aria-label="signup">{{trans('messages.sign_up.sign_up')}}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}" aria-label="login" onClick="disconnectWallet()">{{trans('messages.header.login')}}</a>
                            </div>
                        @else
                            <div class="d-flex">
                                <div>
                                    <div class="nav-item ml-0 pl-0">
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-label="user-profile" aria-haspopup="true" aria-expanded="false">
                                                {{Auth::user()->first_name}}
                                            </a>
                                            <div class="dropdown-menu drop-down-menu-left p-0 drop-width " aria-labelledby="dropdownMenuButton">
                                                <a class="list-group-item border-0" href="{{ url('dashboard') }}" aria-label="dashboard">
                                                    <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span>{{trans('messages.header.dashboard')}}</span>
                                                </a>
                                                <a class="list-group-item border-0 " href="{{ url('users/profile') }}" aria-label="profile">
                                                    <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="black" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span>{{trans('messages.utility.profile')}}</span>
                                                </a>
                                                <a class="list-group-item border-0" href="{{ url('logout') }}" aria-label="logout" onClick="disconnectWallet()">
                                                    <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.016 7.38948V6.45648C15.016 4.42148 13.366 2.77148 11.331 2.77148H6.45597C4.42197 2.77148 2.77197 4.42148 2.77197 6.45648V17.5865C2.77197 19.6215 4.42197 21.2715 6.45597 21.2715H11.341C13.37 21.2715 15.016 19.6265 15.016 17.5975V16.6545" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M21.8094 12.0214H9.76843" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M18.8812 9.10626L21.8092 12.0213L18.8812 14.9373" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <span>{{trans('messages.header.logout')}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="nav-item mr-0">
                                        <img src="{{Auth::user()->profile_src}}" class="head_avatar" alt="{{Auth::user()->first_name}}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Modal Window -->
<div class="modal left leftsidebar" id="left_modal" tabindex="-1" role="dialog" aria-labelledby="left_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 secondary-bg">
                @if(Auth::check())
                    <div class="row justify-content-center m-0">
                        <div>
                            <img src="{{Auth::user()->profile_src}}" class="head_avatar" alt="{{Auth::user()->first_name}}">
                        </div>

                        <div>
                            <p  class="text-white"> {{Auth::user()->first_name}}</p>
                        </div>
                    </div>
                @endif

                <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>

            <div class="modal-body">
                <ul class="mobile-side list-group list-group-flush">
                    @if(Auth::check())
                        <li class="list-group-item">
                            <a href="{{ url('dashboard') }}">
                                 <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.header.dashboard')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('properties') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.7161 16.2236H8.49609" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.7161 12.0371H8.49609" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11.2511 7.86035H8.49609" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9085 2.75C15.9085 2.75 8.23149 2.754 8.21949 2.754C5.45949 2.771 3.75049 4.587 3.75049 7.357V16.553C3.75049 19.337 5.47249 21.16 8.25649 21.16C8.25649 21.16 15.9325 21.157 15.9455 21.157C18.7055 21.14 20.4155 19.323 20.4155 16.553V7.357C20.4155 4.573 18.6925 2.75 15.9085 2.75Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.header.your_listing')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('my-bookings') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.739 6.15344C19.739 3.40256 17.8583 2.2998 15.1506 2.2998H8.79167C6.16711 2.2998 4.2002 3.32737 4.2002 5.96998V20.6938C4.2002 21.4196 4.98115 21.8767 5.61373 21.5219L11.9957 17.9419L18.3225 21.5158C18.9561 21.8727 19.739 21.4156 19.739 20.6888V6.15344Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.27148 9.02762H15.5898" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.booking_my.booking')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('trips/active') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.7729 9.30504V6.27304C15.7729 4.18904 14.0839 2.50004 12.0009 2.50004C9.91694 2.49104 8.21994 4.17204 8.21094 6.25604V6.27304V9.30504" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7422 21.0001H7.25778C4.90569 21.0001 3 19.0951 3 16.7451V11.2291C3 8.87912 4.90569 6.97412 7.25778 6.97412H16.7422C19.0943 6.97412 21 8.87912 21 11.2291V16.7451C21 19.0951 19.0943 21.0001 16.7422 21.0001Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Trips
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('user/favourite') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.87187 11.5983C1.79887 8.24832 3.05287 4.41932 6.56987 3.28632C8.41987 2.68932 10.4619 3.04132 11.9999 4.19832C13.4549 3.07332 15.5719 2.69332 17.4199 3.28632C20.9369 4.41932 22.1989 8.24832 21.1269 11.5983C19.4569 16.9083 11.9999 20.9983 11.9999 20.9983C11.9999 20.9983 4.59787 16.9703 2.87187 11.5983Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 6.7002C17.07 7.0462 17.826 8.0012 17.917 9.1222" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.users_dashboard.favourite')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('users/payout-list') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3"  width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.6389 14.3958H17.5906C16.1042 14.3949 14.8993 13.191 14.8984 11.7045C14.8984 10.2181 16.1042 9.01416 17.5906 9.01324H21.6389" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.0485 11.6429H17.7369" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.74766 3H16.3911C19.2892 3 21.6388 5.34951 21.6388 8.24766V15.4247C21.6388 18.3229 19.2892 20.6724 16.3911 20.6724H7.74766C4.84951 20.6724 2.5 18.3229 2.5 15.4247V8.24766C2.5 5.34951 4.84951 3 7.74766 3Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.03564 7.53814H12.4346" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.sidenav.payouts')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('users/transaction-history') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.24463 14.781L10.2378 10.8909L13.652 13.5728L16.581 9.79248" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="19.9954" cy="4.20003" r="1.9222" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.9243 3.12012H7.65655C4.64511 3.12012 2.77783 5.25284 2.77783 8.26428V16.3467C2.77783 19.3581 4.6085 21.4817 7.65655 21.4817H16.2607C19.2721 21.4817 21.1394 19.3581 21.1394 16.3467V9.30776" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.account_transaction.transaction')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('users/profile') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="black" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.utility.profile')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <a class="" data-toggle="collapse" href="#collapseReviews" role="button" aria-expanded="true" aria-controls="collapseReviews" id="reviewIcon">
                            <li class="list-group-item {{ (request()->is('users/reviews'))  || (request()->is('users/reviews_by_you')) || (request()->is('reviews/edit/*'))  ? 'active-sidebar' : '' }}">

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.sidenav.reviews')}}
                                    </div>
                                    <div>
                                        <span class="text-right">
                                            @if((request()->is('users/reviews')) || (request()->is('reviews/edit/*')) || (request()->is('reviews/details/*'))  || (request()->is('users/reviews_by_you')))
                                            <i class="fas fa-angle-down" id="reviewArrow"></i>
                                            @else
                                            <i class="fas fa-angle-right" id="reviewArrow"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            </li>
                        </a>

                        <div class="collapse {{ (request()->is('users/reviews')) || (request()->is('reviews/edit/*')) || (request()->is('reviews/details/*'))  || (request()->is('users/reviews_by_you'))  ? 'show' : '' }}" id="collapseReviews">
                            <ul class="pl-3">
                                <a class="" href="{{ url('users/reviews') }}">
                                    <li class="list-group-item d-flex align-items-center {{ (request()->is('users/reviews')) || (request()->is('reviews/details/*')) ? '' : '' }}">
                                        <i class="fas fa-angle-right mr-3"></i>
                                        {{trans('messages.reviews.reviews_about_you')}}
                                    </li>
                                </a>

                                <a class="" href="{{ url('users/reviews_by_you') }}">
                                    <li class="list-group-item d-flex align-items-center  {{ (request()->is('users/reviews_by_you')) || (request()->is('reviews/edit/*')) ? '' : '' }}">
                                        <i class="fas fa-angle-right mr-3"></i>
                                        {{trans('messages.reviews.reviews_by_you')}}
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <li class="list-group-item">
                            <a href="{{ url('logout') }}" onClick="disconnectWallet()">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.016 7.38948V6.45648C15.016 4.42148 13.366 2.77148 11.331 2.77148H6.45597C4.42197 2.77148 2.77197 4.42148 2.77197 6.45648V17.5865C2.77197 19.6215 4.42197 21.2715 6.45597 21.2715H11.341C13.37 21.2715 15.016 19.6265 15.016 17.5975V16.6545" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21.8094 12.0214H9.76843" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.8812 9.10626L21.8092 12.0213L18.8812 14.9373" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{trans('messages.header.logout')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                    @else
                        <li class="list-group-item">
                            <a href="{{ url('signup') }}">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_244_6313" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="2" y="14" width="16" height="8">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 14.4561H17.754V21.795H2V14.4561Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_244_6313)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.877 15.9561C5.646 15.9561 3.5 16.6831 3.5 18.1151C3.5 19.5611 5.646 20.2951 9.877 20.2951C14.108 20.2951 16.254 19.5681 16.254 18.1371C16.254 16.6891 14.108 15.9561 9.877 15.9561M9.877 21.7951C7.929 21.7951 2 21.7951 2 18.1151C2 14.8351 6.495 14.4561 9.877 14.4561C11.825 14.4561 17.754 14.4561 17.754 18.1371C17.754 21.4161 13.259 21.7951 9.877 21.7951" fill="black"/>
                                            </g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87709 3.5C7.77309 3.5 6.06009 5.213 6.06009 7.318C6.05609 8.337 6.44809 9.292 7.16309 10.013C7.87909 10.733 8.83309 11.132 9.84909 11.136L9.87709 11.886V11.136C11.9821 11.136 13.6951 9.423 13.6951 7.318C13.6951 5.213 11.9821 3.5 9.87709 3.5M9.87709 12.636H9.84609C8.42709 12.631 7.09709 12.074 6.10009 11.07C5.10209 10.065 4.55509 8.731 4.56009 7.315C4.56009 4.386 6.94509 2 9.87709 2C12.8101 2 15.1951 4.386 15.1951 7.318C15.1951 10.25 12.8101 12.636 9.87709 12.636" fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2041 13.4295C18.7901 13.4295 18.4541 13.0935 18.4541 12.6795V8.66846C18.4541 8.25446 18.7901 7.91846 19.2041 7.91846C19.6181 7.91846 19.9541 8.25446 19.9541 8.66846V12.6795C19.9541 13.0935 19.6181 13.4295 19.2041 13.4295" fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2502 11.4238H17.1602C16.7462 11.4238 16.4102 11.0878 16.4102 10.6738C16.4102 10.2598 16.7462 9.92383 17.1602 9.92383H21.2502C21.6642 9.92383 22.0002 10.2598 22.0002 10.6738C22.0002 11.0878 21.6642 11.4238 21.2502 11.4238" fill="black"/>
                                        </svg>
                                        {{trans('messages.sign_up.sign_up')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ url('login') }}" onClick="disconnectWallet()">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <svg class="mr-3"width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_243_6062" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="4" y="14" width="16" height="8">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4 14.4961H19.8399V21.8701H4V14.4961Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_243_6062)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.921 15.9961C7.66 15.9961 5.5 16.7281 5.5 18.1731C5.5 19.6311 7.66 20.3701 11.921 20.3701C16.181 20.3701 18.34 19.6381 18.34 18.1931C18.34 16.7351 16.181 15.9961 11.921 15.9961M11.921 21.8701C9.962 21.8701 4 21.8701 4 18.1731C4 14.8771 8.521 14.4961 11.921 14.4961C13.88 14.4961 19.84 14.4961 19.84 18.1931C19.84 21.4891 15.32 21.8701 11.921 21.8701" fill="black"/>
                                            </g>
                                            <mask id="mask1_243_6062" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="2" width="12" height="11">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.60986 2H17.2299V12.6186H6.60986V2Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask1_243_6062)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9209 3.42751C9.77989 3.42751 8.03789 5.16851 8.03789 7.30951C8.03089 9.44351 9.75989 11.1835 11.8919 11.1915L11.9209 11.9055V11.1915C14.0609 11.1915 15.8019 9.44951 15.8019 7.30951C15.8019 5.16851 14.0609 3.42751 11.9209 3.42751M11.9209 12.6185H11.8889C8.9669 12.6095 6.59989 10.2265 6.60989 7.30651C6.60989 4.38151 8.99189 1.99951 11.9209 1.99951C14.8489 1.99951 17.2299 4.38151 17.2299 7.30951C17.2299 10.2375 14.8489 12.6185 11.9209 12.6185" fill="black"/>
                                            </g>
                                        </svg>
                                        {{trans('messages.header.login')}}
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif

                    @if(Request::segment(1) != 'help')
                        <a href="{{ url('property/create') }}">
                            <button class="btn vbtn-outline-success w-100 p-3 d-block mt-4">
                                    {{trans('messages.header.list_space')}}
                            </button>
                        </a>                        
                        
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!--================Header Menu Area =================-->
