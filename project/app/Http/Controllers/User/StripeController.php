<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Config;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{

    public function __construct()
    {
        //Set Spripe Keys
        $stripe = Generalsetting::findOrFail(1);
        Config::set('services.stripe.key', $stripe->stripe_key);
        Config::set('services.stripe.secret', $stripe->stripe_secret);
    }


    public function store(Request $request){

        $input = $request->all();
        return $input;


        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
        $user = Auth::user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
        $success_url = action('User\UserController@index');
        $item_name = $subs->title." Plan";
        $item_number = str_random(4).time();
        $item_amount = $subs->price;
        $item_currency = $subs->currency_code;
        $validator = Validator::make($request->all(),[
                        'card' => 'required',
                        'cvv' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);
        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->card,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cvv,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('error','Token Problem With Your Token.');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $item_currency,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {

                    $today = Carbon::now()->format('Y-m-d');
                    $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                    $input = $request->all();  
                    $user->is_vendor = 2;
                    if(!empty($package))
                    {
                        if($package->subscription_id == $request->subs_id)
                        {
                            $newday = strtotime($today);
                            $lastday = strtotime($user->date);
                            $secs = $lastday-$newday;
                            $days = $secs / 86400;
                            $total = $days+$subs->days;
                            $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                        }
                        else
                        {
                            $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                        }
                    }
                    else
                    {
                        $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                    }
                    $msg=  "
        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
        <tr>
                <td>
                    <p style='margin-left:48px; text-align:center'><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img src='https://annextrades.com/old/assets/images/logo.png' style='height:63px; width:499px' /></span></span></p>

            <br>                                                </td>
        </tr>
        <tr>
            <td colspan='2'>
                <p style='text-align:center'>&nbsp;</p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>USA Distributor:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $user->shop_name ."</span></span></span></span></p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Supplier ID:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $rw['vendor_id']."</span></span></span></span></p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Owner&rsquo;s Name:</span></span></strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'> ". $user->name." ". $rw['lastname']."</span></span></span></span></p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Email ID: </strong>". $user->email ."</span></span></span></span></p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Contact Number: </strong>". $user->phone ."</span></span></span></span></p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>

                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><img style='width: 150px;' src='https://annextrades.com/old/assets/images/mailimg/2starrating.png' alt=''>
                                                                    <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-family: 'Montserrat', sans-serif;'>Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>

                    <br>
                <p><span style='font-size:11pt'><span style='font-family: 'Montserrat', sans-serif;'><strong><span style='font-size: 11pt;'><span style='font-family: 'Montserrat', sans-serif;'>Dear ". $user->name.",</span></span></strong></span></span></p>

                <p style='text-align:center'>&nbsp;</p>

                
                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Congratulations! <br> Your submission have been approved by the U.S. Team. &nbsp; Your account is now active on the ANNEXTrades&trade; Business Portal.</span></span></span></span></span></p>

                    <p>&nbsp;</p>

                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>The business portal link is:&nbsp;<a href='http://www.annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_self'>www.annextrades.com</a></span></span></span></span></span></p>

                    <p>
                    <span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>No further action is required at this time.</span></span></span></span></span></p>

                    <p>&nbsp;</p>

                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>If you have additional product or service you wish to upload to your account, from your user dashboard select 'Add Product' and enter the appropriate information such as name, description, images and technical support will assist you to complete your listing.</span></span></span></span></span></p>

                    <p>&nbsp;</p>

                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Please contact Customer Service after new submission has been posted and allow 24 - 48 hrs for the change to be updated to your account.</span></span></span></span></span></p>

                    <p>&nbsp;</p>

                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Customer Service can be contacted at&nbsp;<a href='tel:8001238632' style='color:#0563c1; text-decoration:underline' target='_blank'>+1 (888) 641-2950</a>, WhatsApp us <a href='https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc' style='color:#0563c1; text-decoration:underline' target='_blank'>+1 (772) 877-9454</a> or email Customer Support at support@annextrades.com. Visit us at: <span style='color:#0563c1'><u><a href='http://www.annextrades.com' style='color:#0563c1; text-decoration:underline'>www.annextrades.com</a></u></span></span></span></span></span></span></p>

                    <p>&nbsp;</p>

                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Thanks again for being a valued&nbsp;<a href='http://annextrades.com/' style='color:#0563c1; text-decoration:underline' target='_blank'>ANNEXTrades&trade;</a>&nbsp;family member!</span></span></span></span></span></p>

                    <p>&nbsp;</p>

                    <p><span style='font-size:11pt'><span style='background-color:white'><span style='font-family: 'Montserrat', sans-serif;'><span style='font-size:11.0pt'><span style='font-family: 'Montserrat', sans-serif;'>Kind Regards,</span></span></span></span></span></p>
                </td>
            </tr>
        </table>
        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
            <tbody>
                <tr>
                    <td style='width:140px; padding:0; text-align:center; vertical-align:middle;' valign='middle' width='140'>
                        <img alt='photograph' width='100' height='100' border='0' style='width:100px; height:100px; border-radius:50px; border:0;'  src='http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png'>
                    </td>
                    <td style='border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;' valign='top'> 
                        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                            <tbody>
                                <tr>
                                    <td style='font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;' valign='top'>
                                        <strong><span style='font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;'>ANNEXTrades Teams</span></strong><br>    
                                        <span style='font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;'>Customer Support</span> 
                                    </td>     
                                </tr>     
                                <tr>     
                                    <td style='font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;' valign='top'>    
                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>email: welcome@annextrades.com<br> </span>    
                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>phone: +1 (888)614-2950<span style='font-family:Verdana, sans-serif; font-size:10pt;'> | </span></span> 
                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'></span> 
                                    </td>
                                </tr>
                                <tr>     
                                    <td style='font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;' valign='top'>    
                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'> </span> 
                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>110 SE 6th Street Suite 1700</span> 
                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>Ft. Lauderdale, Florida 33301</span>      
                                    </td>
                                </tr>
                            </tbody>
                        </table>         
                    </td> 
                </tr>
                <tr>
                    <td style='font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;' valign='middle' width='140'> 
                        <span><a href='https://www.facebook.com/Annexis.net/' target='_blank' rel='noopener'><img border='0' width='16' alt='facebook icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png'></a>&nbsp;</span><span><a href='https://twitter.com/annexisbusiness' target='_blank' rel='noopener'><img border='0' width='16' alt='twitter icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png'></a>&nbsp;</span><span><a href='https://www.linkedin.com/company/annexis-business-solutions' target='_blank' rel='noopener'><img border='0' width='16' alt='linkedin icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png'></a>&nbsp;</span><span><a href='https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm' target='_blank' rel='noopener'><img border='0' width='16' alt='google plus icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png'></a>&nbsp;</span>
                    </td>
                    <td style='padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;' valign='middle'>
                        <a href='http://www.annextrades.com' target='_blank' rel='noopener' style=' text-decoration:none;'><span style='color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt'><span style='color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt'>www.annextrades.com</span></span></a>
                    </td>
                </tr>
            </tbody>
        </table>
        ";
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
                    $sub->method = 'Stripe';
                    $sub->txnid = $charge['balance_transaction'];
                    $sub->charge_id = $charge['id'];
                    $sub->status = 1;
                    $sub->save();
                    $subject = "Account Activated Successfully";
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
                    }
                    else
                    {
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: ".$settings->from_name."<".$settings->from_email.">";
                    mail($user->email,$subject,$msg,$headers);
                    }

                    return redirect()->route('user-dashboard')->with('success',$subject);

                }
                
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
        return back()->with('unsuccess', 'Please Enter Valid Credit Card Informations.');
    }


}
