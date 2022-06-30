<?php session_start();
if(@$_SESSION['super_adm']!=''){
    
?>
    <?php include"header.php"; ?>
        <?php
            $lot = $_GET['lot'];
            //---Queries------------
            $quy=mysqli_query($conn, "SELECT lot FROM whatsapp_report WHERE lot = '$lot'");
            $cntlot = mysqli_num_rows($qry);
        ?>
        <style>
            .btn {
                padding: 5px 10px;
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
                            <h2 class="pageheader-title">Whatsapp Report Detail</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Whatsapp Report Detail</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Whatsapp Report Details</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                    <h5>Total Contact : <?php echo $cntlot; ?></h5>
                                    </div>
                                    

                                    <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5>Total Registrations :&nbsp; <font color="#dc3545" ><b id="shw"></b></font>&nbsp;&nbsp; Buyer :&nbsp; <font color="#dc3545" ><b><?php echo $cntBuyer; ?></b></font>&nbsp;&nbsp; Seller :&nbsp; <font color="#dc3545" ><b><?php echo $cntlot; ?></b></font></h5></div> -->
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                    <?php echo $lot; ?>
                               </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable" border="1">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Phone Number</th>
                                                <th>Lot</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                                
                                                $i = 1;
                                                
                                                if (isset($_GET['pageno'])) {
                                                    $pageno = $_GET['pageno'];
                                                } else {
                                                    $pageno = 1;
                                                }
                                                $no_of_records_per_page = 500;
                                                $offset = ($pageno-1) * $no_of_records_per_page;

                                                $total_pages_sql = "SELECT COUNT(*) FROM whatsapp_report WHERE lot = '$lot'";
                                                $result = mysqli_query($conn,$total_pages_sql);
                                                $total_rows = mysqli_fetch_array($result)[0];
                                                $total_pages = ceil($total_rows / $no_of_records_per_page);

                                                $sql = "SELECT * FROM whatsapp_report WHERE lot = '$lot' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                                                $res_data = mysqli_query($conn,$sql);
                                                while($row_adv1 = mysqli_fetch_array($res_data)){ 
                                                $queryp=mysqli_query($conn, "SELECT id FROM whatsapp_report WHERE lot = '".$lot."'");
                                                $sum = mysqli_num_rows($queryp);
                                            ?>
                                               
                                            <tr style="background: <?php if ($row_adv1['status'] == ''){ echo '#ff93987a'; } ?>;">
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <td><?php echo $row_adv1['phone'];?></td>
                                                
                                                <td>
                                                    <?php 
                                                        if ($row_adv1['status'] == '') {
                                                            echo 'Unknown Contact';
                                                        }
                                                        else{
                                                    ?>
                                                    <?php echo $row_adv1['status'];?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_adv1['date']; ?>
                                                </td>
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
                                        <ul class="pagination">
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
                                        </ul>
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
            var rowCount = $('#myTable tr').length;
            $('#shw').html(rowCount);


                function myFunction() {

                    var input, filter, table, tr, td, i, txtValue;
                    
                    var x = $('input[type="radio"]:checked').val();
                    //console.log(x);
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[x];
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