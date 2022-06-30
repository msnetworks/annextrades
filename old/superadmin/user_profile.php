<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query2=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='".$_GET['vendor_id']."' ");
            $row_adv2=mysqli_fetch_array($query2);
        $query3=mysqli_query($conn, "SELECT * FROM `country` WHERE country_id='".$row_adv2['country']."' ");
        $row_adv3=mysqli_fetch_array($query3);
            
?>
    <?php include"header.php"; ?>
        <!-- ============================================================== --> 
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="influence-profile">
                <div class="container-fluid dashboard-content">
                    <!-- ============================================================== -->
                    <!-- pageheader -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2">My Profile</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb"> 
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- profile -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- card profile -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar text-center d-block">
                                        <!--?php 
                                            if($row_adv['image'] != NULL ){
                                        ?>
                                            <img src="../admin_login/img/student/< ?php echo $row_adv2['image']; ?>" style="border: 2px solid #333;" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                        < ?php
                                                }
                                                else{
                                        ?-->
                                            <img src="assets/images/dummy.png" style="border: 2px solid #333;" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                        <!--?php
                                            }
                                        ?-->
                                    </div>

                                    <div class="text-center">
                                        
                                        <h2 class="font-24 mb-0"> <?php echo $row_adv2['firstname']." ".$row_adv2['lastname']; ?></h2>
                                        <p>(Vendor ID : <?php echo $row_adv2['vendor_id']; ?>)</p>
                                        
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Status ( <?php if($row_adv2['userstatus'] == '0'){ echo "<font class='text-success'>Active</font>"; }else{ echo "<font class='text-danger'>Not Active</font>"; } ?> )</h3>   
                                    <?php if($row_adv2['userstatus'] != '0'){ ?>
                                        <a href="controller/userstatus.php?vendor_id=<?php echo $row_adv2['vendor_id']; ?>&status=0"><button class="btn btn-success w-100">Activate</button></a>
                                    <?php }else{ ?>
                                        <a href="controller/userstatus.php?vendor_id=<?php echo $row_adv2['vendor_id']; ?>&status=1"><button class="btn btn-danger w-100">Deactivate</button></a>
                                    <?php } ?>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Join Date</h3>   
                                    <div class="">
                                        <ul class="list-unstyled mb-0">
                                        <li class="mb-2" style="color: green;"><i class="fas fa-fw fa-calendar mr-2 "></i>Join Date: <b><?php echo $row_adv2['added_date']; ?></b></li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Validity</h3>   
                                    <div class="">
                                        <ul class="list-unstyled mb-0">
                                        <li class="mb-2" style="color: green;"><i class="fas fa-fw fa-calendar mr-2 "></i>Start Date: <b><?php echo $row_adv2['activate_date']; ?></b></li>
                                        <li class="mb-0" style="color: red;"><i class="fas fa-fw fa-bell mr-2 "></i>Expiry Date: <b><?php echo $row_adv2['expiry_date']; ?></b></li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Account Type <i class="fa fa-books mr-2"></i></h3>
                                    <div class="">
                                        <ul class="mb-0 list-unstyled">
                                            <li class="mb-1"><i class="fa fa-industry mr-2"></i>&nbsp; <?php echo $row_adv2['usertype']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Package <i class="fa fa-books mr-2"></i></h3>
                                    <div class="">
                                        <ul class="mb-0 list-unstyled">
                                            <li class="mb-1"><i class="fa fa-book mr-2"></i>&nbsp; <?php echo $row_adv2['package']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Contact Information</h3>
                                    <div class="">
                                            
                                        <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i><?php echo $row_adv2['email']; ?>
                                            <?php 
                                                if($row_adv2['email_verify'] == 'Verified' ){
                                            ?>
                                            (Verified)
                                            <?php
                                                    }
                                                    else{
                                            ?>
                                            <a href="controller/email_verify_resend.php?email=<?php echo $row_adv2['email']; ?>" class="btn-primary"><button>Resend Verification Email</button></a>
                                            
                                            <a href="controller/email_verify.php?vendor_id=<?php echo $row_adv2['vendor_id']; ?>&verify_code=<?php echo $row_adv2['email_verify']; ?>" class="btn-primary"><button>Verify Email</button></a>
                                            <?php } ?>
                                        </li>
                                        <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i><?php echo $row_adv2['phonenumber']; ?></li>
                                    </ul>
                                    </div>
                                </div>
                                
                                <div class="card-body border-top">
                                    <h3 class="font-16">Address Info</h3>
                                    <div class="">
                                        <ul class="mb-0 list-unstyled">
                                            <li class="mb-1"><i class="fa fa-map mr-2"></i>&nbsp; <?php echo $row_adv2['street'].", ".$row_adv2['state']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Password</h3>
                                    <div class="">
                                        <ul class="mb-0 list-unstyled">
                                            <li class="mb-1"><i class="fa fa-key mr-2"></i>&nbsp; <?php echo $row_adv2['password'].", ".$row_adv2['state']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end card profile -->
                            <!-- ============================================================== -->
                        </div>
                        <!-- ============================================================== -->
                        <!-- end profile -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- campaign data -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <h5 class="card-header">Profile Details</h5>
                                <div class="card-body">
                                    <form class="needs-validation" method="POST" enctype="multipart/form-data" action="controller/update_student_details.php" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Vendor ID</label>
                                                <input type="text" class="form-control" id="validationCustom01" placeholder="Vendor Id" value="<?php echo $row_adv2['vendor_id']; ?>" readonly>
                                                
                                                <!-- <div class="valid">
                                                    <font color="#28a745">Valid!</font>
                                                </div> -->
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Name</label>
                                                <input type="text" class="form-control" name="fname" id="validationCustom01" value="<?php echo $row_adv2['firstname']." ".$row_adv2['lastname']; ?>" readonly>
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
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Account Type</label>
                                                <input type="text" class="form-control" name="fname" id="validationCustom01" value="<?php echo $row_adv2['usertype']; ?>" readonly>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Package</label>
                                                <input type="text" class="form-control" name="fname" id="validationCustom01" value="<?php echo $row_adv2['package']; ?>" readonly>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Date of Birth</label>
                                                <input type="date" class="form-control" name="dob" id="validationCustom01" value="<?php echo $row_adv2['dob']; ?>" required>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">School/College</label>
                                                <input type="text" class="form-control" name="school" id="validationCustom01" value="<?php echo $row_adv2['school']; ?>" required>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div> -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomEmail">E-mail</label>
                                                <input type="email" required="" name="email" data-parsley-type="email" value="<?php echo $row_adv2['email']; ?>" class="form-control" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter a valid e-mail
                                                </div>
                                                <div class="valid-feedback">
                                                   Done
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomPhone">Phone Number</label>
                                                <input type="phone" required="" name="contact" data-parsley-type="Phone" value="<?php echo $row_adv2['phonenumber']; ?>" class="form-control" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter a valid contact number
                                                </div>
                                                <div class="valid-feedback">
                                                   Done
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <br>
                                        </div>
                                         
                                        <div class="form-row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustomAddress">Address</label>
                                            <input type="text" name="address" class="form-control" value="<?php echo $row_adv2['street']; ?>" id="validationCustomAddress" required readonly>
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
                                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                            <label for="validationCustom03">City</label>
                                            <input type="text" class="form-control" name="district" id="validationCustom03" value="<?php echo $row_adv2['city']; ?>" required readonly>
                                            <div class="invalid-feedback">
                                                Please provide a valid city.
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                            <label for="validationCustom04">State</label>
                                            <input type="text" class="form-control" name="state" id="validationCustom04" value="<?php echo $row_adv2['state']; ?>" required readonly>
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                            <label for="validationCustom05">Pin</label>
                                            <input type="text" class="form-control" name="pin" id="validationCustom05" data-parsley-max="6" placeholder="Zip Code" value="<?php echo $row_adv2['zipcode']; ?>" required readonly>
                                            <div class="invalid-feedback">
                                                Please provide a valid pin.
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <br>
                                        </div>  
                                        
                                        
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustomDate">Date of Registration</label>
                                            <input type="datetime" name="date" class="form-control" value="<?php echo $row_adv2['added_date']; ?>" id="validationCustomdate" readonly>
                                            <div class="invalid-feedback">
                                               Required
                                            </div>
                                            <div class="valid-feedback">
                                                <font color="#28a745">Valid!</font>
                                            </div>
                                        </div>
                                           
                                        <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <br><br>
                                        </div>   
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <button class="btn btn-primary" type="submit">Update Record</button>
                                        </div> -->
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="card">
                            <h5 class="card-header">Product List</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Image</th>
                                                <th>Added Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $queryp=mysqli_query($conn, "SELECT * FROM product WHERE userid = '".$row_adv2['id']."'");
                                            WHILE($row_pro=mysqli_fetch_array($queryp)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row_pro['id'];?></td>
                                                <td><?php echo $row_pro['p_name'];?></td>
                                                <td><img src="../productlogo/<?php echo $row_pro['p_photo'];?>" style="width: 100px; height: 100px;" alt=""></td>
                                                <td><?php echo $row_pro['udate'];?></td>
                                                <td>
                                                    <?php if($row_pro['status'] == '2') { ?>
                                                    <font color="#28a745" >Approved</font>
                                                    <?php }
                                                    elseif($row_pro['status'] == '1') {
                                                    ?>
                                                    <font color="#dc3545" >Not Approved</font>
                                                    <?php }elseif($row_pro['status'] == '3'){ ?>
                                                    <font color="#dc3545" >Editing Required</font>
                                                    <?php } ?>
                                                </td>
                                                <td><a href="edit_newproduct.php?product_id=<?php echo $row_pro['id'];?>&id=<?php echo $row_pro['userid'];?>" style="color: #d70404;"><i class="fa fa-edit"></i></a></td>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <!--tfoot>
                                            <tr>
                                                <th width="75%">Total Booking</th>
                                                <th>Start date</th>
                                            </tr>
                                        </tfoot-->
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end campaign tab one -->
                        <!-- ============================================================== -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- end campaign data -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end content -->
            <?php include"footer.php"; ?> 
            <?php
            }
                else{ 
                            header('location: auth/');
                    } 
            ?>      