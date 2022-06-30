<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$uid=$_REQUEST['uid'];
	//echo "select * from  registration where id='$uid'";
	$sql=(mysqli_query($con,"select * from  registration where id='$uid'"));
	$count=mysqli_num_rows($sql);
	$row=mysqli_fetch_array($sql);
	$rid=$row['id'];
	$fname=$row['firstname'];
	if(isset($_REQUEST['Submit_edit']))
	{
	
	$uidd=$_REQUEST['uid'];
   $Firstname=$_REQUEST['firstname'];
   $Lastname=$_REQUEST['lastname'];
   $Gender=$_REQUEST['gender'];
   $Street=$_REQUEST['street'];
   $City=$_REQUEST['city']; 
   $State=$_REQUEST['state1']; 
   $Zipcode=$_REQUEST['zipcode'];
   $Countrycode=$_REQUEST['countrycode'];
   $Areacode=$_REQUEST['areacode'];
   $Phonenumber=$_REQUEST['phoneno'];
   $Faxnumber=$_REQUEST['faxno'];
   $MobileNo=$_REQUEST['mobile'];
   $Companyname=$_REQUEST['companyname'];
   $Department=$_REQUEST['department'];
   $Jobtitle=$_REQUEST['jobtitle']; 
  
  
//  echo "update  registration  set  firstname='$Firstname',lastname='$Lastname',gender='$Gender',street='$Street',city='$City',state='$State',zipcode='$Zipcode',countrycode='$Countrycode',areacode='$Areacode',phonenumber='$Phonenumber',faxnumber='$Faxnumber',mobile='$MobileNo', companyname='$Companyname',department='$Department',jobtitle='$Jobtitle' where `id`= ' $uid'"; 
  
  $insertsql = "update  registration  set  firstname='$Firstname',lastname='$Lastname',gender='$Gender',street='$Street',city='$City',state='$State',zipcode='$Zipcode',countrycode='$Countrycode',areacode='$Areacode',phonenumber='$Phonenumber',faxnumber='$Faxnumber',mobile='$MobileNo', companyname='$Companyname',department='$Department',jobtitle='$Jobtitle' where `id`= '$uid'";  
   $query =mysqli_query($con,$insertsql);
   header("location:profileview.php?uid=$uid&edited");
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="../ajaxfun.js"></script>
<script>
function chkvali()
{
	if(document.editmember.country.value=="")
	{
	alert("Please Select the Country");
	document.editmember.country.focus()
	return false
	}
	if(document.editmember.firstname.value=="")
	{
	alert("Please Enter Your Firstname");
	document.editmember.firstname.focus()
	return false
	}
	if(document.editmember.lastname.value=="")
	{
	alert("Please Enter Your Lastname");
	document.editmember.lastname.focus()
	return false
	}
	if(document.editmember.street.value=="")
	{
	alert("Please Enter Your Street Address");
	document.editmember.street.focus()
	return false
	}
	if(document.editmember.city.value=="")
	{
	alert("Please Enter Your City ");
	document.editmember.city.focus()
	return false
	}
	if(document.editmember.zipcode.value=="")
	{
	alert("Please Enter The ZipCode ");
	document.editmember.zipcode.focus()
	return false
	}
	if(isNaN(document.editmember.zipcode.value))
	{
	alert("Please Enter The ZipCode In Numeric Form  ");
	document.editmember.zipcode.focus()
	return false
	}
		if((document.editmember.countrycode.value=="")&& (document.editmember.mobile.value==""))
	{
	alert("Please Enter The Countrycode ");
	document.editmember.countrycode.focus()
	return false
	}
	if(isNaN(document.editmember.countrycode.value))
	{
	alert("Please Enter The Countrycode In Numeric Form  ");
	document.editmember.countrycode.focus()
	return false
	}
		if((document.editmember.areacode.value=="")&& (document.editmember.mobile.value==""))
	{
	alert("Please Enter The Areacode ");
	document.editmember.areacode.focus()
	return false
	}
	if(isNaN(document.editmember.areacode.value))
	{
	alert("Please Enter The Areacode In Numeric Form  ");
	document.editmember.areacode.focus()
	return false
	}
		if((document.editmember.phoneno.value=="")&& (document.editmember.mobile.value==""))
	{
	alert("Please Enter The Phoneno ");
	document.editmember.phoneno.focus()
	return false
	}
	if(isNaN(document.editmember.phoneno.value))
	{
	alert("Please Enter The Phoneno In Numeric Form  ");
	document.editmember.phoneno.focus()
	return false
	}
	
	if(isNaN(document.editmember.mobile.value))
	{
	alert("Please Enter The Mobile In Numeric Form  ");
	document.editmember.mobile.focus()
	return false
	}
	
	if((document.editmember.faxno.value=="") ||(document.editmember.faxno.value==0) )
	{
	alert("Please Enter The Faxno ");
	document.editmember.faxno.focus()
	return false
	}
	if(isNaN(document.editmember.faxno.value))
	{
	alert("Please Enter The Faxno In Numeric Form  ");
	document.editmember.faxno.focus()
	return false
	}
	
	if((document.editmember.companyname.value==""))
	{
	alert("Please Enter The CompanyName ");
	document.editmember.companyname.focus()
	return false
	}

}
</script>
</head>
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="membermanagement.php"><b>Members Management</b></a></article>
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
		<header><h3 class="tabs_involved">Members Management</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td height="358" valign="top">
					<table width="732" height="157" align="center" cellspacing="0">
						<tr class="normalbold"><td height="32" style="padding-left:17px;"><?php echo $fname;?>'s Edit Account Details</td>
					  </tr>
						<tr class="smallfont">
						<td colspan="5">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td ><form  name="editmember" method="post" action="" onsubmit="return ValidateForm()" >
<table width="100%" border="0" cellpadding="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>
<td><table width="100%" border="0" cellpadding="0" cellspacing="3">
<tr>
<?php    
 $cou = $row['country'];
 $sql_rr=mysqli_query($con,"select * from `country` where  country_id='$cou'");   		
 $row_rr = mysqli_fetch_array($sql_rr); 
 $country=$row_rr['country_name'];
?>
<td width="3%">&nbsp;</td>
<td align="left" class=""> <span style="color:#FF0000">* </span><span style="font-size:12"><strong>Country</strong></span></td>
<td align="center" class="">:</td>
<td class="">
<select name="country" onChange="Javascript:categorylist(this.value);" style="width:147px;">
                          <option value="">Select</option>
                   <?php  $sta=mysqli_query($con,"select * from country");
		  while($con2=mysqli_fetch_array($sta)) {
		  $ssid=$con2['country_id'];
		  ?>
                          <option value="<?php echo $con2['country_id'];?>"<?PHP if($country==$con2['country_name']) {?> selected="selected"<?PHP }?>><?php echo $con2['country_name'];?></option>
                          <?php } ?>
                        </select></td>
						<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td width="19%" align="left" class=""><span style="font-size:12"><strong>&nbsp;&nbsp;&nbsp;State</strong></span></td>
<td width="6%" align="center" class="blackBo">:</td>
<td width="42%" class="inTxtNormal"><div id="statenew">
					  <?php /*?><!--<?php
					  $state=$row['state'];
					  //echo "SELECT * FROM `state` WHERE `countryid` = '$countryid'";
					  $sql = "SELECT * FROM `state` WHERE `cou_id` = '$cou'";
$query = mysqli_query($con,$sql);
?>
<select name="state1" style=\"width:180px\" onChange="Javascript:citylist(this.value);">
<option value=''>Select State</option>
<?PHP
while($sub = mysqli_fetch_array($query))
{
?>
 <option value="<?PHP echo $sub['state_name'];?>" <?PHP if($state==$sub['state_name']) {?> selected="selected"<?PHP }?>><?PHP echo $sub['state_name']; ?></option>
<?PHP 
}?>
</select>--><?php */?>

<input name="state1" type="text" class="textBox" id="state1" value="<?php echo $row['state'];?>" />
		  </div></td>
		  <td>&nbsp;</td>
</tr>

<tr>
<td>&nbsp;</td>
<td width="19%" align="left" class=""><span style="color:#FF0000">* </span><span style="font-size:12"><strong> Bussiness Email</strong></span> </td>
<td width="6%" align="center" class="blackBo">:</td>
<td width="42%" class=""><span style="font-size:12"><?php echo $row['email'];?></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td width="19%" align="left" class=""><span style="color:#FF0000">* </span><span style="font-size:12"><strong>First Name </strong></span></td>
<td width="6%" align="center" class="blackBo">:</td>
<td colspan="2" class="bluebold"><input name="firstname" type="text" class="textBox" id="firstname" value="<?php echo $row['firstname'];?>" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class="" ><span style="color:#FF0000">* </span><span style="font-size:12"><strong>Last Name</strong></span></td>
<td align="center" class="blackBo" >:</td>
<td colspan="2" class="bluebold"><input name="lastname" type="text" class="textBox" id="lastname"  value="<?php echo $row['lastname'];?>"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class=""><span style="color:#FF0000">* </span><span style="font-size:12"><strong>Gender</strong></span></td>
<td align="center" class="blackBo">:</td>
<td colspan="2" class="" >
<input name="gender" type="radio" value="Male" <?php if($row['gender']==Male){?> checked="checked" <?php }?> />
<span style="font-size:12">Male</span>
<input name="gender" type="radio" value="Female"  <?php if($row['gender']==Female){?> checked="checked" <?php }?>/>
<span style="font-size:12">Female</span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class=""><span style="color:#FF0000">* </span><span style="font-size:12"><strong>Contact Address</strong></span> </td>
<td align="center" class="blackBo">:</td>
<td class=""><span style="font-size:12">Street Address </span><br/>  <input name="street" type="text" class="textBox" id="street" value="<?php echo $row['street'];?>" /></td>
<td class=""><span style="font-size:12">City </span><br/>  <input name="city" type="text" class="textBox" id="city" value="<?php echo $row['city'];?>" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class="blackBo">&nbsp;</td>
<td align="center" class="blackBo">&nbsp;</td>
<td width="42%" class=""><span style="font-size:12">Zip Code </span><br/>   
  <input name="zipcode" type="text" class="textBox" id="zipcode" value="<?php echo $row['zipcode'];?>" /></td>
<td width="30%" class="inTxtNormal">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class=""><span style="color:#FF0000">* </span><span style="font-size:12"><strong>Phone Number</strong></span></td>
<td align="center" class="blackBo">:</td>
<td class=""><span style="font-size:12">Country Code </span><span style="font-size:12">&nbsp;&nbsp;&nbsp;&nbsp;Area Code</span><br/>   
  <input name="countrycode" type="text" class="textBoxx" id="countrycode" value="<?php echo $row['countrycode'];?>" size="5"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="areacode" type="text" id="areacode" class="textBoxx"  value="<?php echo $row['areacode'];?>" size="5"/></td>
<td class=""><span style="font-size:12">Number </span><br/>   
  <input name="phoneno" type="text" class="textBox" id="phoneno"  value="<?php echo $row['phonenumber'];?>"/></td>
</tr>

<tr>
<td>&nbsp;</td>
<td align="left" class="blackBo">&nbsp;</td>
<td align="center" class="blackBo">&nbsp;</td><td class=""><span style="font-size:12">Mobile</span>  <br/>   
  <input name="mobile" type="text" class="textBox" id="mobile"  value="<?php echo $row['mobile'];?>"/></td>
<td class="inTxtNormal"></td>

</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class=""><span style="color:#FF0000">* </span><span style="font-size:12"><strong>Fax Number</strong></span></td>
<td align="center" class="blackBo">:</td>
<td colspan="2" class="inTxtSmall"><input name="faxno" type="text" class="textBox" id="faxno"  value="<?php echo $row['faxnumber'];?>"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" class=""><span style="font-size:12"><span style="color:#FF0000">* </span><strong>Company name</strong></td>
<td align="center" class="blackBo">:</td>
<td colspan="2" class="inTxtSmall"><input name="companyname" type="text" class="textBox" id="companyname"  value="<?php echo $row['companyname'];?>"/>
<span style="font-size:12">eg.. ABC Limited </span></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td align="center"><input type="hidden" name="date" value="<?php echo $today =date("Y-m-d h:m:s"); ?>" />
<!--<input name="Submit_edit" type="submit" value="Submit" onclick="return chkvali();" />&nbsp;&nbsp;-->
<input name="Submit_edit" type="submit" value="Submit"  />&nbsp;&nbsp;
<input type="button" name="Submit" value="Cancel" onclick="javascript:history.back();"/></td>
</tr>
</table>
</form></td>
</tr>
</table>
						 </td>
						</tr>
						<tr><td></td></tr>
				  </table>
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