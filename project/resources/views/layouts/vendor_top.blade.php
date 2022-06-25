<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	 <!-- favicon -->
	<!-- stylesheet -->
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor/css/top-style.css')}}">
	 <link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Updated CSS-->
	<link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
@endif

@if($gs->is_popup== 1)

@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->popup_background)}}">
    </div>
 
    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">
            <span class="preload-close"><i class="fas fa-times"></i></span>
            <div class="subscribePreloader__text text-center">
                <h1>{{$gs->popup_title}}</h1>
                <p>{{$gs->popup_text}}</p>
                <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" name="email"  placeholder="{{ $langg->lang741 }}" required="">
                        <button id="sub-btn" type="submit">{{ $langg->lang742 }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->

@endif

@endif


	<section class="top-header lr-30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="content">
						<div class="left-content">
							<div class="list">
								<ul>

									<li>
										<a target="_blank" href="https://annextrades.com/howitworksIN">
											<div class="howitwork" style="font-size: 18px; font-weight: 800;"> 
												<strong>HOW IT WORKS</strong>
											</div>
										</a>
									</li>
									<li>
										<a href="{{ route('deals-bulletain') }}">
											<div class="deals-bulletin" style="font-size: 18px; font-weight: 800;">
												TRADE DEALS
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="right-content">
							<div class="list">
								<ul>
									@if(!Auth::guard('web')->check())
									<li class="login">
										<div class="links">
											{{-- <a href="{{ route('user.login') }}" class="text-light"> --}}
												<a href="javascript:;" data-toggle="modal" data-target="#vendor-login" class="text-light">
													<span class="join" style="font-size: 18px; font-weight: 800;">{{ $langg->lang13 }}</span>
												</a>
												<span>|</span>
												<a href="javascript:;" class="text-light" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
													<span class="sign-in" style="font-size: 18px; font-weight: 800;">Sign In</span>
												</a>&nbsp;&nbsp;
											</div>
										</li>
										@else
										<li class="profilearea my-dropdown">
											<a href="javascript: ;" id="profile-icon" class="profile carticon">
												<span class="text">
													<i class="far fa-user"></i>	{{ $langg->lang11 }} <i class="fas fa-chevron-down"></i>
												</span>
											</a>
											<div class="my-dropdown-menu profile-dropdown">
												<ul class="profile-links">
													<li>
														<a href="{{ route('user-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
													</li>
													@if(Auth::user()->IsVendor())
													<li>
														<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
													</li>
													@endif
													
													<li>
														<a href="{{ route('user-profile') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
													</li>
													
													<li>
														<a href="{{ route('user-logout') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
													</li>
												</ul>
											</div>
										</li>
										@endif
										<li>
											<a target="_blank" class="whatsapp-text cnt-btn" href="https://wa.me/+17723070151" style="font-size: 18px; font-weight: 800;"><i class="fa fa-whatsapp"></i> CONTACT US</a>
										</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Top Header Area End -->
	<!-- Logo Header Area Start -->
	<section class="logo-header lr-30">
		<div class="container-fluid">
			<div class="row ">
				<div class="col-lg-2 col-sm-6 col-5 ">
					<div class="logo">
						<a href="{{ route('front.index') }}">
							<img style="margin-top: 12px;" src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-sm-12  order-last order-sm-2 order-md-2">
					<div class="search-box-wrapper">
						<div class="search-box text-center">

							<form id="searchForm" class="search-form" action="{{ route('front.category', [Request::route('category'),Request::route('subggory'),Request::route('childcategory')]) }}" method="GET">
								@if (!empty(request()->input('sort')))
									<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
								@endif
								@if (!empty(request()->input('minprice')))
									<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
								@endif
								@if (!empty(request()->input('maxprice')))
									<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
								@endif
								<input type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="off">
								<div class="autocomplete">
								  <div id="myInputautocomplete-list" class="autocomplete-items">
								  </div>
								</div>
								<button type="submit"><i class="icofont-search-1"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6 col-7 remove-padding order-lg-last">
					<div class="helpful-links">
						<ul class="helpful-links-inner">
							<li class="my-dropdown"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang3 }}">
								<a href="javascript:;" class="cart carticon">
									<div class="icon">
										<i class="icofont-cart"></i>
										<span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
									</div>

								</a>
								<div class="my-dropdown-menu" id="cart-items">
									@include('load.cart')
								</div>
							</li>
							<li class="wishlist"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								@if(Auth::guard('web')->check())
									<a href="{{ route('user-wishlists') }}" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">{{ Auth::user()->wishlistCount() }}</span>
									</a>
								@else
									<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">0</span>
									</a>
								@endif
							</li>
							<li class="compare"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang10 }}">
								<a href="{{ route('product.compare') }}" class="wish compare-product">
									<div class="icon">
										<i class="fas fa-exchange-alt"></i>
										<span id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
									</div>
								</a>
							</li>


						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->
<!--Main-Menu Area Start-->
	<div class="mainmenu-area mainmenu-bb lr-30">
		<div class="container-fluid">
			<div class="row align-items-center mainmenu-area-innner">
				<div class="col-lg-2 col-md-6 categorimenu-wrapper">
					<!--categorie menu start-->
					<div class="categories_menu">
						<div class="categories_title">
							<h2 class="categori_toggle"><i class="fa fa-bars"></i>  CATEGORIES{{-- {{ $langg->lang14 }} --}} <i class="fa fa-angle-down arrow-down"></i></h2>
						</div>
						<div class="categories_menu_inner">
							<ul>
								@php
								$i=1;
								@endphp
								@foreach($categories as $category)
									@php
										$c = DB::table('products')->where('category_id', $category->id)->where('status', '1')->get();
									@endphp
									@if (count($c) != 0)
										<li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
											@if(count($category->subs) > 0)
												<div class="img">
													<img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt="">
												</div>
												<div class="link-area">
													<span><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></span>
													@if(count($category->subs) > 0)
													<a href="javascript:;">
														<i class="fa fa-angle-right" aria-hidden="true"></i>
													</a>
													@endif
												</div>

											@else
												<a href="{{ route('front.category',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}"> {{ $category->name }}</a>

											@endif
											@if(count($category->subs) > 0)

											@php
											$ck = 0;
											foreach($category->subs as $subcat) {
												if(count($subcat->childs) > 0) {
													$ck = 1;
													break;
												}
											}
											@endphp
											<ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
												@foreach($category->subs as $subcat)
													@php
														$sc = DB::table('products')->where('subcategory_id', $subcat->id)->where('status', '1')->get();
													@endphp
													@if (count($sc))	
														<li>
															<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a>
															@if(count($subcat->childs) > 0)
															<div class="categorie_sub_menu">
																<ul>
																	@foreach($subcat->childs as $childcat)
																	<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
																	@endforeach
																</ul>
															</div>
															@endif
														</li>
													@endif
												@endforeach
											</ul>

											@endif

										</li>
									@endif
								@php
								$i++;
								@endphp

								@if($i == 15)
									<li>
									<a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i> {{ $langg->lang15 }} </a>
									</li>
									@break
								@endif


								@endforeach

							</ul>
						</div>
					</div>

					<!--categorie menu end-->
				</div>
				<div class="col-lg-10 col-md-6 mainmenu-wrapper remove-padding">
					<nav hidden>
						<div class="nav-header">
							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
						</div>
						<ul class="menu">
							@if($gs->is_home == 1)
							<li><a href="{{ route('front.index') }}">{{ $langg->lang17 }}</a></li>
							@endif
							<li><a href="{{ route('front.blog') }}">{{ $langg->lang18 }}</a></li>
							{{-- @if($gs->is_faq == 1)
							<li><a href="{{ route('front.faq') }}">{{ $langg->lang19 }}</a></li>
							@endif --}}
							@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li><a href="{{ route('front.aboutus') }}">{{ $data->title }}</a></li>
							@endforeach
							<li> 
								<a href="{{ route('front.pricing') }}">Pricing</a>
							</li>
							<li>
								<a href="{{ route('front-postrequirement') }}"  class="track-btn"><button class="mybtn3">{{ $langg->lang1001 }}</button></a>
							</li>
							<li>
								<a href="{{ route('deals-bulletain') }}" style="padding: 0px 0px;"><button style="background: #128C7E;" class="mybtn3">DEALS</button></a>
							</li>
						</ul>

					</nav>
				</div>
			</div>
		</div>
	</div>
<!--Main-Menu Area End-->


<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode(DB::table('generalsettings')->where('id','=',1)->first(['is_loader'])) !!};
  var langg    = {!! json_encode($langg) !!};
</script>

	<!-- jquery -->
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	{{-- <script src="{{asset('assets/front/js/vue.js')}}"></script> --}}
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- popper -->
	<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>
	<script src="{{asset('assets/vendor/js/nicEdit.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>
	<script src="https://kit.fontawesome.com/5ed2d81137.js" crossorigin="anonymous"></script>
    {!! $seo->google_analytics !!}

	@yield('scripts')

</body>

</html>
