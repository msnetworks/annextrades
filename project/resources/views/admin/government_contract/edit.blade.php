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
                <h4 class="heading">{{ __("Edit Contract") }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-government-contracts') }}">{{ __("All Contracts") }} </a>
                    </li>
                    <li>
                        <a href="#">{{ __("Edit Contract") }}</a>
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
                <form id="postdata" action="{{route('admin-government-contract-update')}}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            {{csrf_field()}}
                            <input type="hidden" value="<?= $details->id; ?>" name="id"/>
                            <div class="form-input col-md-12">
                                <br>
                                <label for="title">Title <span class="astrick text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title" required="" value="<?= $details->title; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="type">Type <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;" name="type" required="">
                                    <option value="">--Select Type--</option>
                                    <option value="Federal" <?= ($details->type == 'Federal') ? 'selected':''; ?> >Federal</option>
                                    <option value="State/Local" <?= ($details->type == 'State/Local') ? 'selected':''; ?> >State/Local</option>
                                </select>
                                <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">Category <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;" name="category_id">
                                    <option value="0">--Select Category--</option>
                                    <?php foreach($all_categories as $category): ?>
                                    <option value="<?= $category->id; ?>"
                                        <?= ($details->category_id == $category->id) ? 'selected' : ''; ?>
                                    ><?= $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">State</label>
                                <input type="text"class="form-control" id="state" disabled readonly value="<?= $details->state; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="naic_code">NAIC Code</label>
                                <input type="text" name="naic_code" class="form-control" id="naic_code" name="naic_code" value="<?= $details->naic_code; ?>">
                            </div>

                            <div class="form-input col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control"
                                    placeholder="{{ __('Short description about product..') }}" cols="30"
                                    rows="7"><?= $details->description; ?></textarea> <br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Buyer</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" value="<?= $details->buyer; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="deadline">Deadline</label>
                                <input type="date" name="deadline" class="form-control" id="deadline" value="<?= $details->deadline; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="agency">Agency</label>
                                <input type="text" name="agency" class="form-control" id="agency" value="<?= $details->agency; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contract_link">Contract Link</label>
                                <input type="text" name="contract_link" class="form-control" id="contract_link" value="<?= $details->contract_link; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="notice_id">Notice ID</label>
                                <input type="text" name="notice_id" class="form-control" id="notice_id" value="<?= $details->notice_id; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="purchasing_department">Purchasing Department</label>
                                <input type="text" name="purchasing_department" class="form-control" id="purchasing_department" value="<?= $details->purchasing_department; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contact_officer_name">Contact Officer Name</label>
                                <input type="text" name="contact_officer_name" class="form-control" id="contact_officer_name" value="<?= $details->contact_officer_name; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contact_officer_number">Contact Officer Number</label>
                                <input type="text" name="contact_officer_number" class="form-control" id="contact_officer_number" value="<?= $details->contact_officer_number; ?>">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="contact_officer_email">Contact Officer Email</label>
                                <input type="text" name="contact_officer_email" class="form-control" id="contact_officer_email" value="<?= $details->contact_officer_email; ?>">
                            </div>
                            <div class="form-input col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                                <label for="keywords">Keywords</label>
                                <textarea name="keywords" class="form-control" id="keywords" cols="30"rows="7"><?= $details->keywords; ?></textarea>
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