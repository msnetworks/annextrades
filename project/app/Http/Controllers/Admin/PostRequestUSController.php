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

class PostRequestUSController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    

    //*** GET POST Rquirement
    public function postrequirement()
    {
        return view('admin.PostRequirementUS.index');
    }

    //*** JSON Request Post Requirement
    public function postrequirement_datatables()
    {
        $data = DB::table('PostRequest')->orderBy('id','desc')->get();
        $category = DB::table('categories')->orderBy('name','desc')->get();
        
        //--- Integrating This Collection Into Datatables
         return Datatables::of($data)
                            ->editColumn('name', function($data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="user/'.$data->user_id.'/show" target="_blank">'.sprintf("%'.08d",$data->user_id).'</a></small>';
                                
                                return  $name."<br>".$id;
                            })
                            ->editColumn('company_name', function($data) {
                                $company_name = mb_strlen(strip_tags($data->company_name),'utf-8') > 50 ? mb_substr(strip_tags($data->company_name),0,50,'utf-8').'...' : strip_tags($data->company_name);
                                return  $company_name;
                            })
                            ->editColumn('icon', function($data) {
                            if ($data->pri_gov == '0') {
                                    $company_name = '<button class="btn btn-primary">G</button>';
                            }
                            else {
                                $company_name = '<button class="btn btn-primary">P</button>';
                            }
                                return  $company_name;
                            })
                            ->editColumn('product_name', function($data) {
                                $product_name = mb_strlen(strip_tags($data->product_name),'utf-8') > 50 ? mb_substr(strip_tags($data->product_name),0,50,'utf-8').'...' : strip_tags($data->product_name);
                                $id = '<small>Deal No: <a href="'.route('viewquote', $data->request_id).'" target="_blank">'.sprintf("%'.08d",$data->request_id).'</a></small>';
                                
                                return  $product_name."<br>".$id;
                            })
                            ->editColumn('short_des', function($data) {
                                $short_des = mb_strlen(strip_tags($data->short_des),'utf-8') > 50 ? mb_substr(strip_tags($data->short_des),0,50,'utf-8').'...' : strip_tags($data->short_des);
                                return  $short_des;
                            })
                            ->editColumn('product_des', function($data) {
                                $product_des = mb_strlen(strip_tags($data->product_des),'utf-8') > 50 ? mb_substr(strip_tags($data->product_des),0,50,'utf-8').'...' : strip_tags($data->product_des);
                                return  $product_des;
                            })
                            ->editColumn('notify', function($data) {
                                $category = Category::get();
                                $notify = '<form id="categories'.$data->id.'" method="GET" action="'. route('admin-notification', ['id' => $data->id]) .'">
                                <input type="hidden" name="request_id" value="'.$data->request_id.'">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <select class="form-control" id="category'.$data->id.'" name="categories[]" multiple="multiple">
                                    ';
                                        foreach($category as $item){
                                            $c = DB::table('notification_categories')->where('request_id', $data->request_id)->where('category_id', $item->id)->get();
                                            if (count($c)) {
                                                $cat = "<option value='".$item->id."' selected>".$item->name."</option>";
                                            } else {
                                                $cat = "<option value='".$item->id."'>".$item->name."</option>";
                                            }
                                            
                                            $notify .= $cat;
                                        }
                                        $notify .= '</select><br>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div></form>
                                <script>
                                            $("#category").on("submit", function (e) {
                                                var data = $("#category'.$data->id.'").val();
                                                e.preventDefault();
                                                $.ajax({
                                                method: "POST",
                                                url: $(this).prop("action"),
                                                data: data, 
                                                dataType: "JSON",
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                success: function (data) {
                                                    if (data == 1) {
                                                    console.log(data);
                                                    alert(data.success[success]);
                                                    } else {
                                                    console.log(data);
                                                    if ((data.errors)) {
                                                        for (var error in data.errors) {
                                                        alert(data.errors[error]);
                                                        }
                                                    } else {
                                                        alert(data);
                                                    }
                                                    }
                                                }
                                            });
                                          
                                          });


                                            $(document).ready(function() {
                                                $(\'#category'.$data->id.'\').select2();
                                            });

                                        </script>
                                ';
                                $modal = '
                                <div class="modal fade" id="categ'.$data->id.'" tabindex="-1" role="dialog" aria-labelledby="categ'.$data->id.'Label" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="categ'.$data->id.'Label">Select Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        '.$notify.'
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
                                $categorydata = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categ'.$data->id.'">
                                Select Category
                              </button>'.$modal;
                                return  $categorydata;
                            })
                            ->editColumn('email', function($data) {
                                $email = mb_strlen(strip_tags($data->email),'utf-8') > 50 ? mb_substr(strip_tags($data->email),0,50,'utf-8').'...' : strip_tags($data->email);
                                
                                return  $email;
                            })
                            ->editColumn('phone', function($data) {
                                $phone = mb_strlen(strip_tags($data->phone),'utf-8') > 50 ? mb_substr(strip_tags($data->phone),0,50,'utf-8').'...' : strip_tags($data->phone);
                                return  $phone;
                            })
                            ->editColumn('price_range', function($data) {
                                if ($data->price_from == '0') {
                                    $price = 'N/A';
                                } else {
                                    $price = $data->price_from;
                                }
                                
                                return  $price;
                            })
                            ->editColumn('quote_nos', function($data) {
                                $query = DB::table('postrequest_quotes')->where('request_id', $data->request_id)->get();
                                $c = count($query);
                                $count = "<a class='text-center count_quote' href='".route('admin-post-quote', ['id' => $data->request_id])."'>".$c."</a>";
                                return  $count;
                            })
                            ->editColumn('mail', function($data) {
                                $mail = '<i class="fa fa-envelope"></i>'; 
                                return  $mail;
                            })
                            ->editColumn('view', function($data) {
                                $button = '<button class="btn btn-primary" data-toggle="modal" data-target="#Modal'.$data->id.'"><i class="fa fa-eye"></i></button>
                                            <a href="'.route('admin-postrequest-edit', $data->id).'"><button class="btn btn-info"><i class="fa fa-edit"></i></button></a>';
                            
                                            $ext = pathinfo($data->photo, PATHINFO_EXTENSION);
                                            $ext1 = pathinfo($data->photo1, PATHINFO_EXTENSION);
                                            $ext2 = pathinfo($data->photo2, PATHINFO_EXTENSION);
                                            $ext3 = pathinfo($data->photo3, PATHINFO_EXTENSION);
                                            $ext4 = pathinfo($data->photo4, PATHINFO_EXTENSION);
                                            header('Content-Type: application/octet-stream');
                                            if ($data->photo!="") {
                                                if ($ext == 'png' || $ext == 'PNG' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'jifi' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'JIFI') {
                                                    $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <img class='border' src='".asset('assets/images/postrequest/')."/".$data->photo ."' alt='Title'> </br>
                                                        </div>
                                                    </div>
                                                    </div>
                                                ";
                                                } else {
                                                    $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('admin-postrequest-download', ['id' => $data->request_id, 'id1' => 'photo'])."' style='font-size: 18px!important;'><b>Download<br> Document</b></a>
                                                    </div>";
                                                }
                                            }else{
                                                $photo = "";
                                            }
                                            if($data->photo1!="")
                                            {
                                                if ($ext1 == 'png' || $ext1 == 'PNG' || $ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'jifi' || $ext1 == 'JPG' || $ext1 == 'JPEG' || $ext1 == 'JIFI') {
                                                    $photo1 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <div class='row'>
                                                            <div class='col-md-12'>
                                                                <img class='border' src='".asset('assets/images/postrequest/')."/".$data->photo1 ."' alt='Title'> </br>
                                                            </div>
                                                        </div>
                                                    </div>";
                                                }else{
                                                    $photo1 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <a target='_blank' href='".route('admin-postrequest-download', ['id' => $data->request_id, 'id1' => 'photo1'])."'><h4><b>Download <br> Document</b></a><br>
                                                        </div>";
                                                    }
                                            }else{
                                                $photo1 = '';
                                            }
                                            if($data->photo2!=""){
                                                if ($ext2 == 'png' || $ext3 == 'PNG' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'jifi' || $ext2 == 'JPG' || $ext2 == 'JPEG' || $ext2 == 'JIFI') {
                                                    $photo2 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <div class='row'>
                                                            <div class='col-md-12'>
                                                                <img class='border' src='".asset('assets/images/postrequest/')."/".$data->photo2 ."' alt='Title'> </br>
                                                            </div>
                                                        </div>
                                                    </div>";
                                                }else{
                                                    $photo2 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('admin-postrequest-download', ['id' => $data->request_id, 'id1' => 'photo2'])."'><h4><b>Download <br> Document</b></a><br>
                                                     </div>";
                                                }
                                            }else{
                                                $photo2 = "";
                                            }
                                            if($data->photo3!="") {
                                                if ($ext3 == 'png' || $ext3 == 'PNG' || $ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'jifi' || $ext3 == 'JPG' || $ext3 == 'JPEG' || $ext3 == 'JIFI') {
                                                    $photo3 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <div class='row'>
                                                            <div class='col-md-12'><img class='border' src='".asset('assets/images/postrequest/')."/".$data->photo3 ."' alt='Title'> </br></div>
                                                        </div>
                                                    </div> ";
                                                }else{
                                                    $photo3 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('admin-postrequest-download', ['id' => $data->request_id, 'id1' => 'photo3'])."'><h4><b>Download <br> Document</b></a><br>
                                                        </div>";
                                                    }
                                            }else{
                                                $photo3 = "";
                                            }
                                             if($data->photo4!=""){
                                                if ($ext4 == 'png' || $ext4 == 'PNG' || $ext4 == 'jpg' || $ext4 == 'jpeg' || $ext4 == 'jifi' || $ext4 == 'JPG' || $ext4 == 'JPEG' || $ext4 == 'JIFI') {

                                                    $photo4 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <div class='row'>
                                                            <div class='col-md-12'><img class='border' src='".asset('assets/images/postrequest/')."/".$data->photo4 ."' alt='Title'> </br></div>
                                                        </div>
                                                    </div>";
                                                }else{
                                                    $photo4 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('admin-postrequest-download', ['id' => $data->request_id, 'id1' => 'photo4'])."'><h4><b>Download <br> Document</b></a><br>
                                                        </div>";
                                                    }
                                            }else{
                                                $photo4 = "";
                                            }
                                            if ($data->price_from == '0') {
                                                $price = 'N/A';
                                            } else {
                                                $price = $data->price_from;
                                            }
                                            if ($data->pri_gov == '0') {
                                                $dealtype = 'Government';
                                            }
                                            else {
                                                $dealtype = 'Private';
                                            }
                                $modal = "
                                    <div class='modal fade bd-example-modal-lg' id='Modal".$data->id."' tabindex='-1' role='dialog' aria-labelledby='Modal".$data->id."Label' aria-hidden='true'>
                                        <div class='modal-dialog  modal-lg' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>".$data->product_name."</h5>
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
                                                    <div class='col-md-12'>

                                                        <b>Deal Title: </b>".$data->product_name ." <br><br>
                                                        <b>Deal Type: </b> ". $dealtype ." <br><br>
                                                        <b>Company Name: </b>".$data->company_name ." <br><br>
                                                        <b>Company Address: </b>".$data->address . $data->city . $data->state . $data->country . $data->pincode ." <br><br>
                                                        <b>Contact Number: </b>".$data->phone ." <br><br>
                                                        <b>Price Range: </b>".$price ." <br><br>
                                                        <b>Deadline: </b>".$data->deadline ." <br><br>
                                                        <b>Status: </b>Open <br><br>
                                                        <b>Shortn Description: </b><p class='text-justify'>".html_entity_decode(htmlspecialchars_decode($data->short_des)) ."</p><br><br>
                                                        <b>Description: </b><p class='text-justify'>".html_entity_decode(htmlspecialchars_decode($data->product_des)) ."</p><br><br>
                                                    </div>    
                                                    <div class='col-md-12'>
                                                    <b>Photo </b><br><br>
                                                        <div class='row'>
                                                            ".$photo.$photo1.$photo2.$photo3.$photo4."
                                                        </div>
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
                                            
                                            pdf.save('ANNEXTRADES_".$data->product_name .".pdf');
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
                                    <option data-val="1" value="'. route('admin-postrequirement-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Accepted</option>
                                    <option data-val="0" value="'. route('admin-postrequirement-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Pending</option>
                                </select></div>';
                            })
                            ->addColumn('highlight', function($data) {
                                $class = $data->highlight == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->highlight == 1 ? 'selected' : '';
                                $ns = $data->highlight == 0 ? 'selected' : '';
                                return '<div class="action-list">
                                <select class="process select droplinks '.$class.'">
                                    <option data-val="1" value="'. route('admin-postrequirement-highlight',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Highlight</option>
                                    <option data-val="0" value="'. route('admin-postrequirement-highlight',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Not Highlight</option>
                                </select></div>';
                            })
                            ->addColumn('delete', function($data) {
                                $button = '<a href="'.route('deal-delete', $data->id).'"><button class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this deal?\');"><i class="fa fa-trash"></i></button></a>';
                                return $button;
                            })
                            ->rawColumns(['name', 'product_name', 'icon', 'notify','view','mail', 'quote_nos', 'status', 'highlight', 'delete'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function status($id1,$id2)
    {
        DB::table('PostRequest')->where('id', $id1)->update(['status' => $id2]);

        $data = DB::table('PostRequest')->where('id', $id1)->get();
        $gs = Generalsetting::findOrFail(1);
            if ($id2 == 1) {
                # code...
           
                if ($gs->is_verification_email == 1) {
                    $to = $data->email;
                    $subject = 'You have a new Quote Request.';
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
                                                                <h1 style='font-size: 24px; color: #292936 !important; margin: 0;' align='center'>Congrats! your request has been approved.</h1>
                                                                </td>
                                                            </tr>
                                                            <!--tr >
                                                                <td align='center' style='color: #292936; background: #ebebff; font-family: Arial, sans-serif;'>
                                                                    <h1 style='font-size: 20px; color: #292936 !important; margin: 0;' align='center'></h1>
                                                                </td>
                                                            </tr-->
                                                            <tr>
                                                                <td align='left' style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                                                    <p style='font-size: 16px; margin: 0;'>Hello ".$data->name." <br>
                                                                        Your request for ".$data[0]->product_name." has approved. We will try to give you a batter response for your requirement.
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
        //$data->status = $id2;
        //$data->update();
    }
    public function highlight($id1,$id2)
    {
        DB::table('PostRequest')->where('id', $id1)->update(['highlight' => $id2]);
    }

    public function qutoestatus($id1,$id2)
    {
        $data = DB::table('postrequest_quotes')->where('id', $id1)->update(['status' => $id2]);
        //$data->status = $id2;
        //$data->update();
    }

    public function quote()
    {
       //return view('admin.PostRquirement.quotes');
    }
    public function quotes($id)
    {   
       return view('admin.PostRquirement.quotes')->with('id', $id);
    }

    //*** JSON Request Post Requirement
    public function quotedatatables()
    {
        $data = DB::table('postrequirement_quote')->orderBy('id','desc')->get();
        $company = DB::table('users')->where('id', $data->user_id);
        $post_company = DB::table('PostRequest')->where('request_id', $data->request_id);
         //--- Integrating This Collection Into Datatables
         return Datatables::of($data)
                            ->editColumn('post By', function($post_company, $company) {
                                $name = mb_strlen(strip_tags($post_company->company_name),'utf-8') > 50 ? mb_substr(strip_tags($post_company->company_name),0,50,'utf-8').'...' : strip_tags($post_company->company_name);
                                $id = '<small>ID: <a href="'.route('viewquote', $post_company->request_id).'" target="_blank">'.sprintf("%'.08d",$post_company->request_id).'</a></small>';
                                return  $name.'<br>'.$id;
                            })
                            ->editColumn('quote_by', function($post_company, $company) {
                                $company_name = mb_strlen(strip_tags($company->shop_name),'utf-8') > 50 ? mb_substr(strip_tags($company->shop_name),0,50,'utf-8').'...' : strip_tags($company->shop_name);
                                return  $company_name;
                            })
                            ->rawColumns(['post_by', 'quote_by'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function add_new()
    {
        $all_categories = DB::table('categories_us')->orderBy('name','ASC')->get();
        $all_bookmarks = DB::table('bookmark_us')->orderBy('name','ASC')->get();
        //set_data
        $data['all_categories'] = $all_categories;
        $data['all_bookmarks'] = $all_bookmarks;
        return view('admin.PostRequirementUS.add_newquote', $data);
    }
    public function insert(Request $request)
    {   
      
        print_r($request);die;

        $insert = DB::table('GovernmentContracts')->insert(['user_id' => $request->user_id, 'request_id' => $request_id, 'product_name' => $request->product_name, 
        'company_name' => $request->company_name, 'product_des' => $request->product_des, 'short_des' => $request->short_des, 'pri_gov' => $request->pri_gov, 'price_from' => $request->price_from, 'photo' => $image, 'photo1' => $image1, 'photo2' => $image2, 'photo3' => $image3, 'photo4' => $image4, 'deadline' => $request->deadline, 'name' => $request->name,
         'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'city' => $request->city, 'pincode' => $request->pincode,
        'state' => $request->state, 'country' => $request->country, 'homepage' => $request->homepage, 'regions' => $request->regions, 'contact_regions' => $request->select_regions]);
        
        if (!$insert) {
            return back()->with('message', 'insert error');
        }
        else {
            /* $success = 'Success';
            echo $success; */
            return back()->with('message', 'You request was successfully submitted. Responses from Seller with Quotations will be directed to your Inbox.');
        }
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
    public function edit($id)
    {
        $data = DB::table('PostRequest')->where('id', $id)->get();
        return view('admin.PostRquirement.edit')->with('data', $data);
    }
    public function update(Request $request)
    {
        $file = $request->file('photo');
        if ($file) {
        $image = time().str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/images/postrequest',$image);
        }
        else {
            $image = $request->oldphoto;
        }

        $file1 = $request->file('photo1');
        if ($file1  != '') {
        $image1 = time().str_replace(' ', '', $file1->getClientOriginalName());
        $file1->move('assets/images/postrequest',$image1);
        }
        else {
            $image1 = $request->oldphoto;
        }
        
        $file2 = $request->file('photo2');
        if ($file2 != '') {
        $image2 = time().str_replace(' ', '', $file2->getClientOriginalName());
        $file2->move('assets/images/postrequest',$image2);
        }
        else {
            $image2 = $request->oldphoto;
        }

        $file3 = $request->file('photo3');
        if ($file3 != '') {
        $image3 = time().str_replace(' ', '', $file3->getClientOriginalName());
        $file3->move('assets/images/postrequest',$image3);
        } 
        else {
            $image3 = $request->oldphoto;
        }

        $file4 = $request->file('photo4');
        if ($file4 != '') {
            $image4 = time().str_replace(' ', '', $file4->getClientOriginalName());
            $file4->move('assets/images/postrequest',$image4);
        }
        else {
            $image4 = $request->oldphoto;
        }

        $update = DB::table('PostRequest')->where('id', $request->id)->update(['company_name' => $request->company_name, 'type' => $request->type, 
        'product_name' => $request->product_name, 'product_des' => $request->product_des, 'short_des' => $request->short_des, 'pri_gov' => $request->pri_gov, 'price_from' => $request->price_from, 'price_to' => $request->price_to,
        'deadline' => $request->deadline, 'name' => $request->name, 'address' => $request->address, 'city' => $request->city, 'state' => $request->state, 'pincode' => $request->pincode,
        'country' => $request->country, 'phone' => $request->phone, 'email' => $request->email, 'homepage' => $request->homepage, 'regions' => $request->regions, 'contact_regions' => $request->select_regions,
        'photo' => $image, 'photo1' => $image1, 'photo2' => $image2, 'photo3' => $image3, 'photo4' => $image4]);
         
        return back()->with('success', 'Update Successfully');
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
    public function delete($id)
    {
        DB::table('PostRequest')->where('id', $id)->delete();
        return back()->with('success', 'Successfully Deleted.');
    }
}
