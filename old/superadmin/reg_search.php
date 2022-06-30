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
                            <h2 class="pageheader-title">Registration List</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="registration_list.php" class="breadcrumb-link">Registration</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Search Result</li>
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
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Search Result</h5></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                                    <h5><a href="registration_list.php">View All</a> &nbsp;&nbsp;&nbsp;
                                    <!-- <a id="downloadLink2" onclick="exportG(this)" href="#">Export to excel (Full Sheet)</a> --></h5>
                                    </div>
                                    

                                    <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5>Total Registrations :&nbsp; <font color="#dc3545" ><b id="shw"></b></font>&nbsp;&nbsp; Buyer :&nbsp; <font color="#dc3545" ><b><?php echo $cntBuyer; ?></b></font>&nbsp;&nbsp; Seller :&nbsp; <font color="#dc3545" ><b><?php echo $cntSeller; ?></b></font></h5></div> -->
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="col-md-12">
                                    <form name="myForm" action="reg_search.php" method="POST">
                                        <!-- <label for="myInput"><b>Search Name:</b> </label> --><input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search keyword.."><br>
                                        <input type="submit" class="btn btn-primary" value="SEARCH">
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
                                                <th>Vendor Id</th>
                                                <th>Name</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>Email Status</th>
                                                <th>Status</th>
                                                <th>Password</th>
                                                <th>Company Name</th>
                                                <th>Contact</th>
                                                <th>Products</th>
                                                <th>Star Rating</th>
                                                <th>Join Date</th>
                                                <th>Last Login</th>
                                                <th>Added By</th>
                                                <th>Email</th>
                                                <!-- <th>Expiry Date</th>
                                                <th>Active Status</th>
                                                <th>Payment</th> -->
                                                <th>View</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            $search = $_POST['search'];
                                            $query1=mysqli_query($conn, "SELECT * FROM registration WHERE firstname like '%$search%' or lastname like '%$search%' or companyname like '%$search%' or email like '%$search%' order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                                $queryp=mysqli_query($conn, "SELECT userid FROM product WHERE userid = '".$row_adv1['id']."'");
                                                $sum = mysqli_num_rows($queryp);
                                            ?>
                                            <tr style="background: <?php if ($row_adv1['star_rating'] == '1'){ echo '#ff93987a'; }elseif($row_adv1['star_rating'] == '2'){ echo"#ffcc61b3"; }elseif($row_adv1['star_rating'] == '3'){ echo"#3aaa4780"; } ?>;">
                                                <td><?php echo $row_adv1['vendor_id'];?></td>
                                                <td><?php echo "<a onclick='javascript:nameValue$i();' style='color: #333;' href='#'>".$row_adv1['firstname']." ".$row_adv1['lastname']."</a>"; ?>
                                                    <script>
                                                        function nameValue<?php echo $i; ?>(){
                                                            var id= "<?php echo $row_adv1['vendor_id']; ?>";
                                                            var firstname=prompt("Enter First Name:", "<?php echo $row_adv1['firstname'];?>");
                                                            var lastname=prompt("Enter Last Name:", "<?php echo $row_adv1['lastname'];?>");
                                                            var re = /^[a-zA-Z]*$/;
                                                            var test = firstname+""+lastname;
                                                                if(confirm("Name = "+firstname+" "+lastname+".  Are you sure want to update?")){
                                                                    if (re.test(test)) {
                                                                        $.ajax({
                                                                        method: 'POST',
                                                                        url: 'controller/nameupdate.php',
                                                                        data: {id: id, firstname: firstname, lastname: lastname},
                                                                        dataType: 'json',
                                                                        success: function ( response ){
                                                                                alert(response);
                                                                        }
                                                                        });
                                                                    }
                                                                    else{
                                                                        alert("Please Enter Number only (1-5) -> "+rate);
                                                                    }   
                                                                }else{
                                                                    return false;
                                                                }
                                                            }
                                                    </script>
                                                </td>
                                                <td><?php echo $row_adv1['usertype'];?></td>
                                                <td><?php echo "<a onclick='javascript:emailValue$i();' style='color: #333;' href='#'>".$row_adv1['email']."</a>"; ?>
                                                    <script>
                                                        function emailValue<?php echo $i; ?>(){
                                                            var id= "<?php echo $row_adv1['vendor_id']; ?>";
                                                            var email=prompt("Enter Correct Company Name:", "<?php echo $row_adv1['email'];?>");
                                                            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                                                            if(confirm("Email = "+email+" Are you sure want to update?")){
                                                                if (re.test(email)) {
                                                                    $.ajax({
                                                                    method: 'POST',
                                                                    url: 'controller/emailupdate.php',
                                                                    data: {id: id, email: email},
                                                                    dataType: 'json',
                                                                    success: function ( response ){
                                                                        if(response != 'Email Alreay Exist.'){
                                                                            alert(response);
                                                                        }else{
                                                                            alert(response);
                                                                        }
                                                                    }
                                                                    });
                                                                }
                                                                else{
                                                                    alert("Please Enter Number only (1-5) -> "+rate);
                                                                }   
                                                            }else{
                                                                return false;
                                                            }
                                                        }
                                                    </script>
                                                </td>
                                                <td><?php if($row_adv1['email_verify'] == "Verified"){ 
                                                    ?>
                                                    <font color="#28a745" >Verified</font><?php }else {
                                                    ?>
                                                        <font color="#dc3545" >Not Verified</font>
                                                    <?php } ?>
                                                </td>
                                                <td><?php if($row_adv1['userstatus'] == "0"){ 
                                                    ?>
                                                        <font color="#28a745" >Active</font>
                                                    <?php }else { ?>
                                                        <font color="#dc3545" >Not Active</font>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row_adv1['password'];?></td>
                                                <td><?php echo "<a onclick='javascript:companyValue$i();' style='color: #333;' href='#'>".$row_adv1['companyname']."</a>"; ?>
                                                    <script>
                                                        function companyValue<?php echo $i; ?>(){
                                                            var id= "<?php echo $row_adv1['vendor_id']; ?>";
                                                            var companyname=prompt("Enter Correct Company Name:", "<?php echo $row_adv1['companyname'];?>");
                                                            if(confirm("Company Name =  "+companyname+" Are you sure want to update?")){
                                                                    $.ajax({
                                                                    method: 'POST',
                                                                    url: 'controller/companynameupdate.php',
                                                                    data: {id: id, companyname: companyname},
                                                                    dataType: 'json',
                                                                    success: function ( response ){
                                                                            alert(response);
                                                                    }
                                                                    });
                                                            }else{
                                                                return false;
                                                            }
                                                        }
                                                    </script>
                                                </td>
                                                <td><?php echo $row_adv1['phonenumber'];?></td>
                                                <td><center>
                                                <?php if($sum == "0"){
                                                    echo "<font style='color: #dc3545;'>No Product</font>";
                                                }else{ echo "<font style='color: #28a745;'>( ".$sum." ) Product</font>";} ?></center></td>
                                                <td>
                                                    <img class="star-rating" src="../assets/images/stars-<?php echo $row_adv1['star_rating']; ?>.png" style="width: 70px;" alt=""> <span style="verticle-align: bottom;"><?= $reviewAvg ?>
                                                    <?php echo "<a onclick='javascript:rateValue$i();' href='#'>Rate</a>"; ?>
                                                    <script>
                                                        function rateValue<?php echo $i; ?>(){
                                                            var id= "<?php echo $row_adv1['vendor_id']; ?>";
                                                            var rate=prompt("Enter Rating (1-5):");
                                                            var re = /^[1-5]+$/;
                                                            if(re.test(rate)){
                                                                $.post("controller/rateupdate.php", {id: id, rate: rate });
                                                                alert("Ratting Update -> "+rate);
                                                                window.load();

                                                            }
                                                            else{
                                                                alert("Please Enter Number only (1-5) -> "+rate);
                                                            }   
                                                        }
                                                    </script>
                                                    <!-- <a style="color: #ff7900;" href="#rating" data="" onclick="prompt('Rate in number between 1-5', '')">Rate</a></span> -->
                                                    
                                                </td>
                                                <td><?php echo $row_adv1['added_date'];?></td>
                                                <td><?php echo $row_adv1['last_visit_date'];?></td>
                                                <td><?php echo $row_adv1['added_by'];?></td>
                                                <td><a href="email_template.php?v_id=<?php echo $row_adv1['vendor_id']; ?>">Mail Now</a></td>
                                                    <!-- <td>< ?php echo $row_adv1['expiry_date'];?></td>
                                                    <td>
                                                        < ?php if($row_adv1['payment'] == 'Yes') { ?>
                                                        <font color="#28a745" >Active</font>
                                                        < ?php }
                                                        else {
                                                        ?>
                                                        <font color="#dc3545" >Not Active</font>
                                                        < ?php } ?>
                                                    </td>
                                                    <td>< ?php echo $row_adv1['payment'];?></td> -->
                                                <td><a href="user_profile.php?vendor_id=<?php echo $row_adv1['vendor_id'];?>" style="color: #d70404;">View</a></td>
                                                
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
                                    <table class="table table-striped table-bordered first" style="display: none;" id="myTbl"  border="1">
                                        <thead>
                                            <tr>
                                                <th>Company ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Company Name</th>
                                                <th>Contact</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            $query1=mysqli_query($conn, "SELECT * FROM registration order by id desc");
                                            WHILE($row_adv1=mysqli_fetch_array($query1)){
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $row_adv1['firstname'];?></td>
                                                <td><?php echo $row_adv1['lastname'];?></td>
                                                <td><?php echo $row_adv1['email'];?></td>
                                                <td><?php echo $row_adv1['companyname'];?></td>
                                                <td><?php echo $row_adv1['phonenumber'];?></td>
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
                                    <script>
                                        function exportF(elem) {
                                            var table = document.getElementById("myTbl");
                                            var html = table.outerHTML;
                                            var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                                            elem.setAttribute("href", url);
                                            elem.setAttribute("download", "export.xls"); // Choose the file name
                                            return false;
                                        }
                                        function exportG(elem) {
                                            var table = document.getElementById("myTable");
                                            var html = table.outerHTML;
                                            var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                                            elem.setAttribute("href", url);
                                            elem.setAttribute("download", "export.xls"); // Choose the file name
                                            return false;
                                        }
                                        $(document).ready(function(){

                                            // From datepicker
                                            $("#from_date").datepicker({ 
                                            dateFormat: 'yy-mm-dd',
                                            changeYear: true,
                                            onSelect: function (selected) {
                                                var dt = new Date(selected);
                                                dt.setDate(dt.getDate() + 1);
                                                $("#to_date").datepicker("option", "minDate", dt);
                                            }
                                            });

                                            // To datepicker
                                            $("#to_date").datepicker({
                                            dateFormat: 'yy-mm-dd',
                                            changeYear: true,
                                            onSelect: function (selected) {
                                                var dt = new Date(selected);
                                                dt.setDate(dt.getDate() - 1);
                                                $("#from_date").datepicker("option", "maxDate", dt);
                                            }
                                            });
                                            });
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