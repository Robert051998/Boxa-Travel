<?php

/**
 * Banners Controller
 *
 * Banners Controller manages banners in home page.
 *
 * @category   Banners

 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataTables\BannersDataTable;
use App\Models\Banners;
use App\Http\Helpers\Common;
use Validator;

class BannersController extends Controller
{
    protected $helper;  

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(BannersDataTable $dataTable)
    {
        return $dataTable->render('admin.banners.view');
    }

    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
            return view('admin.banners.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'heading'    => 'required|max:100',
                'image'      => 'required|dimensions:min_width=1920,min_height=600'
            );

            
            $fieldNames = array(
                'heading'    => 'Heading',
                'image'      => 'Image'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                

                $s3filePath = 'images/banners/';
                $image =  $request->file('image');    
                $aws_enabled = env('AWS_ACCESS_KEY_ID');                    
                if ( isset( $aws_enabled ))  {
                    $s3 = \Storage::disk('s3');                
                    $file_name = $s3filePath.uniqid() .'.'. $image->getClientOriginalExtension();
                    $path = $s3->put($file_name, file_get_contents($image), 'public');
                    \Storage::disk('s3')->url($path);
                    $imageName = env('AWS_URL').$file_name;
                } else {
                    $image     =   $request->file('image');
                    $extension =   $image->getClientOriginalExtension();
                    $filename  =   'banner_'.time() . '.' . $extension;

                    $filename   = $image->move($s3filePath, $filename);
                    $imageName = env('APP_URL').'/'.$s3filePath.$imageName;
                    // dd($imageName);
                }

                
                if (!isset($imageName)) {
                    return back()->withError('Could not upload Image');
                }

                $banners = new Banners;

                $banners->heading  = $request->heading;
                $banners->image    = $imageName;
                $banners->status   = $request->status;
                if (isset($request->subheading)) {
                    $banners->subheading = $request->subheading;
                }
                $banners->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/banners');
            }
        } else {
            return redirect('admin/settings/banners');
        }
    }
    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
            $data['result'] = Banners::find($request->id);

            return view('admin.banners.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'heading'    => 'required|max:100',
                    'image'      => 'dimensions:min_width=1920,min_height=600'

                    );

            $fieldNames = array(
                        'heading'    => 'Heading',
                        'image'      => 'dimensions:min_width=1920,min_height=600'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $banners = Banners::find($request->id);

                $banners->heading  = $request->heading;
                $banners->status   = $request->status;
                if (isset($request->subheading)) {
                    $banners->subheading = $request->subheading;
                }
                $s3filePath = 'images/banners/';
                $image =  $request->file('image');    
                $aws_enabled = env('AWS_ACCESS_KEY_ID');                    
                if ( isset( $aws_enabled ))  {
                    $s3 = \Storage::disk('s3');                
                    $file_name = $s3filePath.uniqid() .'.'. $image->getClientOriginalExtension();
                    $path = $s3->put($file_name, file_get_contents($image), 'public');
                    \Storage::disk('s3')->url($path);
                    $imageName = env('AWS_URL').$file_name;
                } else {
                    $image     =   $request->file('image');
                    $extension =   $image->getClientOriginalExtension();
                    $filename  =   'banner_'.time() . '.' . $extension;

                    $filename   = $image->move($s3filePath, $filename);
                    $imageName = env('APP_URL').'/'.$s3filePath.$imageName;
                    // dd($imageName);
                }
                $banners->image    = $imageName;
                $banners->save();

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/settings/banners');
            }
        } else {
            return redirect('admin/settings/banners');
        }
    }
    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {           
            Banners::find($request->id)->delete();
            $this->helper->one_time_message('success', 'Deleted Successfully');
        }
        
        return redirect('admin/settings/banners');
    }
}
