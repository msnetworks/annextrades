<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>

<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">
function openClosStatus(AAA) {
    if (
		document.getElementById(AAA).style.display == "block") {
        document.getElementById(AAA).style.display = "none";
       } 
	   else 
	   {
        document.getElementById(AAA).style.display = "block";
       }
}
function openClosother(CCC) {
    if (
		document.getElementById(CCC).style.display == "block") {
        document.getElementById(CCC).style.display = "none";
       } 
	   else 
	   {
        document.getElementById(CCC).style.display = "block";
       }
}
function openCloseother(BBB) {
    if (
		document.getElementById(BBB).style.display == "block") {
        document.getElementById(BBB).style.display = "none";
       } 
	   else 
	   {
	   
        document.getElementById(BBB).style.display = "block";
       }
}
function emailThisPage(url)
{
  var newwindow=window.open(url,'name','width=510,height=600,scrollbars=yes');
}
</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/help_side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $quiz_info; ?></b></div>
<table>
<form id="form1" name="form1" method="post" action="">
<?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select * from company_info");
$gen=mysqli_fetch_array($select);
$company=$gen['company_info'];
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select * from company_info");
$gen=mysqli_fetch_array($select);
$company=$gen['company_info_french'];
}
else
{
$select=mysqli_query($con,"select * from company_info");
$gen=mysqli_fetch_array($select);
$company=$gen['company_info_chinese'];
}
	//$select=mysqli_query($con,"select help_reg from general");
	//$gen=mysqli_fetch_array($select);
?>
	<tr>
		<td style="padding-left:10px;"><?php echo $company; ?></td>
	</tr>
	<tr>
		<td style="padding-left:10px;">We have field sales and marketing offices in more than 30 cities in India and the United States.</td>
	</tr>
</form>
</table>
</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
