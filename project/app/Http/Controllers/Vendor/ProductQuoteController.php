<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Auth;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use LDAP\Result;
use Session;
use Validator;
class ProductQuoteController extends Controller
{
    //
    public $global_language;

    public function __construct()
    {
        $this->middleware('auth'); 

            if (Session::has('language'))
            {
                $data = DB::table('languages')->find(Session::get('language'));
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->vendor_language = json_decode($data_results);
            }
            else
            {
                $data = DB::table('languages')->where('is_default','=',1)->first();
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->vendor_language = json_decode($data_results);

            }

    }
    public function makeoffer(Request $request)
    {
        $file = $request->file('doc');
        if ($file != '') {
            $image = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images/productquote',$image);
        }
        else {
            $image = NULL;
        }
        $file1 = $request->file('doc1');
        if ($file1  != '') {
            $image1 = time().str_replace(' ', '', $file1->getClientOriginalName());
            $file1->move('assets/images/productquote',$image1);
        }
        else {
            $image1 = NULL;
        }
        
        $file2 = $request->file('doc2');
        if ($file2 != '') {
            $image2 = time().str_replace(' ', '', $file2->getClientOriginalName());
            $file2->move('assets/images/productquote',$image2);
        }
        else {
            $image2 = NULL;
        }
        
        $file3 = $request->file('doc3');
        if ($file3 != '') {
            $image3 = time().str_replace(' ', '', $file3->getClientOriginalName());
            $file3->move('assets/images/productquote',$image3);
        } 
        else {
            $image3 = NULL;
        } 
        
    $insert = DB::table('request_product_offer')->insert(['user_id' => $request->user_id, 'seller_id' => $request->seller_id, 
    'buyer_id' => $request->buyer_id, 'quote_id' => $request->quote_id, 'product_id' => $request->product_id,  
    'offer_amount' => $request->offer_price, 'terms_and_condition' => $request->terms_con, 'signature' => $request->newsignature, 
         'doc1' => $image, 'doc2' => $image1, 'doc3' => $image2, 'doc4' => $image3]);
         
        if (!$insert) {
            return back()->with('errors', 'insert error');
        }
        else {
            DB::update("update quotes_submit set status = '4' where quote_id = ?", [$request->quote_id]);
            return redirect()->route('vendor-product-transactions')->with('success', 'You quote offer was successfully submitted. Responses from Seller will be directed to your Transactions');
        }
    }
    public function editoffer(Request $request)
    {   
        //dd($request->newsignature);
        $file = $request->file('doc');
        if ($file != '') {
            $image = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images/productquote',$image);
        }
        else {
            $image = NULL;
        }
        $file1 = $request->file('doc1');
        if ($file1  != '') {
            $image1 = time().str_replace(' ', '', $file1->getClientOriginalName());
            $file1->move('assets/images/productquote',$image1);
        }
        else {
            $image1 = NULL;
        }
        
        $file2 = $request->file('doc2');
        if ($file2 != '') {
            $image2 = time().str_replace(' ', '', $file2->getClientOriginalName());
            $file2->move('assets/images/productquote',$image2);
        }
        else {
            $image2 = NULL;
        }
        
        $file3 = $request->file('doc3');
        if ($file3 != '') {
            $image3 = time().str_replace(' ', '', $file3->getClientOriginalName());
            $file3->move('assets/images/productquote',$image3);
        } 
        else {
            $image3 = NULL;
        } 
        $insert = DB::table('request_product_offer')->insert(['user_id' => $request->user_id, 'seller_id' => $request->seller_id, 
        'buyer_id' => $request->buyer_id, 'quote_id' => $request->quote_id, 'product_id' => $request->product_id,  
         'offer_amount' => $request->offer_price, 'terms_and_condition' => $request->terms_con, 'signature' => $request->newsignature,
         'doc1' => $image, 'doc2' => $image1, 'doc3' => $image2, 'doc4' => $image3]);
         
        if (!$insert) {
            return back()->with('errors', 'insert error');
        }
        else {
            DB::update("update quotes_submit set status = '5' where quote_id = ?", [$request->quote_id]);
            if ($request->user_id == $request->seller_id) {
                return redirect()->route('vendor-requests')->with('success', 'You quote was successfully edited. Responses from Buyer will be directed to your Quote Request');
            } else {
                return redirect()->route('vendor-product-transactions')->with('success', 'You quote offer was successfully submitted. Responses from Seller will be directed to your Transactions');
            }
        }
    }
    public function requests()
    {
        return view('vendor.requests.index');
    }
    public function statusupdate($id, $id1)
    {
        DB::update("update quotes_submit set status = '$id1' where id = ?", [$id]);
        return back();
    }
    public function requests_view($id)
    {
        
        return view('vendor.requests.requests_view')->with(['id' => $id]);
    }
    
    public function transactions()
    {
        return view('vendor.requests.transactions');
    }
}
 