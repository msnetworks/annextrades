<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $sent_items; ?></b></div>
<?php 
	$view_msg=$_REQUEST['view'];
	$sql=mysqli_query($con,"select * from `messages` where  id='$view_msg' ");
	$count_msg=mysqli_num_rows($sql);
	$array_msg=mysqli_fetch_array($sql);
?>
<?php 
	if(isset($_REQUEST['delete']))
	{
	 	$deleteid=$_REQUEST['delid'];
 	 	$updatetsql_d ="delete from messages where id=$deleteid";
 	 	$query_up_d=mysqli_query($con,$updatetsql_d);
 		header("location:trash.php?tras"); 
	}
?>
<form id="form1" name="c_message" method="post" action="">
<table border="0" width="100%" style="margin-top:20px; margin-left:40px;">
	<tr>
		<td width="11%" style="line-height:30px;"><b><?php echo $from; ?></b></td>
		<td width="2%" style="line-height:30px;"><b>:</b></td>
		<td width="87%" style="line-height:30px;"><?php echo $array_msg['from_mail']; ?></td>
	</tr>
	<tr>
		<td width="11%" style="line-height:30px;"><b><?php echo $to; ?></b></td>
		<td width="2%" style="line-height:30px;"><b>:</b></td>
		<td width="87%" style="line-height:30px;"><?php echo $array_msg['to_mail']; ?></td>
	</tr>
	<tr>
		<td style="line-height:30px;"><b><?php echo $subject; ?></b></td>
		<td style="line-height:30px;"><b>:</b></td>
		<td style="line-height:30px;"><?php echo $array_msg['subject']; ?></td>
	</tr>
	<tr>
		<td style="line-height:30px;"><b><?php echo $message; ?></b></td>
		<td style="line-height:30px;"><b>:</b></td>
		<td style="line-height:30px;"><?php echo $array_msg['message']; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="padding-left:150px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="delete" class="search_bg" value="<?php echo $delete; ?>" onClick="if(confirm('Are you sure you want to Delete this Record?'))
                        {  				
							return true;
						}
						else
						{	
							return false; 
						}"/>
						<input type="hidden" name="delid" value="<?php echo $_REQUEST['view']; ?>" />
		</td>
	</tr>
</table>
</form>
</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
