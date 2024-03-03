<?php

namespace App\Http\Controllers;

use Cache;
use Auth;
use DB;
use Session;

use App\Http\Helpers\Common;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Validator;
use App\Rules\AtLeastFourEco;
use App\Rules\AtLeastOneCertificationDocument;

use Google\Cloud\Translate\V2\TranslateClient;

use App\Models\{Favourite,
    Properties,
    PropertyDetails,
    PropertyAddress,
    PropertyPhotos,
    PropertyPrice,
    PropertyType,
    PropertyDates,
    PropertyDescription,
    Currency,
    Certification,
    CertificationDocument,
    Settings,
    Bookings,
    SpaceType,
    BedType,
    PropertySteps,
    Country,
    Amenities,
    Language,
    AmenityType};

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function userProperties(Request $request)
    {
        switch ($request->status) {
            case 'Listed':
            case 'Unlisted':
                $pram = [['status', '=', $request->status]];
                break;
            default:
                $pram = [];
                break;
        }

        $data['status'] = $request->status;
        $data['properties'] = Properties::with('property_price', 'property_address')
                                ->where('host_id', Auth::id())
                                ->where($pram)
                                ->orderBy('id', 'desc')
                                ->paginate(Session::get('row_per_page'));
        $data['currentCurrency'] =  $this->helper->getCurrentCurrency();
        return view('property.listings', $data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'property_type_id'  => 'required',
                'space_type'        => 'required',
                'accommodates'      => 'required',
                'map_address'       => 'required',
            );

            $fieldNames = array(
                'property_type_id'  => 'Home Type',
                'space_type'        => 'Room Type',
                'accommodates'      => 'Accommodates',
                'map_address'       => 'City',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $property                  = new Properties;
                $property->host_id         = Auth::id();
                $property->name            = SpaceType::getAll()->find($request->space_type)->name.' in '.$request->city;
                $property->slug            = $this->helper->pretty_url($property->name);
                $property->property_type   = $request->property_type_id;
                $property->space_type      = $request->space_type;
                $property->accommodates    = $request->accommodates;
                $property->booking_type    = 'instant';
                $property->save();

                $property_address                 = new PropertyAddress;
                $property_address->property_id    = $property->id;
                $property_address->address_line_1 = $request->route;
                $property_address->city           = $request->city;
                $property_address->state          = $request->state;
                $property_address->country        = $request->country;
                $property_address->postal_code    = $request->postal_code;
                $property_address->latitude       = $request->latitude;
                $property_address->longitude      = $request->longitude;
                $property_address->save();

                $property_price                 = new PropertyPrice;
                $property_price->property_id    = $property->id;
                $property_price->currency_code  = \Session::get('currency');
                $property_price->save();

                $property_steps                   = new PropertySteps;
                $property_steps->property_id      = $property->id;
                $property_steps->save();

                $languages = Language::all();
                foreach($languages as $language) {
                    $property_description              = new PropertyDescription;
                    $property_description->property_id = $property->id;
                    $property_description->language_id = $language->id;
                    $property_description->save();
                }

                return redirect('listing/'.$property->id.'/basics');
            }
        }

        $data['property_type'] = PropertyType::getAll()->where('status', 'Active')->pluck('name', 'id');
        $data['certification'] = Certification::getAll()->where('status', 'Active')->pluck('name', 'id');
        $data['space_type']    = SpaceType::getAll()->where('status', 'Active')->pluck('name', 'id');

        return view('property.create', $data);
    }

    public function listing(Request $request, CalendarController $calendar)
    {

        $step            = $request->step;
        $property_id     = $request->id;
        $data['step']    = $step;
        $data['result']  = Properties::where('host_id', Auth::id())->findOrFail($property_id);
        $data['details'] = PropertyDetails::pluck('value', 'field');
        $data['missed']  = PropertySteps::where('property_id', $request->id)->first();


        if ($step == 'basics') {
            if ($request->isMethod('post')) {                           
                $rules      = array('certifications'     => [new AtLeastOneCertificationDocument($property_id)]);
                $fieldNames = array('certifications'     => 'Certifications Documents');
                $validator = Validator::make($request->all(), $rules);                
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {                    
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property                     = Properties::find($property_id);
                    $property->bedrooms           = $request->bedrooms;
                    $property->beds               = $request->beds;
                    $property->bathrooms          = $request->bathrooms;
                    $property->bed_type           = $request->bed_type;
                    $property->property_type      = $request->property_type;
                    $property->space_type         = $request->space_type;
                    
                    $property->accommodates       = $request->accommodates;
                    if ($request->certifications) {
                        $property->certifications     = implode(',', $request->certifications);
                    }
                    $property->other_certifications     = $request->other_certifications;
                    $property->pets_allowed       = $request->pets_allowed;
                    $amenities = explode(',',$property->amenities);
                    // check if pets allowed is checked
                    $found = array_search(24,$amenities);
                    if($property->pets_allowed=='1'){
                        // we need to add it
                        if($found===false){
                            $amenities[]=24;
                        }
                    }else{
                        if($found!==false){
                            unset($amenities[$found]);
                        }
                    }
                    

                $property->amenities = implode(',', $amenities);
                    $property->save();

                    $property_steps         = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->basics = 1;
                    $property_steps->save();
                    return redirect('listing/'.$property_id.'/description');
                }
            }

            $data['bed_type']       = BedType::getAll()->pluck('name', 'id');
            $data['property_type']  = PropertyType::getAll()->where('status', 'Active')->pluck('name', 'id');
            $data['certifications'] = Certification::where('status', 'Active')->get();
            $data['space_type']     = SpaceType::getAll()->pluck('name', 'id');
            $data['property_certifications'] = explode(',', $data['result']->certifications);
            $data['certification_documents'] = CertificationDocument::where('property_id', $property_id)->get();
            
        } elseif ($step == 'description') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'name'     => 'required|max:50',
                    'summary'  => 'required|max:1000'
                );

                $fieldNames = array(
                    'name'     => 'Name',
                    'summary'  => 'Summary',
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }
                else
                {
                    $property           = Properties::find($property_id);
                    $property->name     = $request->name;
                    $property->slug     = $this->helper->pretty_url($request->name);
                    $property->save();

                    $this->updateDescription($property_id, ['summary' => $request->summary]);

                    


                    $property_steps              = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->description = 1;
                    $property_steps->save();
                    return redirect('listing/'.$property_id.'/location');
                }
            }
            $selectedLanguage = $this->getSelectedLanguage();
            $data['description']       = PropertyDescription::where('property_id', $property_id)->where('language_id', $selectedLanguage->id)->first();
        } elseif ($step == 'details') {
            if ($request->isMethod('post')) {
                $this->updateDescription($property_id, [
                    'about_place' => $request->about_place,
                    'place_is_great_for'   => $request->place_is_great_for,
                    'guest_can_access'     => $request->guest_can_access,
                    'interaction_guests'   => $request->interaction_guests,
                    'other'                => $request->other,
                    'about_neighborhood'   => $request->about_neighborhood,
                    'get_around'           => $request->get_around
                ]);
                return redirect('listing/'.$property_id.'/description');
            }
            $selectedLanguage = $this->getSelectedLanguage();
            $data['description']       = PropertyDescription::where('property_id', $property_id)->where('language_id', $selectedLanguage->id)->first();            
        } elseif ($step == 'location') {
            if ($request->isMethod('post')) {
                $rules = array(
                    'address_line_1'    => 'required|max:250',
                    'address_line_2'    => 'max:250',
                    'country'           => 'required',
                    'city'              => 'required',
                    'state'             => 'required',
                    'latitude'          => 'required|not_in:0',
                );

                $fieldNames = array(
                    'address_line_1' => 'Address Line 1',
                    'country'        => 'Country',
                    'city'           => 'City',
                    'state'          => 'State',
                    'latitude'       => 'Map',
                );

                $messages = [
                    'not_in' => 'Please set :attribute pointer',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property_address                 = PropertyAddress::where('property_id', $property_id)->first();
                    $property_address->address_line_1 = $request->address_line_1;
                    $property_address->address_line_2 = $request->address_line_2;
                    $property_address->latitude       = $request->latitude;
                    $property_address->longitude      = $request->longitude;
                    $property_address->city           = $request->city;
                    $property_address->state          = $request->state;
                    $property_address->country        = $request->country;
                    $property_address->postal_code    = $request->postal_code;
                    $property_address->save();

                    $property_steps           = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->location = 1;
                    $property_steps->save();

                    return redirect('listing/'.$property_id.'/amenities');
                }
            }
            $data['country']       = Country::pluck('name', 'short_name');
        } elseif ($step == 'amenities') {
            if ($request->isMethod('post') && is_array($request->amenities)) {
                $rules      = array('amenities'     => [new AtLeastFourEco]);
                $fieldNames = array('amenities'     => 'Eco Amenities');
                $validator = Validator::make($request->all(), $rules);                
                $validator->setAttributeNames($fieldNames);
                if ($validator->fails()) {
                    $data['property_amenities'] = $request->amenities;
                    return back()->withErrors($validator)->withInput();
                } else {
                    $rooms            = Properties::find($request->id);

                    $amenities = $request->amenities;
                    // check if pets allowed is checked
                    $found = array_search(24,$amenities);
                    if($found!==false){
                        $rooms->pets_allowed ='1';
                    }else{
                        $rooms->pets_allowed='0';
                    }
                    

                    $rooms->amenities = implode(',', $amenities);

                    $rooms->save();
                    $eco_friendly_amenities = Amenities::eco_friendly($request->id);
                    $eco_amenities_count = 0;
                    foreach($eco_friendly_amenities as $eco_amenity ) {
                        if (!is_null ($eco_amenity->status)) {
                            $eco_amenities_count += 0.5;
                        }
                    }
                    $rooms->green_score     = $eco_amenities_count;
                    $rooms->save();
                    return redirect('listing/'.$property_id.'/photos');
                }
            } else {
                $data['property_amenities'] = explode(',', $data['result']->amenities);
            }
            $data['amenities']          = Amenities::where('status', 'Active')->get();
            $data['amenities_type']     = AmenityType::get();
        } elseif ($step == 'photos') {
            if($request->isMethod('post')) {
                if($request->crop == 'crop' && $request->photos) {
                    $baseText = explode(";base64,", $request->photos);
                    $name = explode(".", $request->img_name);
                    $convertedImage = base64_decode($baseText[1]);
                    $request->request->add(['type'=>end($name)]);
                    $request->request->add(['image'=>$convertedImage]);


                    $validate = Validator::make($request->all(), [
                        'type' => 'required|in:png,jpg,JPG,JPEG,jpeg,bmp',
                        'img_name' => 'required',
                        'photos' => 'required',
                    ]);
                } else {
                    $validate = Validator::make($request->all(), [
                        'file' => 'required|file|mimes:jpg,jpeg,bmp,png,gif,JPG',
                        'file' => 'dimensions:min_width=640,min_height=360'
                    ]);
                }

                if($validate->fails()) {
                    return back()->withErrors($validate)->withInput();
                }

                $path = public_path('images/property/'.$property_id.'/');
                $s3filePath = 'images/property/'.$property_id.'/';

                

                $aws_enabled = env('AWS_ACCESS_KEY_ID');                
                if($request->crop == "crop") {
                    if ( isset( $aws_enabled ))  {
                        $s3 = \Storage::disk('s3');                
                        $file_name = $s3filePath.uniqid() .'.'. end($name);
                        
                        $path = $s3->put($file_name, ($convertedImage), 'public');
                        \Storage::disk('s3')->url($path);
                        $imageName = env('AWS_URL').$file_name;
                    } else {
                        $imageName = time().'.'.$request->file->extension();  
                        $uploaded = file_put_contents($path . $imageName, $convertedImage);
                        $imageName = env('APP_URL').'/'.$s3filePath.$imageName;
                    }

                } else {
                    if (isset($_FILES["file"]["name"])) {
                        $image =  $request->file('file');                        
                        if ( isset( $aws_enabled ))  {
                            $s3 = \Storage::disk('s3');                
                            $file_name = $s3filePath.uniqid() .'.'. $image->getClientOriginalExtension();
                            $path = $s3->put($file_name, file_get_contents($image), 'public');
                            \Storage::disk('s3')->url($path);
                            $imageName = env('AWS_URL').$file_name;
                        } else {
                            $imageName = uniqid().'.'.$image->getClientOriginalExtension();  
                            $image->move($s3filePath, $imageName);
                            $imageName = env('APP_URL').'/'.$s3filePath.$imageName;
                            // dd($imageName);
                        }

                    }
                }

                if ($imageName) {
                    $photos = new PropertyPhotos;
                    $photos->property_id = $property_id;
                    $photos->photo = $imageName;
                    $photos->serial = 1;
                    $photos->cover_photo = 1;

                    $exist = PropertyPhotos::orderBy('serial', 'desc')
                        ->select('serial')
                        ->where('property_id', $property_id)
                        ->take(1)->first();

                    if (!empty($exist->serial)) {
                        $photos->serial = $exist->serial + 1;
                        $photos->cover_photo = 0;
                    }
                    $photos->save();
                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->photos = 1;
                    $property_steps->save();
                }

                return redirect('listing/'.$property_id.'/photos')->with('success', 'File Uploaded Successfully!');

            }

            $data['photos'] = PropertyPhotos::where('property_id', $property_id)
                ->orderBy('serial', 'asc')
                ->get();

        } elseif ($step == 'pricing') {
            if ($request->isMethod('post')) {
                $bookings = Bookings::where('property_id', $property_id)->where('currency_code', '!=', $request->currency_code)->first();
                if($bookings) {
                    return back()->withErrors(['currency' => trans('messages.error.currency_change')]);
                }
                $rules = array(
                    'price' => 'required|numeric|min:5',
                    'weekly_discount' => 'nullable|numeric|max:99|min:0',
                    'monthly_discount' => 'nullable|numeric|max:99|min:0'
                );

                $fieldNames = array(
                    'price'  => 'Price',
                    'weekly_discount' => 'Weekly Discount Percent',
                    'monthly_discount' => 'Monthly Discount Percent'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $property_price                    = PropertyPrice::where('property_id', $property_id)->first();
                    $property_price->price             = $request->price;
                    $property_price->weekly_discount   = $request->weekly_discount ?? 0;
                    $property_price->monthly_discount  = $request->monthly_discount ?? 0;
                    $property_price->currency_code     = $request->currency_code;
                    // $property_price->cleaning_fee      = $request->cleaning_fee;
                    $property_price->cleaning_fee      = $request->cleaning_fee ?? 0;
                    $property_price->guest_fee         = $request->guest_fee ?? 0;
                    $property_price->guest_after       = $request->guest_after ?? 0;
                    $property_price->security_fee      = $request->security_fee ?? 0;
                    $property_price->weekend_price     = $request->weekend_price ?? 0;
                    $property_price->pet_price         = $request->pet_price ?? 0;
                    $property_price->save();

                    $property_steps = PropertySteps::where('property_id', $property_id)->first();
                    $property_steps->pricing = 1;
                    $property_steps->save();

                    return redirect('listing/'.$property_id.'/booking');
                }
            }
        } elseif ($step == 'booking') {
            if ($request->isMethod('post')) {
                $property_steps          = PropertySteps::where('property_id', $property_id)->first();
                $property_steps->booking = 1;
                $property_steps->save();

                $properties               = Properties::find($property_id);
                $properties->booking_type = $request->booking_type;
                $properties->status       = ( $properties->steps_completed == 0 ) ?  'Listed' : 'Unlisted';
                $properties->save();


                return redirect('listing/'.$property_id.'/calendar');
            }
        } elseif ($step == 'calendar') {
            $data['calendar'] = $calendar->generate($request->id);
        }

        return view("listing.$step", $data);
    }

    public function getSelectedLanguage()
    {
        $language_name      = Session::get('language');
        $selectedLanguage   = Language::where('short_name', $language_name)->first();
        if (is_null($selectedLanguage)) {
            $selectedLanguage   = Language::where('default', 1)->first();
        }
        return $selectedLanguage;
    }

    public function updateDescription($property_id, $fieldsArray) 
    {        
        $language_name      = Session::get('language');
        $selectedLanguage   = Language::where('short_name', $language_name)->first();
        if (is_null($selectedLanguage)) {
            $selectedLanguage   = Language::where('default', 1)->first();
        }
        $languages          = Language::all();
        foreach($languages as $language) {
            $property_description              = PropertyDescription::where('property_id', $property_id)->where('language_id', $language->id)->first();
            if ($language->short_name == $selectedLanguage->short_name) {
                foreach($fieldsArray as $key => $value) {

                    $property_description->$key     = $value;
                }
                
            } else {
                $options = ['target' => $language->short_name, 'source' => $selectedLanguage->short_name]; 
                $translate = new TranslateClient(['key' => MAP_KEY]);
                $strings = [];
                foreach($fieldsArray as $key => $value) {
                    if (!is_null($value)) {
                        $strings[] = $value;
                    }
                }
                if (!empty($strings)) {
                    $translationResult = $translate->translateBatch($strings, $options);
                }
                $i = 0;
                foreach($fieldsArray as $key => $value) {
                    if (!is_null($value)) {
                        $property_description->$key     = $translationResult[$i]['text'];
                        $i++;
                    }
                }                
            }
            
            $property_description->save();            
        }        
    }


    public function updateStatus(Request $request)
    {
        $property_id = $request->id;
        $reqstatus = $request->status;
        if ($reqstatus == 'Listed') {
            $status = 'Unlisted';
        }else{
            $status = 'Listed';
        }
        $properties         = Properties::where('host_id', Auth::id())->find($property_id);
        $properties->status = $status;
        $properties->save();
        return  response()->json($properties);

    }

    public function getPrice(Request $request)
    {

        return $this->helper->getPrice($request->property_id, $request->checkin, $request->checkout, $request->guest_count, $request->pets_count);
    }

    public function single(Request $request)
    {

        $data['property_slug'] = $request->slug;


        $data['result'] = $result = Properties::where('slug', $request->slug)->first();        
        if ( empty($result)  ) {
            abort('404');
        }

        $data['property_id'] = $id = $result->id;
        $selectedLanguage = $this->getSelectedLanguage();
        $data['property_description'] = PropertyDescription::where('property_id', $id)->where('language_id', $selectedLanguage->id)->first();            
        if (is_null($data['property_description'])) {
            $selectedLanguage   = Language::where('default', 1)->first();
            $data['property_description'] = PropertyDescription::where('property_id', $id)->where('language_id', $selectedLanguage->id)->first();            
            if (is_null($data['property_description'])) {
                $data['property_description'] = PropertyDescription::where('property_id', $id)->first();            
            }
        }        
        $data['property_photos']     = PropertyPhotos::where('property_id', $id)->orderBy('serial', 'asc')
            ->get();

        $data['amenities']        = Amenities::normal($id);
        $data['safety_amenities'] = Amenities::security($id);
        $data['eco_friendly']     = Amenities::eco_friendly($id);
        $data['certifications']   = Certification::where('status', 'Active')->get();
        $data['property_certifications'] = explode(',', $data['result']->certifications);

        $property_address         = $data['result']->property_address;

        $latitude                 = $property_address->latitude;

        $longitude                = $property_address->longitude;

        $data['checkin']          = (isset($request->checkin) && $request->checkin != '') ? $request->checkin:'';
        $data['checkout']         = (isset($request->checkout) && $request->checkout != '') ? $request->checkout:'';

        $data['guests']           = (isset($request->guests) && $request->guests != '') ? $request->guests : 1;
        $data['children']         = (isset($request->children) && $request->children != '') ? $request->children : 0;
        $data['infants']          = (isset($request->infants) && $request->infants != '') ? $request->infants : 0;
        $data['pets']             = (isset($request->pets) && $request->pets != '') ? $request->pets : 0;
        
        $data['similar']  = Properties::join('property_address', function ($join) {
                                        $join->on('properties.id', '=', 'property_address.property_id');
        })
                                    ->select(DB::raw('*, ( 3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) as distance'))
                                    ->having('distance', '<=', 30)
                                    ->where('properties.host_id', '!=', Auth::id())
                                    ->where('properties.id', '!=', $id)
                                    ->where('properties.status', 'Listed')
                                    ->get();
        
        // $data['similar']  = Properties::all();
        $data['title']    =   $data['result']->name.' in '.$data['result']->property_address->city;
        $data['symbol'] = $this->helper->getCurrentCurrencySymbol();
        //$data['shareLink'] = url('/').'/'.'properties/'.$data['property_id'];
        $data['shareLink'] = url()->full();

        $data['date_format'] = Settings::all()->firstWhere('name', 'date_format_type')->value;
      
        return view('property.single', $data);
    }

    public function currencySymbol(Request $request)
    {
        $symbol          = Currency::code_to_symbol($request->currency);
        $data['success'] = 1;
        $data['symbol']  = $symbol;

        return json_encode($data);
    }

    public function photoMessage(Request $request)
    {
        $property = Properties::find($request->id);
        if ($property->host_id == \Auth::user()->id) {
            $photos = PropertyPhotos::find($request->photo_id);
            $photos->message = $request->messages;
            $photos->save();
        }

        return json_encode(['success'=>'true']);
    }

    public function photoDelete(Request $request)
    {
        $property   = Properties::find($request->id);
        if ($property->host_id == \Auth::user()->id) {
            $photos = PropertyPhotos::find($request->photo_id);
            $photos->delete();
        }

        return json_encode(['success'=>'true']);
    }

    public function makeDefaultPhoto(Request $request)
    {

        if ($request->option_value == 'Yes') {
            PropertyPhotos::where('property_id', '=', $request->property_id)
            ->update(['cover_photo' => 0]);

            $photos = PropertyPhotos::find($request->photo_id);
            $photos->cover_photo = 1;
            $photos->save();
        }
        return json_encode(['success'=>'true']);
    }

    public function makePhotoSerial(Request $request)
    {

        $photos         = PropertyPhotos::find($request->id);
        $photos->serial = $request->serial;
        $photos->save();

        return json_encode(['success'=>'true']);
    }


    public function set_slug()
    {

       $properties   = Properties::where('slug', NULL)->get();
       foreach ($properties as $key => $property) {

           $property->slug     = $this->helper->pretty_url($property->name);
           $property->save();
       }
       return redirect('/');

    }

    public function userBookmark()
    {

        $data['bookings'] = Favourite::with(['properties' => function ($q) {
            $q->with('property_address');
        }])->where(['user_id' => Auth::id(), 'status' => 'Active'])->orderBy('id', 'desc')
            ->paginate(Settings::all()->where('name', 'row_per_page')->first()->value);
        return view('users.favourite', $data);
    }

    public function addEditBookMark()
    {
        $property_id = request('id');
        $user_id = request('user_id');

        $favourite = Favourite::where('property_id', $property_id)->where('user_id', $user_id)->first();

        if (empty($favourite)) {
            $favourite = Favourite::create([
                'property_id' => $property_id,
                'user_id' => $user_id,
                'status' => 'Active',
            ]);

        } else {
            $favourite->status = ($favourite->status == 'Active') ? 'Inactive' : 'Active';
            $favourite->save();
        }

        return response()->json([
            'favourite' => $favourite
        ]);
    }
    public function uploadCertificationDocument(Request $request) 
    {
        $property_id = request('id');
        $validator = Validator::make($request->all(), [
            'certification_document' => 'required|file|mimes:pdf,doc,docx'            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $path = public_path('certification_documents/property/'.$property_id.'/');
        $s3filePath = 'certification_documents/property/'.$property_id.'/';
        $aws_enabled = env('AWS_ACCESS_KEY_ID');

        if (isset($_FILES["certification_document"]["name"])) {
            $fileName = $_FILES["certification_document"]["name"];
            $image =  $request->file('certification_document');
            if ( isset( $aws_enabled ))  {
                $s3 = \Storage::disk('s3');
                $file_name = $s3filePath.$_FILES["certification_document"]["name"];
                $path = $s3->put($file_name, file_get_contents($image), 'public');
                \Storage::disk('s3')->url($path);
                $imageName = env('AWS_URL').$file_name;
            } else {
                $imageName = uniqid().'.'.$image->getClientOriginalExtension();  
                $image->move($s3filePath, $imageName);
                $imageName = env('APP_URL').'/'.$s3filePath.$imageName;                
            }
        }

        if ($imageName) {
            $doc = new CertificationDocument;
            $doc->property_id = $property_id;
            $doc->document = $imageName;            
            $doc->name = $fileName;            
            $doc->save();
            return response()->json(
                [
                    'document'=> $imageName, 
                    'name' => $fileName, 
                    'error' => 'false', 
                    'id' => $doc->id,
                    'delete_url' => url('listing/delete-certification-document/'.$doc->id),

                ], 200);            
        }
        return response()->json(['document'=> null, 'error' => 'true'], 200);            
    }

    public function deleteCertificationDocument(Request $request)
    {
        $certification_document =  CertificationDocument::where('id', $request->id)->first();
        $property_id = $certification_document->property_id;
        $certification_document->delete();
        $this->helper->one_time_message('success', 'Deleted Successfully');
        return redirect('listing/'.$property_id.'/basics');
    }
}
