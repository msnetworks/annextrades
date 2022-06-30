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
                            <h2 class="pageheader-title">User List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of User</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>User List</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                        <h4><a class="btn btn-success" href="add_user.php"><i class="fa fa-plus"></i> Add User</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTbl"  border="1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            $query1=mysqli_query($conn, "SELECT * FROM superadmin order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <td><?php echo $row_adv1['name'];?></td>
                                                <td><?php echo $row_adv1['usertype'];?></td>
                                                <td><?php echo $row_adv1['email'];?></td>
                                                <td><?php echo $row_adv1['phone'];?></td>
                                                <td><?php if($row_adv1['status'] == "0"){ 
                                                    ?>
                                                    <font color="#28a745" >Active</font><?php }else {
                                                    ?>
                                                        <font color="#dc3545" >Not Active</font>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            
                                            <?php $i++; } ?>
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
                            <!-- <div class="card-footer text-right">
                                <h4><a class="btn btn-success" href="add_user.php"><i class="fa fa-plus"></i> Add User</a></h4>
                            </div> -->
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