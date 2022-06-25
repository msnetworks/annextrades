@extends('layouts.vendor')
@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
          <h4 class="heading">Location Notification</h4>

        <ul class="links">
          <li>
            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
          </li>
          <li>
            <a href="{{ route('vendor-location-notifications') }}">Location Notification</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <section>
    <div class="row">    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Choose Locations</div>
          <div class="card-body">
            @foreach($all_states as $state)
              <div>
                <input type="checkbox"
                id="state_ids" value="{{ $state->state }}" 
                @if(in_array($state->state, $total_selected_states))
                  checked
                @endif
                />
                {{ $state->state }}
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
  
<script>
  $(document).on("change", "[id=state_ids]",function(event){
    let id = $(this).val();
    if(event.target.checked) {
      $.ajax({
          type: 'GET',
          url: '{{ route('vendor-save-location-notification') }}',
          data: {vendor_id: '{{ Auth::user()->id }}', state: id},
          success: function(response){
              alert(response);
          }
      });
    } else {
      $.ajax({
          type: 'GET',
          url: '{{ route('vendor-delete-location-notification') }}',
          data: {vendor_id: '{{ Auth::user()->id }}', state: id},
          success: function(response){
              alert(response);
          }
      });
    }
  });
  </script>
@endsection