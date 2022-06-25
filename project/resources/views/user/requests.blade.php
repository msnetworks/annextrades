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
									Requests
								</h4>
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
								<div class="table-responsiv">
                                    <table class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                      <thead>
                                        <tr>
                                          <th>{{ __("Product Name") }}</th>
                                          <th>{{ __("Request Quantity") }}</th>
                                          <th>{{ __("Status") }}</th>
                                          <th>{{ __("Dated") }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                          $data = DB::table('order_bulk')->get();
                                        @endphp
                                          @foreach ($data as $key) 
                                            @php
                                              $product = DB::table('products')->where('id', $key->product_id)->where('user_id', Auth::guard('web')->user()->id)->get();
                                            @endphp
                                          @foreach ($product as $pro) 
                                              @php
                                                $user = DB::table('users')->where('id', $pro->user_id)->get();
                                              @endphp
                                                @foreach ($user as $value) 
                                                <tr>
                                                  <td>{{ $pro->name }}</td>
                                                  <td>{{ $key->quantity }}</td>
                                                  <td>{{ __('Active') }}</td>
                                                  <td>{{ $key->created_at }}</td>
                                                </tr>
                                              @endforeach
                                            @endforeach 
                                          @endforeach	
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