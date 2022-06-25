@extends('layouts.front')


@section('content')

<style>
    table{
        font-size: 13px;
    }
</style>
<link rel="stylesheet" href="https://github.com/downloads/lafeber/world-flags-sprite/flags32.css">
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
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
        @if(Auth::guard('web')->check())
            
                <div class="container-fluid">
                    <div class="col-md-12 header bg-light h3 text-primary">
                        <div class="container">
                            {{ $data[0]->company_name }}
                        </div>
                    </div>
                    <div class="container">
                        @include('includes.admin.form-login')
                        <div class="deal-product row d-flex justify-content-center">
                            <div class="col-md-7 quote-border p-15">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Vendor</h5>
                                        <div class="quote-border">
                                            <p class="quite-vendor-detail">
                                                <input type="text" class="input-name" name="vendor_name" value="{{ Auth::user()->name }}"><br>
                                                <input type="text" class="input-name" name="postby_id" value="{{ $data[0]->user_id }}"><br>
                                                {{ Auth::user()->address }}<br>
                                                {{ Auth::user()->shop_message }}<br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pb-15">
                                            <h5>Quote #</h5>
                                            <form action="{{ route('quote-submit') }}" enctype="multipart/form-data" method="POST" id="quoteform">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}" readonly>
                                                <input type="text" class="form-control" name="request_id" value="{{ $data[0]->request_id }}" readonly>
                                        </div>
                                        <h5>Exp. Date #</h5>
                                        <input type="text" class="form-control" value="{{ $data[0]->deadline }}" readonly>
                                    </div>
                                    <div class="col-md-6 pt-15">
                                        <div class="pb-15">
                                            <h5>Buyer</h5>
                                            <input type="text" class="form-control" value="{{ $data[0]->company_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pb-15">
                                            <h5>Product or Services Description</h5>
                                            <div style="max-height: 300px; overflow: scroll; border: 1px solid #c7c7c7; border-radius: 5px; padding: 5px;">{!! html_entity_decode(htmlspecialchars_decode($data[0]->product_des)) !!}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @php
                                            $id = $data[0]->request_id.Auth::user()->id;
                                            $query = DB::table('postrequest_quotes')->where('signature','like', '%'.$id.'%')->get();
                                            //echo $id;
                                        @endphp
                                        {{-- {{ dd($query) }} --}}
                                        @if ($query->count() == 0)
                                            <table class="table table-striped table-light">
                                                <thead>
                                                    <tr>
                                                        <th class="w-50" scope="col">NAME</th>
                                                        <th scope="col">PRICE</th>
                                                        <th scope="col">QTY</th>
                                                        <th scope="col">SUBTOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"><input type="text" class="input-name" placeholder="Item Name" name="item_name" required></th>
                                                        <td><input type="number" class="input-name" placeholder="0" min="0" name="item_price" required></td>
                                                        <td><input type="number" class="input-name price" placeholder="0" min="0" name="item_qty" required></td>
                                                        <td><input type="number" class="input-name price subtotal" name="subtotal" value="0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><input type="text" class="input-name" placeholder="Item Name" name="item_name1"></th>
                                                        <td><input type="number" class="input-name" placeholder="0" min="0" value="0" name="item_price1"></td>
                                                        <td><input type="number" class="input-name price" placeholder="0" min="0" value="0" name="item_qty1"></td>
                                                        <td><input type="number" class="input-name subtotal1" name="subtotal1" value="0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><input type="text" class="input-name" placeholder="Item Name" name="item_name2"></th>
                                                        <td><input type="number" class="input-name" placeholder="0" min="0" name="item_price2"></td>
                                                        <td><input type="number" class="input-name price" placeholder="0" min="0" name="item_qty2"></td>
                                                        <td><input type="number" class="input-name subtotal2" name="subtotal2" value="0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="row">Shipping</th>
                                                        <td></td>
                                                        <td><input type="number" class="input-name shipping" name="shipping" value="0"></td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th scope="row">Taxes</th>
                                                        <td></td>
                                                        <td><input type="number" class="input-name taxes" name="taxes" value="0"></td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th scope="row">Total Cost</th>
                                                        <td></td>
                                                        <th scope="row"><input type="number" class="input-name input-name-total total text-bold" name="total" value="0" readonly></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <table class="table table-striped table-light">
                                                <thead>
                                                    <tr>
                                                        <th class="w-50" scope="col">NAME</th>
                                                        <th scope="col">PRICE</th>
                                                        <th scope="col">QTY</th>
                                                        <th scope="col">SUBTOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"><input type="text" class="input-name" placeholder="Item Name" value="{{ $query[0]->item_name }}" readonly></th>
                                                        <td><input type="number" class="input-name" placeholder="0" min="0" name="item_price" value="{{ $query[0]->item_price }}" readonly></td>
                                                        <td><input type="number" class="input-name price" placeholder="0" min="0" name="item_qty" value="{{ $query[0]->item_qty }}" readonly></td>
                                                        <td><input type="number" class="input-name price subtotal" name="subtotal" value="{{ $query[0]->subtotal }}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><input type="text" class="input-name" placeholder="Item Name" value="{{ $query[0]->item_name1 }}" readonly></th>
                                                        <td><input type="number" class="input-name" placeholder="0" min="0" name="item_price" value="{{ $query[0]->item_price1 }}" readonly></td>
                                                        <td><input type="number" class="input-name price" placeholder="0" min="0" name="item_qty" value="{{ $query[0]->item_qty1 }}" readonly></td>
                                                        <td><input type="number" class="input-name price subtotal" name="subtotal" value="{{ $query[0]->subtotal1 }}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><input type="text" class="input-name" placeholder="Item Name" value="{{ $query[0]->item_name2 }}" readonly></th>
                                                        <td><input type="number" class="input-name" placeholder="0" min="0" name="item_price" value="{{ $query[0]->item_price2 }}" readonly></td>
                                                        <td><input type="number" class="input-name price" placeholder="0" min="0" name="item_qty" value="{{ $query[0]->item_qty2 }}" readonly></td>
                                                        <td><input type="number" class="input-name price subtotal" name="subtotal" value="{{ $query[0]->subtotal2 }}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="row">Shipping</th>
                                                        <td></td>
                                                        <td><input type="number" class="input-name shipping" name="shipping" value="{{ $query[0]->shipping }}" readonly></td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th scope="row">Taxes</th>
                                                        <td></td>
                                                        <td><input type="number" class="input-name taxes" name="taxes" value="{{ $query[0]->taxes }}" readonly></td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <th scope="row">Total Cost</th>
                                                        <td></td>
                                                        <th scope="row"><input type="number" class="input-name input-name-total total text-bold" name="total" value="{{ $query[0]->total }}" readonly></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                    @if ($query->count() == 0)
                                        <div class="col-md-12">

                                            <div class="row pb-15">
                                                <div class="form-input col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <label for="photos"> Document for Verification</label><br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input id="uploadImage1" type="file" name="photo" class="form-control" onchange="PreviewImage();" /> </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input id="uploadImage2" type="file" name="photo1" class="form-control" onchange="PreviewImage();" /> </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input id="uploadImage3" type="file" name="photo2" class="form-control" onchange="PreviewImage();" /> </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input id="uploadImage4" type="file" name="photo3" class="form-control" onchange="PreviewImage();" /> </br>
                                                </div>
                                                <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input id="uploadImage5" type="file" name="photo4" class="form-control" onchange="PreviewImage();" /> </br>
                                                </div>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="pb-15">
                                                <h5>Quote Terms and Conditions</h5>
                                                <textarea type="text" name="quote_terms" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="pb-15">
                                                <h5>Quote Terms and Conditions</h5>
                                                <textarea type="text" name="quote_terms" class="form-control" rows="5" readonly>{{ $query[0]->quote_terms }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-8">
                                        <div class="row container">
                                            <div class="col-md-12 pt-15">
                                                <p>{{ Auth::user()->shop_name }}</p>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="col-md-6 signature-dt">
                                                <input type="text" class="input-name" value="{{ $data[0]->product_name }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <h5 class="text-left"><b>E-Signature *</b></h5>
                                        <div class="pb-15 d-flex justify-content-center signature">
                                            @if ($query->count() == 0)
                                                <span class="bg_blank" id="signature">Signature</span> 
                                                <span id="signature_id"></span>
                                                <input type="text" name="signature" value="" required hidden>
                                            @else
                                                <span><font class="sig">{{ Auth::user()->name }}</font><br><font class="text">{{ $query[0]->signature }}</font></span>
                                                
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-center signature-dt">
                                            <input type="date" class="input-name" value="<?php echo date("Y-m-d");?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12 button-section">
                                        @if ($query->count() == 0)
                                            <button type="submit" value="active" id="submitquote" class="active btn btn-danger">Submit Quote</button>
                                        @else
                                            <button class="active btn btn-danger" disabled>Submit Quote</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif 
        </section>
    <script>
        $(document).ready(function() {
            $('input[name=item_price]').change(function () {
                var item_price = $('input[name=item_price]').val();
                var item_qty = $('input[name=item_qty]').val();
                $('.subtotal').prop('value', item_price * item_qty);

                
                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());

                var sum = sub+sub1+sub2+ship+taxes;

                $('.total').attr('value', sum);
            });
        });
        $(document).ready(function() {
            $('input[name=item_qty]').change(function () {
                var item_price = $('input[name=item_price]').val();
                var item_qty = $('input[name=item_qty]').val();
                $('.subtotal').prop('value', item_price * item_qty);
                
                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());

                var sum = sub+sub1+sub2+ship+taxes;

                $('.total').attr('value', sum);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name=item_price1]').change(function () {
                var item_price = $('input[name=item_price1]').val();
                var item_qty = $('input[name=item_qty1]').val();
                $('.subtotal1').prop('value', item_price * item_qty);
                
                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());
                var sum = sub+sub1+sub2+ship+taxes;
                $('.total').attr('value', sum);
            });
        });
        $(document).ready(function() {
            $('input[name=item_qty1]').change(function () {
                var item_price = $('input[name=item_price1]').val();
                var item_qty = $('input[name=item_qty1]').val();
                $('.subtotal1').prop('value', item_price * item_qty);
                
                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());
                var sum = sub+sub1+sub2+ship+taxes;
                
                $('.total').attr('value', sum);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name=shipping]').change(function () {

                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());
                var sum = sub+sub1+sub2+ship+taxes;

                    $('.total').attr('value', sum);
            });
        });
        $(document).ready(function() {
            $('input[name=taxes]').change(function () {
                
                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());
               var sum = sub+sub1+sub2+ship+taxes;

                $('.total').attr('value', sum);
            });
        });
        
    </script>
    <script>
        $(document).ready(function() {
            $('input[name=item_price2]').change(function () {
                var item_price = $('input[name=item_price2]').val();
                var item_qty = $('input[name=item_qty2]').val();
                $('.subtotal2').prop('value', item_price * item_qty);
                
                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());
                var sum = sub+sub1+sub2+ship+taxes;

                    $('.total').attr('value', sum);
            });
        });
        $(document).ready(function() {
            $('input[name=item_qty2]').change(function () {
                var item_price = $('input[name=item_price2]').val();
                var item_qty = $('input[name=item_qty2]').val();
                $('.subtotal2').prop('value', item_price * item_qty);

                var sub = parseInt($('.subtotal').val());
                var sub1 = parseInt($('.subtotal1').val());
                var sub2 = parseInt($('.subtotal2').val());
                var ship = parseInt($('.shipping').val());
                var taxes = parseInt($('.taxes').val());
               var sum = sub+sub1+sub2+ship+taxes;

                $('.total').attr('value', sum);
            });
        });
        
    </script>
    <script>
        $('#signature').on('click', function () {
            var req = $('input[name=request_id]').val();
            var ven = $('input[name=vendor_id]').val();
            var ven_name = $('input[name=vendor_name]').val();
            
            $('#signature_id').html('<font class="sig">'+ven_name+`</font></br>`+req+ven+'Q');
            $('input[name=signature]').attr('value', req+ven+'Q')
            $('#signature').css('display', 'none');
            alert('Your Signature Code to Track your quote: '+req+ven+'Q');

        });
    </script>
    <script>
        $('#submit quote').on('click', function (e) {
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