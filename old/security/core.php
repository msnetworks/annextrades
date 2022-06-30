<?php
$configfile = 'config.php';
if (!file_exists($configfile)) {
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
}

include 'config.php';

session_start();

if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $table = $prefix . 'settings';
    $suser = $mysqli->query("SELECT username, password FROM `$table` WHERE username='$uname' LIMIT 1");
    $count = $suser->num_rows;
    if ($count < 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php" />';
        exit;
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
    exit;
}

if (basename($_SERVER['SCRIPT_NAME']) != 'warning-pages.php') {
    $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
}

$table = $prefix . 'settings';
$query = $mysqli->query("SELECT * FROM `$table` LIMIT 1");
$row   = mysqli_fetch_array($query);

function get_banned($ip)
{
    include 'config.php';
    $table = $prefix . 'bans';
    $query = $mysqli->query("SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        return 1;
    } else {
        return 0;
    }
}

function get_bannedid($ip)
{
    include 'config.php';
    $table = $prefix . 'bans';
    $query = $mysqli->query("SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
    $row   = mysqli_fetch_array($query);
    return $row['id'];
}

function head()
{
    include 'config.php';
    
    $table = $prefix . 'settings';
    $query = $mysqli->query("SELECT * FROM `$table` LIMIT 1");
    $row   = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta name="theme-color" content="#000000">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <title>Project SECURITY &rsaquo; Admin Panel</title>


    <!--STYLESHEET-->
    <!--=================================================-->
	
    <!--Bootstrap Stylesheet-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

	<!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	
	<!--Stylesheet-->
    <link href="assets/css/admin.min.css" rel="stylesheet">
	
    <!--Switchery-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
        
<?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php') {
        echo '
    <!--Select2-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">';
    }
?>

    <!--DataTables-->
    <link href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css" rel="stylesheet">
    
    <!--Flags-->
    <link href="assets/plugins/flags/flags.css" rel="stylesheet">
	
    <!--SCRIPT-->
    <!--=================================================-->

    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	
<?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php' || basename($_SERVER['SCRIPT_NAME']) == 'visit-analytics.php') {
        echo '
	<!--Chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>';
    }
?>

<?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'log-details.php' || basename($_SERVER['SCRIPT_NAME']) == 'search.php') {
        echo '
	
    <!--Map-->
    <script src="https://openlayers.org/api/OpenLayers.js"></script>';
    }
?>
<style>
/* width */
::-webkit-scrollbar {
    width: 6px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
}

.scroll-btn {
	height: 30px;
	width: 30px;
	border: 2px solid #000;
	border-radius: 10%;
	background-color: #000;
	position: fixed;
	bottom: 25px;
	right: 20px;
	opacity: 0.5;
	z-index: 9999;
	cursor: pointer;
	display: none;
}

.scroll-btn .scroll-btn-arrow {
	height: 8px;
	width: 8px;
	border: 3px solid;
	border-right: none;
	border-top: none;
	margin: 12px 9px;
	-webkit-transform: rotate(135deg);
	-moz-transform: rotate(135deg);
	-ms-transform: rotate(135deg);
	-o-transform: rotate(135deg);
	transform: rotate(135deg);
	color: white;
}

.notouch .scroll-btn:hover { opacity: 0.8 }

@media only screen and (max-width: 700px), only screen and (max-device-width: 700px) {
	.scroll-btn {
		bottom: 8px;
		right: 8px;
	}
}
</style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom">

        <ul class="nav navbar-nav">
		  <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
		</ul>
		  
		  <form class="form-inline ml-3" action="search.php" method="get">
      		  <div class="input-group input-group-sm">
      		    <input type="text" name="ip" class="form-control form-control-navbar" placeholder="IP Lookup" required>
				<div class="input-group-append">
				  <button type="submit" class="btn btn-navbar"><i class="fa fa-search"></i></button>
                </button>
     		    </div>
     		  </div>
   		  </form>
		  
		<ul class="nav navbar-nav ml-auto">
          <li class="nav-item d-none d-md-block">
             <a href="<?php
    echo $site_url;
?>" class="nav-link" target="_blank" title="View Site">
			 <i class="fas fa-desktop"></i>
			 </a>
          </li>
          <li class="nav-item">
             <a href="settings.php" class="nav-link" title="Settings"><i class="fas fa-cogs"></i></a>
          </li>
		  
<?php
    $uname = $_SESSION['sec-username'];
    $table = $prefix . 'settings';
    $suser = $mysqli->query("SELECT username, password FROM `$table` WHERE username='$uname' LIMIT 1");
    $urow  = mysqli_fetch_array($suser);
?>
        </ul>
    </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

	<center><a href="dashboard.php" class="brand-link">
      <span class="brand-text font-weight-light"><i class="fab fa-get-pocket"></i> Project SECURITY</span>
    </a></center>
	
	<div class="sidebar font-weight-light">
	
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <p style="margin: auto;"><a href="my-account.php" class="btn btn-sm btn-secondary btn-flat"><i class="fas fa-user fa-fw"></i> My Account</a>
		  &nbsp;&nbsp;<a href="logout.php" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a></p>
      </div>

	  <nav class="mt-2">
	  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<li class="nav-header">NAVIGATION</li>
        
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
        echo 'active';
    }
?>">
           <a href="dashboard.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-home"></i>&nbsp; <p>Dashboard</p>
           </a>
        </li>
          
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'site-info.php') {
        echo 'active';
    }
?>">
           <a href="site-info.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'site-info.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-info-circle"></i>&nbsp; <p>Site Information</p>
           </a>
        </li>
          
        <li class="nav-item has-treeview <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'ip-whitelist.php' OR basename($_SERVER['SCRIPT_NAME']) == 'file-whitelist.php') {
        echo 'menu-open';
    }
?>">
           <a href="#" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'ip-whitelist.php' OR basename($_SERVER['SCRIPT_NAME']) == 'file-whitelist.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-flag"></i>&nbsp; <p>Whitelist <i class="fas fa-angle-right right"></i>
           </p></a>
           <ul class="nav nav-treeview">
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'ip-whitelist.php') {
        echo 'active';
    }
?>"><a href="ip-whitelist.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'ip-whitelist.php') {
        echo 'active';
    }
?>"><i class="fas fa-user"></i>&nbsp; <p>IP Whitelist</p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'file-whitelist.php') {
        echo 'active';
    }
?>"><a href="file-whitelist.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'file-whitelist.php') {
        echo 'active';
    }
?>"><i class="far fa-file-alt"></i>&nbsp; <p>File Whitelist</p></a></li>
           </ul>
        </li>
          
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'warning-pages.php') {
        echo 'active';
    }
?>">
           <a href="warning-pages.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'warning-pages.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-file-alt"></i>&nbsp; <p>Warning Pages</p>
           </a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'users.php') {
        echo 'active';
    }
?>">
           <a href="login-history.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'login-history.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-history"></i>&nbsp; <p>Login History</p>
           </a>
        </li>

        <li class="nav-header">SECURITY</li>
          
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'sql-injection.php') {
        echo 'active';
    }
?>">
           <a href="sql-injection.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'sql-injection.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-code"></i>&nbsp; <p>SQL Injection
<?php
    $table = $prefix . 'sqli-settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] == 1) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-danger">OFF</span>';
    }
?>     
           </p></a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'badbots.php') {
        echo 'active';
    }
?>">
           <a href="badbots.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'badbots.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-user-secret"></i>&nbsp; <p>Bad Bots
<?php
    $table = $prefix . 'badbot-settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] == 1 OR $row['protection2'] == 1 OR $row['protection3'] == 1) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-danger">OFF</span>';
    }
?>     
           </p></a>
        </li>
          
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'proxy.php') {
        echo 'active';
    }
?>">
           <a href="proxy.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'proxy.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-globe"></i>&nbsp; <p>Proxy
<?php
    $table = $prefix . 'proxy-settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] > 0 OR $row['protection2'] == 1 OR $row['protection3'] == 1) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-danger">OFF</span>';
    }
?>     
           </p></a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'spam.php') {
        echo 'active';
    }
?>">
           <a href="spam.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'spam.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-keyboard"></i>&nbsp; <p>Spam
<?php
    $table = $prefix . 'spam-settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] == 1) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-danger">OFF</span>';
    }
?>     
           </p></a>
        </li>
        
<?php
    $table   = $prefix . 'logs';
    $lquery1 = $mysqli->query("SELECT * FROM `$table`");
    $lcount1 = mysqli_num_rows($lquery1);
    $lquery2 = $mysqli->query("SELECT * FROM `$table` WHERE `type`='SQLi'");
    $lcount2 = mysqli_num_rows($lquery2);
    $lquery3 = $mysqli->query("SELECT * FROM `$table` WHERE `type`='Bad Bot' or `type`='Fake Bot' or type='Missing User-Agent header' or type='Missing header Accept' or type='Invalid IP Address header'");
    $lcount3 = mysqli_num_rows($lquery3);
    $lquery4 = $mysqli->query("SELECT * FROM `$table` WHERE `type`='Proxy'");
    $lcount4 = mysqli_num_rows($lquery4);
    $lquery5 = $mysqli->query("SELECT * FROM `$table` WHERE `type`='Spammer'");
    $lcount5 = mysqli_num_rows($lquery5);
?>
        <li class="nav-item has-treeview <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'all-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'sqli-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'badbot-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'proxy-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'spammer-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'log-details.php') {
        echo 'menu-open';
    }
?>">
           <a href="#" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'all-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'sqli-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'badbot-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'proxy-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'spammer-logs.php' OR basename($_SERVER['SCRIPT_NAME']) == 'log-details.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-align-justify"></i>&nbsp; <p>Logs <i class="fas fa-angle-right right"></i>
           </p></a>
           <ul class="nav nav-treeview">
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'all-logs.php') {
        echo 'active';
    }
?>"><a href="all-logs.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'all-logs.php') {
        echo 'active';
    }
?>"><i class="fas fa-align-justify"></i>&nbsp; <p>All Logs <span class="badge right badge-primary"><?php
    echo $lcount1;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'sqli-logs.php') {
        echo 'active';
    }
?>"><a href="sqli-logs.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'sqli-logs.php') {
        echo 'active';
    }
?>"><i class="fas fa-code"></i>&nbsp; <p>SQLi Logs <span class="badge right badge-info"><?php
    echo $lcount2;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'badbot-logs.php') {
        echo 'active';
    }
?>"><a href="badbot-logs.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'badbot-logs.php') {
        echo 'active';
    }
?>"><i class="fas fa-robot"></i>&nbsp; <p>Bad Bots <span class="badge right badge-danger"><?php
    echo $lcount3;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'proxy-logs.php') {
        echo 'active';
    }
?>"><a href="proxy-logs.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'proxy-logs.php') {
        echo 'active';
    }
?>"><i class="fas fa-globe"></i>&nbsp; <p>Proxy Logs <span class="badge right badge-success"><?php
    echo $lcount4;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'spammer-logs.php') {
        echo 'active';
    }
?>"><a href="spammer-logs.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'spammer-logs.php') {
        echo 'active';
    }
?>"><i class="fas fa-keyboard"></i>&nbsp; <p>Spam Logs <span class="badge right badge-warning"><?php
    echo $lcount5;
?></span></p></a></li>
           </ul>
        </li>
        
<?php
    $table   = $prefix . 'bans';
    $bquery1 = $mysqli->query("SELECT * FROM `$table`");
    $bcount1 = mysqli_num_rows($bquery1);
    $table2  = $prefix . 'bans-country';
    $bquery2 = $mysqli->query("SELECT * FROM `$table2`");
    $bcount2 = mysqli_num_rows($bquery2);
    $table3  = $prefix . 'bans-ranges';
    $bquery3 = $mysqli->query("SELECT * FROM `$table3`");
    $bcount3 = mysqli_num_rows($bquery3);
    $table4  = $prefix . 'bans-other';
    $bquery4 = $mysqli->query("SELECT * FROM `$table4`");
    $bcount4 = mysqli_num_rows($bquery4);
?>
        <li class="nav-item has-treeview <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-ip.php' OR basename($_SERVER['SCRIPT_NAME']) == 'bans-iprange.php' OR basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php' OR basename($_SERVER['SCRIPT_NAME']) == 'bans-other.php') {
        echo 'menu-open';
    }
?>">
           <a href="#" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-ip.php' OR basename($_SERVER['SCRIPT_NAME']) == 'bans-iprange.php' OR basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php' OR basename($_SERVER['SCRIPT_NAME']) == 'bans-other.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-ban"></i>&nbsp; <p>Bans <i class="fas fa-angle-right right"></i>
           </p></a>
           <ul class="nav nav-treeview">
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-ip.php') {
        echo 'active';
    }
?>"><a href="bans-ip.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-ip.php') {
        echo 'active';
    }
?>"><i class="fas fa-user"></i>&nbsp; <p>IP Bans <span class="badge right badge-secondary"><?php
    echo $bcount1;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php') {
        echo 'active';
    }
?>"><a href="bans-country.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php') {
        echo 'active';
    }
?>"><i class="fas fa-globe"></i>&nbsp; <p>Country Bans <span class="badge right badge-secondary"><?php
    echo $bcount2;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-iprange.php') {
        echo 'active';
    }
?>"><a href="bans-iprange.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-iprange.php') {
        echo 'active';
    }
?>"><i class="fas fa-grip-horizontal"></i>&nbsp; <p>IP Range Bans <span class="badge right badge-secondary"><?php
    echo $bcount3;
?></span></p></a></li>
               <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-other.php') {
        echo 'active';
    }
?>"><a href="bans-other.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-other.php') {
        echo 'active';
    }
?>"><i class="fas fa-desktop"></i>&nbsp; <p>Other Bans <span class="badge right badge-secondary"><?php
    echo $bcount4;
?></span></p></a></li>
           </ul>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'content-protection.php') {
        echo 'active';
    }
?>">
           <a href="content-protection.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'content-protection.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-file-alt"></i>&nbsp; <p>Content Protection
<?php
    $table   = $prefix . 'content-protection';
    $queryfc = $mysqli->query("SELECT * FROM `$table` WHERE enabled = 1 LIMIT 1");
    $countfc = mysqli_num_rows($queryfc);
    if ($countfc > 0) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-primary">OFF</span>';
    }
?>
			  </p>
           </a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'adblocker-detection.php') {
        echo 'active';
    }
?>">
           <a href="adblocker-detection.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'adblocker-detection.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-window-maximize"></i>&nbsp; <p>AdBlocker Detection
<?php
    $table = $prefix . 'adblocker-settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['detection'] == 1) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-primary">OFF</span>';
    }
?>     
           </p></a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bad-words.php') {
        echo 'active';
    }
?>">
           <a href="bad-words.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bad-words.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-filter"></i>&nbsp; <p>Bad Words
<?php
    $table   = $prefix . 'bad-words';
    $queryfc = $mysqli->query("SELECT * FROM `$table` LIMIT 1");
    $countfc = mysqli_num_rows($queryfc);
    if ($countfc > 0) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-primary">OFF</span>';
    }
?>
           </p></a>
        </li>
		
		<li class="nav-header">SECURITY CHECK</li>
          
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'phpfunctions-check.php') {
        echo 'active';
    }
?>">
           <a href="phpfunctions-check.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'phpfunctions-check.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-check"></i>&nbsp; <p>PHP Functions</p>
           </a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'phpconfig-check.php') {
        echo 'active';
    }
?>">
           <a href="phpconfig-check.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'phpconfig-check.php') {
        echo 'active';
    }
?>">
              <i class="fab fa-php"></i>&nbsp; <p>PHP Configuration</p>
           </a>
        </li>
		
		<li class="nav-header">ANALYTICS &nbsp;
<?php
    $table = $prefix . 'settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['live_traffic'] == 1) {
        echo '<span class="right badge badge-success">ON</span>';
    } else {
        echo '<span class="right badge badge-primary">OFF</span>';
    }
?></li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'live-traffic.php') {
        echo 'active';
    }
?>">
           <a href="live-traffic.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'live-traffic.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-globe"></i>&nbsp; <p>Live Traffic</p>
           </a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'visit-analytics.php') {
        echo 'active';
    }
?>">
           <a href="visit-analytics.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'visit-analytics.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-chart-line"></i>&nbsp; <p>Visit Analytics</p>
           </a>
        </li>

        <li class="nav-header">MONITORING</li>
          
<?php
    $table   = $prefix . 'monitoring';
    $wmquery = $mysqli->query("SELECT * FROM `$table`");
    $wmcount = mysqli_num_rows($wmquery);
?>
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'website-monitoring.php') {
        echo 'active';
    }
?>">
           <a href="website-monitoring.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'website-monitoring.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-desktop"></i>&nbsp; <p>Website Monitoring  <span class="badge right badge-secondary"><?php
    echo $wmcount;
?></span></p>
           </a>
        </li>
          
        <li class="nav-header">TOOLS</li>

		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'error-monitoring.php') {
        echo 'active';
    }
?>">
           <a href="error-monitoring.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'error-monitoring.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-exclamation-circle"></i>&nbsp; <p>Error Monitoring</p>
           </a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'htaccess-editor.php') {
        echo 'active';
    }
?>">
           <a href="htaccess-editor.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'htaccess-editor.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-columns"></i>&nbsp; <p>.htacces Editor</p>
           </a>
        </li>
		
		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'port-scanner.php') {
        echo 'active';
    }
?>">
           <a href="port-scanner.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'port-scanner.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-search"></i>&nbsp; <p>Port Scanner</p>
           </a>
        </li>

		<li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'blacklist-checker.php') {
        echo 'active';
    }
?>">
           <a href="blacklist-checker.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'blacklist-checker.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-list"></i>&nbsp; <p>IP Blacklist Checker</p>
           </a>
        </li>
          
        <li class="nav-item <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'hashing.php') {
        echo 'active';
    }
?>">
           <a href="hashing.php" class="nav-link <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'hashing.php') {
        echo 'active';
    }
?>">
              <i class="fas fa-lock"></i>&nbsp; <p>Hashing</p>
           </a>
        </li>
		
		</ul>
          
      </nav>
    </div>

  </aside>
<?php
}

function footer()
{
    include 'config.php';
    
    $table = $prefix . 'settings';
    $query = $mysqli->query("SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
?>
<footer class="main-footer">
    <div class="scroll-btn"><div class="scroll-btn-arrow"></div></div>
    <strong>&copy; <?php
    echo date("Y");
?> <a href="https://codecanyon.net/item/project-security-website-security-antivirus-firewall/15487703?ref=Antonov_WEB" target="_blank">Project SECURITY</a></strong>
	
</footer>

</div>

    <!--JAVASCRIPT-->
    <!--=================================================-->

<script>
(function($) { // Avoid conflicts with other libraries

'use strict';

$(function() {
	var settings = {
			min: 200,
			scrollSpeed: 400
		},
		toTop = $('.scroll-btn'),
		toTopHidden = true;

	$(window).scroll(function() {
		var pos = $(this).scrollTop();
		if (pos > settings.min && toTopHidden) {
			toTop.stop(true, true).fadeIn();
			toTopHidden = false;
		} else if(pos <= settings.min && !toTopHidden) {
			toTop.stop(true, true).fadeOut();
			toTopHidden = true;
		}
	});

	toTop.bind('click touchstart', function() {
		$('html, body').animate({
			scrollTop: 0
		}, settings.scrollSpeed);
	});
});

})(jQuery);
</script>
	
<?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'proxy.php') {
        echo '
	<!--Popper JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>';
    }
?>
	
    <!--Bootstrap-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<!--Admin-->
    <script src="assets/js/admin.min.js"></script>

<?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php') {
        echo '
    <!--Select2-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>';
    }
?>
    
    <!--DataTables-->
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

</body>
</html>
<?php
}
?>