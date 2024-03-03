<div class="col-xl-2 col-lg-3 border-right d-none d-lg-block overflow-hidden mt-m-30 sidebar">
	<div class="main-panel h-100">
		<div class="">
			<ul class="list-group list-group-flush pl-0 mt-3 mb-3">
				<a class="" href="{{ url('dashboard') }}">
					<li class="list-group-item {{ (request()->is('dashboard')) ? 'active-sidebar' : '' }}">
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
					</li>
					
				</a>

				<a class="" href="{{ url('properties') }}">
					<li class="list-group-item {{ (request()->is('properties')) ? 'active-sidebar' : '' }}">
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
					</li>
				</a>

				<a class="" href="{{ url('my-bookings') }}">
					<li class="list-group-item {{ (request()->is('my-bookings')) ? 'active-sidebar' : '' }}">
						<div class="d-flex justify-content-between">
							<div>
								<svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M19.739 6.15344C19.739 3.40256 17.8583 2.2998 15.1506 2.2998H8.79167C6.16711 2.2998 4.2002 3.32737 4.2002 5.96998V20.6938C4.2002 21.4196 4.98115 21.8767 5.61373 21.5219L11.9957 17.9419L18.3225 21.5158C18.9561 21.8727 19.739 21.4156 19.739 20.6888V6.15344Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M8.27148 9.02762H15.5898" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								{{trans('messages.booking_my.booking')}}
							</div>
						</div>
					</li>
				</a>

				<a class="" href="{{ url('trips/active') }}">
					<li class="list-group-item {{ (request()->is('trips/active')) ? 'active-sidebar' : '' }}">
						<div class="d-flex justify-content-between">
							<div>
								<svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M15.7729 9.30504V6.27304C15.7729 4.18904 14.0839 2.50004 12.0009 2.50004C9.91694 2.49104 8.21994 4.17204 8.21094 6.25604V6.27304V9.30504" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M16.7422 21.0001H7.25778C4.90569 21.0001 3 19.0951 3 16.7451V11.2291C3 8.87912 4.90569 6.97412 7.25778 6.97412H16.7422C19.0943 6.97412 21 8.87912 21 11.2291V16.7451C21 19.0951 19.0943 21.0001 16.7422 21.0001Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								{{trans('messages.users_dashboard.my_trips')}}
							</div>
						</div>
					</li>
				</a>

                <a class="" href="{{ url('user/favourite') }}">
                    <li class="list-group-item {{ (request()->is('user/favourite')) ? 'active-sidebar' : '' }}">
                        <div class="d-flex justify-content-between">
							<div>
								<svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M2.87187 11.5983C1.79887 8.24832 3.05287 4.41932 6.56987 3.28632C8.41987 2.68932 10.4619 3.04132 11.9999 4.19832C13.4549 3.07332 15.5719 2.69332 17.4199 3.28632C20.9369 4.41932 22.1989 8.24832 21.1269 11.5983C19.4569 16.9083 11.9999 20.9983 11.9999 20.9983C11.9999 20.9983 4.59787 16.9703 2.87187 11.5983Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M16 6.7002C17.07 7.0462 17.826 8.0012 17.917 9.1222" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								{{trans('messages.users_dashboard.favourite')}}
							</div>
						</div>
                    </li>
                </a>
				
				<a class="" href="{{ url('users/payout-list') }}">
					<li class="list-group-item {{ (request()->is('users/payout-list' ) || request()->is('users/payout')) ? 'active-sidebar' : '' }}">
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
					</li>
				</a>

				<a class="" href="{{ url('users/transaction-history') }}">
					<li class="list-group-item {{ (request()->is('users/transaction-history')) ? 'active-sidebar' : '' }}">
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
					</li>
				</a>

				<a class="" href="{{ url('users/profile') }}">
					<li class="list-group-item {{ (request()->is('users/profile') || request()->is('users/profile/media') || request()->is('users/edit-verification') || request()->is('users/security')) ? 'active-sidebar' : '' }}">
						<div class="d-flex justify-content-between">
							<div>
								<svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="black" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								{{trans('messages.utility.profile')}}
							</div>
						</div>
					</li>
				</a>

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

				<a class="" href="{{ url('logout') }}">
					<li class="list-group-item">	
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
					</li>
				</a>
			</ul>
		</div>
	</div>
</div>
