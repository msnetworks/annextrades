<?php require_once('../controller/config.php'); ?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
    <title>ANNEXTrades || Superadmin Dashboard</title>
    <style>
        p {
            margin: 0px 0px 0px 0px !important;
        }
    </style>
</head>

<body>
   
    <?php
    $query=mysqli_query($con, "SELECT * FROM superadmin WHERE id='".$_SESSION['super_id']."' ");
    $row_adv=mysqli_fetch_array($query);
    $regqry=mysqli_query($conn, "SELECT * FROM registration ");
    $row_reg=mysqli_fetch_array($query);

    $vqry=mysqli_query($conn, "SELECT view FROM registration WHERE view = '1'");

    $proqry=mysqli_query($conn, "SELECT p_category FROM product WHERE p_category = '1938'");
    $row_pro=mysqli_fetch_array($query);

    $r = mysqli_num_rows($vqry);
    $p = mysqli_num_rows($proqry);
    $sm_all = $r + $p;
    ?>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper" >
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.php"><img style="width:150px;" src="../assets/images/logo.png" ></a>
                <button class="navbar-toggler" style="padding-right: 30px;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon">
                        <!-- < ?php 
                            if($row_adv['image'] != NULL ){
                        ?>
                         <img src="assets/images/< ?php echo $row_adv['image']; ?>" style="width:45px !important; height: 45px !important; border-radius: 50%!important;border: 2px solid #333;"></span>
                        < ?php
                                }
                                else{
                        ?> -->
                            <img src="https://annextrades.com/assets/images/annexis-emblem.png" style="width:45px !important; height: 45px !important; border-radius: 50%!important; border: 2px solid #333;"></span>
                        <!-- < ?php
                            }
                        ?> -->
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item"><a class="nav-link" href="#"><font style="font-size: 18px; color: #ff7900;"><?php echo $_SESSION['super_name']; ?></font></a></li>
                        <li class="nav-item dropdown nav-user ">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="badge badge-danger ml-2" style="padding: 7px;"><i  class="fa fa-bell">&nbsp;&nbsp; <superscript class="" style="color: ;"> <?php echo $sm_all; ?></superscript></i></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"  aria-labelledby="navbarDropdownMenuLink2">
                            <?php if(mysqli_num_rows($vqry) != '0'){ ?>
                                <a class="dropdown-item waves-effect waves-light" style="padding: 30px; font-size: 17px;" href="registration_list.php"><b><?php echo $r; ?> New Client Registered</b></a>
                            <?php } ?>
                            <?php if(mysqli_num_rows($proqry) != '0'){ ?>
                                <a class="dropdown-item waves-effect waves-light" style="padding: 30px; font-size: 17px;" href="product_list.php"><b><?php echo $p; ?> - Products Pending to categorized</b></a>
                            <?php } ?>
                                
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                            <img src="https://annextrades.com/assets/images/annexis-emblem.png" style="width:45px !important; height: 45px !important; border-radius: 50%!important; border: 2px solid #333;" alt="" class="user-avatar-md rounded-circle"></a>
                                
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"  aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION['super_name']; ?></h5>
                                    <!--span class="status"></span><span class="ml-2">Available</span-->
                                </div>
                                <a class="dropdown-item" href="user_profile.php"><i class="fas fa-user mr-2"></i>My Profile</a>

                                <a class="dropdown-item" href="auth/logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                <!--a class="dropdown-item" href="../"><i class="fas fa-cog mr-2"></i>Visit Site</a-->
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark" id="slide-panel">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">View More</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-rd" aria-controls="submenu-rd">
                                    <i class="fas fa-registered"></i>Registration Details</a>
                                <div id="submenu-rd" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="create_newregistration.php" ><i class="fa fa-plus"></i>Create New <span class="badge badge-success">6</span></a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="registration_list.php" ><i class="fa fa-inbox"></i>Registrations List<span class="badge badge-success">6</span></a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="bot_registrations.php" ><i class="fas fa-robot"></i>Bot Registrations<span class="badge badge-success">6</span></a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="new_productlist.php"><i class="fa fa-shopping-cart"></i>Pending Product</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-np" aria-controls="submenu-np">
                                    <i class="fas fa-align-center"></i>Product Details</a>
                                <div id="submenu-np" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="product_list.php" ><i class="fa fa-shopping-cart"></i>Product List <span class="badge badge-success">6</span></a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="new_productlist.php"><i class="fa fa-shopping-cart"></i>Pending Product</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-cl" aria-controls="submenu-cl">
                                    <i class="fas fa-tag"></i>Category Details</a>
                                <div id="submenu-cl" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="category_list.php" ><i class="fa fa-category"></i>Category List <span class="badge badge-success">6</span></a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="new_productlist.php"><i class="fa fa-shopping-cart"></i>Pending Product</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-mq" aria-controls="submenu-mq">
                                    <i class="fas fa-comments"></i>Quotes Details</a>
                                <div id="submenu-mq" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="reqquote_list.php" >Quote Requests <span class="badge badge-success">6</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contactnow_list.php" >Contact Now <span class="badge badge-success">6</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="weekly_quotes.php" >Weekly Deals Quotes <span class="badge badge-success">6</span></a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="new_productlist.php"><i class="fa fa-shopping-cart"></i>Pending Product</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <?php if($_SESSION['super_type']=='admin' || $_SESSION['super_type']=='superadmin'){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-um" aria-controls="submenu-um"><i class="fas fa-users"></i>Users Management</a>
                                    <div id="submenu-um" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="add_user.php">Add User</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="user_list.php">All Users</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-em" aria-controls="submenu-em"><i class="fas fa-envelope"></i>E-Mail</a>
                                <div id="submenu-em" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="email_template.php">Compose Email</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="#passwordchange.php">Change Password</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#landing-mp" aria-controls="landing-mp"><i class="fas fa-cog"></i>Landing Page</a>
                                <div id="landing-mp" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="post_buyer.php">Add Testimonial</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="landing_postlist.php">All Testimonial</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#landing-wp" aria-controls="landing-wp"><i class="fas fa-whatsapp"></i>Whatsapp</a>
                                <div id="landing-wp" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="whatsapp.php">Create Campaign</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="import_contact.php">Import Contact</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="whatsapp_report.php">Campaign Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-mp" aria-controls="submenu-mp"><i class="fas fa-cog"></i>Settings</a>
                                <div id="submenu-mp" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#profile.php">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#passwordchange.php">Change Password</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>   
    
<!-- add Pusher -->
<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script>
    $('#opener').on('click', function() {       
        var panel = $('#slide-panel');
        if (panel.hasClass("visible")) {
            panel.removeClass('visible').animate({'left':'-300px'});
        } else {
            panel.addClass('visible').animate({'left':'0px'});
        }   
        return false;   
    });
</script>
<script>
    
    // add hear Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    // pusher
    var pusher = new Pusher('add your app key', {
    cluster: 'ap2',
    encrypted: true
    });
    // for channel pusher
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    console.log(data.message);
    $.notify(data.message, {
    newest_on_top: true
    });
    });
 
</script>
 
        <!-- ============================================================== -->
        <!-- end left sidebar -->
