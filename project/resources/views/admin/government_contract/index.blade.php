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
	table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before{
		left: -22px;
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
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                  @include('includes.admin.form-success')  

										<div class="table-responsiv">
											<table id="geniustable" class="table display responsive nowrap" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __("Notice ID") }}</th>
														<th>{{ __("Buyer") }}</th>
														<th class="none">{{ __("Description") }}</th>
														<th>{{ __("Location") }}</th>
														<th>{{ __("View/Edit") }}</th>
														<th>{{ __("Deadline") }}</th>
														<th>{{ __("Status") }}</th>
														<th>{{ __("Highlight") }}</th>
														<th>{{ __("Delete") }}</th>
														<th>{{ __("Title") }}</th>
														<th>{{ __("Contract Link") }}</th>
														<th>{{ __("Contact Officer Name") }}</th>
														<th>{{ __("Contact Officer Number") }}</th>
														<th>{{ __("Contact Officer Email") }}</th>
														<th>{{ __("Keywords") }}</th>
														<th class="none">{{ __("Create Date") }}</th>
														<th class="none">{{ __("Create Time") }}</th>
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

		$('#geniustable').DataTable({
			  ordering: false,
				processing: true,
				serverSide: true,
				ajax: '{{ route('admin-government-contract-list') }}', 
        columns: [
					{ data: 'notice_id'},
					{ data: 'buyer'},
					{ data: 'description'}, 
					{ data: 'state'},					
					{ data: 'view', searchable: false, orderable: false},
					{ data: 'deadline', searchable: false, orderable: false},
					{ data: 'status', searchable: false, orderable: false},
					{ data: 'highlight', orderable: false },
					{ data: 'delete', orderable: false },
					{ data: 'title', orderable: false },
					{ data: 'contract_link', orderable: false },
					{ data: 'contact_officer_name', orderable: false },
					{ data: 'contact_officer_number', orderable: false },
					{ data: 'contact_officer_email', orderable: false },
					{ data: 'keywords', orderable: false },
					{ data: 'create_date', orderable: false },
					{ data: 'create_time', orderable: false },
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
				drawCallback  : function( settings ) {
													$('.select').niceSelect();	
												}
      });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" href="{{route('admin-government-contract-add')}}">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New Quote") }}<span>'+
          '</a>'+
          '</div>');
      });											
									


{{-- DATA TABLE ENDS--}}


</script>



@endsection   