<?php

namespace App\Http\Controllers\Vendor;

use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\AdminUserConversation;
use App\Models\AdminUserMessage;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Pagesetting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function messages()
    {
        $user = Auth::guard('web')->user();
        $convs = Conversation::where('sent_user','=',$user->id)->orWhere('recieved_user','=',$user->id)->get();
        return view('vendor.message.index',compact('user','convs'));            
    }

    public function message($id)
    {
            $user = Auth::guard('web')->user();
            $conv = Conversation::findOrfail($id);
            return view('vendor.message.create',compact('user','conv'));                 
    }

    public function messagedelete($id)
    {
            $conv = Conversation::findOrfail($id);
            if($conv->messages->count() > 0)
            {
                foreach ($conv->messages as $key) {
                    $key->delete();
                }
            }
            $conv->delete();
            return redirect()->back()->with('success','Message Deleted Successfully');                 
    }

    public function msgload($id)
    {
            $conv = Conversation::findOrfail($id);
            return view('load.usermsg',compact('conv'));                 
    }  

    //Send email to user
    public function usercontact(Request $request)
    {
        $data = 1;
        $user = User::findOrFail($request->user_id);
        $vendor = User::where('email','=',$request->email)->first();
        if(empty($vendor))
        {
            $data = 0;
            return response()->json($data);   
        }

        $subject = $request->subject;
        $to = $vendor->email;
        $name = $request->name;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
        $gs = Generalsetting::findOrfail(1);
        if($gs->is_smtp == 1)
        {
        $data = [
            'to' => $vendor->email,
            'subject' => $request->subject,
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

        $conv = Conversation::where('sent_user','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new Message();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->sent_user = $user->id;
            $msg->save();
            return response()->json($data);   
        }
        else{
            $message = new Conversation();
            $message->subject = $subject;
            $message->sent_user= $request->user_id;
            $message->recieved_user = $vendor->id;
            $message->message = $request->message;
            $message->save();

            $msg = new Message();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->sent_user = $request->user_id;;
            $msg->save();
            return response()->json($data);   
        }
    } 

    public function postmessage(Request $request)
    {
        $msg = new Message();
        $input = $request->all();  
        $msg->fill($input)->save();
        //--- Redirect Section     

        $user = User::where('id', $request->reciever)->get();

        foreach ($user as $value) {
            $gs = Generalsetting::findOrFail(1);
            $subject = 'ANNEXTrades Message';
            $to = $value->email;
            $name = $value->name;
            $from = 'welcome@annextrades.com';
            $message = "
                <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#fff' style='border:1px solid #ff7900;'>
                    <tr><img src='https://annextrades.com/assets/images/mailimg/newmessage.jpg' style='width: 100%;'></tr>
                    <tr bgcolor='#FFF' style='padding: 15px border-top: 1px; border-color: #ff7900;'>
                        <td>
                            <div style='font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#29B1CA; text-align:left; padding-bottom:10px; padding-top:10px; line-height:26px;text-align:center;\">
                                <span style='font-family:Arial, Helvetica, sans-serif; font-size:15px;'>
                                    <div style='padding: 15px;'>
                                        <b>Dear $name</b><br>
                                        <p>You have a new Quote Request from a potential buyer.</p>

                                        <p><b>Message:</b> $request->message</p>

                                        <p>Please login to you user dashboard and respond as soon as possible.  Remember, fast response increases your chance to win sales. 
                                            </p><br><br>
                                        <p align='center'><!-- b>Please login to: </b -->
                                            <a href='https://demo.annextrades.com/user/messages'>
                                                <button style='color: #fff; background: #ff7900; padding: 7px 15px; border-radius: 10px; border: 0; font-size: 18px;'><b>LOGIN</b></button>
                                            </a>
                                        </p><br>
                                    </div>
                                </span> 
                            </div>
                        </td>
                    </tr>
                </table>
            ";
            if($gs->is_smtp)
            {
                $data = [
                    'to' => $to,
                    'subject' => $subject,
                    'body' => $message,
                ];

                $mailer = new GeniusMailer();
                if ($mailer->sendCustomMail($data)) {
                    $msg = 'Message Sent! SMTP'.$to;
                }else{
                    $msg = 'failed';
                }
            }
            else{
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$message,$headers);
                $msg = 'Message Sent! MailSET';

            }
        }
        return response()->json($msg);      
        //--- Redirect Section Ends  
    }

    public function adminmessages()
    {
            $user = Auth::guard('web')->user();
            $convs = AdminUserConversation::where('type','=','Ticket')->where('user_id','=',$user->id)->get();
            return view('vendor.ticket.index',compact('convs'));            
    }

    public function adminDiscordmessages()
    {
            $user = Auth::guard('web')->user();
            $convs = AdminUserConversation::where('type','=','Dispute')->where('user_id','=',$user->id)->get();
            return view('vendor.dispute.index',compact('convs'));            
    }

    public function messageload($id)
    {
            $conv = AdminUserConversation::findOrfail($id);
            return view('load.usermessage',compact('conv'));                 
    }   

    public function adminmessage($id)
    {
            $conv = AdminUserConversation::findOrfail($id);
            return view('vendor.ticket.create',compact('conv'));                 
    }   

    public function adminmessagedelete($id)
    {
            $conv = AdminUserConversation::findOrfail($id);
            if($conv->messages->count() > 0)
            {
                foreach ($conv->messages as $key) {
                    $key->delete();
                }
            }
            $conv->delete();
            return redirect()->back()->with('success','Message Deleted Successfully');                 
    }

    public function adminpostmessage(Request $request)
    {
        $msg = new AdminUserMessage();
        $input = $request->all();  
        $msg->fill($input)->save();
        $notification = new Notification;
        $notification->conversation_id = $msg->conversation->id;
        $notification->save();
        //--- Redirect Section     
        $msg = 'Message Sent!';
        return response()->json($msg);      
        //--- Redirect Section Ends  
    }

    public function adminusercontact(Request $request)
    {

    }
    
    public function buyBulk(Request $request)
    {
        $insert = DB::table('order_bulk')->insert(['user_id' => $request->user_id, 'product_id' => $request->product_id,  'quantity' => $request->quantity]);
        
        $msg = 'Message Sent!';
        return response()->json($msg);
    }
}
 