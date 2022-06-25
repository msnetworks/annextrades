<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;


class VendorController extends Controller
{

    public function index(Request $request,$slug)
    {
        $this->code_image();
        // $sort = "";
        $minprice = $request->min;
        $maxprice = $request->max;
        $sort = $request->sort;
        $string = str_replace('-',' ', $slug);
        $vendor = User::where('shop_name','=',$string)->firstOrFail();
        $data['vendor'] = $vendor;
        $data['services'] = DB::table('services')->where('user_id','=',$vendor->id)->get();
        // $oldcats = $vendor->products()->where('status','=',1)->orderBy('id','desc')->get();
        // $vprods = (new Collection(Product::filterProducts($oldcats)))->paginate(9);

        // Search By Price
        $prods = Product::when($minprice, function($query, $minprice) {
                                      return $query->where('price', '>=', $minprice);
                                    })
                                    ->when($maxprice, function($query, $maxprice) {
                                      return $query->where('price', '<=', $maxprice);
                                    })
                                     ->when($sort, function ($query, $sort) {
                                        if ($sort=='date_desc') {
                                          return $query->orderBy('id', 'DESC');
                                        }
                                        elseif($sort=='date_asc') {
                                          return $query->orderBy('id', 'ASC');
                                        }
                                        elseif($sort=='price_desc') {
                                          return $query->orderBy('price', 'DESC');
                                        }
                                        elseif($sort=='price_asc') {
                                          return $query->orderBy('price', 'ASC');
                                        }
                                     })
                                    ->when(empty($sort), function ($query, $sort) {
                                        return $query->orderBy('id', 'DESC');
                                    })->where('status', 1)->where('user_id', $vendor->id)->get();

        $vprods = (new Collection(Product::filterProducts($prods)))->paginate(9);
        $data['vprods'] = $vprods;


        return view('front.vendor', $data);
    }

    //Send email to user
    public function vendorcontact(Request $request)
    {
        if ($request->allseller == 0) {
            $user = User::findOrFail($request->user_id);
            $vendor = User::findOrFail($request->vendor_id);
            $gs = Generalsetting::findOrFail(1);
                $subject = $request->subject;
                $to = $vendor->email;
                $name = $request->name;
                //$from = $request->email;
                $from = 'welcome@annextrades.com';
                $msg = "
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
    
                //$msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
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
            else{
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
            }
            else{
                $message = new Conversation();
                $message->subject = $subject;
                $message->sent_user= $request->user_id;
                $message->recieved_user = $request->vendor_id;
                $message->message = $request->message;
                $message->save();
                $msg = new Message();
                $msg->conversation_id = $message->id;
                $msg->message = $request->message;
                $msg->sent_user = $request->user_id;;
                $msg->save();
    
            }
        }
        else{
            $subcat_id = $request->subcategory_id;
            $variable = DB::table('products')->where('subcategory_id', $subcat_id)->distinct()->get(['user_id']);
            
            $data = array('data'=> $variable);
            foreach ($variable as $value) 
            {
                $var = DB::table('users')->where('id', $value->user_id)->get();

                foreach ($var as $values) {
                    $user = User::findOrFail($values->id);
                    $vendor = User::findOrFail($request->vendor_id);
                    $gs = Generalsetting::findOrFail(1);
                    $subject = $request->subject;
                    $to = $values->email;
                    $name = $values->name;
                    $from = 'welcome@annextrades.com';
                    $msg = "
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
                            'body' => $msg,
                        ];
            
                        $mailer = new GeniusMailer();
                        $mailer->sendCustomMail($data);
                    }
                    else{
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
                    }
                    else{
                        $message = new Conversation();
                        $message->subject = $subject;
                        $message->sent_user= $request->user_id;
                        $message->recieved_user = $values->id;
                        $message->message = $request->message;
                        $message->save();
                        $msg = new Message();
                        $msg->conversation_id = $message->id;
                        $msg->message = $request->message;
                        $msg->sent_user = $request->user_id;
                        $msg->save();
                    }
                }
            }
           // return response()->json($data);

        }
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


}
