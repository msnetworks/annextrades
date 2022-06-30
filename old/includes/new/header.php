<?php
include "db-connect/notfound.php";
include "language/english/language.php";
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AnnexTrades</title>
    <meta name="facebook-domain-verification" content="yf2lddeyq9506u21lfprbpxxj9r259" />

    <meta property="type" content="website">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ANNEXTrades, US Business, India Business, Export to USA, Sell Products, Buy Products, Expand your business to USA" name="keywords">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="role" content="og:main">
    <meta name="og:TileColor" content="#ffffff">
    <meta content="ANNEXTrades" name="og:author">

    <!--  Essential META Tags -->
    <meta property="og:title" content="ANNEXTrades">
    <meta property="og:description" content="Your Bridge to Expansion & Increased Market Share.">
    <meta property="og:image" content="https://annextrades.com/assets/images/annexis-emblem.png">
    <meta name="og:email" content="welcome@annextrades.com">
    
    <meta property="og:url" content="https://annextrades.com">
    <meta name="twitter:card" content="Your Bridge to Expansion & Increased Market Share.">

    <!--  Non-Essential, But Recommended -->
    <meta property="og:site_name" content="ANNEXTrades">
    <meta name="twitter:image:alt" content="Your Bridge to Expansion & Increased Market Share.">

    <!--  Non-Essential, But Required for Analytics -->

    <meta name="twitter:site" content="mantusharma7">


    <link rel="icon" href="assets/images/annexis-emblem.png" type="image/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
      <!-- AOS -->
      <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- <link href="assets/css/responsive.css" rel="stylesheet"> -->
    <!--link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'-->
    <!-- Facebook Pixel Code -->

    <!-- Global site tag (gtag.js) - Google Ads: 568387266 -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173541794-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-173541794-1');
    </script>
        
    <!-- <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '806925426514345'); 
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=806925426514345&ev=PageView
        &noscript=1"/>
    </noscript> -->
    <!-- End Facebook Pixel Code -->

    <!-- End Global site tag (gtag.js) - Google Analytics -->
    
    <script src="assets/js/jquery.min.js "></script>
    <style>
        .navbar{
            font-family: 'Montserrat';
        }
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
<!-- 
<script language="javascript">
    function redirect(ids) {

        window.location = '<?php echo $page; ?>lan=' + ids;
    }
</script> -->

<body

    <?php
    $session_user = $_SESSION['user_login'];
    $sess_id = $_SESSION['user_login'];
    if ($_SESSION['language'] == 'english') {
        $select_log = "SELECT * FROM registration WHERE id='".$_SESSION['user_login']."' ";
    } else if ($_SESSION['language'] == 'french') {
        $select_log = "SELECT * FROM registration WHERE lang_status='1' and id='".$_SESSION['user_login']."' ";
    } else if ($_SESSION['language'] == 'chinese') {
        $select_log = "SELECT * FROM registration WHERE lang_status='2' and id='".$_SESSION['user_login']."' ";
    } else {
        $select_log = "SELECT * FROM registration WHERE lang_status='3' and id='".$_SESSION['user_login']."' ";
    }
    //$select_log="SELECT * FROM registration WHERE id='$session_user' ";
    $res_log = mysqli_query($con, $select_log);
    $fetch_log = mysqli_fetch_array($res_log);
    //echo 'testfile';
    //echo '<pre>';
    //print_r($fetch_log);
    //echo '</pre>';
    $firstname = $fetch_log['firstname'];
    $session_email = $fetch_log['email'];
    echo $firstname;
    ?>
    <!-- header Section Starts --> 
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="padding: 0;">
                    <nav class="navbar navbar-expand-lg navbar-light navigationbar" style="padding: 0 15;">
                        <a class="navbar-brand logo" href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
                        <?php include "includes/new/product_search.php"; ?>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <?php include "includes/new/menu.php"; ?>
                    </nav>
                    <hr style="margin: 0px; padding:0;">
                    <?php include "includes/new/sub-menu.php"; ?> 
                </div>
            </div>
        </div>
    </div>
    <!-- Header ends -->

    <!-- Sub Menu -->
    