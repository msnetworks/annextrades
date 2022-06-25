@extends('layouts.admin') 

@section('content')  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
	table td{
		font-size: 13px !important;
	}
	table td button{
		font-size: 13px!important;
	}
	table.dataTable tbody td {
		padding: 5px!important;
	}
	.select2{ 
		width: 100%!important;
	}
</style>

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
												<a href="javascript:;">{{ __("Requests") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-prod-index') }}">{{ __("All Requests") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							@if(session()->has('message'))
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-success">
											{{ session()->get('message') }}
									</div>
								</div>
							</div>	
							@endif
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
                    					@include('includes.admin.form-success')  
										<div class="table-responsiv">
											<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __("Name") }}</th>
														<th>{{ __("Company Name") }}</th>
														<th>{{ __("Product Name") }}</th>
														<th>{{ __("P/G") }}</th>
														{{-- <th>{{ __("Price Range") }}</th> --}}
														<th>{{ __("Notify") }}</th>
														<th>{{ __("View/Edit") }}</th>
														<th>{{ __("Quotes") }}</th>
														<th>{{ __("Status") }}</th>
														<th>{{ __("Highlight") }}</th>
														<th>{{ __("Delete") }}</th>
														<th>{{ __("") }}</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

@endsection    



@section('scripts') 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
{{-- DATA TABLE --}}
	
    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-post-requirement-datatables') }}', 
               columns: [
				   { data: 'name', name: 'Name' },
				   { data: 'company_name', name: 'Company Name' },
				   { data: 'product_name', class: '' }, 
				   { data: 'icon', class: '' }, 
				   { data: 'notify', name: 'Notify' },
				   { data: 'view', name:'view'},
				   { data: 'quote_nos', name: 'Quotes Nos'},
				   { data: 'status', searchable: false, orderable: false},
				   { data: 'highlight', searchable: false, orderable: false},
				   { data: 'delete', orderable: false },
				   { data: 'mail', orderable: false }

				], 
				columnDefs: [
					{
					targets: 5,
					className: 'quote-column5'
					}
				],
                language : {
					processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
					$('.select').niceSelect();	
				}
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" href="{{route('admin-addnew')}}">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New Quote") }}<span>'+
          '</a>'+
          '</div>');
      });											
									

</script>



@endsection   