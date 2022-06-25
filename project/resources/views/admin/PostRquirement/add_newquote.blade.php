@extends('layouts.admin') 

@section('content')
<style>
	table.dataTable tbody td {
		padding: 5px!important;
	}
</style> 
<style>
    .dvImages1 {
        float: right;
        width: 100px;
        height: 100px;
        border: 1px solid green;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

					<input type="hidden" id="headerdata" value="{{ __("POST YOUR REQUIREMENTS") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Add New Post") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-post-requirement') }}">{{ __("All Requests") }} </a>
											</li>
											<li>
												<a href="#">{{ __("Add New Request") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-12 border" style="padding: 15px;">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12" style="padding: 0px 0px 15px 15px;">
                                                            <img class="border" src="{{ asset('assets/front/images/posturreq.png') }}" width="100%" alt="Post your Requirement">
                                                        </div>
                                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12" style="padding: 30px;">
                                                            <i class="fa fa-graduation-cap aws-blue"></i> Connecting Buyers with the right Sellers to meet required demands <br><br>
                                                            <i class="fa fa-users aws-blue"></i> Variety of Manufacturer, Exporters and Suppliers across hundreds of product categories <br><br>
                                                            <i class="fa fa-envelope aws-blue"></i> Direct communication between parties through our user dashboard <br>
                                                        </div>
                                                    </div>
                                                        @if(session()->has('message'))
                                                            <div class="alert alert-success">
                                                                {{ session()->get('message') }}
                                                            </div>
                                                        @endif
                                                        {{-- @include('includes.admin.form-login') --}}
                                                        <form id="postdata" action="{{route('admin-addnew-insert')}}" method="POST" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <!-- /resources/views/post/create.blade.php -->
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul>
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>{{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                    <!-- Create Post Form -->
                                                                    {{csrf_field()}}
                                                                    <div class="form-input col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"> 
                                                                        <label for="companyname"><span class="astrick">*</span> Your Company Name</label>
                                                                        <input type="text" name="company_name" class="form-control" id="companyname" value="{{ Auth::user()->shop_name }}" required=""> </br>
                                                                        <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required=""> 
                                                                    </div>
                                                                    <br/>
                                                                    <div class="form-input col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"> 
                                                                        <label for="cover_image_category"><span class="astrick">*</span>Cover Image Category</label>
                                                                        <select class="form-control select2" name="cover_image_category" id="cover_image_category">
                                                                            <option value="">--Select Cover Image Category--</option>
                                                                            <?php foreach($all_category as $category): ?>
                                                                            <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <br/>
                                                                    <div class="form-input col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"> 
                                                                        <label for="type"><span class="astrick">*</span> Type</label><br>
                                                                        <label for="products"> Products</label>
                                                                        <input type="radio" name="type" id="products" value="Products" checked> &nbsp;&nbsp;
                                                                        <label for="services"> Services</label>
                                                                        <input type="radio" name="type" id="services" value="services"></br></br>
                                                                    </div>
                                                                    <div class="form-input col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"> 
                                                                        <label for="type"><span class="astrick">*</span> Private/Government</label><br>
                                                                        <label for="private"> Private</label>
                                                                        <input type="radio" name="pri_gov" id="private" value="1" > &nbsp;&nbsp;
                                                                        <label for="government"> Government</label>
                                                                        <input type="radio" name="pri_gov" id="government" value="0" checked></br></br>
                                                                    </div>
                                                                    <div class="form-input col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="productname"><span class="astrick">*</span> What product or service do you seek?</label>
                                                                        <input type="text" name="product_name" class="form-control" id="productname" placeholder="{{  __('e.g. I need 10,000 T-shirt with custom paint.') }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="describe"><span class="astrick">*</span> Short Description</label>
                                                                        <textarea name="short_des" class="form-control" placeholder="{{ __('Short description about product..') }}" cols="30" rows="7"></textarea> <br>
                                                                    </div>
                                                                    <div class="form-input col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="describe"><span class="astrick">*</span> Detail Description</label>
                                                                        <textarea name="product_des" class="form-control" id="describe" placeholder="{{ __('Quantity, specification, sizes, timeline, delivery location, price range.') }}" cols="30" rows="7"></textarea> <br>
                                                                        <script>
                                                                            CKEDITOR.replace( 'describe' );
                                                                        </script>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="pricerange"><span class="astrick">*</span> Price Range ($)</label><br>
                                                                        <input type="text" class="form-control" name="price_from" id="*price-min" placeholder="e.g. $10 - $15 or N/A">
                                                                        {{-- <div class="d-flex justify-content-center row" style="padding: 15px;">
                                                                            <div class="col-2 text-center">Price Detail</div> 
                                                                            <div class="col-2 text-center">To</div> 
                                                                            <input type="number" class="form-control col-4" name="price_to" id="price-max" value="0" min="0">
                                                                            <input type="number" class="form-control col-4" name="price_to" id="price-max" value="0" min="0">

                                                                        </div> --}}<br>
                                                                            <script>
                                                                                $("#price-min").change(function(){
                                                                                    var x = $("#price-min").val();
                                                                                    var y = x + 1;
                                                                                    $('#price-max').attr('min', x);
                                                                                });
                                                                         </script>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="deadline"><span class="astrick">*</span> Dead Line</label>
                                                                        <input type="datetime-local" name="deadline" class="form-control" id="deadline" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <div id="inputFormRow">
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="photo" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                                                                                {{-- <div class="input-group-append">
                                                                                    <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                                                                </div> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div id="newRow"></div>
                                                                        <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>

                                                                    <div class="form-input col-12 mt-15">
                                                                        <p class="modal-title post-req-title"> Your Contact Details</p>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="productname"><span class="astrick">*</span> Your Name</label>
                                                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                                                        <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="address"><span class="astrick">*</span> Address</label>
                                                                        <textarea type="text" name="address" rows="5" class="form-control" id="address" required="">{{ Auth::user()->address }}</textarea></br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                                                        <label for="city"><span class="astrick">*</span> City</label>
                                                                        <input type="text" name="city" class="form-control" id="city" value="{{ Auth::user()->city }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                                                        <label for="pincode"><span class="astrick">*</span> Zip/ Postal Code</label>
                                                                        <input type="number" name="pincode" class="form-control" id="pincode" value="{{ Auth::user()->zip }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                                                        <label for="state"><span class="astrick">*</span> State</label>
                                                                        <input type="text" name="state" class="form-control" id="state" value="{{ Auth::user()->state }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                                                        <label for="country"><span class="astrick">*</span> Country</label>
                                                                        <select name="country" class="form-control" id="country">
                                                                            <option class="placeholder" value="">Select Country</option>
                                                                            @foreach (DB::table('countries')->get() as $data)
                                                                            <option value="{{ $data->country_name }}" {{ $data->country_name == Auth::user()->country ? 'selected' : '' }}>
                                                                                {{ $data->country_name }}
                                                                            </option>		
                                                                         @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-input col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="Phone"><span class="astrick">*</span> Phone Number</label>
                                                                        <input type="tel" name="phone" class="form-control" minlength="10" maxlength="15" value="{{ Auth::user()->phone }}" id="Phone" placeholder="{{ __('e.g. 919055509190') }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="email"><span class="astrick">*</span> Email</label>
                                                                        <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required=""> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                                        <label for="homepage"> Company Website</label>
                                                                        <input type="homepage" name="homepage" class="form-control" id="homepage"> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                                        <label for="regions"> What is the best time and number to reach you with qualified sellers?</label>
                                                                        <input type="regions" name="regions" class="form-control" id="regions"> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                                        <label for="select_regions"> Do you have a preferred region for seller?</label>
                                                                        <input type="select_regions" name="select_regions" class="form-control" id="select_regions"> </br>
                                                                    </div>
                                                                    <div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"></div>
                                                                    <div class="col-sm-8">
                                                                        <button type="submit" class="mybtn1 postsubmit">{{ __('SUBMIT') }}</button></br> 
                                                                    </div>
                                    
                                                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="submit-loader d-none">
                                                        <img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
                                                    </div>
                                                    <div id="track-order">
                                                    </div>
                                                </div>
                                            </div>
                                    
                                          </div>
                                    
                                        </div>
                                      </div>
								</div>
							</div>
						</div>
					</div>

@endsection    



@section('scripts')
<script type="text/javascript">
    // add row
        var id = 1;
    

    $("#addRow").click(function () {
        
            var showId = $(":file").length;
            if(showId <= 4)
            {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group mb-3">';
                html += '<input type="file" name="photo'+showId+'" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
                html += '<div class="input-group-append">';
                html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                html += '</div>';
                html += '</div>';

                $('#newRow').append(html);
            }
            if(showId == 4)
            {   
                $("#addRow").hide();
            }

    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
        $("#addRow").show();
    });
</script>
@endsection   