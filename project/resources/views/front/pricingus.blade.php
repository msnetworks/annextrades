@extends('layouts.front')


@section('content')
<style>
    @media only screen and (min-width: 1248px) {
        .col-xl-2 .col-lg-2 .col-md-2{
            width: 20%!important;
        }
    }
</style>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area lr-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.pricing') }}">
                            Pricing
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<style>
    .off{
        background: red;
    }
</style>
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: limegreen;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
    
    
    
    </style>
    <!-- Contact Us Area Start -->
    <section class="contact-us lr-30">
        <div class="container-fluid  checklist">
            <div class="row">
                <div class="col-lg-12"> 
                    <div class="section-title text-center">
                        <h3>
                            <b style="font-size: 42px;">Ready to start with <br/>ANNEXTrades?</b><br><br>
                        </h3>
                        <h4 style="margin-top: -30px;">Your Bridge to Expansion &amp; Increased Market Share</h4>
                    </div>
                    <p class="text-center" style="margin-top: 20px;">Choose package that suits your business needs<p>
                    <div class="text-center" style="margin-top:10px;margin-bottom:20px;display:flex;justify-content:center;align-items:center;">
                        <h4>Monthly</h4> &nbsp; <label class="switch">
                            <input type="checkbox" id="mo-year" value="monthly">
                            <span class="slider round" id="togal-my"></span>
                        </label>
                        &nbsp;<h4>Yearly</h4>&nbsp;<img style="width:5%;" src="{{ asset('assets/front/images/prices/discount.jpeg') }}">
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="pricing-area">
                        <div class="contact-form text-center" style="border:5px solid #35aadf;padding:20px;border-radius:10px;">
                            <div>
                            <img src="{{ asset('assets/front/images/prices/vbasic.jpeg') }}" style="width: 30%;"/>
                            <h3><b style="color: #35aadf;">V-Basic</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">Online Exposure to get you more sales. Promote to local and internationally, Access to more vendors and suppliers globaly and take your business to new heights.</p><br>
                            </div>
                                <div class="pricing" id="pr-1"><sup>$</sup><span class="b">10</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a id="p-1" href="https://annextrades.com/user/subscription/15">
                                    <button type="button" style="color:white; background-color:#35aadf; border:2px solid #35aadf;"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <a href="javascript:;"  data-toggle="modal" data-target="#vendor-login">
                                    <button type="button" style="color:white; background-color:#35aadf; border:2px solid #35aadf;"><b>Get Started Now</b></button>
                                </a>
                            @endif
                            </div>
                            <br>
                            <div class="text-left" style="padding-bottom:15px;">
                                <span style="font-size:18px;font-weight:900;color:#35aadf;">V-Basic Includes</span>
                                <br/>
                                <span style="font-size:14px;font-weight:600font-weight:900;">Boost Exposure</span>
                            </div>
                            <br>
                            <ul class="text-left">
                                <li>Product or Service Listing: 20 items (5 images each / 1 Video)</li>
                                <li>Direct teads from Private Buyers via SMS, WhatsApp.</li>
                                <li>Dedicated Business page with comparty and product details</li>
                                <li>Post Buy Requests and receive Quotes from Supplier electronically</li>
                                <li>User Dashboard to comunicate with Sellers</li>   
                                <li>User Dashboard to communicate with Private Buyers </li>
                                <li>User Dashboard to generate E-Quotes, E-Invoices, E-POs and E-Contracts</li>
                                <li>U.S. &amp; India Sales Team Support </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="pricing-area">
                        <div class="contact-form text-center" style="border:5px solid #35aadf;padding:20px;border-radius:10px;">
                            <div>
                            <img src="{{ asset('assets/front/images/prices/professional.jpeg') }}" style="width: 30%;"/>
                            <h3><b style="color: #35aadf;">Professional</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For the budget minded seller looking for a head start. Get the tools & power to fast track your company. </p><br>
                            </div>
                            <div class="pricing" id="pr-2"><sup>$</sup><del><span class="b">49</span></del>&nbsp; <sup>$</sup><span class="b">39</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a id="p-2" href="https://annextrades.com/user/subscription/16">
                                    <button type="button" style="color:#35aadf;border:2px solid #35aadf;background-color:white;"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <a href="javascript:;"  data-toggle="modal" data-target="#vendor-login">
                                    <button type="button" style="color:#35aadf;border:2px solid #35aadf;background-color:white;"><b>Get Started Now</b></button>
                                </a>
                            @endif
                            </div>
                            <br>
                            <div class="text-left">
                                <span style="font-size:18px;font-weight:900;color:#35aadf;">Professional Includes</span>
                                <br/>
                                <span style="font-size:14px;font-weight:600font-weight:900;;">Everything in V-Basic +</span>
                            </div>
                            <br>
                            <ul class="text-left">
                                <li>Access to latest U.S. Government Contact Opportunities(Local, Federal)</li>
                                <li>User Dashboard to monitor, manage preference for direact leads via email updates</li>
                                <li>Reeive daily updates on new government contract listing per your set preferance</li>
                                <li>ANNEXTrades Verified Vendor Prefered Vendor Shield on products & company profile  </li>
                                <li>Respond to Private Buyer request for quotes on Trade Deals Bulletin</li>
                                <li>Receive ANNEXTrades Verified Vendor Prefred Vendor Shiled on products &amp; company profile.</li>
                                <li>Dedicated Business page with company and product details</li>
                                <li>Discount on Learning Center Training - How to conduct business with the U.S. Government &amp; more...</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="pricing-area">
                        <div class="contact-form text-center" style="border:5px solid #35aadf;padding:20px;border-radius:10px;">
                            <div>
                            <img src="{{ asset('assets/front/images/prices/enterprise.jpeg') }}" style="width: 30%;"/>
                            <h3><b style="color: #35aadf;">Enterprise</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For the fast start / follow through premium company complemented with impactful tools & services for success.</p><br>
                            </div>
                            <div class="pricing" id="pr-3"><sup>$</sup><del><span class="b">119</span></del>&nbsp; <sup>$</sup><span class="b">59</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a id="p-3" href="https://annextrades.com/user/subscription/17">
                                    <button type="button" style="color:white; background-color:#35aadf; border:2px solid #35aadf;"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <a href="javascript:;"  data-toggle="modal" data-target="#vendor-login">
                                    <button type="button" style="color:white; background-color:#35aadf; border:2px solid #35aadf;"><b>Get Started Now</b></button>
                                </a>
                            @endif
                            </div>
                            <br>
                            <div class="text-left">
                                <span style="font-size:18px;font-weight:900;color:#35aadf;">Enterprise Includes</span>
                                <br/>
                                <span style="font-size:14px;font-weight:600font-weight:900;;">Everything in Professional +</span>
                            </div>
                            <br>
                            <ul class="text-left">
                                <li>Dedicated reoresentative for Market Monitor and Updates on Private and U.S. Government Opportunities specific to your business profile per your preference settings</li>
                                <li>Select and receive up to 3 Category Bid Alert &amp; Submittal Package from Daily updates weekly</li>
                                <li>Increased Product or Service Listing to 40 Products (5 images each / 1 video)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <i class="fa fa-commenting-o text-danger"></i>
                <b>If you have any questions or concerns, please <a href="{{ route('front.contact') }}"><span class="text-danger">contact us</span></a></b>
            </div>
        </div>
    </section>
    <!-- Contact Us Area End-->
<script>
    $(document).on('click', '#togal-my', function(){
        if($('#mo-year').val() == 'monthly'){
            $('#p-1').prop('href', 'https://annextrades.com/user/subscription/18');
            $('#p-2').prop('href', 'https://annextrades.com/user/subscription/20');
            $('#p-3').prop('href', 'https://annextrades.com/user/subscription/21');
            $('#pr-1').html(`<sup>$</sup><del><span class="b">120</span></del>&nbsp; <sup>$</sup><span class="b">108</span><span>/yr</span>`);
            $('#pr-2').html(`<sup>$</sup><del><span class="b">468</span></del>&nbsp; <sup>$</sup><span class="b">421</span><span>/yr</span>`);
            $('#pr-3').html(`<sup>$</sup><del><span class="b">708</span></del>&nbsp; <sup>$</sup><span class="b">637</span><span>/yr</span>`);
            $('#mo-year').val('yearly');
        }else{
            $('#p-1').prop('href', 'https://annextrades.com/user/subscription/15');
            $('#p-2').prop('href', 'https://annextrades.com/user/subscription/16');
            $('#p-3').prop('href', 'https://annextrades.com/user/subscription/17');
            $('#pr-1').html(`<sup>$</sup><span class="b">10</span><span>/mo</span>`);
            $('#pr-2').html(`<sup>$</sup><del><span class="b">49</span></del>&nbsp; <sup>$</sup><span class="b">39</span><span>/mo</span>`);
            $('#pr-3').html(`<sup>$</sup><del><span class="b">119</span></del>&nbsp; <sup>$</sup><span class="b">59</span><span>/mo</span>`);
            $('#mo-year').val('monthly');
        }
    });
</script>
@endsection