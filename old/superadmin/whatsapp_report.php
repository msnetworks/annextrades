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
                            <h2 class="pageheader-title"><i class="fa fa-comments"></i>Whatsapp Report</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Whatsapp Campaign Report</li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Whatsapp Reports</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                        <h5><?php $c=mysqli_query($conn, "SELECT id FROM whatsapp_report where `status`!='' ");
                                                 $count = mysqli_num_rows($c);?>Total Send : <?php echo $count; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <!-- <th>Lot Name</th> -->
                                                <!-- <th>Phone</th>
                                                <th>Message ID</th> -->
                                                <th>Lot</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $lot=mysqli_query($conn, "SELECT * FROM whatsapp_lot");
                                            WHILE($row_adv1=mysqli_fetch_array($lot)){
                                            $query1=mysqli_query($conn, "SELECT lot FROM whatsapp_report WHERE lot = '".$row_adv1['lot']."'");
                                            //WHILE($row_adv1=mysqli_fetch_array($query1)){
                                                $count = mysqli_num_rows($query1);
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <!-- <td>< ?php echo $row_adv1['lot'];?></td>
                                                <td>< ?php echo $row_adv1['message_id'];?></td> -->
                                                <td><?php echo $row_adv1['lot'];?></td>
                                                <td><a href="whatsapp_report_details.php?lot=<?php echo $row_adv1['lot']; ?>"><?php echo $count; ?></a></td>

                                                <!-- <td>
                                                    <?php 
                                                        if ($row_adv1['status'] == '') {
                                                            echo 'Unknown Contact';
                                                        }
                                                        else{
                                                    ?>
                                                    <?php echo $row_adv1['status'];?>
                                                    <?php } ?>
                                                </td> -->
                                                <td><?php echo $row_adv1['date'];?></td>
                                                
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