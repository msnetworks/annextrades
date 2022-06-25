@extends('layouts.admin') 
 
@section('content')  
<style>
    .nav-tabs .active{
        background-color: #2d3274 !important;
        color: #fff!important;
        font-weight: 800!important;
    }
    .nav-tabs .nav-item{
        color: #2d3274;
    }
    .submit-btn{
        background-color: #2d3274 !important;
        color: #fff!important;
        font-weight: 800!important;
        width: 100%;
        height: 50px;
        border: 0px;
        border-radius: 1px;
    }
</style>
<div class="content-area">
    <div class="add-product-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area" id="modalEdit">
                        <nav class="comment-log-reg-tabmenu">
                            <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                                <a class="nav-item w-50 text-center nav-link login active" style="font-size: 22px" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
                                    <b>Seller Registration</b>
                                </a>
                                <a class="nav-item w-50 text-center nav-link" style="font-size: 22px" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
                                    <b>Buyer Registration</b>
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
                                <div class="login-area">
                                    <div class="login-form signin-form">
                                        <br><br>
                                        @include('includes.admin.form-login')
                                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                                            {{ csrf_field() }}
                                            <br>
                                            <div class="form-input">
                                                <input type="text" class="input-field" name="name" placeholder="{{ $langg->lang182 }}" required="">
                                                {{--<i class="icofont-user-alt-5"></i> --}}
                                            </div><br><br>
                            
                                            <div class="form-input">
                                                <input type="email" class="input-field" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                                {{--<i class="icofont-email"></i> --}}
                                            </div><br><br>
                            
                                            <div class="form-input">
                                                <input type="text" class="input-field" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                                {{--<i class="icofont-phone"></i> --}}
                                            </div><br><br>
                            
                                            <div class="form-input">
                                                <input type="text" class="input-field" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                                {{--<i class="icofont-location-pin"></i> --}}
                                            </div><br><br>
                            
                                            <div class="form-input">
                                                <input type="password" class="Password input-field" name="password" placeholder="{{ $langg->lang186 }}"
                                                required="">
                                                {{--<i class="icofont-ui-password"></i> --}}
                                            </div><br><br>
                            
                                            <div class="form-input">
                                                <input type="password" class="Password input-field" name="password_confirmation"
                                                placeholder="{{ $langg->lang187 }}" required="">
                                                {{--<i class="icofont-ui-password"></i> --}}
                                            </div><br><br>
                            
                                            @if($gs->is_capcha == 1)
                                                <p  class="captcha-area">
                                                    <img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
                                                    class="fas fa-sync-alt pointer refresh_code "></i>
                                                </p>
                            
                                                <div class="form-input">
                                                    <br>
                                                    <input type="text" class="Password input-field" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                                    {{--<i class="icofont-refresh"></i> --}}
                                                </div><br><br>
                            
                                            @endif
                            
                                            <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
                                            <div class="form-input text-center">
                                                <button type="submit" class="submit-btn">REGISTER</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade  show active" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                                <div class="login-area signup-area">
                                    <div class="login-form signup-form">
                                        <br><br>
                                        @include('includes.admin.form-login')
                                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                                            {{ csrf_field() }}
                                            <br>
                                            <div class="row">
                
                                                <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="input-field" name="name" placeholder="{{ $langg->lang182 }}" required="">
                                                    {{--<i class="icofont-user-alt-5"></i> --}}
                                                </div><br><br>
                                            </div>
                
                                            <div class="col-lg-6">
                                                    <div class="form-input">
                                                    <input type="email" class="input-field" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                                    {{--<i class="icofont-email"></i> --}}
                                                </div><br><br>
                
                                                </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="input-field" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                                    {{--<i class="icofont-phone"></i> --}}
                                                </div><br><br>
                                                </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="input-field" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                                    {{--<i class="icofont-location-pin"></i> --}}
                                                </div><br><br>
                                                </div>
                
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                <input type="text" class="input-field" name="shop_name" placeholder="{{ $langg->lang238 }}" required="">
                                                {{--<i class="icofont-cart-alt"></i> --}}
                                            </div><br><br>
                
                                                </div>
                                            <div class="col-lg-6">
                
                                                <div class="form-input">
                                                <input type="text" class="input-field" name="owner_name" placeholder="{{ $langg->lang239 }}" required="">
                                                {{--<i class="icofont-cart"></i> --}}
                                            </div><br><br>
                                                </div>
                                            <div class="col-lg-6">
                
                                            <div class="form-input">
                                                <input type="text" class="input-field" name="shop_number" placeholder="{{ $langg->lang240 }}" required="">
                                                {{--<i class="icofont-shopping-cart"></i> --}}
                                            </div><br><br>
                                                </div>
                                            <div class="col-lg-6">
                
                                                <div class="form-input">
                                                <input type="text" class="input-field" name="shop_address" placeholder="{{ $langg->lang241 }}" required="">
                                                {{--<i class="icofont-opencart"></i> --}}
                                            </div><br><br>
                                                </div>
                                            <div class="col-lg-6">
                
                                            <div class="form-input">
                                                <select name="reg_name" required="">
                                                    <option value="">Product or Service</option>
                                                    <option value="Product">Product</option>
                                                    <option value="Service">Service</option>
                                                </select>
                                                {{--<i class="icofont-settings-alt"></i> --}}
                                                {{-- <input type="text" class="input-field" n<br><br>ame="reg_number" placeholder="{{ $langg->lang242 }}" required=""> --}}
                                                
                                            </div>
                                                </div>
                                            <div class="col-lg-6">
                
                                                <div class="form-input">
                                                <input type="text" class="input-field" name="shop_message" placeholder="Company Description" required="">
                                                {{--<i class="icofont-envelope"></i> --}}
                                            </div><br><br>
                                                </div>
                
                                            <div class="col-lg-6">
                                                    <div class="form-input">
                                                <input type="password" class="Password input-field" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                                {{--<i class="icofont-ui-password"></i> --}}
                                            </div><br><br>
                
                                                </div>
                                            <div class="col-lg-6">
                                                    <div class="form-input">
                                                <input type="password" class="Password input-field" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                                {{--<i class="icofont-ui-password"></i> --}}
                                                </div><br><br>
                                                </div>
                
                                            @if($gs->is_capcha == 1)
                                                <div class="col-lg-6">
                                                    <p class="captcha-area">
                                                        <img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
                                                    </p>
                                                    {{-- <ul class="captcha-area">
                                                        <li>
                
                                                        </li>
                                                    </ul> --}}
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <input type="text" class="Password input-field" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                                        {{-- <i class="icofont-refresh"></i> --}}
                                                    </div><br><br>
                                                </div>
                                            @endif
                
                                                <input type="hidden" name="vendor"  value="1">
                                                <input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="submit-btn">REGISTER</button>
                                                </div>
                
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
    </div>
</div>

@endsection    

@section('scripts')

{{-- DATA TABLE --}}
<script>
    $('.refresh_code').on( "click", function() {
          $.get(mainurl+'/contact/refresh_code', function(data, status){
              $('.codeimg1').attr("src",mainurl+"/assets/images/capcha_code.png?time="+ Math.random());
          });
      })
</script>
<script>
      // MODAL REGISTER FORM
  $(".mregisterform").on('submit', function (e) {
    e.preventDefault();
    var $this = $(this).parent();
    $this.find('button.submit-btn').prop('disabled', true);
    $this.find('.alert-info').show();
    var processdata = $this.find('.mprocessdata').val();
    $this.find('.alert-info p').html(processdata);
    $.ajax({
      method: "POST",
      url: $(this).prop('action'),
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data == 1) {
            $this.find('.alert-success').html(data);
         // window.location = mainurl + '/user/dashboard';
        } else {

          if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $this.find('.alert-danger p').html(data.errors[error]);
            }
            $this.find('button.submit-btn').prop('disabled', false);
          } else {
            
            $this.find('.create-account').hide();
            $this.find('.email-verify').show();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html(data);
            $this.find('button.submit-btn').prop('disabled', false);
          }
        }

        $('.refresh_code').click();

      }
    });

  });
  // MODAL REGISTER FORM ENDS


</script>

{{-- DATA TABLE --}}
    
@endsection   