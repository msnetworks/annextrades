@extends('layouts.admin')

@section('content')
<style>
    table.dataTable tbody td {
        padding: 5px !important;
    }
</style>
<style>
    .dvImages1 {
        float: right;
        width: 100px;
        height: 100px;
        border: 1px solid green;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="hidden" id="headerdata" value="{{ __("POST YOUR REQUIREMENTS") }}">
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __("Add Contract") }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-government-contracts') }}">{{ __("All Contracts") }} </a>
                    </li>
                    <li>
                        <a href="#">{{ __("Add New Contract") }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">Enter Details</div>
                <form id="postdata" action="{{route('admin-government-contract-insert')}}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            {{csrf_field()}}
                            <div class="form-input col-md-12">
                                <br>
                                <label for="title">Title <span class="astrick text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="type">Type <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;" name="type" required="">
                                    <option value="">--Select Type--</option>
                                    <option value="federal">Federal</option>
                                    <option value="local">Local</option>
                                </select>
                                <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">Category <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;" name="category_id">
                                    <option value="0">--Select Category--</option>
                                    <?php foreach($all_categories as $category): ?>
                                    <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">State <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;" name="state">
                                    <option value="">--Select State--</option>
                                    <option value="US">US</option>
                                    <option value="UK">UK</option>
                                </select>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="naic_code">NAIC Code</label>
                                <input type="text" name="naic_code" class="form-control" id="naic_code" name="naic_code">
                            </div>

                            <div class="form-input col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control"
                                    placeholder="{{ __('Short description about product..') }}" cols="30"
                                    rows="7"></textarea> <br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Buyer</label>
                                <input type="text" name="buyer" class="form-control" id="buyer">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="deadline">Deadline</label>
                                <input type="date" name="deadline" class="form-control" id="deadline">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="agency">Agency</label>
                                <input type="text" name="agency" class="form-control" id="agency">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contract_link">Contract Link</label>
                                <input type="text" name="contract_link" class="form-control" id="contract_link">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="notice_id">Notice ID</label>
                                <input type="text" name="notice_id" class="form-control" id="notice_id">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="purchasing_department">Purchaseing Department</label>
                                <input type="text" name="purchasing_department" class="form-control"
                                    id="purchasing_department">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contact_officer_name">Contact Officer Name</label>
                                <input type="text" name="contact_officer_name" class="form-control"
                                    id="contact_officer_name">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contact_officer_number">Contact Officer Number</label>
                                <input type="text" name="contact_officer_number" class="form-control"
                                    id="contact_officer_number">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contact_officer_email">Contact Officer Email</label>
                                <input type="text" name="contact_officer_email" class="form-control"
                                    id="contact_officer_email">
                            </div>
                            <div class="form-input col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                                <label for="keywords">Keywords</label>
                                <textarea name="keywords" class="form-control" id="keywords" cols="30"
                                    rows="7"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('SUBMIT') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection