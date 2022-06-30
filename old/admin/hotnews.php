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
		$title=$_REQUEST['txtnwstitle'];
		$sub=addslashes($_REQUEST['message']);

		$filename2=basename($_FILES['fleimage']['name']);
		$tmpfilename2=$_FILES['fleimage']['tmp_name'];		
	
		list($width,$height)=getimagesize($_FILES['fleimage']['tmp_name']);
		$uploadpath12="newsimages/".$filename2;
		move_uploaded_file($tmpfilename2,$uploadpath12); 	
		mysqli_query($con,"INSERT INTO `news` (`nwssub`,`nwsmsg`,`nwsdt`,`nwsimg1`,`nwsstatus`) VALUES ('$title','$sub',NOW(),'$uploadpath12',0)");
	}
?>
<?php
if(isset($_REQUEST['delid']))
{
	$delid=$_REQUEST['delid'];
	mysqli_query($con,"delete from `news` where `nwsid`='$delid'");
	header("location:hotnews.php?msgdel=1");
}


if(isset($_REQUEST['update']))
{
	$title=$_REQUEST['txtnwstitle'];
	$sub=$_REQUEST['message'];
	$artid=$_REQUEST['hidart'];
		$filename2=basename($_FILES['fleimage']['name']);
		
		if($filename2=="")
		{
		mysqli_query($con,"UPDATE `news`  SET `nwssub`='$title',`nwsmsg`='$sub',`nwsdt`=NOW(),`nwsstatus`=0 WHERE `nwsid`='$artid'     ");
		}
		else
		{
		$tmpfilename2=$_FILES['fleimage']['tmp_name'];		
	
		list($width,$height)=getimagesize($_FILES['fleimage']['tmp_name']);
		$uploadpath12="newsimages/".$filename2;
		move_uploaded_file($tmpfilename2,$uploadpath12); 	
		mysqli_query($con,"UPDATE `news`  SET `nwssub`='$title',`nwsmsg`='$sub',`nwsdt`=NOW(),`nwsimg1`='$uploadpath12',`nwsstatus`=0 WHERE `nwsid`='$artid' ");
		}
		header("location:hotnews.php?editmsg=1");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" language="javascript">
function addconfirmdel()
{
	if(document.searchform.txtnwstitle.value=="")
	{
	alert("please enter the title for the news");
	document.searchform.txtnwstitle.focus();
	return false
	}
	
	if(document.searchform.fleimage.value!="")
	{
		var str = document.searchform.fleimage.value.substring(document.searchform.fleimage.value.indexOf('.'));
		if(str=='.jpg'||str=='.gif' || str=='.jpeg'){
		
		}else{
		alert("Upload only jpg, jpeg and gif");
		document.searchform.fleimage.value="";
		document.searchform.fleimage.focus();
		return false;
		}
	}
	
	else {
	alert("please select an image to be uploaded");
	document.searchform.fleimage.focus()
	return false
	}
	
	 document.getElementById('10').value = document.getElementById("wysiwyg10").contentWindow.document.body.innerHTML;
	if(document.getElementById('10').value.replace("<br>","NULL")=="NULL")
	{
		alert("Please enter Message ");
		return false;
	}
	
}
function updconfirmdel()
{

	if(document.searchform.txtnwstitle.value=="")
	{
	alert("please enter the title for the news");
	document.searchform.txtnwstitle.focus();
	return false
	}
	 document.getElementById('10').value = document.getElementById("wysiwyg10").contentWindow.document.body.innerHTML;
	if(document.getElementById('10').value.replace("<br>","NULL")=="NULL")
	{
		alert("Please enter Message ");
		return false;
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Hot News</b></a></article>
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
		<header><h3 class="tabs_involved">Hot News</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="searchform" action="" method="post" enctype="multipart/form-data">
			<table width="98%" align="center" cellspacing="0">
			<tr><td height="129">
					
					<table width="437" align="center">
						<tr class="normal"><td width="138" height="37">Keyword</td>
						<td width="3">:</td>
						<td width="280"><input type="text" name="keyword" /></td></tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style="font-size:12px">(Search in title and subject only)</span></td></tr>
						<tr class="normal"><td height="26" colspan="3" align="center">
						<input type="submit" name="submit" value="Search" /></td>
						</tr>
				  </table>
				</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td valign="top">
				
			<table width="732" height="79" align="center" cellspacing="2" cellpadding="2" style="border:1px solid #99CCFF;">
					<?php
					if(isset($_REQUEST['msgdel']))
					{
					?>
						<tr>
							<td colspan="5" align="center" valign="middle" class="redbold">News Deleted Successfully</td>
							</tr>
					<?php		
					}	
					?>
					
					
					<?php
					if(isset($_REQUEST['editmsg']))
					{
					?>
						<tr>
							<td colspan="5" align="center" valign="middle" class="redbold">News Edited Successfully</td>
							</tr>
					<?php		
					}	
					?>
			<tr bgcolor="#99CCFF">
			<td width="37" height="29" style="color:#FFFFFF;"><strong>&nbsp;S.No</strong></td>
			<td width="187" class="normalbold" align="center" style="color:#FFFFFF;">News Title </td>
			<td width="349" class="normalbold" align="center" style="color:#FFFFFF;">&nbsp;News Subject </td>
			<td width="63" class="normalbold" align="center" style="color:#FFFFFF;">&nbsp;Edit</td>
				<td width="62" class="normalbold" align="center" style="color:#FFFFFF;">Delete</td>
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
$str.= $temp." `nwssub`  LIKE '%$keyword%' or `nwsmsg`  Like '%$keyword%' ";
}
if($str!="")
{
//echo "select * from registration where $str";

$select="select * from `news` where $str order by nwsid desc";

}else{

$select="select * from `news` order by nwsid desc";

}
//$_SESSION['sql']=$select;				
}
else
{
$select="select * from `news` order by nwsid desc";
}

	 //$select=$_SESSION['sql'];
	 
	 		$strget="submit=Submit&keyword=$keyword";
              $rowsPerPage =5;
              $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
              $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			  
			  $count=mysqli_num_rows($query);
	                      
	                if($count > 0)
					{
						if(!isset($_REQUEST['page']))
						{
					    $i=1;
						}
						else
						{
						$pgno=$_REQUEST['page'];
						$i=($pgno-1)*$rowsPerPage+1;
						
						}
						while($members=mysqli_fetch_array($query))
						{
							$memberid=$members['nwsid'];
							
						?>
					
						<tr>
		<td align="center"><?php echo $i;?></td>
					<td>&nbsp;<?php echo $members['nwssub']; ?></td><td>&nbsp;<?php echo substr($members['nwsmsg'],0,200);?>..</td><td><a href="hotnews.php?editid=<?PHP echo $memberid;?>"><img src="images/images.jpg" style="width:17px; height:17px;" /></a><!--<img src="../images/edit_f2.png" border="0"/>--></td>
					
					<td><a href="hotnews.php?delid=<?PHP echo $memberid;?>" onclick="return confirm('Are you sure you wish to Delete this Record?');">
                                  <img  src="../images1/delete.jpg" name="imageField2" border="0"/>
                                </a><!-- <input type="image" name="imageField2" src="../images/delete.jpg" />--></td>
					<?php
					$i++;
						}
						?>
						<input name="maxvalue" type="hidden" value="<?php echo $i;?>" />
						<tr><td colspan="6" align="center"><?php echo $pagingLink;?></td></tr>
						<?php 
						}
						else
						{
						?>
				<tr>
				  <td colspan="6" align="center"><span class="redbold">No News Found</span></td>
				</tr>
					<?php
					 }
					 ?>
				  </table>
				</td></tr>
			 <tr><td colspan="2">&nbsp;</td></tr>
			
				<tr><td height="27" colspan="5" bgcolor="#99CCFF" class="adminheading">&nbsp;&nbsp;Add Hot News</td>
				</tr>
				
				
				
				<tr>
				<td valign="top">
				
			<table width="732" height="79" align="center" cellspacing="2" cellpadding="2" >
			 <?php
			 if(isset($_REQUEST['editid']))
			 {
			 $editid=$_REQUEST['editid'];
			 $select_news=mysqli_query($con,"select * from `news` where `nwsid`='$editid'");
			 $fetch_news=mysqli_fetch_array($select_news);
			 }
			 ?>
			 <tr><td colspan="2">&nbsp;</td></tr>
			  <tr>
					<td align="left" valign="middle"> <span class="redbold">* </span>News Title</td>
		            <td align="left" valign="middle"><input name="txtnwstitle" type="text"  <?php  if(isset($_REQUEST['editid'])) { ?> value="<?php echo $fetch_news['nwssub'];?>" <?php } ?>/></td>
			  </tr>	
			

					
						
				<tr><td colspan="2">&nbsp;</td></tr>
				 <tr>
					<td align="left" valign="middle"> <span class="redbold">*</span> News Image</td>
		            <td align="left" valign="middle">
					<?php  if(isset($_REQUEST['editid'])) { ?>
						<?php
						$imgpath=$fetch_news['nwsimg1'];
						if(file_exists($imgpath) && $fetch_news['nwsimg1']!='')
						{
						?>
						<img src="<?php echo $imgpath ; ?>" border="0" width="98" height="86" style="margin:5px;" />
						<?php 
						}
						 else
						{
						?>
						<img src="../blog_photo_thumbnail/img_noimg.jpg" width="98" height="86" style="margin:5px;" />
						<?php
						}?><br />
						<?php } ?>
					<input name="fleimage" type="file" /></td>
			  </tr>	
			  	<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td align="left" valign="middle"><span class="redbold">*</span> Message</td>
					<td align="left" valign="middle">&nbsp;</td>
				</tr><input type="hidden" name="hidart" value="<?php echo $_REQUEST['editid'];?>" />
				<tr><td colspan="2">&nbsp;</td></tr>
				
				
				<tr><td colspan="2" align="left">&nbsp;&nbsp;
				<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script> 
				 <textarea name="message" rows="10" cols="50" ID="10"  ><?php  if(isset($_REQUEST['editid'])) { ?> <?php echo $fetch_news['nwsmsg'];?> <?php } ?></textarea>
				 <script language="JavaScript">
    		generate_wysiwyg('10');
        </script></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
				<td colspan="2" align="center"><?php  if(isset($_REQUEST['editid'])) { ?> <input type="submit" name="update" value="Update" onclick="javascript:return updconfirmdel();"  /> <?php } else {?>
				<input type="submit" name="send" value="Submit" onclick="javascript:return addconfirmdel();"/> <?php } ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
		  </table>
		  		</td>
				</tr>
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

<?php

function createThumbnail($srcFile, $destFile, $width , $quality = 75)
{
	$thumbnail = '';
	//echo $descFile;
	if (file_exists($srcFile)  && isset($destFile))
	{
		$size        = getimagesize($srcFile);
		
		$w           = number_format($width, 0, ',', '');
		$h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
		if($h>250) $h=250;
		if($w>250) $w=250;
		
		$thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
	}
	
	// return the thumbnail file name on sucess or blank on fail
	return basename($thumbnail);
}


function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg")
    {
      // $destFile  = substr_replace($destFile, 'jpg', -3);
	
	  // $w           = number_format($width, 0, ',', '');
		//$h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
	
	   
       $dest      =imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == "png") {
       $dest = imagecreatetruecolor($w, $h);
	 
       imageantialias($dest, TRUE);
    } 
	else {
      return false;
    }
	//echo $size[2];
    switch($size[2])
    {
       case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);
	
    switch($size[2])
    {
       case 1:
	   		imagegif($dest,$destFile);
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
		  
    }
    return $destFile;

}


?>