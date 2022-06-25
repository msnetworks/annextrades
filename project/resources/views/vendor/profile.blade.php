@extends('layouts.vendor')
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ $langg->lang434 }}</h4>
											<ul class="links">
												<li>
													<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
												</li>
												<li>
													<a href="{{ route('vendor-profile') }}">{{ $langg->lang434 }} </a>
												</li>
											</ul> 
									</div>
								</div>
							</div>
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description"> 
											<div class="body-area" id="modalEdit">

				                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
											<form id="geniusform" action="{{ route('vendor-profile-update') }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}} 

                      						 		@include('includes.vendor.form-both') 
													<div class="row">
														<div class="col-lg-7"></div>
														<div class="col-lg-4 text-right">
															<div class="upload-img">
																@if($data->is_provider == 1)
																	<div class="img">
																		<img class="w-100" src="{{ $data->photo ? asset($data->photo):asset('assets/images/'.$gs->user_image) }}">
																	</div>
																@else
																	<div class="img">
																		<img class="w-100" src="{{ $data->photo ? asset('assets/images/users/'.$data->photo):asset('assets/images/'.$gs->user_image) }}">
																	</div>
																@endif
																@if($data->is_provider != 1)
																	<div class="file-upload-area">
																		<label for="upload" class="upload-file">
																			<input type="file" name="photo" id="upload" class="upload">
																			<span>{{ $langg->lang263 }}</span>
																		</label>
																	</div>
																@endif
															</div> 
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">Name *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input type="text" class="input-field" name="name" placeholder="{{ $langg->lang264 }}" required="" value="{{ $data->name }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">Email *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input type="email" class="input-field" name="email" placeholder="{{ $langg->lang265 }}" required="" value="{{ $data->email }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ $langg->lang266 }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input type="text" class="input-field" name="phone" placeholder="{{ $langg->lang266 }}" required="" value="{{ $data->phone }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ $langg->lang267 }}</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input type="text" class="input-field" name="fax" placeholder="{{ $langg->lang267 }}" value="{{ $data->fax }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">Country *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<select class="input-field" name="country">
																<option value="">{{ $langg->lang157 }}</option>
																@php
																	$country = DB::table('countries')->get();
																@endphp
																@foreach ($country as $val)
																	<option value="{{ $val->country_name }}" {{ $data->country == $val->country_name ? 'selected' : '' }}>
																		{{ $val->country_name }}
																	</option>		
																 @endforeach
															</select>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ $langg->lang830 }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input name="state" type="text" class="input-field"
																placeholder="{{ $langg->lang830 }}" value="{{ $data->state }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ $langg->lang268 }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input name="city" type="text" class="input-field"
																placeholder="{{ $langg->lang268 }}" value="{{ $data->city }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ $langg->lang269 }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input name="zip" type="text" class="input-field" placeholder="{{ $langg->lang269 }}" value="{{ $data->zip }}">
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ $langg->lang270 }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<textarea class="input-field" name="address" required=""
																placeholder="{{ $langg->lang270 }}">{{ $data->address }}</textarea>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ __('Company Name') }}: </h4>
															</div>
														</div>
														<div class="col-lg-7">
															<div class="right-area">
																	<h6 class="heading"> {{ $data->shop_name }}
																		@if($data->checkStatus())
																		<a class="badge badge-success verify-link" href="javascript:;">{{ $langg->lang783 }}</a>
																		@else
																		<span class="verify-link"><a href="{{ route('vendor-verify') }}">{{ $langg->lang784 }}</a></span>
																		@endif
																	</h6>
															</div>
														</div>
													</div>
											

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Owner Name') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="owner_name" placeholder="{{ __('Owner Name') }}" required="" value="{{$data->owner_name}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Number') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_number" placeholder="{{ __('Number') }}" required="" value="{{$data->shop_number}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Company Address') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_address" placeholder="{{ __('Company Address') }}" required="" value="{{$data->shop_address}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Company URL') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="reg_number" placeholder="{{ __('Company URL') }}" value="{{$data->reg_number}}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Business Type') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<select type="select" name="business_type" id="business_type" class="input-field">
															<option value="">--Select Option--</option>
															<option value="Manufacturer">Manufacturer</option>
															<option value="Buying Office">Buying Office</option>
															<option value="Distributor">Distributor</option>
															<option value="Services">Services</option>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Number of Employees') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" min="0" class="input-field" name="no_employees" placeholder="{{ __('Number of Employees') }}" value="{{$data->no_employees}}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Target Markets') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<select name="target_market" id="target_market" class="input-field">
															<option value="">--Select Option--</option>
															<option value="North America">North America</option>
															<option value="South America">South America</option>
															<option value="Eastern Europe">Eastern Europe</option>
															<option value="Southease Asia">Southease Asia</option>
															<option value="Africa">Africa</option>
															<option value="Oceania">Oceania</option>
															<option value="Middle East">Middle East</option>
															<option value="Eastern Aisa">Eastern Aisa</option>
															<option value="Western Europe">Western Europe</option>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Total Annual Volume') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" min="0" class="input-field" name="annual_volume" placeholder="{{ __('Total Annual Volume') }}" value="{{$data->annual_volume}}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Export Percentage') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" min="0" class="input-field" name="export_percentage" placeholder="{{ __('Export Percentage') }}" value="{{$data->export_percentage}}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Monthly Capacity') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" min="0" class="input-field" name="monthly_capacity" placeholder="{{ __('Monthly Capacity') }}" value="{{$data->monthly_capacity}}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Facility Capacity') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" min="0" class="input-field" name="facility_capacity" placeholder="{{ __('Facility Capacity') }}" value="{{$data->facility_capacity}}">
													</div>
												</div>
												{{-- <div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Facility Capacity') }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="checkbox" class="input-field" name="facility_capacity" placeholder="{{ __('Facility Capacity') }}" value="HACCP">
													</div>
												</div> --}}
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Company Description') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<textarea class="input-field nic-edit" name="shop_details" placeholder="{{ __('Company Description') }}">{{$data->shop_details}}</textarea>
													</div>
												</div>

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ $langg->lang464 }}</button>
						                          </div>
						                        </div>

											</form>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
<script>
	// IMAGE UPLOADING :)

	$(".upload").on( "change", function() {
        var imgpath = $(this).parent().parent().prev().find('img');
        var file = $(this);
        readURL(this,imgpath);
      });

      function readURL(input,imgpath) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                imgpath.attr('src',e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      // IMAGE UPLOADING ENDS :)
</script>

@endsection