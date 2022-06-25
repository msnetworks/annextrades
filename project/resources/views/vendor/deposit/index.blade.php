@extends('layouts.vendor') 

@section('content')  
                    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">My Sales</h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">My Sales</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-area">
                            <div class="row">
                                <div class="col-lg-12">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title" >
									{{ $langg->lang824 }}
									<a class="mybtn1" href="{{route('vendor-deposit-create')}}"> <i class="fas fa-plus"></i> {{ $langg->lang821 }}</a>
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang825 }}</th>
														<th>{{ $langg->lang332 }}</th>
														<th>{{ $langg->lang334 }}</th>
														<th>{{ $langg->lang335 }}</th>
													</tr>
												</thead>
												<tbody>
                            @foreach(Auth::user()->deposits as $data)
                                <tr>
                                    <td>{{date('d-M-Y',strtotime($data->created_at))}}</td>
                                    <td>{{$data->method}}</td>
                                    <td>{{$data->currency_code}}{{ round($data->amount * $data->currency_value, 2) }}</td>
                                    <td>{{ $data->status == 1 ? 'Completed' : 'Pending'}}</td>
                                </tr>
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
