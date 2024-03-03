<ul class="list-group customlisting">
	<li>
		<a class="btn {{ Request::segment(3) == 'basics'?'vbtn-outline-success active-side':'btn-outline-secondary'}} {{ $missed['basics'] == 1 ? '' : 'step-inactive'  }} " href="{{$result->status != ""? url("listing/$result->id/basics"):"#"}}">	
			<div class="d-flex justify-content-between">
				<span>{{trans('messages.listing_sidebar.basic')}}</span>
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>

	<li>
		<a class="btn {{ Request::segment(3) == 'description'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $missed['description'] == 1 ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/description"):"#"}}">
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.description')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>

	<li>
		<a class="btn {{ Request::segment(3) == 'location'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $missed['location'] == 1 ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/location"):"#"}}"> 
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.location')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>
	
	<li>
		<a class="btn {{ Request::segment(3) == 'amenities'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $result->amenities == null ? 'step-inactive' : ''  }}" href="{{$result->status != ""? url("listing/$result->id/amenities"):"#"}}"> 
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.amenities')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>

	<li>
		<a class="btn {{ Request::segment(3) == 'photos'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $missed['photos'] == 1 ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/photos"):"#"}}">
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.photos')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>

	<li>
		<a class="btn {{ Request::segment(3) == 'pricing'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $missed['pricing'] == 1 ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/pricing"):"#"}}"> 
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.price')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>

	<li>
		<a class="btn {{ Request::segment(3) == 'booking'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $missed['booking'] == 1 ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/booking"):"#"}}"> 
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.booking')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>

	<li>
		<a class="btn step-inactive {{ Request::segment(3) == 'calendar'?'vbtn-outline-success active-side':' btn-outline-secondary'}}" href="{{$result->status != ""? url("listing/$result->id/calendar"):"#"}}">
			<div class="d-flex justify-content-between">
				{{trans('messages.listing_sidebar.calender')}}
				<span class="text-right"><i class="fas fa-angle-right"></i></span>
			</div>
		</a>
	</li>
</ul>