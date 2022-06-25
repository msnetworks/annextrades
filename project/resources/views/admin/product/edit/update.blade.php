@extends('layouts.admin') 
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

@endsection
@section('content')  
					<input type="hidden" id="headerdata" value="{{ __("PRODUCT") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Products") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ __("Products") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-prod-index') }}">{{ __("All Products") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>

						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __("Name") }}</th>
									                        <th>{{ __("Price") }}</th>
									                        <th>{{ __("Stock") }}</th>
									                        <th>{{ __("Details") }}</th>
									                        <th>{{ __("Update") }}</th>
														</tr>
													</thead>
                                                    <tbody>
                                                        @php
                                                            $item = DB::table('products')->get();
                                                            foreach ($item as $key => $value) {
                                                                echo "
                                                                    <tr>
                                                                       
                                                                        <td> <form><input type='text' name='name' value='".$value->name."'></td>
                                                                        <td><input type='number' name='price' value='".$value->price."'></td>
                                                                        <td><input type='number' name='stock' value='".$value->stock."'></td>
                                                                        <td><div class='text-editor'>
                                                                            <textarea name='details' class='nic-edit-p'>".$value->details."</textarea>
                                                                        </div></td>
                                                                        <td><input type='submit' name='submit' value='UPDATE'></form></td>
                                                                        
                                                                    </tr>";
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



@section('scripts')




@endsection   