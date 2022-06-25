@extends('layouts.admin') 
 
@section('content')  
<style>
    .nav-tabs .active{
        background-color: #2d3274 !important;
        color: #fff!important;
        font-weight: 800!important;
    }
    .nav-tabs .nav-item{
        color: #2d3274;
    }
    .submit-btn{
        background-color: #2d3274 !important;
        color: #fff!important;
        font-weight: 800!important;
        width: 100%;
        height: 50px;
        border: 0px;
        border-radius: 1px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="content-area">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <div class="card">
        <div class="card-header">Import (Only CSV File)</div>
        <form action="{{route('admin-government-contract-import')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="card-body text-center p-5">
            <a href="{{asset('assets/government_contract_sample.csv')}}" download>
              <span><button class="btn btn-success btn-flat" type="button"><i class="fa fa-download"></i>&nbsp;Sample File Download</button></span><br/><br/>
            </a>
              <div class="form-input">
                  <input type="file" class="dropify" name="csvfile"/>
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="submit-btn">UPLOAD</button>
          </div>
        </form>
      </div>  
    </div>
  </div>
</div>

@endsection    

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('.dropify').dropify();
</script>
@endsection   