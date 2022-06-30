<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$editid=$_REQUEST['editid'];
	$fea=mysqli_fetch_array(mysqli_query($con,"select * from featureproducts where id='$editid'"));
	$img=$fea['f_pdt_images'];
	if(isset($_REQUEST['feature_product']))
	{
	 $pdtname=$_REQUEST['pdtname'];
	  $pdtname1=mysqli_real_escape_string($con, $_REQUEST['pdtname1']);
	   $pdtname2=mysqli_real_escape_string($con, $_REQUEST['pdtname2']);
	   $pdtname3=mysqli_real_escape_string($con, $_REQUEST['pdtname3']);
	 $companyname=$_REQUEST['companyname'];
	 $companyname1=mysqli_real_escape_string($con, $_REQUEST['companyname1']);
	 $companyname2=mysqli_real_escape_string($con, $_REQUEST['companyname2']);
	 $companyname3=mysqli_real_escape_string($con, $_REQUEST['companyname3']);
	 $comemail=$_REQUEST['com_email'];
	 $comstart=$_REQUEST['startyear'];	 
	 $country=$_REQUEST['country'];
	 $address=$_REQUEST['address'];
	  $address1=mysqli_real_escape_string($con, $_REQUEST['address1']);
	   $address2=mysqli_real_escape_string($con, $_REQUEST['address2']);
	   $address3=mysqli_real_escape_string($con, $_REQUEST['address3']);
	 $price=$_REQUEST['p_price'];
	 $range1=$_REQUEST['range1'];
	 $range2=$_REQUEST['range2'];
	 $paymentterms=$_REQUEST['payment'];
	 $minquantity=$_REQUEST['p_miniquantity'];
	 $pdtquantity=$_REQUEST['p_quantity'];
	 $pdtcapacity=$_REQUEST['p_capacity'];
	 $capacity=$_REQUEST['capacity'];
	 $time=$_REQUEST['time'];
	 $deliverytime=$_REQUEST['p_deliverytime'];
	 $packdetails=$_REQUEST['p_packagedetails'];
	 $packdetails1=mysqli_real_escape_string($con, $_REQUEST['p_packagedetails1']);
	 $packdetails2=mysqli_real_escape_string($con, $_REQUEST['p_packagedetails2']);
	 $packdetails3=mysqli_real_escape_string($con, $_REQUEST['p_packagedetails3']);
	 $date=date("Y.m.d");
 
       $filename=basename($_FILES['file']['name']);
	   $uploadpath1="picture/".$filename;
   	   move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath1);

   $hh=$_SESSION['hh'];
   
   if($filename!="")
	{
	$photo=$filename;
	}
	else
	{
	$photo=$img;
	}
 
 $expiredate = date("Y.m.d", strtotime("+1 year"));
 $update=mysqli_query($con,"update featureproducts set f_pdt_name='$pdtname',f_pdt_name_french='$pdtname1',f_pdt_name_chinese='$pdtname2',f_pdt_name_spanish='$pdtname3',f_pdt_images='$photo',companyname='$companyname',companyname='$companyname',companyname_french='$companyname1',companyname_chinese='$companyname2',companyname_spanish='$companyname3',companyemail='$comemail',company_start='$comstart',country='$country',address='$address',address_french='$address1',address_chinese='$address2',address_spanish='$address3',price='$price',range1='$range1',range2='$range2',payment_terms='$paymentterms',minimum_quantity='$minquantity',pdt_quantity='$pdtquantity',pdt_capacity='$pdtcapacity',	 capacity='$capacity',time='$time',deliverytime='$deliverytime',pakage_details='$packdetails',pakage_details_french='$packdetails1',pakage_details_chinese='$packdetails2',pakage_details_spanish='$packdetails3',f_pdt_up_date='$date',f_pdt_exp_date= '$expiredate' where id='$editid'");
	 if($update)
	 {
	 	header("location:featureproductss.php?edited");
	 }	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../ajaxfunction.js"></script>
<script language="javascript">
function featureval()
{
if(document.feature.pdtname.value=="")
{
 alert("Please Enter The Product Name");
 document.feature.pdtname.focus();
 return false;
 }
  if(document.feature.pdtname1.value=="")
{
 alert("Please Enter The Product Name");
 document.feature.pdtname1.focus();
 return false;
 }
 if(document.feature.pdtname2.value=="")
{
 alert("Please Enter The Product Name");
 document.feature.pdtname2.focus();
 return false;
 }
 /*if(document.feature.file.value=="")
 {
  alert("Please Upload The Product Image");
  document.feature.file.focus();
  return false;
  }*/
 if(document.feature.file.value!="")
{
var str = document.feature.file.value.substring(document.feature.file.value.indexOf('.'));
if(str=='.jpg'||str=='.gif' || str=='.jpeg')
{
return true;
}
else
{
alert("Upload only jpg, jpeg and gif");
return false;
}
}
  if(document.feature.startyear.value=="")
  {
  alert("Please Enter Your Company Established Year");
  document.feature.startyear.focus();
  return false;
  }
    if(document.feature.country.value=="")
  {
  alert("Please Select The Country");
  document.feature.country.focus();
  return false;
  }
    if(document.feature.address.value=="")
  {
  alert("Please Enter The Address");
  document.feature.address.focus();
  return false;
  }
   if(document.feature.address1.value=="")
  {
  alert("Please Enter The Address");
  document.feature.address1.focus();
  return false;
  }
   if(document.feature.address2.value=="")
  {
  alert("Please Enter The Address");
  document.feature.address2.focus();
  return false;
  }
   if(document.feature.p_price.value=="")
  {
  alert("Please Select Pay Category");
  document.feature.p_price.focus();
  return false;
  }
  if(document.feature.range1.value=="")
  {
  alert("Please Enter The Minimum Amount");
  document.feature.range1.focus();
  return false;
  }
  if(isNaN(document.feature.range1.value))
  {
   alert("Please Enter Only Numeric Values");
   document.feature.range1.focus();
   return false;
   }
   if(document.feature.range2.value=="")
  {
  alert("Please Enter The Maximum Amount");
  document.feature.range2.focus();
  return false;
  }
  
   if(isNaN(document.feature.range2.value))
  {
   alert("Please Enter Only Numeric Values");
   document.feature.range2.focus();
   return false;
   }
    if(document.feature.p_miniquantity.value=="")
  {
  alert("Please Enter The Minimum Quantity Of Product");
  document.feature.p_miniquantity.focus();
  return false;
  }
  
   if(isNaN(document.feature.p_miniquantity.value))
  {
   alert("Please Enter Only Numeric Values");
   document.feature.p_miniquantity.focus();
   return false;
   }
  if(document.feature.p_quantity.value=="")
  {
  alert("Please Select The Mode Of Order");
  document.feature.p_quantity.focus();
  return false;
  }
  
  
    if(document.feature.p_capacity.value=="")
  {
  alert("Please Enter Production Capacity");
  document.feature.p_capacity.focus();
  return false;
  }
  
  if(isNaN(document.feature.p_capacity.value))
  {
   alert("Please Enter Only Numeric Values");
   document.feature.p_capacity.focus();
   return false;
   }  
   
  if(document.feature.capacity.value=="")
  {
  alert("Please Select Unit Type");
  document.feature.capacity.focus();
  return false;
  }
  if(document.feature.time.value=="")
  {
  alert("Please Select Time");
  document.feature.time.focus();
  return false;
  }
  
   if(document.feature.p_deliverytime.value=="")
  {
  alert("Please Enter The Product Delivery Time");
  document.feature.p_deliverytime.focus();
  return false;
  }
  if(document.feature.p_packagedetails.value=="")
  {
   alert("Please Enter The Package Details");
   document.feature.p_packagedetails.focus();
   return false;
   }
   if(document.feature.p_packagedetails1.value=="")
  {
   alert("Please Enter The Package Details");
   document.feature.p_packagedetails1.focus();
   return false;
   }
   if(document.feature.p_packagedetails2.value=="")
  {
   alert("Please Enter The Package Details");
   document.feature.p_packagedetails2.focus();
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="featureproductss.php"><b>Featured Products</b></a></article>
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
		<header><h3 class="tabs_involved">Edit Feature Products</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
				<tr><td><form action="" method="post" name="feature" enctype="multipart/form-data" onsubmit="return featureval();"><table width="100%" border="0" cellpadding="0" cellspacing="0">

                  <tr>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      
                      <tr>
                        <td colspan="2"><table width="100%" border="0">
                            <?PHP $selectcount=mysqli_query($con,"select * from product where userid='$sess_id'");
							$count=mysqli_num_rows($selectcount);
							$co=$produ-$count;?>
                            
                        </table></td>
                      </tr>
                      <!--<tr bgcolor="#99CCFF">
                        <td height="30" colspan="2" class="normalbold">&nbsp;&nbsp;Basic Information</td>
                      </tr>-->
					  <tr>
                        <td height="30" colspan="2" class="normalbold" style="color:#000099;">&nbsp;&nbsp;Basic Information</td>
                      </tr>
                      <tr>
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Product Name&nbsp;&nbsp;(English)</td>
                        <td width="67%" height="30"><input name="pdtname" type="text" id="pdtname" value="<?PHP echo $fea['f_pdt_name'];?>"/></td>
                      </tr>
					  <tr>
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Product Name&nbsp;&nbsp;(French)</td>
                        <td width="67%" height="30"><input name="pdtname1" type="text" id="pdtname1" value="<?PHP echo $fea['f_pdt_name_french'];?>"/></td>
                      </tr>
					 <?php /*?> <tr>
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Product Name&nbsp;&nbsp;(Chinese)</td>
                        <td width="67%" height="30"><input name="pdtname2" type="text" id="pdtname2" value="<?PHP echo $fea['f_pdt_name_chinese'];?>"/></td>
                      </tr><?php */?>
					  <tr>
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Product Name&nbsp;&nbsp;(Spanish)</td>
                        <td width="67%" height="30"><input name="pdtname3" type="text" id="pdtname3" value="<?PHP echo $fea['f_pdt_name_spanish'];?>"/></td>
                      </tr>
                      <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Product Image </td>
                        <td>

						<?php
						$imgpath="picture/".$fea['f_pdt_images'];
						if(file_exists($imgpath) && $fea['f_pdt_images']!='' )
						{
						?><img src="<?php echo $imgpath; ?>" width="98" height="86" style="margin:5px;" />
						<?php 
						}
						 else
						{
						?>
						<img src="../blog_photo_thumbnail/img_noimg.jpg" width="98" height="86" style="margin:5px;" />
						<?php
						}?>
<br />
<input type="file" name="file" />
						</td>
                      </tr>
                      
                     <!-- <tr>
                        <td colspan="2" class="inTxtHead">&nbsp;Comapny info </td>
                      </tr>-->
                      <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(English) </td>
                        <td height="30"><input name="companyname" type="text" id="companyname" value="<?php echo $fea['companyname'];?>"></td>
                      </tr>
					   <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(French) </td>
                        <td height="30"><input name="companyname1" type="text" id="companyname1" value="<?php echo $fea['companyname_french'];?>"></td>
                      </tr>
					   <?php /*?><tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(Chinese) </td>
                        <td height="30"><input name="companyname2" type="text" id="companyname2" value="<?php echo $fea['companyname_chinese'];?>"></td>
                      </tr><?php */?>
					  <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(Spanish) </td>
                        <td height="30"><input name="companyname3" type="text" id="companyname3" value="<?php echo $fea['companyname_spanish'];?>"></td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Email </td>

                        <td height="30"><input name="com_email" type="text" id="com_email" value="<?php echo $fea['companyemail'];?>"/></td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Company Established On </td>
                        <td height="30"><input name="startyear" type="text" id="startyear" value="<?php echo $fea['company_start'];?>" /></td>
                      </tr> <?php $q=mysqli_query($con,"select * from country");
								    ?>
                      <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Country</td>
                        <td height="30"><span class="inTxtNormal">
                          <select name="country" class="textBox" >
                            <option value="" >Select Country</option>
                            <?PHP
								   while($r=mysqli_fetch_array($q))
								   {
								   ?>
                            <option value="<?PHP echo $r['country_id']; ?>" <?PHP if($fea['country']==$r['country_id']) { ?> selected="selected"<?PHP } ?>><?PHP echo $r['country_name']; ?></option>
                            <?PHP }?>
                          </select>
                        </span></td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(English)</td>
                        <td height="30"><input name="address" type="text" id="address" value="<?php echo $fea['address'];?>"/></td>
                      </tr>
					  <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(French)</td>
                        <td height="30"><input name="address1" type="text" id="address1" value="<?php echo $fea['address_french'];?>"/></td>
                      </tr>
					 <?php /*?> <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(Chinese)</td>
                        <td height="30"><input name="address2" type="text" id="address2" value="<?php echo $fea['address_chinese'];?>"/></td>
                      </tr><?php */?>
					  <tr>
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(Spanish)</td>
                        <td height="30"><input name="address3" type="text" id="address3" value="<?php echo $fea['address_spanish'];?>"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%">
                          <!--<tr>
                            <td colspan="3" bgcolor="#99CCFF" style="padding:5px; border:1px solid #E9E9E8; "><strong> Select Payment and Shipping Terms </strong></td>
                          </tr>-->
						  <tr>
                            <td height="32" colspan="3" style="padding:5px; color:#000099;"><strong> Select Payment and Shipping Terms </strong></td>
                          </tr>
                          <tr>
                            <td width="33%" height="30" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Price range </td>
                            <td height="30" colspan="2"><select name="p_price"  class="textBox" style="width:80px;">
                                <option value="">currency</option>
                                <option value="USD" <?PHP if($fea['price']=="USD") { ?> selected="selected" <?PHP } ?>> USD </option>
                                <option value="GBP" <?PHP if($fea['price']=="GBP") { ?> selected="selected" <?PHP } ?>> GBP </option>
                                <option value="RMB" <?PHP if($fea['price']=="RMB") { ?> selected="selected" <?PHP } ?>> RMB </option>
                                <option value="EUR" <?PHP if($fea['price']=="EUR") { ?> selected="selected" <?PHP } ?>> EUR </option>
                                <option value="AUD" <?PHP if($fea['price']=="AUD") { ?> selected="selected" <?PHP } ?>> AUD </option>
                                <option value="CAD" <?PHP if($fea['price']=="CAD") { ?> selected="selected" <?PHP } ?>> CAD </option>
                                <option value="CHF" <?PHP if($fea['price']=="CHF") { ?> selected="selected" <?PHP } ?>> CHF </option>
                                <option value="JPY" <?PHP if($fea['price']=="JPY") { ?> selected="selected" <?PHP } ?>> JPY </option>
                                <option value="HKD" <?PHP if($fea['price']=="HKD") { ?> selected="selected" <?PHP } ?>> HKD </option>
                                <option value="NZD" <?PHP if($fea['price']=="NZD") { ?> selected="selected" <?PHP } ?>> NZD </option>
                                <option value="SGD" <?PHP if($fea['price']=="SGD") { ?> selected="selected" <?PHP } ?>> SGD </option>
                                <option value="Other" <?PHP if($fea['price']=="Other") { ?> selected="selected" <?PHP } ?>> Other </option>
                              </select>
                                <input type="text" name="range1" style="width:80px;"  maxlength="6" value="<?PHP echo $fea['range1'];?>"/>
                              &nbsp;~&nbsp;
                                <input type="text" name="range2" style="width:80px;"  maxlength="6" value="<?PHP echo $fea['range2'];?>"/></td>
                          </tr>
                          <tr>
                            <td width="33%" rowspan="2" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Payment Terms:</td>
                            <td colspan="2"><input name="payment" type="radio" value="L/C" <?PHP if($fea['payment_terms']=="L/C") { ?> checked="checked" <?PHP } ?> id="free1" onclick="javascript:hide2('addcomments2');" />
                              L/C
                              <input name="payment" type="radio" value="D/A"  <?PHP if($fea['payment_terms']=="D/A") { ?> checked="checked" <?PHP } ?>  onclick="javascript:hide2('addcomments2');"/>
                              D/A
                              <input name="payment" type="radio" value="D/P" <?PHP if($fea['payment_terms']=="D/P") { ?> checked="checked" <?PHP } ?>  onclick="javascript:hide2('addcomments2');"/>
                              D/P
                              <input name="payment" type="radio" value="T/T"  <?PHP if($fea['payment_terms']=="T/T") { ?> checked="checked" <?PHP } ?>  onclick="javascript:hide2('addcomments2');" />
                              T/T
                              <input name="payment" type="radio" value="Western Union"  <?PHP if($fea['payment_terms']=="Western Union") { ?> checked="checked" <?PHP } ?>/>
                              Western Union
                              <input name="payment" type="radio" value="MoneyGram" <?PHP if($fea['payment_terms']=="MoneyGram") { ?> checked="checked" <?PHP } ?>  onclick="javascript:hide2('addcomments2');"/>
                              MoneyGram
                              <input name="payment" type="radio" value="Others" <?PHP if($fea['payment_terms']=="Others") { ?> checked="checked" <?PHP } ?>  onclick="javascript:hide2('addcomments2');"/>
                              Others</td>
                          </tr>
                          <tr>
                            <td colspan="2"><div id="addcomments2" <?PHP if($fea['payment_terms']!="Others") { ?>style="display:none" <?php } else { ?> style="display:block" <?php } ?>>
                              <input type="text" name="others" value="<?php echo $fea['payment_terms'];?>" />
                            </div></td>
                          </tr>
                          <tr>
                            <td class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Minimum Order Quantity </td>
                            <td width="22%"><input type="text" name="p_miniquantity" class="textBoxSi" value="<?PHP echo $fea['minimum_quantity'];?>" /></td>
                            <td width="45%"><select name="p_quantity" class="textBoxSi">
							<option value="">Select</option>
                              
                                <option value="Bag/Bags" <?PHP if($fea['pdt_quantity']=="Bag/Bags") { ?> selected="selected" <?PHP } ?>> Bag/Bags </option>
                                <option value="Barrel/Barrels" <?PHP if($fea['pdt_quantity']=="Barrel/Barrels") { ?> selected="selected" <?PHP } ?>> Barrel/Barrels </option>
                                <option value="Bushel/Bushels" <?PHP if($fea['pdt_quantity']=="Bushel/Bushels") { ?> selected="selected" <?PHP } ?>> Bushel/Bushels </option>
                                <option value="Cubic Meter" <?PHP if($fea['pdt_quantity']=="Cubic Meter") { ?> selected="selected" <?PHP } ?>> Cubic Meter </option>
                                <option value="Dozen" <?PHP if($fea['pdt_quantity']=="Dozen") { ?> selected="selected" <?PHP } ?>> Dozen </option>
                                <option value="Gallon" <?PHP if($fea['pdt_quantity']=="Gallon") { ?> selected="selected" <?PHP } ?>> Gallon </option>
                                <option value="Gram" <?PHP if($fea['pdt_quantity']=="Gram") { ?> selected="selected" <?PHP } ?>> Gram </option>
                                <option value="Kilogram" <?PHP if($fea['pdt_quantity']=="Kilogram") { ?> selected="selected" <?PHP } ?>> Kilogram </option>
                                <option value="Kilometer" <?PHP if($fea['pdt_quantity']=="Kilometer") { ?> selected="selected" <?PHP } ?>> Kilometer </option>
                                <option value="Long Ton" <?PHP if($fea['pdt_quantity']=="Long Ton") { ?> selected="selected" <?PHP } ?>> Long Ton </option>
                                <option value="Meter" <?PHP if($fea['pdt_quantity']=="Meter") { ?> selected="selected" <?PHP } ?>> Meter </option>
                                <option value="Metric Ton" <?PHP if($fea['pdt_quantity']=="Metric Ton") { ?> selected="selected" <?PHP } ?>> Metric Ton </option>
                                <option value="Ounce" <?PHP if($fea['pdt_quantity']=="Ounce") { ?> selected="selected" <?PHP } ?>> Ounce </option>
                                <option value="Pair" <?PHP if($fea['pdt_quantity']=="Pair") { ?> selected="selected" <?PHP } ?>> Pair </option>
                                <option value="Pack/Packs" <?PHP if($fea['pdt_quantity']=="Pack/Packs") { ?> selected="selected" <?PHP } ?>> Pack/Packs </option>
                                <option value="Piece/Pieces" <?PHP if($fea['pdt_quantity']=="Piece/Pieces") { ?> selected="selected" <?PHP } ?>> Piece/Pieces </option>
                                <option value="Pound" <?PHP if($fea['pdt_quantity']=="Pound") { ?> selected="selected" <?PHP } ?>> Pound </option>
                                <option value="Set/Sets" <?PHP if($fea['pdt_quantity']=="Set/Sets") { ?> selected="selected" <?PHP } ?>> Set/Sets </option>
                                <option value="Short Ton" <?PHP if($fea['pdt_quantity']=="Short Ton") { ?> selected="selected" <?PHP } ?>> Short Ton </option>
                                <option value="Square Meter" <?PHP if($fea['pdt_quantity']=="Square Meter") { ?> selected="selected" <?PHP } ?>> Square Meter </option>
                                <option value="Ton" <?PHP if($fea['pdt_quantity']=="Ton") { ?> selected="selected" <?PHP } ?>> Ton </option>
                              </select>                            </td>
                          </tr>
                          <tr>
                            <td height="21" class="blackBo">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%">
                          <!--<tr>
                            <td colspan="2" bgcolor="#99CCFF" style="padding:5px; border:1px solid #E9E9E8;"><strong> Show Buyers your Ability to Supply </strong></td>
                          </tr>-->
						  <tr>
                            <td height="29" colspan="2" style="padding:5px; color:#000099;"><strong> Show Buyers your Ability to Supply </strong></td>
                          </tr>
                          <tr>
                            <td height="30" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Production Capacity:</td>
                            <td width="67%" height="30"><input type="text" name="p_capacity" style="width:80px;"  maxlength="6" value="<?PHP echo $fea['pdt_capacity'];?>"/>
                                <select name="capacity" class="textBox" style="width:130px;" >
                                  <option value="">Select Unit Type</option>
                                   <option value="Bag/Bags" <?PHP if($fea['pdt_quantity']=="Bag/Bags") { ?> selected="selected" <?PHP } ?>> Bag/Bags </option>
                                <option value="Barrel/Barrels" <?PHP if($fea['capacity']=="Barrel/Barrels") { ?> selected="selected" <?PHP } ?>> Barrel/Barrels </option>
                                <option value="Bushel/Bushels" <?PHP if($fea['capacity']=="Bushel/Bushels") { ?> selected="selected" <?PHP } ?>> Bushel/Bushels </option>
                                <option value="Cubic Meter" <?PHP if($fea['capacity']=="Cubic Meter") { ?> selected="selected" <?PHP } ?>> Cubic Meter </option>
                                <option value="Dozen" <?PHP if($fea['capacity']=="Dozen") { ?> selected="selected" <?PHP } ?>> Dozen </option>
                                <option value="Gallon" <?PHP if($fea['capacity']=="Gallon") { ?> selected="selected" <?PHP } ?>> Gallon </option>
                                <option value="Gram" <?PHP if($fea['capacity']=="Gram") { ?> selected="selected" <?PHP } ?>> Gram </option>
                                <option value="Kilogram" <?PHP if($fea['capacity']=="Kilogram") { ?> selected="selected" <?PHP } ?>> Kilogram </option>
                                <option value="Kilometer" <?PHP if($fea['capacity']=="Kilometer") { ?> selected="selected" <?PHP } ?>> Kilometer </option>
                                <option value="Long Ton" <?PHP if($fea['capacity']=="Long Ton") { ?> selected="selected" <?PHP } ?>> Long Ton </option>
                                <option value="Meter" <?PHP if($fea['capacity']=="Meter") { ?> selected="selected" <?PHP } ?>> Meter </option>
                                <option value="Metric Ton" <?PHP if($fea['capacity']=="Metric Ton") { ?> selected="selected" <?PHP } ?>> Metric Ton </option>
                                <option value="Ounce" <?PHP if($fea['capacity']=="Ounce") { ?> selected="selected" <?PHP } ?>> Ounce </option>
                                <option value="Pair" <?PHP if($fea['capacity']=="Pair") { ?> selected="selected" <?PHP } ?>> Pair </option>
                                <option value="Pack/Packs" <?PHP if($fea['capacity']=="Pack/Packs") { ?> selected="selected" <?PHP } ?>> Pack/Packs </option>
                                <option value="Piece/Pieces" <?PHP if($fea['capacity']=="Piece/Pieces") { ?> selected="selected" <?PHP } ?>> Piece/Pieces </option>
                                <option value="Pound" <?PHP if($fea['capacity']=="Pound") { ?> selected="selected" <?PHP } ?>> Pound </option>
                                <option value="Set/Sets" <?PHP if($fea['capacity']=="Set/Sets") { ?> selected="selected" <?PHP } ?>> Set/Sets </option>
                                <option value="Short Ton" <?PHP if($fea['capacity']=="Short Ton") { ?> selected="selected" <?PHP } ?>> Short Ton </option>
                                </select>
                              &nbsp;per &nbsp;
                              <select name="time" class="textBox" style="width:90px;">
                                <option value="">Select Time</option>
                                <option value="Day" <?PHP if($fea['time']=="Day") { ?> selected="selected" <?PHP } ?>> Day </option>
                                <option value="Week" <?PHP if($fea['time']=="Week") { ?> selected="selected" <?PHP } ?>> Week </option>
                                <option value="Month" <?PHP if($fea['time']=="Month") { ?> selected="selected" <?PHP } ?>> Month </option>
                                <option value="Year" <?PHP if($fea['time']=="Year") { ?> selected="selected" <?PHP } ?>> Year </option>
                              </select>                            </td>
                          </tr>
                          <tr>
                            <td width="33%" height="30" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Delivery Time:</td>
                            <td height="30" class="inTxtNormal"><input name="p_deliverytime" type="text" class="textBox" value="<?PHP echo $fea['deliverytime'];?>"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details:&nbsp;&nbsp;(English)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails"><?PHP echo $fea['pakage_details'];?></textarea>
                            </label></td>
                          </tr>
                           <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details:&nbsp;&nbsp;(French)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails1"><?PHP echo $fea['pakage_details_french'];?></textarea>
                            </label></td>
                          </tr>
						  <?php /*?> <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details:&nbsp;&nbsp;(Chinese)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails2"><?PHP echo $fea['pakage_details_chinese'];?></textarea>
                            </label></td>
                          </tr><?php */?>
						  <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details:&nbsp;&nbsp;(Spanish)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails3"><?PHP echo $fea['pakage_details_spanish'];?></textarea>
                            </label></td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="center">
                              <input type="submit" name="feature_product" value="Submit"   />
                              <!--<input name="feature_product" type="image" id="feature_product" value="Submit" src="../images/bu_submit.gif" />-->
                              &nbsp;&nbsp;<input type="button" name="Submit" value="Cancel" onclick="javascript:history.back();"/>
                            </div></td>
                          </tr>
                        </table></td>
                      </tr>
                      
                    </table></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="inbg2">&nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
                </table></form></td>
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