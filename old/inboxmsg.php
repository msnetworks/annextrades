<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="company__container">
            <?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="tabs-cont"> <div class="left">
<div class="bordersty">
<div class="headinggg"><?php echo $inbox; ?></div>
<div style="color:#C55000; margin-left:10px; margin-top:10px;"><b style="font-size:14px;"><?php echo $inbox_msg; ?></b></div>
<?php 
	$view_msg=$_REQUEST['view'];
	$sql=mysqli_query($con,"select * from messages where id='$view_msg' ");
	$count_msg=mysqli_num_rows($sql);
	$array_msg=mysqli_fetch_array($sql);
	$user_id=$array_msg['user_id'];
	//echo '<pre>';
	//print_r($array_msg);
	$sqlreg=mysqli_query($con,"select * from registration where id='$user_id' ");
	//$count_msg=mysqli_num_rows($sql);
	$array_reg=mysqli_fetch_array($sqlreg);
	//echo '<pre>';
	//print_r($array_reg);
?>
<?php 
	if(isset($_REQUEST['delete']))
	{
	 	$deleteid=$_REQUEST['delid'];
 	 	$updatetsql_d ="UPDATE `messages` SET `tostatus`='1'  WHERE `id`='$deleteid'";
 	 	$query_up_d=mysqli_query($con,$updatetsql_d);
 		header("location:inbox.php"); 
	}
?>
<form id="form1" name="c_message" method="post" action="inboxmsg.php?delid=<?php echo $view_msg; ?>">
<table border="0" width="100%" style="margin-top:20px; margin-left:40px;">
	<tr>
		<td width="11%" style="line-height:30px;"><b><?php echo $from; ?></b></td>
		<td width="2%" style="line-height:30px;"><b>:</b></td>
		<td width="87%" style="line-height:30px;"><?php echo $array_reg['firstname'].' '.$array_reg['lastname']; ?></td>
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
		<td style="padding-left:150px;">
		<input type="button" style="width: 100px" name="Submit" value="<?php echo $reply; ?>" class="search_bg" onClick="javascript:location.href='compose.php?comp=<?php echo $view_msg; ?>';" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" style="width: 100px" name="delete" class="search_bg" value="<?php echo $delete; ?>" onclick="if(confirm('Are you sure you want to Delete this Record?'))
                        {  				
							return true;
						}
						else
						{	
							return false; 
						}"/>
		</td>
	</tr>
</table>
</form>
</div>

</div></div>

</div>

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
