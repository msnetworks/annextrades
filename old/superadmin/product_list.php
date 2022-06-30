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
                            <h2 class="pageheader-title">Product List</h2>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6 text-left">
                                        <h5>Product List</h5>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6 text-right">
                                        <h5><a id="downloadLink" onclick="exportG(this)" href="#">Export to excel (Full Sheet)</a></h5>
                                       <!--  <button id="export">Export to Excel</button> -->
                                        
                                    </div>
                                </div>
                                <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5>Total Registrations :&nbsp; <font color="#dc3545" ><b id="shw"></b></font>&nbsp;&nbsp; Buyer :&nbsp; <font color="#dc3545" ><b><?php echo $cntBuyer; ?></b></font>&nbsp;&nbsp; Seller :&nbsp; <font color="#dc3545" ><b><?php echo $cntSeller; ?></b></font></h5></div> -->
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                    <label for="myInput"><b>Search Product Name:</b> </Label><input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Type Keyword.." title="Type in a name"><br>
                                    <label for="myInput"><b>Search By:</b> <br></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="byInput">Product Name <input type="radio" name="searchby" value="1"  id="byInput" checked></label>&nbsp;&nbsp;
                                    <label for="byInput2">Company Name <input type="radio" name="searchby" value="2"  id="byInput2"></label></label>&nbsp;&nbsp;
                                    <label for="byInput3">Contact Person <input type="radio" name="searchby" value="3"  id="byInput3"></label>&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" id="tableHolder">
                                    <table class="table table-striped table-bordered first border" style="border: 1px solid #333;" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Company Name</th>
                                                <th>Contact Person</th>
                                                <th>Image</th>
                                                <th>Added Date</th>
                                                <th>Active Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $query1=mysqli_query($conn, "SELECT * FROM product order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <td><?php echo $row_adv1['p_name'];?></td>
                                                <td>
                                                    <?php $quy1=mysqli_query($conn, "SELECT * FROM registration where id = '".$row_adv1['userid']."'");
                                                        $rowv1=mysqli_fetch_array($quy1);
                                                        echo $rowv1['companyname'];    
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $rowv1['firstname']." ".$rowv1['lastname']; ?>
                                                </td>
                                                <td><img src="../productlogo/<?php echo $row_adv1['p_photo'];?>" style="width: 100px; height: 100px;" alt=""></td>
                                                <td><?php echo $row_adv1['udate'];?></td>
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
                                                <td><a href="edit_newproduct.php?product_id=<?php echo $row_adv1['id'];?>&id=<?php echo $row_adv1['userid'];?>" style="color: #d70404;"><i class="fa fa-edit"></i></a></td>
                                                
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
                                    <script>
                                        function exportG(elem) {
                                            var table = document.getElementById("myTable");
                                            var html = table.outerHTML;
                                            var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                                            elem.setAttribute("href", url);
                                            elem.setAttribute("download", "export.xls"); // Choose the file name
                                            return false;
                                        }
                                       /*  $("#export").click(function (e) {
                                            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#tableHolder').html()));
                                            e.preventDefault();
                                        }); */
                                    </script>
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