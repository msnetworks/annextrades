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
                            <h2 class="pageheader-title"><i class="fa fa-comments"></i> Quote Destails</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Quote Destails</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Quote Destails</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                    <h5><a id="downloadLink2" onclick="exportG(this)" href="#">Export to excel</a></h5>
                                    </div>
                                    

                                    <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5>Total Registrations :&nbsp; <font color="#dc3545" ><b id="shw"></b></font>&nbsp;&nbsp; Buyer :&nbsp; <font color="#dc3545" ><b><?php echo $cntBuyer; ?></b></font>&nbsp;&nbsp; Seller :&nbsp; <font color="#dc3545" ><b><?php echo $cntSeller; ?></b></font></h5></div> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" style="padding-bottom: 30px;">
                                    <?php 
                                        $query=mysqli_query($conn, "SELECT * FROM getquote WHERE id = '".$_GET['id']."' ");
                                        $row_det = mysqli_fetch_array($query);
                                        $frmreg=mysqli_query($conn, "SELECT * FROM registration  WHERE vendor_id = '".$row_det['rec_vendor_id']."' ");
                                        $row_frm = mysqli_fetch_array($frmreg);
                                        $toreg=mysqli_query($conn, "SELECT * FROM registration  WHERE vendor_id = '".$row_det['sender_vendor_id']."' ");
                                        $row_to = mysqli_fetch_array($toreg);
                                        $prod=mysqli_query($conn, "SELECT * FROM product  WHERE id = '".$row_det['product_id']."' ");
                                        $row_pro = mysqli_fetch_array($prod);
                                    echo $conn->error; ?>
                                    <div class="col-md-6 border" style="border-color: #333;">
                                        <h5 class="card-header" style="margin-bottom: 30px;">Seller/Supplier Details:</h5>
                                            <p style="color: #333;">Company Name: <?php echo $row_frm['companyname']; ?></p>
                                            <p style="color: #333;">Contact Person: <?php echo $row_frm['firstname']." ".$row_frm['lastname']; ?></p>
                                            <p style="color: #333;">Contact Number: <?php echo $row_frm['phonenumber']; ?></p>
                                            <p style="color: #333;">Email: <?php echo $row_frm['email']; ?></p>
                                    </div>
                                    <div class="col-md-6 border" style="border-color: #333;">
                                        <h5 class="card-header" style="margin-bottom: 30px;">Requested By Details:</h5>
                                            <p style="color: #333;">Company Name: <?php echo $row_to['companyname']; ?></p>
                                            <p style="color: #333;">Contact Person: <?php echo $row_to['firstname']." ".$row_to['lastname']; ?></p>
                                            <p style="color: #333;">Contact Number: <?php echo $row_to['phonenumber']; ?></p>
                                            <p style="color: #333;">Email: <?php echo $row_to['email']; ?></p>
                                    </div>
                                    <div class="col-md-12 border" style="border-color: #333; margin-top: 30px;">
                                        <h5 class="card-header" style="margin-bottom: 30px;">Product Name: </h5>
                                        <p style="color: #333; border: 1px solid #333; padding: 15px;"><a target="_blank" href="edit_newproduct.php?product_id=<?php echo $row_det['product_id']; ?>&id=<?php echo $row_frm['id']; ?>"><?php echo $row_pro['p_name'];; ?></a></p>
                                    </div>
                                    <div class="col-md-12 border" style="border-color: #333; margin-top: 30px;">
                                        <h5 class="card-header" style="margin-bottom: 30px;">Message:</h5>
                                        <p style="color: #333; border: 1px solid #333; padding: 15px;"><?php echo html_entity_decode($row_det['quote']); ?></p>
                                    </div>
                                    <div class="col-md-12 card-header text-right" style="margin-top: 60px;">
                                        <a href="reqquote_list.php"><h3>Back</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          <?php include"footer.php"; ?> 
          <script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
        </script>
    <?php
            } 
        else{ 
					header('location: auth/');
            } 
    ?>      