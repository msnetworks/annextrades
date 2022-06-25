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
                        <div class="contact-form text-center" style="border:5px solid #03a3e8;padding:20px;border-radius:10px;"> 
                            <div>
                            <img src="{{ asset('assets/front/images/prices/vbasic.jpeg') }}" width="30%"/>
                            <h3><b style="color: #03a3e8;">Trader/Free</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For individuals or companies who seeks to source manufacturers, vendors, or suppliers to buy & sell products or services. </p><br>
                            </div>
                                <div class="pricing"><sup>$</sup><span class="b">0</span><span>/mo</span></div>
                                @if (Auth::guard('web')->check())
                                <a id="p-1" href="https://annextrades.com/user/subscription/13"><button type="button" style="color:white; background-color:#35aadf; border:2px solid #35aadf;"><b>Get Started Now</b></button></a>
                                @else
                                <button type="button" data-toggle="modal" data-target="#vendor-login" style="color:white; background-color:#35aadf; border:2px solid #35aadf;"><b>Get Started Now</b></button>
                                @endif
                            </div>
                            <br>
                            <div class="text-left" style="padding-bottom:15px;">
                                <span style="font-size:18px;font-weight:900;color:#35aadf;">Trader/Free includes</span>
                                <br/>
                                <span style="font-size:14px;font-weight:600font-weight:900;;">Boost Exposure</span>
                            </div>
                            <br>
                            <ul class="text-left">
                                <li>Listing: 10 Products (5 images each / 1 Video)</li>
                                <li>1 User license</li>
                                <li>Dedicated business page with company and product details</li>
                                <li>Post Requests and receive Quotes</li>
                                <li>User Dashboard to comunicate with Sellers</li>   
                                <li>User Dashboard to manage Request, Quotes and Messages </li>
                                <li>User Dashboard to generate E-Quotes, E-Invoices, E-POs and E-Contracts</li>
                                <li>Dedicated Business page with company and product details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="pricing-area">
                        <div class="contact-form text-center" style="border:5px solid #03a3e8;padding:20px;border-radius:10px;">
                            <div>
                            <img src="{{ asset('assets/front/images/prices/professional.jpeg') }}" width="30%"/>
                            <h3><b style="color: #03a3e8;">Level I Vendor</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">Online Exposure and Entry Level Vendor to get you Sales.</p><br>
                            </div>
                                <div class="pricing" id="pr-2"><sup>$</sup><span class="b">10</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a id="p-2" href="https://annextrades.com/user/subscription/12">
                                    <button type="button" class="btn-outline-blue"><b>Get Started Now</b></button>
                                </a>
                            @else
                                <a href="javascript:;"  data-toggle="modal" data-target="#vendor-login">
                                    <button type="button" class="btn-outline-blue"><b>Get Started Now</b></button>
                                </a>
                            @endif
                            </div>
                            <br>
                            <div class="text-left">
                                <span style="font-size:18px;font-weight:900;color:#35aadf;">Level I Vendor includes</span>
                                <br/>
                                <span style="font-size:14px;font-weight:600font-weight:900;;">Everything in Trader/Free</span>
                            </div>
                            <br>

                            <ul class="text-left">
                                <li>Listing: 20 Products (5 images each / 1 video)</li>
                                <li>Direct Leads from Private Buyers via SMS, WhatsApp, Email</li>
                                <li>Dedicated Business page with company and product details</li>
                                <li>Post Requests and receive Quotes</li>
                                <li>User Dashboard to communicate with Sellers</li>
                                <li>User Dashboard to communicate with Private Buyers</li>
                                <li>User Dashboard to generate Electronic Quotes to Contracts.</li>
                                <li>U.S. Business shipping address for Non-U.S. Members</li>
                                <li>U.S. Sales Team Support.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="pricing-area">
                        <div class="contact-form text-center" style="border:5px solid #03a3e8;padding:20px;border-radius:10px;">
                            <div>
                            <img src="{{ asset('assets/front/images/prices/enterprise.jpeg') }}" width="30%"/>
                            <h3><b style="color: #03a3e8;">Level II Vendor</b></h3>
                            <div class="pricing-height">
                                <p class="text-left">For the budget minded seller looking for a head start. Get the tools & power to fast track your company. </p><br>
                            </div>
                            <div class="pricing" id="pr-3"><sup>$</sup><del><span class="b">49</span></del>&nbsp; <sup>$</sup><span class="b">29</span><span>/mo</span></div>
                            @if (Auth::guard('web')->check())
                                <a id="p-3" href="https://annextrades.com/user/subscription/10">
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
                                <span style="font-size:18px;font-weight:900;color:#35aadf;">Level III Vendor includes</span>
                                <br/>
                                <span style="font-size:14px;font-weight:600font-weight:900;;">Everything in Level II +</span>
                            </div>
                            <br>
                            <ul class="text-left">
                                <li>Government Contract Bids Limit: 3 Active Bids per month</li>
                                <li>Direct Leads from Private Buyer & Government Bids via SMS, WhatsApp, Email</li>
                                <li>ANNEXTrades Verified Vendor Preferred Vendor Shield on products & company profile</li>
                                <li>Dedicated Business page with company and product details</li>
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
            $('#p-2').prop('href', 'https://annextrades.com/user/subscription/18');
            $('#p-3').prop('href', 'https://annextrades.com/user/subscription/19');
            $('#pr-2').html(`<sup>$</sup><del><span class="b">100</span></del>&nbsp; <sup>$</sup><span class="b">90</span><span>/yr</span>`);
            $('#pr-3').html(`<sup>$</sup><del><span class="b">290</span></del>&nbsp; <sup>$</sup><span class="b">261</span><span>/yr</span>`);
            $('#mo-year').val('yearly');
        }else{
            $('#p-2').prop('href', 'https://annextrades.com/user/subscription/12');
            $('#p-3').prop('href', 'https://annextrades.com/user/subscription/10');
            $('#pr-2').html(`<sup>$</sup><span class="b">10</span><span>/yr</span>`);
            $('#pr-3').html(`<sup>$</sup><del><span class="b">49</span></del>&nbsp; <sup>$</sup><span class="b">29</span><span>/mo</span>`);
            $('#mo-year').val('monthly');
        }
    });
</script>
@endsection