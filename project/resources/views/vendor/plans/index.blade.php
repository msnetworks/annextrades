@extends('layouts.vendor')
@section('content')


<div class="content-area">

    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                    <h4 class="heading">{{ $langg->lang237 }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                        </li>
                        <li>
                            <a href="{{ route('vendor-package') }}">{{ $langg->lang237 }}</a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>


<section class="user-dashbord">

      <div class="row">
        <div class="col-lg-12">
            <div class="user-profile-details">
                @include('includes.form-success')
                    <div class="row">
                        {{-- @foreach($subs as $sub)
                            @if ($sub->price  != 0)
                                
                            <div class="col-lg-4">
                                <div class="elegant-pricing-tables style-2 text-center">
                                    <div class="pricing-head">
                                        <h3>{{ $sub->title }}</h3>
                                        @if($sub->price  == 0)
                                            <span class="price">
                                                <span class="price-digit">{{ $langg->lang402 }}</span>
                                            </span>
                                            @else
                                            <span class="price">
                                                <sup>{{ $sub->currency }}</sup>
                                                <span class="price-digit">{{ $sub->price }}</span><br>
                                                <span class="price-month">{{ $sub->days }} {{ $langg->lang403 }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    <div class="pricing-detail">
                                        {!! $sub->details !!}
                                    </div>
                                    @if(!empty($package))
                                    @if($package->subscription_id == $sub->id)
                                    <a href="javascript:;" class="btn btn-default">{{ $langg->lang404 }}</a>
                                    <br>
                                            @if(Carbon\Carbon::now()->format('Y-m-d') > $user->date)
                                            <small class="hover-white">{{ $langg->lang405 }} {{ date('d/m/Y',strtotime($user->date)) }}</small>
                                            @else
                                            <small class="hover-white">{{ $langg->lang406 }} {{ date('d/m/Y',strtotime($user->date)) }}</small>
                                            @endif
                                             <a href="{{route('vendor-vendor-request',$sub->id)}}" class="hover-white"><u>{{ $langg->lang407 }}</u></a>
                                             @else
                                             <a href="{{route('vendor-vendor-request',$sub->id)}}" class="btn btn-default">{{ $langg->lang408 }}</a>
                                             <br><small>&nbsp;</small>
                                             @endif
                                             @else
                                             <a href="{{route('vendor-vendor-request',$sub->id)}}" class="btn btn-default">{{ $langg->lang408 }}</a>
                                             <br><small>&nbsp;</small>
                                             @endif
                                             
                                            </div>
                                        </div>
                                @endif
                        @endforeach --}}
                        
    <!-- Contact Us Area Start -->
    <section class="contact-us lr-30">
        <div class="container-fluid  checklist">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-3 col-xl-offset-1 col-lg-offset-1 col-md-offset-1">
                    <div class="pricing-area">
                        <div class="contact-form text-center"> 
                            <h3><b style="color: #03a3e8;">Trader / Free</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For individuals or companies who seeks to source manufacturers, vendors, or suppliers to buy & sell products or services. </p><br>
                            </div>
                                <div class="pricing"><sup>$</sup><span class="b">0</span><span>/mo</span></div>
                                @if (Auth::guard('web')->check())
                                <a href="https://annextrades.com/user/subscription/13"><button type="button" class="btn-outline-blue"><b>Get Started Now</b></button></a>
                                @else
                                <button type="button" class="btn-outline-blue"  data-toggle="modal" data-target="#vendor-login"><b>Get Started Now</b></button>
                                @endif
                            <hr><br>
                            <ul class="text-left li-blue">
                                <li>Listing Limit:up to 10Products (5 images each / 1 Video)</li>
                                <li>1 User license</li>
                                <li>Post Requests and receive Quotes</li>
                                <li>User Dashboard to communicate with Sellers</li>
                                <li>User Dashboard to manage Request, Quotes and Messages</li>
                                <li>Dedicated Business page with company and product details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 ">
                    <div class="pricing-area">
                        <div class="contact-form text-center">
                            <h3><b style="color: #3efaf1;">Level I Vendor</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">Online Exposure and Entry Level Vendor to get you Sales.</p><br>
                            </div>
                                <div class="pricing"><sup>$</sup><span class="b">10</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a href="https://annextrades.com/user/subscription/12">
                                    <button type="button" class="btn-outline-sky"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <a href="javascript:;"  data-toggle="modal" data-target="#vendor-login">
                                    <button type="button" class="btn-outline-sky"><b>Get Started Now</b></button>
                                </a>
                            @endif
                            
                            <hr><br>
                            <ul class="text-left li-sky">
                                <li>Listing Limit: up to <u><b>20 Products</b></u> (5 images each / 1 video) </li>
                                <li>Direct Leads from Private Buyers via SMS,WhatsApp, eMail </li>
                                <li>Dedicated Business page with company and product details </li>
                                <li>Post Requests and receive Quotes</li>
                                <li>User Dashboard to comunicate with Sellers</li>   
                                <li>User Dashboard to communicate with Private Buyers </li>
                                <li>User Dashboard to generate Electronic Quotes to Contracts </li>
                                <li>U.S. Business shipping address for Non U.S. Members </li>
                                <li>U.S. Sales Team Support </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 ">
                    <div class="pricing-area">
                        <div class="contact-form text-center">
                            <h3><b style="color: #3cb24c;">Level II Vendor</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For the budget minded seller looking for a head start. Get the tools & power to fast track your company. </p><br>
                            </div>
                            <div class="pricing"><sup>$</sup><del><span class="b">49</span></del>&nbsp; <sup>$</sup><span class="b">29</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a href="https://annextrades.com/user/subscription/10">
                                    <button type="button" class="btn-outline-green"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <a href="javascript:;"  data-toggle="modal" data-target="#vendor-login">
                                    <button type="button" class="btn-outline-green"><b>Get Started Now</b></button>
                                </a>
                            @endif
                            
                            <hr><br>
                            <ul class="text-left li-green">
                                <li>1 Government Contract Bids Limit: <b><u>3 Active Bids</u></b> per month </li>
                                <li>Listing Limit: up to <u><b>20 Products</b></u> (5 images each / 1 video)</li>
                                <li>Direct Leads from <u>Private Buyer & Government</u> Bids via SMS, WhatsApp, eMail </li>
                                <li>ANNEXTrades Verified Vendor Prefered Vendor Shield on products & company profile  </li>
                                <li>Dedicated Business page with company and product details  </li>
                                <li>Post Requests and receive Quotes </li>
                                <li>User Dashboard to comunicate with Sellers </li>
                                <li>User Dashboard to communicate with Private Buyers </li>
                                <li>User Dashboard to generate Electronic Quotes to Contracts </li>
                                <li>U.S. Business shipping address for Non U.S. Members </li>
                                <li>U.S. Sales Team Support </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 ">
                    <div class="pricing-area">
                        <div class="contact-form text-center">
                            <h3><b style="color: #944392;">Level III Vendor</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For the fast start / follow through premium company complemented with impactful tools & services for success.</p><br>
                            </div>
                            <div class="pricing"><sup>$</sup><del><span class="b">119</span></del>&nbsp; <sup>$</sup><span class="b">49</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a href="https://annextrades.com/user/subscription/11">
                                    <button type="button" class="btn-outline-purple"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <button type="button" class="btn-outline-purple"  data-toggle="modal" data-target="#vendor-login"><b>Get Started Now</b></button>
                            @endif
                            <hr><br>
                            <ul class="text-left li-purple">
                                <li>Government Contract Bids Limit: <u><b>10 Active Bids</b></u> per month </li>
                                <li>Listing Limit: up to <u><b>40 Products</b></u> (5 images each / 1 video)</li>
                                <li>Direct Leads from Private Buyer & Government Bids via SMS, WhatsApp, eMail </li>
                                <li>ANNEXTrades Verified Vendor Prefered Vendor Shield on products & company profile </li>
                                <li>Dedicated Business page with company and product details</li>
                                <li>Post Requests and receive Quotes</li>
                                <li>User Dashboard to comunicate with Sellers</li>
                                <li>User Dashboard to communicate with Private Buyers </li>
                                <li>User Dashboard to generate Electronic Quotes to Contracts </li>
                                <li>U.S. Business shipping address for Non U.S. Members </li>
                                <li>U.S. Sales Team Support </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Area End-->

                        </div>
                    </div>
                </div>
            </div>

        </section>

</div>

@endsection