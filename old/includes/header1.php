<?php 
include("db-connect/notfound.php");

$languagee=$_REQUEST['lan'];

if($languagee=="1")
{
$_SESSION['language'] = 'english';
}

if($_SESSION['language']!="")
{
include("language/".$_SESSION['language']."/language.php");

}


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $webname; ?></title>

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
<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="js/tab.js" type="text/javascript"></script>
</head>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/ddaccordion.js">

</script>
<script type="text/javascript">

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
	toggleclass: ["closedlanguage", "openlanguage"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "<img src='images/minus.gif' style='width:13px; height:13px' /> ", "<img src='images/plus.gif' style='width:13px; height:13px' /> "], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>
	<!-- Google Tag Manager --> 
	<script>(function(w,d,s,l,i){​​​​w[l]=w[l]||[];w[l].push({​​​​'gtm.start': 
	new Date().getTime(),event:'gtm.js'}​​​​);var f=d.getElementsByTagName(s)[0], 
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 
	' https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); 
	}​​​​)(window,document,'script','dataLayer','GTM-T8DJP2B');</script> 
	<!-- End Google Tag Manager -->
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
<?php  $pageName = basename($_SERVER['PHP_SELF']); 
     $params = $_SERVER['QUERY_STRING'];
	 
	 $page=$pageName."?".$params."&";
 ?>

<script language="javascript">
			function redirect(ids) {
					
				window.location='<?php echo $page; ?>lan='+ids;
			}
		</script>

<body>

<div class="fullcontainer"> 

<span class="header-row1">
<?php 
 $session_user=$_SESSION['user_login'];
 $sess_id=$_SESSION['user_login'];
 if($_SESSION['language']=='english')
{
$select_log="SELECT * FROM registration WHERE lang_status='0' and id='$session_user' ";
}
else if($_SESSION['language']=='french')
{
$select_log="SELECT * FROM registration WHERE lang_status='1' and id='$session_user' ";
}
else
{
$select_log="SELECT * FROM registration WHERE lang_status='2' and id='$session_user' ";
}

 //$select_log="SELECT * FROM registration WHERE id='$session_user' ";
 $res_log=mysqli_query($con,$select_log);
 $fetch_log=mysqli_fetch_array($res_log);
 $firstname=$fetch_log['firstname'];
 $session_email=$fetch_log['email'];
 ?>
</span>
<div class="header">
<div class="header-row1">
  <ul> 

<li> <b><?php echo $welcome; ?> <?php if($session_user=="") { ?> <?php echo $lower; ?> <?php } else {?><a href="myprofile.php"><?php echo $firstname;?></a> | <a href="land.php"><?php echo $myaccount; ?></a><?php }?></b> </li>
<li> | </li>
<?php if($session_user=="") { ?>
<li> <a href="register.php"><?php echo $join; ?></a> </li>
<li> | </li>
<li> <a href="login.php"><?php echo $sign; ?></a></li>
<?php }  else {?>
<li> <a href="logout.php"><?php echo $logout; ?></a></li>
<?php } ?>

</ul>

</div>
<?php
  if($logo=="")
  {
  $logo="logo.jpg";
  }
  else 
	 {
		if(file_exists("images/".$logo))
		{
			$logo = $logo;
		}
		else{
			$logo = "logo.jpg";	
		}
	 }
  ?>

<div class="header-row2"> 
<div class="logo"><a href="index.php"><img src="images/<?php echo $logo; ?>" alt="" width="169" height="48" /></a> </div>

<?php 
$test_sdd=$_REQUEST['DIVIDd'];
  if($test_sdd=="StabThree")
  {
include("product_search.php");
 }
else  if($test_sdd=="StabTwo")
  {
include("selling_search.php");
 }
else if($test_sdd=="StabFour")
  {
  //echo "dnbgfv";
include("trade_search.php");
 }
 else
 {
 include("product_search.php");
 }

?>

<div class="flagcont">
  <table width="145" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="37" align="left" valign="top"><a href="#" onclick="redirect('1');" title="English" ><img src="images/flag1.png" alt="" width="32" height="26" /></a></td>
     <!-- <td width="37" align="left" valign="top"><a href="#"><img src="images/flag2.png" alt="" width="32" height="26" /></a></td>-->
      <td width="37" align="left" valign="top"><a href="#" onclick="redirect('2');" title="French"><img src="images/flag3.png" alt="" width="32" height="26" /></a></td>
      <td align="left" valign="top"><a href="#" onclick="redirect('3');" title="Chinese"><img src="images/flag4.png" alt="" width="32" height="26" /></a></td>
    </tr>
  </table>
</div>

</div>

</div>
