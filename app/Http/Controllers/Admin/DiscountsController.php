<?php

/**
 * Discounts Controller
 *
 * Discounts Controller manages Property Types by admin.
 *
 * @category   Discounts

 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DiscountsDataTable;
use App\Models\Discounts;
use Validator;
use App\Http\Helpers\Common;

class DiscountsController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(DiscountsDataTable $dataTable)
    {
        return $dataTable->render('admin.discounts.view');
    }

    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
            return view('admin.discounts.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'amount'   => 'required|max:100',
                    'value'    => 'required|max:255',
                    'status'   => 'required'
                    );

            $fieldNames = array(
                        'amount'      => 'Name',
                        'value'       => 'Description',
                        'status'      => 'Status'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $discount                = new Discounts;
                $discount->amount          = $request->amount;
                $discount->value   = $request->value;
                $discount->status        = $request->status;
                $discount->save();                
                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/discounts');
            }
        }
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
             $data['result'] = Discounts::find($request->id);

            return view('admin.discounts.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'amount'   => 'required|max:110',
                    'value'    => 'required|max:255',
                    'status'   => 'required'
                    );

            $fieldNames = array(
                        'amount'     => 'Name',
                        'value'      => 'Description',
                        'status'     => 'Status'
                        );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $discount  = Discounts::find($request->id);

                $discount->amount          = $request->amount;
                $discount->value   = $request->value;
                $discount->status        = $request->status;
                $discount->save();
                
                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/settings/discounts');
            }
        }
    }

    public function delete(Request $request)
    {
        Discounts::find($request->id)->delete();        
        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/settings/discounts');
    }
}
