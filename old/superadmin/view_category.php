<?php session_start();
if(@$_SESSION['super_adm']!=''){
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
                            <h2 class="pageheader-title">Category Details</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Sub Categories</li>
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
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5><a href="#">Sub Category List</a></h5></div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5><a href="#">Add Sub Category</a></h5></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Sub Caregory Id</th>
                                                <th>Sub Category</th>
                                                <th>View & Edit</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                                $query2=mysqli_query($conn, "SELECT parent_id FROM category WHERE parent_id = '".$_GET['c_id']."'");
                                                $sub_id = mysqli_num_rows($query2);
                                                $query1=mysqli_query($conn, "SELECT * FROM category WHERE parent_id ='".$_GET['c_id']."'");
                                                WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['c_id'];?></td>
                                                <td><?php echo $row_adv1['category'];?></td>
                                                <td><a href="edit_category.php?c_id=<?php echo $row_adv1['c_id'];?>&p_id=<?php echo $_GET['c_id']; ?>" style="color: #d70404;"><i class="fa fa-edit"></i></a></td>
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