<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>{{$gs->title}}</title>
	@elseif(isset($blog->meta_tag) && isset($blog->meta_description))
		<meta property="og:title" content="{{$blog->title}}" />
		<meta property="og:description" content="{{ $blog->meta_description != null ? $blog->meta_description : strip_tags($blog->meta_description) }}" />
		<meta property="og:image" content="{{asset('assets/images/blogs'.$blog->photo)}}" />
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($productt))
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
	    <meta name="author" content="GeniusOcean">
    	<title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
	@else
		<meta property="og:title" content="{{$gs->title}}" />
		<meta property="og:description" content="{{ strip_tags($gs->footer) }}" />
		<meta property="og:image" content="{{asset('assets/images/'.$gs->logo)}}" />
	    <meta name="keywords" content="{{ $seo->meta_keys }}">
	    <meta name="author" content="GeniusOcean">
		<title>{{$gs->title}}</title>
    @endif
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@else

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endif

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173541794-1"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-173541794-1');
  </script>
{{-- <script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "ccc71f7abf6ba42df61c7480021eace46fa3c352e125d11c63d2d3bd75a9a895d98971cb48be2e8ee2912cf02d0355f8", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
 --}}
 {{-- <script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/61e064a6b84f7301d32ae093/1fpa8ibhl';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script> --}}
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/20569710.js"></script>
<!-- End of HubSpot Embed Code -->


  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
	  https://firebase.google.com/docs/web/setup#available-libraries -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>


	@yield('styles')

</head>

<body>
	@if(isset($_COOKIE['country']))

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
									@if($_COOKIE['country'] == 'US')
									<li>
										<a target="_blank" href="https://annextrades.com/howitworksUS">
											<div class="howitwork" style="font-size: 18px; font-weight: 800;"> 
												<strong>HOW IT WORKS</strong>
											</div>
										</a>
									</li>
									@else
									<li>
										<a target="_blank" href="https://annextrades.com/howitworksIN">
											<div class="howitwork" style="font-size: 18px; font-weight: 800;"> 
												<strong>HOW IT WORKS</strong>
											</div>
										</a>
									</li>
									@endif

									@if($_COOKIE['country'] == 'US')
									<li>
										<a href="{{ route('deals-bulletain') }}">
											<div class="deals-bulletin" style="font-size: 18px; font-weight: 800;">
												TRADE DEALS
											</div>
										</a>
									</li>
									@else
									<li>
										<a href="{{ route('deals-bulletain') }}">
											<div class="deals-bulletin" style="font-size: 18px; font-weight: 800;">
												TRADE DEALS
											</div>
										</a>
									</li>
									@endif
									@if($_COOKIE['country'] == 'US')
										{{-- @if (Auth::user()->subscribes()->orderBy('id','desc')->first()->price > 10) --}}
											<li>
												<a href="{{ route('government-contract') }}">
													<div class="deals-bulletin" style="font-size: 18px; font-weight: 800;">
														GOVERNMENT CONTRACT
													</div>
												</a>
											</li>
										{{-- @endif --}}
									@endif
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


                        			{{-- @if($gs->reg_vendor == 1)
										<li>
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        					<a href="{{ route('vendor-dashboard') }}" class="sell-btn">START SELLING</a>
	                        				@else
	                        					<a href="{{ route('user-package') }}" class="sell-btn">START SELLING</a>
	                        				@endif
										</li>
                        				@else
										<li>
											<a href="javascript:;" data-toggle="modal" data-target="#vendor-login" class="sell-btn">START SELLING</a>
										</li>
										@endif
									@endif --}}


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
							{{-- <div class="categori-container" id="catSelectForm">
								<select name="category" id="category_select" class="categoris">
									<option value="">{{ $langg->lang1 }}</option>
									@foreach($categories as $data)
									@php
										$c = DB::table('products')->where('category_id', $data->id)->get();
									@endphp
									@if (count($c) != 0)
									<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>{{ $data->name }}</option>
									@endif
									@endforeach
								</select>
							</div> --}}

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
								@if($_COOKIE['country'] == 'US')
									<li><a href="{{ route('front.about-us') }}">{{ $data->title }}</a></li>
								@else
									<li><a href="{{ route('front.about') }}">{{ $data->title }}</a></li>
								@endif
							@endforeach
							{{-- @if($gs->is_contact == 1)
							<li><a href="{{ route('front.contact') }}">{{ $langg->lang20 }}</a></li>
							@endif
							<li>
								<a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>
							</li> --}}
						
							@if($_COOKIE['country'] == 'US')
								<li><a href="{{ route('front.pricing-us') }}">Pricing</a></li>
							@else
								<li><a href="{{ route('front.pricing') }}">Pricing</a></li>
							@endif
							<li>
								@if (Auth::check())
									<a href="{{ route('front-postrequirement') }}"  class="track-btn"><button class="mybtn3">Post Requirements</button></a>
								@else
									<button class="mybtn3" onclick="alert('Please Login to Post a Requirement.')">Post Requirements</button>
								@endif
							</li>
							<li>
								<a href="#" style="padding: 0px 0px;"><button style="background: #128C7E;" class="mybtn3">Learning Center</button></a>
							</li>
						</ul>

					</nav>
				</div>
			</div>
		</div>
	</div>
<!--Main-Menu Area End-->

@yield('content')

<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="footer-info-area">
						<div class="footer-logo">
							<a href="{{ route('front.index') }}" class="logo-link">
								<img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt="">
							</a>
						</div>
						<div class="text">
							<p>
									{!! $gs->footer !!}
							</p>
						</div>
					</div>
					<div class="fotter-social-links">
						<ul>

							@if(App\Models\Socialsetting::find(1)->f_status == 1)
							<li>
							<a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
								<i class="fab fa-facebook-f"></i>
							</a>
							</li>
							@endif

							@if(App\Models\Socialsetting::find(1)->g_status == 1)
							<li>
							<a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
								<i class="fab fa-google-plus-g"></i>
							</a>
							</li>
							@endif

							@if(App\Models\Socialsetting::find(1)->t_status == 1)
							<li>
							<a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
								<i class="fab fa-twitter"></i>
							</a>
							</li>
							@endif

							@if(App\Models\Socialsetting::find(1)->l_status == 1)
							<li>
							<a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
								<i class="fab fa-linkedin-in"></i>
							</a>
							</li>
							@endif

							@if(App\Models\Socialsetting::find(1)->d_status == 1)
							<li>
							<a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
								<i class="fab fa-dribbble"></i>
							</a>
							</li>
							@endif

						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
								{{ $langg->lang21 }}
						</h4>
						<ul class="link-list">
							<li>
								<a href="{{ route('front.index') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang22 }}
								</a>
							</li>
							@if($_COOKIE['country'] == 'US')
							<li>
								<a href="{{ route('front.about-us') }}">
									<i class="fas fa-angle-double-right"></i>About Us
								</a>
							</li>
							@else
							<li>
								<a href="{{ route('front.about') }}">
									<i class="fas fa-angle-double-right"></i>About Us
								</a>
							</li>
							@endif
							
							@if($_COOKIE['country'] == 'US')
								<li><a href="{{ route('front.pricing-us') }}"><i class="fas fa-angle-double-right"></i>Pricing</a></li>
							@else
								<li><a href="{{ route('front.pricing') }}"><i class="fas fa-angle-double-right"></i>Pricing</a></li>
							@endif

							

							{{-- @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							@endforeach --}}

							<li>
								<a href="{{ route('front.contact') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang23 }}
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							{{ $langg->lang24 }}
						</h4>
						<ul class="post-list">
							@foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get() as $blog)
							<li>
								<div class="post">
								  <div class="post-img">
									<img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
								  </div>
								  <div class="post-details">
									<a href="{{ route('front.blogshow',$blog->id) }}">
										<h4 class="post-title">
											{{mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title}}
										</h4>
									</a>
									<p class="date">
										{{ date('M d - Y',(strtotime($blog->created_at))) }}
									</p>
								  </div>
								</div>
							  </li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="copy-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
							<div class="content">
								<div class="content">
									<p>{!! $gs->copyright !!}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->

	<!-- LOGIN MODAL -->
	<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="login-head" style="background: #143250">
						<b>SIGN - IN</b>
					</div>
							<div class="login-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang172 }}</h4>
								</div>
								<div class="login-form signin-form">
									@include('includes.admin.form-login')
									<form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
										{{ csrf_field() }}
										<div class="form-input">
											<input type="email" name="email" placeholder="{{ $langg->lang173 }}"
												required="">
											<i class="icofont-user-alt-5"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang174 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-forgot-pass">
											<div class="left">
												<input type="checkbox" name="remember" id="mrp"
													{{ old('remember') ? 'checked' : '' }}>
												<label for="mrp">{{ $langg->lang175 }}</label>
											</div>
											<div class="right">
												<a href="javascript:;" id="show-forgot">
													{{ $langg->lang176 }}
												</a>
											</div>
										</div>
										<input type="hidden" name="modal" value="1">
										<input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
										@if(App\Models\Socialsetting::find(1)->f_check == 1 ||
										App\Models\Socialsetting::find(1)->g_check == 1)
										<div class="social-area">
											<h3 class="title">{{ $langg->lang179 }}</h3>
											<p class="text">{{ $langg->lang180 }}</p>
											<ul class="social-links">
												@if(App\Models\Socialsetting::find(1)->f_check == 1)
												<li>
													<a href="{{ route('social-provider','facebook') }}">
														<i class="fab fa-facebook-f"></i>
													</a>
												</li>
												@endif
												@if(App\Models\Socialsetting::find(1)->g_check == 1)
												<li>
													<a href="{{ route('social-provider','google') }}">
														<i class="fab fa-google-plus-g"></i>
													</a>
												</li>
												@endif
											</ul>
										</div>
										@endif
									</form>
								</div>
							</div>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGIN MODAL ENDS -->

	<!-- FORGOT MODAL -->
	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="login-area">
						<div class="header-area forgot-passwor-area">
							<h4 class="title">{{ $langg->lang191 }} </h4>
							<p class="text">{{ $langg->lang192 }} </p>
						</div>
						<div class="login-form">
							@include('includes.admin.form-login')
							<form id="mforgotform" action="{{route('user-forgot-submit')}}" method="POST">
								{{ csrf_field() }}
								<div class="form-input">
									<input type="email" name="email" class="User Name"
										placeholder="{{ $langg->lang193 }}" required="">
									<i class="icofont-user-alt-5"></i>
								</div>
								<div class="to-login-page">
									<a href="javascript:;" id="show-login">
										{{ $langg->lang194 }}
									</a>
								</div>
								<input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
								<button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- FORGOT MODAL ENDS -->


<!-- VENDOR LOGIN MODAL -->
	<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<nav class="comment-log-reg-tabmenu">
					<div class="nav nav-tabs" id="nav-tab1" role="tablist">
						<a class="nav-item nav-link login active" style="font-size: 22px" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
							Buyer Registration <br> <small>(Free Account)</small>
						</a>
						<a class="nav-item nav-link" style="font-size: 22px" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
							Seller Registration
						</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
				        <div class="login-area">
				          <div class="login-form signin-form">
				                @include('includes.admin.form-login')
								<form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
									{{ csrf_field() }}
				  
									<div class="form-input">
									  <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
									  <i class="icofont-user-alt-5"></i>
									</div>
				  
									<div class="form-input">
									  <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
									  <i class="icofont-email"></i>
									</div>
				  
									<div class="form-input">
									  <input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
									  <i class="icofont-phone"></i>
									</div>
				  
									<div class="form-input">
									  <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
									  <i class="icofont-location-pin"></i>
									</div>
				  
									<div class="form-input">
									  <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}"
										required="">
									  <i class="icofont-ui-password"></i>
									</div>
				  
									<div class="form-input">
									  <input type="password" class="Password" name="password_confirmation"
										placeholder="{{ $langg->lang187 }}" required="">
									  <i class="icofont-ui-password"></i>
									</div>
				  
									@if($gs->is_capcha == 1)
				  
									<ul class="captcha-area">
									  <li>
										<p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
											class="fas fa-sync-alt pointer refresh_code "></i></p>
									  </li>
									</ul>
				  
									<div class="form-input">
									  <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
									  <i class="icofont-refresh"></i>
									</div>
				  
									@endif
				  
									<input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
									<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>
									
								  </form>
				          </div>
				        </div>
					</div>
					<div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                <div class="login-area signup-area">
                    <div class="login-form signup-form">
                       @include('includes.admin.form-login')
                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                          {{ csrf_field() }}

                          <div class="row">

                          	<div class="col-lg-6">
								<div class="form-input">
									<input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
									<i class="icofont-user-alt-5"></i>
								</div>
							</div>

                           <div class="col-lg-6">
 								<div class="form-input">
									<input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
									<i class="icofont-email"></i>
								</div>

                           	</div>
                           <div class="col-lg-6">
    							<div class="form-input">
									<input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
									<i class="icofont-phone"></i>
								</div>
                           	</div>
                           <div class="col-lg-6">
								<div class="form-input">
									<input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
									<i class="icofont-location-pin"></i>
								</div>
                           	</div>

							<div class="col-lg-6">
								<div class="form-input">
									<select name="already_export" required="">
										<option value="">Do You Export Internationally</option>
										<option value="1">Yes</option></option>
										<option value="0">No</option>
									</select>
								<i class="fas fa-shipping-fast"></i>
							</div>
                           	</div>
							   <div class="col-lg-6">
								   <div class="form-input">
										<input type="text" class="User Name" name="which_country" placeholder="Which Countries?" required="">
									<i class="fa-solid fa-earth-americas"></i>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-input">
									<input type="text" class="User Name" name="shop_name" placeholder="{{ $langg->lang238 }}" required="">
									<i class="icofont-cart-alt"></i>
								</div>
							</div>
                           <div class="col-lg-6">

 							<div class="form-input">
                                <input type="text" class="User Name" name="owner_name" placeholder="{{ $langg->lang239 }}" required="">
                                <i class="icofont-user"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

							<div class="form-input">
                                <input type="text" class="User Name" name="shop_number" placeholder="{{ $langg->lang240 }}" required="">
                                <i class="icofont-shopping-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

 							<div class="form-input">
                                <input type="text" class="User Name" name="shop_address" placeholder="{{ $langg->lang241 }}" required="">
                                <i class="icofont-opencart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

							<div class="form-input">
								<select name="reg_name" required="">
									<option value="">Product or Service</option>
									<option value="Product">Product</option>
									<option value="Service">Service</option>
								</select>
								<i class="icofont-settings-alt"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

 							<div class="form-input">
                                <input type="text" class="User Name" name="shop_message" placeholder="What do you sell?" required="">
                                <i class="icofont-envelope"></i>
                            </div>
                           	</div>

                           <div class="col-lg-6">
  								<div class="form-input">
                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                <i class="icofont-ui-password"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
 								<div class="form-input">
                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                <i class="icofont-ui-password"></i>
                            	</div>
                           	</div>

                            @if($gs->is_capcha == 1)
								<div class="col-lg-6">
									<ul class="captcha-area">
										<li>
											<p>
												<img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
											</p>

										</li>
									</ul>
								</div>
								<div class="col-lg-6">
									<div class="form-input">
										<input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
										<i class="icofont-refresh"></i>
									</div>
								</div>

							@endif

								<input type="hidden" name="vendor"  value="1">
								<input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
								<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                           	</div>
							</form>
						</div>
                </div>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- VENDOR LOGIN MODAL ENDS -->

<!-- Product Quick View Modal -->

	  <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<div class="container-fluid quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal -->

<!-- Order Tracking modal Start-->
    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                        <div class="order-tracking-content">
                            <form id="track-form" class="track-form">
                                {{ csrf_field() }}
                                <input type="text" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
                                <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
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
<!-- Order Tracking modal End -->

<!-- Post a Requirement Start-->
	<div class="modal fade" id="post-req-modal" tabindex="-1" role="dialog" aria-labelledby="post-req-modal" aria-hidden="true">
		<div class="modal-dialog  modal-dialog modal-xl" role="document">
			<div class="modal-content"> 
				<button type="button" class="close closeX" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span> close
				</button>
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="modal-post-req">
							<div class="modal-header">
								<div class="container-fluid">
									<p class="modal-title post-req-title"> Details About Your Buy Requirement</p>
									<hr>
								</div>
							</div>
							<div class="modal-body" style="padding: 0px 0px 15px 0px;">
								<div class="container-fluid">
									<div class="row">
										<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12" style="padding: 0px 0px 15px 15px;">
											<img class="border" src="{{ asset('assets/front/images/posturreq.png') }}" width="100%" alt="Post your Requirement">
										</div>
										<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12" style="padding: 30px;">
											<i class="fa fa-graduation-cap aws-blue"></i> Connecting Buyers with the right Sellers to meet required demands <br><br>
											<i class="fa fa-users aws-blue"></i> Variety of Manufacturer, Exporters and Suppliers across hundreds of product categories <br><br>
											<i class="fa fa-envelope aws-blue"></i> Direct communication between parties through our user dashboard <br>
										</div>
									</div>
									<div class="order-tracking-content">
										@include('includes.admin.form-login')
										<form class="postrequestform" id="geniusformdata" action="{{route('post-request-insert')}}" method="POST" enctype="multipart/form-data">
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
													<div class="form-input col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"> 
														<label for="companyname"><span class="astrick">*</span> Your Company Name</label>
														<input type="text" name="company_name" class="form-control" id="companyname" placeholder="" required=""> </br>
													</div>
													<div class="form-input col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12"> 
														<label for="type"><span class="astrick">*</span> Type</label><br>
														<label for="products"> Products</label>
														<input type="radio" name="type" id="products" value="Products" checked> &nbsp;&nbsp;
														<label for="services"> Services</label>
														<input type="radio" name="type" id="services" value="services"></br></br>
													</div>
													<div class="form-input col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="productname"><span class="astrick">*</span> What product or service do you seek?</label>
														<input type="text" name="product_name" class="form-control" id="productname" placeholder="{{  __('e.g. I need 10,000 T-shirt with custom paint.') }}" required=""> </br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="describe"><span class="astrick">*</span> Detail Description</label>
														<textarea name="product_des" class="form-control" id="describe" placeholder="{{ __('Quantity, specification, sizes, timeline, delivery location, price range.') }}" cols="30" rows="7"></textarea> <br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>

													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="pricerange"><span class="astrick">*</span> Price Range ($)</label><br>
														<div class="d-flex justify-content-center row" style="padding: 15px;">
															<div class="col-2 text-center">From</div> 
															<input type="number" class="form-control col-4" name="price_from" id="price-min" value="0" min="0">
															<div class="col-2 text-center">To</div> 
															<input type="number" class="form-control col-4" name="price_to" id="price-max" value="0" min="0">
														</div><br>
															<script>
																$("#price-min").change(function(){
																	var x = $("#price-min").val();
																	var y = x + 1;
																	$('#price-max').attr('min', x);
																});
														 </script>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="deadline"><span class="astrick">*</span> Dead Line</label>
														<input type="date" name="deadline" class="form-control" id="deadline" required=""> </br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="photos"> Images/File Upload</label><br>
														<img id="uploadPreview" style="width: 150px; border: 1px solid;" />
														<input id="uploadImage" type="file" name="photo" onchange="PreviewImage();" /> </br>
														<script type="text/javascript">

															function PreviewImage() {
																var oFReader = new FileReader();
																oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
														
																oFReader.onload = function (oFREvent) {
																	document.getElementById("uploadPreview").src = oFREvent.target.result;
																};
															};
														
														</script>
														<div class="input-files">
														</div>
														<div class="add-more-cont"><a class="add-box btn btn-info" id="add_more"><b>+ ADD MORE</b></a></div>
														
														<script>
															$(document).ready(function(){
																var id = 0;
																$("#add_more").click(function(){
																	var showId = ++id;
																	if(showId <= 4)
																	{
																		$(".input-files").append('<div style="padding: 15px;"><input type="file" class="form-control" name="photo'+showId+'"></div>');
																	}
																});
															});
														</script>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-12 mt-15">
														<p class="modal-title post-req-title"> Your Contact Details</p>
														<hr>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="productname"><span class="astrick">*</span> Your Name</label>
														<input type="text" name="name" class="form-control" id="name" required=""> </br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="address"><span class="astrick">*</span> Address</label>
														<textarea type="text" name="address" rows="5" class="form-control" id="address" required=""> </textarea></br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
														<label for="city"><span class="astrick">*</span> City</label>
														<input type="text" name="city" class="form-control" id="city" required=""> </br>
													</div>
													<div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
														<label for="pincode"><span class="astrick">*</span> Zip/ Postal Code</label>
														<input type="number" name="pincode" class="form-control" id="pincode" required=""> </br>
													</div>
													<div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
														<label for="state"><span class="astrick">*</span> State</label>
														<input type="text" name="state" class="form-control" id="state" required=""> </br>
													</div>
													<div class="form-input col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
														<label for="country"><span class="astrick">*</span> Country</label>
														<select name="country" class="form-control" id="country">
															<option class="placeholder" value="">Select Country</option>
															@foreach (DB::table('countries')->get() as $data)
                                                            <option value="{{ $data->country_name }}" {{ $data->country_name == 'India' ? 'selected' : '' }}>
                                                                {{ $data->country_name }}
                                                            </option>		
                                                         @endforeach
														</select>
													</div>
													<div class="form-input col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="Phone"><span class="astrick">*</span> Phone Number</label>
														<input type="tel" name="phone" class="form-control" minlength="10" maxlength="15" id="Phone" placeholder="{{ __('e.g. 919055509190') }}" required=""> </br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="email"><span class="astrick">*</span> Email</label>
														<input type="email" name="email" class="form-control" id="email" required=""> </br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<label for="homepage"> Company Website</label>
														<input type="homepage" name="homepage" class="form-control" id="homepage" required=""> </br>
													</div>
													<div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
														<label for="regions"> What is the best time and number to reach you with qualified sellers?</label>
														<input type="regions" name="regions" class="form-control" id="regions" required=""> </br>
													</div>
													<div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"></div>
													<div class="form-input col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
														<label for="select_regions"> Do you have a preferred region for seller?</label>
														<input type="select_regions" name="select_regions" class="form-control" id="select_regions" required=""> </br>
													</div>
													<div class="form-input col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"></div>
													@if($gs->is_capcha == 1)
													<div class="col-lg-6">
														<label for="select_regions"><span class="astrick">*</span> Please enter the following text in the box below</label>
														<ul class="captcha-area">
															<li>
																<p>
																	<img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
																</p>
															</li>
														</ul>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
														<div class="form-input">
															<input type="text" id='cpcode' class="form-control Password" name="codes" placeholder="{{ $langg->lang51 }}" required=""> </br>
														</div>
													  </div>
													  @endif
														{{-- <input type="hidden" name="vendor"  value="1">
														<input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
														<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button> --}}
														<input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
													<div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"></div>
													<div class="col-sm-8">
														<button type="submit" class="mybtn1 postsubmit">{{ __('SUBMIT') }}</button>
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
<!-- Post a Requirement End -->


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

	<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>

	
	@else
	<!--Preloader -->
	<style>
		.bluecard{
			min-height: 200px;
			min-width: 400px;
			background: rgba(0,0,200,0.7);
			display: flex;
			justify-content: space-evenly;
			align-items: center;
			color: white;
			flex-direction: column;
			padding: 28px;
			margin-top: 100px;
    	margin-left: 100px;
		}
		.countrycontainer{
			position:fixed;
			height:100vh;
			width:100vw;
			display:flex;
			justify-content:center;
			align-items:center;
			flex-direction:column;
			background: url('{{asset('assets/gif/background.gif')}}');
			background-size: 100% 100%;
		}
		@media screen and (max-width: 480px) {
			.bluecard{
				min-height: 200px;
				min-width: 300px;
				background: rgba(0,0,200,0.7);
				display: flex;
				justify-content: space-evenly;
				align-items: center;
				color: white;
				flex-direction: column;
				padding: 28px;
				margin-top: 0px;
				margin-left: 0px;
			}
		}
		</style>
	<div class="countrycontainer">
		<div class="bluecard">
			<div style="font-weight:900;font-size:40px;">Select Location:</div>
			<div>
				<input type="radio" value="US" name="country" id="country" style="height: 26px;"/>&nbsp;&nbsp;<span style="font-weight:900;font-size:36px;">North America</span><br/>
				<input type="radio" value="IN" name="country" id="country" style="height: 26px;"/>&nbsp;&nbsp;<span style="font-weight:900;font-size:36px;">India</span>
			</div>
		</div>
	</div>
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script>
		$(document).on('change','[name=country]',function(){
			var radioValue = $("input[name='country']:checked").val();
			if(radioValue == 'IN'){
				document.cookie = "country=IN";
				window.location.reload();
			} else {
				document.cookie = "country=US";
				window.location.reload();
			}
		});
	</script>
	@endif

	<script src="https://kit.fontawesome.com/5ed2d81137.js" crossorigin="anonymous"></script>
    {!! $seo->google_analytics !!}

	@if($gs->is_talkto == 1)
		<!--Start of Tawk.to Script-->
		{!! $gs->talkto !!}
		<!--End of Tawk.to Script-->
	@endif

	@yield('scripts')

</body>

</html>
