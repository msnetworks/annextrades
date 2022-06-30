        @php
          $package=DB::table('user_subscriptions')->where('user_id', Auth::guard('web')->user()->id)->where('status', 1)->orderBy('id', 'DESC')->take(1)->get();
          //dd($package);
        @endphp 
        <div class="col-lg-4">
          <div class="user-profile-info-area">
            <ul class="links">
                @php 

                  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
                  {
                    $link = "https"; 
                  }
                  else
                  {
                    $link = "http"; 
                      
                    // Here append the common URL characters. 
                    $link .= "://"; 
                      
                    // Append the host(domain name, ip) to the URL. 
                    $link .= $_SERVER['HTTP_HOST']; 
                      
                    // Append the requested resource location to the URL 
                    $link .= $_SERVER['REQUEST_URI']; 
                  }      

                @endphp
              <li class="{{ $link == route('user-dashboard') ? 'active':'' }}">
                <a href="{{ route('user-dashboard') }}">
                  {{ $langg->lang200 }} 
                </a>
              </li>
              <li class="{{ $link == route('user-messages') ? 'active':'' }}">
                @if (!empty($package[0]) && $package[0]->method == 'Free')
                  <a href="#" onclick="alert('Please Update the package to view message!')">{{ $langg->lang232 }}</a>
                @else
                   <a href="{{route('user-messages')}}">{{ $langg->lang232 }}</a>
                @endif
              </li> 
              <li>
                <a href="{{ route('user-requests') }}">Quote Request</a>
              </li>
              <li>
                <a href="{{ route('user-requests') }}">Transactions</a>
              </li>
              <li>
                <a href="{{ route('user-postrequest') }}">Post Requirement</a>
              </li> 
              <li>
                <a href="{{ route('user-postrequest-submitquote') }}">Trade Deals</a>
              </li>
              @if(Auth::user()->IsVendor() && Auth::user()->email_verified != 'No')
                <li>
                  <a href="{{ route('vendor-dashboard') }}">
                    {{ $langg->lang230 }}
                  </a>
                </li>
                <li>
                    @if (!empty($package[0]) && $package[0]->method == 'Free')
                       <a href="#" onclick="alert('Please Update the package to get orders!')">All Orders</a>
                    @else
                       <a href="{{route('vendor-order-index')}}"> {{ $langg->lang443 }}</a>
                    @endif
                </li>
                @if($gs->affilate_product == 1)
                  <!-- <li class="dropdown_list">
                    <a href="#menu2" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                      <i class="icofont-cart"></i>{{ $langg->lang444 }}
                    </a>
                    <ul class="collapse list-unstyled" id="menu2" data-parent="#accordion"> -->
                      <li>
                        <a href="{{ route('vendor-prod-types') }}"><span>{{ $langg->lang445 }}</span></a>
                      </li>
                      <li>
                        <a href="{{ route('vendor-prod-index') }}"><span>{{ $langg->lang446 }}</span></a>
                      </li>
                      <li>
                        <a href="{{ route('admin-vendor-catalog-index') }}"><span>{{ $langg->lang785 }}</span></a>
                      </li>
                    <!-- </ul>
                  </li> -->
							  @endif
              @endif

              <li class="{{ $link == route('user-orders') ? 'active':'' }}">
                <a href="{{ route('user-orders') }}">
                  {{ $langg->lang201 }}
                </a>
              </li>
              {{-- <li class="{{ $link == route('product-request') ? 'active':'' }}">
                <a href="{{ route('product-request') }}">
                  {{ $langg->lang1001 }}
                </a>
              </li> --}}

              <li class="{{ $link == route('user-deposit-index') ? 'active':'' }}">
                <a href="{{route('user-deposit-index')}}">{{ $langg->lang819 }}</a>
              </li>
  
              <li class="{{ $link == route('user-transactions-index') ? 'active':'' }}">
                <a href="{{route('user-transactions-index')}}">My Sales</a>
              </li>

              @if($gs->is_affilate == 1)

                <li class="{{ $link == route('user-affilate-code') ? 'active':'' }}">
                    <a href="{{ route('user-affilate-code') }}">{{ $langg->lang202 }}</a>
                </li>

                <li class="{{ $link == route('user-wwt-index') ? 'active':'' }}">
                    <a href="{{route('user-wwt-index')}}">{{ $langg->lang203 }}</a>
                </li>

              @endif


              {{-- <li class="{{ $link == route('user-order-track') ? 'active':'' }}">
                  <a href="{{route('user-order-track')}}">{{ $langg->lang772 }}</a>
              </li> --}}

              {{-- <li class="{{ $link == route('user-favorites') ? 'active':'' }}">
                  <a href="{{route('user-favorites')}}">{{ $langg->lang231 }}</a>
              </li> --}}

              

              <li class="{{ $link == route('user-message-index') ? 'active':'' }}">
                  <a href="{{route('user-message-index')}}">{{ $langg->lang204 }}</a>
              </li>

              {{-- <li class="{{ $link == route('user-dmessage-index') ? 'active':'' }}">
                  <a href="{{route('user-dmessage-index')}}">{{ $langg->lang250 }}</a>
              </li> --}}

              <li class="{{ $link == route('user-profile') ? 'active':'' }}">
                <a href="{{ route('user-profile') }}">
                  {{ $langg->lang205 }}
                </a>
              </li>

              <li class="{{ $link == route('user-reset') ? 'active':'' }}">
                <a href="{{ route('user-reset') }}">
                 {{ $langg->lang206 }}
                </a>
              </li>

              <li>
                <a href="{{ route('user-logout') }}">
                  {{ $langg->lang207 }}
                </a>
              </li>

            </ul>
          </div>
          {{-- @if($gs->reg_vendor == 1)
            <div class="row mt-4">
              <div class="col-lg-12 text-center">
                <a href="{{ route('user-package') }}" class="mybtn1 lg">
                  <i class="fas fa-dollar-sign"></i> {{ Auth::user()->is_vendor == 1 ? $langg->lang233 : (Auth::user()->is_vendor == 0 ? $langg->lang233 : $langg->lang237) }}
                </a>
              </div>
            </div>
          @endif --}}
        </div>