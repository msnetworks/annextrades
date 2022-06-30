<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <title>Dashboard</title>
</head>

<body>
    <?php
    $query=mysqli_query($con, "SELECT * FROM registration WHERE vendor_id='".$_SESSION['user_login']."' ");
    $row_adv=mysqli_fetch_array($query);
    ?>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
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
                         <img src="assets/images/<?php echo $row_adv['image']; ?>" style="width:45px !important; height: 45px !important; border-radius: 50%!important;border: 2px solid #333;"></span>
                        < ?php
                                }
                                else{
                        ?> -->
                            <img src="assets/images/dummy.png" style="width:45px !important; height: 45px !important; border-radius: 50%!important; border: 2px solid #333;"></span>
                        <!-- < ?php
                            }
                        ?> -->
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item"><a class="nav-link" href="#"><font style="font-size: 18px; color: #ff7900;"><?php echo $row_adv['firstname']." ".$row_adv['lastname']; ?></font></a></li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                            <img src="assets/images/dummy.png" style="width:45px !important; height: 45px !important; border-radius: 50%!important; border: 2px solid #333;" alt="" class="user-avatar-md rounded-circle"></a>
                                
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"  aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $row_adv['firstname']." ".$row_adv['lastname']; ?></h5>
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
        <?php if($row_adv2['expiry_date'] >= date('Y-m-d H:i:s') ){ ?>
        <div class="nav-left-sidebar sidebar-dark">
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
                            <li class="nav-item ">
                                <a class="nav-link" href="#" ><i class="fa fa-inbox"></i>Message <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-microphone"></i>Voice Mail <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-envelope"></i>E-Mail <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-file"></i>Paper <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-book"></i>Bookings <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-shopping-bag"></i>Product/Service <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-asterisk"></i>Samples <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-certificate"></i>Samples Request <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-bars"></i>Requirements <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-users"></i>Sales Representative <span class="badge badge-success">6</span></a>
                                <a class="nav-link" href="#" ><i class="fa fa-exclamation-circle"></i>Marketing Updates <span class="badge badge-success">6</span></a>
                            </li>
                            
                            <!--li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-10">
                                    <i class="fas fa-f fa-folder"></i>Courses Details</a>
                                <div id="submenu-9" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="textcourses.php">Text Courses</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="videoclasses.php">Video Classes</a>
                                        </li>
                                    </ul>
                                </div>
                            </li-->
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Profile Details</a>
                                <div id="submenu-10" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="user_profile.php">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="changepassword.php">Change Password</a>
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
        <?php } ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->