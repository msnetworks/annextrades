<?php

namespace App\Http\Controllers\Front;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Classes\GeniusMailer;
use Illuminate\Support\Facades\Input;
use Validator;
use Image;
use DB;
use Auth;

class PostRequestController extends Controller
{
    public function home()
    {   
        return view('front.postrequirement.postrequirement');
    }
    public function index()
    {   
        return view('front.dealsbulletain');
    }
    public function Datatable() 
    {
        $data = DB::table('PostRequest')->where('status', 1)->orderby('id', 'desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($data)
                       ->editColumn('company_name', function($data) {
                           $company_name = mb_strlen(strip_tags($data->company_name),'utf-8') > 50 ? mb_substr(strip_tags($data->company_name),0,50,'utf-8').'...' : strip_tags($data->company_name);
                                                          
                           return  mb_convert_encoding($company_name, 'UTF-8', 'UTF-8');
                       })
                       ->editColumn('icon', function($data) {
                        if ($data->pri_gov == '0') {
                             $company_name = '<span value="active" class="c_icon">G</span>';
                        }
                        else {
                            $company_name = '<span class="c_icon">P</span>';
                        }
                            return  mb_convert_encoding($company_name, 'UTF-8', 'UTF-8');
                        })
                       ->editColumn('product_name', function($data) {
                           $product_name = mb_strlen(strip_tags($data->product_name),'utf-8') > 50 ? mb_substr(strip_tags($data->product_name),0,50,'utf-8').'...' : strip_tags($data->product_name);
                           $product = '<a href="viewquote/'. $data->request_id .'" class="deals-title"><b>'.$product_name.'</b></a>';
                           /* if (Auth::guard('web')->check()) {
                            }else{
                               $product = '<a  href="#javascript();"  onclick="alert(\'Please login to view deal.\')"  class="deals-title"><b>'.$product_name.'</b></a>';
                            
                            } */
                           return  mb_convert_encoding($product, 'UTF-8', 'UTF-8');
                       })
                       ->editColumn('product_des', function($data) {
                        $link = '<a href="viewquote/'. $data->request_id .'"><b>Read More</b></a>';
                        $product_des = mb_strlen(strip_tags($data->product_des),'utf-8') > 300 ? mb_substr(strip_tags($data->product_des),0,300,'utf-8').'...'.$link : strip_tags($data->product_des);                        
                        return  mb_convert_encoding(html_entity_decode(($product_des)), 'UTF-8', 'UTF-8');
                        })
                       ->addColumn('submit_quote', function($data) {
                           if ($data->status) {
                            if(Auth::guard('web')->check()){
                                if (Auth::user()->is_vendor) {
                                    $today = date("Y-m-d H:i:s");
                                    $date = $data->deadline;
                                    if ($date >= $today) {
                                        $subcount = UserSubscription::where('user_id', Auth::user()->id)->where('status', 1)->sum('allowed_deals');
                                        $totalpost = DB::table('postrequest_quotes')->where('user_id', Auth::user()->id)->get();
                                        if (count($totalpost) < $subcount) {
                                            $databtn = '<a href="submitquote/'. $data->request_id .'"><span value="active" class="deal-submit active btn btn-danger">Submit Quote</span></a>
                                            ';
                                        } else {
                                            $databtn = '<a href="#javascript();"  onclick="alert(\'You have exceeded the deals submission limit. Please upgrade the plan to collect more deals\')"><span value="active" class="deal-submit active btn btn-danger">Submit Quote</span></a>
                                            ';
                                        }
                                    }else{
                                        $databtn = '<a href="#javascript();"  onclick="alert(\'The Deal is already expired Quote cannot be submitted.\')"><span value="active" class="deal-submit active btn btn-secondary">Submit Quote</span></a>
                                        ';
                                    }
                                }
                                else{
                                    $databtn = '<a href="#" onclick="alert(\'A Sellers Account is required to Submit Quote. Please Register for Seller\'s Account\')"><span value="active" class="deal-submit active btn btn-danger">Submit Quote</span></a>
                                    ';
                                }    
                                }else {
                                    $databtn = '<a href="#" onclick="alert(\'Login to submit quote\')"><span value="active" class="deal-submit active btn btn-danger">Submit Quote</span></a>
                                    ';
                                }
                                
                            }
                            else {
                               $databtn = '<button class="deal-submit btn btn-secondary" disabled>Submit Quote</button>';
                           }
                        return $databtn;
                    })
                       ->editColumn('type', function($data) {
                           $type = mb_strlen(strip_tags($data->type),'utf-8') > 50 ? mb_substr(strip_tags($data->type),0,50,'utf-8').'...' : strip_tags($data->type);
                           return  mb_convert_encoding($type, 'UTF-8', 'UTF-8');
                       })
                       ->editColumn('request_id', function($data) {
                        $request_id = mb_strlen(strip_tags($data->request_id),'utf-8') > 50 ? mb_substr(strip_tags($data->request_id),0,50,'utf-8').'...' : strip_tags($data->request_id);
                        return  mb_convert_encoding($request_id, 'UTF-8', 'UTF-8');
                        })
                       ->editColumn('deadline', function($data) {
                           $deadline = date('m-d-Y H:i:s', strtotime($data->deadline));
                           return  mb_convert_encoding($deadline, 'UTF-8', 'UTF-8');
                       })
                       ->editColumn('created_at', function($data) {
                           $created_at = date('m-d-Y H:i:s', strtotime($data->created_at));
                           return  mb_convert_encoding($created_at, 'UTF-8', 'UTF-8');
                       })
                       ->editColumn('deals_title_full', function($data) {
                        $product_name = strip_tags($data->product_name);
                        return  mb_convert_encoding($product_name, 'UTF-8', 'UTF-8');
                        })
                       ->addColumn('star', function($data) {
                            if(Auth::guard('web')->check()){
                                $user_id = Auth::user()->id;
                                $favData = DB::table('postrequest_fav')
                                ->where('request_id', $data->request_id)
                                ->where('user_id', $user_id)
                                ->get();
                                if (count($favData) == 1) {
                                    $fav = "<span value='favourite' class='btn btn-sm btn-warning removefav' data-id='$data->request_id'><i class='fa fa-star-o'></i></span>";
                                }
                                else {
                                    $fav = "<button class='btn btn-sm btn-light addfav' data-id='$data->request_id'><i class='fa fa-star-o'></i></button>";
                                }
                            }
                            else {
                                $fav = "<button class='btn btn-sm btn-light addfav' data-id='$data->request_id'><i class='fa fa-star-o'></i></button>";
                            }
                            return $fav;
                            //return '<div class="action-list"><form class="'.$data->request_id.'"><input type="hidden" value="'.$data->request_id.'"><input type="hidden" value="'.$data->request_id.'"><button onclick="myFunction()" class="star-submit" ><i class="fa fa-star-o"></i></button></form></div>';
                        })
                    ->rawColumns(['company_name', 'product_name','product_des', 'icon', 'name', 'star', 'action', 'product_name', 'submit_quote'])
                    ->toJson(); //--- Returning Json Data To Client Side
    }
    public function favouriteCount()
    {
        if(Auth::guard('web')->check()){
        $count_fav = DB::table('postrequest_fav')->where('user_id', Auth::user()->id)->count();
        return response()->json($count_fav);
        }
    }
    public function favourite(Request $request)
    {   
        if (DB::table('postrequest_fav')->where('user_id', $request->user_id)->where('request_id', $request->request_id)->count() == 0) {   
            $insert = DB::table('postrequest_fav')->insert(['request_id' => $request->request_id, 'user_id' => $request->user_id]);
        }
        return response()->json(1);
    }
    public function favouriteRemove(Request $request)
    {
        DB::table('postrequest_fav')->where('request_id', $request->request_id)->where('user_id', $request->user_id)->delete();
        //$data->delete();
        return response()->json(1);
    }
    public function viewquote(Request $request, $id)
    {   
        $data = DB::table('PostRequest')->where('request_id', $id)->get();

        return view('front.postrequirement.quotesubmit')->with(['data' => $data]);
    }
    public function submitquote(Request $request, $id)
    {   
        $data = DB::table('PostRequest')->where('request_id', $id)->get();
        return view('front.postrequirement.submitquote')->with(['data' => $data]);
    }

    public function quoteSubmit(Request $request)
    {
        //--- Validation Section

        $rules =
        [
            'signature' => 'required',
            'vendor_id' => 'required',
            'request_id'=> 'required',
            'item_name'=> 'required',
            'item_price'=> 'required',
            'item_qty'=> 'required',
            'photo'=> 'required'
        ];


        $validator = Validator::make(Input::all(), $rules);
        
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        $file = $request->file('photo');
        if ($file) {
        $image = time().str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/images/documents', $image);
        }
        else {
            $image = NULL;
        }

        $file1 = $request->file('photo1');
        if ($file1  != '') {
        $image1 = time().str_replace(' ', '', $file1->getClientOriginalName());
        $file1->move('assets/images/documents', $image1);
        }
        else {
            $image1 = NULL;
        }
        
        $file2 = $request->file('photo2');
        if ($file2 != '') {
        $image2 = time().str_replace(' ', '', $file2->getClientOriginalName());
        $file2->move('assets/images/documents', $image2);
        }
        else {
            $image2 = NULL;
        }

        $file3 = $request->file('photo3');
        if ($file3 != '') {
        $image3 = time().str_replace(' ', '', $file3->getClientOriginalName());
        $file3->move('assets/images/documents', $image3);
        }
        else {
            $image3 = NULL;
        }

        $file4 = $request->file('photo4');
        if ($file4 != '') {
            $image4 = time().str_replace(' ', '', $file4->getClientOriginalName());
            $file4->move('assets/images/documents', $image4);
        }
        else {
            $image4 = NULL;
        }

         $insert = DB::table('postrequest_quotes')->insert(['user_id' => $request->vendor_id, 'postby_id' => $request->postby_id,'request_id' => $request->request_id, 'item_name' => $request->item_name, 
        'item_price' => $request->item_price, 'item_qty' => $request->item_qty, 'subtotal' => $request->subtotal, 'item_name1' => $request->item_name1, 'item_price1' => $request->item_price1, 'subtotal1' => $request->subtotal1,
        'item_qty1' => $request->item_qty1, 'item_name2' => $request->item_name2, 'item_price2' => $request->item_price2, 'subtotal2' => $request->subtotal2, 'item_qty2' => $request->item_qty2, 
        'shipping' => $request->shipping, 'taxes' => $request->taxes, 'total' => $request->total, 'quote_terms' => $request->quote_terms, 'signature' => $request->signature, 'photo' => $image, 'photo1' => $image1, 'photo2' => $image2, 'photo3' => $image3, 'photo4' => $image4, 'status' => 0]);
         
        if (!$insert) {
            return response()->json(array('errors' => [ 0 => 'insert error' ]));
        }
        else {
            
            return back()->with('success', 'You request was successfully submitted. Responses from Seller with Quotations will be directed to your Inbox');
        }

    }
    public function downloadfile($id, $id1)
    {
        $data = DB::table('PostRequest')->Where('request_id', $id)->get();
        //dd($data);
        $filepath = asset('assets/images/postrequest/') . "/" . $data[0]->$id1;
   
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        //header('Content-Length: ' . filesize($filepath));

        // Flush system output buffer
        flush(); 
        echo readfile($filepath).'<script> window.setTimeout("window.close()", 1000); </script>';
        
    }
    
}