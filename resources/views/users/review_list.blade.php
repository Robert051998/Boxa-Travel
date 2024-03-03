<div class="inner-Bookings">
<div class="d-flex justify-content-between align-items-center booking-details">
	<div class="d-flex justify-content-between align-items-center booking-info-text">
		<div class="mr-3">
			<h4 class="">
				<a href="{{ url('properties/'.$row_host->properties->slug) }}">
					{{ $row_host->properties->name }}
				</a>
			</h4>
			<span class="d-flex align-items-center">
				<ul class="d-flex align-items-center m-0 p-0">
					@for ($i = 0; $i < 5; $i++)
						@if($row_host->rating >$i)
							<li class="mr-1"><i class="fa fa-star rating_active" aria-hidden="true"></i></li>
						@else
							<li class="mr-1"><i class="fa fa-star rating" aria-hidden="true"></i></li>
						@endif
					@endfor  
				</ul>
			</span>
			<span class="d-flex align-items-center">
				<img src="{{ url('images/Calendar.svg')}}" alt="Calendar" class="mr-2">
				{{ ($row_host->created_at->diffForHumans()) }}
			</span>
			<span class="d-flex align-items-center">
				{{ $row_host->message }}
			</span>
		</div>
		<div class="status text-center">
			<a href="{{ url('users/show/'.$row_host->sender_id) }}">
				<div class="user-details">
					<div class="user-img">
						<img src="{{ $row_host->users->profile_src }}">
					</div>
					<div class="user-name mt-2">
						{{ $row_host->users->first_name }}
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
</div>