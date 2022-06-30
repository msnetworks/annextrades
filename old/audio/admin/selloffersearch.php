<?php
	//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("pagenation.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	
	$uid=$_REQUEST['uid'];
	$strget="";
	$rowsPerPage =2;
	if(isset($_REQUEST['search']))
	{
		$keyword=$_REQUEST['keyword'];
		$fromdate=$_REQUEST['fromdate'];
		$todate=$_REQUEST['todate'];
		$show=$_REQUEST['show'];
		if($_REQUEST['uid']!=""){echo $uid=$_REQUEST['uid'];$userid="id='$uid' and ";}else{$userid="";}
		if($show=="all"){$status="status='1' or status='2' or status='3' or status='0'";}else{$status="status=$show";}
		if($keyword!="")
		{
			$sql="select * from tbl_seller where $user_id ($status) and (seller_subject like '%$keyword%' or seller_keyword like '%$keyword%' or seller_description like '%$keyword%' or seller_detaildescription like '%$keyword%')";
		}
		else if($fromdate!="" && $todate!="")
		{
			$sql="select * from tbl_seller where $status and seller_expired_date between '$fromdate' and '$todate'";
		}
	}
	$result=mysqli_query($con,getPagingQuery($sql, $rowsPerPage,$strget));
	//echo mysqli_error($con);
	$pagingLink = getPagingLink($sql, $rowsPerPage,"search=search&uid=$uid&keyword=$keyword&fromdate=$fromdate&todate=$todate&show=$show");
	$num=mysqli_num_rows(mysqli_query($con,$sql));
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="JavaScript1.2" src="../script/cal2.js"></script>
<script language="JavaScript1.2">
//Define calendar(s): addCalendar ("Unique Calendar Name", "Window title", "Form element's name", Form name")
addCalendar("Calendar1", "Select Date", "fromdate", "search");
addCalendar("Calendar2", "Select Date", "todate", "search");

 setWidth(90, 1, 15, 1);

setFormat("yyyy-mm-dd");

</script>
</head>

<body>
<table width="100%" height="496" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<?php include("include/adminheader.php");?>		</td>
	</tr>
	<tr><td height="40" colspan="3"></td>
	</tr>
	<tr>
		<td width="18%" valign="top">
			<?php include("include/leftmenu.php");?>	  </td>
		<td width="3%" valign="top">&nbsp;</td>
		<td width="79%" height="409" valign="top">
			<table width="98%" align="left" cellspacing="0" style="border:solid 1px #669966;">
				<tr><td height="27" bgcolor="#669966" class="adminheading">Selling Leads</span></td>
				</tr>
				<tr><td>
					<?php //include("sell_leadheaduser.php");?>
				</td></tr>
				<tr><td><?php include("selloffersearchhead.php");?></td></tr>
				<tr><td height="358" valign="top">
					<table width="732" height="157" align="center" cellspacing="0">
						<tr bgcolor="#FFFFE1" class="normalbold"><td width="141" height="32">Photo</td>
						<td width="172">Product Name</td>
						<td width="162">Posted By</td>
						<td width="163">Updated Date</td>
						<td width="82">Details</td>
					  </tr>
						
						<?php while($product=mysqli_fetch_array($result)){
							$image="../uploads/".$product['seller_photo'];
							$memberid=$product['user_id'];
							$name=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$memberid'"));
						?>
						<tr class="smallfont">
						<td colspan="5">
							<table width="734" bgcolor="#FFFFFF">
							  <tr>
							  <td width="134" height="102"><img src="<?php echo $image;?>" width="98" height="86" /></td>
							  <td width="172" valign="top"><?php echo $product['seller_subject'];?></td>
							  <td width="160" valign="top"><?php echo $name['firstname']." ".$name['lastname'];?></td>
							  <td width="160" valign="top"><?php echo $product['seller_updated_date'];?></td>
							  <td width="78" valign="top"><a href="sell_leadviewuser.php?sid=<?php echo $product['seller_id'];?>&uid=<?php echo $uid;?>">Show</a>
							  <!--<a href="sell_leadmail.php?sid=<?php //echo $product['seller_id'];?>">Mails</a>-->
							  </td>
						 	</tr></table>
						 </td>
						</tr>
						<tr><td></td></tr>
						<?php }?>
						<?php if($num>$rowsPerPage){?>
						<tr><td colspan="5" align="center"><?php echo $pagingLink;?></td></tr>
						<?php }?>
						<?php if($num<=0){?>
						<tr>
						  <td colspan="5" align="center" class="redboldlink">No Products Found</td>
						</tr>
						<?php }?>
				  </table>
				</td></tr>
		  </table>
	  </td>
	</tr>
</table>
</body>
</html>
