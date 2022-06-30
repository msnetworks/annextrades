<?php session_start();
if(@$_SESSION['super_adm']!=''){
    
?>
    <?php include"header.php"; ?>
        <?php
            $vv = mysqli_query($conn, "SELECT * FROM registration WHERE view = '1'");
            WHILE($roq = mysqli_fetch_array($vv)){
            $conn->query("UPDATE registration SET view = '0' WHERE view='1'");
            }
            //---Queries------------
            $quy=mysqli_query($conn, "SELECT usertype FROM registration WHERE usertype = 'Seller'");
            $cntSeller = mysqli_num_rows($qry);
            $quy1=mysqli_query($conn, "SELECT usertype FROM registration WHERE usertype = 'Buyer'");
            $cntBuyer = mysqli_num_rows($qry1);
            
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
                            <h2 class="pageheader-title">Bot-Registration List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Bot-Registration</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Bot-Registration List</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                    <h5><a id="downloadLink" onclick="exportF(this)" href="#">Export to excel (Hubspot)</a> &nbsp;&nbsp;&nbsp;
                                    <a id="downloadLink2" onclick="exportG(this)" href="#">Export to excel (Full Sheet)</a></h5>
                                    </div>
                                    

                                    <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5>Total Registrations :&nbsp; <font color="#dc3545" ><b id="shw"></b></font>&nbsp;&nbsp; Buyer :&nbsp; <font color="#dc3545" ><b><?php echo $cntBuyer; ?></b></font>&nbsp;&nbsp; Seller :&nbsp; <font color="#dc3545" ><b><?php echo $cntSeller; ?></b></font></h5></div> -->
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                <form name="myForm" action="reg_search.php" method="POST">
                                    <!-- <label for="myInput"><b>Search Name:</b> </label> --><input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search keyword.."><br>
                                    <input type="submit" class="btn btn-primary" value="SEARCH">
                                    <!-- <label for="myInput"><b>Search By:</b> <br></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="byInput">Name <input type="radio" name="searchby" value="1"  id="byInput" checked></label>&nbsp;&nbsp;
                                    <label for="byInput1">Company Name <input type="radio" name="searchby" value="6"  id="byInput1"></label>&nbsp;&nbsp;
                                    <label for="byInput2">Email <input type="radio" name="searchby" value="3"  id="byInput2"></label></label>&nbsp;&nbsp;
                                    <label for="byInput3">Seller/Buyer <input type="radio" name="searchby" value="2"  id="byInput3"></label>&nbsp;&nbsp;
                                    <label for="byInput4">Date <input type="radio" name="searchby" value="10"  id="byInput4"></label>&nbsp;&nbsp; -->
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                               <!--  <form method='post' action='controller/download.php'>

                                    <!- - Datepicker - ->
                                    <input type='date' class='datepicker' placeholder="From date" name="from_date" id='from_date'>
                                    <input type='date' class='datepicker' placeholder="To date" name="to_date" id='to_date'>

                                    <!- - Export button - ->
                                    <input type='submit' value='Export' name='Export'>
                                </form>  -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable" border="1">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Company Name</th>
                                                <th>Added On</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                                $i = 1;
                                                include('../controller/config.php');
                                                if (isset($_GET['pageno'])) {
                                                    $pageno = $_GET['pageno'];
                                                } else {
                                                    $pageno = 1;
                                                }
                                                $no_of_records_per_page = 100;
                                                $offset = ($pageno-1) * $no_of_records_per_page;

                                                $total_pages_sql = "SELECT COUNT(*) FROM tmp_register";
                                                $result = mysqli_query($conn,$total_pages_sql);
                                                $total_rows = mysqli_fetch_array($result)[0];
                                                $total_pages = ceil($total_rows / $no_of_records_per_page);

                                                $sql = "SELECT * FROM tmp_register ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                                                $res_data = mysqli_query($conn,$sql);
                                                while($row_adv1 = mysqli_fetch_array($res_data)){ 
                                                /* $queryp=mysqli_query($conn, "SELECT userid FROM product WHERE userid = '".$row_adv1['id']."'");
                                                $sum = mysqli_num_rows($queryp); */
                                            ?>
                                               
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $row_adv1['firstname']." ".$row_adv1['lastname']; ?></td>
                                                <td><?php echo $row_adv1['email']; ?></td>
                                                <td><?php echo $row_adv1['phonenumber'];?></td>
                                                <td><?php echo $row_adv1['company_name']; ?></td>
                                                <td><?php echo $row_adv1['created_on'];?></td>
                                                <td>https://annextrades.com/webhook/action.php?id=<?php echo $row_adv1['registration_id']; ?></td>
                                                <td><?php if($row_adv1['status'] == "0"){ 
                                                    ?>
                                                        <font color="#28a745" >Register</font>
                                                    <?php }else { ?>
                                                        <font color="#dc3545" >Pending</font>
                                                    <?php } ?>
                                                </td>
                                               <!--  <td><a href="#user_profile.php?id=<?php echo $row_adv1['id'];?>" style="color: #d70404;">View</a></td> -->
                                                
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
                                    <!-- <ul class="pagination">
                                        <li><a href="?pageno=1">First</a></li>
                                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                                        </li>
                                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                                        </li>
                                        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                                    </ul> -->
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