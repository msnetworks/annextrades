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
<div style="background-color:#29b1cb; height:20px; padding-top:10px;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px; padding-top:5px;"><?php echo $aboutus; ?></b></div>
<table>

<?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select about_us from cms");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select about_us from cms_french");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select about_us from cms_chinese");
}
else
{
$select=mysqli_query($con,"select about_us from cms_spanish");
}
	//$select=mysqli_query($con,"select about from general");
	$gen=mysqli_fetch_array($select);
?>
	<tr>
		<td style="padding-left:10px;"><?php echo $gen['about_us']; ?></td>
	</tr>

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
