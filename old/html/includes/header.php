<?php
$currentFile = basename($_SERVER['PHP_SELF'], ".php");

$firstCharacter = $firstname[0];
?>
<?php
include "db-connect/notfound.php";

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

if ($cms_on != $cms_approve_st) {echo "<script>location.href='$cms_approve';</script>";}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Annex Trade</title><!--?php echo $webname; ?-->
    <meta name="description" content="<?php echo $webdes; ?>" />
    <meta name="keywords" content="<?php echo $webkeyword; ?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:700|Merienda&display=swap" rel="stylesheet"> 
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



<!-- <script type="text/javascript">
ddaccordion.init({
    headerclass: "technology", //Shared CSS class name of headers group
    contentclass: "thelanguage", //Shared CSS class name of contents group
    revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
    mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
    collapseprev: false, //Collapse previous content (so only one open at any time)? true/false
    defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
    onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
    animatedefault: false, //Should contents open by default be animated into view?
    persiststate: false, //persist state of opened contents within browser session?
    toggleclass: ["closedlanguage",
        "openlanguage"
    ], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
    togglehtml: ["prefix", "<img src='images/minus.gif' style='width:13px; height:13px' /> ",
        "<img src='images/plus.gif' style='width:13px; height:13px' /> "
    ], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
    animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
    oninit: function(expandedindices) { //custom code to run when headers have initalized
        //do nothing
    },
    onopenclose: function(header, index, state,
        isuseractivated) { //custom code to run whenever a header is opened or closed
        //do nothing
    }
})
</script> -->

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
        <?php } ?>
    <div class="fullcontainer">

        