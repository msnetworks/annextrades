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
                            <h2 class="pageheader-title"><i class="fa fa-comments"></i> Contact Now List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">List of Contact Now</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Contact Now List</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                        <h5><a id="downloadLink2" onclick="exportF(this)" href="#">Export to excel</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                    <label for="myInput"><b>Search Contact Now:</b> </label><input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Type keywords.." title="Type in a name"><br>
                                    <label for="myInput"><b>Search By:</b> <br></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="byInput">Product Name <input type="radio" name="searchby" value="1"  id="byInput" checked></label>&nbsp;&nbsp;
                                    <label for="byInput2">Mail From <input type="radio" name="searchby" value="2"  id="byInput2"></label></label>&nbsp;&nbsp;
                                    <label for="byInput3">Mail To <input type="radio" name="searchby" value="3"  id="byInput3"></label>&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Product Name</th>
                                                <th>Mail From</th>
                                                <th>Mail To</th>
                                                <th>Message</th>
                                                <th>Contact Date</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query1=mysqli_query($conn, "SELECT * FROM messages  order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <!-- < ?php $quya1=mysqli_query($conn, "SELECT * FROM registration where email = '".$row_adv1['to_mail']."'");
                                                $rowr1=mysqli_fetch_array($quya1);
                                            ?>
                                            < ?php $quyb1=mysqli_query($conn, "SELECT * FROM registration where email = '".$row_adv1['from_mail']."'");
                                                $rows1=mysqli_fetch_array($quyb1);
                                            ?>
                                            < ?php $quyb1=mysqli_query($conn, "SELECT * FROM product where p_name = '".$row_adv1['subject']."'");
                                                $rowp1=mysqli_fetch_array($quyb1);
                                            ?> -->
                                            <tr>
                                                <td><?php echo $row_adv1['id'];?></td>
                                                <!-- <td><a target="_blank" href="edit_newproduct.php?product_id=<?php /* echo $row_adv1['product_id']; */ ?>&id=<?php /* echo $rowp1['userid']; */ ?>"><?php /* echo $rowp1['p_name']; */ ?></a></td> -->
                                                <td><?php echo $row_adv1['subject'];?></td>
                                                <td><?php echo $row_adv1['from_mail'];?></td>
                                                <td><?php echo $row_adv1['to_mail'];?></td>
                                                <td><?php echo $row_adv1['message'];?></td>
                                                <td><?php echo $row_adv1['date'];?></td>
                                                <td><a href="contactnow_view.php?id=<?php echo $row_adv1['id'];?>&fmail=<?php echo $row_adv1['from_mail'];?>&to=<?php echo $row_adv1['to_mail'];?>" style="color: #d70404;"><i class="fa fa-eye"></i></a></td>
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
            function exportF(elem) {
                var table = document.getElementById("myTable");
                var html = table.outerHTML;
                var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                elem.setAttribute("href", url);
                elem.setAttribute("download", "export.xls"); // Choose the file name
                return false;
            }
        </script>
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