<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query2=mysqli_query($conn, "SELECT * FROM `email_template` order by id ASC ");
        
        $qur=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='".$_GET['v_id']."' ");
        $rw=mysqli_fetch_array($qur);

        /* $query3=mysqli_query($conn, "SELECT * FROM `country` WHERE country_id='".$row_adv2['country']."' ");
        $row_adv3=mysqli_fetch_array($query3); */

        $er=mysqli_query($conn, "SELECT * FROM email_report WHERE vendor_id='".$_GET['v_id']."' ");
        
            
?>
    <?php include"header.php"; ?>
        <!-- ============================================================== --> 
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="influence-profile">
                <div class="container-fluid dashboard-content">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-left"><a  href="add_etemp.php">Email Template</a></h5>
                                </div>
                                <!-- <div class="col-md-6">
                                    <h5 class="text-right"><a  href="add_etemp.php">Add New Template</a></h5>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12" style="">
                            <div class="row" style="padding: 15px;">
                                <div class="col-md-6" style="background: #f9f9f9;">
                                    <label for="Vendor"><h5><b>Vendor ID:</b> <?php echo $rw['vendor_id']; ?></h5></label><br>
                                    <label for="Vendor"><h5><b>Company Name:</b> <?php echo $rw['companyname']; ?></h5></label><br>
                                    <label for="Vendor"><h5><b>Contact Person:</b> <?php echo $rw['firstname']." ".$rw['lastname']; ?></h5></label>
                                </div>
                                <div class="col-md-6" style="background: #f9f9f9;">
                                    <label for="Vendor"><h5><b>Contact Number:</b> <?php echo $rw['phonenumber']; ?></h5></label><br>
                                    <label for="Vendor"><h5><b>Email:</b> <?php echo $rw['email']; ?></h5></label><br>
                                    <label for="Vendor"><h5><b>Email Already Send:</b> 
                                    <?php WHILE($erw=mysqli_fetch_array($er)){
                                        echo $erw['email_id'].", ";
                                    } ?>
                                    </h5></label>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table tabel-responive border">
                                <thead>
                                    <tr>
                                        <td>Email No.</td>
                                        <td>Email Subject</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <?php 
                                    $i=1;
                                    WHILE($row_adv2=mysqli_fetch_array($query2)){
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <a href="add_etemp.php?i=<?php echo $row_adv2['id']; ?>&v_id=<?php echo $_GET['v_id']; ?>"><?php echo $row_adv2['subject']; ?></a>
                                        </td>
                                        <td>
                                            <a href="create_email.php?i=<?php echo $row_adv2['id']; ?>&v_id=<?php echo $rw['vendor_id']; ?>">Select</a>
                                        </td>
                                    </tr>
                                <?php $i++; } ?>
                            </table>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    <?php include"footer.php"; ?> 
    <?php
    }
        else{ 
                    header('location: auth/');
            } 
    ?>      