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
                            <h2 class="pageheader-title">Category List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Category</li>
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
                            <div class="card-headre row" >
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5 style="padding: 30px;">Category List</h5></div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right" style="padding: 30px;"><h5><a href="#" style="padding: 15px;">Add New Category</a></h5></div>
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                    <label for="myInput"><b>Search Category:</b> </Label><input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for category.." title="Type in a name">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Caregory Id</th>
                                                <th>Category</th>
                                                <th>No's Sub Catefory</th>
                                                <th>View & Edit</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                                $query1=mysqli_query($conn, "SELECT * FROM category WHERE parent_id = '' order by c_id desc");
                                                WHILE($row_adv1=mysqli_fetch_array($query1)){
                                                $query2=mysqli_query($conn, "SELECT parent_id FROM category WHERE parent_id = '".$row_adv1['c_id']."'");
                                                $sub_id = mysqli_num_rows($query2);
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['c_id'];?></td>

                                                <td><?php echo $row_adv1['category'];?></td>
                                                <td>
                                                    <?php echo $sub_id; ?>
                                                </td>
                                                <td><a href="view_category.php?c_id=<?php echo $row_adv1['c_id'];?>" style="color: #d70404;"><i class="fa fa-eye"></i></a></td>
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