<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;

use App\Models\{
    Settings,
    Country,
    PayoutSetting,
    Withdrawal,
    Wallet,
    Accounts,
    PaymentMethods,
    Currency,
    Boxalog
};

use App\DataTables\PayoutListDataTable;
use Auth;
use DB;
use Session;
use Validator;
use DateTime;

class BoxaController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index()
    {
        $data['title'] = 'Boxa Log';
        
        $data['transactions'] = BoxaLog::
            select('amount', 'created_at')
            ->where(['user_id' => Auth::user()->id])
            ->orderBy('created_at', 'desc')->take(9)->get();  
        return view('boxa.index', $data);
    }
}
