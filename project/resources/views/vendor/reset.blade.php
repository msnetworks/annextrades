@extends('layouts.vendor')
@section('content')



<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
              <h4 class="heading">Reset Password</h4>
              <ul class="links">
                <li>
                    <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                </li>
                <li>
                    <a href="{{ route('vendor-requests') }}">Reset Password</a>
                </li>
              </ul>
            </div>
        </div>
    </div>

<section class="product-area">
    <div class="container">
      <div class="row">
                <div class="col-lg-12">
                    <div class="user-profile-details">
                        <div class="account-info">
                            <div class="header-area">
                                <h4 class="title">
                                    {{ $langg->lang272 }}
                                </h4>
                            </div>
                            <div class="edit-info-area">
                                
                                <div class="body">
                                        <div class="edit-info-area-form">
                                                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <form id="userform" action="{{route('user-reset-submit')}}" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @include('includes.admin.form-both') 
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                <input type="password" name="cpass"  class="form-control" placeholder="{{ $langg->lang273 }}" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                <input type="password" name="newpass"  class="form-control" placeholder="{{ $langg->lang274 }}" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                <input type="password" name="renewpass"  class="form-control" placeholder="{{ $langg->lang275 }}" value="" required="">
                                                        </div>
                                                    </div>

                                                        <div class="form-links">
                                                            <button class="btn btn-primary submit-btn" type="submit">{{ $langg->lang276 }}</button>
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
  </section>

@endsection