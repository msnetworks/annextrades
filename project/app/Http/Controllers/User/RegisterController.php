<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

    	$gs = Generalsetting::findOrFail(1);

    	if($gs->is_capcha == 1)
    	{
	        $value = session('captcha_string');
	        if ($request->codes != $value){
	            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	        }    		
    	}


        //--- Validation Section

        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
		
		$user = new User;
		$input = $request->all();        
		$input['password'] = bcrypt($request['password']);
		$token = md5(time().$request->name.$request->email);
		$input['verification_link'] = $token;
		$input['affilate_code'] = md5($request->name.$request->email);
		
		if(!empty($request->vendor))
	          {
					//--- Validation Section
					/* $rules = [
						'shop_name' => 'unique:users',
						'shop_number'  => 'max:10'
							];
					$customs = [
						'shop_name.unique' => 'This Shop Name has already been taken.',
						'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
					];

					$validator = Validator::make(Input::all(), $rules, $customs);
					if ($validator->fails()) {
					return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
					} */
					$input['is_vendor'] = 1;
			  }
			  
			  $user->fill($input)->save();
			if(!empty($request->vendor)){
				$user = User::where('verification_link','=', $token)->first();
				Auth::guard('web')->login($user); 
				//return redirect()->route('front.pricing')->with('success','Please select the plan');
				return response()->json(2);
			}
			else{
	        if($gs->is_verification_email == 1)
	        {
	        $to = $request->email;
	        $subject = 'Verify your email address.';
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
														<h1 style='font-size: 24px; color: #292936 !important; margin: 0;' align='center'>Verify Your Email Address</h1>
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
																As an extra security check, this is to verify your identify. Please verify this is the correct email address for your ANNEXTrades account.
															</p>
														</td>
													</tr>
													<tr>
														<td align='center' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
															<a href=".url('user/register/verify/'.$token)."><button style='padding: 15px 24px; color: #fff; background: #ff5500; font-weight: 600; border: 0px; border-radius: 30px;'>CONFIRM EMAIL</button></a>
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
	        if($gs->is_smtp == 1)
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
			//$m = 'annexis.data@gmail.com';
	        mail($to,$subject,$msg,$headers);
	        }
          	return response()->json('Verification email was sent to '.$to.'. Please check Inbox and Spam folder. Click on the provided link to complete verification and proceed to next step.');
	        }
	        else {

            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user); 
          	return response()->json(1);
	        }
			}

    }

    public function token($token)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_verification_email == 1)
	        {    	
        $user = User::where('verification_link','=',$token)->first();
        if(isset($user))
        {
            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user); 
			if ($user->is_vendor == '1') {
				return redirect()->route('front.pricing')->with('success','Email Verified Successfully');
			} else {
				return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
			}
			
        }
    		}
    		else {
    		return redirect()->back();	
    		}
    }
}