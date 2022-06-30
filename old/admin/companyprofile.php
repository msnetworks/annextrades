<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
if(!isset($_SESSION['admin_user']))
{
	header("Location:index.php");
}
if(isset($_REQUEST['act']))
{
if($_REQUEST['act']=='active')
{
$idd=$_REQUEST['id'];

$sql=mysqli_query($con,"update companyprofile set approval_status='0' where id='$idd'");

}
}

if(isset($_REQUEST['act']))
{
if($_REQUEST['act']=='deactive')
{
$idd=$_REQUEST['id'];

$sql=mysqli_query($con,"update companyprofile set approval_status='1' where id='$idd'");

}
}
if(isset($_REQUEST['delid']))
{
$delid=$_REQUEST['delid'];

$del=mysqli_query($con,"delete from companyprofile where id='$delid'");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
	{
		
		return;
	}
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
	{
		objCheckBoxes.checked = CheckValue;
		
	}
	else
	{
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
		{
			objCheckBoxes[i].checked = CheckValue;
			}
	}
}

function checkbox()
{
var lengthcount=document.searchform.maxvalue.value;
 //alert(lengthcount);
var checkedcount=0;
   for(var i=0;i<lengthcount;i++)
    {
     var check_list="chk_list["+i+"]";
	 //alert(check_list);
     var ch=document.getElementById(check_list);
	 //alert(ch);
      if(ch.checked==true)
       {
	    checkedcount++;
	   }
	  
    }
	//alert(checkedcount);
    if(checkedcount < 1)
         {
	      alert("Select Atleast One Record")
	      return false;
	     }
		
     if(document.searchform.message.value=="")
           {
		   alert("Please Enter The Message");
		   document.searchform.message.focus();
	       return false;
	       }   
          
}
function confirmdel()
{

var result=checkbox();
   if(result == false)
     {
	 return false;
	 }
	 else
	 {
	 document.searchform.submit();
	 }
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.gbold
{
	font-family:tahoma,Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:bold;
	color:#7B7B7B;
}
-->
</style>
</head>
<body onload="document.searchform.keyword.focus();">
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Company Profile</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['deleted'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Company Profile</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td><form name="searchform" action="companyprofile.php" method="post">
						<table width="75%" align="center" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #99CCFF;">
						<tr class="normal"><td width="138" height="37">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keyword</td>
						<td width="3">:</td>
						<td width="280"><input type="text" name="keyword" /></td></tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style="font-size:12px">(Search in Companyname, Product Service and Bussiness type only)</span></td></tr>
						<tr class="normal"><td height="26" colspan="3" align="center">
						<input type="submit" name="submit" value="Search" /></td>
						</tr>
						<tr class="normal"><td height="26" colspan="3" align="center">
						<a href="companyexcl.php?key=<?php echo $keyword;?>" class="news"><span style="font-size:13px">Export Company Profile list in Excel Format</span></a></td>
						</tr>
				  </table>
					  </form></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align="center">
					<?php //include("buyingleadhead.php");?>
					<?php if(isset($_REQUEST['upd'])) { ?>
					<span style="color:#006600; font-weight:bold;">Updated successfully</span>
					<?php } ?>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td height="358" valign="top">
					<table width="100%" align="center" cellspacing="0" style="border:1px solid #99CCFF;">
						<tr bgcolor="#99CCFF">
			<td width="201" class="normalbold">&nbsp;User Mail-id</td>
			<td width="167" class="normalbold">&nbsp;Companyname</td>
			<td width="111" class="normalbold">&nbsp;Entry Date</td>
			<td width="229" class="normalbold" align="center">Actions</td>
				</tr>
<?php 
if(isset($_REQUEST['submit']))
{
$keyword=$_REQUEST['keyword'];
$str="";
if($keyword!="")
{
	if($str!="")
	{
	 $temp=" and ";
	}
$str.= $temp." companyname LIKE '%$keyword%' or bussiness_type Like '%$keyword%' or P_service Like '$keyword%' or company_address Like '$keyword'";
}
if($str!="")
{
$select="select * from `companyprofile` where $str";
}else{
$select="select * from `companyprofile`";
}
}
else
{
$select="select * from `companyprofile`";
}
			  $strget="submit=Submit&keyword=$keyword";
              $rowsPerPage =20;
              //$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
			  $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
              //$pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
			  $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			  $count=mysqli_num_rows($query);
			  
	                if($count > 0)
					{
					    $i=0;
						while($members=mysqli_fetch_array($query))
						{
							$memberid=$members['id'];
							$uid=$members['user_id'];
							$sql=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$uid'"));
						?>
						<tr>
		<!--<td align="center"><input type="checkbox" name="chk_list[]" value="<?php echo $members['id']; ?>" id="chk_list[<?php echo $i; ?>]"/></td>-->
					<td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;<?php echo $sql['email']; ?></td>
					<td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;<?php echo $members['companyname'];?></td>
					<td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;
						<?php 
							$mem_date_temp=explode("-",$members['add_date']);
							echo $mem_date=$mem_date_temp[2]."-".$mem_date_temp[1]."-".$mem_date_temp[0];
						?>
					</td>
					<td align="center">
						<a href="companyview.php?id=<?php echo $memberid;?>&idd=<?php echo $uid;?>" class="news"><img src="images/view4.png" style="width:20px; height:20px;" /></a>&nbsp;&nbsp;
						<a href="editcompany.php?id=<?php echo $memberid;?>&idd=<?php echo $uid;?>" class="news"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a>&nbsp;&nbsp;
						<a href="companyprofile.php?delid=<?php echo $memberid;?>" class="news" onclick="return confirm('Are you sure you wish to Delete this Record?');"><img src="../images1/delete.jpg" alt="Delete" title="Delete" border="0" /></a>&nbsp;&nbsp;
					<?php
					if($members['approval_status']=='1')
					{
					?>
					<a href="companyprofile.php?id=<?php echo $memberid;?>&act=active" class="bluebold" onclick="return confirm('Are you sure you wish to Active this Record?');"><img src="images/inact.png" /></a>
					<?php
					}else{
					?>
					<a href="companyprofile.php?id=<?php echo $memberid;?>&act=deactive" class="news" onclick="return confirm('Are you sure you wish to Deactive this Record?');"><img src="images/act.png" /></a>
					<?php
					}
					?>
					</td>
					
					<?php
					$i++;
						}
						?>
						<input name="maxvalue" type="hidden" value="<?php echo $i;?>" />
						<tr><td colspan="5" align="center"><?php echo $pagingLink;?></td></tr>
						<tr><td colspan="5" align="center" height="40"><a href="companyexcl.php?key=<?php echo $keyword;?>" class="news">Export Company Profile list in Excel Format</a></td></tr>
						<?php 
						}
						else
						{
						?>
				<tr><td colspan="5" align="center"><span class="style1">No Records Found</span></td>
				</tr>
					<?php
					 }
					 ?>
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