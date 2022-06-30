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
                            <h3 class="mb-2">Create New Registration</h3><div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create New Registration</li>
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
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><h5>Registration Details</h5></div>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="POST" name="myForm" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="firstname">First Name *</label>
                                            <input type="text" class="form-control" name="fname" id="firstname">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="lastname">Last Name *</label>
                                            <input type="text" class="form-control" name="lname" id="lastname">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 ">
                                            <label for="companyname">Company Name *</label>
                                            <input type="text" class="form-control" name="companyname" id="companyname">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="phone">Phone *</label>
                                            <input type="text" class="form-control" name="phone" id="phone">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="email">Email *</label>
                                            <input type="text" class="form-control" name="email" id="email">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="password">Password *</label>
                                            <input type="password" class="form-control" name="pass" id="password">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="cpassword">Confirm Password *</label>
                                            <!-- <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px;" id="CheckPasswordMatch"></span> -->
                                            <input type="password" class="form-control" name="cpass" id="cpass">
                                            <!-- <div class="invalid-feedback">
                                                Required
                                            </div>
                                            <div class="valid-feedback">
                                                Done
                                            </div> -->
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <div style="border: 1px solid #ccc; font-size: 16px; background-color: #ECEFF1; padding: 8px 15px 8px 15px; margin-bottom: 25;">
                                                <label for="gender" style="padding-right: 20px;  margin-bottom: 0;"><b>Account Type*</b></label>
                                                <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type" value="Seller" class="w-auto m-0" <?php if($r['usertype'] == 'Seller'){echo 'readonly checked';}?>/> &nbsp;Seller:&nbsp; <b> Sell My Products or Services</b></label>
                                                <?php
                                                    //if (@$_GET['package'] == 'BusinessPortal' & @$_GET['source'] != NULL) {
                                                ?>       
                                                <label style="padding-right: 20px;  margin-bottom: 0;"><input type="radio" name="user_type" id="user_type1" value="Buyer" class="w-auto m-0" <?php if($r['usertype'] == 'Buyer'){echo 'readonly checked';}?>>&nbsp; Buyer:&nbsp;<b> Buy Products and Services </b></label>
                                                <?php
                                                //}
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustomDate">Date of Registration</label>
                                            <input type="datetime" name="date" class="form-control" value="<?php echo date('y.d.m'); ?>" id="validationCustomdate" readonly>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustomDate">Added By</label>
                                            <input type="text" name="added_by" class="form-control" value="<?php echo $_SESSION['super_name']; ?>" id="validationCustomdate" readonly>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>

                                        <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label style="padding-right: 20px;  margin-bottom: 0; font-size: 16px;" >
                                                <input type="checkbox" name="terms" class="w-auto" id="terms" /> I agree to all <a href="https://www.annexis.net/terms-amp-condition/" target="_blank">Terms & Condition</a> and
                                                <a href="https://www.annexis.net/privacy-policy/" target="_blank">Privacy Policy</a>
                                            </label>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label style="padding-right: 20px;  margin-bottom: 0; font-size: 16px;">
                                                <input type="checkbox" name="newsletter" class="w-auto" id="newsletter" value="yes" />
                                                I would like to receive newsletters and directory magazines.
                                            </label>
                                        </div> -->
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
            var x = document.forms["myForm"]["lname"].value;
            if (x == "") {
                alert("Last Name must be filled out");
                return false;
            }/* 
            var x = document.forms["myForm"]["gender"].value;
            if (x == "") {
                alert("Gender required");
                return false;
            } */
            var x = document.forms["myForm"]["companyname"].value;
            if (x == "") {
                alert("Company Name must be filled out");
                return false;
            }
            /* var x = document.forms["myForm"]["pan_no"].value; 
            if (x == ""){
                alert("PAN Number must be filled out");
                return false;
            } */
            
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
                    alert("Choose Account Type");
                    return false;
                }
                $.ajax({
                    method: 'POST',
                    url: 'controller/register-submit.php',
                    crossDomain: true,
                    data: data,
                    dataType: 'json',
                    success: function ( response ){ 
                            console.log(response);
                        if(response != ''){
                            if(response == "Failed to Registration"){
                                alert('Failed to Registration');
                            }
                            else{   

                                /* if (response == 'PAN/GST already exist') {
                                        alert('PAN/GST already exist');
                                    }
                                    else{ */
                                        if(response == 'Email already exist'){
                                            alert('Email already exist');
                                        }
                                        else{
                                            console.log(response);
                                            alert('Registration Success. Please Verify Your Email.');
                                    
                                    $('#user-form').css("opacity",".5");

                                    window.location.href = response;
                                    

                                    
                                /*  } */
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