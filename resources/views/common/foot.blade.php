		<!-- New Js start-->
		<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
		<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('js/main.js')}}"></script>

		  {!! @$head_code !!}

		<!-- New Js End -->
		<!-- Needed Js from Old Version Start-->
		<script type="text/javascript">
			var APP_URL = "{{ url('/') }}";
			var USER_ID = "{{ isset(Auth::user()->id)  ? Auth::user()->id : ''  }}";
			var sessionDate      = '{!! Session::get('date_format_type') !!}';

		$(".currency_footer").on('click', function() {
			var currency = $(this).data('curr');
				$.ajax({
					type: "POST",
					url: APP_URL + "/set_session",
					data: {
						"_token": "{{ csrf_token() }}",
						'currency': currency
						},
					success: function(msg) {
						location.reload()
					},
			});
		});

		$(".language_footer").on('click', function() {
			var language = $(this).data('lang'); // class="language_footer" data-lang="en" | data-lang="sl"
			$.ajax({
				type: "POST",
				url: APP_URL + "/set_session",
				data: {
						"_token": "{{ csrf_token() }}",
						'language': language
					},
				success: function(msg) {
					location.reload()
				},
			});
		});
		function sendBoxaValue(price_BOXA_ETH) {
			$.ajax({
				type: "POST",
				url: APP_URL + "/set_session",
				data: {
				"_token": "{{ csrf_token() }}",
				'boxa_price': price_BOXA_ETH
				},
				success: function(msg) {
					console.log("🚀 ~ file: walletConnect.js:40 ~ getBoxaPrice ~ msg", msg)
					// location.reload()
				},
			});
		}		
		 function callbackMap() {}
		 jQuery(document).ready(function( $ ){
			$(window).scroll(function(){
			if ($(window).scrollTop() >= 150) {
				$('footer').addClass('fixed');
			}
			else {
				$('footer').removeClass('fixed');
			}
			});
		});
		$(document).on('click', function(e) {
			var keepalive = $('.popover');
			if(!keepalive.is(e.target) && keepalive.has(e.target).length===0){
				// check if opener is clicked
				if($(e.target).attr('id')!='guest_text'){
					$('[data-toggle="popover-click"]').popover("hide");
				}
				var keepalive_ = $('#footerMenu');
				if(!keepalive_.is(e.target) && keepalive_.has(e.target).length===0){
					var footerMenu = $('a[data-target="#footerMenu"]')
					if(!footerMenu.is(e.target) && footerMenu.has(e.target).length===0){
						$('#footerMenu').hide();
						$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
					}
				}
				
			}else{
				//console.log('inside');
			}
			/*if(!$(e.target).hasClass('.popover')){
			
				console.log($(e.target).closest('.popover').lenght);
				if($(e.target).closest('.popover').length==0){
					console.log('outside');
				}else{
					console.log('inside 1')
				}
			}else{
				console.log('inside 2');
			} */
			/*$('[data-toggle="popover"],[data-original-title]').each(function() {
				if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
					//$(this).popover('hide').data('bs.popover').inState.click = false 
					console.log($(this).attr('aria-describedby='))
					//$('[data-toggle="popover-click"]').popover("hide");
				}
			}); */
		});
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		})
		$(document).ready(function(){
    		function setCookie(name,value,days) {
			var expires = "";
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days*24*60*60*1000));
				expires = "; expires=" + date.toUTCString();
			}
			document.cookie = name + "=" + (value || "")  + expires + "; path=/";
			}

		$(document).on('click','.cookiedstatus',function(e){
				console.log('d');
				e.preventDefault();
				setCookie('accepted',$(this).data('accepted'),30);
				$('.cookiechallange').hide();
			})
		})
		</script>
		<!-- Start of LiveChat (www.livechat.com) code -->
		<script>
			window.__lc = window.__lc || {};
			window.__lc.license = 15483393;
			;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
		</script>
		<noscript><a href="https://www.livechat.com/chat-with/15483393/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
		<!-- End of LiveChat code -->

		<!-- Needed Js from Old Version End -->
		@stack('scripts')
	</body>
</html>