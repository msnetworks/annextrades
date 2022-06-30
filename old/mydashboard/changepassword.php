<?php session_start();?>
<?php if(@$_SESSION['std_registration_no']!=''){
	include("../admin_login/connect.php");
	$query2=mysqli_query($conn, "SELECT * FROM `student_record` WHERE std_registration_no='".$_SESSION['std_registration_no']."' ");
    $row_adv2=mysqli_fetch_array($query2);
?>
       <?php include"header.php"; ?>
        
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Change Password</h2>
                            <p class="pageheader-text">Career Edge Institute</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <h5 class="card-header">Doctors Details</h5>
                                <div class="card-body">
                                    <form class="needs-validation" method="POST" enctype="multipart/form-data" action="controller/update_password.php" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Student Name/ID</label>
                                                <input type="text" class="form-control" id="validationCustom01" placeholder="Student Name/ID" value="<?php echo $row_adv['name']; ?> (<?php echo $row_adv['std_registration_no']; ?>)" readonly>
                                                <div class="valid">
                                                    <font color="#28a745">Valid!</font>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Current Password</label>
                                                <input type="password" class="form-control" name="old_pass" id="validationCustom01" placeholder="Current Password" required >
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">New Password</label>
                                                <input type="password" class="form-control" name="new_pass" id="validationCustom01" placeholder="New Password"  required >
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Confirm Password</label>
                                                <input type="password" class="form-control" name="cfm_pass" id="validationCustom01" placeholder="Retype Password" required >
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <button class="btn btn-primary" type="submit">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end campaign tab one -->
                            <!-- ============================================================== -->
                        </div>
                    </div>
                </div>
            <!-- ============================================================== -->
          <?php include"footer.php"; ?> 
          
          <!---------------------password script ------------------->
          
          
          <!---------------------/password script------------------->
          
          <?php
            } 
        else{ 
					header('location: auth/');
            } 
        ?> 