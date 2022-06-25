@php
	$package=DB::table('user_subscriptions')->where('user_id', Auth::guard('web')->user()->id)->where('status', 1)->orderBy('id', 'DESC')->take(1)->get();
@endphp
<!doctype html>
<html lang="en" dir="ltr">
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="author" content="GeniusOcean">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Title -->
		<title>{{$gs->title}}</title>
		<!-- favicon -->
		<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
		<!-- Bootstrap -->
		<link href="{{asset('assets/vendor/css/bootstrap.min.css')}}" rel="stylesheet" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/vendor/css/fontawesome.css')}}">
		<!-- icofont -->
		<link rel="stylesheet" href="{{asset('assets/vendor/css/icofont.min.css')}}">
		<!-- Sidemenu Css -->
		<link href="{{asset('assets/vendor/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/vendor/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />
		
		<link href="{{asset('assets/vendor/css/plugin.css')}}" rel="stylesheet" />
		
		<link href="{{asset('assets/vendor/css/jquery.tagit.css')}}" rel="stylesheet" />
    	<link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap-coloroicker.css') }}">
		<!-- Main Css -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		@if($langg->rtl == "1")
		
		<link href="{{asset('assets/vendor/css/rtl/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/vendor/css/rtl/custom.css')}}" rel="stylesheet"/>\
		<link href="{{ asset('assets/vendor/css/common.css') }}" rel="stylesheet">
		<link href="{{asset('assets/vendor/css/rtl/responsive.css')}}" rel="stylesheet" />
		
		@else
		 
		<link href="{{asset('assets/vendor/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/vendor/css/custom.css')}}" rel="stylesheet"/>
		<link href="{{ asset('assets/vendor/css/common.css') }}" rel="stylesheet">
		<link href="{{asset('assets/vendor/css/responsive.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		@endif
		
		@yield('styles')
		
	</head>
	{{-- @include('layouts.vendor_top') --}}
	<body>
		<div class="page">
			<div class="page-main">
				<!-- Header Menu Area Start -->
				<div class="header">
					<div class="container-fluid">
						<div class="d-flex justify-content-between">
							<div class="menu-toggle-button">
								<a class="nav-link" href="/" id="sidebarCollapse">
									{{-- <div class="my-toggl-icon">
											<span class="bar1"></span>
											<span class="bar2"></span>
											<span class="bar3"></span>
									</div> --}}
									<img src="https://annextrades.com/assets/images/1630056782logo.png" width="180px" alt="">
								</a>

							</div>

							<div class="right-eliment">
								<ul class="list">

									<li class="bell-area">
										<a id="notf_order" class="btn-user-panel" href="https://annextrades.com/user/dashboard">
											BACK TO USER PANEL
										</a>
									</li>
									<li class="bell-area">
										<a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
											<i class="icofont-cart"></i>
											<span data-href="{{ route('vendor-order-notf-count',Auth::guard('web')->user()->id) }}" id="order-notf-count">{{ App\Models\UserNotification::countOrder(Auth::guard('web')->user()->id) }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('vendor-order-notf-show',Auth::guard('web')->user()->id) }}" id="order-notf-show">
										</div>
										</div>
									</li>

									<li class="login-profile-area">
										<a class="dropdown-toggle-1" href="javascript:;">
											<div class="user-img">
              									@if(Auth::user()->is_provider == 1)
              									<img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}" alt="">
              									@else
              									<img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo ):asset('assets/images/noimage.png') }}" alt="">
              									@endif
											</div>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper">
												<ul>
													<h5>{{ $langg->lang431 }}</h5>
														<li>
															<a target="_blank" href="{{ route('front.vendor',str_replace(' ', '-', Auth::user()->shop_name)) }}"><i class="fas fa-eye"></i> {{ $langg->lang432 }}</a>
														</li>
														<li>
															<a href="{{ route('user-dashboard') }}"><i class="fas fa-sign-in-alt"></i> {{ $langg->lang433 }}</a>
														</li>
														<li>
															<a href="{{ route('vendor-profile') }}"><i class="fas fa-user"></i> {{ $langg->lang434 }}</a>
														</li>
														<li>
															<a href="{{ route('user-logout') }}"><i class="fas fa-power-off"></i> {{ $langg->lang435 }}</a>
														</li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Menu Area End -->
				<div class="wrapper">
					<!-- Side Menu Area Start -->
					<nav id="sidebar" class="nav-sidebar">
						<ul class="list-unstyled components" id="accordion">

							<li>
								<a target="_blank" href="{{ route('front.vendor',str_replace(' ', '-', Auth::user()->shop_name)) }}" class="wave-effect active"><i class="fas fa-eye mr-2"></i> {{ $langg->lang440 }}</a>
							</li>

							<li>
								<a href="{{ route('vendor-dashboard') }}" class="wave-effect active"><i class="fa fa-home mr-2"></i>{{ $langg->lang441 }}</a>
							</li>
							<li>
								{{-- @if ($package[0]->method == 'Free')
								  <a href="#" onclick="alert('Please Update the package to view message!')"><i class="fas fa-comment"></i>{{ $langg->lang232 }}</a>
								@else --}}
								   <a href="{{route('vendor-messages')}}"><i class="fas fa-comment"></i>{{ $langg->lang232 }}</a>
								{{-- @endif --}}
							</li>
							<li>
								{{-- @if ($package[0]->method == 'Free')
								  <a href="#" onclick="alert('Please Update the package to view message!')"><i class="fa fa-bell"></i>Quote Request</a>
								@else --}}
								   <a href="{{route('vendor-requests')}}"><i class="fa fa-bell"></i>Quote Request</a>
								{{-- @endif --}}
							</li>
							<li>
								<a href="{{route('vendor-product-transactions')}}"><i class="fas fa-receipt"></i>Transactions</a>
							</li>
							<li>
								<a href="{{route('vendor-postrequest')}}"><i class="fas fa-copy"></i>Post Requirement</a>
							</li>

							<li>
								<a href="#government-contract" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>Govt. Contracts</a>
								<ul class="collapse  components" id="government-contract" data-parent="#government-contract" style="width: 100%;padding: 0px 0px 0px 15px;">
										<li style="list-style: none;">
											<a href="#daily-updates" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">Daily Updates</a>
											<ul class="collapse list-unstyled" id="daily-updates" data-parent="#daily-updates" >
												<li><a href="#">Latest Updates</a></li>
											</ul>
											{{-- <a href="{{route('vendor-personalised-notications')}}"><i class="fas fa-bell"></i>Government Contracts Settings</a> --}}
										</li>
										<li style="list-style: none;">
											<a href="#preference-settings" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">Preference Settings</a>
											<ul class="collapse list-unstyled" id="preference-settings" data-parent="#preference-settings" >
												<li><a href="{{route('vendor-category-notifications')}}">Choose Category</a></li>
												<li><a href="{{route('vendor-location-notifications')}}">Choose Location</a></li>
												<li><a href="{{route('vendor-notifications')}}">Notification</a></li>
											</ul>
										</li>
								</ul>
							</li>

							<li>
								<a href="{{ route('vendor-postrequest-submitquote') }}"><i class="fas fa-shipping-fast"></i>Trade Deals</a>
							</li>
							<li>
								<a href="#order" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>{{ $langg->lang442 }}</a>
								<ul class="collapse list-unstyled" id="order" data-parent="#accordion" >
                                   	<li>
										@if ($package[0]->method == 'Free')
										   <a href="#" onclick="alert('Please Update the package to get orders!')">All Orders</a>
										@else
										   <a href="{{route('vendor-order-index')}}"> {{ $langg->lang443 }}</a>
										@endif
                                	</li>
								</ul>
							</li>

							@if($gs->affilate_product == 1)
							<li>
								<a href="#menu2" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-cart"></i>{{ $langg->lang444 }}
								</a>
								<ul class="collapse list-unstyled" id="menu2" data-parent="#accordion">
									<li>
										<a href="{{ route('vendor-prod-types') }}"><span>{{ $langg->lang445 }}</span></a>
									</li>
									<li>
										<a href="{{ route('vendor-prod-index') }}"><span>{{ $langg->lang446 }}</span></a>
									</li>
									<li>
										<a href="{{ route('admin-vendor-catalog-index') }}"><span>{{ $langg->lang785 }}</span></a>
									</li>
								</ul>
							</li>
							@endif
							<li>
								<a href="#affiliateprod" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-cart"></i>{{ $langg->lang447 }}
								</a>
								<ul class="collapse list-unstyled" id="affiliateprod" data-parent="#accordion">
									<li>
										<a href="{{ route('vendor-import-create') }}"><span>{{ $langg->lang448 }}</span></a>
									</li>
									<li>
										<a href="{{ route('vendor-import-index') }}"><span>{{ $langg->lang449 }}</span></a>
									</li>
								</ul>
							</li>
							<li>
								<a href="{{ route('user-orders') }}"><i class="fas fa-window-restore"></i>Purchase Item</a>
							</li>
							<li>
								<a href="{{route('vendor-deposit-index')}}"><i class="fas fa-money"></i>Deposite</a>
							</li>
							<li>
								<a href="{{route('vendor-transactions-index')}}"><i class="fas fa-poll"></i>My Sales</a>
							</li>
							{{-- <li>
								<a href="{{ route('vendor-postrequest-submitquote') }}"><i class="fas fa-shipping-fast"></i>Order Track</a>
							</li> --}}
							{{-- <li>
								<a href="{{ route('vendor-postrequest-submitquote') }}"><i class="fas fa-shipping-fast"></i>Favourite Seller</a>
							</li> --}}
							<li>
								<a href="{{ route('vendor-message-index') }}"><i class="fa fa-ticket"></i>Ticket</a>
							</li>
							{{-- <li>
								<a href="{{ route('vendor-postrequest-submitquote') }}"><i class="fas fa-shipping-fast"></i>Dispute</a>
							</li> --}}

							<li>
								<a href="{{ route('vendor-prod-import') }}"><i class="fas fa-upload"></i>{{ $langg->lang450 }}</a>
							</li>
							<li>
								<a href="{{ route('vendor-wt-index') }}" class=" wave-effect"><i class="fas fa-list"></i>{{ $langg->lang451 }}</a>
							</li>
							@if($gs->reg_vendor == 1)
								<li>
									<a href="{{ route('vendor-package') }}" class=" wave-effect"><i class="fas fa-dollar-sign"></i>{{ Auth::user()->is_vendor == 1 ? $langg->lang233 : (Auth::user()->is_vendor == 0 ? $langg->lang233 : $langg->lang237) }}</a>
								</li>
						  	@endif
							<li>
								<a href="#general" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-cogs"></i>{{ $langg->lang452 }}
								</a>
								<ul class="collapse list-unstyled" id="general" data-parent="#accordion">
                                    <li>
                                    	<a href="{{ route('vendor-service-index') }}"><span>{{ $langg->lang453 }}</span></a>
                                    </li>
                                    <li>
                                    	<a href="{{ route('vendor-banner') }}"><span>{{ $langg->lang454 }}</span></a>
                                    </li>
                                    @if($gs->vendor_ship_info == 1)
	                                    <li>
	                                    	<a href="{{ route('vendor-shipping-index') }}"><span>{{ $langg->lang719 }}</span></a>
	                                    </li>
	                                @endif
	                                @if($gs->multiple_packaging == 1)
	                                    <li>
	                                    	<a href="{{ route('vendor-package-index') }}"><span>{{ $langg->lang721 }}</span></a>
	                                    </li>
	                                @endif
                                    <li>
                                    	<a href="{{ route('vendor-social-index') }}"><span>{{ $langg->lang456 }}</span></a>
                                    </li>
									<li>
										<a href="{{ route('vendor-profile') }}"><span>Edit Profile</span></a>
									</li>
									<li>
										<a href="{{ route('vendor-reset') }}"><span>Reset Password</span></a>
									</li>
								</ul>
							</li>

						</ul>
					</nav>
					<!-- Main Content Area Start -->
					@yield('content')
					<!-- Main Content Area End -->
					</div>
				</div>
			</div>

		@php
		  $curr = \App\Models\Currency::where('is_default','=',1)->first();
		@endphp

		<script type="text/javascript">

		  var mainurl = "{{url('/')}}";
		  var admin_loader = {{ $gs->is_admin_loader }};
		  var whole_sell = {{ $gs->wholesell }};
		  var langg    = {!! json_encode($langg) !!};
		  var getattrUrl = '{{ route('vendor-prod-getattributes') }}';
		  var curr = {!! json_encode($curr) !!};
		  var alang    = {
			'add': '{{ __('ADD NEW') }}',
			'edit': '{{ __('EDIT') }}',  
			'status': '{{ __('Status Updated Successfully.') }}',  
  			};
		</script>

		<!-- Dashboard Core -->
		<script src="{{asset('assets/vendor/js/vendors/jquery-1.12.4.min.js')}}"></script>
		<script src="{{asset('assets/vendor/js/vendors/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/vendor/js/jqueryui.min.js')}}"></script>
		<!-- Fullside-menu Js-->
		<script src="{{asset('assets/vendor/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
		<script src="{{asset('assets/vendor/plugins/fullside-menu/waves.min.js')}}"></script>

		<script src="{{asset('assets/vendor/js/plugin.js')}}"></script>

		<script src="{{asset('assets/vendor/js/Chart.min.js')}}"></script>
		<script src="{{asset('assets/vendor/js/tag-it.js')}}"></script>
		<script src="{{asset('assets/vendor/js/nicEdit.js')}}"></script>
        <script src="{{asset('assets/vendor/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{asset('assets/vendor/js/notify.js') }}"></script>
		<script src="{{asset('assets/vendor/js/load.js')}}"></script>
		<!-- Custom Js-->
		<script src="{{asset('assets/vendor/js/custom.js')}}"></script>
		<!-- AJAX Js-->
		<script src="{{asset('assets/vendor/js/myscript.js')}}"></script>
		
		<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
		<!-- popper -->
		<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
		<!-- plugin js-->
		<script src="{{asset('assets/front/js/plugin.js')}}"></script>
		<script src="{{asset('assets/vendor/js/nicEdit.js')}}"></script>
		
		<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
		<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
		<script src="{{asset('assets/front/js/setup.js')}}"></script>
		
		<script src="{{asset('assets/front/js/toastr.js')}}"></script>
		
		<script src="https://kit.fontawesome.com/5ed2d81137.js" crossorigin="anonymous"></script>
		@yield('scripts')

@if($gs->is_admin_loader == 0)
<style>
	div#geniustable_processing {
		display: none !important;
	}
</style>
@endif

	</body>

</html>
