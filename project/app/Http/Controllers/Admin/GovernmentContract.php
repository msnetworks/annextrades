<?php
namespace App\Http\Controllers\Admin;

use App\Models\Childcategory;
use App\Models\Subcategory;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\PostRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use Datatables;
use Validator;
use Image;
use DB;

class GovernmentContract extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    

    //*** GET POST Rquirement
    public function index()
    {
        return view('admin.government_contract.index');
    }

    //*** JSON Request Post Requirement
    public function list()
    {
        ini_set('max_execution_time', 300);
        $data = DB::table('government_contracts')->orderBy('id','desc')->get();
        $category = DB::table('categories')->orderBy('name','asc')->get();
        //--- Integrating This Collection Into Datatables
         return Datatables::of($data)
                            ->editColumn('contract_link', function($data) {
                                $contract_link = '<a href="' . $data->contract_link . '">' . $data->contract_link . '&nbsp;<i class="fa fa-link"></i></a>';
                                return $contract_link;
                            })
                            ->editColumn('deadline', function($data) {
                                $deadline = date_create($data->deadline);
			                    $deadline = date_format($deadline, 'd-M-Y');
                                return $deadline;
                            })
                            ->editColumn('create_date', function($data) {
                                $create_date = date_create($data->create_date);
			                    $create_date = date_format($create_date, 'd-M-Y');
                                return $create_date;
                            })
                            ->editColumn('create_time', function($data) {
                                $create_time = date_create($data->create_time);
			                    $create_time = date_format($create_time, 'H:i:s');
                                return $create_time;
                            })
                            ->editColumn('view', function($data) {
                                $button = '<button class="btn btn-primary" data-toggle="modal" data-target="#Modal'.$data->id.'"><i class="fa fa-eye"></i></button>
                                            <a href="'.route('admin-government-contract-edit', $data->id).'"><button class="btn btn-info"><i class="fa fa-edit"></i></button></a>';
                            
                                            $deadline = date_create($data->deadline);
			                                $deadline = date_format($deadline, 'd-M-Y');

                                            $create_date = date_create($data->create_date);
			                                $create_date = date_format($create_date, 'd-M-Y');

                                            $create_time = date_create($data->create_time);
			                                $create_time = date_format($create_time, 'H:i:s');

                                            
                                $modal = "
                                    <div class='modal fade bd-example-modal-lg' id='Modal".$data->id."' tabindex='-1' role='dialog' aria-labelledby='Modal".$data->id."Label' aria-hidden='true'>
                                        <div class='modal-dialog  modal-lg' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>".$data->title."</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                <div class='col-md-12 text-right'>
                                                    <i class='fa fa-print' id='btn' value='Print' onclick='printDiv".$data->id."();' style='font-size: 32px;' title='Print Deal'></i>
                                                    &nbsp;&nbsp; 
                                                    <i style='font-size: 32px;' id='cmd".$data->id."' onclick='getPDF".$data->id."()' class='fa fa-download' title='Save as PDF'></i>
                                                </div>
                                                <div class='container canvas_div_pdf".$data->id."' id='Print".$data->id."'>
                                                <div class='deal-product row text-left' >
                                                    <div class='col-md-12' style='white-space: normal;'>

                                                        <b>Title: </b>".$data->title ." <br><br>
                                                        <b>Category: </b> ". $data->category_id ." <br><br>
                                                        <b>State: </b>".$data->state ." <br><br>
                                                        <b>Type: </b>".$data->type ." <br><br>
                                                        <b>Naic Code: </b>".$data->naic_code ." <br><br>
                                                        <b>Buyer: </b>".$data->buyer ." <br><br>
                                                        <b>Deadline: </b>".$deadline ." <br><br>
                                                        <b>Agency: </b>".$data->agency ." <br><br>
                                                        <b>Contract Link: </b>".$data->contract_link ." <br><br>
                                                        <b>Notice Id: </b>".$data->notice_id ." <br><br>
                                                        <b>Purchasing Department: </b>".$data->purchasing_department ." <br><br>
                                                        <b>Contact Officer Name: </b>".$data->contact_officer_name ." <br><br>
                                                        <b>Contact Officer Number: </b>".$data->contact_officer_number ." <br><br>
                                                        <b>Contact Officer Email: </b>".$data->contact_officer_email ." <br><br>
                                                        <b>Keywords: </b>".html_entity_decode(htmlspecialchars_decode($data->keywords))." <br><br>
                                                        <b>Status: </b>".$data->status ." <br><br>
                                                        <b>Highlight: </b>".$data->highlight ." <br><br>
                                                        <b>Create Date: </b>".$create_date ." <br><br>
                                                        <b>Create Time: </b>".$create_time ." <br><br>
                                                        <b>Status: </b>Open <br><br>
                                                        <b>Description: </b><p class='text-justify'>".html_entity_decode(htmlspecialchars_decode($data->description)) ."</p><br><br>
                                                    </div>    
                                                </div>
                                            </div>
                                            <div id='editor".$data->id."'></div>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button class='active btn btn-danger' id='btn' value='Print' onclick='printDiv".$data->id."();'>Print</button>
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    function printDiv".$data->id."() 
                                    {
                                    
                                      var divToPrint=document.getElementById('Print".$data->id."');
                                    
                                      var newWin=window.open('','Print-Window');
                                    
                                      newWin.document.open();
                                    
                                      newWin.document.write(`<html><body onload='window.print()'>` +divToPrint.innerHTML+ `</body></html>`);
                                    
                                      newWin.document.close();
                                    
                                      setTimeout(function(){newWin.close();},10);
                                    
                                    }

                                    </script>
                                    <script>
                                    function getPDF".$data->id."(){

                                        var HTML_Width = $('.canvas_div_pdf".$data->id."').width();
                                        var HTML_Height = $('.canvas_div_pdf".$data->id."').height();
                                        var top_left_margin = 15;
                                        var PDF_Width = HTML_Width+(top_left_margin*2);
                                        var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
                                        var canvas_image_width = HTML_Width;
                                        var canvas_image_height = HTML_Height;
                                        
                                        var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
                                        
                                
                                        html2canvas($('.canvas_div_pdf".$data->id."')[0],{allowTaint:true}).then(function(canvas) {
                                            canvas.getContext('2d');
                                            
                                            console.log(canvas.height+'  '+canvas.width);
                                            
                                            
                                            var imgData = canvas.toDataURL('image/jpeg', 1.0);
                                            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
                                            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                                            
                                            
                                            for (var i = 1; i <= totalPDFPages; i++) { 
                                                pdf.addPage(PDF_Width, PDF_Height);
                                                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                                            }
                                            
                                            pdf.save('ANNEXTRADES_".$data->id .".pdf');
                                        });
                                    };
                                    </script>
                                    ";
                                
                                    return  $button . $modal;
                            })
                            ->addColumn('status', function($data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list">
                                <select class="process select droplinks '.$class.'">
                                    <option data-val="1" value="'. route('admin-government-contract-change-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Accepted</option>
                                    <option data-val="0" value="'. route('admin-government-contract-change-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Pending</option>
                                </select></div>';
                            })
                            ->addColumn('highlight', function($data) {
                                $class = $data->highlight == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->highlight == 1 ? 'selected' : '';
                                $ns = $data->highlight == 0 ? 'selected' : '';
                                return '<div class="action-list">
                                <select class="process select droplinks '.$class.'">
                                    <option data-val="1" value="'. route('admin-government-contract-change-highlight',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Highlight</option>
                                    <option data-val="0" value="'. route('admin-government-contract-change-highlight',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Not Highlight</option>
                                </select></div>';
                            })
                            ->addColumn('delete', function($data) {
                                $button = '<a href="'.route('admin-government-contract-delete', $data->id).'"><button class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this deal?\');"><i class="fa fa-trash"></i></button></a>';
                                return $button;
                            })
                            ->rawColumns(['view','status','highlight', 'delete','contract_link'])
                            ->toJson();
    }

    public function change_status($id1,$id2)
    {
        DB::table('government_contracts')->where('id', $id1)->update(['status' => $id2]);
        return back()->with('message', 'Status succcessfully changed.');
    }
    public function change_highlight($id1,$id2)
    {
        DB::table('government_contracts')->where('id', $id1)->update(['highlight' => $id2]);
        return back()->with('message', 'Hightlight status successfully changed!');
    }

    public function add()
    {
        $all_categories = DB::table('categories_us')->orderBy('name','ASC')->get();
        $all_bookmarks = DB::table('bookmark_us')->orderBy('name','ASC')->get();
        //set_data
        $data['all_categories'] = $all_categories;
        $data['all_bookmarks'] = $all_bookmarks;
        return view('admin.government_contract.add', $data);
    }

    public function insert(Request $request)
    {   
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['bookmark_id'] = $request->bookmark_id;
        $data['state'] = $request->state;
        $data['type'] = $request->type;
        $data['naic_code'] = $request->naic_code;
        $data['description'] = $request->description;
        $data['buyer'] = $request->buyer;
        $data['deadline'] = $request->deadline;
        $data['agency'] = $request->agency;
        $data['contact_link'] = $request->contact_link;
        $data['notice_id'] = $request->notice_id;
        $data['purchasing_department'] = $request->purchasing_department;
        $data['contacting_officer_name'] = $request->contacting_officer_name;
        $data['contact_officer_number'] = $request->contact_officer_number;
        $data['contact_offiicer_email'] = $request->contact_offiicer_email;
        $data['keywords'] = $request->keywords;
        $data['create_date'] = date('Y-m-d');
        $data['create_time'] = date('H:i:s');
        $insert = DB::table('government_contracts')->insert($data);
        if (!$insert) {
            return back()->with('message', 'insert error');
        }
        else {            
            return back()->with('message', 'You request was successfully submitted.');
        }
    }


    public function import(){
        return view('admin.government_contract.import');
    }

    public function import_process(Request $request)
    {
        $log = "";
        //--- Validation Section
        $rules = [
            'csvfile'      => 'required|mimes:csv,txt',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $filename = '';
        if ($file = $request->file('csvfile'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            $file->move('assets/temp_files',$filename);
        }

        $datas = "";

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $i = 1;
        $already_exist = 0;
        while (($line = fgetcsv($file)) !== FALSE) {
            if($i != 1)
            {
                if(!empty($line)){
                    $contract_slug = str_slug($line[2]);
                    $contract_exist = DB::table('government_contracts')->where(['slug' => $contract_slug])->get()->first();
                    //check already exist
                    // if(empty($contract_exist)){
                    if(1){
                        //prepare category
                        $category_name = addslashes($line[0]);
                        $category_slug = str_slug($line[0]);
                        //check category exist
                        $category_exist = DB::table('categories_us')->where(['slug' => $category_slug])->get()->first();
                        if(empty($category_exist)){
                            //insert category into database
                            if(!empty($category_name)){
                                $new_category['name'] = $category_name;
                                $new_category['slug'] = $category_slug;
                                $category_id = DB::table('categories_us')->insert($new_category);
                                $data['category_id'] = $category_id;
                            }
                        } else {
                            $data['category_id'] = $category_exist->id;
                        }

                        $data['state'] = $line[1];
                        $title = $line[2];
                        $data['title'] = addslashes($title);
                        $data['slug'] = str_slug($line[2]);
                        $data['type'] = $line[3];
                        $data['naic_code'] = addslashes($line[4]);
                        $data['buyer'] = addslashes($line[5]);                
                        $deadline = date_create($line[6]);
                        $data['deadline'] = date_format($deadline, 'Y-m-d');
                        $data['agency'] = addslashes($line[7]);
                        $data['contract_link'] = $line[8];
                        $data['notice_id'] = addslashes($line[9]);
                        $data['purchasing_department'] = $line[10];
                        $data['contact_officer_name'] = $line[11];
                        $data['contact_officer_number'] = $line[12];
                        $data['contact_officer_email'] = $line[13];
                        $data['keywords'] = $line[14];
                        $data['special_category'] = $line[15];
                        $data['create_date'] = date('Y-m-d');
                        $data['create_time'] = date('h:i:s');
                        $description = $this->remove_emoji($line[16]);
                        $data['description'] = addslashes($description);
                        $contract_id = DB::table('government_contracts')->insert($data);
                    } else {
                        $already_exist++;
                    }
                }
            }
            $i++;
        }
        fclose($file);
        //--- Redirect Section
        $msg = 'Successfully Imported!';
        return response()->json($msg);
    }


    public function remove_emoji($string) {

        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $string);
    
        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);
    
        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);
    
        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);
    
        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);
    
        return $clear_string;
    }



    public function edit($id)
    {
        $all_categories = DB::table('categories_us')->orderBy('name','ASC')->get();
        $all_bookmarks = DB::table('bookmark_us')->orderBy('name','ASC')->get();
        $details = DB::table('government_contracts')->where('id', $id)->get()->first();

        //set_data
        $data['all_categories'] = $all_categories;
        $data['all_bookmarks'] = $all_bookmarks;
        $data['details'] = $details;
        
        return view('admin.government_contract.edit',$data);
    }

    public function update(Request $request)
    {        
        $data['type'] = $request->type;
        $data['category_id'] = $request->category_id;
        $data['naic_code'] = $request->naic_code;
        $data['description'] = $request->description;
        $data['buyer'] = $request->buyer;
        $data['deadline'] = $request->deadline;
        $data['agency'] = $request->agency;
        $data['contract_link'] = $request->contract_link;
        $data['notice_id'] = $request->notice_id;
        $data['purchasing_department'] = $request->purchasing_department;
        $data['contact_officer_name'] = $request->contact_officer_name;
        $data['contact_officer_number'] = $request->contact_officer_number;
        $data['contact_officer_email'] = $request->contact_officer_email;
        $data['keywords'] = $request->keywords;
        $update = DB::table('government_contracts')->where('id', $request->id)->update($data);
        return back()->with('message', 'Update Successfully');
    }

    public function delete($id)
    {
        DB::table('government_contracts')->where('id', $id)->delete();
        return back()->with('message', 'Successfully Deleted.');
    }

    public function notification(Request $request, $id)
    {   
        $inputs = $request->all();
        
        $category = $inputs['categories'];
        foreach ($category as $categories) {

            DB::table('notification_categories')->insert(['request_id' => $request->request_id, 'category_id' => $categories]);
            $category = DB::table('products')->where('category_id', $categories)->get();
            $data = DB::table('users')->where('id', $category[0]->user_id)->get();
            $gs = Generalsetting::findOrFail(1);
                if ($gs->is_verification_email == 1) {
                    $to = $data[0]->email;
                    $subject = 'We have a deal related to your products.';
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
                                                                <h1 style='font-size: 24px; color: #292936 !important; margin: 0;' align='center'>Deal Offer.</h1>
                                                                </td>
                                                            </tr>
                                                            <!--tr >
                                                                <td align='center' style='color: #292936; background: #ebebff; font-family: Arial, sans-serif;'>
                                                                    <h1 style='font-size: 20px; color: #292936 !important; margin: 0;' align='center'></h1>
                                                                </td>
                                                            </tr-->
                                                            <tr>
                                                                <td align='left' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                                                    <p style='font-size: 16px; margin: 0;'>Hello ".$data[0]->name." <br>
                                                                        We have a deal related to your products please check the deals on Deals Bulletin.
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
            } 
            
            return back();
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
