<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;


use View, Auth, App, Session, Route, DB;

use App\Models\{
    Currency,
    Properties,
    Page,
    Settings,
    StartingCities,
    Testimonials,
    language,
    Admin,
    User,
    Wallet
};

use Mail;


class HomeController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->middleware('ajax-session-expired');
        $this->helper = new Common;
    }

    public function index()
    {
        $data['starting_cities'] = StartingCities::getAll();
        $data['properties']          = Properties::recommendedHome();
        $data['testimonials']        = Testimonials::getAll();
        $sessionLanguage             = Session::get('language');
        $language                    = Settings::all()->where('name', 'default_language')->where('type', 'general')->first();

        $languageDetails             = language::where(['id' => $language->value])->first();

        if (!($sessionLanguage)) {
            Session::pull('language');
            Session::put('language', $languageDetails->short_name);
            App::setLocale($languageDetails->short_name);
        }

        $pref = Settings::all();

        $this->getBoxaPrice();
        if (is_null(Session::get('user_latitude'))) {
            
            // dd(Session::get('user_latitude'));
            $userIP = $this->getIp();
            //dd($userIP);
            if ($userIP) {
                $user_location_response = $this->helper->content_read("https://ipwho.is/".$userIP);
                $user_location_json = json_decode($user_location_response, 1);
                if ($user_location_json['success']) {
                    Session::put('user_latitude', $user_location_json['latitude']);
                    Session::put('user_longitude', $user_location_json['longitude']);
                }                
            }
        }
        // dd(Session::get('user_latitude'));
        if (!is_null(Session::get('user_latitude'))) {
            $latitude = Session::get('user_latitude');
            $longitude = Session::get('user_longitude');
            $data['similar']  = Properties::join('property_address', function ($join) {
                $join->on('properties.id', '=', 'property_address.property_id');
            })
            ->select(DB::raw('*, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) as distance'))
            // ->having('distance', '<=', 300)
            ->where('properties.host_id', '!=', Auth::id())            
            ->where('properties.status', 'Listed')
            ->take(40)
            ->get();
            // dd($data['similar']);
            // $data['similar']  = collect([]);
        }

        $prefer = [];

        if (!empty($pref)) {
            foreach ($pref as $value) {
                $prefer[$value->name] = $value->value;
            }
            Session::put($prefer);
        }
        $data['date_format'] = Settings::all()->firstWhere('name', 'date_format_type')->value;

        return view('home.home', $data);
    }

    public function getBoxaPrice()
    {
        $crypto_boxa_expiry    = Settings::where('type', 'WalletConnect')->where('name', 'crypto_boxa_expiry')->first();
        $crypto_boxa_price     = Settings::where('type', 'WalletConnect')->where('name', 'crypto_boxa_price')->first();
        if(strtotime($crypto_boxa_expiry) < time()) {
            $boxa_price_response = $this->helper->content_read("https://api.coingecko.com/api/v3/simple/price?ids=boxa&vs_currencies=eur");                
            if ($boxa_price_response) {
                $crypto_boxa_price_value = json_decode($boxa_price_response);                    
                if (isset($crypto_boxa_price_value->boxa)) {
                    
                    $crypto_boxa_price->value = $crypto_boxa_price_value->boxa->eur;
                    $crypto_boxa_price->save();
                    Session::put('BOXA_PRICE', $crypto_boxa_price_value->boxa->eur);
                }
            }                
            $crypto_boxa_expiry->value = date('Y-m-d H:i:s', (time() + (5 * 60)));
            $crypto_boxa_expiry->save();
        } else {
            Session::put('BOXA_PRICE', $crypto_boxa_price->value);
        }
        
    }

    public function getIp(){
        if(env('APP_ENV') == 'local') {
            return '203.223.170.19';
        }
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }

    public function phpinfo()
    {
        echo phpinfo();
    }

    public function login()
    {
        return view('home.login');
    }
    public function thankyou()
    {
        return view('home.thankyou');
    }
    public function setSession(Request $request)
    {
        if ($request->currency) {
            Session::put('currency', $request->currency);
            $symbol = Currency::code_to_symbol($request->currency);
            Session::put('symbol', $symbol);
        } elseif ($request->language) {
            Session::put('language', $request->language);
            $name = language::name($request->language);
            Session::put('language_name', $name);
            App::setLocale($request->language);
        }elseif ($request->task == 'setUserBoxaAccount') {
            Session::put('user_boxa_account', $request->user_boxa_account);
            Session::put('user_boxa_balance', $request->user_boxa_balance);
        }elseif($request->my_currency){
            Session::put('my_currency', $request->my_currency);
        }
       
    }

    public function cancellation_policies()
    {
        return view('home.cancellation_policies');
    }

    public function staticPages(Request $request)
    {
        $pages          = Page::where(['url'=>$request->name, 'status'=>'Active']);
        if (!$pages->count()) {
            abort('404');
        }
        $pages           = $pages->first();
        $data['content'] = str_replace(['SITE_NAME', 'SITE_URL'], [SITE_NAME, url('/')], $pages->content);
        $data['title']   = $pages->url;
        $data['url']     = url('/').'/';
        $data['img']     = $data['url'].'images/2222hotel_room2.jpg';

        return view('home.static_pages', $data);
    }


    public function activateDebugger()
    {
      setcookie('debugger', 0);
    }

    public function walletUser(Request $request){

        $users = User::all();
        $wallet = Wallet::all();


        if (!$users->isEmpty() && $wallet->isEmpty() ) {
            foreach ($users as $key => $user) {

                Wallet::create([
                    'user_id' => $user->id,
                    'currency_id' => 1,
                    'wallet_type' => 'currency',
                    'balance' => 0,
                    'is_active' => 0
                ]);
                Wallet::create([
                    'user_id' => $user->id,
                    'currency_id' => 1,
                    'wallet_type' => 'crypto',
                    'balance' => 0,
                    'is_active' => 0
                ]);
            }
        }

        return redirect('/');

    }
    public function subscribeNewsletter(Request $request)
    {
        $emailSettings      = Settings::all()->where('type', 'email')->toArray();
        $emailConfig        = $this->helper->key_value('name', 'value', $emailSettings);
        // dd($emailConfig);
        $data['email']      = env('MAIL_FROM_ADDRESS');
        $data['subject']    = $subject =  'Newsletter';
        $data['content']    = $content = $request->id.' subscribed for newsletter';
        if($emailConfig['driver'] == 'smtp' && $emailConfig['email_status'] == 1 ){
            // dd('here');
            Mail::send('emails.newsletter_email', $data, function($message) use($data, $subject, $content) {
                $message->to($data['email'], 'Email')->subject($subject);
            });
            return 'ok';
        } 
        return 'ok1';
    }

}
