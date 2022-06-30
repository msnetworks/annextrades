<?php
include "db-connect/notfound.php";
include "language/english/language.php";
include "includes/new/functions.php";
$languagee = $_REQUEST['lan'];

if ($languagee == "1") {
    $_SESSION['language'] = 'english';
} elseif ($languagee == "2") {
    $_SESSION['language'] = 'french';
} elseif ($languagee == "3") {
    $_SESSION['language'] = 'chinese';
} elseif ($languagee == "4") {
    $_SESSION['language'] = 'spanish';
    //echo $_SESSION['language'];
}

if ($_SESSION['language'] != "") {
    include "language/" . $_SESSION['language'] . "/language.php";
} else {
    $_SESSION['language'] = 'english';
    include "language/" . $_SESSION['language'] . "/language.php";
}

if ($cms_on != $cms_approve_st) {
    echo "<script>location.href='$cms_approve';</script>";
}
<?php
    $currentFile = basename($_SERVER['PHP_SELF'], ".php");

    $firstCharacter = $firstname[0];
?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Annex Trades</title>
    <meta name="description" content="<?php echo $webdes; ?>" />
    <meta name="keywords" content="<?php echo $webkeyword; ?>" />

    <!-- Bootstrap -->
    <link rel="icon" href="asset/images/annexis-emblem.png" type="image/png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js "></script>
    <style>
        .logo {
            width: 170px;
        }

        .logo img {
            max-width: 100%;
        }
    </style>
</head>

<?php $pageName = basename($_SERVER['PHP_SELF']);
$params = $_SERVER['QUERY_STRING'];

$page = $pageName . "?" . $params . "&";
?>

<script language="javascript">
    function redirect(ids) {

        window.location = '<?php echo $page; ?>lan=' + ids;
    }
</script>

<body>

    <?php
    $session_user = $_SESSION['user_login'];
    $sess_id = $_SESSION['user_login'];
    if ($_SESSION['language'] == 'english') {
        $select_log = "SELECT * FROM registration WHERE lang_status='0' and id='$session_user' ";
    } else if ($_SESSION['language'] == 'french') {
        $select_log = "SELECT * FROM registration WHERE lang_status='1' and id='$session_user' ";
    } else if ($_SESSION['language'] == 'chinese') {
        $select_log = "SELECT * FROM registration WHERE lang_status='2' and id='$session_user' ";
    } else {
        $select_log = "SELECT * FROM registration WHERE lang_status='3' and id='$session_user' ";
    }
    //$select_log="SELECT * FROM registration WHERE id='$session_user' ";
    $res_log = mysqli_query($con, $select_log);
    $fetch_log = mysqli_fetch_array($res_log);
    $firstname = $fetch_log['firstname'];
    $session_email = $fetch_log['email'];
    ?>
    <?php $currentFile = basename($_SERVER['PHP_SELF'], ".php");?>
    <!-- header Section Starts-->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light navigationbar">
                        <a class="navbar-brand logo" href="index.php"><img src="assets/images/logo.png" alt="logo"></a>

                        <?php include "includes/new/product_search.php"; ?>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <?php include "includes/new/menu.php"; ?>
                    </nav>
                    <?php include "includes/new/sub-menu.php"; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Header ends -->

    <!-- Sub Menu -->