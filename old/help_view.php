<?php 
	include("includes/header.php");
	include("includes/pagination.php");
	
	$get=$_REQUEST['view'];
	 if($_SESSION['language']=='english')
                          {
                            $sel_qry=mysqli_query($con,"select * from que_ans where id='$get' ");
                          }
							else if($_SESSION['language']=='french')
							{
							$sel_qry=mysqli_query($con,"select * from que_ans_french where id='$get' ");
							}
							else if($_SESSION['language']=='chinese')
							{
							$sel_qry=mysqli_query($con,"select * from que_ans_chinese where id='$get' ");
							}
						  else
							{
							$sel_qry=mysqli_query($con,"select * from que_ans_spanish where id='$get' ");
							}
	
	$answers=mysqli_fetch_array($sel_qry);
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
<div style="background-color:#29b1cb;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $answers['question']; ?></b></div>

<table border="0" width="100%" style="margin-top:10px;">
	<tr>
		<td width="98%" style="padding-left:10px;"><?php echo $answers['answer']; ?></td>
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
