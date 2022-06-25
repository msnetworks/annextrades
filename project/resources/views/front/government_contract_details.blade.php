@extends('layouts.front')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div style="background:#ededed;padding:10px 100px;font-size:20px;margin:10px 0px;">Buyer: <span class="text-primary">DEPT OF DEFENSE</span></div>
  </div>
</div>
<style>
  .common{

  }
  .even{
    background:#B4C6E7;
  }
  .odd{
    background:#D0CECE;
  }
</style>
<div class="row">
  <div class="col-md-6 offset-md-3">
    <table class="table table-striped">
      <tbody>
        <tr>
          <td class="even text-right" widtd="50%;">Buyer:</td>
          <td>{{$details->buyer}}</td>
        </tr>
        <tr>
          <td class="odd text-right">Title:</td>
          <td>{{$details->title}}</td>
        </tr>
        <tr>
          <td class="even text-right">Contract Link:</td>
          <td>{{$details->contract_link}}</td>
        </tr>
        <tr>
          <td class="odd text-right">Contract Submittle Deadline:</td>
          <td>{{$details->deadline}}</td>
        </tr>
        <tr>
          <td class="even text-right">Notice ID:</td>
          <td>{{$details->notice_id}}</td>
        </tr>
        <tr>
          <td class="odd text-right">Purchase Department:</td>
          <td>{{$details->purchasing_department}}</td>
        </tr>
        <tr>
          <td class="even text-right">Contracting Officer Name:</td>
          <td>{{$details->contact_officer_name}}</td>
        </tr>
        <tr>
          <td class="odd text-right">Contracting Officer Number:</td>
          <td>{{$details->contact_officer_number}}</td>
        </tr>
        <tr>
          <td class="even text-right">Contracting Officer  Email:</td>
          <td>{{$details->contact_officer_email}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <table class="table table-striped">
      <tbody>
        <tr>
          <td style="background-color:#B4C6E7;text-align:center;">General Description</td>
        </tr>
        <tr>
          <td class="" style="border:2px solid #ededed;">{{$details->description}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <table class="table table-striped">
      <tbody>
        <tr>
          <td style="background-color:#ededed;text-align:center;">Scope of Work / Product List</td>
        </tr>
        <tr>
          <td class="" style="border:2px solid #ededed;"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

 {{ $details->id }}
@endsection