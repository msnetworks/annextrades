<?php
$configfile = 'config.php';
if (!file_exists($configfile)) {
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
}

include "config.php";

session_start();

if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $table = $prefix . 'settings';
    $suser = $mysqli->query("SELECT username, password FROM `$table` LIMIT 1");
    $count = mysqli_num_rows($suser);
    if ($count > 0) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php" />';
        exit;
    }
}

$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$error = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
		<meta name="theme-color" content="#000000">
        <title>Project SECURITY &rsaquo; Admin Panel</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
		<link href="assets/css/admin.min.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
    </head>

    <body class="login-page">
	<div class="login-box">
	    <form action="" method="post">
	    
		<div class="login-logo">
           <a href="#"><i class="fab fa-get-pocket"></i> Project <b>SECURITY</b></a>
        </div>
		
		<div class="card">
           <div class="card-body text-white bg-dark">
<?php
if (isset($_POST['signin'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
	@$date = @date("d F Y");
    @$time = @date("H:i");
    
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = hash('sha256', $_POST['password']);
    $table    = $prefix . "settings";
    $check    = $mysqli->query("SELECT username, password FROM `$table` WHERE `username`='$username' AND password='$password'");
    if (mysqli_num_rows($check) > 0) {
        $table   = $prefix . "logins";
        $checklh = $mysqli->query("SELECT id FROM `$table` WHERE `username`='$username' AND ip='$ip' AND date='$date' AND time='$time' AND successful='1'");
        if (mysqli_num_rows($checklh) == 0) {
            $log = $mysqli->query("INSERT INTO `$table` (username, ip, date, time, successful) VALUES ('$username', '$ip', '$date', '$time', '1')");
        }
        
        $_SESSION['sec-username'] = $username;
        echo '<meta http-equiv="refresh" content="0;url=dashboard.php">';
    } else {
		$table   = $prefix . "logins";
        $checklh = $mysqli->query("SELECT id FROM `$table` WHERE `username`='$username' AND ip='$ip' AND date='$date' AND time='$time' AND successful='0'");
        if (mysqli_num_rows($checklh) == 0) {
            $log = $mysqli->query("INSERT INTO `$table` (username, ip, date, time, successful) VALUES ('$username', '$ip', '$date', '$time', '0')");
        }
        
        echo '
		<div class="alert alert-danger">
              <i class="fas fa-exclamation-circle"></i> The entered <strong>Username</strong> or <strong>Password</strong> is incorrect.
        </div>';
        $error = 1;
    }
}
?> 
			<div class="form-group has-feedback <?php
if ($error == 1) {
    echo 'has-danger';
}
?>">
            <div class="input-group mb-3">
				<input type="username" name="username" class="form-control <?php
if ($error == 1) {
    echo 'is-invalid';
}
?>" placeholder="Username" <?php
if ($error == 1) {
    echo 'autofocus';
}
?> required>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
            </div>
			</div>
            <div class="form-group has-feedback">
			    <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
				<div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
				</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" name="signin" class="btn btn-md btn-primary btn-block btn-flat"><i class="fas fa-sign-in-alt"></i>
&nbsp;Sign In</button>
                </div>
            </div>
			</div>
			</div>
        </form> 
		
		</div>
    </body>
</html>