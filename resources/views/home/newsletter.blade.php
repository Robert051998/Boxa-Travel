<section class="newsletter">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">
                <img src="{{URL::to('images/Business.svg')}}" alt="Business" />
            </div>
            <div class="col-12 col-md-8">
                <div class="newsletter-form">
                    <h3 class="mb-4">
                        {{trans('messages.home.your_next')}} <span style="color:#2EC8A1;">{{trans('messages.home.business_idea')}}</span> {{trans('messages.home.email_away')}}</h3>
                    <form name="newsletter_form" id="newsletter_form">
                        <input class="form-control newsletter" placeholder="{{trans('messages.home.business_idea_email')}}" value="" type="email" name="newsletter_email" id="newsletter_email">
                        <div id="newsletter_success" class="display-off">Done</div>
                        <div class="button">
                            <input class="submit" type="submit" id="newsletter_btn" name="newsletter_btn" value="{{trans('messages.home.subscribe')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script>
    $('#newsletter_form').validate({  
		rules: {
			newsletter_email: {
				required: true,
				
			},			
		},    
		submitHandler: function(form)
		{
			$("#newsletter_btn").on("click", function (e)
			{	
				$("#newsletter_btn").attr("disabled", true);
				e.preventDefault();
			});            
            
            var dataURL = APP_URL+'/subscribe_newsletter';
            $.ajax({
                url: dataURL,
                data:{
                    "_token": "{{ csrf_token() }}",
                    'id': $("#newsletter_email").val(),                    
                },
                type: 'post',
                dataType: 'json',
                success: function(data) {                    
                    $("#newsletter_success").removeClass('display-off');;
                    return false;
                }
            });

			return false;

		},
		messages: {			
		}   
	});
</script>
@endpush