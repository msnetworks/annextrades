@extends('layouts.vendor')
@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="heading">Quote Requests</h4>
        <ul class="links">
          <li>
            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
          </li>
          <li>
            <a href="{{ route('vendor-requests') }}">Quote Request</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  @php
    //dd($id);
    $data = DB::table('order_bulk')->where('id', $id)->get();
    $user = DB::table('users')->where('id', $data[0]->user_id)->get();
    
    $pro = DB::table('products')->where('id', $data[0]->product_id)->get();
    $users = DB::table('users')->where('id', $pro[0]->user_id)->get();
    @endphp
    {{-- @php dd($data[0]->user_id); @endphp --}}
  @php
  $query = DB::table('quotes_submit')->where('quote_id', $id)->get();
  @endphp 
  <section class="product-area" id="DivIdToPrint">
      <div class="container">
        <form action="{{ route('vendor-product-quote') }}" enctype="multipart/form-data" method="POST" id="quoteform">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="quote_id" value="{{$id}}">
            <input type="hidden" name="product_id" value="{{ $data[0]->product_id }}">
            <input type="hidden" name="seller_id" value="{{ $pro[0]->user_id }}">
            <input type="hidden" name="buyer_id" value="{{$data[0]->user_id}}">
          <div class="col-lg-12 pt-30">
            <div class="d-flex justify-content-center pt-30">
                <div class="col-lg-8 mb-5 p-30" style="border: 1px solid #a3a3a3; border-radius: 5px;">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <h5><b>Buyers Details:</b></h5>
                        </div>
                        <div class="col-lg-6 col-sm-12 text-rt pb-15">
                            <span class="signature-dt"><b>Dated: </b> {{ $data[0]->created_at }}</span> <br>
                            <div class="print-download-btn">
                                <a href="javascript:;" title="Download Quote"><i class="fa fa-download"></i></a>
                                <a href="javascript:;" onclick="printDiv()" title="Print Quote"><i class="fa fa-print"></i></a>
                            </div>
                            
                            
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <p><b>Company Name: </b> {{ $user[0]->shop_name }}</p>
                            <p class="border" style="padding: 8px;"><b>Company Description: </b> {{ $user[0]->shop_message }}</p>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <hr style="margin: 15px!important">
                        <h5><b>Product Details:</b></h5>
                        
                            <p><b>Product Name: </b> {{ $pro[0]->name }}</p>
                            <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <h5><b>Quantity Required: </b> {{ $data[0]->quantity }}<small> @if(!empty($pro[0]->unit)){{ $pro[0]->unit }} @else{{ __('Units') }}@endif </small> </h5>
                                </div>
                                <div class="col-lg-4 col-md-4 text-right">
                                    <p><b><a target="_blank" class="add-btn" href="{{ route('front.product', $pro[0]->slug) }}">{{ __('View Product') }}</a></b> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            @if ($data[0]->user_id == Auth::user()->id)
                            .<h3 class="text-center" style="padding-top: 50px; padding-bottom: 30px;"><u><b>Submited Quote</b></u></h3>
                            
                            @elseif ($pro[0]->user_id == Auth::user()->id)
                            <h3 class="text-center" style="padding-top: 50px; padding-bottom: 30px;"><u><b>Submit Quote</b></u></h3>
                            @endif
                        </div>
                        <div class="table-responsive">
                            @if ($query->count() == 0 && $pro[0]->user_id == Auth::user()->id) 
                                <table class="table table-striped table-light">
                                    <thead>
                                        <tr>
                                            <th class="w-50" scope="col">NAME</th>
                                            <th scope="col">PRICE (USD)</th>
                                            <th scope="col">QTY</th>
                                            <th scope="col">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><input type="text" class="input-name" placeholder="Item Name" name="item_name" required ></th>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_price" required ></td>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_qty" required ></td>
                                            <td><input type="number" step="0.01" class="input-name subtotal" name="subtotal" value="0" required readonly></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><input type="text" class="input-name" placeholder="Item Name" name="item_name1"></th>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" value="0" name="item_price1"></td>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" value="0" name="item_qty1"></td>
                                            <td><input type="number" step="0.01" class="input-name subtotal1" name="subtotal1" value="0" required readonly></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><input type="text" class="input-name" placeholder="Item Name" name="item_name2"></th>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_price2"></td>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_qty2"></td>
                                            <td><input type="number" step="0.01" class="input-name subtotal2" name="subtotal2" value="0" required readonly></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th scope="row">Shipping</th>
                                            <td></td>
                                            <td><input type="number" step="0.01" class="input-name shipping" name="shipping" value="0"></td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Taxes</th>
                                            <td></td>
                                            <td><input type="number" step="0.01" class="input-name taxes" name="taxes" value="0"></td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Total Cost</th>
                                            <td></td>
                                            <th scope="row"><input type="number" step="0.01" class="input-name input-name-total total text-bold" name="total" value="0" required readonly></th>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($query->count() == 1)
                                <table class="table table-striped table-light">
                                    <thead>
                                        <tr>
                                            <th class="w-50" scope="col">NAME</th>
                                            <th scope="col">PRICE ($)</th>
                                            <th scope="col">QTY</th>
                                            <th scope="col">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><input type="text" class="input-name" placeholder="Item Name" value="{{ $query[0]->item_name }}" disabled></th>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_price" value="{{ $query[0]->item_price }}" disabled></td>
                                            <td><input type="number" step="0.01" class="input-name price" placeholder="0" min="0" name="item_qty" value="{{ $query[0]->item_qty }}" disabled></td>
                                            <td><input type="number" step="0.01" class="input-name price subtotal" name="subtotal" value="{{ $query[0]->subtotal }}" disabled></td>
                                        </tr>
                                        <tr> 
                                            <th scope="row"><input type="text" class="input-name" placeholder="Item Name" value="{{ $query[0]->item_name1 }}" disabled></th>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_price" value="{{ $query[0]->item_price1 }}" disabled></td>
                                            <td><input type="number" step="0.01" class="input-name price" placeholder="0" min="0" name="item_qty" value="{{ $query[0]->item_qty1 }}" disabled></td>
                                            <td><input type="number" step="0.01" class="input-name price subtotal" name="subtotal" value="{{ $query[0]->subtotal1 }}" disabled></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><input type="text" class="input-name" placeholder="Item Name" value="{{ $query[0]->item_name2 }}" disabled></th>
                                            <td><input type="number" step="0.01" class="input-name" placeholder="0" min="0" name="item_price" value="{{ $query[0]->item_price2 }}" disabled></td>
                                            <td><input type="number" step="0.01" class="input-name price" placeholder="0" min="0" name="item_qty" value="{{ $query[0]->item_qty2 }}" disabled></td>
                                            <td><input type="number" step="0.01" class="input-name price subtotal" name="subtotal" value="{{ $query[0]->subtotal2 }}" disabled></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th scope="row">Shipping</th>
                                            <td></td>
                                            <td><input type="number" step="0.01" class="input-name shipping" name="shipping" value="{{ $query[0]->shipping }}" disabled></td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Taxes</th>
                                            <td></td>
                                            <td><input type="number" step="0.01" class="input-name taxes" name="taxes" value="{{ $query[0]->taxes }}" disabled></td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th scope="row">Total Cost</th>
                                            <td></td>
                                            <th scope="row"><input type="number" step="0.01" class="input-name input-name-total total text-bold" name="total" value="{{ $query[0]->total }}" disabled></th>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <h3 class="text-center">No Quote Found</h3>
                            @endif
                        </div> 
                        @if ($query->count() == 0 && $pro[0]->user_id == Auth::user()->id) 
                            <div class="col-md-12">
                                <div class="pb-15">
                                    <h5>Quote Terms and Conditions</h5>
                                    <textarea type="text" name="quote_terms" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        @elseif($query->count() == 1)
                            <div class="col-md-12">
                                <div class="pb-15">
                                    <h5>Quote Terms and Conditions</h5>
                                    <textarea type="text" name="quote_terms" class="form-control" rows="5" disabled>{{ $query[0]->quote_terms }}</textarea>
                                </div>
                            </div>
                        @endif
                        @if ($query->count() == 0 && $pro[0]->user_id == Auth::user()->id || $query->count() == 1) 
                            <div class="col-md-8">
                                <div class="row container">
                                        <div class="col-md-12 pt-15">
                                            <b><h3>Vendor: <small> {{ $users[0]->shop_name }}</small></h3></b>
                                        </div>
                                        <div class="col-md-6 signature-dt">
                                            <input type="text" class="input-name" value="{{ $users[0]->name }}" disabled>
                                        </div>
                                        <div class="col-md-6 signature-dt">
                                            <input type="text" class="input-name" value="{{ $pro[0]->name }}" disabled>
                                        </div>
                                    <div class="col-md-12">
                                        <p class="text-dark" style="color: #000; font-weight: 600;">Instructions <br>
                                            To ask questions, View Product and messages Vendor <br>
                                            Decline: Rejects Quote <br>
                                            Make Offer: Adjust Total Cost <br>
                                            Accept: Proceed to Contract
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <h5 class="text-left"><b>E-Signature *</b></h5>
                                <div class="pb-15 d-flex justify-content-center signature">
                                    @if ($query->count() == 0)
                                        <a href="javascript:;" class="bg_blank" id="signature">Signature</a> 
                                        <span id="signature_id"></span>
                                        <input type="text" name="signature" value="" required hidden>
                                    @else
                                        @if ($users)
                                        <span><font class="sig">{{ $users[0]->name }}</font><br><font class="text">{{ $query[0]->signature }}</font></span>
                                            
                                        @else
                                        <span><font class="sig">{{ Auth::user()->name }}</font><br><font class="text">{{ $query[0]->signature }}</font></span>
                                            
                                        @endif
                                        
                                    @endif
                                </div>
                                <div class="d-flex justify-content-center signature-dt">
                                    <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                </div> 
                            </div>
                            @endif
                            <div class="col-md-12">
                                @if ($query->count() == 1)
                                    @php
                                        $query_offer = DB::table('request_product_offer')->where('quote_id', $id)->where('user_id', $data[0]->user_id)->get();
                                        //$query_offer = DB::table('request_product_offer')->where('quote_id', $id)->where('user_id', $data[0]->user_id)->get();
                                        $offer_edit = DB::table('request_product_offer')->where('quote_id', $id)->where('user_id', $pro[0]->user_id)->get();
                                        $offer_count = DB::table('request_product_offer')->where('quote_id', $id)->get();
                                
                                    @endphp
                                    @if ($query_offer->count() == 1)
                                        @php
                                            $ext1 = pathinfo($query_offer[0]->doc1, PATHINFO_EXTENSION);
                                            $ext2 = pathinfo($query_offer[0]->doc2, PATHINFO_EXTENSION);
                                            $ext3 = pathinfo($query_offer[0]->doc3, PATHINFO_EXTENSION);
                                            $ext4 = pathinfo($query_offer[0]->doc4, PATHINFO_EXTENSION);
                                            if ($ext1 == 'png' || $ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'jifi') {
                                                $b = "<img class='w-100' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc1."'>";
                                            }else{
                                                $b = "<iframe class='col-md-12 w-100' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc1."'></iframe>";
                                            }
                                            if ($ext2 == 'png' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'jifi') {
                                                $c = "<img class='w-100 ' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc2."'>";
                                            }else{
                                                $c = "<iframe class='col-md-12 w-100' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc2."'></iframe>";
                                            }
                                            if ($ext3 == 'png' || $ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'jifi') {
                                                $d = "<img class='w-100 ' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc3."'>";
                                            }else{
                                                $d = "<iframe class='col-md-12 w-100' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc3."'></iframe>";
                                            }
                                            if ($ext4 == 'png' || $ext4 == 'jpg' || $ext4 == 'jpeg' || $ext4 == 'jifi') {
                                                $e = "<img class='w-100 ' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc4."'>";
                                            }else{
                                                $e = "<iframe class='col-md-12 w-100' src='".asset('assets/images/productquote/')."/".$query_offer[0]->doc4."'></iframe>";
                                            }
                                        @endphp
                                        <div>
                                            <hr style="height: 2px;background:#000;">
                                            <div class="row"style="padding-bottom: 15px;">
                                                <div class="col-md-4"><h5 class="text-left"><b>Buyer's Offer</b></h5></div>
                                                <div class="col-sm-8 text-right"><h5>Offer Price:<b> {{$query_offer[0]->offer_amount}}</b></h5></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pb-15">
                                                    <h5>Buyer's Terms and Conditions</h5>
                                                    <textarea type="text" name="terms_con" placeholder="" class="form-control" rows="5" disabled>{{ $query_offer[0]->terms_and_condition }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row pb-15">
                                                <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <label for="photos"> Document for Verification</label><br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="padding: 15px; max-height: 200px; overflow: hidden;">
                                                    @php echo $b; @endphp </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="padding: 15px; max-height: 200px; overflow: hidden;">
                                                    @php echo $c; @endphp </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="padding: 15px; max-height: 200px; overflow: hidden;">
                                                    @php echo $d; @endphp </br> </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="padding: 15px; max-height: 200px; overflow: hidden;">
                                                    @php echo $e; @endphp </br>
                                                </div>                                    
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row container">
                                                            <div class="col-md-12 pt-15">
                                                                <b><h3>Vendor: <small> {{ $user[0]->shop_name }}</small></h3></b>
                                                            </div>
                                                            <div class="col-md-6 signature-dt">
                                                                <input type="text" class="input-name" value="{{ $user[0]->name }}" readonly>
                                                            </div>
                                                            <div class="col-md-6 signature-dt">
                                                                <input type="text" class="input-name" value="{{ $pro[0]->name }}" readonly>
                                                            </div>
                                                        <div class="col-md-12">
                                                            <p class="text-dark" style="color: #000; font-weight: 600;">Instructions <br>
                                                                To ask questions, View Product and messages Vendor <br>
                                                                Decline: Rejects Quote <br>
                                                                Make Offer: Adjust Total Cost <br>
                                                                Accept: Proceed to Contract
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <h5 class="text-left"><b>E-Signature *</b></h5>
                                                    <div class="pb-15 d-flex justify-content-center signature">
                                                        <span><font class="sig">{{ $user[0]->name }}</font><br><font class="text">{{ $query_offer[0]->signature }}</font></span>
                                                    </div>
                                                    <div class="d-flex justify-content-center signature-dt">
                                                        <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                
                                    @if ($offer_edit->count() == 1)
                                        
                                        <div>
                                            <hr style="height: 2px;background:#000;">
                                            <div class="row"style="padding-bottom: 15px;">
                                                <div class="col-md-4"><h5 class="text-left"><b>Seller's Offer</b></h5></div>
                                                <div class="col-sm-8 text-right"><h5>Offer Price:<b> {{$offer_edit[0]->offer_amount}}</b></h5></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pb-15">
                                                    <h5>Seller's Terms and Conditions</h5>
                                                    <textarea type="text" name="terms_con" placeholder="" class="form-control" rows="5" disabled>{{ $offer_edit[0]->terms_and_condition }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row container">
                                                            <div class="col-md-12 pt-15">
                                                                <b><h3>Vendor: <small> {{ $user[0]->shop_name }}</small></h3></b>
                                                            </div>
                                                            <div class="col-md-6 signature-dt">
                                                                <input type="text" class="input-name" value="{{ $users[0]->name }}" readonly>
                                                            </div>
                                                            <div class="col-md-6 signature-dt">
                                                                <input type="text" class="input-name" value="{{ $pro[0]->name }}" readonly>
                                                            </div>
                                                        <div class="col-md-12">
                                                            <p class="text-dark" style="color: #000; font-weight: 600;">Instructions <br>
                                                                To ask questions, View Product and messages Vendor <br>
                                                                Decline: Rejects Quote <br>
                                                                Make Offer: Adjust Total Cost <br>
                                                                Accept: Proceed to Contract
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <h5 class="text-left"><b>E-Signature *</b></h5>
                                                    <div class="pb-15 d-flex justify-content-center signature">
                                                        <span><font class="sig">{{ $users[0]->name }}</font><br><font class="text">{{ $offer_edit[0]->signature }}</font></span>
                                                    </div>
                                                    <div class="d-flex justify-content-center signature-dt">
                                                        <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($query[0]->status == 2)
                                    <div id="complete-form">
                                        <hr style="height: 2px;background:#000;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row container">
                                                        <div class="col-md-12 pt-15">
                                                            <b><h5><b>ANNEXTrades:</b> Bridge Consultant</h5></b>
                                                        </div>
                                                        <div class="col-md-6 signature-dt">
                                                            <input type="text" class="input-name" value="{{ $user[0]->name }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 signature-dt">
                                                            <input type="text" class="input-name" value="{{ $pro[0]->name }}" readonly>
                                                        </div>
                                                    <div class="col-md-12">
                                                        <p class="text-dark" style="color: #000; font-weight: 600;">NOTICE <br>
                                                            All items has been reviewed and deem in compliance with our company policy. 
                                                            Escrow details will be shared with parties to proceed with transaction. 
                                                            It is up to the parties involved to ensure that they complete the contractual agreement. 
                                                            ANNEXTrades cannot enforce or become involved in any litigation associated with this transaction. 
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <h5 class="text-left"><b>E-Signature *</b></h5>
                                                <div class="pb-15 d-flex justify-content-center signature">
                                                    <span><font class="sig">{{ $user[0]->name }}</font><br><font class="text">{{ $pro[0]->id.$data[0]->id }}{{ $user[0]->id }}C</font></span>
                                                </div>
                                                <div class="d-flex justify-content-center signature-dt">
                                                    <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                
                                    <div id="order-tab"></div>
                            </div>
                        <div class="col-md-12 button-section text-right pt-30">
                                @if ($query->count() == 1 && $data[0]->user_id == Auth::user()->id)
                                    @if ($query[0]->status == 2)
                                    <a href="{{ route('vendor-product-transactions') }}" class="btn btn-primary"><b>Back</b></a>
                                    @elseif ($query[0]->status == 3)
                                    <a href="{{ route('vendor-product-transactions') }}" class="btn btn-primary"><b>Back</b></a>
                                    @elseif($query[0]->status == 4)
                                        <a href="{{ route('vendor-product-transactions') }}" id="back-btn" class="btn btn-primary"><b>Back</b></a>
                                    @elseif($query[0]->status == 5)
                                        <a href="javascript:;" id="accept-btn" class="btn btn-success"><b>Accept</b></a>
                                        <a href="{{ route('vendor-product-updatestatus', ['id' => $query[0]->id, 'id1' => 3]) }}" id="decline-btn" onclick="confirm('This confirms that you wish to Decline this Quote. Seller will be notified and may with to revise this quote.')" class="btn btn-danger"><b>Decline</b></a>
                                        <a href="{{ route('vendor-product-updatestatus', ['id' => $query[0]->id, 'id1' => 2]) }}" id="complete-btn" class="btn btn-success d-none"><b>Complete</b></a>
                                        <a href="javascript:;" id="cancel-btn" class="btn btn-danger d-none"><b>Cancel</b></a>  

                                    @else
                                        <a href="{{ route('vendor-product-updatestatus', ['id' => $query[0]->id, 'id1' => 3]) }}" id="decline-btn"  onclick="confirm('This confirms that you wish to Decline this Quote. Seller will be notified and may with to revise this quote.')" class="btn btn-danger"><b>Decline</b></a>
                                        <a href="javascript:;" id="offer-btn" class="btn btn-primary"><b>Make Offer</b></a>
                                        <a href="{{ route('vendor-product-updatestatus', ['id' => $query[0]->id, 'id1' => 2]) }}" id="accept-btn" class="btn btn-success"><b>Accept</b></a>
                                        <button type="submit" id="submit-btn" class="btn btn-primary d-none"  onclick="confirm('You are about to Submit Response.')"><b>Submit Quote</b></button>
                                        <a href="javascript:;" id="cancel-btn" class="btn btn-danger d-none"><b>Cancel</b></a>  
                                    @endif

                                @elseif($query->count() == 0 && $pro[0]->user_id == Auth::user()->id)

                                    <button type="submit" value="active" id="submitquote" class="active btn btn-danger"  onclick="confirm('You are about to Submit Response.')">Submit Quote</button>    
                                        
                                @elseif($query->count() == 1 &&  $pro[0]->user_id == Auth::user()->id)
                                  
                                    @if (count($offer_count) <= 1 && $query[0]->status != 1 && $query[0]->status != 2 && $query[0]->status != 5 && $query[0]->status != 0|| $query[0]->status == 4)
                                        <a href="javascript:;" id="edit-btn" class="btn btn-info"><b>Edit Quote</b></a>
                                        <button type="submit" id="submit-btn" class="btn btn-primary d-none"  onclick="confirm('You are about to Submit Response.')"><b>Submit Quote</b></button>
                                        <a href="{{ route('vendor-product-updatestatus', ['id' => $query[0]->id, 'id1' => 2]) }}" id="complete-btn" class="btn btn-success d-none"><b>Complete</b></a>
                                        <a href="javascript:;" id="cancel-btn" class="btn btn-danger d-none"><b>Cancel</b></a> 
                                        <a href="{{ route('vendor-requests') }}" id="back-btn" class="btn btn-primary"><b>Back</b></a>
                                    @endif

                                    @if ($query[0]->status == 2)
                                        <a href="{{ route('vendor-requests') }}" class="btn btn-primary"><b>Back</b></a>
                                    @elseif ($query[0]->status == 3 && $pro[0]->user_id == Auth::user()->id)
                                        <a href="javascript:;" id="edit-btn" class="btn btn-info"><b>Edit Quote</b></a>
                                        <a href="{{ route('vendor-product-quote') }}" id="back-btn" class="btn btn-primary"><b>Back</b></a>
                                        <button type="submit" id="submit-btn" class="btn btn-primary d-none"><b>Submit Quote</b></button>
                                        <a href="javascript:;" id="cancel-btn" class="btn btn-danger d-none"><b>Cancel</b></a>  
                                    @elseif($query[0]->status == 1 || $query[0]->status == 5)
                                        <button class="active btn btn-secondary">Submit Quote</button>
                                    @endif
                                @endif
                            {{-- @endif --}}
                        </div>
                    </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </section>
  <script>

      $(document).ready(function () {
          $('#offer-btn').click(function () {
              $('#order-tab').append(`
                        <div id="offer-form">
                            <hr style="height: 2px;background:#000;">
                            <div class="row"style="padding-bottom: 15px;">
                                <div class="col-md-4"><h5 class="text-left"><b>Buyer's Offer</b></h5></div>
                                <div class="col-sm-4 text-right"><h5>Offer Price:</h5></div>
                                <div class="col-sm-4 text-left"> 
                                    <input type="number" step="0.01" name="offer_price" placeholder="Offer amount" class=""style="border: 1px solid #000; border-radius:2px;"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="pb-15">
                                    <h5>Buyer's Terms and Conditions</h5>
                                    <textarea type="text" name="terms_con" placeholder="" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row pb-15">
                                <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="photos"> Document for Verification</label><br>
                                </div>
                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input id="uploadImage1" type="file" name="doc" class="form-control"/> </br>
                                </div>
                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input id="uploadImage2" type="file" name="doc1" class="form-control"/> </br>
                                </div>
                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input id="uploadImage3" type="file" name="doc2" class="form-control"/> </br>
                                </div>
                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <input id="uploadImage4" type="file" name="doc3" class="form-control"/> </br>
                                </div>                                    
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row container">
                                            <div class="col-md-12 pt-15">
                                                <b><h3>Vendor: <small> {{ $user[0]->shop_name }}</small></h3></b>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ $user[0]->name }}" readonly>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ $pro[0]->name }}" readonly>
                                            </div>
                                        <div class="col-md-12">
                                            <p class="text-dark" style="color: #000; font-weight: 600;">Instructions <br>
                                                To ask questions, View Product and messages Vendor <br>
                                                Decline: Rejects Quote <br>
                                                Make Offer: Adjust Total Cost <br>
                                                Accept: Proceed to Contract
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h5 class="text-left"><b>E-Signature *</b></h5>
                                    <div class="pb-15 d-flex justify-content-center signature">
                                        <a href="javascript:;" class="bg_blank" id="newsignature" onclick="newmakesign()">Signature</a> 
                                        <span id="newsignature_id"></span>
                                        <input type="text" name="newsignature" value="" hidden>
                                    </div>
                                    <div class="d-flex justify-content-center signature-dt">
                                        <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="order-tab"></div>
                            </div>
                        </div>
              `);
              $('#quoteform').attr('action', '{{ route('vendor-product-makeoffer') }}');
              $('#offer-btn').hide();
              $('#decline-btn').hide();
              $('#accept-btn').hide();
              $('#submit-btn').removeClass('d-none');
              $('#cancel-btn').removeClass('d-none');
          })
      })
      $('#cancel-btn').click(function(){
          $('#offer-form').remove();
          $('#offer-btn').show();
              $('#decline-btn').show();
              $('#accept-btn').show();
              $('#submit-btn').addClass('d-none');
              $('#cancel-btn').addClass('d-none');
      })
  </script>
  <script>
      $(document).ready(function () {
          $('#edit-btn').click(function () {
              $('#order-tab').append(`
                        <div id="edit-form">
                            <hr style="height: 2px;background:#000;">
                            <div class="row"style="padding-bottom: 15px;">
                                <div class="col-md-4"><h5 class="text-left"><b>Edit's Offer</b></h5></div>
                                <div class="col-sm-4 text-right"><h5>Offer Price:</h5></div>
                                <div class="col-sm-4 text-left"> 
                                    <input type="number" step="0.01" name="offer_price" placeholder="Offer amount" class=""style="border: 1px solid #000; border-radius:2px;"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="pb-15">
                                    <h5>Seller's Terms and Conditions</h5>
                                    <textarea type="text" name="terms_con" placeholder="" class="form-control" rows="5">{{ (isset($query[0]->quote_terms) ? $query[0]->quote_terms : '') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row container">
                                            <div class="col-md-12 pt-15">
                                                <b><h3>Vendor: <small>{{ $user[0]->shop_name }}</small></h3></b>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ $pro[0]->name }}" readonly>
                                            </div>
                                        <div class="col-md-12">
                                            <p class="text-dark" style="color: #000; font-weight: 600;">Instructions <br>
                                                To ask questions, View Product and messages Vendor <br>
                                                Decline: Rejects Quote <br>
                                                Make Offer: Adjust Total Cost <br>
                                                Accept: Proceed to Contract
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h5 class="text-left"><b>E-Signature *</b></h5>
                                    <div class="pb-15 d-flex justify-content-center signature">
                                        <a href="javascript:;" class="bg_blank" id="newsignature" onclick="newsign()">Signature</a> 
                                        <span id="newsignature_id"></span>
                                        <input type="text" name="newsignature" value="" hidden>
                                    </div>
                                    <div class="d-flex justify-content-center signature-dt">
                                        <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="order-tab"></div>
                            </div>
                        </div>
              `);
        $('#quoteform').attr('action', '{{ route('vendor-product-editoffer') }}');
        $('#cancel-btn').removeClass('d-none');
        $('#submit-btn').removeClass('d-none');
        $('#edit-btn').addClass('d-none');
        $('#accept-btn').addClass('d-none');
        $('#back-btn').addClass('d-none');
        $('#decline-btn').addClass('d-none');
          })
      })
      $('#cancel-btn').click(function(){
        $('#edit-form').remove();
        $('#cancel-btn').addClass('d-none');
        $('#submit-btn').addClass('d-none');
        $('#edit-btn').removeClass('d-none');
        $('#back-btn').removeClass('d-none');
        $('#accept-btn').removeClass('d-none');
        $('#declinet-btn').removeClass('d-none');

      })
  </script>
  <script>
      $(document).ready(function () {
          $('#accept-btn').click(function () {
              $('#order-tab').append(`
                        <div id="complete-form">
                            <hr style="height: 2px;background:#000;">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row container">
                                            <div class="col-md-12 pt-15">
                                                <b><h5><b>ANNEXTrades:</b> Bridge Consultant</h5></b>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ $pro[0]->name }}" readonly>
                                            </div>
                                        <div class="col-md-12">
                                            <p class="text-dark" style="color: #000; font-weight: 600;">NOTICE <br>
                                                 All items has been reviewed and deem in compliance with our company policy. 
                                                 Escrow details will be shared with parties to proceed with transaction. 
                                                 It is up to the parties involved to ensure that they complete the contractual agreement. 
                                                 ANNEXTrades cannot enforce or become involved in any litigation associated with this transaction. 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h5 class="text-left"><b>E-Signature *</b></h5>
                                    <div class="pb-15 d-flex justify-content-center signature">
                                        <a href="javascript:;" class="bg_blank" id="compsignature" onclick="compsign()">Signature</a> 
                                        <span id="compsignature_id"></span>
                                        <input type="text" name="compsignature" value="" hidden>
                                    </div>
                                    <div class="d-flex justify-content-center signature-dt">
                                        <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                    </div> 
                                </div>
                            </div>
                        </div>
              `);
        $('#quoteform').attr('action', '{{ route('vendor-product-editoffer') }}');
        $('#cancel-btn').removeClass('d-none');
        $('#complete-btn').removeClass('d-none');
        $('#decline-btn').addClass('d-none');
        $('#edit-btn').addClass('d-none');
        $('#accept-btn').addClass('d-none');
          })
      })
      $('#cancel-btn').click(function(){
          $('#complete-form').remove();
        $('#cancel-btn').addClass('d-none');
        $('#complete-btn').addClass('d-none');
        $('#decline-btn').removeClass('d-none');
        $('#accept-btn').removeClass('d-none');
        $('#edit-btn').removeClass('d-none');
      })
  </script>
  <script>
      $('#submitquote').click(function(){
          if($('input[name=signature]').val() == ''){
            alert('Please Signature The Quote.');
          }
      })
  </script>
  <script>
      $('#submit-btn').click(function(){
          if($('input[name=newsignature]').val() == ''){
            alert('Please Signature The Quote.');
            return false;
          }
          confirm('You are about to Submit Response.');
      })
  </script>
  <script>
      function printDiv() 
        {

        var divToPrint=document.getElementById('DivIdToPrint');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write(`<html><head>
            <link href="https://annextrades.com/assets/vendor/css/style.css" rel="stylesheet">
            <link href="https://annextrades.com/assets/vendor/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://annextrades.com/assets/vendor/css/fontawesome.css">

            </head><body onload="window.print()">`+divToPrint.innerHTML+`</body></html>`);

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

        }
  </script>
  <script>
    $(document).ready(function() {
        $('input[name=item_price]').change(function () {
            var item_price = $('input[name=item_price]').val();
            var item_qty = $('input[name=item_qty]').val();
            var total = item_price * item_qty;
            
            var newVal = parseFloat(total).toFixed(2);
            $('.subtotal').val(newVal);
            
            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());

            var sum = sub+sub1+sub2+ship+taxes;
            var newTotal = parseFloat(sum).toFixed(2)
            $('.total').val(newTotal);
        });
    });
    $(document).ready(function() {
        $('input[name=item_qty]').change(function () {
            var item_price = $('input[name=item_price]').val();
            var item_qty = $('input[name=item_qty]').val();

            var total = item_price * item_qty;
            var newVal = parseFloat(total).toFixed(2);
            $('.subtotal').val(newVal);
            
            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());

            var sum = sub+sub1+sub2+ship+taxes;
            var newTotal = parseFloat(sum).toFixed(2)
            $('.total').val(newTotal);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name=item_price1]').change(function () {
            var item_price = $('input[name=item_price1]').val();
            var item_qty = $('input[name=item_qty1]').val();
            var total = item_price * item_qty;
            
            var newVal = parseFloat(total).toFixed(2);
            $('.subtotal1').val(newVal);
            
            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());
            var sum = sub+sub1+sub2+ship+taxes;
            var newTotal = parseFloat(sum).toFixed(2)
            console.log(newTotal);
            $('.total').val(newTotal);
        });
    });
    $(document).ready(function() {
        $('input[name=item_qty1]').change(function () {
            var item_price = $('input[name=item_price1]').val();
            var item_qty = $('input[name=item_qty1]').val();
            var total = item_price * item_qty;
            
            var newVal = parseFloat(total).toFixed(2);
            $('.subtotal1').val(newVal);
            
            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());
            var sum = sub+sub1+sub2+ship+taxes;
            
            var newTotal = parseFloat(sum).toFixed(2) 
            $('.total').val(newTotal);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('input[name=item_price2]').change(function () {
            var item_price = $('input[name=item_price2]').val();
            var item_qty = $('input[name=item_qty2]').val();
            var total = item_price * item_qty;
            
            var newVal = parseFloat(total).toFixed(2);
            $('.subtotal2').val(newVal);
            
            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());
            var sum = sub+sub1+sub2+ship+taxes;

            var newTotal = parseFloat(sum).toFixed(2)
            $('.total').val(newTotal);
        });
    });
    $(document).ready(function() {
        $('input[name=item_qty2]').change(function () {
            var item_price = $('input[name=item_price2]').val();
            var item_qty = $('input[name=item_qty2]').val();
            var total = item_price * item_qty;
            
            var newVal = parseFloat(total).toFixed(2);
            $('.subtotal2').val(newVal);

            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());
           var sum = sub+sub1+sub2+ship+taxes;

           var newTotal = parseFloat(sum).toFixed(2)
            $('.total').val(newTotal);
        });
    });
    
</script>
<script>
    $(document).ready(function() {
        $('input[name=shipping]').change(function () {

            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());
            var sum = sub+sub1+sub2+ship+taxes;

            var newTotal = parseFloat(sum).toFixed(2);
            $('.total').val(newTotal);
        });
    });
    $(document).ready(function() {
        $('input[name=taxes]').change(function () {
            
            var sub = parseFloat($('.subtotal').val());
            var sub1 = parseFloat($('.subtotal1').val());
            var sub2 = parseFloat($('.subtotal2').val());
            var ship = parseFloat($('.shipping').val());
            var taxes = parseFloat($('.taxes').val());
           var sum = sub+sub1+sub2+ship+taxes;

           var newTotal = parseFloat(sum).toFixed(2)
            $('.total').val(newTotal);
        });
    });
    
</script>
<script>
    $('#signature').on('click', function () {
        var req = '{{ $pro[0]->id.$data[0]->id }}';
        var ven = '{{ Auth::user()->id }}';
        var ven_name = '{{ Auth::user()->name }}';
        
        $('#signature_id').html('<font class="sig">'+ven_name+`</font></br>`+req+ven+'Q');
        $('input[name=signature]').attr('value', req+ven+'Q')
        $('#signature').css('display', 'none');
        alert('Your Signature Code to Track your quote: '+req+ven+'Q');

    });
</script>
<script>
    function newsign () {
        var req = '{{ $pro[0]->id.$data[0]->id }}';
        var ven = '{{ Auth::user()->id }}';
        var ven_name = '{{ Auth::user()->name }}';
        $('#newsignature_id').html('<font class="sig">'+ven_name+`</font></br>`+req+ven+'E');
        $('input[name=newsignature]').attr('value', req+ven+'E')
        $('#newsignature').css('display', 'none');
        alert('Your Signature Code to Track your quote: '+req+ven+'E');

    };
</script>
<script>
    function newmakesign () {
        var req = '{{ $pro[0]->id.$data[0]->id }}';
        var ven = '{{ Auth::user()->id }}';
        var ven_name = '{{ Auth::user()->name }}';
        $('#newsignature_id').html('<font class="sig">'+ven_name+`</font></br>`+req+ven+'M');
        $('input[name=newsignature]').attr('value', req+ven+'M')
        $('#newsignature').css('display', 'none');
        alert('Your Signature Code to Track your quote: '+req+ven+'M');

    };
</script>
<script>
    function compsign () {
        var req = '{{ $pro[0]->id.$data[0]->id }}';
        var ven = '{{ Auth::user()->id }}';
        var ven_name = '{{ Auth::user()->name }}';
        $('#compsignature_id').html('<font class="sig">'+ven_name+`</font></br>`+req+ven+'C');
        $('input[name=compsignature]').attr('value', req+ven+'C')
        $('#compsignature').css('display', 'none');
        alert('Your Signature Code to Track your quote: '+req+ven+'C');

    };
</script>
<script>
      onclick="confirm('You are about to Submit Response.')"$('#submit quote').on('click', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var $this = $(this).parent();
        var data = $('#quoteform').serialize();
        $this.find('button.submit-btn').prop('disabled', true);
        $this.find('.alert-info').show();
        var processdata = $this.find('.mprocessdata').val();
        $this.find('.alert-info p').html(processdata);
        $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: data, 
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
            if (data == 1) {
                console.log(data);
                $this.find('.alert-success p').html(data.success[success]);
                $this.find('button.submit-btn').prop('disabled', false);
            } else {
                console.log(data);
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
                $this.find('.alert-info').hide();
                $this.find('.alert-danger').hide();
                $this.find('.alert-success').show();
                $this.find('.alert-success p').html(data);
                alert(data);
                $this.find('button.postsubmit').prop('disabled', true);
                $this.find('button.postsubmit').css('display', 'none');
                $this.find('#cpcode').prop('disabled', true);
                }
            }

            $('.refresh_code').click();

            }
        });
    });

</script>
  @endsection