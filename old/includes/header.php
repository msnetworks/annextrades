<?php
$currentFile = basename($_SERVER['PHP_SELF'], ".php");

$firstCharacter = $firstname[0];
?>
<?php
include "db-connect/notfound.php";

$languagee = $_REQUEST['lan'];

if ($languagee == "1") {
    $_SESSION['language'] = 'english';
}

if ($_SESSION['language'] != "") {
    include "language/" . $_SESSION['language'] . "/language.php";

} else {
    $_SESSION['language'] = 'english';
    include "language/" . $_SESSION['language'] . "/language.php";
}

if ($cms_on != $cms_approve_st) {echo "<script>location.href='$cms_approve';</script>";}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Annex Trade</title><!--?php echo $webname; ?-->
    
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


    <meta name="facebook-domain-verification" content="yf2lddeyq9506u21lfprbpxxj9r259" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:700|Merienda&display=swap" rel="stylesheet"> 
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="js/tab.js" type="text/javascript"></script>

    <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript" src="js/ddaccordion.js"></script>
    <link rel="icon" type="image/png" href="assets/images/annexis-emblem.png" />
     <!-- Bootstrap -->
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800;1,900&display=swap" rel="stylesheet">
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link href="assets/css/responsive.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js "></script>
    <!-- Global site tag (gtag.js) - Google Ads: 568387266 -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173541794-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-173541794-1');
    </script>
	<!-- Event snippet for Website traffic (1) conversion page -->
	<script>
		gtag('event', 'conversion', {'send_to': 'AW-568387266/cTTPCO741OEBEMLNg48C'});
	</script>
    <!-- Google Tag Manager --> 
<script>(function(w,d,s,l,i){​​​​w[l]=w[l]||[];w[l].push({​​​​'gtm.start': 
new Date().getTime(),event:'gtm.js'}​​​​);var f=d.getElementsByTagName(s)[0], 
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 
' https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); 
}​​​​)(window,document,'script','dataLayer','GTM-T8DJP2B');</script> 
<!-- End Google Tag Manager -->
<style>
.navbar-brand.logo img
{
    max-width: 100%;
}
.header
{
    padding: 0;
}
button.subscribe-btn
{
background-image: none;
}
footer .navbar-brand.logo
{
    float: none;
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
    }

    //$select_log="SELECT * FROM registration WHERE id='$session_user' ";
    $res_log = mysqli_query($con, $select_log);
    $fetch_log = mysqli_fetch_array($res_log);
    $firstname = $fetch_log['firstname'];
    $session_email = $fetch_log['email'];
    ?>
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
                </div>
            </div>
        </div>
    </div> 
    <!-- Header ends -->

    <!-- Sub Menu -->
    <!-- < ?php if ($_SERVER['REQUEST_URI'] == '/newanx/html/business_news.php' ){
        }else{    
    ?> -->
    <?php include "includes/new/sub-menu.php"; ?>
    <div class="fullcontainer">

        