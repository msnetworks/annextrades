<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Generalsetting as GS;
use App\Models\Currency;
use App\Models\Transaction;
use Session;

class DepositController extends Controller
{
    public function index() {
      return view('vendor.deposit.index');
    }

    public function transactions() {
      return view('vendor.transactions');
    }

    public function transhow($id)
    {
      $data = Transaction::find($id);
      return view('load.transaction-details',compact('data'));
    }

    public function create() {
      if (Session::has('currency'))
      {
        $data['curr'] = Currency::find(Session::get('currency'));
      }
      else
      {
        $data['curr'] = Currency::where('is_default','=',1)->first();
      }
      $data['gs'] = GS::first();
      return view('vendor.deposit.create', $data);
    }

}
 