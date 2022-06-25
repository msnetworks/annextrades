@extends('layouts.front')


@section('content')

<style>
    table{
        font-size: 13px;
    }
</style>
<link rel="stylesheet" href="https://github.com/downloads/lafeber/world-flags-sprite/flags32.css">
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
                        <a href="{{ route('deals-bulletain') }}">
                            {{ __('Deals Bulletain') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
    <section class="deals-section">
        <div class="container-fluid">
            <div class="col-md-12 header bg-light h3 text-primary">
                <div class="container">
                    {{ $data[0]->company_name }}
                </div>
            </div>
            <div class="container">
                <div class="deal-product row">
                    <div class="col-md-7">
                        <b>Title: </b>{{ $data[0]->product_name }} <br><br>
                        <b>Price Range: </b> &nbsp;${{ $data[0]->price_from }}&nbsp; to &nbsp;${{ $data[0]->price_to }} <br><br>
                        <b>Company Name: </b>{{ $data[0]->company_name }} <br><br>
                        <b>Delivery Address: </b>{{ $data[0]->address }} @if($data[0]->city){{ $data[0]->city }}@endif @if($data[0]->state){{ $data[0]->state }}@endif @if($data[0]->country){{ $data[0]->country }}@endif<br><br>
                        <b>Deadline: </b>{{ date('m-d-Y', strtotime($data[0]->deadline)) }} <br><br>
                        <b>Status: </b>Open <br><br>
                        <b>Description: </b><br><br> 
                        <p class="text-justify">{!! html_entity_decode(htmlspecialchars_decode($data[0]->product_des)) !!}</p>
                    </div>    
                    <div class="col-md-5">
                        <div class="row">
                            @php
                            $ext = pathinfo($data[0]->photo, PATHINFO_EXTENSION);
                            $ext1 = pathinfo($data[0]->photo1, PATHINFO_EXTENSION);
                            $ext2 = pathinfo($data[0]->photo2, PATHINFO_EXTENSION);
                            $ext3 = pathinfo($data[0]->photo3, PATHINFO_EXTENSION);
                            $ext4 = pathinfo($data[0]->photo4, PATHINFO_EXTENSION);
                            if($data[0]->photo!="")
                            {
                            if ($ext == 'png' || $ext == 'PNG' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'jifi' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'JIFI') {
                                $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo ."' alt='Title'> </br>
                                        </div>
                                    </div>
                                    </div>
                                ";
                                echo $photo;
                            }else{
                                $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                    <a href='".asset('assets/images/documents/')."/".$data[0]->photo."' style='font-size: 18px!important;'><b>Download <br> Document</b></a>
                                    
                                    </div>";
                                echo $a;
                            }
                            }
                            if($data[0]->photo1!="")
                            {
                                if ($ext1 == 'png' || $ext1 == 'PNG' || $ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'jifi' || $ext1 == 'JPG' || $ext1 == 'JPEG' || $ext1 == 'JIFI') {
                                    $photo = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo1 ."' alt='Title'> </br>
                                            </div>
                                        </div>
                                        </div>
                                    ";
                                    echo $photo;
                                }else{
                                    $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <a href='".asset('assets/images/documents/')."/".$data[0]->photo1."'><h4>Download</a><br>
                                    </div>";
                                    echo $a;
                                }
                            }
                            if($data[0]->photo2!="")
                            {
                                if ($ext2 == 'png' || $ext3 == 'PNG' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'jifi' || $ext2 == 'JPG' || $ext2 == 'JPEG' || $ext2 == 'JIFI') {
                                    $photo2 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo2 ."' alt='Title'> </br>
                                            </div>
                                        </div>
                                        </div>
                                    ";
                                    echo $photo2; 
                                }else{
                                    $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <a href='".asset('assets/images/documents/')."/".$data[0]->photo2."'><h4>Download</a><br>
                                        </div>";
                                    echo $a;
                                }
                            }
                            if($data[0]->photo3!="")
                            {
                                if ($ext3 == 'png' || $ext3 == 'PNG' || $ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'jifi' || $ext3 == 'JPG' || $ext3 == 'JPEG' || $ext3 == 'JIFI') {
                                    $photo3 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo3 ."' alt='Title'> </br>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                    echo $photo3;
                                }else{
                                    $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <a href='".asset('assets/images/documents/')."/".$data[0]->photo3."'><h4>Download</a></br>
                                        </div>";
                                    echo $a;
                                }
                            }
                            if($data[0]->photo4!="")
                            {
                                if ($ext4 == 'png' || $ext4 == 'PNG' || $ext4 == 'jpg' || $ext4 == 'jpeg' || $ext4 == 'jifi' || $ext4 == 'JPG' || $ext4 == 'JPEG' || $ext4 == 'JIFI') {
                                    $photo4 = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <img class='border' src='".asset('assets/images/postrequest/')."/".$data[0]->photo4 ."' alt='Title'> </br>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                    echo $photo4;
                                }else{
                                    $a = "<div class='col-md-4 d-flex justify-content-center pd-15' style='padding-bottom: 30px;'>
                                        <a href='".asset('assets/images/documents/')."/".$data[0]->photo4."'><h4>Download</a></br>
                                        </div>"
                                        ;
                                    echo $a;
                                }
                            }
                        @endphp 
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                    <div class="col-md-6 button-section text-left">
                        <small>Have question on this deal?</small><br>
                        <button class="btn btn-warning"  data-toggle="modal" data-target="#contactsale" style="background: #ff7900; color: #fff; font-size: 22px;">
                            <b>Contact Sales</b>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="contactsale" tabindex="-1" role="dialog" aria-labelledby="contactsaleLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        {{-- <h5 class="modal-title" id="contactsaleLabel">SELECT </h5> --}}
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-center" style="color: #ff7900;">
                                            <b>CONTACT SALES</b>
                                        </h3>
                                        <div class="row h-100">
                                            <div class="col-md-6 border my-auto text-center" style="padding: 15px;">
                                                <a href="tel:+919582033502"><img src="{{ asset('assets/images/flag/ind.png') }}" style="width: 100px;" alt=""> <br>
                                                    <b>INDIA <br> SALES TEAM</b></a>
                                            </div>
                                            <div class="col-md-6 border my-auto text-center" style="padding: 15px;">
                                                <a href="tel:+18886142950"><img src="{{ asset('assets/images/flag/us.png') }}" style="width: 100px" alt=""> <br>
                                                    <b>US <br> SALES TEAM</b></a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 button-section"><br><br>
                        <a href="{{ route('submitquote', $data[0]->request_id) }}"><button value="active" class="active btn btn-danger">Submit Quote</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection