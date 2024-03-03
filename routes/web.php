<?php

use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AmenitiesController;
use App\Http\Controllers\Admin\AmenitiesTypeController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\BedTypeController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountsController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MetasController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PayoutsController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SpaceTypeController;
use App\Http\Controllers\Admin\StartingCitiesController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TripsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoxaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('health', function () {
    return response('App is working', 200);
} );

Route::match(array('GET', 'POST'),'create-users-wallet', [HomeController::class, 'walletUser']);
Route::post('set_session', [HomeController::class, 'setSession']);

//cron job
Route::get('cron/ical-synchronization', [CronController::class, 'iCalendarSynchronization']);

//user can view it anytime with or without logged in
Route::group(['middleware' => ['locale']], function () {
	Route::get('/', [HomeController::class, 'index']);	
  Route::post('search/result', [SearchController::class, 'searchResult']);
	Route::get('search', [SearchController::class, 'index']);
	Route::match(array('GET', 'POST'),'properties/{slug}', [PropertyController::class, 'single'])->name('property.single');
	Route::match(array('GET', 'POST'),'property/get-price', [PropertyController::class, 'getPrice']);
	Route::get('set-slug/', [PropertyController::class, 'set_slug']);
	Route::get('signup', [LoginController::class, 'signup']);
	Route::post('/checkUser/check', [LoginController::class, 'check'])->name('checkUser.check');
});


//only can view if user is not logged in if they are logged in then they will be redirect to dashboard
Route::group(['middleware' => ['no_auth:users', 'locale']], function () {
    Route::get('login', [LoginController::class, 'index']);
    Route::get('auth/login', function()
    {
		return Redirect::to('login');
    });

    Route::get('googleLogin', [LoginController::class, 'googleLogin'])->middleware('social_login:google_login');
    Route::get('facebookLogin', [LoginController::class, 'facebookLogin'])->middleware('social_login:facebook_login');
    Route::get('register', [HomeController::class, 'register']);
	Route::get('thankyou', [HomeController::class, 'thankyou']);
    Route::match(array('GET', 'POST'), 'forgot_password', [LoginController::class, 'forgotPassword']);
    Route::post('create', [UserController::class, 'create']);
    Route::post('authenticate', [LoginController::class, 'authenticate']);
    Route::get('users/reset_password/{secret?}', [LoginController::class, 'resetPassword']);
    Route::post('users/reset_password', [LoginController::class, 'resetPassword']);
	Route::get('users/confirm_email/{code?}', [UserController::class, 'confirmEmail']);
	
});

Route::get('googleAuthenticate', [LoginController::class, 'googleAuthenticate']);
Route::get('facebookAuthenticate', [LoginController::class, 'facebookAuthenticate']);

//only can view if user is logged in
Route::group(['middleware' => ['guest:users', 'locale']], function () {
  Route::get('dashboard', [UserController::class, 'dashboard']);
  Route::match(array('GET', 'POST'),'users/profile', [UserController::class, 'profile']);
  Route::match(array('GET', 'POST'),'users/profile/media', [UserController::class, 'media']);

  // User verification
  Route::get('users/edit-verification', [UserController::class, 'verification']);
  
//  Route::get('users/confirm_email/{code?}', [UserController::class, 'confirmEmail']);
  Route::get('users/new_email_confirm', [UserController::class, 'newConfirmEmail']);

  Route::get('facebookLoginVerification', [UserController::class, 'facebookLoginVerification']);
  Route::get('facebookConnect/{id}', [UserController::class, 'facebookConnect']);
  Route::get('facebookDisconnect', [UserController::class, 'facebookDisconnectVerification']);

  Route::get('googleLoginVerification', [UserController::class, 'googleLoginVerification']);
  Route::get('googleConnect/{id}', [UserController::class, 'googleConnect']);
  Route::get('googleDisconnect', [UserController::class, 'googleDisconnect']);
  

  Route::get('users/show/{id}', [UserController::class, 'show']);
  Route::match(array('GET', 'POST'),'users/reviews', [UserController::class, 'reviews']);
  Route::match(array('GET', 'POST'),'users/reviews_by_you', [UserController::class, 'reviewsByYou']);
  Route::match(['get', 'post'], 'reviews/edit/{id}', [UserController::class, 'editReviews']);
  Route::match(['get', 'post'], 'reviews/details', [UserController::class, 'reviewDetails']);

  Route::match(array('GET', 'POST'),'properties', [PropertyController::class, 'userProperties']);
  Route::match(array('GET', 'POST'),'property/create', [PropertyController::class, 'create']);
  Route::match(array('GET', 'POST'),'listing/{id}/photo_message', [PropertyController::class, 'photoMessage'])->middleware(['checkUserRoutesPermissions']);
  Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', [PropertyController::class, 'photoDelete'])->middleware(['checkUserRoutesPermissions']);

  Route::match(array('POST'),'listing/photo/make_default_photo', [PropertyController::class, 'makeDefaultPhoto']);

  Route::match(array('POST'),'listing/photo/make_photo_serial', [PropertyController::class, 'makePhotoSerial']);

  Route::match(array('GET', 'POST'),'listing/update_status', [PropertyController::class, 'updateStatus']);
  Route::match(array('GET', 'POST'),'listing/upload-certification-document', [PropertyController::class, 'uploadCertificationDocument']);
  Route::match(array('GET', 'POST'),'listing/delete-certification-document/{id}', [PropertyController::class, 'deleteCertificationDocument']);
  Route::match(array('GET', 'POST'),'listing/{id}/{step}', [PropertyController::class, 'listing'])->where(['id' => '[0-9]+','page' => 'basics|description|location|amenities|photos|pricing|calendar|details|booking']);

  // Favourites routes
  Route::get('user/favourite', [PropertyController::class, 'userBookmark']);
  Route::post('add-edit-book-mark', [PropertyController::class, 'addEditBookMark']);
  Route::post('subscribe_newsletter', [HomeController::class, 'subscribeNewsletter']);

  Route::post('ajax-calender/{id}', [CalendarController::class, 'calenderJson']);
  Route::post('ajax-calender-price/{id}', [CalendarController::class, 'calenderPriceSet']);
  //iCalendar routes start
  Route::post('ajax-icalender-import/{id}', [CalendarController::class, 'icalendarImport']);
  Route::get('icalendar/synchronization/{id}', [CalendarController::class, 'icalendarSynchronization']);
  //iCalendar routes end
  Route::post('currency-symbol', [PropertyController::class, 'currencySymbol']);
  Route::match(['get', 'post'], 'payments/book/{id?}', [PaymentController::class, 'index']);
  Route::post('payments/create_booking', [PaymentController::class, 'createBooking']);
  Route::get('payments/success', [PaymentController::class, 'success']);
  Route::get('payments/cancel', [PaymentController::class, 'cancel']);
  Route::get('payments/currency-wallet-payment', [PaymentController::class, 'currencyWalletPayment']);
  Route::get('payments/boxa-wallet-payment', [PaymentController::class, 'boxaWalletPayment']);
  Route::get('payments/stripe', [PaymentController::class, 'stripePayment']);
  Route::get('payments/wallet-connect', [PaymentController::class, 'walletConnect']);
  Route::post('payments/boxa-wallet-request', [PaymentController::class, 'boxaWalletRequest']);
  Route::post('payments/stripe-request', [PaymentController::class, 'stripeRequest']);
  Route::post('payments/currencty-wallet-request', [PaymentController::class, 'currencyWalletRequest']);
  Route::post('payments/wallet-request', [PaymentController::class, 'walletRequest']);
  Route::match(['get', 'post'], 'payments/bank-payment', [PaymentController::class, 'bankPayment']);

  Route::get('booking/{id}', [BookingController::class, 'index'])->where('id', '[0-9]+');
  Route::get('booking_payment/{id}', [BookingController::class, 'requestPayment'])->where('id', '[0-9]+');
  Route::get('booking/requested', [BookingController::class, 'requested']);
  Route::get('booking/itinerary_friends', [BookingController::class, 'requested']);
  Route::post('booking/accept/{id}', [BookingController::class, 'accept']);
  Route::post('booking/decline/{id}', [BookingController::class, 'decline']);
  Route::get('booking/expire/{id}', [BookingController::class, 'expire']);
  Route::match(['get', 'post'], 'my-bookings', [BookingController::class, 'myBookings']);
  Route::post('booking/host_cancel', [BookingController::class, 'hostCancel']);

  Route::match(['get', 'post'], 'trips/active', [TripsController::class, 'myTrips']);
  Route::get('booking/receipt', [TripsController::class, 'receipt']);
  Route::post('trips/guest_cancel', [TripsController::class, 'guestCancel']);

  // Messaging
  Route::match(['get', 'post'], 'inbox', [InboxController::class, 'index']);
  Route::post('messaging/booking/', [InboxController::class, 'message']);
  Route::post('messaging/reply/', [InboxController::class, 'messageReply']);

  Route::match(['get', 'post'], 'users/account-preferences', [UserController::class, 'accountPreferences']);
  Route::get('users/account_delete/{id}', [UserController::class, 'accountDelete']);
  Route::get('users/account_default/{id}', [UserController::class, 'accountDefault']);
  Route::get('users/transaction-history', [UserController::class, 'transactionHistory']);
  Route::post('users/account_transaction_history', [UserController::class, 'getCompletedTransaction']);
  // for customer payout settings
  Route::match(['GET', 'POST'], 'users/payout', [PayoutController::class, 'index']);
  Route::match(['GET', 'POST'], 'users/payout/setting', [PayoutController::class, 'setting']);
  Route::match(['GET', 'POST'], 'users/payout/edit-payout/', [PayoutController::class, 'edit']);
  Route::match(['GET', 'POST'], 'users/payout/delete-payout/{id}', [PayoutController::class, 'delete']);

  // for payout request
  Route::match(['GET', 'POST'], 'users/payout-list', [PayoutController::class, 'payoutList']);
  Route::match(['GET', 'POST'], 'users/payout/success', [PayoutController::class, 'success']);
  Route::match(['GET', 'POST'], 'users/boxa-list', [BoxaController::class, 'index']);

  Route::match(['get', 'post'], 'users/security', [UserController::class, 'security']);
  Route::get('logout', function()
  {
    Auth::logout();
    Session::flush();
    return Redirect::to('login');
  });
});


//only can view if admin is logged in
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['guest:admin']], function(){
	Route::get('/', function(){
        return Redirect::to('admin/dashboard');
	});

    Route::match(array('GET', 'POST'), 'profile', [AdminController::class, 'profile']);
    Route::get('logout', [AdminController::class, 'logout']);
	Route::get('dashboard', [DashboardController::class, 'index']);
	Route::get('customers', [CustomerController::class, 'index'])->middleware(['permission:customers']);
	Route::get('customers/customer_search', [CustomerController::class, 'searchCustomer'])->middleware(['permission:customers']);
    Route::post('add-ajax-customer', [CustomerController::class, 'ajaxCustomerAdd'])->middleware(['permission:add_customer']);
	Route::match(array('GET', 'POST'), 'add-customer', [CustomerController::class, 'add'])->middleware(['permission:add_customer']);

	Route::group(['middleware' => 'permission:edit_customer'], function () {
		Route::match(array('GET', 'POST'), 'edit-customer/{id}', [CustomerController::class, 'update']);
		Route::get('customer/properties/{id}', [CustomerController::class, 'customerProperties']);
		Route::get('customer/bookings/{id}', [CustomerController::class, 'customerBookings']);
		Route::post('customer/bookings/property_search', [BookingsController::class, 'searchProperty']);
		Route::get('customer/payouts/{id}', [CustomerController::class, 'customerPayouts']);
		Route::get('customer/payment-methods/{id}', [CustomerController::class, 'paymentMethods']);
		Route::get('customer/wallet/{id}', [CustomerController::class, 'customerWallet']);
		Route::match(array('GET', 'POST'), 'customer/send-boxa-to-wallet/{id}', [CustomerController::class, 'sendBoxaToWallet']);

		Route::get('customer/properties/{id}/property_list_csv', [PropertiesController::class, 'propertyCsv']);
		Route::get('customer/properties/{id}/property_list_pdf', [PropertiesController::class, 'propertyPdf']);

		Route::get('customer/bookings/{id}/booking_list_csv', [BookingsController::class, 'bookingCsv']);
		Route::get('customer/bookings/{id}/booking_list_pdf', [BookingsController::class, 'bookingPdf']);

		Route::get('customer/payouts/{id}/payouts_list_pdf', [PayoutsController::class, 'payoutsPdf']);
		Route::get('customer/payouts/{id}/payouts_list_csv', [PayoutsController::class, 'payoutsCsv']);

		Route::get('customer/customer_list_csv', [CustomerController::class, 'customerCsv']);
		Route::get('customer/customer_list_pdf', [CustomerController::class, 'customerPdf']);
	});

	Route::group(['middleware' => 'permission:manage_messages'], function () {
		Route::get('messages', [AdminController::class, 'customerMessage']);
		Route::match(array('GET', 'POST'), 'delete-message/{id}', [AdminController::class, 'deleteMessage']);
		Route::match(array('GET','POST'), 'send-message-email/{id}', [AdminController::class, 'sendEmail']);
		Route::match(['get', 'post'],'upload_image',[AdminController::class, 'uploadImage'])->name('upload');
		Route::get('messaging/host/{id}', [AdminController::class, 'hostMessage']);
        Route::post('reply/{id}', [AdminController::class, 'reply']);
    });

	Route::get('properties', [PropertiesController::class, 'index'])->middleware(['permission:properties']);
	Route::match(array('GET', 'POST'), 'add-properties', [PropertiesController::class, 'add'])->middleware(['permission:add_properties']);
	Route::get('properties/property_list_csv', [PropertiesController::class, 'propertyCsv']);
	Route::get('properties/property_list_pdf', [PropertiesController::class, 'propertyPdf']);

	Route::group(['middleware' => 'permission:edit_properties'], function () {
		Route::match(array('GET', 'POST'),'listing/{id}/photo_message', [PropertiesController::class, 'photoMessage']);
		Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', [PropertiesController::class, 'photoDelete']);
		Route::match(array('GET', 'POST'),'listing/{id}/update_status', [PropertiesController::class, 'update_status']);
		Route::match(array('POST'),'listing/photo/make_default_photo', [PropertiesController::class, 'makeDefaultPhoto']);
		Route::match(array('POST'),'listing/photo/make_photo_serial', [PropertiesController::class, 'makePhotoSerial']);
		Route::match(array('GET', 'POST'),'listing/{id}/{step}', [PropertiesController::class, 'listing'])->where(['id' => '[0-9]+','page' => 'basics|description|location|amenities|photos|pricing|calendar|details|booking']);
	});

    Route::post('ajax-calender/{id}', [CalendarController::class, 'calenderJson']);
    Route::post('ajax-calender-price/{id}', [CalendarController::class, 'calenderPriceSet']);
    //iCalender routes for admin
    Route::post('ajax-icalender-import/{id}', [CalendarController::class, 'icalendarImport']);
    Route::get('icalendar/synchronization/{id}', [CalendarController::class, 'icalendarSynchronization']);
    //iCalender routes end
	Route::match(array('GET', 'POST'), 'edit_property/{id}', [PropertiesController::class, 'update'])->middleware(['permission:edit_properties']);
	Route::get('delete-property/{id}', [PropertiesController::class, 'delete'])->middleware(['permission:delete_property']);
	Route::get('bookings', [BookingsController::class, 'index'])->middleware(['permission:manage_bookings']);
	Route::get('bookings/property_search', [BookingsController::class, 'searchProperty'])->middleware(['permission:manage_bookings']);
	Route::get('bookings/customer_search', [BookingsController::class, 'searchCustomer'])->middleware(['permission:manage_bookings']);
	//booking details
	Route::get('bookings/detail/{id}', [BookingsController::class, 'details'])->middleware(['permission:manage_bookings']);
	Route::get('bookings/edit/{req}/{id}', [BookingsController::class, 'updateBookingStatus'])->middleware(['permission:manage_bookings']);
	Route::post('bookings/pay', [BookingsController::class, 'pay'])->middleware(['permission:manage_bookings']);
	Route::get('booking/need_pay_account/{id}/{type}', [BookingsController::class, 'needPayAccount']);
	Route::get('booking/booking_list_csv', [BookingsController::class, 'bookingCsv']);
	Route::get('booking/booking_list_pdf', [BookingsController::class, 'bookingPdf']);
	Route::get('payouts', [PayoutsController::class, 'index'])->middleware(['permission:view_payouts']);
	Route::match(array('GET', 'POST'), 'payouts/edit/{id}', [PayoutsController::class, 'edit']);
	Route::get('payouts/details/{id}', [PayoutsController::class, 'details']);
	Route::get('payouts/payouts_list_pdf', [PayoutsController::class, 'payoutsPdf']);
	Route::get('payouts/payouts_list_csv', [PayoutsController::class, 'payoutsCsv']);
	Route::group(['middleware' => 'permission:manage_reviews'], function () {
		Route::get('reviews', [ReviewsController::class, 'index']);
		Route::match(array('GET', 'POST'), 'edit_review/{id}', [ReviewsController::class, 'edit']);
		Route::get('reviews/review_search', [ReviewsController::class, 'searchReview']);
		Route::get('reviews/review_list_csv', [ReviewsController::class, 'reviewCsv']);
		Route::get('reviews/review_list_pdf', [ReviewsController::class, 'reviewPdf']);

	});

	// For Reporting
	Route::group(['middleware' => 'permission:view_reports'], function () {
		Route::get('sales-report', [ReportsController::class, 'salesReports']);
		Route::get('sales-analysis', [ReportsController::class, 'salesAnalysis']);
		Route::get('reports/property-search', [ReportsController::class, 'searchProperty']);
		Route::get('overview-stats', [ReportsController::class, 'overviewStats']);
	});

	Route::group(['middleware' => 'permission:manage_amenities'], function () {
		Route::get('amenities', [AmenitiesController::class, 'index']);
		Route::match(array('GET', 'POST'), 'add-amenities', [AmenitiesController::class, 'add']);
		Route::match(array('GET', 'POST'), 'edit-amenities/{id}', [AmenitiesController::class, 'update']);
		Route::get('delete-amenities/{id}', [AmenitiesController::class, 'delete']);
	});

	Route::group(['middleware' => 'permission:manage_pages'], function () {
		Route::get('pages', [PagesController::class, 'index']);
		Route::match(array('GET', 'POST'), 'add-page', [PagesController::class, 'add']);
		Route::match(array('GET', 'POST'), 'edit-page/{id}', [PagesController::class, 'update']);
		Route::get('delete-page/{id}', [PagesController::class, 'delete']);

	});


	Route::group(['middleware' => 'permission:manage_admin'], function () {
		Route::get('admin-users', [AdminController::class, 'index']);
		Route::match(array('GET', 'POST'), 'add-admin', [AdminController::class, 'add']);
		Route::match(array('GET', 'POST'), 'edit-admin/{id}', [AdminController::class, 'update']);
		Route::match(array('GET', 'POST'), 'delete-admin/{id}', [AdminController::class, 'delete']);
	});

	Route::group(['middleware' => 'permission:general_setting'], function () {
		Route::match(array('GET', 'POST'), 'settings', [SettingsController::class, 'general'])->middleware(['permission:general_setting']);
		Route::match(array('GET', 'POST'), 'settings/preferences', [SettingsController::class, 'preferences'])->middleware(['permission:preference']);
		Route::post('settings/delete_logo', [SettingsController::class, 'deleteLogo']);
		Route::post('settings/delete_favicon', [SettingsController::class, 'deleteFavIcon']);
		Route::match(array('GET', 'POST'), 'settings/fees', [SettingsController::class, 'fees'])->middleware(['permission:manage_fees']);
		Route::group(['middleware' => 'permission:manage_banners'], function () {
			Route::get('settings/banners', [BannersController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-banners', [BannersController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-banners/{id}', [BannersController::class, 'update']);
			Route::get('settings/delete-banners/{id}', [BannersController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:starting_cities_settings'], function () {
			Route::get('settings/starting-cities', [StartingCitiesController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-starting-cities', [StartingCitiesController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-starting-cities/{id}', [StartingCitiesController::class, 'update']);
			Route::get('settings/delete-starting-cities/{id}', [StartingCitiesController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:manage_property_type'], function () {
			Route::get('settings/property-type', [PropertyTypeController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-property-type', [PropertyTypeController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-property-type/{id}', [PropertyTypeController::class, 'update']);
			Route::get('settings/delete-property-type/{id}', [PropertyTypeController::class, 'delete']);
		});
		Route::group(['middleware' => 'permission:manage_discounts'], function () {
			Route::get('settings/discounts', [DiscountsController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-discounts', [DiscountsController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-discounts/{id}', [DiscountsController::class, 'update']);
			Route::get('settings/discounts/{id}', [DiscountsController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:space_type_setting'], function () {
			Route::get('settings/space-type', [SpaceTypeController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-space-type', [SpaceTypeController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-space-type/{id}', [SpaceTypeController::class, 'update']);
			Route::get('settings/delete-space-type/{id}', [SpaceTypeController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:manage_bed_type'], function () {
			Route::get('settings/bed-type', [BedTypeController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-bed-type', [BedTypeController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-bed-type/{id}', [BedTypeController::class, 'update']);
			Route::get('settings/delete-bed-type/{id}', [BedTypeController::class, 'delete'] );
		});

		Route::group(['middleware' => 'permission:manage_currency'], function () {
			Route::get('settings/currency', [CurrencyController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-currency', [CurrencyController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-currency/{id}', [CurrencyController::class, 'update']);
			Route::get('settings/delete-currency/{id}', [CurrencyController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:manage_country'], function () {
			Route::get('settings/country', [CountryController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-country', [CountryController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-country/{id}', [CountryController::class, 'update']);
			Route::get('settings/delete-country/{id}', [CountryController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:manage_amenities_type'], function () {
			Route::get('settings/amenities-type', [AmenitiesTypeController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-amenities-type', [AmenitiesTypeController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-amenities-type/{id}', [AmenitiesTypeController::class, 'update']);
			Route::get('settings/delete-amenities-type/{id}', [AmenitiesTypeController::class, 'delete']);
		});

		Route::match(array('GET', 'POST'), 'settings/email', [SettingsController::class, 'email'])->middleware(['permission:email_settings']);



		Route::group(['middleware' => 'permission:manage_language'], function () {
			Route::get('settings/language', [LanguageController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-language', [LanguageController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-language/{id}', [LanguageController::class, 'update']);
			Route::get('settings/delete-language/{id}', [LanguageController::class, 'delete']);
		});

		Route::match(array('GET', 'POST'), 'settings/fees', [SettingsController::class, 'fees'])->middleware(['permission:manage_fees']);

		Route::group(['middleware' => 'permission:manage_metas'], function () {
			Route::get('settings/metas', [MetasController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/edit_meta/{id}', [MetasController::class, 'update']);
		});

		Route::match(array('GET', 'POST'), 'settings/api-informations', [SettingsController::class, 'apiInformations'])->middleware(['permission:api_informations']);
		Route::match(array('GET', 'POST'), 'settings/payment-methods', [SettingsController::class, 'paymentMethods'])->middleware(['permission:payment_settings']);
		Route::match(array('GET', 'POST'), 'settings/bank/add', [BankController::class, 'addBank'])->middleware(['permission:payment_settings']);
		Route::match(array('GET', 'POST'), 'settings/bank/edit/{bank}', [BankController::class, 'editBank'])->middleware(['permission:payment_settings']);
		Route::get('settings/bank/{bank}', [BankController::class, 'show'])->middleware(['permission:payment_settings']);
		Route::get('settings/bank/delete/{bank}', [BankController::class, 'deleteBank'])->middleware(['permission:payment_settings']);
		Route::match(array('GET', 'POST'), 'settings/social-links', [SettingsController::class, 'socialLinks'])->middleware(['permission:social_links']);

        Route::match(array('GET', 'POST'), 'settings/social-logins', [SettingsController::class, 'socialLogin'])->middleware(['permission:social_logins']);;

		Route::group(['middleware' => 'permission:manage_roles'], function () {
			Route::get('settings/roles', [RolesController::class, 'index']);
			Route::match(array('GET', 'POST'), 'settings/add-role', [RolesController::class, 'add']);
			Route::match(array('GET', 'POST'), 'settings/edit-role/{id}', [RolesController::class, 'update']);
			Route::get('settings/delete-role/{id}', [RolesController::class, 'delete']);
		});

		Route::group(['middleware' => 'permission:database_backup'], function () {
			Route::get('settings/backup', [BackupController::class, 'index']);
			Route::get('backup/save', [BackupController::class, 'add']);
			Route::get('backup/download/{id}', [BackupController::class, 'download']);
		});

		Route::group(['middleware' => 'permission:manage_email_template'], function () {
			Route::get('email-template/{id}', [EmailTemplateController::class, 'index']);
			Route::post('email-template/{id}', [EmailTemplateController::class, 'update']);
		});

		Route::group(['middleware' => 'permission:manage_testimonial'], function () {
			Route::get('testimonials', [TestimonialController::class, 'index']);
			Route::match(array('GET', 'POST'), 'add-testimonials', [TestimonialController::class, 'add']);
			Route::match(array('GET', 'POST'), 'edit-testimonials/{id}', [TestimonialController::class, 'update']);
			Route::get('delete-testimonials/{id}', [TestimonialController::class, 'delete']);
		});
	});
});

//only can view if admin is not logged in if they are logged in then they will be redirect to dashboard
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'no_auth:admin'], function () {
  Route::get('login', [AdminController::class, 'login']);
});



//for exporting iCalendar
Route::get('icalender/export/{id}', [CalendarController::class, 'icalendarExport']);
Route::post('admin/authenticate', [AdminController::class, 'authenticate']);
Route::get('{name}', [HomeController::class, 'staticPages']);
Route::post('duplicate-phone-number-check', [UserController::class, 'duplicatePhoneNumberCheck']);
Route::post('duplicate-phone-number-check-for-existing-customer', [UserController::class, 'duplicatePhoneNumberCheckForExistingCustomer']);
Route::match(['GET', 'POST'], 'admin/settings/sms', [SettingsController::class, 'smsSettings']);
Route::match(['get', 'post'],'upload_image',[PagesController::class, 'uploadImage'])->name('upload');

