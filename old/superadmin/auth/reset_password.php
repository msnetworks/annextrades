<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
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
            <div class="card-header text-center"><a href="https://www.annexis.net"><img class="logo-img" src="../../templates/images/logo-wide.png" alt="logo" width="100px"></a></div>
            <h5 class="splash-description">Reset Password</5>
            <span class="splash-description">Please enter a new password.</span>
            <div class="card-body">
                <form method="POST" action="reset_pswd_bknd.php">
                    <div class="form-group"-->
                        <input class="form-control form-control-lg" id="reg" name="reg" value="<?php echo $_GET['email'];?>" type="text" readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" min="6" name="password" placeholder="Enter New Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form><br><hr><hr>
                <h5><a href="./">Click Here for Sign In</a></h5>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>