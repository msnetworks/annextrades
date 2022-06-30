<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
	include("../controller/config.php");
	include'controller/select_fetch.php';
?>      
        <?php /* header('location:user_profile.php'); */ ?>
       <?php include"header.php"; ?>
        <style>
            .dropdown-menu
            {
                background-color: #fff;
                border: 1 #5969ff;
                color: #5969ff;
            }
            .btn-secondary{
                background: #5969ff;
                border-color:  #333 !important;
                color: #fff;
            }
            .secondary.dropdown-toggle{
                background: #5969ff;
                border-color:  #333 !important;
                color: #fff;
            }
            .ho:hover{
                background-color: #4254fd !important;
            }
        </style>
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
                            <h2 class="pageheader-title">Welcome</h2>
                            <p class="pageheader-text">Annexis Business Soluitons</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Home</li>
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
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header row">
                                    <div class="col-md-6">
                                        <h5 style="color: #ff7900;">New Registrations</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5><a class="btn btn-success" href="registration_list.php">VIEW ALL</a></h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th>Vendor Id</th>
                                                    <th>Name</th>
                                                    <th>User Type</th>
                                                    <th>Email</th>
                                                    <th>Email Verification</th>
                                                    <th>Company Name</th>
                                                    <th>Contact</th>
                                                    <th>Join Date</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>    
                                            <tbody>
                                                <?php 
                                                $query1=mysqli_query($conn, "SELECT * FROM registration order by id desc LIMIT 5");
                                                WHILE($row_adv1=mysqli_fetch_array($query1)){
                                                ?>
                                                <tr>
                                                    <td><!-- <img src="assets/images/new.gif" style="width: 40px;"> --> <?php echo $row_adv1['vendor_id'];?></td>
                                                    <td><?php echo $row_adv1['firstname']." ".$row_adv1['lastname'];?></td>
                                                    <td><?php echo $row_adv1['usertype'];?></td>
                                                    <td><?php echo $row_adv1['email'];?></td>
                                                    <td><?php if($row_adv1['email_verify'] == "Verified"){ 
                                                        ?>
                                                        <font color="#28a745" >Verified</font><?php }else {
                                                        ?>
                                                            <font color="#dc3545" >Not Verified</font>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $row_adv1['companyname'];?></td>
                                                    <td><?php echo $row_adv1['phonenumber'];?></td>
                                                    <td><?php echo $row_adv1['added_date'];?></td>
                                                    <td><a href="user_profile.php?vendor_id=<?php echo $row_adv1['vendor_id'];?>" style="color: #d70404;">View</a></td>
                                                    
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
                                    <div class="card-footer text-right">
                                        <h3><a href="registration_list.php">View All</a></h3>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <h5 style="color: #ff7900;">New Products</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h5><a class="btn btn-success" href="product_list.php">VIEW ALL</a></h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Company Name</th>
                                                <th>Contact Person</th>
                                                <th>Added Date</th>
                                                <th>Active Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $query1=mysqli_query($conn, "SELECT * FROM product WHERE p_category = '1938' order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td><!-- <img src="assets/images/new.gif" style="width: 40px;"> --> <?php echo $row_adv1['id'];?></td>
                                                <td><?php echo $row_adv1['p_name'];?></td>
                                                <td>
                                                    <?php $quy1=mysqli_query($conn, "SELECT * FROM registration where id = '".$row_adv1['userid']."'");
                                                        $rowv1=mysqli_fetch_array($quy1);
                                                        echo $rowv1['companyname'];    
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $rowv1['firstname']." ".$rowv1['lastname']; ?>
                                                </td>
                                                <td><?php echo $row_adv1['udate'];?></td>
                                                <td>
                                                    <?php if($row_adv1['status'] == '2') { ?>
                                                    <font color="#28a745" >Approved</font>
                                                    <?php }
                                                    elseif($row_adv1['status'] == '1') {
                                                    ?>
                                                    <font color="#dc3545" >Not Approved</font>
                                                    <?php }elseif($row_adv1['status'] == '3'){ ?>
                                                    <font color="#dc3545" >Editing Required</font>
                                                    <?php } ?>
                                                </td>
                                                <td><a href="edit_newproduct.php?product_id=<?php echo $row_adv1['id'];?>&id=<?php echo $row_adv1['userid'];?>" style="color: #d70404;"><i class="fa fa-edit"></i></a></td>
                                                
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
                                <div class="card-footer text-right">
                                    <h3><a href="product_list.php">View All</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          <?php include"footer.php"; ?>
        
          <?php
            } 
        else{ 
					header('location: auth/');
            } 
        ?> 