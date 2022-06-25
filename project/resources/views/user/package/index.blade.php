@extends('layouts.front')
@section('content')

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
                <div class="col-lg-8">
<div class="user-profile-details">
    @include('includes.form-success')


                        <div class="row">
                            <div class="col-md-12">
                                {{-- @if($gs->reg_vendor == 1)
                                    <div class="text-plan">
                                        <div class="header-area text-left mb-0">
                                            <div class="title">STEP 3 - SELECT PLAN &nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
                            </div>
                            @foreach($subs as $sub)
                                <div class="col-lg-6">
                                    <div class="elegant-pricing-tables style-2 text-center">
                                        <div class="pricing-head">
                                            <h3 class="plan-head-text">{{ $sub->title }}</h3>
                                            @if($sub->price  == 0)
                                                <span class="price">
                                                    <span class="price-digit">{{ $langg->lang402 }}</span>
                                                </span>
                                            @else
                                            <span class="price">
                                                <sup>{{ $sub->currency }}</sup>
                                                <span class="price-digit" id="price-digit">{{ $sub->price }}</span><br>
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
                                             <a href="{{route('user-vendor-request',$sub->id)}}" class="hover-white"><u>{{ $langg->lang407 }}</u></a>
                                        @else
                                            <a href="{{route('user-vendor-request',$sub->id)}}" class="btn btn-default">{{ $langg->lang408 }}</a>
                                            <br><small>&nbsp;</small>
                                        @endif
                                    @else
                                        <a href="{{route('user-vendor-request',$sub->id)}}" class="btn btn-default">{{ $langg->lang408 }}</a>
                                        <br><small>&nbsp;</small>
                                    @endif


{{--                                         <a href="#" class="btn btn-default">Get Started Now</a>   --}}                
                                    </div>
                                </div>

                                @endforeach



                        </div>
                    </div>
                </div>
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('.price-digit').each(function () {
    var $this = $(this),
        $val = $this.text(),
        dec_pos = $val.indexOf('.');
    $this.html($val.substring(0, dec_pos) + '<sup>' + $val.substring(dec_pos + 1) + '</sup>');
    });
</script>
@endsection