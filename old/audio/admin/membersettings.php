<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$result=mysqli_query($con,"select * from membersettings");
	$details=mysqli_fetch_array($result);
	$id=$details['m_id'];
	$count=mysqli_num_rows($result);
	
	if(isset($_REQUEST['submit']))
	{
		$freepost=$_REQUEST['freepost'];
		$goldproduct = $_REQUEST['goldproduct'];
		$silverproduct = $_REQUEST['silverproduct'];
		$bronzeproduct = $_REQUEST['bronzeproduct'];
		$silveryear=$_REQUEST['silveryear'];
		$silveramount=$_REQUEST['silveramount'];
		$goldyear=$_REQUEST['goldyear'];
		$goldamount=$_REQUEST['goldamount'];
		$bronzeyear=$_REQUEST['bronzeyear'];
		$bronzeamount=$_REQUEST['bronzeamount'];
		/*$count=mysqli_num_rows(mysqli_query($con,"select * from mainarticles where articles='$categoryname'"));*/
		if($count>0)
		{
		
			mysqli_query($con,"update `membersettings` set `freepost`='$freepost', `goldpost`='$goldproduct',`gold_year`='$goldyear', `gold_amount`='$goldamount',`silverpost`='$silverproduct', `sillver_year`='$silveryear', `silver_amount`='$silveramount',`bronzepost`='$bronzeproduct', `bronze_year`='$bronzeyear', `bronze_amount`='$bronzeamount' where `m_id`='$id'");
			header("Location:membersettings.php?msg=upd");
		}
		else
		{
		
			mysqli_query($con,"insert into `membersettings`(`freepost`, `goldpost`, `gold_year`, `gold_amount`, `silverpost`, `sillver_year`, `silver_amount`,`bronzepost`, `bronze_year`, `bronze_amount`) values('$freepost', '$goldproduct','$goldyear', '$goldamount','$silverproduct', '$silveryear', '$silveramount','$bronzeproduct', '$bronzeyear', '$bronzeamount')");
			header("Location:membersettings.php?msg=ins");
		}
	}
	
	if(isset($_REQUEST['msg']))
	{
		echo "<meta http-equiv='refresh' content='3;URL=membersettings.php'>"; 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function addsubval()
{
if(document.addsubcat.cat.value=="")
{
 alert("Please Select The Category");
 document.addsubcat.cat.focus();
 return false;
}
if(document.addsubcat.subcat.value=="")
{
 alert("Plese Enter The Subcategory Name");
 document.addsubcat.subcat.focus();
 return false;
}  
}
</script>
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Membership Settings</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['suc'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Membership Settings</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form name="addsubcat" action="" method="post" onsubmit="return addsubval();">
					<table width="349" height="413" align="center">
						<?php if(isset($_REQUEST['msg'])){$msg=$_REQUEST['msg']?>
						<tr><td height="28" colspan="3" align="center"><span class="style1" style="color:#FF0000;"><?php if($msg=="upd"){?><b>Updated Successfully</b><?php }else{?>Added Successfully<?php }?></span></td>
						</tr>
						<?php }?>
						<tr>
							<td class="gbold" width="128" height="30">Free Post</td>
						  <td class="gbold">:</td>
						  <td width="209">&nbsp;&nbsp;&nbsp;<input type="text" name="freepost" value="<?php echo $details['freepost'];?>" /></td>
						</tr>
						<tr><td height="30" colspan="3" class="normalbold" style="color:#000099;">Gold Members</td>
						</tr>
						<tr><td class="gbold" height="35">No Of Products</td>
						<td class="gbold">:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="goldproduct" value="<?php echo $details['goldpost'];?>" /></td></tr>
						<tr><td class="gbold" height="35">Year</td>
						<td class="gbold">:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="goldyear" value="<?php echo $details['gold_year'];?>" /></td></tr>
						<tr><td class="gbold" height="32">Amount</td>
						<td class="gbold">:</td><td><!--<span class="normalbold">Rs</span>-->&nbsp;&nbsp;
						  <input type="text" name="goldamount" value="<?php echo $details['gold_amount'];?>" /></td>
						</tr>
						<tr><td height="30" colspan="3" class="normalbold" style="color:#000099;">Silver Members</td>
						</tr>
								<tr><td class="gbold" height="35">No Of Products</td>
						<td class="gbold">:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="silverproduct" value="<?php echo $details['silverpost'];?>" /></td></tr>
						<tr><td class="gbold" height="35">Year</td>
						<td class="gbold">:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="silveryear" value="<?php echo $details['sillver_year'];?>" /></td></tr>
						<tr><td class="gbold" height="32">Amount</td>
						<td class="gbold">:</td><td><!--<span class="normalbold">Rs</span>-->&nbsp;&nbsp;
						  <input type="text" name="silveramount" value="<?php echo $details['silver_amount'];?>" /></td>
						</tr>
						
						<tr><td height="31" colspan="3" class="normalbold" style="color:#000099;">Bronze Members</td>
						</tr>
						<tr><td class="gbold" height="33">No Of Products</td>
						<td class="gbold">:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="bronzeproduct" value="<?php echo $details['bronzepost'];?>" /></td></tr>
						<tr><td class="gbold" height="33">Year</td>
						<td class="gbold">:</td><td>&nbsp;&nbsp;&nbsp;<input type="text" name="bronzeyear" value="<?php echo $details['bronze_year'];?>" /></td></tr>
						<tr><td class="gbold" height="35">Amount</td>
						<td class="gbold">:</td><td><!--<span class="normalbold">Rs</span>-->&nbsp;&nbsp;
						  <input type="text" name="bronzeamount" value="<?php echo $details['bronze_amount'];?>" /></td>
						</tr>
						<tr>
							<td height="34" colspan="3" align="center">
								<input type="submit" name="submit" value="Save" /><br />
							</td>
						</tr>
					</table>
				  </form>
				</td></tr>
		  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>