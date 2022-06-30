<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../superadmin/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../superadmin/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../superadmin/assets/libs/css/style.css">
    <link rel="stylesheet" href="../superadmin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="https://annextrades.com"><img class="logo-img" src="https://annextrades.com/assets/images/logo.png" alt="logo" width="150px"></a></div>
            <h5 class="splash-description">Reset Password</5>
            <span class="splash-description">Please enter new password.</span>
            <div class="card-body">
                <form method="POST" name="myForm" action="reset_pswd_bknd.php" onsubmit="return validateForm()">
                    <div class="form-group">
                        <input name="vendor_id" value="<?php echo $_GET['reg'];?>" type="text" hidden>
                        <input class="form-control form-control-lg" id="reg" name="reg" value="<?php echo $_GET['email'];?>" type="text" readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="pass" type="password" min="6" name="password" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <span class="registrationFormAlert" style="color:green; position: absolute; padding-left: 15px; left: 15px;" id="CheckPasswordMatch"></span>
                        <input class="form-control form-control-lg" id="cpass" type="password" min="6" name="cpassword" placeholder="Confirm Password">
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form><br><hr>
                <h5><a href="https://annextrades.com/login.php">Click Here to Sign In</a></h5>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#cpass").keyup(checkPasswordMatch);
        });
        function checkPasswordMatch() {
            var password = $("#pass").val();
            var confirmPassword = $("#cpass").val();
            if (password == confirmPassword)
                $("#CheckPasswordMatch").html("Match.");
            else
                $("#CheckPasswordMatch").html("Does not match!");
        }
    </script>
    <script>
        function validateForm(){
                
            var x = document.forms["myForm"]["pass"].value;
            if (x == "") {
                alert("Password must be filled out");
                return false;
            }
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
        }

    </script>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../superadmin/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../superadmin/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>