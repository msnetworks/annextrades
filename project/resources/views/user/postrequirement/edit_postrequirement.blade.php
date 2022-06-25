@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
            <div class="user-profile-details">
                <div class="row justify-content-center">
                    <div class="order-history col-lg-12 border" style="padding: 15px;">
                        <div class="container">
                            <div class="header-area">
                                <h4 class="title">
                                    Edit Post Requirement
                                </h4>
                            </div>
                            @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                {{-- @include('includes.admin.form-login') --}}
                                <form id="postdata" action="{{route('user-postrequest-update')}}" method="POST" enctype="multipart/form-data">
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
                                            <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"> 
                                                <label for="companyname"><span class="astrick">*</span> Your Company Name</label>
                                                <input type="text" name="company_name" class="form-control" id="companyname" value="{{ $data[0]->company_name }}" required=""> </br>
                                                <input type="hidden" name="id" value="{{ $data[0]->id }}" required=""> 
                                            </div>
                                            <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"> 
                                                <label for="type"><span class="astrick">*</span> Type</label><br>
                                                <label for="products"> Products</label>
                                                <input type="radio" name="type" id="products" value="Products" @if ($data[0]->type == 'Products') checked @endif> &nbsp;&nbsp;
                                                <label for="services"> Services</label>
                                                <input type="radio" name="type" id="services" value="services"  @if ($data[0]->type == 'services') checked @endif></br></br>
                                            </div>
                                            <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="productname"><span class="astrick">*</span> What product or service do you seek?</label>
                                                <input type="text" name="product_name" class="form-control" id="productname" placeholder="{{  __('e.g. I need 10,000 T-shirt with custom paint.') }}" value="{{ $data[0]->product_name }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="describe"><span class="astrick">*</span> Detail Description</label>
                                                <textarea name="product_des" class="form-control nic-edit-p" id="describe" placeholder="{{ __('Quantity, specification, sizes, timeline, delivery location, price range.') }}" cols="30" rows="7"> {!! $data[0]->product_des !!} </textarea> <br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
            
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="pricerange"><span class="astrick">*</span> Price Range ($)</label><br>
                                                <div class="d-flex justify-content-center row" style="padding: 15px;">
                                                    <div class="col-2 text-center">From</div> 
                                                    <input type="number" class="form-control col-4" name="price_from" id="price-min" value="{{ $data[0]->price_from }}" min="0">
                                                    <div class="col-2 text-center">To</div> 
                                                    <input type="number" class="form-control col-4" name="price_to" id="price-max" value="{{ $data[0]->price_to }}" min="0">
                                                </div><br>
                                                    <script>
                                                        $("#price-min").change(function(){
                                                            var x = $("#price-min").val();
                                                            var y = x + 1;
                                                            $('#price-max').attr('min', x);
                                                        });
                                                 </script>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="deadline"><span class="astrick">*</span> Dead Line</label>
                                                <input type="datetime-local" name="deadline" class="form-control" id="deadline" value="{{ $data[0]->deadline }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <label for="photos"> Images/File Upload</label><br>
                                                    <div class="row">                                                                     
                                                @php
                                                    $ext = pathinfo($data[0]->photo, PATHINFO_EXTENSION);
                                                    $ext1 = pathinfo($data[0]->photo1, PATHINFO_EXTENSION);
                                                    $ext2 = pathinfo($data[0]->photo2, PATHINFO_EXTENSION);
                                                    $ext3 = pathinfo($data[0]->photo3, PATHINFO_EXTENSION);
                                                    $ext4 = pathinfo($data[0]->photo4, PATHINFO_EXTENSION);
                                                    if($data[0]->photo!="")
                                                    {
                                                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'jifi') {
                                                        $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                            <div class='row'>
                                                                <div class='col-md-12'>
                                                                    <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo ."' alt='Title'> </br>
                                                                </div>
                                                                <div class='col-md-12'>
                                                                    <input type='hidden' name='oldphoto' value='".$data[0]->photo."'/>
                                                                    <input class='form-control' type='file' name='photo'/>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        ";
                                                        echo $photo;
                                                    }else{
                                                        $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                            <a href='".asset('assets/images/documents/')."/".$data[0]->photo."' style='font-size: 18px!important;'><b>Download <br> Document</b></a>
                                                            <input type='hidden' name='oldphoto' value='".$data[0]->photo."'/><br>
                                                            <input class='form-control' type='file' name='photo'/>
                                                            </div>";
                                                        echo $a;
                                                    }
                                                    }
                                                    if($data[0]->photo1!="")
                                                    {
                                                        if ($ext1 == 'png' || $ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'jifi') {
                                                            $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <div class='row'>
                                                                    <div class='col-md-12'>
                                                                        <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo1 ."' alt='Title'> </br>
                                                                    </div>
                                                                    <div class='col-md-12'>
                                                                        <input type='hidden' name='oldphoto1' value='".$data[0]->photo1."'/>
                                                                        <input class='form-control' type='file' name='photo1'/>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            ";
                                                            echo $photo;
                                                        }else{
                                                            $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <a href='".asset('assets/images/documents/')."/".$data[0]->photo1."'><h4>Download</a><br>
                                                                    <input type='hidden' name='oldphoto1' value='".$data[0]->photo1."'/>
                                                                    <input class='form-control' type='file' name='photo1'/>
                                                            </div>";
                                                            echo $a;
                                                        }
                                                    }
                                                    if($data[0]->photo2!="")
                                                    {
                                                        if ($ext2 == 'png' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'jifi') {
                                                            $photo2 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <div class='row'>
                                                                    <div class='col-md-12'>
                                                                        <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo2 ."' alt='Title'> </br>
                                                                    </div>
                                                                    <div class='col-md-12'>
                                                                        <input type='hidden' name='oldphoto2' value='".$data[0]->photo2."'/>
                                                                        <input class='form-control' type='file' name='photo2'/>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            ";
                                                            echo $photo2;
                                                        }else{
                                                            $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <a href='".asset('assets/images/documents/')."/".$data[0]->photo2."'><h4>Download</a><br>
                                                                    <input type='hidden' name='oldphoto2' value='".$data[0]->photo2."'/>
                                                                        <input class='form-control' type='file' name='photo2'/>
                                                                </div>";
                                                            echo $a;
                                                        }
                                                    }
                                                    if($data[0]->photo3!="")
                                                    {
                                                        if ($ext3 == 'png' || $ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'jifi') {
                                                            $photo3 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <div class='row'>
                                                                    <div class='col-md-12'>
                                                                        <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo3 ."' alt='Title'> </br>
                                                                    </div>
                                                                    <div class='col-md-12'>
                                                                        <input class='form-control' type='file' name='photo3'/>
                                                                        <input type='hidden' name='oldphoto3' value='".$data[0]->photo3."'/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            ";
                                                            echo $photo3;
                                                        }else{
                                                            $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <a href='".asset('assets/images/documents/')."/".$data[0]->photo3."'><h4>Download</a></br>
                                                                    <input type='hidden' name='oldphoto3' value='".$data[0]->photo3."'/>
                                                                    <input class='form-control' type='file' name='photo3'/>
                                                                </div>";
                                                            echo $a;
                                                        }
                                                    }
                                                    if($data[0]->photo4!="")
                                                    {
                                                        if ($ext4 == 'png' || $ext4 == 'jpg' || $ext4 == 'jpeg' || $ext4 == 'jifi') {
                                                            $photo4 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <div class='row'>
                                                                    <div class='col-md-12'>
                                                                        <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo4 ."' alt='Title'> </br>
                                                                    </div>
                                                                    <div class='col-md-12'>
                                                                        <input type='hidden' name='oldphoto4' value='".$data[0]->photo4."'/>
                                                                        <input class='form-control' type='file' name='photo4'/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            ";
                                                            echo $photo4;
                                                        }else{
                                                            $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                                                <a href='".asset('assets/images/documents/')."/".$data[0]->photo4."'><h4>Download</a></br>
                                                                <input type='hidden' name='oldphoto4' value='".$data[0]->photo4."'/>
                                                                <input class='form-control' type='file' name='photo4'/>
                                                                </div>"
                                                                ;
                                                            echo $a;
                                                        }
                                                    }
                                                @endphp 
                                                </div>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-12 mt-15">
                                                <p class="modal-title post-req-title"> Your Contact Details</p>
                                                <hr>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="productname"><span class="astrick">*</span> Your Name</label>
                                                <input type="hidden" value="{{ $data[0]->id }}" name="user_id">
                                                <input type="text" name="name" class="form-control" id="name" value="{{ $data[0]->name }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="address"><span class="astrick">*</span> Address</label>
                                                <textarea type="text" name="address" rows="5" class="form-control" id="address" required="">{{ $data[0]->address }}</textarea></br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="city"><span class="astrick">*</span> City</label>
                                                <input type="text" name="city" class="form-control" id="city" value="{{ $data[0]->city }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="pincode"><span class="astrick">*</span> Zip/ Postal Code</label>
                                                <input type="number" name="pincode" class="form-control" id="pincode" value="{{ $data[0]->pincode }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="state"><span class="astrick">*</span> State</label>
                                                <input type="text" name="state" class="form-control" id="state" value="{{ $data[0]->state }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="country"><span class="astrick">*</span> Country</label>
                                                <select name="country" class="form-control" id="country">
                                                    <option class="placeholder" value="">Select Country</option>
                                                    @foreach (DB::table('countries')->get() as $cntry)
                                                        <option value="{{ $cntry->country_name }}" @if($data[0]->country == $cntry->country_name) selected @endif>
                                                            {{ $cntry->country_name }}
                                                        </option>		
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-input col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="Phone"><span class="astrick">*</span> Phone Number</label>
                                                <input type="tel" name="phone" class="form-control" minlength="10" maxlength="15" value="{{ $data[0]->phone }}" id="Phone" placeholder="{{ __('e.g. 919055509190') }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="email"><span class="astrick">*</span> Email</label>
                                                <input type="email" name="email" class="form-control" id="email" value="{{ $data[0]->email }}" required=""> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="homepage"> Company Website</label>
                                                <input type="homepage" name="homepage" class="form-control" id="homepage" value="{{ $data[0]->homepage }}"> </br>
                                            </div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="regions"> What is the best time and number to reach you with qualified sellers?</label>
                                                <input type="regions" name="regions" class="form-control" id="regions" value="{{ $data[0]->regions }}"> </br>
                                            </div>
                                            <div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"></div>
                                            <div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                <label for="select_regions"> Do you have a preferred region for seller?</label>
                                                <input type="select_regions" name="select_regions" class="form-control" id="select_regions" value="{{ $data[0]->contact_regions }}"> </br>
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
</section>

@endsection