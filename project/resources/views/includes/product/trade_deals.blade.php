

@php
    $govt = DB::table('PostRequest')->where('status', 1)->where('highlight', 1)->get();
    
@endphp
@foreach ($govt as $item)
    @php
    $today = date("Y-m-d");
    $date = $item->deadline;
    @endphp
    <div class="row">
    @if ($date >= $today) 
               @php
                    $category_image = DB::table('categories')->where('id',$item->cover_image_category)->pluck('cover')->toArray();
                @endphp
        <div class="col-md-12">
            <a href="{{ route('viewquote', $item->request_id) }}" class="item">
                    @if(!empty($category_image[0]))
                        <div class="item-img"><img class="img-fluid" src="{{ asset('assets/images/categories/' . $category_image[0]) }}" alt=""></div>
                    @else
                        <div class="item-img"><img class="img-fluid" src="{{ asset('assets/images/logo_small.jpeg') }}" alt=""></div>
                   @endif
                
                <div class="info">
                    <h5 class="name">{{ $item->name }}</h5>
                    <small><b>Deal No. :</b> {{ $item->id }}</small><br>
                    <small><b>Expiry  :</b> {{ date('m-d-Y H:i:s', strtotime($item->deadline)) }}</small>
                    <div class="item-cart-area text-light text-center" style="background-color: #ff7900; border-color: #ff7900; width: 100%; padding-top: 5px; padding-bottom: 5px; margin-bottom: 0;">
                        <span data-href="#"><b>VIEW IN DETAIL</b></span>
                    </div>
                </div>
                <div class="deal-counter">
                    <div data-countdown="{{ $item->deadline }}"></div>
                </div>
            </a>
        </div>
    @endif
    </div>
@endforeach