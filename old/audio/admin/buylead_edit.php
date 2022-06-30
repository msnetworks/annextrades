<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	include("../language/".$_SESSION['language']."/language.php");
	include("../easythumbnail.class.php");

	$buy_id=$_REQUEST['bid'];
	/*print_r($_REQUEST);*/
	if(isset($_REQUEST['updatebuy']))
	{
	$bname=mysqli_real_escape_string($con, $_REQUEST['bname']);
	$key=mysqli_real_escape_string($con, $_REQUEST['key']);
	$key1=mysqli_real_escape_string($con, $_REQUEST['key1']);
	$key2=mysqli_real_escape_string($con, $_REQUEST['key2']);
	$pcat=mysqli_real_escape_string($con, $_REQUEST['pcat']);
	$psubcat=mysqli_real_escape_string($con, $_REQUEST['psubcat']);
	$brief=mysqli_real_escape_string($con, $_REQUEST['brief']);
	$add_desc=mysqli_real_escape_string($con, $_REQUEST['add_desc']);
	$price=mysqli_real_escape_string($con, $_REQUEST['price']);
	$range1=mysqli_real_escape_string($con, $_REQUEST['range1']);
	$range2=mysqli_real_escape_string($con, $_REQUEST['range2']);
	$miniquantity=mysqli_real_escape_string($con, $_REQUEST['miniquantity']);
	$quantity=mysqli_real_escape_string($con, $_REQUEST['quantity']);
	$certi_req=mysqli_real_escape_string($con, $_REQUEST['certi_req']);
$upload_qry='';

if($_FILES['chgimg']['name']!=NULL)
{
$newfilename=basename($_FILES['chgimg']['name']);
$uploaddir='../upload/';
$uploadfile=$uploaddir . $newfilename;
if(move_uploaded_file($_FILES['chgimg']['tmp_name'], $uploadfile))
{
echo "uploaded successfully";
}
else
{
echo "error";
}
$ftimages = "../blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);
$upload_qry=",photo='$newfilename'";
}
/*	echo "update buyingleads set subject='$bname',keyword='$key',keyword1='$key1',keyword2='$key2',category='$pcat', subcategory='$psubcat',briefdes='$brief',detdes='$add_desc',price='$price',range1='$range1',range2='$range2',miniquantity='$miniquantity',quantity='$quantity',certificate='$certi_req' where buy_id='$buy_id'";
	exit;*/
	$upqry=mysqli_query($con,"update buyingleads set subject='$bname',keyword='$key',keyword1='$key1',keyword2='$key2',category='$pcat', subcategory='$psubcat',briefdes='$brief',detdes='$add_desc',price='$price',range1='$range1',range2='$range2',miniquantity='$miniquantity',quantity='$quantity',certificate='$certi_req' $upload_qry where buy_id='$buy_id'");
	
	if($upqry)
	{
	header("Location:buyleadpending.php?upd");
	}
	}
	$result=mysqli_query($con,"select * from buyingleads where buy_id='$buy_id'");
	$details=mysqli_fetch_array($result);
	$image="../".$details['photo'];
	$product_category=$details['category'];
	$subcategory=$details['subcategory'];
	$stat=$details['status'];
	if($stat==0){$status="Expired";}else if($stat==1){$status="Pending";}else if($stat==2){$status="Approved";}else if($stat==3){$status="Editing Required";}
	$category_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$product_category'"));
	$subcat_name=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcategory'"));
	$num=mysqli_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function validation()
{
tinyMCE.triggerSave();

if(document.buylead.bname.value=="")
{
alert('Enter the buying lead subject');
document.buylead.bname.focus();
return false;
}

if(document.buylead.key.value=="")
{
alert('Enter the keyword');
document.buylead.key.focus();
return false;
}

if(document.buylead.pcat.value=="")
{
alert('Please choose product category');
document.buylead.pcat.focus();
return false;
}

/*if(document.buylead.psubcat.value=="")
{
alert('Please choose product sub category');
document.buylead.psubcat.focus();
return false;
}*/


if(document.buylead.brief.value=="")
{
alert('Enter the product brief description');
document.buylead.brief.focus();
return false;
}

if(document.buylead.price.value=="")
{
alert('Please choose currency type');
document.buylead.price.focus();
return false;
}

if(document.buylead.range1.value=="")
{
alert('Enter the price range');
document.buylead.range1.focus();
return false;
}

if(document.buylead.range2.value=="")
{
alert('Enter the price range');
document.buylead.range2.focus();
return false;
}

if(document.buylead.miniquantity.value=="")
{
alert('Enter the product minimum quantity');
document.buylead.miniquantity.focus();
return false;
}


}

	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "simple",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,indent,blockquote,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		/*theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",*/
		/*theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",*/
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="buyleadpending.php"><b>Buying Leads</b></a></article>
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
		<header><h3 class="tabs_involved">Buying Lead Details</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="732" height="157" align="center" cellspacing="0">
						<tr class="smallfont">
						<td colspan="5">
							<form name="buylead" action="" method="post" onsubmit="return validation();" enctype="multipart/form-data">
							<table width="540" align="center">
								<tr><td height="102" colspan="3" align="center">
								<?php
								 
								 $imgpath = "../blog_photo_thumbnail/".$details['photo'];
								 
								 if(file_exists($imgpath) && $details['photo'] != '' )
								 {
								 
								 ?>
								 <img src="<?php echo "../blog_photo_thumbnail/".$details['photo'];?>" width="98" height="86" />
								 <?php
								 }
								 else
								 {
								 ?>
								 <img src="../blog_photo_thumbnail/img_noimg.jpg" width="98" height="86" />
								 <?php
								 }?>
								</td>
								</tr>
								<tr valign="top"><td width="159" height="44" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Buying lead subject</td>
							    <td width="13">:</td>
							    <td width="352" style="font-family:'Times New Roman', Times, serif; font-size:13px;">
								<input type="text" name="bname" id="bname" class="textBox" value="<?php echo $details['subject'];?>" />
								<input type="hidden" name="bid" value="<?php echo $_REQUEST['bid'];?>" /></td>
								</tr>
								<tr valign="top"><td height="49" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Keyword 1</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><input type="text" name="key" id="key" class="textBox" value="<?php echo $details['keyword'];?>"  /><br />
								 </td></tr>
								 
								 <tr valign="top"><td height="49" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Keyword 2</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><input type="text" name="key1" id="key1" class="textBox" value="<?php echo $details['keyword1'];?>"  /><br />
								 </td></tr>
								 
								  <tr valign="top"><td height="48" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Keyword 2</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><input type="text" name="key2" id="key2" class="textBox" value="<?php echo $details['keyword2'];?>"  /><br />
								 </td></tr>
								<tr valign="top"><td height="44" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Category</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;">
								<?php
								$get_parentid=mysqli_fetch_array(mysqli_query($con,"select * from category where category='$category_name[category]'"));
								 ?>
								<select name="pcat" id="pcat" class="textBox" onchange="FUNCTION1(this.value);" >
								<option value="">Select category</option>
								<?php
								$sel_catlist=mysqli_query($con,"select * from category");
								while($fth_catlist=mysqli_fetch_array($sel_catlist))
								{
								 ?>
								 <option value="<?php echo $fth_catlist['c_id']; ?>" <?php if($fth_catlist['category']==$category_name['category']) { ?> selected="selected" <?php } ?>><?php echo $fth_catlist['category']; ?></option>
								 <?php } ?>
								</select></td>
								</tr>
								<tr valign="top"><td height="43" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Product Sub Category</td>
								<td>:</td>
								<td id="subcat12" style="font-family:'Times New Roman', Times, serif; font-size:13px;"><select name="psubcat" id="psubcat" class="textBox" >
								<option value="">Select sub category</option>
								<?php
								$sel_subcatlist=mysqli_query($con,"select * from category where parent_id='$get_parentid[c_id]'");
								while($fth_subcatlist=mysqli_fetch_array($sel_subcatlist))
								{
								 ?>
								 <option value="<?php echo $fth_subcatlist['c_id']; ?>" <?php if($fth_subcatlist['category']==$subcat_name['category']) { ?> selected="selected" <?php } ?>><?php echo $fth_subcatlist['category']; ?></option>
								 <?php } ?>
								</select></td>
								</tr>
								<tr valign="top"><td height="41" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Brief Description</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><textarea name="brief" id="brief"><?php echo $details['briefdes'];?></textarea></td>
								</tr>
								<tr valign="top"><td height="45" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Additional Description</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><textarea name="add_desc" id="add_desc"><?php echo $details['detdes'];?></textarea></td>
								</tr>
								
								<tr valign="top"><td height="49" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Price Range</td>
								<td>:</td>
								<td>
								<select name="price" id="price" class="textBoxSi" style="width:70px;" style="font-family:'Times New Roman', Times, serif; font-size:13px;">
                                          <option value=""><?php echo $buying_leads_cur;?></option>
                                          <option value="USD" <?php if($details['price']=="USD") { ?> selected="selected" <?php } ?>>USD<?php //echo $buying_leads_usd;?> </option>
                                          <option value="GBP" <?php if($details['price']=="GBP") { ?> selected="selected" <?php } ?>>GBP <?php //echo $buying_leads_gbp;?> </option>
                                          <option value="RMB" <?php if($details['price']=="RMB") { ?> selected="selected" <?php } ?>> RMB<?php //echo $buying_leads_rmb;?> </option>
                                          <option value="EUR" <?php if($details['price']=="EUR") { ?> selected="selected" <?php } ?>> EUR<?php //echo $buying_leads_eur;?> </option>
                                          <option value="AUD" <?php if($details['price']=="AUD") { ?> selected="selected" <?php } ?>> AUD<?php //echo $buying_leads_aud;?> </option>
                                          <option value="CAD" <?php if($details['price']=="CAD") { ?> selected="selected" <?php } ?>> CAD<?php //echo $buying_leads_cad;?> </option>
                                          <option value="CHF" <?php if($details['price']=="CHF") { ?> selected="selected" <?php } ?>>CHF<?php //echo $buying_leads_chf;?> </option>
                                          <option value="JPY" <?php if($details['price']=="JPY") { ?> selected="selected" <?php } ?>> JPY<?php //echo $buying_leads_jpy;?> </option>
                                          <option value="HKD" <?php if($details['price']=="HKD") { ?> selected="selected" <?php } ?>> HKD<?php //echo $buying_leads_hkd;?> </option>
                                          <option value="NZD" <?php if($details['price']=="NZD") { ?> selected="selected" <?php } ?>>NZD <?php //echo $buying_leads_nzd;?></option>
                                          <option value="SGD" <?php if($details['price']=="SGD") { ?> selected="selected" <?php } ?>>SGD <?php //echo $buying_leads_sgd;?> </option>
                                          <option value="OTHER" <?php if($details['price']=="OTHER") { ?> selected="selected" <?php } ?>>OTHER <?php //echo $buying_leads_other;?> </option>
                                  								  </select>
                                        <input type="text" name="range1" style="width:70px;" id="range1" class="textBoxSi" value="<?php echo $details['range1']; ?>" />&nbsp;~&nbsp;                                        
                                        <input type="text" name="range2" style="width:70px;" id="range2" class="textBoxSi" value="<?php echo $details['range2']; ?>" />
								</td>
								</tr>
								<tr valign="top"><td height="62" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Minimum Order Quantity</td>
								<td>:</td>
								<td><input type="text" name="miniquantity" id="miniquantity"class="textBoxSi" value="<?php echo $details['miniquantity']; ?>" />
								<select name="quantity" id="quantity"class="textBoxSi" style="font-family:'Times New Roman', Times, serif; font-size:13px;">
                                          <option value="Unit" <?php if($details['quantity']=="Unit") { ?> selected="selected" <?php } ?>><?php echo $buying_leads_un;?></option>
                                          <option value="Bag/Bags" <?php if($details['quantity']=="Bag/Bags") { ?> selected="selected" <?php } ?>><?php echo $buying_leads_bag;?> </option>
                                          <option value="Barrel/Barrels" <?php if($details['quantity']=="Barrel/Barrels") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_bar;?> </option>
                                          <option value="Bushel/Bushels" <?php if($details['quantity']=="Bushel/Bushels") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_bushe;?></option>
                                          <option value="Cubic meter" <?php if($details['quantity']=="Cubic meter") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_cubicm;?> </option>
                                          <option value="Dozen" <?php if($details['quantity']=="Dozen") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_dzzn;?></option>
                                          <option value="Gallon" <?php if($details['quantity']=="Gallon") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_gallon;?></option>
                                          <option value="Gram" <?php if($details['quantity']=="Gram") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_grm;?> </option>
                                          <option value="Kilogram" <?php if($details['quantity']=="Kilogram") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_kg;?> </option>
                                          <option value="Kilometer" <?php if($details['quantity']=="Kilometer") { ?> selected="selected" <?php } ?>><?php echo $buying_leads_km;?> </option>
                                          <option value="Long Ton" <?php if($details['quantity']=="Long Ton") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_lngto;?> </option>
                                          <option value="Meter" <?php if($details['quantity']=="Meter") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_metr;?></option>
                                          <option value="Metric Ton" <?php if($details['quantity']=="Metric Ton") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_mertoon;?> </option>
                                          <option value="Ounce" <?php if($details['quantity']=="Ounce") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_ounce;?> </option>
                                          <option value="Pair" <?php if($details['quantity']=="Pair") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_pr;?> </option>
                                          <option value="Pack/Packs" <?php if($details['quantity']=="Pack/Packs") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_pks;?></option>
                                          <option value="Piece/Pieces" <?php if($details['quantity']=="Piece/Pieces") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_pieces;?> </option>
                                          <option value="Pound" <?php if($details['quantity']=="Pound") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_pnd;?> </option>
                                          <option value="Set/Sets" <?php if($details['quantity']=="Set/Sets") { ?> selected="selected" <?php } ?>><?php echo $buying_leads_sets;?></option>
                                          <option value="Short Ton" <?php if($details['quantity']=="Short Ton") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_shhot;?> </option>
                                          <option value="Square Meter" <?php if($details['quantity']=="Square Meter") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_squrmet;?></option>
                                          <option value="Ton" <?php if($details['quantity']=="Ton") { ?> selected="selected" <?php } ?>> <?php echo $buying_leads_tn;?></option>
                                  </select>
								</td>
								</tr>
								<tr valign="top"><td height="44" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Certification Requirement</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><textarea name="certi_req" id="certi_req"><?php echo $details['certificate'];?></textarea></td>
								</tr>
								<tr valign="top"><td height="62" style="font-family:'Times New Roman', Times, serif; font-size:13px;">Change product image</td>
								<td>:</td>
								<td style="font-family:'Times New Roman', Times, serif; font-size:13px;"><input type="file" name="chgimg" id="chgimg" /></td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td colspan="3" align="center">
								<input type="submit" name="updatebuy"  value="Update" />
								&nbsp;&nbsp;<!--<input type="button" onclick="javascript:history.back();" value="Back" />-->
								</td></tr>
						  </table>
						  </form>
						 </td>
						</tr>
						
				  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>