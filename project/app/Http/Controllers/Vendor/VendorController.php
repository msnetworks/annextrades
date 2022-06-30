<?php

namespace App\Http\Controllers\Vendor;

use DB;
use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\VendorOrder;
use App\Models\Subscription;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\UserSubscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class VendorController extends Controller
{

    public $lang;
    public function __construct()
    {

        $this->middleware('auth');

            if (Session::has('language')) 
            {
                $data = DB::table('languages')->find(Session::get('language'));
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->lang = json_decode($data_results);
            }
            else
            {
                $data = DB::table('languages')->where('is_default','=',1)->first();
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->lang = json_decode($data_results);
                
            } 
    }

    //*** GET Request
    public function index()
    {
        $user = Auth::user();  
        $pending = VendorOrder::where('user_id','=',$user->id)->where('status','=','pending')->get(); 
        $processing = VendorOrder::where('user_id','=',$user->id)->where('status','=','processing')->get(); 
        $completed = VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->get(); 
        return view('vendor.index',compact('user','pending','processing','completed'));
    }

    public function category_notifications()
    {
        $user = Auth::user();  
        //get_data
        $all_categories = DB::table('categories_us')->orderBy('id','desc')->get()->toArray();
        $selected_categories = DB::table('vendor_category_notifications')->select('category_id')->where('vendor_id',$user->id)->get()->toArray();
        $total_selected_categories = array();
        foreach($selected_categories as $cat){
            $total_selected_categories[] = $cat->category_id;
        }
        //set_data
        $data['all_categories'] = $all_categories;
        $data['total_selected_categories'] = $total_selected_categories;
        return view('vendor.notifications.category_notifications',$data);
    }

    public function save_category_notification(Request $request){
        if (DB::table('vendor_category_notifications')->where('vendor_id', $request->vendor_id)->where('category_id', $request->category_id)->count() == 0) {   
            $insert = DB::table('vendor_category_notifications')->insert(['vendor_id' => $request->vendor_id, 'category_id' => $request->category_id]);
            echo "Category successfully subscribed. Thankyou!";
        } else {
            echo "Already exist in your subscription list.";
        }
    }

    public function delete_category_notification(Request $request){
        DB::table('vendor_category_notifications')->where('vendor_id', $request->vendor_id)->where('category_id', $request->category_id)->delete();
        echo "Category successfully unsubscribed. Thankyou!";
    }

    public function location_notifications()
    {
        $user = Auth::user();  
        //get_data
        $all_states = DB::table('us_states')->orderBy('id','asc')->get()->toArray();
        $selected_states = DB::table('vendor_location_notifications')->select('state_id')->where('vendor_id',$user->id)->get()->toArray();
        $total_selected_states = array();
        foreach($selected_states as $state){
            $total_selected_states[] = $state->state_id;
        }
        //set_data
        $data['all_states'] = $all_states;
        $data['total_selected_states'] = $total_selected_states;
        return view('vendor.notifications.location_notifications',$data);
    }

    public function save_location_notification(Request $request){
        if (DB::table('vendor_location_notifications')->where('vendor_id', $request->vendor_id)->where('state_id', $request->state_id)->count() == 0) {   
            $insert = DB::table('vendor_location_notifications')->insert(['vendor_id' => $request->vendor_id, 'state_id' => $request->state_id]);
            echo "Location successfully subscribed. Thankyou!";
        } else {
            echo "Already exist in your subscription list.";
        }
    }

    public function delete_location_notification(Request $request){
        DB::table('vendor_location_notifications')->where('vendor_id', $request->vendor_id)->where('state_id', $request->state_id)->delete();
        echo "Location successfully unsubscribed. Thankyou!";
    }

    
    public function notifications()
    {
        $user = Auth::user();  
        $data = array();
        return view('vendor.notifications.notifications',$data);
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section
        $rules = [
                'shop_image'  => 'mimes:jpeg,jpg,png,svg', 
                'photo' => 'mimes:jpeg,jpg,png,svg',
                'email' => 'unique:users,email,'.Auth::user()->id
                ];


        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $input = $request->all();  
        $data = Auth::user();    

        if ($request->banner_id == '1') {
            if ($file = $request->file('shop_image')) 
             {       
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images/vendorbanner',$name);           
                $input['shop_image'] = $name;
            }
        } elseif($request->banner_id == '2') {
            $input['shop_image'] = 'annexisbg.jpg';
        } elseif($request->banner_id == '3') {
            $input['shop_image'] = 'annexisbg1.jpg';
        } elseif($request->banner_id == '4') {
            $input['shop_image'] = 'annexisbg2.jpg';
        }
        



        if ($file = $request->file('photo')) 
            {              
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images/users/',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/users/'.$data->photo)) {
                        unlink(public_path().'/assets/images/users/'.$data->photo);
                    }
                }            
                $input['photo'] = $name;
            } 

        $data->update($input);
        $msg = 'Successfully updated your profile';
        return response()->json($msg); 
    }

    // Spcial Settings All post requests will be done in this method
    public function socialupdate(Request $request)
    {
        //--- Logic Section
        $input = $request->all(); 
        $data = Auth::user();   
        if ($request->f_check == ""){
            $input['f_check'] = 0;
        }
        if ($request->t_check == ""){
            $input['t_check'] = 0;
        }

        if ($request->g_check == ""){
            $input['g_check'] = 0;
        }

        if ($request->l_check == ""){
            $input['l_check'] = 0;
        }
        $data->update($input);
        //--- Logic Section Ends
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends                

    }

    //*** GET Request
    public function profile()
    {
        $data = Auth::user();  
        return view('vendor.profile',compact('data'));
    }

    //*** GET Request
    public function ship()
    {
        $gs = Generalsetting::find(1);
        if($gs->vendor_ship_info == 0) {
            return redirect()->back();
        }
        $data = Auth::user();  
        return view('vendor.ship',compact('data'));
    }

    //*** GET Request
    public function banner()
    {
        $data = Auth::user();  
        return view('vendor.banner',compact('data'));
    }

    //*** GET Request
    public function social()
    {
        $data = Auth::user();  
        return view('vendor.social',compact('data'));
    }

    //*** GET Request
    public function subcatload($id)
    {
        $cat = Category::findOrFail($id);
        return view('load.subcategory',compact('cat'));
    }

    //*** GET Request
    public function childcatload($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }

    //*** GET Request
    public function verify()
    {
        $data = Auth::user();  
        if($data->checkStatus())
        {
            return redirect()->back();
        }
        return view('vendor.verify',compact('data'));
    }

    //*** GET Request
    public function warningVerify($id)
    {
        $verify = Verification::findOrFail($id);
        $data = Auth::user();  
        return view('vendor.verify',compact('data','verify'));
    }

    //*** POST Request
    public function verifysubmit(Request $request)
    {
        //--- Validation Section
        $rules = [
          'attachments.*'  => 'mimes:jpeg,jpg,png,svg|max:10000'
           ];
        $customs = [
            'attachments.*.mimes' => 'Only jpeg, jpg, png and svg images are allowed',
            'attachments.*.max' => 'Sorry! Maximum allowed size for an image is 10MB',
                   ];

        $validator = Validator::make(Input::all(), $rules,$customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = new Verification();
        $input = $request->all();

        $input['attachments'] = '';
        $i = 0;
                if ($files = $request->file('attachments')){
                    foreach ($files as  $key => $file){
                        $name = time().str_replace(' ', '', $file->getClientOriginalName());
                        if($i == count($files) - 1){
                            $input['attachments'] .= $name;
                        }
                        else {
                            $input['attachments'] .= $name.',';
                        }
                        $file->move('assets/images/attachments',$name);

                    $i++;
                    }
                }
        $input['status'] = 'Pending';        
        $input['user_id'] = Auth::user()->id;
        if($request->verify_id != '0')
        {
            $verify = Verification::findOrFail($request->verify_id);
            $input['admin_warning'] = 0;
            $verify->update($input);
        }
        else{

            $data->fill($input)->save();
        }

        //--- Redirect Section        
        $msg = '<div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>'.$this->lang->lang804.'</h3></div>';
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }

    public function package()
    {
        $user = Auth::user();
        $subs = Subscription::all();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        return view('vendor.plans.index',compact('user','subs','package'));
    }


    public function vendorrequest($id)
    {
        $subs = Subscription::findOrFail($id);
        $gs = Generalsetting::findOrfail(1);
        $user = Auth::user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        if($gs->reg_vendor != 1)
        {
            return redirect()->back();
        }
        return view('vendor.plans.details',compact('user','subs','package'));
    }

    public function vendorrequestsub(Request $request)
    {
        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
        $user = Auth::user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
                    $today = Carbon::now()->format('Y-m-d');
                    $input = $request->all();  
                    $user->is_vendor = 2;
                    $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                    $user->mail_sent = 1;     
                    $user->update($input);

                    $sub = new UserSubscription;
                    $sub->user_id = $user->id;
                    $sub->subscription_id = $subs->id;
                    $sub->title = $subs->title;
                    $sub->currency = $subs->currency;
                    $sub->currency_code = $subs->currency_code;
                    $sub->price = $subs->price;
                    $sub->days = $subs->days;
                    $sub->allowed_products = $subs->allowed_products;
                    $sub->details = $subs->details;
                    $sub->method = 'No Payment';
                    $sub->status = 1;
                    $sub->save();
                    
                    if ($user->email_verified != 'Yes') {
                        $subject_email = 'Verify your email address.';
                        $msg_email ="
                            <!DOCTYPE html>
                                <html xmlns='http://www.w3.org/1999/xhtml' lang='en-GB'>
                                    <head>
                                    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                    <title>ANNEXTrades</title>
                                    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
                                    
                                    <style type='text/css'>
                                        a[x-apple-data-detectors] {color: inherit !important;}
                                    </style>
                                    
                                    </head>
                                    <body style='margin: 0; padding: 0;'>
                                        <table role='presentation'  cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                                <td style='padding: 20px 0 30px 0;'>
                                            
                                                    <table align='center' cellpadding='0' cellspacing='0' style='border-collapse: collapse; '>
                                                        <tr>
                                                            <td align='left' bgcolor='#fff' style='padding: 15px 0 15px 0;'>
                                                            <img src='https://demo.annextrades.com/assets/images/1630056782logo.png' alt='ANNEXTrades' width='150' style='display: block;' />
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td bgcolor='#ffffff' align='center' style='padding: 40px 30px 40px 30px;'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;'>
                                                                <tr height='85px'>
                                                                    <td align='center' style='font-family: Arial, sans-serif; margin: 30px;'>
                                                                        <img src='https://annextrades.com/assets/images/annexis-emblem.png' alt='ANNEXTrades' width='50px' style='display: block;' />
                                                                    </td>
                                                                </tr>
                                                                <tr height='85px'>
                                                                    <td align='center' style='font-family: Arial, sans-serif; margin: 30px;'>
                                                                    <h1 style='font-size: 24px; color: #292936 !important; margin: 0;' align='center'>Verify Your Email Address</h1>
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td align='center' style='color: #292936; background: #ebebff; font-family: Arial, sans-serif;'>
                                                                        <h1 style='font-size: 20px; color: #292936 !important; margin: 0;' align='center'>$user->email</h1>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align='left' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                                                        <p style='font-size: 16px; margin: 0;'>Hello $user->name <br>
                                                                            As an extra security check, this is to verify your identify. Please verify this is the correct email address for your ANNEXTrades account.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align='center' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                                                        <a href=".url('user/register/verify/'.$user->verification_link)."><button style='padding: 15px 24px; color: #fff; background: #ff5500; font-weight: 600; border: 0px; border-radius: 30px;'>CONFIRM EMAIL</button></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align='left' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                                                        <p style='font-size: 16px; margin: 0;'>
                                                                            If this is not you, please disregard this email. Thank you.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height='55' align='left' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                                                        <p align='center'>
                                                                            <b>Your Bridge to Expansion & Increased Market Share</b>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <!--tr> 
                                                                    <td height='70'>
                                                                        <small style='font-family:Helvetica, Arial, sans-serif; font-size:10px; color:#4d4d4e;'>Confidentiality Notice: This e-mail message, including any attachments, is for the sole use of the intended recipient(s) and may contain confidential and privileged information. Any unauthorized review, use, disclosure or distribution of this information is prohibited, and may be punishable by law. If this was sent to you in error, please notify the sender by reply e-mail and destroy all copies of the original message. Please consider the environment before printing this e-mail.</small>
                                                                    </td>
                                                                </tr-->
                                                            </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </body>
                            </html>
                        ";
                    }else{
                        $subject_email = '';
                        $msg_email = "";
                    }

                    if($settings->is_smtp == 1)
                    {
                    $data = [
                        'to' => $user->email,
                        'type' => "vendor_accept",
                        'cname' => $user->name,
                        'oamount' => "",
                        'aname' => "",
                        'aemail' => "",
                        'onumber' => "",
                    ];    
                    $mailer = new GeniusMailer();
                    $mailer->sendAutoMail($data);  
                    if ($user->email_verified != 'Yes') {
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= "From: ".$settings->from_name."<".$settings->from_email.">";
                        mail($user->email,$subject_email,$msg_email,$headers);
                    }       
                    }
                    else
                    {
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: ".$settings->from_name."<".$settings->from_email.">";
                    mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
                    
                    if ($user->email_verified != 'Yes') {
                        mail($user->email,$subject_email,$msg_email,$headers);
                    }
                }
                if ($user->email_verified != 'Yes') {
                    return redirect()->route('user-dashboard')->with('success','Vendor Account Successfully Registered. Verification email was sent to '.$user->email.'. Please check Inbox and Spam folder. Click on the provided link to complete verification and proceed to next step.');
                }else{
                    return redirect()->route('vendor-dashboard')->with('success','Vendor Account Activated Successfully.');
                }

    }
   

}