<?php 
//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	include "includes/pagination.php";
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if(isset($_REQUEST['send']))
{
$chk_list=$_REQUEST['chk_list'];
foreach ($chk_list as $check)
{
$check;

//echo "select * from feedback where id='$check'";

$res=mysqli_fetch_array(mysqli_query($con,"select * from feedback where id='$check'"));

$to=$res['email'];
$messages=$_REQUEST['message'];

$from=$mailurl;

$subject="Admin News Letter";
$message=

"<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid #FE7903;\">
  <tr bgcolor=\"#FFEAC2\">
    <td colspan=\"2\"><div style=\"font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#ff7300; text-align:left; padding-bottom:10px; line-height:26px;text-align:center;\">
You're an $webname Member!<br>
</div></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Dear Members,</span></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">&nbsp;&nbsp;Detail Newsletter</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $messages</span></td>
  </tr>
  
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<a href=\"$signin\">Sign in now!</a></td>
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
    
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Wishing you the very best of business,</span></td>
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">$webname Service Team</span></td>
  </tr>
</table>";


$headers .= 'From:'.$from."\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";

mail($to,$subject,$message,$headers);
}
header("location:successfeedback.php");
}
 
if(isset($_REQUEST['delid']))
{
$delid=$_REQUEST['delid'];

$del=mysqli_query($con,"delete from feedback where id='$delid'");

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
document.getElementById('10').value = document.getElementById("wysiwyg10").contentWindow.document.body.innerHTML;
if(document.getElementById('10').value.replace("<br>","NULL")=="NULL")
	{
		alert("Please enter Message ");
		return false;
	}
    /* if(document.searchform.message.value=="")
     {
		   alert("Please Enter The Message");
		   updateTextArea('10')
		   document.searchform.htxtmessage.value=document.getElementById('10').value;
		   alert(document.searchform.htxtmessage.value);
		   document.searchform.message.focus();
	       return false;
	  }   */
          
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
<script type="text/javascript">

function popUp1(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300,left = 150,top = 234');");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Feedback</b></a></article>
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
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Feedback</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="searchform" action="" method="post">
			<table width="98%" align="center" cellspacing="0">
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td valign="top">
				
			<table width="98%" height="79" align="center" cellspacing="2" cellpadding="2" style="border:1px solid #99CCFF;">
						
			<tr bgcolor="#99CCFF">
			<td width="70" height="29">&nbsp;<a href="#" onclick="javascript:SetAllCheckBoxes('searchform','chk_list[]',true)" class="gboldli" style="color: black;">Select All</a> / &nbsp;<a href="#" onclick="javascript:SetAllCheckBoxes('searchform', 'chk_list[]', false)" class="gboldli" style="color: black;">Clear All</a></td>
			<td width="156" class="normalbold">&nbsp;User Mail-id</td>
			<td width="153" class="normalbold">&nbsp;Subject</td>
			<td width="82" class="normalbold">&nbsp;Entry date</td>
			<td width="141" class="normalbold" align="center">Reply | View | Delete</td>
				</tr>
<?php 

$select="SELECT * FROM `feedback` ORDER BY `id` DESC";

	 //$select=$_SESSION['sql'];
	 
	 			$strget="";
              $rowsPerPage =10;
              $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
              $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			  
			  $count=mysqli_num_rows($query);
	                      
	                if($count > 0)
					{
					    $i=0;
						while($members=mysqli_fetch_array($query))
						{
							$memberid=$members['id'];
							
						?>
					
						<tr>
		<td align="center">
		<input type="checkbox" name="chk_list[]" value="<?php echo $members['id']; ?>" id="chk_list[<?php echo $i; ?>]"/></td>
					<td>&nbsp;
						<a href="feedbackreplys.php?id=<?php echo $memberid;?>" class="news" style="text-decoration:none; color:#000099;"><b><?php echo $members['email']; ?></b></a>
					</td>
					<td class="gbold">&nbsp;<?php echo substr($members['subject'],0,30)."...";?></td>
					<td class="gbold">&nbsp;
						<?php 
							$dt_tmp=explode("-",$members['entrydate']);
							echo $mem_date=$dt_tmp[2]."-".$dt_tmp[1]."-".$dt_tmp[0];
						?>
					</td>
					<td align="center">
						<a href="feedbackreplys.php?id=<?php echo $memberid;?>" class="news" style="text-decoration:none; color:#000099;"><b>Reply</b></a> | 
						<a href="feedbackview.php?id=<?php echo $memberid;?>" class="news" style="color:#000099;"><b>View</b></a> | 
						<a href="feedback.php?delid=<?php echo $memberid;?>" class="news" style="color:#000099;" onclick="return confirm('Are you sure you wish to delete this Record?');"><b>Delete</b></a>
					</td>
					
					<?php
					$i++;
						}
						?>
						<input name="maxvalue" type="hidden" value="<?php echo $i;?>" />
						<tr><td colspan="5" align="center"><?php echo $pagingLink;?></td></tr>
						<?php 
						}
						else
						{
						?>
				<tr><td colspan="5" align="center"><span class="style1">No Members Found</span></td>
				</tr>
					<?php
					 }
					 ?>
				  </table>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align="center">Message&nbsp;&nbsp;
			<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script> 
			<input type="hidden" name="htxtmessage" /> 
				 <textarea name="message" rows="10" cols="50" ID="10" ></textarea> 
				<script language="JavaScript">
    		generate_wysiwyg('10');
        </script></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td align="center">
				<input type="submit" name="send" value="Submit" onclick="javascript:return confirmdel();"/></td></tr>
				<tr><td>&nbsp;</td></tr>
		  </table>
		  </form>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>

