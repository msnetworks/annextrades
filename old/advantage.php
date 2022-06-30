<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/help_side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $advantage; ?></b></div>
<table>

<?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select advantage from cms");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select advantage from cms_french");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select advantage from cms_chinese");
}
else
{
$select=mysqli_query($con,"select advantage from cms_spanish");
}
	
	$gen=mysqli_fetch_array($select);
?>
	<tr>
		<td style="padding-left:10px;"><?php echo $gen['advantage']; ?></td>
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
