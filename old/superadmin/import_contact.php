<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query2=mysqli_query($conn, "SELECT * FROM `whatsapp`");
            $row_adv2=mysqli_fetch_array($query2);
            
?>
    <?php include"header.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
            max-height: 300px;
        }
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
            }
    </style>
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
                                <h3 class="mb-2">Import Contact</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Import Contact</li>
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
                        
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- campaign data -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="card">

                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><h5>Contact Detail</h5></div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        if(!empty($_GET['status'])){
                                            switch($_GET['status']){
                                                case 'succ':
                                                    $statusType = 'alert-success';
                                                    $statusMsg = 'Members data has been imported successfully.';
                                                    break;
                                                case 'err':
                                                    $statusType = 'alert-danger';
                                                    $statusMsg = 'Some problem occurred, please try again.';
                                                    break;
                                                case 'invalid_file':
                                                    $statusType = 'alert-danger';
                                                    $statusMsg = 'Please upload a valid CSV file.';
                                                    break;
                                                default:
                                                    $statusType = '';
                                                    $statusMsg = '';
                                            }
                                        }
                                    ?>
                                    <form class="mrg-cont" action="controller/import_contact.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="email">Upload CSV only *</label>
                                                <input type="file" name="file" class="form-control" required>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="email">Contact Lot Name *</label>
                                                <input type="text" name="lot" class="form-control" required>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <button class="btn btn-primary" name="importSubmit" type="submit"><b>SUBMIT</b></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-right">
                                    <h4><a class="btn btn-success" href="import_contact.php">Create Campaign</a></h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <td><b>
                                                    Total Contacts : 
                                                    <?php
                                                        $t=mysqli_query($conn, "SELECT lot FROM whatsapp");

                                                        //WHILE($row_adv1=mysqli_fetch_array($query1)){
                                                            $total_count = mysqli_num_rows($t);
                                                            echo $total_count;
                                                    ?>
                                                    </b>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table table-striped table-bordered first" id="myTable" border="1">

                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Lot</th>
                                                <th>Total Contacts</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                                $i = 1;
                                                
                                                $qry2=mysqli_query($conn, "SELECT * FROM `whatsapp_lot`");
                                                while ($contact=mysqli_fetch_array($qry2)) {
                                                    $query1=mysqli_query($conn, "SELECT lot FROM whatsapp WHERE lot = '".$contact['lot']."'");
                                                    $query2=mysqli_query($conn, "SELECT lot FROM whatsapp WHERE lot = '".$contact['lot']."' AND status = 'valid'");

                                                    //WHILE($row_adv1=mysqli_fetch_array($query1)){
                                                        $count = mysqli_num_rows($query1);
                                                        $count2 = mysqli_num_rows($query2);
                                                        $invalid = $count - $count2;
                                            ?>
                                               
                                            <tr>
                                                <td><?php echo $contact['id'];?></td>
                                                <td><?php echo $contact['lot'];?></td>
                                                <!-- <td><?php echo $contact['phonenumber'];?></td> -->
                                                <td><?php echo $count; ?></td>
                                                <td>Valid : <?php echo $count2; ?> And Invalid : <?php echo $invalid; ?></td>
                                            </tr>
                                            
                                            <?php $i++; }
                                                mysqli_close($conn); ?>
                                        </tbody>
                                        <!--tfoot>
                                            <tr>
                                                <th width="75%">Total Booking</th>
                                                <th>Start date</th>
                                            </tr>
                                        </tfoot-->
                                    </table>
                                    <div class="card-footer">
                                        <!-- <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                                            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous</a>
                                            </li>
                                            <?php $a = 1; 
                                                WHILE($a <= $total_pages){
                                            ?>
                                            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $a; ?>"><?php echo $a; ?></a></li>
                                            <?php $a++; } ?>
                                            <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
                                            </li>
                                        </ul> -->
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