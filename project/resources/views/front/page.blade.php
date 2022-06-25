@extends('layouts.front')
@section('content')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area lr-30">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index') }}">
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('front.page',$page->slug) }}">
              {{ $page->title }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->



<section class="about lr-30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-info text-center">
            <h4 class="title text-center"  style="color: #ff7900;">
              <u><b>{{ $page->title }}</b></u><br><br>
            </h4>
            <p>
              {!! $page->details !!}
            </p>

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection