@extends('layouts.vendor')
@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
          <h4 class="heading">Personalised Notification</h4>

        <ul class="links">
          <li>
            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
          </li>
          <li>
            
          </li>
        </ul>
      </div>
    </div>
  </div>
  <section>
    <div class="row">    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Choose Personalized Notifications</div>
          <div class="card-body">
            Enable Email Notification
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
  
@endsection