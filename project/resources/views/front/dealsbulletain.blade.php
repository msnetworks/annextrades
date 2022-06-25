@extends('layouts.front')


@section('content')
 
<style>
    table{
        font-size: 13px;
    }
</style>
<link rel="stylesheet" href="https://github.com/downloads/lafeber/world-flags-sprite/flags32.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" src="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>
<style>
    tr td.details-control {
      background: url('https://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
      cursor: pointer;
    }
    tr.dt-hasChild td.details-control {
      background: url('https://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
    table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
    }
</style>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area lr-30" style="padding-top: 5px; padding-bottom: 5px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <ul class="pages" style="padding-top: 17px;">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }} 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('deals-bulletain') }}">
                            {{ __('Deals Bulletin') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 deals-instruction order-2 order-sm-2 order-md-1 order-lg-1">
                <h4>&nbsp;Instructions...</h4>
                &nbsp;<i class="fa-solid fa-circle-info" style="color: #62bdeb;"></i> To learn more how our system works,<a target="_blank" href="https://annextrades.com/howitworks">click here</a>  for HOW IT WORKS
            </div>
            <div class="col-lg-2 deals-instruction align-text-bottom order-4 order-sm-4 order-md-1 order-lg-1">
                <h4>&nbsp</h4>
                <img src="{{ asset('assets/images/plus-icon.png') }}" alt="" width="16px">&nbsp;&nbsp; View More Details
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
    <section class="deals-section lr-30" style="padding-top: 0px;!important">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="title-dealbulletain">
                    <div class="row deal-title">
                        <div class="col-sm-6 col-lg-2 dealsbulletain-title p-0"  style="padding-top: 15px;">Deals Bulletin &nbsp;&nbsp; <i class="fa fa-star"></i> 
                            @if(!Auth::guard('web')->check())
                            (0)
                            @else 
                                <span id="fav-count"></span>
                            @endif 
                        </div>
                        <div class="col-sm-6 col-lg-2 p-0">
                            @if(!Auth::guard('web')->check())
                                <a href="{{ route('user.login') }}" class="v-center">
                                    <span>{{ $langg->lang12 }}</span> <span>|</span>
                                    <span>{{ $langg->lang13 }}</span>
                                </a>
                                @else
                                
                                    <div class="dropdown v-center">
                                        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text">
                                                <i class="far fa-user"></i>Hi,	{{ Auth::user()->name }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('user-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
                                        @if (Auth::user()->is_vendor) 
                                        <a class="dropdown-item" href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('user-profile') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
                                        <a class="dropdown-item" href="{{ route('user-logout') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
                                        </div>
                                    </div>
                            @endif
                        </div>
                        <div class="col-sm-12 col-lg-6 deals-instruction order-3 order-sm-3 order-md-1 order-lg-1">
                            <i class="fas fa-cog" style="color: #000000;"></i> To <b>Submit Quote</b>, user must Sign In. If you are not a member <a href="javascript:;" data-toggle="modal" data-target="#vendor-login">Join Now</a> and register as Vendor. <br> 
                            <i class="fas fa-file-alt" style="color: #be6161;"></i> What is include in Full Description of <b>Private</b> or <b><i>U.S.</i> Government Contract Opportunity? <a href="#sample">Click Here</a></b>  to View Sample <br>
                            <div class="col-lg-12 text-center">
                                <button onclick="window.HubSpotConversations.widget.open();" class="initial-message-bubble" 
                                style="background-color: rgb(255, 255, 255); border: 0;" aria-label="Open live chat" aria-haspopup="false"><div alt="Open live chat">
                                    <img src="{{ asset('assets/images/flag/livechat.png') }}" style="height: 70px;" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 deals-instruction order-5 order-sm-5 order-md-1 order-lg-1">
                            &nbsp;&nbsp;&nbsp;<i class="fa fa-star"></i> Add to My Favorite Deals <br>
                            &nbsp;&nbsp;&nbsp;<b>P</b>&nbsp;&nbsp;= Private Contract Opportunities <br>
                            &nbsp;&nbsp;&nbsp;<b>G</b>&nbsp;&nbsp;= Government Contract Opportunities <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <font class="border bid-class">
                                Deals search
                            </font>
                            <hr style="margin-top: 0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Area Start -->
    <section class="user-dashbord">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="order-2 order-sm-2 order-md-1 order-lg-1 col-xl-2 col-lg-2 col-md-12">
                    <div class="row sorting mb-5">
                        <div class="col-12">
                            <a class="btn btn-light">
                                <i class="fas fa-filter mr-2"></i> FILTER
                            </a>
                            <div class="btn-group float-md-right">
                                <a class="btn btn-light"><span class="fa fa-gear mr-2"></span> <span class="fa fa-caret-down"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 order-md-1 col-lg-12 sidebar-filter">
                        <h6 class="text-uppercase font-weight-bold mb-3">SELECTED</h6>
                        <div class="mt-2 mb-2 pl-2">
                            <p><b>Status</b></p>
                            <div class="custom-control">
                                <span id="factive"></span>
                                <span id="fmyfav"></span>
                            </div>
                        </div>
                        
                        <div class="mt-2 mb-2 pl-2">
                            <p><b>Register Buyer</b></p>
                            <div class="custom-control ">
                                <i class="fa fa-times-circle"></i>
                                <label class="" for="category-1">Yes</label>
                            </div>
                        </div>
                        <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
                        <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">Refine</h6>
                        <div class="mt-2 mb-2 pl-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="myfav" id="filter-size-1">
                                <label class="custom-control-label" for="filter-size-1">MY FAVORITE DEALS</label>
                            </div>  
                        </div>
                        <div class="mt-2 mb-2 pl-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="hidden" id="filter-size-2">
                                <label class="custom-control-label" for="filter-size-2">MY HIDDEN DEALS</label>
                            </div>
                        </div>
                        <div class="mt-2 mb-2 pl-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="active" id="filter-size-3">
                            <label class="custom-control-label" for="filter-size-3">ACTIVE</label>
                        </div>
                        </div>
                        <div class="mt-2 mb-2 pl-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="filter-size-4">
                            <label class="custom-control-label" for="filter-size-4">VERIFIED BUYERS</label>
                        </div>
                        </div>
                         <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
                        {{-- <a href="#" class="btn btn-lg btn-block btn-danger mt-5">SUBMIT SEARCH</a> --}}
                    </div>
                </div>
                <div class="order-1 order-sm-1 order-md-2 order-lg-2 col-xl-10 col-lg-10 col-md-12">
                    <div >
                        <table id="datatable" class="display nowrap" cellspacing="0" width="100%">
                            <thead class="thead">
                                <tr>
                                    <th style="white-space: normal!important">View More</th>
                                    <th>{{ __("Title") }}</th>
                                    <th style="width: 20%!important; white-space: normal!important;">{{ __("Description") }}</th>
                                    <th style="border-right: 0px!important;">{{ __("Buyer") }}</th>
                                    <th>{{ __("P/G") }}</th>
                                    <th style="width: 15%!important;">{{ __("Quote") }}</th>
                                    <th>{{ __("Country") }}</th>
                                    <th>{{ __("State") }}</th>
                                    <th>{{ __("Type") }}</th>
                                    <th>{{ __("Deal Code") }}</th>
                                    <th>{{ __("Dead Line") }}</th>
                                    <th>{{ __("Added On") }}</th>
                                    <th>{{ __("Details") }}</th>
                                    <th><i class="fa fa-star-o"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Area End-->
    <section class="blue-space">
        <div class="container-fluid text-center text-white blue-space-text" style="color: #fff!important;">
            <h2 style="color: #fff!important;"><b>FISCAL YEAR END 2020 SPENDING </b></h2>
            <p style="color: #fff!important;">The Value of Goods Imported to USA in 2020 totaled $2.4 Trillion. <br> The Federal Government Contracted for over $630 Billion in FYE September 30, 2020. <br>
                Small businesses were awarded approx. $150 Billion in U.S. Government Contracts. </p>
                <h2 style="color: #fff!important;"><b>2021 Fiscal Year Budget $7.16 Trillion </b></h2>
                <h4 style="color: #fff!important;">Let ANNEXTades be your bridge to Expansion & Increased Market Share </h4>
                <hr>
        </div>
    </section>
    <section class="white-space text-center" id="sample">
        <div class="container"><h3><b>FULL DESCRIPTION REPORT WITH DETAILS ON REQUEST FOR PROPOSAL (RFP)</b></h3></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"><img src="{{ asset('assets/images/deals-sample.png') }}" width="100%" alt=""></div>
                <div class="col-lg-6"><img src="{{ asset('assets/images/deals-process.png') }}" width="100%" alt=""></div>
            </div>
        </div>
    </section>
    <!-- #region datatables files -->


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- #endregion -->
    <script type="text/javascript">
		var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                searching: true,
                ajax: '{{ route('postrequest-datatables') }}',
                columns: [
                    {
                        "className":      'details-control all sorting_disabled',
                        "data":           null,
                        "defaultContent": '',
                    }, 
                   { data: 'product_name', "className": 'all',searchable: true, orderable: true},
                   { data: 'product_des', name: 'Description', class:"text-wrap tdwrap"},
				   { data: 'company_name', searchable: true, "sortable": true },
				   { data: 'icon', searchable: true  , orderable: false, "sortable": false },
                   { data: 'submit_quote', orderable: false, searchable: false},
                   {
                        className: 'f32', // used by world-flags-sprite library
                        data: 'country',
                        render: function(data, type) {
                            if (type === 'display') {
                                let country = '';
        
                                switch (data) {
                                    case 'India':
                                        country = 'in';
                                        break;
                                    case 'Edinburgh':
                                        country = '_Scotland';
                                        break;
                                    case 'London':
                                        country = '_England';
                                        break;
                                    case 'New York':
                                    case 'United States':
                                    case 'San Francisco':
                                        country = 'us';
                                        break;
                                    case 'Sydney':
                                        country = 'au';
                                        break;
                                    case 'Tokyo':
                                        country = 'jp';
                                        break;
                                    }   
                                    
                                    return country.toUpperCase() + '&nbsp;&nbsp;<span class="flag ' + country + '"></span> ';
                            }
        
                            return data;
                        }
                    },
                    { data: 'state', searchable: true, orderable: true },
                    { data: 'type', searchable: true, orderable: true },
                    { data: 'request_id', orderable: false, searchable: false},
                    { data: 'deadline', "sortable": true},
                    { data: 'created_at', name: 'Added On'},
                    { data: 'deals_title_full', name: 'Deals Title Full'},
                    { data: 'star'}
				],
                columnDefs: [{
                targets: 0,
                className: 'border-rt-0',
                orderable: false,
                sortable: false
                }],
				drawCallback : function( settings ) {
					//$('.select').niceSelect();	
				},
                
            });

            $('input[name=myfav]').on('change', function() {
                if (this.checked) {
                    table.columns(0).search('favourite').draw();
                    $('#fmyfav').show();
                    $('#fmyfav').html(`<i class="fa fa-times-circle text-danger"> <span class="text-dark">Favourite Bids</span></i>`);
                } else {
                    table.columns(0).search("").draw();
                    $('#fmyfav').hide();
                    $('input[name=myfav]').prop("checked", false);
                }
            });

            $('#fmyfav').on('click', function() {
                $('#fmyfav').hide();
                $('input[name=myfav]').prop("checked", false);
                table.columns(0).search("").draw();
            });

            $('input[name=active]').on('change', function() {
                if (this.checked) {
                    console.log('active');
                    table.columns(1).search("active").draw();
                    $('#factive').show();
                    $('#factive').html(`<i class="fa fa-times-circle text-danger"> <span class="text-dark">Active</span></i>`);
                } else {
                    console.log('inactive');
                    table.columns(1).search("").draw();
                    $('input[name=active]').prop("checked", false);
                    $('#factive').hide();
                }
            });

            $('#factive').on('click', function() {
                $('#factive').hide();
                $('input[name=active]').prop("checked", false);
                table.columns(1).search("").draw();
            });

            $(document).ready(
                function() {
                    $.ajax({
                        url: '{{ route('deal-fav-count') }}',
                        success: function(response){
                            $('#fav-count').html('('+response+')');
                        }
                    })
                }
            )
            

	</script>		
    @if(Auth::guard('web')->check())			
        <script>
            $('#datatable').on('click','.addfav',function(){
                var id = $(this).data('id');
                    // AJAX request
                $.ajax({
                    url: '{{ route('deal-fav') }}',
                    type: 'GET',
                    data: {user_id: '{{ Auth::user()->id }}', request_id: id},
                    success: function(response){
                        console.log(response);
                        if(response == 1){
                            //alert("Record deleted.");
                            // Reload DataTable
                            table.ajax.url( '{{ route('postrequest-datatables') }}' ).load();
                            $('#fav-count').load('{{ route('deal-fav-count') }}');
                        }else{
                            alert("Invalid ID.");
                        }
                    }
                });
            });
        </script>
    @else
    <script>
        $('#datatable').on('click','.addfav',function(){
            alert('Please login to add favourite!')
        });
    </script>
    @endif
    @if(Auth::guard('web')->check())			
        <script>
            $('#datatable').on('click','.removefav',function(){
                var id = $(this).data('id');
                console.log(id);
                    // AJAX request
                $.ajax({
                    url: '{{ route('deal-fav-remove') }}',
                    type: 'GET',
                    data: {user_id: '{{ Auth::user()->id }}', request_id: id},
                    success: function(response){
                        console.log(response);
                        if(response == 1){
                            //alert("Remove Favourite.");
                            // Reload DataTable
                            table.ajax.url( '{{ route('postrequest-datatables') }}' ).load();
                            $('#fav-count').load('{{ route('deal-fav-count') }}');
                        }else{
                            alert("Invalid ID.");
                        }
                    }
                });
            });
        </script>
    @endif


@endsection