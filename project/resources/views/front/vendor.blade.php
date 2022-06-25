@extends('layouts.front')
@section('content')

<!-- Vendor Area Start -->
  <div class="vendor-banner" style="background: url({{  $vendor->shop_image != null ? asset('assets/images/vendorbanner/'.$vendor->shop_image) : '' }}); background-repeat: no-repeat; background-size: cover;background-position: center;{!! $vendor->shop_image != null ? '' : 'background-color:'.$gs->vendor_color !!} ">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <p class="sub-title">
                {{ $langg->lang226 }}
            </p>
            <h2 class="title">
              {{ $vendor->shop_name }}
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>


{{-- Info Area Start --}}
<section class="info-area">
  <div class="container-fluid lr-30">


        @foreach($services->chunk(4) as $chunk)

        <div class="row">

        <div class="col-lg-12 p-0">
          <div class="info-big-box">
              <div class="row">
                @foreach($chunk as $service)
              <div class="col-6 col-xl-3 p-0">
                <div class="info-box">
                  <div class="icon">
                    <img src="{{ asset('assets/images/services/'.$service->photo) }}">
                  </div>
                  <div class="info">
                      <div class="details">
                        <h4 class="title">{{ $service->title }}</h4>
                      <p class="text">
                        {!! $service->details !!}
                      </p>
                      </div>
                  </div>
                </div>
              </div>
              @endforeach
              </div>
          </div>
        </div>

        </div>

          @endforeach


        </div>
</section>
{{-- Info Area End  --}}




<!-- SubCategori Area Start -->
  <section class="sub-categori">
    <div class="container-fluid lr-30">
      <div class="row">

        {{-- @include('includes.vendor-catalog') --}}
        <div class="col-lg-3 col-md-6">
          <h4 class="title text-center">
            <b>{{ $vendor->shop_name }}</b>
          </h4>
          <div class="profile-area">
            <div class="filter-result-area">
              <div class="logo-area d-flex justify-content-center">
                {{ $vendor->shop_name[0] }}
                {{-- <img src="https://annextrades.com/old/assets/images/annexis-emblem.png" alt=""> --}}
              </div>
              <div class="body-area">
                <p class="text-light" style="margin-bottom: 0px;"><b>Company Description</b></p>
                <div class="w-100 desc-area">
                  {{ $vendor->shop_details }}
                </div>
              </div>
            </div>
          </div>
          <div class="left-area">
            <div class="filter-result-area">
            <div class="header-area">
              <h4 class="title">
                {{$langg->lang61}}
              </h4>
            </div>
            <div class="body-area">

              <form class="price-range-block" id="priceForm" action="{{ route('front.vendor', Request::route('category')) }}">
                  @if (!empty(request()->input('sort')))
                    <input type="hidden" name="sort" value="{{ request()->input('sort') }}" />
                  @endif
                  <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                  <div class="livecount">
                    <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
                    <span>{{$langg->lang62}}</span>
                    <input type="number" min=0  name="max" id="max_price" class="price-range-field" />
                  </div>
                </form>

                <button class="filter-btn" type="button" onclick="document.getElementById('priceForm').submit();">{{$langg->lang58}}</button>
            </div>
            </div>


            @if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))

              <div class="tags-area">
                <div class="header-area">
                  <h4 class="title">
                      Filters
                  </h4>
                </div>
                <div class="body-area">
                  <form id="attrForm" action="{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="post">
                    <ul class="filter">
                      <div class="single-filter">
                        @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
                          @foreach ($cat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
                          @foreach ($subcat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
                          @foreach ($childcat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </div>
                    </ul>
                  </form>
                </div>
              </div>
            @endif


            @if(!isset($vendor))

            {{-- <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">
                        {{$langg->lang63}}
                    </h4>
                  </div>
                  <div class="body-area">
                    <ul class="taglist">
                      @foreach(App\Models\Product::showTags() as $tag)
                      @if(!empty($tag))
                      <li>
                        <a class="{{ isset($tags) ? ($tag == $tags ? 'active' : '') : ''}}" href="{{ route('front.tag',$tag) }}">
                            {{ $tag }}
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
            </div> --}}


            @else

            <div class="service-center">
              <div class="header-area">
                <h4 class="title">
                    {{ $langg->lang227 }}
                </h4>
              </div>
              <div class="body-area">
                <ul class="list">
                  <li>
                      <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg' }}">
                          <i class="icofont-email"></i> <span class="service-text">{{ $langg->lang228 }}</span>
                      </a>
                  </li>
                  <li>
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-phone"></i> <span class="service-text">{{$vendor->shop_number}}</span>
                        </a>
                  </li>
                </ul>
              <!-- Modal -->
              </div>

              {{-- <div class="footer-area">
                <p class="title">
                  {{ $langg->lang229 }}
                </p>
                <ul class="list">


                  @if($vendor->f_check != 0)
                  <li><a href="{{$vendor->f_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  @endif
                  @if($vendor->g_check != 0)
                  <li><a href="{{$vendor->g_url}}" target="_blank"><i class="fab fa-google"></i></a></li>
                  @endif
                  @if($vendor->t_check != 0)
                  <li><a href="{{$vendor->t_url}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  @endif
                  @if($vendor->l_check != 0)
                  <li><a href="{{$vendor->l_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                  @endif
                    
                    
                </ul>
              </div> --}}
            </div>


            @endif


          </div>
        </div>
        <div class="col-lg-9 order-first order-lg-last">
          <div class="right-area">

            @if(count($vprods) > 0)

              @include('includes.vendor-filter')

            <div class="categori-item-area">
              {{-- <div id="ajaxContent"> --}}
                <div class="row">

                  @foreach($vprods as $prod)
                    @include('includes.product.product')
                  @endforeach

                </div>
                  <div class="page-center category">
                    {!! $vprods->appends(['sort' => request()->input('sort'), 'min' => request()->input('min'), 'max' => request()->input('max')])->links() !!}
                  </div>
              {{-- </div> --}}
            </div>

            @else
              <div class="page-center">
                <h4 class="text-center">{{ $langg->lang60 }}</h4>
              </div>
            @endif


          </div>
        </div>
      </div>
    </div>
  </section>
<!-- SubCategori Area End -->


@if(Auth::guard('web')->check())

{{-- MESSAGE VENDOR MODAL --}}

<div class="message-modal">
  <div class="modal" id="vendorform1" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel1">{{ $langg->lang118 }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-md-12">
              <div class="contact-form">

                <form id="emailreply">
                  {{csrf_field()}}
                  <ul>

                    <li>
                      <input type="text" class="input-field" readonly="" placeholder="Send To {{ $vendor->shop_name }}" readonly="">
                    </li>

                    <li>
                      <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ $langg->lang119}}" required="">
                    </li>

                    <li>
                      <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ $langg->lang120 }}" required=""></textarea>
                    </li>

                    <input type="hidden" name="email" value="{{ Auth::guard('web')->user()->email }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('web')->user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

                  </ul>
                  <button class="submit-btn" id="emlsub1" type="submit">{{ $langg->lang118 }}</button>
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

{{-- MESSAGE VENDOR MODAL ENDS --}}


@endif

@endsection

@section('scripts')

<script type="text/javascript">


  $(function () {
    $("#slider-range").slider({
    range: true,
    orientation: "horizontal",
    min: 0,
    max: 10000,
    values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '1000000' }}],
    step: 5,

    slide: function (event, ui) {
      if (ui.values[0] == ui.values[1]) {
        return false;
      }

      $("#min_price").val(ui.values[0]);
      $("#max_price").val(ui.values[1]);
    }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });
</script>

<script type="text/javascript">
          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var email = $(this).find('input[name=email]').val();
          var name = $(this).find('input[name=name]').val();
          var user_id = $(this).find('input[name=user_id]').val();
          var vendor_id = $(this).find('input[name=vendor_id]').val();
          $('#subj').prop('disabled', true);
          $('#msg').prop('disabled', true);
          $('#emlsub').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/vendor/contact')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'email'   : email,
                'name'  : name,
                'user_id'   : user_id,
                'vendor_id'  : vendor_id
                  },
            success: function() {
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        toastr.success("{{ $langg->message_sent }}");
        $('.ti-close').click();
            }
        });
          return false;
        });
</script>


@endsection
