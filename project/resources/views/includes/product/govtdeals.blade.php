
@php
    $govt = DB::table('government_contracts')
    ->select('government_contracts.id','government_contracts.deadline','government_contracts.title','categories_us.photo as photo')
    ->where('government_contracts.status', 1)
    ->where('government_contracts.highlight', 1)
    ->join('categories_us', 'government_contracts.category_id', '=', 'categories_us.id')
    ->get();
@endphp
@foreach ($govt as $item)

    @php
    $today = date("Y-m-d");
    $date = $item->deadline;
    @endphp

    <div class="row">
    {{-- @if ($date >= $today)  --}}
        <div class="col-md-12">
            <a href="{{'government-contract-details/' . $item->id}}" class="item">
                <?php if(empty($item->photo)): ?>
                    <div class="item-img"><img class="img-fluid" src="{{ asset('assets/images/logo_small.jpeg') }}" alt=""></div>
                <?php else: ?>
                    <div class="item-img"><img class="img-fluid" src="{{ asset('assets/images/categories/' . $item->photo) }}" alt=""></div>
                <?php endif; ?>
                <div class="info">
                    <h5 class="name">{{ $item->title }}</h5>
                    <small><b>Notice ID. :</b> {{ $item->id }}</small><br>
                    <small><b>Deadline  :</b> {{ date('m-d-Y H:i:s', strtotime($item->deadline)) }}</small>
                    <div class="item-cart-area text-light text-center" style="background-color: #ff7900; border-color: #ff7900; width: 100%; padding-top: 5px; padding-bottom: 5px; margin-bottom: 0;">
                        <span data-href="#"><b>VIEW IN DETAIL</b></span>
                    </div>
                </div>
                <div class="deal-counter">
                    <div data-countdown="{{ $item->deadline }}"></div>
                </div>
            </a>
        </div>
    {{-- @endif --}}
    </div>
@endforeach