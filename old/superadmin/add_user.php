<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query3=mysqli_query($conn, "SELECT * FROM `registration` WHERE id='".$_GET['id']."' ");
        $row_adv4=mysqli_fetch_array($query3);
        $query2=mysqli_query($conn, "SELECT * FROM `product` WHERE id='".$_GET['product_id']."' ");
            $row_adv2=mysqli_fetch_array($query2);
            
?>
    <?php include"header.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
            max-height: 300px;
        }
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
            }
    </style>
        <!-- ============================================================== --> 
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="influence-profile">
                <div class="container-fluid dashboard-content">
                    <!-- ============================================================== -->
                    <!-- pageheader -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2">Create New User</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Create New User</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- campaign data -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="card">

                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><h5>User Detail</h5></div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" id="form" method="POST" name="myForm" enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="firstname">Full Name *</label>
                                                <input type="text" class="form-control" name="fname" id="firstname">
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="phone">Phone *</label>
                                                <input type="text" class="form-control" name="phone" id="phone">
                                            </div>

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="email">Email *</label>
                                                <input type="text" class="form-control" name="email" id="email">
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="password">Password *</label>
                                                <input type="password" class="form-control" name="pass" id="password">
                                            </div>

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="cpassword">Confirm Password *</label>
                                                <!-- <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px;" id="CheckPasswordMatch"></span> -->
                                                <input type="password" class="form-control" name="cpass" id="cpass">
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <div style="border: 1px solid #ccc; font-size: 16px; background-color: #ECEFF1; padding: 8px 15px 8px 15px; margin-bottom: 25;">
                                                    <label for="gender" style="padding-right: 20px;  margin-bottom: 0;"><b>User Type*</b></label>
                                                    <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type" value="Management" class="w-auto m-0"/> &nbsp;<b>Management</b></label>
                                                    <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type" value="IT Support" class="w-auto m-0"/> &nbsp;<b>IT Support</b></label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="validationCustomDate">Date</label>
                                                <input type="datetime" name="date" class="form-control" value="<?php echo date('y.d.m'); ?>" id="validationCustomdate" readonly>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="validationCustomDate">Added By</label>
                                                <input type="datetime" name="addedby" class="form-control" value="<?php echo $_SESSION['super_name']; ?>" id="validationCustomdate" readonly>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br><br>
                                            </div>   
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <button class="btn btn-primary" type="submit"><b>SUBMIT</b></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-right">
                                    <h4><a class="btn btn-success" href="user_list.php">Users List</a></h4>
                                </div>
                            </div>
                        <!-- ============================================================== -->
                        <!-- end campaign tab one -->
                        <!-- ============================================================== -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- end campaign data -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end content -->
<script>
    $(document).ready(function () {
        $("#cpass").keyup(checkPasswordMatch);
    });
    function checkPasswordMatch() {
        var password = $("#pass").val();
        var confirmPassword = $("#cpass").val();
        if (password == confirmPassword)
            $("#CheckPasswordMatch").html("Password match.");
        else
            $("#CheckPasswordMatch").html("Password does not match!");
    } 
</script>
<script>
        $("#form").on('submit', function(e){
            e.preventDefault();
            var data = $(this).serialize();

        var x = document.forms["myForm"]["fname"].value;
        if (x == "") {
            alert("First Name must be filled out");
            return false;
        }
        var x = document.forms["myForm"]["phone"].value;
        var filter = /^\d*(?:\.\d{10})?$/;
        if (x == "") {
            alert("Phone Number must be filled out");
            return false;
        }
        if (filter.test(x) == false) {
            alert("Please Enter 10digit Valid Phone Number");
            return false;
        }
        if (x.length != 10) {
            alert("Please Enter 10digit Valid Phone Number");
            return false;
        }
        var x = document.forms["myForm"]["email"].value;
        if (x == "") {
            alert("Enter The Email");
            document.getElementById('email').focus();
            return false;
        } else {

            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (re.test(document.forms["myForm"]["email"].value) == false) {

                alert("Enter the Valid Email Address");
                document.forms["myForm"]["email"].focus();
                return false;
                
            }

        }
            var x = document.forms["myForm"]["pass"].value;
            var re = /^[a-zA-Z0-9]+$/;
            if (x == "") {
                alert("Password must be filled out");
                return false;
            }
            if (x.length < 8) {
                alert("Password Require Minimum 8 Characters.");
                return false;
            }
            /* if(re.test(x) == false){
                alert("Password Require Atleast 1 Number.");
                return false;
            } */

            var x = document.forms["myForm"]["cpass"].value;
            if (x == "") {
                alert("Confirm Password must be filled out");
                return false;
            }
            var x = document.forms["myForm"]["cpass"].value;
            var y = document.forms["myForm"]["pass"].value;
            if (x != y) {
                alert("Confirm Password must be same as password");
                return false;
            }
            var x = document.forms["myForm"]["user_type"].value;
            if (x == "") {
                alert("Choose User Type");
                return false;
            }
            $.ajax({
                method: 'POST',
                url: 'controller/add_user.php',
                crossDomain: true,
                data: data,
                dataType: 'json',
                success: function ( response ){ 
                        console.log(response);
                    if(response != ''){
                        if(response == "Failed to Registration"){
                            alert('Failed to Add');
                        }
                        else{   
                                    if(response == 'Email already exist'){
                                        alert('Email already exist');
                                    }
                                    else{
                                        console.log(response);
                                        alert('Added Successfully.');
                                
                                $('#user-form').css("opacity",".5");
                                window.location.href = response;
                                
                                }
                        }
                    } 
                }
            }); 
            
        });

</script>
            <?php include"footer.php"; ?> 
            
            <?php
            }
                else{ 
                            header('location: auth/');
                    } 
            ?>      