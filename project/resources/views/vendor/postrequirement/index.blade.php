@extends('layouts.vendor')
@section('content')


<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                    <h4 class="heading">Post Requirement</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                        </li>
                        <li>
                            <a href="{{ route('vendor-postrequest') }}">Post Requirement</a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>

<section class="product-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title">
									Post Requirement
                                </h4>
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
								<div class="table-responsiv">
                                    <table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Product Name</th>
                                                <th>Post On</th>
                                                <th>View</th>
                                                <th>Quotes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $data = DB::table('PostRequest')->where('user_id', Auth::user()->id)->get();
                                                $i = 1;
                                            @endphp
                                            @foreach($data as $conv)
                                                @php
                                                $count = DB::table('postrequest_quotes')->where('request_id', $conv->request_id)->where('status', '1')->count();

                                                $ext = pathinfo($conv->photo, PATHINFO_EXTENSION);
                                            $ext1 = pathinfo($conv->photo1, PATHINFO_EXTENSION);
                                            $ext2 = pathinfo($conv->photo2, PATHINFO_EXTENSION);
                                            $ext3 = pathinfo($conv->photo3, PATHINFO_EXTENSION);
                                            $ext4 = pathinfo($conv->photo4, PATHINFO_EXTENSION);
                                            header('Content-Type: application/octet-stream');
                                            if ($conv->photo!="") {
                                                if ($ext == 'png' || $ext == 'PNG' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'jifi' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'JIFI') {
                                                    $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <img class='border w-100' src='".asset('assets/images/postrequest/')."/".$conv->photo ."' alt='Title'> </br>
                                                                </div>
                                                            ";
                                                } else {
                                                    $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('front-postrequest-download', ['id' => $conv->request_id, 'id1' => 'photo'])."' style='font-size: 18px!important;'><b>Download<br> Document</b></a>
                                                    </div>";
                                                }
                                            }else{
                                                $photo = "";
                                            }
                                            if($conv->photo1!="")
                                            {
                                                if ($ext1 == 'png' || $ext1 == 'PNG' || $ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'jifi' || $ext1 == 'JPG' || $ext1 == 'JPEG' || $ext1 == 'JIFI') {
                                                    $photo1 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <img class='border w-100' src='".asset('assets/images/postrequest/')."/".$conv->photo1 ."' alt='Title'> </br>
                                                            </div>";
                                                }else{
                                                    $photo1 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <a target='_blank' href='".route('front-postrequest-download', ['id' => $conv->request_id, 'id1' => 'photo1'])."'><h4><b>Download <br> Document</b></a><br>
                                                        </div>";
                                                    }
                                            }else{
                                                $photo1 = '';
                                            }
                                            if($conv->photo2!=""){
                                                if ($ext2 == 'png' || $ext3 == 'PNG' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'jifi' || $ext2 == 'JPG' || $ext2 == 'JPEG' || $ext2 == 'JIFI') {
                                                    $photo2 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                    <img class='border w-100' src='".asset('assets/images/postrequest/')."/".$conv->photo2 ."' alt='Title'> </br>
                                                                </div>";
                                                }else{
                                                    $photo2 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('front-postrequest-download', ['id' => $conv->request_id, 'id1' => 'photo2'])."'><h4><b>Download <br> Document</b></a><br>
                                                     </div>";
                                                }
                                            }else{
                                                $photo2 = "";
                                            }
                                            if($conv->photo3!="") {
                                                if ($ext3 == 'png' || $ext3 == 'PNG' || $ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'jifi' || $ext3 == 'JPG' || $ext3 == 'JPEG' || $ext3 == 'JIFI') {
                                                    $photo3 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <img class='border w-100' src='".asset('assets/images/postrequest/')."/".$conv->photo3 ."' alt='Title'> </br></div>
                                                        </div> ";
                                                }else{
                                                    $photo3 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('front-postrequest-download', ['id' => $conv->request_id, 'id1' => 'photo3'])."'><h4><b>Download <br> Document</b></a><br>
                                                        </div>";
                                                    }
                                            }else{
                                                $photo3 = "";
                                            }
                                             if($conv->photo4!=""){
                                                if ($ext4 == 'png' || $ext4 == 'PNG' || $ext4 == 'jpg' || $ext4 == 'jpeg' || $ext4 == 'jifi' || $ext4 == 'JPG' || $ext4 == 'JPEG' || $ext4 == 'JIFI') {

                                                    $photo4 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                        <img class='border w-100' src='".asset('assets/images/postrequest/')."/".$conv->photo4 ."' alt='Title'> </br></div>
                                                        </div>";
                                                }else{
                                                    $photo4 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                    <a target='_blank' href='".route('front-postrequest-download', ['id' => $conv->request_id, 'id1' => 'photo4'])."'><h4><b>Download <br> Document</b></a><br>
                                                        </div>";
                                                    }
                                            }else{
                                                $photo4 = "";
                                            }
                                                    $modal = "
                                                        <div class='modal fade bd-example-modal-lg' id='Modal".$conv->id."' tabindex='-1' role='dialog' aria-labelledby='Modal".$conv->id."Label' aria-hidden='true'>
                                                            <div class='modal-dialog  modal-lg' role='document'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <h5 class='modal-title'>".$conv->product_name."</h5>
                                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                        <span aria-hidden='true'>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                    <div class='container'>
                                                                    <div class='deal-product row'>
                                                                        <div class='col-md-12'>
                                                                            <b>Title: </b>".$conv->product_name ." <br><br>
                                                                            <b>Price Range: </b>$".$conv->price_from ." to $".$conv->price_to ." <br><br>
                                                                            <b>Deadline: </b>".date('m-d-Y H:i:s', strtotime($conv->deadline)) ." <br><br>
                                                                            <b>Status: </b>Open <br><br>
                                                                            <b>Description: </b><p class='text-justify'>". html_entity_decode(htmlspecialchars_decode($conv->product_des)) ."</p><br><br>
                                                                            
                                                                        </div>    
                                                                        <div class='col-md-12'>
                                                                        <b>Photo </b><br><br>
                                                                            <div class='row'>
                                                                                ".$photo.$photo1.$photo2.$photo3.$photo4."
                                                                            </div>
                                                                        </div>
                                                                        <div class='col-md-12 button-section'>
                                                                            <!--a href='".route('submitquote', $conv->request_id) ."'><button value='active' class='active btn btn-danger'>Submit Quote</button></a-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    </div>
                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>";
                                                        echo $modal;
                                                @endphp
                                                <tr class="conv">
                                                <input type="hidden" value="{{$conv->id}}">
                                                <td>{{$conv->id}}</td>
                                                <td width="30%">{{$conv->product_name}}</td>
                                                <td>{{ date('m-d-Y H:i:s', strtotime($conv->created_at))}}</td>
                                                <td>
                                                    <a ahref="#" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $conv->id }}" style="color: #fff"><i class="fa fa-eye"></i></a> &nbsp;
                                                    <a href="{{ route('vendor-postrequest-edit', $conv->id) }}" class="btn btn-primary" ><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td class="text-center"><a class="text-center count_quote btn btn-primary" href="{{ route('vendor-postrequest-quote', $conv->request_id) }}">{{ $count }}</a></td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection
