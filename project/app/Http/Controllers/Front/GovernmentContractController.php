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

class GovernmentContractController extends Controller
{
    public function index()
    {   
        $all_categories = DB::table('categories_us')->orderBy('display_name','asc')->get()->toArray();
        $all_special_categories = DB::table('government_contracts')
                                    ->select('special_category')
                                    ->distinct('special_category')
                                    ->get()->toArray();
        $all_states = DB::table('government_contracts')
                        ->select('state')
                        ->distinct('state')
                        ->get()->toArray();
        $data['all_categories'] = $all_categories;
        $data['all_special_categories'] = $all_special_categories;
        $data['all_states'] = $all_states;
        return view('front.governmentcontract', $data);
    }

    public function list(Request $request) 
    {

        $query = DB::table('government_contracts');

        if(!empty($request->keyword)){
            $query->where('keywords', 'LIKE', "%{$request->keyword}%"); 
            $query->orwhere('title', 'LIKE', "%{$request->keyword}%");
            $query->orWhere('description', 'LIKE', "%{$request->keyword}%"); 
            $query->orWhere('buyer', 'LIKE', "%{$request->keyword}%"); 
            $query->orWhere('agency', 'LIKE', "%{$request->keyword}%"); 
            $query->orWhere('notice_id', 'LIKE', "%{$request->keyword}%"); 
        }

        if(!empty($request->type)){
            $types = explode(',',$request->type);
            if(!(in_array('local', $types) && in_array('federal', $types))){
                if(in_array('local', $types)){
                    $query->where('type', '=', "State/Local"); 
                }
                if(in_array('federal',$types)){
                    $query->where('type', '=', "Federal"); 
                }
            }
        }
        
        if(!empty($request->category_id)){
            if($request->category_id != 'all'){
                $query->where('category_id', '=', $request->category_id); 
            }
        } else {
            $query->where('category_id', '=', 44); 
        }
        if(!empty($request->naic_code)){
            $query->where('naic_code', '=', $request->naic_code); 
        }

        if(!empty($request->refine)){
            $refines = explode(",",$request->refine);
            $query->whereIn('special_category',$refines); 
            $refines = explode(',',$request->refine);
            if(in_array('favourite',$refines)){
                $favorite_ids = array();
                $favorites = DB::table('favourite_govt_contracts')->where('user_id', Auth::user()->id)->get();
                foreach($favorites as $fav){
                    array_push($favorite_ids, $fav->request_id);
                }
                $query->whereIn('id',$favorite_ids); 
            }
        }
        
        if(!empty($request->states)){
            $states = explode(",",$request->states);
            $query->whereIn('state',$states); 
        }

        $query->where('status','=',1);
        $data = $query->orderBy('id','desc')->get();
        
        $category = DB::table('categories')->orderBy('name','desc')->get();

        //--- Integrating This Collection Into Datatables
         return Datatables::of($data)
                            ->addColumn('star', function($data) {
                                if(Auth::guard('web')->check()){
                                    $user_id = Auth::user()->id;
                                    $favData = DB::table('favourite_govt_contracts')
                                    ->where('request_id', $data->id)
                                    ->where('user_id', $user_id)
                                    ->get();
                                    if (count($favData) == 1) {
                                        $fav = "<span value='favourite' class='btn btn-sm btn-warning removefav' data-id='$data->id'><i class='fa fa-star-o'></i></span>";
                                    }
                                    else {
                                        $fav = "<button class='btn btn-sm btn-light addfav' data-id='$data->id'><i class='fa fa-star-o'></i></button>";
                                    }
                                }
                                else {
                                    $fav = "<button class='btn btn-sm btn-light addfav' data-id='$data->id'><i class='fa fa-star-o'></i></button>";
                                }
                                return $fav;
                                //return '<div class="action-list"><form class="'.$data->request_id.'"><input type="hidden" value="'.$data->request_id.'"><input type="hidden" value="'.$data->request_id.'"><button onclick="myFunction()" class="star-submit" ><i class="fa fa-star-o"></i></button></form></div>';
                            })
                            ->editColumn('description', function($data) {
                                $user = Auth::user();
                                if(empty($user)){
                                    $link = '<a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">View More</a>';
                                } else {
                                    $link = '<a href="government-contract-details/'. $data->id .'"><b>View More</b></a>';
                                }
                                $description = mb_strlen(strip_tags($data->description),'utf-8') > 50 ? mb_substr(strip_tags($data->description),0,50,'utf-8').'...' . $link : strip_tags($data->description);                        
                                return  html_entity_decode(($description));
                            })
                            ->editColumn('view', function($data) {
                                $button = '<button class="btn btn-primary" ><i class="fa fa-eye"></i></button>
                                            <a href="'.route('admin-postrequest-edit', $data->id).'"><button class="btn btn-info"><i class="fa fa-edit"></i></button></a>';
                                return $button;
                            })
                            ->editColumn('deadline', function($data) {
                                $deadline = date_create($data->deadline);
			                    $deadline = date_format($deadline, 'M-d-Y');
                                return $deadline;
                            })
                            ->editColumn('title', function($data) {
                                $user = Auth::user();
                                if(empty($user)){
                                    $title = '<a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg" style="color:blue;"><b>'. $data->title .'</b></a>';
                                } else {
                                    $title = '<a href="government-contract-details/'. $data->id .'" style="color:blue;"><b>'. $data->title .'</b></a>';
                                }
                                return $title;
                            })
                            ->addColumn('delete', function($data) {
                                $button = '<a href="'.route('admin-government-contract-delete', $data->id).'"><button class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this deal?\');"><i class="fa fa-trash"></i></button></a>';
                                return $button;
                            })
                            ->rawColumns(['view','status','highlight', 'description', 'delete','star','title'])
                            ->toJson();
    }

    public function details($id = NULL){
        $details = DB::table('government_contracts')->find($id);
        $data['details'] = $details;
        return view('front.government_contract_details', $data);
    }

    public function count_favourite()
    {
        if(Auth::guard('web')->check()){
        $count_fav = DB::table('favourite_govt_contracts')->where('user_id', Auth::user()->id)->count();
        return response()->json($count_fav);
        }
    }

    public function add_favourite(Request $request)
    {   
        if (DB::table('favourite_govt_contracts')->where('user_id', $request->user_id)->where('request_id', $request->request_id)->count() == 0) {   
            $insert = DB::table('favourite_govt_contracts')->insert(['request_id' => $request->request_id, 'user_id' => $request->user_id]);
        }
        return response()->json(1);
    }

    public function remove_favourite(Request $request)
    {
        DB::table('favourite_govt_contracts')->where('request_id', $request->request_id)->where('user_id', $request->user_id)->delete();
        return response()->json(1);
    }
}
