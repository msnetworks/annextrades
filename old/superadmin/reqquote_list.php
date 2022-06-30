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
                            <h2 class="pageheader-title"><i class="fa fa-comments"></i> Request Quotes List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Request Quotes</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Request Quotes List</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                        <h5><a id="downloadLink2" onclick="exportF(this)" href="#">Export to excel</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                    <label for="myInput"><b>Search Request Quotes:</b> </label><input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Type keywords.." title="Type in a name"><br>
                                    <label for="myInput"><b>Search By:</b> <br></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="byInput">Product Name <input type="radio" name="searchby" value="1"  id="byInput" checked></label>&nbsp;&nbsp;
                                    <label for="byInput2">Seller/Supplier <input type="radio" name="searchby" value="2"  id="byInput2"></label></label>&nbsp;&nbsp;
                                    <label for="byInput3">Requested By <input type="radio" name="searchby" value="3"  id="byInput3"></label>&nbsp;&nbsp;
                                    <label for="byInput3">Message By <input type="radio" name="searchby" value="5"  id="byInput3"></label>&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Seller/Supplier Name</th>
                                                <th>Requested By</th>
                                                <th>Message</th>
                                                <th>Message By</th>
                                                <th>Quote Date</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query1=mysqli_query($conn, "SELECT * FROM getquote  order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            
                                            <?php 
                                                $quyb1=mysqli_query($conn, "SELECT * FROM registration where vendor_id = '".$row_adv1['sender_vendor_id']."'");
                                                $rows1=mysqli_fetch_array($quyb1);
                                            ?>
                                            <?php 
                                                $quyb1=mysqli_query($conn, "SELECT * FROM product where id = '".$row_adv1['product_id']."'");
                                                $rowp1=mysqli_fetch_array($quyb1);

                                                $quya1=mysqli_query($conn, "SELECT * FROM registration where id = '".$rowp1['userid']."'");
                                                $rowr1=mysqli_fetch_array($quya1);
                                                $quya2=mysqli_query($conn, "SELECT * FROM registration where vendor_id = '".$row_adv1['reply_by']."'");
                                                $rowr2=mysqli_fetch_array($quya2);
                                            ?>
                                            <tr>
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <td><a target="_blank" href="edit_newproduct.php?product_id=<?php echo $row_adv1['product_id'];?>&id=<?php echo $rowp1['userid'];?>"><?php echo $rowp1['p_name'];?></a></td>
                                                <td><?php echo $rowr1['companyname'];?></td>
                                                <td><?php echo $rows1['companyname'];?></td>
                                                <td><?php echo $row_adv1['quote'];?></td>
                                                <td><?php echo $rowr2['companyname'];?></td>
                                                <td><?php echo $row_adv1['date'];?></td>
                                                <td><a href="quotereq_view.php?id=<?php echo $row_adv1['id'];?>" style="color: #d70404;"><i class="fa fa-eye"></i></a></td>
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
            <script>
                function exportF(elem) {
                    var table = document.getElementById("myTable");
                    var html = table.outerHTML;
                    var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                    elem.setAttribute("href", url);
                    elem.setAttribute("download", "export.xls"); // Choose the file name
                    return false;
                }
            </script>
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