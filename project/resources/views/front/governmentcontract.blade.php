@extends('layouts.front')


@section('content')
 
<style>
    table{
        font-size: 13px;
    }
    	
    div.container { max-width: 1200px }
</style>
<link rel="stylesheet" href="https://github.com/downloads/lafeber/world-flags-sprite/flags32.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" src="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>
<style>
    tr td.details-control {
      background: url('https://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
      cursor: pointer;
    }
    tr.dt-hasChild td.details-control {
      background: url('https://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
    table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
    }
</style>
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
                        <a href="{{ route('government-contract') }}">
                            {{ __('Government Contract') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
    <section class="deals-section">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="title-dealbulletain">
                    <div class="row deal-title">
                        <div class="col-sm-6 col-md-3 dealsbulletain-title p-0">Government Contract &nbsp;&nbsp; <i class="fa fa-star"></i> 
                            @if(!Auth::guard('web')->check())
                            (0)
                            @else 
                                <span id="fav-count"></span>
                            @endif 
                        </div>
                        <div class="col-sm-6 col-md-9 p-0">
                            @if(!Auth::guard('web')->check())
                                <a href="{{ route('user.login') }}" class="v-center">
                                    <span>{{ $langg->lang12 }}</span> <span>|</span>
                                    <span>{{ $langg->lang13 }}</span>
                                </a>
                                @else
                                
                                    <div class="dropdown v-center">
                                        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text">
                                                <i class="far fa-user"></i>Hi,	{{ Auth::user()->name }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('user-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
                                        @if (Auth::user()->is_vendor) 
                                        <a class="dropdown-item" href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('user-profile') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
                                        <a class="dropdown-item" href="{{ route('user-logout') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <font class="border bid-class">
                                Deals search
                            </font>
                            <hr style="margin-top: 0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Area Start -->
    <section class="user-dashbord">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="keyword" placeholder="Search By Keyword"/>
                </div>
                <div class="col-md-1">
                    <button id="btn_keyword" class="btn btn-primary">Search</button>
                </div>
                <div class="col-md-4">
                    <select class="form-control" id="category_id">
                        <option value="all">All</option>
                        <?php foreach($all_categories as $category): ?>
                            <option value="<?= $category->id; ?>" <?= ($category->id == 44) ? 'selected': ''; ?> >
                                <?php if(!empty($category->display_name)): ?>
                                    <?= $category->display_name; ?>
                                <?php else: ?>
                                    <?= $category->name; ?>
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="naic_code" placeholder="Search by NAICS Code"/>
                </div>
                <div class="col-md-1">
                    <button id="btn_naic_code" class="btn btn-primary">Search</button>
                </div>
            </div>
            <br/>
            <div class="row justify-content-between">
                <div class="order-2 order-sm-2 order-md-1 order-lg-1 col-xl-2 col-lg-2 col-md-12">
                    <div class="row sorting mb-5">
                        <div class="col-12">
                            <a class="btn btn-light">
                                <i class="fas fa-filter mr-2"></i> FILTER
                            </a>
                            <div class="btn-group float-md-right">
                                <a class="btn btn-light"><span class="fa fa-gear mr-2"></span> <span class="fa fa-caret-down"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 order-md-1 col-lg-12 sidebar-filter">
                        
                        <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">Type</h6>
                        <div class="mt-2 mb-2 pl-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="type" value="local"  id="filter-size-local-state">
                                <label class="custom-control-label" for="filter-size-local-state">State/Local</label>
                            </div>  
                        </div>
                        <div class="mt-2 mb-2 pl-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="type" value="federal" id="filter-size-my-fedeal">
                                <label class="custom-control-label" for="filter-size-my-fedeal">Federal</label>
                            </div>  
                        </div>

                        <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
                        <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">Refine</h6>
                        <?php foreach($all_special_categories as $scategory): ?>
                            <?php if(!empty($scategory->special_category)): ?>
                            <div class="mt-2 mb-2 pl-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="refine" value="{{$scategory->special_category}}" id="filter-size-{{$scategory->special_category}}">
                                    <label class="custom-control-label" for="filter-size-{{$scategory->special_category}}" ><?= $scategory->special_category; ?></label>
                                </div>  
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        @if(Auth::guard('web')->check())
                        <div class="mt-2 mb-2 pl-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="refine" value="favourite" id="filter-size-my-favourite">
                                <label class="custom-control-label" for="filter-size-my-favourite">My Favorite</label>
                            </div>  
                        </div>
                        @endif
                        <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
                        


                        <div class="accordion" id="accordionExample">
                            <h2 class="mb-0">
                                <h6 class="text-uppercase mt-5 mb-3 font-weight-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-caret-right"></i>&nbsp;Location</h6>
                            </h2>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="max-height: 200px;overflow-y: scroll;">
                                <div class="mt-2 mb-2 pl-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="all" name="states" id="filter-size-all">
                                        <label class="custom-control-label" for="filter-size-all">All</label>
                                    </div>
                                </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="AL" name="states" id="filter-size-AL">
                                            <label class="custom-control-label" for="filter-size-AL">ALABAMA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="AK" name="states" id="filter-size-AK">
                                            <label class="custom-control-label" for="filter-size-AK">ALASKA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="AZ" name="states" id="filter-size-AZ">
                                            <label class="custom-control-label" for="filter-size-AZ">ARIZONA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="AR" name="states" id="filter-size-AR">
                                            <label class="custom-control-label" for="filter-size-AR">ARKANSAS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="CA" name="states" id="filter-size-CA">
                                            <label class="custom-control-label" for="filter-size-CA">CALIFORNIA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="CT" name="states" id="filter-size-CT">
                                            <label class="custom-control-label" for="filter-size-CT">CONNECTICUT</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="DE" name="states" id="filter-size-DE">
                                            <label class="custom-control-label" for="filter-size-DE">DELAWARE</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="DC" name="states" id="filter-size-DC">
                                            <label class="custom-control-label" for="filter-size-DC">DISTRICT OF COLUMBIA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="GA" name="states" id="filter-size-GA">
                                            <label class="custom-control-label" for="filter-size-GA">GEORGIA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="GU" name="states" id="filter-size-GU">
                                            <label class="custom-control-label" for="filter-size-GU">GUAM</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="HI" name="states" id="filter-size-HI">
                                            <label class="custom-control-label" for="filter-size-HI">HAWAII</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="ID" name="states" id="filter-size-ID">
                                            <label class="custom-control-label" for="filter-size-ID">IDAHO</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="IL" name="states" id="filter-size-IL">
                                            <label class="custom-control-label" for="filter-size-IL">ILLINIOS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="IN" name="states" id="filter-size-IN">
                                            <label class="custom-control-label" for="filter-size-IN">INDIANA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="IA" name="states" id="filter-size-IA">
                                            <label class="custom-control-label" for="filter-size-IA">IOWA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="KS" name="states" id="filter-size-KS">
                                            <label class="custom-control-label" for="filter-size-KS">KANSAS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="KY" name="states" id="filter-size-KY">
                                            <label class="custom-control-label" for="filter-size-KY">KENTUCKY</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="LA" name="states" id="filter-size-LA">
                                            <label class="custom-control-label" for="filter-size-LA">LOUISIANA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="ME" name="states" id="filter-size-ME">
                                            <label class="custom-control-label" for="filter-size-ME">MAINE</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="MD" name="states" id="filter-size-MD">
                                            <label class="custom-control-label" for="filter-size-MD">MARRYLAND</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="ME" name="states" id="filter-size-ME">
                                            <label class="custom-control-label" for="filter-size-MA">MASSACHUSETTS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="MI" name="states" id="filter-size-MI">
                                            <label class="custom-control-label" for="filter-size-MI">MICHIGAN</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="MN" name="states" id="filter-size-MN">
                                            <label class="custom-control-label" for="filter-size-MN">MINNESOTA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="MS" name="states" id="filter-size-MS">
                                            <label class="custom-control-label" for="filter-size-MS">MISSISSIPPI</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="MO" name="states" id="filter-size-MO">
                                            <label class="custom-control-label" for="filter-size-MO">MISSOURI</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="MT" name="states" id="filter-size-MT">
                                            <label class="custom-control-label" for="filter-size-MT">MONTANA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NE" name="states" id="filter-size-NE">
                                            <label class="custom-control-label" for="filter-size-NE">NEBRASKA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NV" name="states" id="filter-size-NV">
                                            <label class="custom-control-label" for="filter-size-NV">NEVADA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NH" name="states" id="filter-size-NH">
                                            <label class="custom-control-label" for="filter-size-NH">NORTH HAMPSHIRE</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NJ" name="states" id="filter-size-NJ">
                                            <label class="custom-control-label" for="filter-size-NJ">NEW JERSEY</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NM" name="states" id="filter-size-NM">
                                            <label class="custom-control-label" for="filter-size-NM">NEW MEXICO</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NY" name="states" id="filter-size-NY">
                                            <label class="custom-control-label" for="filter-size-NY">NEW YORK</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="NC" name="states" id="filter-size-NC">
                                            <label class="custom-control-label" for="filter-size-NC">NORTH CAROLINA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="ND" name="states" id="filter-size-ND">
                                            <label class="custom-control-label" for="filter-size-ND">NORTH DAKOTA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="CM" name="states" id="filter-size-CM">
                                            <label class="custom-control-label" for="filter-size-CM">NORTH MARIANA ISLANDS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="OH" name="states" id="filter-size-OH">
                                            <label class="custom-control-label" for="filter-size-OH">OHIO</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="OK" name="states" id="filter-size-OK">
                                            <label class="custom-control-label" for="filter-size-OK">OKLAHOMA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="OR" name="states" id="filter-size-OR">
                                            <label class="custom-control-label" for="filter-size-OR">OREGON</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="PA" name="states" id="filter-size-PA">
                                            <label class="custom-control-label" for="filter-size-PA">PENNSYLVANIA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="PR" name="states" id="filter-size-PR">
                                            <label class="custom-control-label" for="filter-size-PR">PUERTO RICO</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="RI" name="states" id="filter-size-RI">
                                            <label class="custom-control-label" for="filter-size-RI">RHODE ISLAND</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="SC" name="states" id="filter-size-SC">
                                            <label class="custom-control-label" for="filter-size-SC">SOUTH CAROLINA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="SD" name="states" id="filter-size-SD">
                                            <label class="custom-control-label" for="filter-size-SD">SOUTH DAKOTA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="TN" name="states" id="filter-size-TN">
                                            <label class="custom-control-label" for="filter-size-TN">TENNESSEE</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="TX" name="states" id="filter-size-TX">
                                            <label class="custom-control-label" for="filter-size-TX">TEXAS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="TT" name="states" id="filter-size-TT">
                                            <label class="custom-control-label" for="filter-size-TT">TRUST TERRITORIES</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="UT" name="states" id="filter-size-UT">
                                            <label class="custom-control-label" for="filter-size-UT">UTAH</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="VT" name="states" id="filter-size-VT">
                                            <label class="custom-control-label" for="filter-size-VT">VERMONT</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="VA" name="states" id="filter-size-VA">
                                            <label class="custom-control-label" for="filter-size-VA">VIRGINIA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="VI" name="states" id="filter-size-VI">
                                            <label class="custom-control-label" for="filter-size-VI">VIRGIN ISLANDS</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="WA" name="states" id="filter-size-WA">
                                            <label class="custom-control-label" for="filter-size-WA">WASHINGTON</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="WV" name="states" id="filter-size-WV">
                                            <label class="custom-control-label" for="filter-size-WV">WEST VIRGINIA</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="WI" name="states" id="filter-size-WI">
                                            <label class="custom-control-label" for="filter-size-WI">WISCONSIN</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2 pl-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="WY" name="states" id="filter-size-WY">
                                            <label class="custom-control-label" for="filter-size-WY">WYOMING</label>
                                        </div>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="order-1 order-sm-1 order-md-2 order-lg-2 col-xl-10 col-lg-10 col-md-12">
                    <div class="table-responsive">
                        <table id="datatable" class="display nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="white-space: normal!important">View More</th>
                                    <th>{{ __("Fav") }}</th>
                                    <th style="width: 25% !important; white-space: normal!important;">{{ __("Title") }}</th>
                                    <th style="width: 25% !important; white-space: normal!important;">{{ __("Description") }}</th>
                                    <th style="width: 20% !important; white-space: normal!important;">{{ __("Buyer") }}</th>
                                    <th style="width: 10% !important; white-space: normal!important;">{{ __("Location") }}</th>
                                    <th style="width: 10% !important; white-space: normal!important;" class="none">{{ __("Type") }}</th>
                                    <th style="width: 10% !important; white-space: normal!important;" class="none">{{ __("Notice ID") }}</th>
                                    <th style="width: 10% !important; white-space: normal!important;">{{ __("Dead Line") }}</th>
                                    <th style="width: 10% !important; white-space: normal!important;" class="none">{{ __("Agency") }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Area End-->

    <section class="blue-space">
        <div class="container-fluid text-center text-white blue-space-text" style="color: #fff!important;">
            <h2 style="color: #fff!important;"><b>FISCAL YEAR END 2022 SPENDING </b></h2>
            <p style="color: #fff!important;">The Value of Goods Imported to USA in 2020 totaled $2.4 Trillion. <br> The Federal Government Contracted for over $630 Billion in FYE September 30, 2020. <br>
                Small businesses were awarded approx. $150 Billion in U.S. Government Contracts. </p>
                <h2 style="color: #fff!important;"><b>2022 Fiscal Year Budget $7.16 Trillion </b></h2>
                <h4 style="color: #fff!important;">Let ANNEXTades be your bridge to Expansion & Increased Market Share </h4>
                <hr>
        </div>
    </section>
    <section class="white-space text-center" id="sample">
        <div class="container"><h3><b>FULL DESCRIPTION REPORT WITH DETAILS ON REQUEST FOR PROPOSAL (RFP)</b></h3></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"><img src="{{ asset('assets/images/deals-sample.png') }}" width="100%" alt=""></div>
                <div class="col-lg-6"><img src="{{ asset('assets/images/deals-process.png') }}" width="100%" alt=""></div>
            </div>
        </div>
    </section>
    <!-- #region datatables files -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- #endregion -->
    <script type="text/javascript">
		var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            searching: false,
            ajax: {
                url:'{{ route('government-contract-list')}}',
                data: function(d){
                    d.keyword = $('#keyword').val();
                    d.category_id = $('#category_id').val();
                    d.naic_code = $('#naic_code').val();
                    d.states = function(){
                        let yourArray = [];
                        $("input:checkbox[name=states]:checked").each(function(){
                            yourArray.push($(this).val());                            
                        });
                        return yourArray;
                    },
                    d.type = function(){
                        let yourArray = [];
                        $("input:checkbox[name=type]:checked").each(function(){
                            yourArray.push($(this).val());
                        });
                        return yourArray;
                    },
                    d.refine = function(){
                        let yourArray = [];
                        $("input:checkbox[name=refine]:checked").each(function(){
                            yourArray.push($(this).val());
                        });
                        return yourArray;
                    }
                }
            },
            columns: [
                {
                    "className":'details-control all sorting_disabled',
                    "defaultContent": '',
                }, 
                { data: 'star', searchable: false, orderable: false, sortable: false,className: "text-wrap"  },
                { data: 'title', searchable: true, orderable: false, sortable: false, className: "text-wrap" },
                { data: 'description', searchable: true, orderable: false, sortable: false, className: "text-wrap" },
                { data: 'buyer', searchable: true, orderable: false, sortable: false, className: "text-wrap"  },
                { data: 'state', searchable: true, orderable: false, sortable: false, className: "text-center" },
                { data: 'type', searchable: false, orderable: false, sortable: false,className: "text-wrap"  },
                { data: 'notice_id', searchable: true, orderable: false, sortable: false,className: "text-wrap"  },
                { data: 'deadline', searchable: false, orderable: false, sortable: false,className: "text-wrap"  },
                { data: 'agency', searchable: true, orderable: false, sortable: false, className: "text-wrap" },
            ],
            columnDefs: [{
            targets: 0,
            targets: 1,
            className: 'border-rt-0'
            }],
            drawCallback : function( settings ) {
                //$('.select').niceSelect();	
            },
        });

        $(document).on("change","#category_id",function(){
            //table.draw();
            table.ajax.reload();
        });

        $(document).on("click","#btn_naic_code",function(){
            table.ajax.reload();
        });

        $(document).on("click","#btn_keyword",function(){
            table.ajax.reload();
        });

        $(document).on("change", "[name=states]",function(){
            table.ajax.reload();
        });

        $(document).on("change", "[name=type]",function(){
            table.ajax.reload();
        });

        $(document).on("change", "[name=refine]",function(){
            table.ajax.reload();
        });
        


        $('input[name=myfav]').on('change', function() {
            if (this.checked) {
                table.columns(0).search('favourite').draw();
                $('#fmyfav').show();
                $('#fmyfav').html(`<i class="fa fa-times-circle text-danger"> <span class="text-dark">Favourite Bids</span></i>`);
            } else {
                table.columns(0).search("").draw();
                $('#fmyfav').hide();
                $('input[name=myfav]').prop("checked", false);
            }
        });

        $('#fmyfav').on('click', function() {
            $('#fmyfav').hide();
            $('input[name=myfav]').prop("checked", false);
            table.columns(0).search("").draw();
        });

            $('input[name=active]').on('change', function() {
                if (this.checked) {
                    console.log('active');
                    table.columns(1).search("active").draw();
                    $('#factive').show();
                    $('#factive').html(`<i class="fa fa-times-circle text-danger"> <span class="text-dark">Active</span></i>`);
                } else {
                    console.log('inactive');
                    table.columns(1).search("").draw();
                    $('input[name=active]').prop("checked", false);
                    $('#factive').hide();
                }
            });

            $('#factive').on('click', function() {
                $('#factive').hide();
                $('input[name=active]').prop("checked", false);
                table.columns(1).search("").draw();
            });

            $(document).ready(
                function() {
                    $.ajax({
                        url: '{{ route('government-contract-count-favourite') }}',
                        success: function(response){
                            $('#fav-count').html('('+response+')');
                        }
                    })
                }
            )
            

	</script>		
    @if(Auth::guard('web')->check())			
        <script>
            $('#datatable').on('click','.addfav',function(){
                var id = $(this).data('id');
                // AJAX request
                $.ajax({
                    url: '{{ route('government-contract-add-favourite') }}',
                    type: 'GET',
                    data: {user_id: '{{ Auth::user()->id }}', request_id: id},
                    success: function(response){
                        console.log(response);
                        if(response == 1){
                            table.ajax.url( '{{ route('government-contract-list') }}' ).load();
                            $('#fav-count').load('{{ route('government-contract-count-favourite') }}');
                        }else{
                            alert("Invalid ID.");
                        }
                    }
                });
            });
        </script>
    @else
    <script>
        $('#datatable').on('click','.addfav',function(){
            alert('Please login to add favourite!')
        });
    </script>
    @endif
    
    @if(Auth::guard('web')->check())			
        <script>
            $('#datatable').on('click','.removefav',function(){
                var id = $(this).data('id');
                // AJAX request
                $.ajax({
                    url: '{{ route('government-contract-remove-favourite') }}',
                    type: 'GET',
                    data: {user_id: '{{ Auth::user()->id }}', request_id: id},
                    success: function(response){
                        console.log(response);
                        if(response == 1){
                            // Reload DataTable
                            table.ajax.url( '{{ route('government-contract-list') }}' ).load();
                            $('#fav-count').load('{{ route('government-contract-count-favourite') }}');
                        }else{
                            alert("Invalid ID.");
                        }
                    }
                });
            });
        </script>
    @endif


@endsection