@extends('layouts.admin') 

@section('content')  
					@php
						$quote = DB::table('PostRequest')->where('request_id', $id)->get();
					@endphp
					<input type="hidden" id="headerdata" value="{{ __("POST REQUIREMENTS") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Requests") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-post-requirement') }}">{{ __("All Post Requirement") }}</a>
											</li>
											<li>
												<a href="javascript:;">{{ $quote[0]->product_name }} </a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="container">
								<div class="row">

									<div class="col-lg-4 quote-top"><b>Deal Code :</b> {{ $quote[0]->request_id }}</div>
									<div class="col-lg-4 quote-top"><b>Name :</b> {{ $quote[0]->product_name }}</div>
									<div class="col-lg-4 quote-top"><b>Price Range :</b> ${{ $quote[0]->price_from }} to ${{ $quote[0]->price_to }} </div>
									<div class="col-lg-4 quote-top"><b>Company Name :</b> {{ $quote[0]->company_name }}</div>
									<div class="col-lg-4 quote-top"><b>Contact Person :</b> {{ $quote[0]->name }}</div>
									<div class="col-lg-4 quote-top"><b>Email :</b> {{ $quote[0]->email }}</div>
									<div class="col-lg-4 quote-top"><b>Phone :</b> {{ $quote[0]->phone }}</div>
									<div class="col-lg-4 quote-top"><b>Dead Line :</b> {{ $quote[0]->deadline }}</div>
									<div class="col-lg-4 quote-top"><b>Added on :</b> {{ $quote[0]->created_at }}</div>
									
								</div>
								
							</div>
						</div><br>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        				@include('includes.admin.form-success')  

										<div class="table-responsiv">
											<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __("Q No.") }}</th>
														<th>{{ __("Seller") }}</th>
														<th>{{ __("Company") }}</th>
														<th>{{ __("Rating") }}</th>
														<th>{{ __("Q-Amount") }}</th>
														<th>{{ __("Attachment") }}</th>
														<th>{{ __("View Quote") }}</th>
														<th>{{ __("Status") }}</th>
													</tr>
												</thead>
												<tbody>
													@php
														$data = DB::table('postrequest_quotes')->where('request_id', $id)->orderBy('id','desc')->get();
														//dd($data);
														$i = 1;
														foreach ($data as $value) {

															$company = DB::table('users')->where('id', $value->user_id)->get();
															$post_company = DB::table('PostRequest')->where('request_id', $value->request_id)->get();
															
															$class = $value->status == 1 ? 'drop-success' : 'drop-danger';
																	$s = $value->status == 1 ? 'selected' : '';
																	$ns = $value->status == 0 ? 'selected' : '';

																	$ext = pathinfo($value->photo, PATHINFO_EXTENSION);
																	$ext1 = pathinfo($value->photo1, PATHINFO_EXTENSION);
																	$ext2 = pathinfo($value->photo2, PATHINFO_EXTENSION);
																	$ext3 = pathinfo($value->photo3, PATHINFO_EXTENSION);
																	$ext4 = pathinfo($value->photo4, PATHINFO_EXTENSION);
																	if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'jifi') {
																		$a = "<img class='' src='".asset('assets/images/documents/')."/".$value->photo."'>";
																	}else{
																		$a = "<iframe class='col-md-12 height-100' src='".asset('assets/images/documents/')."/".$value->photo."'></iframe>";
																	}
																	if ($ext1 == 'png' || $ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'jifi') {
																		$b = "<img class='' src='".asset('assets/images/documents/')."/".$value->photo1."'>";
																	}else{
																		$b = "<iframe class='col-md-12 height-100' src='".asset('assets/images/documents/')."/".$value->photo1."'></iframe>";
																	}
																	if ($ext2 == 'png' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'jifi') {
																		$c = "<img class='' src='".asset('assets/images/documents/')."/".$value->photo2."'>";
																	}else{
																		$c = "<iframe class='col-md-12 height-100' src='".asset('assets/images/documents/')."/".$value->photo2."'></iframe>";
																	}
																	if ($ext3 == 'png' || $ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'jifi') {
																		$d = "<img class='' src='".asset('assets/images/documents/')."/".$value->photo3."'>";
																	}else{
																		$d = "<iframe class='col-md-12 height-100' src='".asset('assets/images/documents/')."/".$value->photo3."'></iframe>";
																	}
																	if ($ext4 == 'png' || $ext4 == 'jpg' || $ext4 == 'jpeg' || $ext4 == 'jifi') {
																		$e = "<img class='' src='".asset('assets/images/documents/')."/".$value->photo4."'>";
																	}else{
																		$e = "<iframe class='col-md-12 height-100' src='".asset('assets/images/documents/')."/".$value->photo4."'></iframe>";
																	}
															$modal = "
															<div class='modal fade bd-example-modal-lg' id='Modal".$i."' tabindex='-1' role='dialog' aria-labelledby='Modal".$i."Label' aria-hidden='true'>
																<div class='modal-dialog  modal-lg' role='document'>
																	<div class='modal-content'>
																		<div class='modal-header'>
																			<h5 class='modal-title'>".$post_company[0]->product_name."</h5>
																			<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
																			<span aria-hidden='true'>&times;</span>
																			</button>
																		</div>
																		<div class='modal-body'>
																			<div class='deal-product row d-flex justify-content-center'>
																				<div class='col-md-11 quote-border p-15'>
																					<div class='row'>
																						<div class='col-md-6'>
																							<h5>Vendor</h5>
																							<div class='quote-border'>
																								<p class='quite-vendor-detail'>
																									".$company[0]->shop_name."<br>
																									".$company[0]->address."<br>
																									".$company[0]->shop_message."<br>
																								</p>
																							</div>
																						</div>
																						<div class='col-md-2'>
																						</div>
																						<div class='col-md-4'>
																							<div class='pb-15'>
																								<h5>Quote #</h5>
																								<form action='#' method='POST' id='quoteform'>
																									<input type='text' class='form-control' name='request_id' value='".$post_company[0]->request_id."' readonly>
																							</div>
																							<h5>Exp. Date #</h5>
																							<input type='text' class='form-control' value='".$post_company[0]->deadline."' readonly>
																						</div>
																						<div class='col-md-6 pt-15'>
																							<div class='pb-15'>
																								<h5>Buyer</h5>
																								<input type='text' class='form-control' value='".$post_company[0]->company_name."' readonly>
																							</div>
																						</div>
																						<div class='col-md-12'>
																							<div class='pb-15'>
																								<h5>Product or Services Description</h5>
																								<textarea type='text' class='form-control' rows='5' readonly>".$post_company[0]->product_des."</textarea>
																							</div>
																						</div>
																						<div class='col-md-12'>
																							<table class='table table-striped table-light'>
																								<thead>
																									<tr>
																										<th class='w-50' scope='col'>NAME</th>
																										<th scope='col'>PRICE</th>
																										<th scope='col'>QTY</th>
																										<th scope='col'>SUBTOTAL</th>
																									</tr>
																								</thead>
																								<tbody>
																									<tr>
																										<th scope='row'><input type='text' class='input-name' placeholder='Item Name' value='".$value->item_name."' readonly></th>
																										<td><input type='number' class='input-name' placeholder='0' min='0' name='item_price' value='".$value->item_price."' readonly></td>
																										<td><input type='number' class='input-name price' placeholder='0' min='0' name='item_qty' value='".$value->item_qty."' readonly></td>
																										<td><input type='number' class='input-name price subtotal' name='subtotal' value='".$value->subtotal."' readonly></td>
																									</tr>
																									<tr>
																										<th scope='row'><input type='text' class='input-name' placeholder='Item Name' value='".$value->item_name1."' readonly></th>
																										<td><input type='number' class='input-name' placeholder='0' min='0' name='item_price' value='".$value->item_price1."' readonly></td>
																										<td><input type='number' class='input-name price' placeholder='0' min='0' name='item_qty' value='".$value->item_qty1."' readonly></td>
																										<td><input type='number' class='input-name price subtotal' name='subtotal' value='".$value->subtotal1."' readonly></td>
																									</tr>
																									<tr>
																										<th scope='row'><input type='text' class='input-name' placeholder='Item Name' value='".$value->item_name2."' readonly></th>
																										<td><input type='number' class='input-name' placeholder='0' min='0' name='item_price' value='".$value->item_price1."' readonly></td>
																										<td><input type='number' class='input-name price' placeholder='0' min='0' name='item_qty' value='".$value->item_qty2."' readonly></td>
																										<td><input type='number' class='input-name price subtotal' name='subtotal' value='".$value->subtotal2."' readonly></td>
																									</tr>
																									<tr>
																										<th></th>
																										<th scope='row'>Shipping</th>
																										<td></td>
																										<td><input type='number' class='input-name shipping' name='shipping' value='".$value->shipping."' readonly></td>
																									</tr>
																									</tr>
																									<tr>
																										<td></td>
																										<th scope='row'>Taxes</th>
																										<td></td>
																										<td><input type='number' class='input-name taxes' name='taxes' value='".$value->taxes."' readonly></td>
																									</tr>
																									</tr>
																									<tr>
																										<td></td>
																										<th scope='row'>Total Cost</th>
																										<td></td>
																										<th scope='row'><input type='number' class='input-name input-name-total total text-bold' name='total' value='".$value->total."' readonly></th>
																									</tr>
																								</tbody>
																							</table>
																						</div>
																						<div class='col-md-12'>
																							<div class='pb-15'>
																								<h5>Quote Terms and Conditions</h5>
																								<textarea type='text' name='quote_terms' class='form-control' rows='5' readonly>".$value->quote_terms."</textarea>
																							</div>
																						</div>
																						<div class='col-md-8'>
																							<div class='row container'>
																								<div class='col-md-12 pt-15'>
																									<p>".$company[0]->shop_name."</p>
																								</div>
																								<div class='col-md-6 signature-dt'>
																									<input type='text' class='input-name' value='".$company[0]->name."' readonly>
																								</div>
																								<div class='col-md-6 signature-dt'>
																									<input type='text' class='input-name' value='".$post_company[0]->product_name."' readonly>
																								</div>
																							</div>
																						</div>
																						<div class='col-md-4 text-right'>
																							<h5 class='text-left'><b>E-Signature *</b></h5>
																							<div class='pb-15 d-flex justify-content-center signature'>
																								<span><font class='sig'>".$company[0]->name."</font><br><font class='text'>".$value->signature."</font></span>
																							</div>
																							<div class='d-flex justify-content-center signature-dt'>
																								<input type='text' class='input-name' value='".$value->created_at."' readonly>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class='modal-footer'>
																			<!-- <button type='button' class='btn btn-primary'>Save changes</button> -->
																			<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
																		</div>
																	</div>
																</div>
															</div>";
															$docu = "
															<div class='modal fade bd-example-modal-lg' id='docu".$i."' tabindex='-1' role='dialog' aria-labelledby='docu".$i."Label' aria-hidden='true'>
																<div class='modal-dialog  modal-lg' role='document'>
																	<div class='modal-content'>
																		
																		<div class='modal-header'>
																			<h5 class='modal-title'>Document Verification</h5>
																				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
																			<span aria-hidden='true'>&times;</span>
																			</button>
																		</div>
																		<div class='modal-body'>
																			<div class='deal-product row d-flex justify-content-center'>
																				<div class='col-md-11 quote-border p-15'>
																					<div class='row'>
																						<div class='col-md-12'>
																							<!--".$a.$b.$c.$d.$e."-->
																							<ul class='nav nav-tabs' id='myTab' role='tablist'>
																							<li class='nav-item'>
																								<a class='nav-link active' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Doc-1</a>
																							</li>
																							<li class='nav-item'>
																								<a class='nav-link' id='profile-tab' data-toggle='tab' href='#profile' role='tab' aria-controls='profile' aria-selected='false'>Doc-2</a>
																							</li>
																							<li class='nav-item'>
																								<a class='nav-link' id='contact-tab' data-toggle='tab' href='#contact' role='tab' aria-controls='contact' aria-selected='false'>Doc-3</a>
																							</li>
																							<li class='nav-item'>
																								<a class='nav-link' id='doc-4-tab' data-toggle='tab' href='#doc-4' role='tab' aria-controls='doc-4' aria-selected='false'>Doc-4</a>
																							</li>
																							<li class='nav-item'>
																								<a class='nav-link' id='doc-5-tab' data-toggle='tab' href='#doc-5' role='tab' aria-controls='doc-5' aria-selected='false'>Doc-5</a>
																							</li>
																						</ul>
																						<div class='tab-content' id='myTabContent'>
																						<div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>$a</div>
																						<div class='tab-pane fade' id='profile' role='tabpanel' aria-labelledby='profile-tab'>$b</div>
																						<div class='tab-pane fade' id='contact' role='tabpanel' aria-labelledby='contact-tab'>$c</div>
																						<div class='tab-pane fade' id='doc-4' role='tabpanel' aria-labelledby='doc-4-tab'>$d</div>
																						<div class='tab-pane fade' id='doc-5' role='tabpanel' aria-labelledby='doc-5-tab'>$e</div>
																						</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class='modal-footer'>
																			<!-- <button type='button' class='btn btn-primary'>Save changes</button> -->
																			<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
																		</div>
																	</div>
																</div>
															</div>";
															$status =  '<div class="action-list">
																			<select class="process select droplinks '.$class.'">
																				<option data-val="1" value="'. route('admin-postquote-status',['id1' => $value->id, 'id2' => 1]).'" '.$s.'>Accepted</option>
																				<option data-val="0" value="'. route('admin-postquote-status',['id1' => $value->id, 'id2' => 0]).'" '.$ns.'>Pending</option>
																			</select>
																		</div>';
															echo "
															<tr>
																<td>".$value->signature."</td>
																<td><a href='/admin/user/".$value->user_id."/show' target='_blank'>".$post_company[0]->name."</a></td><td><a href='/admin/user/".$value->user_id."/show' target='_blank'>".$post_company[0]->company_name."</a></td>
																<td></td>
																<td>".$value->total."</td>
																<td><a href='#' class='btn btn-primary' data-toggle='modal' data-target='#docu".$i."'>View</a>$docu</td>
																<td><a class='btn btn-primary' href='#' data-toggle='modal' data-target='#Modal".$i."'>View</a>$modal</td>
																<td>".$status."</td>
															</tr>";
															$i++;
														}
													@endphp		
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

@endsection    
