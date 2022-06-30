<?php 
ob_start();
//session_start();
error_reporting(1);
include("../db-connect/notfound.php");
include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	//mysqli_query($con,"ALTER TABLE `generalsettings` ADD `weburl` VARCHAR(100)");exit;
	$result=mysqli_query($con,"select * from generalsettings");
	$details=mysqli_fetch_array($result);
	
	$result1=mysqli_query($con,"select * from `paypalsettings`");
	$det=mysqli_fetch_array($result1);
	$id=$details1['pay_id'];
	
	$img=$details['logo'];

	if($img=="")
	{
		$imgpath = "../images/$img";	
	}
	 else 
	 {
		if(file_exists("../images/".$img))
		{
			$imgpath = "../images/".$img;
		}
		else{
			$imgpath = "../images/logo.jpg";	
		}
	 }
	$id=$details['id'];
	$count=mysqli_num_rows($result);
	
	if(isset($_REQUEST['submit']))
	{
	
	/*$result=mysqli_query($con,"select * from `paypalsettings`");
	$det=mysqli_fetch_array($result);
	$id=$details1['pay_id'];*/
	
	$paypalsettings=$_REQUEST['paypalsettings'];
	
		$webname=$_REQUEST['webname'];
		$webkeyword=$_REQUEST['webkeyword'];
		$webdes=$_REQUEST['webdes'];
		$admin_mailid=$_REQUEST['admin_mailid'];
		$weburl=$_REQUEST['admin_mailid2'];
		
		$prdimage=$_FILES['caimg']['name'];

		if($prdimage!=""){
			
		$ptemp=$_FILES['caimg']['tmp_name'];
		
		//list($width,$height)=getimagesize($_FILES['caimg']['tmp_name']);
		$mpath="../images/".$prdimage;
		//$uploadpath_thumb="../prodimages_thumbnail/".$prdimage;
		move_uploaded_file($ptemp,$mpath);
	//	$img_up=createThumbnail($mpath,$uploadpath_thumb,$width,100);
		
		}
		else{
		
			$prdimage = $_REQUEST['imgval'];
		}
		
		
			$result=mysqli_query($con,"select * from generalsettings");
			$count=mysqli_num_rows($result);
			
		if($count>0)
		{


				mysqli_query($con,"update `generalsettings` set `webname`='$webname', `webkeyword`='$webkeyword', `webdes`='$webdes',`logo`='$prdimage',`admin_mailid`='$admin_mailid',`weburl`='$weburl' where `id`=$id") ;
				//echo "update `paypalsettings` set `paypalsettings`='$paypalsettings' where `pay_id`='$id'";exit;
				mysqli_query($con,"update `paypalsettings` set `paypalsettings`='$paypalsettings' where `pay_id`='$id'");

			header("location:general_settings.php?msg=upd");exit;
		
		}
		else
		{		
			
			mysqli_query($con,"insert into `generalsettings`(`webname`, `webkeyword`, `webdes`,`logo`,`admin_mailid`,`weburl`) values('$webname', '$webkeyword', '$webdes','$prdimage','$admin_mailid','$weburl')");

			header("location:general_settings.php?msg=ins");exit;
			
		}
	}
	
	if(isset($_REQUEST['msg']))
	{
		echo "<meta http-equiv='refresh' content='3;URL=general_settings.php'>"; 
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>iuiui</title>
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

function validatesettings()
{
	var freepost=document.settings.freepost.value;
	if(trimAll(freepost)=="")
	{
		alert("Enter Free Post count");
		document.settings.freepost.value='';
		document.settings.freepost.focus();
		return false;
	}
}
</script>

<script type="text/javascript">
function validate()
{
if(trim1(document.settings.webname.value)=="")
{
alert("Please Enter the Website Name");
document.settings.webname.focus();
return false;
}
if(document.settings.webkeyword.value=="")
{
alert("Please Enter the Website Keyword");
document.settings.webkeyword.focus();
return false;
}
if(document.settings.webdes.value=="")
{
alert("Please Enter the Website Description");
document.settings.webdes.focus();
return false;
}
if(trim1(document.settings.admin_mailid.value)=="")
{
	alert("Please Enter Admin MailId");
	document.settings.admin_mailid.focus()
	return false
}
if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.settings.admin_mailid.value)))
{
	alert("Please Enter A Valid Admin Mail Id");
	document.settings.admin_mailid.focus()
	return false
	
}

if(trim1(document.settings.admin_mailid2.value)=="")
{
	alert("Please Enter Website Url");
	document.settings.admin_mailid2.focus()
	return false
}
 
if(document.settings.caimg.value == "" && document.settings.imgval.value=="")
{
alert("please enter Category Image");
document.settings.caimg.focus();
return false;
}


if(document.settings.caimg.value != "")
{
var splt=(document.settings.caimg.value).split('.');
var chksplt=splt[1].toLowerCase();
					
if(chksplt=='jpg' || chksplt=='jpeg' || chksplt=='gif')
{
}
else
{
alert(" Upload only jpg, jpeg, gif");
return false;
}
}
}
function trim1(str)
{
                
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}
</script>

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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">General Settings</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
		<div style="float:left; text-align:left;">
	<div class="" style="width:700px;">
				
			<?php if(isset($_REQUEST['msg'])){$msg=$_REQUEST['msg'] ?>
		<h4 class="alert_success1" style="padding-left:300px; color:#FF0000;"><?php if($msg=="upd"){?>Updated Successfully!<?php }else{?>Added Successfully<?php }?></h4>
				<?php } ?>
				
				<div class="module width_3_quarter" style="width:100%;">
		<header><h3 class="tabs_involved"> General Settings  </h3>
		
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="settings" action="" method="post"   enctype="multipart/form-data" >
					<div class="de_lft" style="height:35px;">Website Name </div><div class="de_lft" style="width:400px;"> 
			<input type="text" name="webname" value="<?php echo $details['webname'];?>" style="width:260px;"/>
					
					</div>
					<div style="clear:both;"></div>
					<div class="de_lft" style="height:100px;">Website Keywords </div><div class="de_lft" style="width:300px;">
					
			<textarea cols="30" rows="4" name="webkeyword"><?php echo $details['webkeyword'];?></textarea>
					
					</div>
					<div style="clear:both;"></div>
						<div class="de_lft" style="height:100px;">Website Description </div><div class="de_lft" style="width:300px;">
			<textarea cols="30" rows="4" name="webdes"><?php echo $details['webdes'];?></textarea>
					</div>
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:35px;">Admin Mailid</div><div class="de_lft" style="width:400px;"> 
					
			<input type="text" name="admin_mailid" value="<?php echo $details['admin_mailid'];?>"  style="width:260px;"/>
					
					
					</div>
					<div style="clear:both;"></div>
					<div class="de_lft" style="height:35px;">Website URL</div><div class="de_lft" style="width:400px;"> 
					<input type="text" name="admin_mailid2" value="<?php echo $details['weburl'];?>"  style="width:260px;"/>
					</div>
					<div style="clear:both;"></div>
					
			
					<div class="de_lft" style="height:80px;">Existing Site Logo</div><div class="de_lft" style="width:400px;"> 
					 <img src="<?php echo $imgpath ;?>" border="0" width="73" height="73" />
					</div>
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:45px;">Site Logo</div><div class="de_lft" style="width:400px;"> 
					 <input type="file" name="caimg" id="caimg"/>
					 <input name="imgval" type="hidden" value="<?php echo $details['logo']; ?>" />
					</div>
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:35px;">Paypal Id</div><div class="de_lft" style="width:400px;"> 
					<input type="text" name="paypalsettings" value="<?php echo $det['paypalsettings'];?>" style="width:260px;"/>
					</div>
					<div style="clear:both;"></div>
					
			<div class="de_lft" style="height:35px;"></div><div class="de_lft">
			&nbsp;
			<input type="submit" name="submit"   value="Save" onclick="return validate();" />
					</div>
		</form>
			</div>
		</div>
		
		</div>
		  </div>
		</div>
		<div class="de_lft">&nbsp;</div>
</body>
</html>