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
                <h4 class="heading">{{ __("Add New Post") }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-post-requirement') }}">{{ __("All Requests") }} </a>
                    </li>
                    <li>
                        <a href="#">{{ __("Add New Request") }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

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
                <form id="postdata" action="{{route('admin-addnew-insert-us')}}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            {{csrf_field()}}
                            <div class="form-input col-md-12">
                                <br>
                                <label for="title">Title <span class="astrick text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">Type <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;">
                                    <option value="">--Select Type--</option>
                                    <option value="federal">Federal</option>
                                    <option value="local">Local</option>
                                </select>
                                <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">Category <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;">
                                    <option value="0">--Select Category--</option>
                                    <?php foreach($all_categories as $category): ?>
                                    <option value="<?= $category->slug; ?>"><?= $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">Bookmark <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;">
                                    <option value="0">--Select Bookmark--</option>
                                    <?php foreach($all_bookmarks as $bookmark): ?>
                                    <option value="<?= $bookmark->slug; ?>"><?= $bookmark->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="companyname">State <span class="astrick text-danger">*</span></label>
                                <select class="form-control" style="width:100%;">
                                    <option value="">--Select State--</option>
                                    <option value="US">US</option>
                                    <option value="UK">UK</option>
                                </select>
                                <input type="hidden" name="postby_id" value="{{ Auth::user()->id }}" required="">
                            </div>
                            <div class="form-input col-md-12">
                                <label for="naic_code">NAIC Code</label>
                                <input type="text" name="naic_code" class="form-control" id="naic_code" required=""> </br>
                            </div>
                            
                            <div class="form-input col-md-12">
                                <label for="describe">Description</label>
                                <textarea name="short_des" class="form-control" placeholder="{{ __('Short description about product..') }}" cols="30" rows="7"></textarea> <br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Buyer</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Deadline</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Agency</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Contact Link</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Notice ID</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Purchaseing Department</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Contacting Officer Name</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Contact Officer Number</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div>
                            <div class="form-input col-md-12">
                                <label for="buyer">Contact Officer Email</label>
                                <input type="text" name="buyer" class="form-control" id="buyer" required=""> </br>
                            </div> 
                            <div class="form-input col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                                <label for="describe">Keywords</label>
                                <textarea name="product_des" class="form-control" id="describe" cols="30" rows="7"></textarea>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#order-tracking-modal"></a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="mybtn1 postsubmit">{{ __('SUBMIT') }}</button>
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



@section('scripts')
<script type="text/javascript">
    // add row
    var id = 1;


    $("#addRow").click(function () {

        var showId = $(":file").length;
        if (showId <= 4) {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="file" name="photo' + showId +
                '" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        }
        if (showId == 4) {
            $("#addRow").hide();
        }

    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
        $("#addRow").show();
    });
</script>
@endsection