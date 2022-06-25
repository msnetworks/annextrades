@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title">
									Post Requirement
								</h4>
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
								<div class="table-responsiv">
                                    <table class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                      <thead>
                                        <tr>
                                          <th>{{ __("Q No.") }}</th>
                                          <th>{{ __("Seller") }}</th>
                                          <th>{{ __("Company") }}</th>
                                          <th>{{ __("Q-Amount") }}</th>
                                          <th>{{ __("View Quote") }}</th>
                                          {{-- <th>{{ __("Status") }}</th> --}}
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                          $data = DB::table('postrequest_quotes')->where('request_id', $id)->orderBy('id','desc')->get();
                                          //dd($data);
                                          $i = 1;
                                          foreach ($data as $value) {
              
                                            $company = DB::table('users')->where('id', $value->user_id)->get();
                                            $post_company = DB::table('PostRequest')->where('request_id', $value->request_id)->get();
                                            
                                            $class = $value->status == 1 ? 'drop-success' : 'drop-danger';
                                                $s = $value->status == 1 ? 'selected' : '';
                                                $ns = $value->status == 0 ? 'selected' : '';
                                            $modal = "
                                            <div class='modal fade bd-example-modal-lg' id='Modal".$i."' tabindex='-1' role='dialog' aria-labelledby='Modal".$i."Label' aria-hidden='true'>
                                              <div class='modal-dialog  modal-lg' role='document'>
                                                <div class='modal-content'>
                                                  <div class='modal-header'>
                                                    <h5 class='modal-title'>".$post_company[0]->product_name."</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class='modal-body'>
                                                    <div class='deal-product row d-flex justify-content-center'>
                                                      <div class='col-md-11 quote-border p-15'>
                                                        <div class='row'>
                                                          <div class='col-md-6'>
                                                            <h5>Vendor</h5>
                                                            <div class='quote-border'>
                                                              <p class='quite-vendor-detail'>
                                                                ".$company[0]->shop_name."<br>
                                                                ".$company[0]->address."<br>
                                                                ".$company[0]->shop_message."<br>
                                                              </p>
                                                            </div>
                                                          </div>
                                                          <div class='col-md-2'>
                                                          </div>
                                                          <div class='col-md-4'>
                                                            <div class='pb-15'>
                                                              <h5>Quote #</h5>
                                                              <form action='#' method='POST' id='quoteform'>
                                                                <input type='text' class='form-control' name='request_id' value='".$post_company[0]->request_id."' readonly>
                                                            </div>
                                                            <h5>Exp. Date #</h5>
                                                            <input type='text' class='form-control' value='".$post_company[0]->deadline."' readonly>
                                                          </div>
                                                          <div class='col-md-6 pt-15'>
                                                            <div class='pb-15'>
                                                              <h5>Buyer</h5>
                                                              <input type='text' class='form-control' value='".$post_company[0]->company_name."' readonly>
                                                            </div>
                                                          </div>
                                                          <div class='col-md-12'>
                                                            <div class='pb-15'>
                                                              <h5>Product or Services Description</h5>
                                                              <textarea type='text' class='form-control' rows='5' readonly>".$post_company[0]->product_des."</textarea>
                                                            </div>
                                                          </div>
                                                          <div class='col-md-12'>
                                                            <table class='table table-striped table-light'>
                                                              <thead>
                                                                <tr>
                                                                  <th class='w-50' scope='col'>NAME</th>
                                                                  <th scope='col'>PRICE</th>
                                                                  <th scope='col'>QTY</th>
                                                                  <th scope='col'>SUBTOTAL</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                <tr>
                                                                  <th scope='row'><input type='text' class='input-name' placeholder='Item Name' value='".$value->item_name."' readonly></th>
                                                                  <td><input type='number' class='input-name' placeholder='0' min='0' name='item_price' value='".$value->item_price."' readonly></td>
                                                                  <td><input type='number' class='input-name price' placeholder='0' min='0' name='item_qty' value='".$value->item_qty."' readonly></td>
                                                                  <td><input type='number' class='input-name price subtotal' name='subtotal' value='".$value->subtotal."' readonly></td>
                                                                </tr>
                                                                <tr>
                                                                  <th scope='row'><input type='text' class='input-name' placeholder='Item Name' value='".$value->item_name1."' readonly></th>
                                                                  <td><input type='number' class='input-name' placeholder='0' min='0' name='item_price' value='".$value->item_price1."' readonly></td>
                                                                  <td><input type='number' class='input-name price' placeholder='0' min='0' name='item_qty' value='".$value->item_qty1."' readonly></td>
                                                                  <td><input type='number' class='input-name price subtotal' name='subtotal' value='".$value->subtotal1."' readonly></td>
                                                                </tr>
                                                                <tr>
                                                                  <th scope='row'><input type='text' class='input-name' placeholder='Item Name' value='".$value->item_name2."' readonly></th>
                                                                  <td><input type='number' class='input-name' placeholder='0' min='0' name='item_price' value='".$value->item_price1."' readonly></td>
                                                                  <td><input type='number' class='input-name price' placeholder='0' min='0' name='item_qty' value='".$value->item_qty2."' readonly></td>
                                                                  <td><input type='number' class='input-name price subtotal' name='subtotal' value='".$value->subtotal2."' readonly></td>
                                                                </tr>
                                                                <tr>
                                                                  <th></th>
                                                                  <th scope='row'>Shipping</th>
                                                                  <td></td>
                                                                  <td><input type='number' class='input-name shipping' name='shipping' value='".$value->shipping."' readonly></td>
                                                                </tr>
                                                                </tr>
                                                                <tr>
                                                                  <td></td>
                                                                  <th scope='row'>Taxes</th>
                                                                  <td></td>
                                                                  <td><input type='number' class='input-name taxes' name='taxes' value='".$value->taxes."' readonly></td>
                                                                </tr>
                                                                </tr>
                                                                <tr>
                                                                  <td></td>
                                                                  <th scope='row'>Total Cost</th>
                                                                  <td></td>
                                                                  <th scope='row'><input type='number' class='input-name input-name-total total text-bold' name='total' value='".$value->total."' readonly></th>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                          </div>
                                                          <div class='col-md-12'>
                                                            <div class='pb-15'>
                                                              <h5>Quote Terms and Conditions</h5>
                                                              <textarea type='text' name='quote_terms' class='form-control' rows='5' readonly>".$value->quote_terms."</textarea>
                                                            </div>
                                                          </div>
                                                          <div class='col-md-8'>
                                                            <div class='row container'>
                                                              <div class='col-md-12 pt-15'>
                                                                <p>".$company[0]->shop_name."</p>
                                                              </div>
                                                              <div class='col-md-6 signature-dt'>
                                                                <input type='text' class='input-name' value='".$company[0]->name."' readonly>
                                                              </div>
                                                              <div class='col-md-6 signature-dt'>
                                                                <input type='text' class='input-name' value='".$post_company[0]->product_name."' readonly>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class='col-md-4 text-right'>
                                                            <h5 class='text-left'><b>E-Signature *</b></h5>
                                                            <div class='pb-15 d-flex justify-content-center signature'>
                                                              <span><font class='sig'>".$company[0]->name."</font><br><font class='text'>".$value->signature."</font></span>
                                                            </div>
                                                            <div class='d-flex justify-content-center signature-dt'>
                                                              <input type='text' class='input-name' value='".$value->created_at."' readonly>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class='modal-footer'>
                                                    <!-- <button type='button' class='btn btn-primary'>Save changes</button> -->
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>";
                                            $status =  '<div class="action-list">
                                                    <select class="process select droplinks '.$class.'">
                                                      <option data-val="1" value="'. route('admin-postquote-status',['id1' => $value->id, 'id2' => 1]).'" '.$s.'>Accepted</option>
                                                      <option data-val="0" value="'. route('admin-postquote-status',['id1' => $value->id, 'id2' => 0]).'" '.$ns.'>Pending</option>
                                                    </select>
                                                  </div>';
                                            echo "
                                            <tr>
                                              <td>".$value->signature."</td>
                                              <td>".$post_company[0]->name."</td>
                                              <td>".$post_company[0]->company_name."</td>
                                              <td>".$value->total."</td>
                                              <td><a class='btn btn-primary' href='#' data-toggle='modal' data-target='#Modal".$i."'>View</a>$modal</td>
                                              <!--td>".$status."</td-->
                                            </tr>";
                                            $i++;
                                          }
                                        @endphp		
                                    </table>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>


@endsection

@section('scripts')

<script type="text/javascript">
    
          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var $type  = $(this).find('input[name=type]').val();
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/user/admin/user/send/message')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'type'   : $type
                  },
            success: function( data) {
          $('#subj1').prop('disabled', false);
          $('#msg1').prop('disabled', false);
          $('#subj1').val('');
          $('#msg1').val('');
        $('#emlsub1').prop('disabled', false);
        if(data == 0)
          toastr.error("{{ $langg->something_wrong }}");
        else
          toastr.success("{{ $langg->message_sent }}");
        $('.close').click();
            }

        });          
          return false;
        });

</script>


<script type="text/javascript">

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

@endsection