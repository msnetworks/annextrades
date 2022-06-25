<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Generalsetting;
use App\Models\User;

class PricingUSController extends Controller
{
    //
    public function index()
    {
        return view('front.pricingus');
    }
    public function free()
    {
        User::where('id', Auth::user()->id)->update(['is_vendor' => 0]);
        return redirect()->route('user-dashboard')->with('success','Account Activated Successfully');
    }
}
