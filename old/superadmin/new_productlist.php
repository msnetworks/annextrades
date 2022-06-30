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
                            <h2 class="pageheader-title">Pending Product</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Product</li>
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
                            <h5 class="card-header">Pending Product</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Added Date</th>
                                                <th>Active Status</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $query1=mysqli_query($conn, "SELECT * FROM product_temp order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <td><?php echo $row_adv1['p_name'];?></td>
                                                <td><?php echo $row_adv1['added_date'];?></td>
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
                                                <td><a href="edit_newproduct.php?product_id=<?php echo $row_adv1['id'];?>" style="color: #d70404;">Edit</a></td>
                                                
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