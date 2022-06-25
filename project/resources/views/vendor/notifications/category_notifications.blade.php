@extends('layouts.vendor')
@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
          <h4 class="heading">Category Notification</h4>

        <ul class="links">
          <li>
            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
          </li>
          <li>
            <a href="{{ route('vendor-category-notifications') }}">Category Notification</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <section>
    <div class="row">    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Choose Categories</div>
          <div class="card-body">
            @foreach($all_categories as $category)
              <div><input type="checkbox" id="category_ids" value="{{ $category->id }}" 
                @if(in_array($category->id, $total_selected_categories))
                  checked
                @endif
                /> {{ $category->name }}</div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
$(document).on("change", "[id=category_ids]",function(event){
  let id = $(this).val();
  if(event.target.checked) {
    $.ajax({
        type: 'GET',
        url: '{{ route('vendor-save-category-notification') }}',
        data: {vendor_id: '{{ Auth::user()->id }}', category_id: id},
        success: function(response){
            alert(response);
        }
    });
  } else {
    $.ajax({
        type: 'GET',
        url: '{{ route('vendor-delete-category-notification') }}',
        data: {vendor_id: '{{ Auth::user()->id }}', category_id: id},
        success: function(response){
            alert(response);
        }
    });
  }
});
</script>
@endsection