<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_POST['submit']))
{
	$addcode=mysqli_real_escape_string($con, $_POST['hori_one']);
	$addcode2=mysqli_real_escape_string($con, $_POST['hori_two']);
	$addcode3=mysqli_real_escape_string($con, $_POST['hori_three']);
	
	if($addcode!='')
	{
	$adheader_count=mysqli_num_rows(mysqli_query($con,"select * from `addmanager` where `title`='header'"));
		if($adheader_count>0)
		{
			mysqli_query($con,"UPDATE  addmanager SET `body`='$addcode',`status`= '".$_REQUEST['hori_one_status']."' WHERE `title`='header'");
		}
		else
		{
			mysqli_query($con,"INSERT INTO addmanager VALUES ('','header','$addcode','".$_REQUEST['hori_one_status']."')");
		}
	}
	if($addcode2!='')
	{
	$ad_rightmenu_count=mysqli_num_rows(mysqli_query($con,"select * from `addmanager` where `title`='rightmenu'"));
		if($ad_rightmenu_count>0)
		{
			mysqli_query($con,"UPDATE  addmanager SET `body`='$addcode2',`status`= '".$_REQUEST['hori_two_status']."' WHERE `title`='rightmenu'");
		}
		else
		{
			mysqli_query($con,"INSERT INTO addmanager VALUES ('','rightmenu','$addcode2','".$_REQUEST['hori_two_status']."')");
		}
	}
	if($addcode3!='')
	{
	$center_count=mysqli_num_rows(mysqli_query($con,"select * from `addmanager` where `title`='center'"));
		if($center_count>0)
		{
			mysqli_query($con,"UPDATE  addmanager SET `body`='$addcode3',`status`= '".$_REQUEST['hori_three_status']."' WHERE `title`='center'");
		}
		else
		{
			mysqli_query($con,"INSERT INTO addmanager VALUES ('','center','$addcode3','".$_REQUEST['hori_three_status']."')");
		}
	}
	mysqli_query($con,"update addmanager set `body`= REPLACE(body,'\\','')");
	header("location:googleads.php?msg=upd");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function trimAll(sString){
	while (sString.substring(0,1) == ' '){
		sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' '){
		sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

function validate()
{
if(document.advertise.hori_one.value=="")
{
alert("Enter Header Advertisement Script");
document.advertise.hori_one.focus();
return false;
}
if(document.advertise.hori_two.value=="")
{
alert("Enter RightMenu Advertisement Script");
document.advertise.hori_two.focus();
return false;
}
if(document.advertise.hori_three.value=="")
{
alert("Enter Center Advertisement Script");
document.advertise.hori_three.focus();
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Google Ads</b></a></article>
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
		<header><h3 class="tabs_involved">Google Advertise Settings</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">
				
				<tr><td valign="top">
					<form action="" enctype="multipart/form-data" name="advertise" method="post">
					<table width="80%" height="147" align="center">
					<?php 
						$sql="SELECT * FROM addmanager LIMIT 0,1";
						$query=mysqli_query($con,$sql);
						$details=mysqli_fetch_array($query);
	 				?>
					<?php if(isset($_REQUEST['msg'])){$msg=$_REQUEST['msg']?>
						<tr><td colspan="5" align="center"><?php if($msg=="upd"){?>
			    		<span class="style2" style="color:#996666;"><b>Updated Successfully</b></span>
			  		<?php }else{?>
			  			<span class="style2">Added Successfully</span>			  <?php }?></td>
						</tr>
					<?php } ?>
					<tr>
                      <td width="93">&nbsp;</td>
                      <td width="262" align="right" nowrap="nowrap"><div align="left" class="gbold"> <strong style="color:#000099;">Vertical1  Adv</strong> :</div></td>
                      <td width="9" class="content1">&nbsp;</td>
                      <td width="416" align="left" class="content1"><font face="Verdana" style="font-size:12px ">
                        						<textarea name="hori_one" cols="50" rows="10"><?php echo $details['body'];?></textarea>
                      </font></td>
                      <td width="80" align="left" class="content1">&nbsp;</td>
                    </tr>
					
					<tr>
                      <td width="93">&nbsp;</td>
                      <td width="262" align="right" nowrap="nowrap"><div align="left" class="gbold" > <strong style="color:#000099;">Vertical1  Status :</strong></div></td>
                      <td width="9" class="content1">&nbsp;</td>
                      <td width="416" align="left" class="bluebold"><font face="Verdana" style="font-size:12px ">
                       <input type="radio" name="hori_one_status" value="1" <?php if($details['status']==1) {?> checked="checked" <?php } ?> /> Enable
					   <input type="radio" name="hori_one_status" value="0" <?php if($details['status']==0) {?> checked="checked" <?php } ?>/> Disable
                      </font></td>
                      <td width="80" align="left" class="content1">&nbsp;</td>
					</tr>
					
					<tr>
                      <td colspan="5" align="center" ><?php #echo $details['hori_one'];?></td>
                    </tr>
					
					<?php 
						$sql="SELECT * FROM addmanager LIMIT 1,1";
						$query=mysqli_query($con,$sql);
						$details=mysqli_fetch_array($query);
	                ?>
					
					<tr>
                      <td width="93">&nbsp;</td>
                      <td width="262" align="right" nowrap="nowrap"><div align="left" class="gbold"> <strong style="color:#000099;">Feedback ad  Adv :</strong></div></td>
                      <td width="9" class="content1">&nbsp;</td>
                      <td width="416" align="left" class="content1"><font face="Verdana" style="font-size:12px ">
                        						<textarea name="hori_two" cols="50" rows="10"><?php echo $details['body'];?></textarea>
                      </font></td>
                      <td width="80" align="left" class="content1">&nbsp;</td>
					</tr>
					
					<tr>
                      <td width="93">&nbsp;</td>
                      <td width="262" align="right" nowrap="nowrap"><div align="left" class="gbold"><strong style="color:#000099;">Feedback ad  Status :</strong></div></td>
                      <td width="9" class="content1">&nbsp;</td>
                      <td width="416" align="left" class="bluebold"><font face="Verdana" style="font-size:12px ">
                       <input type="radio" name="hori_two_status" value="1" <?php if($details['status']==1) {?> checked="checked" <?php } ?>/> Enable
					   <input type="radio" name="hori_two_status" value="0" <?php if($details['status']==0) {?> checked="checked" <?php } ?>/> Disable
                      </font></td>
                      <td width="80" align="left" class="content1">&nbsp;</td>
					</tr>
					
					<tr>
                      <td colspan="5" align="center" ><?php #echo $details['hori_two'];?></td>
                    </tr>
					
					<?php 
						$sql="SELECT * FROM addmanager LIMIT 2,1";
						$query=mysqli_query($con,$sql);
						$details=mysqli_fetch_array($query);
	                ?>
					
					<tr>
                      <td width="93">&nbsp;</td>
                      <td width="262" align="right" nowrap="nowrap"><div align="left" class="gbold"><strong style="color:#000099;">Top Header  Adv :</strong></div></td>
                      <td width="9" class="content1">&nbsp;</td>
                      <td width="416" align="left" class="bluebold"><font face="Verdana" style="font-size:12px ">
                        						<textarea name="hori_three" cols="50" rows="10"><?php echo $details['body'];?></textarea>
                      </font></td>
                      <td width="80" align="left" class="content1">&nbsp;</td>
					</tr>
					
					<tr>
                      <td width="93">&nbsp;</td>
                      <td width="262" align="right" nowrap="nowrap"><div align="left" class="gbold"><strong style="color:#000099;">Top Header Status :</strong></div></td>
                      <td width="9" class="content1">&nbsp;</td>
                      <td width="416" align="left" class="bluebold"><font face="Verdana" style="font-size:12px ">
                       <input type="radio" name="hori_three_status" value="1" <?php if($details['status']==1) {?> checked="checked" <?php } ?>/> Enable
					   <input type="radio" name="hori_three_status" value="0" <?php if($details['status']==0) {?> checked="checked" <?php } ?>/> Disable
                      </font></td>
                      <td width="80" align="left" class="content1">&nbsp;</td>
					</tr>
					
					<tr>
                      <td colspan="5" align="left" ><?php #echo $details['vert_one'];?></td>
                    </tr>
					
					<tr>
                      <td height="27" colspan="5" align="center"><input type="submit" name="submit" value="Save" onclick="return validate();" class="but_bg" /></td>
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