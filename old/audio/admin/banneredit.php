<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$id=$_REQUEST['id'];
	
$res=mysqli_query($con,"select * from featureproducts where bstatus='banner' and id='$id'");
$fetch=mysqli_fetch_array($res);
$img=$fetch['f_pdt_images'];
	
	if(isset($_REQUEST['feature_product']))
	{
	 $pdtname=$_REQUEST['pdtname'];
	  $pdtname1=mysqli_real_escape_string($con, $_REQUEST['pdtname1']);
	$pdtname2=mysqli_real_escape_string($con, $_REQUEST['pdtname2']);
	$pdtname3=mysqli_real_escape_string($con, $_POST['pdtname3']);
	 $companyname=$_REQUEST['companyname'];
     $companyname1=mysqli_real_escape_string($con, $_REQUEST['companyname1']);
	$companyname2=mysqli_real_escape_string($con, $_REQUEST['companyname2']);
	$companyname3=mysqli_real_escape_string($con, $_POST['companyname3']);
	 $comemail=$_REQUEST['com_email'];
	 $comstart=$_REQUEST['startyear'];	 
	 $country=$_REQUEST['country'];
	 $address=$_REQUEST['address'];
	  $address1=mysqli_real_escape_string($con, $_REQUEST['address1']);
	$address2=mysqli_real_escape_string($con, $_REQUEST['address2']);
	$address3=mysqli_real_escape_string($con, $_POST['address3']);
	 $state=$_REQUEST['state'];
	 $city=$_REQUEST['city'];
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
	$packdetails3=mysqli_real_escape_string($con, $_POST['p_packagedetails3']);
	 $date=date("Y.m.d");
 
       $filename=basename($_FILES['file']['name']);
	   $uploadpath1="picture/".$filename;
   	   move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath1);

if($filename!="")
	{
	$photo=$filename;
	}
	else
	{
	$photo=$img;
	}

$hh=$_SESSION['hh'];
 
 $expiredate = date("Y.m.d", strtotime("+1 year"));
 
	 
	/* echo "update featureproducts set f_pdt_name='$pdtname',f_pdt_name_french='$pdtname1',f_pdt_name_chinese='$pdtname2', f_pdt_images='$photo', companyname='$companyname', companyname_french='$companyname1', companyname_chinese='$companyname2', companyemail='$comemail', company_start='$comstart', country='$country', address='$address', address_french='$address1', address_chinese='$address2', state='$state', city='$city', price='$price', range1='$range1', range2='$range2', payment_terms='$paymentterms', minimum_quantity='$minquantity', pdt_quantity='$pdtquantity', pdt_capacity='$pdtcapacity', capacity='$capacity', time='$time', deliverytime='$deliverytime', pakage_details='$packdetails', pakage_details_french='$packdetails1', pakage_details_chinese='$packdetails2' where id='$id'";exit;
	 */
	 mysqli_query($con,"update featureproducts set f_pdt_name='$pdtname',f_pdt_name_french='$pdtname1',f_pdt_name_chinese='$pdtname2',f_pdt_name_spanish='$pdtname3', f_pdt_images='$photo', companyname='$companyname', companyname_french='$companyname1', companyname_chinese='$companyname2', companyname_spanish='$companyname3', companyemail='$comemail', company_start='$comstart', country='$country', address='$address', address_french='$address1', address_chinese='$address2', address_spanish='$address3', state='$state', city='$city', price='$price', range1='$range1', range2='$range2', payment_terms='$paymentterms', minimum_quantity='$minquantity', pdt_quantity='$pdtquantity', pdt_capacity='$pdtcapacity', capacity='$capacity', time='$time', deliverytime='$deliverytime', pakage_details='$packdetails', pakage_details_french='$packdetails1', pakage_details_chinese='$packdetails2', pakage_details_spanish='$packdetails3' where id='$id'");
	 
	 header("location:bannerview.php?edited");
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
 /*if(document.feature.file.value=="")
 {
  alert("Please Upload The Product Image");
  document.feature.file.focus();
  return false;
  }*/
 if(document.feature.file.value!="")
{
var str = document.feature.file.value.substring(document.feature.file.value.indexOf('.'));
if(str=='.jpg'|| str=='.jpeg')
{
return true;
}
else
{
alert("Upload only jpg, jpeg");
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
   if(document.feature.range1.value<=0)
  {
  alert("Please Enter  Minimum Amount Greater Than Zero");
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
   if(document.feature.range2.value<0)
  {
  alert("Please Enter The Maximum Amount Greater Than Zero");
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
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="bannerview.php"><b>Banners</b></a></article>
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
		<header><h3 class="tabs_involved">Edit Banner Products</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0">
				<tr><td><form action="" method="post" name="feature" enctype="multipart/form-data" onsubmit="return featureval();"><table width="100%" border="0" cellpadding="0" cellspacing="0">

                  <tr>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      
                      <tr>
                        <td colspan="2"><table width="100%" border="0" style="border:1px solid #CCCCCC;">
                            <?PHP $selectcount=mysqli_query($con,"select * from product where userid='$sess_id'");
							$count=mysqli_num_rows($selectcount);
							$co=$produ-$count;?>
                            
                        </table></td>
                      </tr>
                      <tr>
                        <td height="30" colspan="2" class="normalbold" style="color:#000099">&nbsp;&nbsp;&nbsp;&nbsp;Basic Company Information</td>
                      </tr>
                      <tr>
                        <td width="33%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Product Name&nbsp;&nbsp;(English)</td>
                        <td width="67%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="pdtname" type="text" id="pdtname" value="<?php echo $fetch['f_pdt_name'];?>"/></td>
                      </tr>
					  <tr>
                        <td width="33%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Product Name&nbsp;&nbsp;(French)</td>
                        <td width="67%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="pdtname1" type="text" id="pdtname1" value="<?php echo $fetch['f_pdt_name_french'];?>"/></td>
                      </tr>
					<?php /*?>  <tr>
                        <td width="33%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Product Name&nbsp;&nbsp;(Chinese)</td>
                        <td width="67%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="pdtname2" type="text" id="pdtname2" value="<?php echo $fetch['f_pdt_name_chinese'];?>"/></td>
                      </tr><?php */?>
					  <tr>
                        <td width="33%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Product Name&nbsp;&nbsp;(Spanish)</td>
                        <td width="67%" height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="pdtname3" type="text" id="pdtname3" value="<?php echo $fetch['f_pdt_name_spanish'];?>"/></td>
                      </tr>
                      <tr>
                        <td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Product Image </td>
                        <td><input type="file" name="file" value="<?php echo $fetch['f_pdt_images'];?>"/></td>
                      </tr>
                      
                    
                      <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(English) </td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="companyname" type="text" id="companyname" value="<?php echo $fetch['companyname'];?>"/></td>
                      </tr>
					  <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(French) </td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="companyname1" type="text" id="companyname1" value="<?php echo $fetch['companyname_french'];?>"/></td>
                      </tr>
					  <?php /*?><tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(Chinese) </td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="companyname2" type="text" id="companyname2" value="<?php echo $fetch['companyname_chinese'];?>"/></td>
                      </tr><?php */?>
					   <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(Spanish) </td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="companyname3" type="text" id="companyname3" value="<?php echo $fetch['companyname_spanish'];?>"/></td>
                      </tr>
                      <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Email </td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="com_email" type="text" id="com_email" value="<?php echo $fetch['companyemail'];?>"/></td>
                      </tr>
                      <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Company Established On </td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="startyear" type="text" id="startyear" value="<?php echo $fetch['company_start'];?>"/></td>
                      </tr> <?php $q=mysqli_query($con,"select * from country");
								    ?>
                      <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Country</td>
                        <td height="30"><span class="inTxtNormal" style="font-family:'Times New Roman', Times, serif; font-size:14px;">
                          <select name="country" class="textBox" >
                            <option value="" >Select Country</option>
                            <?PHP
								   while($r=mysqli_fetch_array($q))
								   {
								   ?>
                            <option value="<?PHP echo $r['country_id']; ?>" <?php if($fetch['country']==$r['country_id']){ ?> selected="selected"<?php }?>><?PHP echo $r['country_name']; ?></option>
                            <?PHP }?>
                          </select>
                        </span></td>
                      </tr>
					  <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State</td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="state" type="text" id="address" value="<?php echo $fetch['state'];?>"/></td>
                      </tr>
					  <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City</td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="city" type="text" id="address" value="<?php echo $fetch['city'];?>"/></td>
                      </tr>
                      <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address&nbsp;&nbsp;(English)</td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="address" type="text" id="address" value="<?php echo $fetch['address'];?>"/></td>
                      </tr>
					  <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address&nbsp;&nbsp;(French)</td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="address1" type="text" id="address1" value="<?php echo $fetch['address_french'];?>"/></td>
                      </tr>
					 <?php /*?> <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address&nbsp;&nbsp;(Chinese)</td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="address2" type="text" id="address2" value="<?php echo $fetch['address_chinese'];?>"/></td>
                      </tr><?php */?>
					  <tr>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address&nbsp;&nbsp;(Spanish)</td>
                        <td height="30" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="address3" type="text" id="address3" value="<?php echo $fetch['address_spanish'];?>"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%">
                          <!--<tr>
                            <td colspan="3" style="color:#000099"><strong> Select Payment and Shipping Terms </strong></td>
                          </tr>-->
						  <tr>
                        <td height="30" colspan="2" class="normalbold" style="color:#000099">&nbsp;&nbsp;&nbsp;&nbsp;Select Payment and Shipping Terms</td>
                      </tr>
                          <tr>
                            <td width="33%" height="30" class="blackBo" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Price range </td>
                            <td height="30" colspan="2"><select name="p_price"  class="textBox" style="width:80px;">
                                <option value="">currency</option>
                               <option value="USD" <?php if($fetch['price']=='USD'){ ?> selected="selected"<?php }?>> USD </option>
                               <option value="GBP" <?php if($fetch['price']=='GBP'){ ?> selected="selected"<?php }?>> GBP </option>
                               <option value="RMB" <?php if($fetch['price']=='RMB'){ ?> selected="selected"<?php }?>> RMB </option>
                               <option value="EUR" <?php if($fetch['price']=='EUR'){ ?> selected="selected"<?php }?>> EUR </option>
                               <option value="AUD" <?php if($fetch['price']=='AUD'){ ?> selected="selected"<?php }?>> AUD </option>
                               <option value="CAD" <?php if($fetch['price']=='CAD'){ ?> selected="selected"<?php }?>> CAD </option>
                               <option value="CHF" <?php if($fetch['price']=='CHF'){ ?> selected="selected"<?php }?>> CHF </option>
                               <option value="JPY" <?php if($fetch['price']=='JPY'){ ?> selected="selected"<?php }?>> JPY </option>
                               <option value="HKD" <?php if($fetch['price']=='HKD'){ ?> selected="selected"<?php }?>> HKD </option>
                               <option value="NZD" <?php if($fetch['price']=='NZD'){ ?> selected="selected"<?php }?>> NZD </option>
                               <option value="SGD" <?php if($fetch['price']=='SGD'){ ?> selected="selected"<?php }?>> SGD </option>
                           <option value="Other" <?php if($fetch['price']=='Other'){ ?> selected="selected"<?php }?>> Other </option>
                              </select>
                                <input type="text" name="range1" style="width:80px;"  maxlength="6" value="<?php echo $fetch['range1'];?>"/>
                              &nbsp;~&nbsp;
                                <input type="text" name="range2" style="width:80px;"  maxlength="6" value="<?php echo $fetch['range2'];?>"/></td>
                          </tr>
                          <tr>
                            <td width="33%" rowspan="2" class="blackBo" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Payment Terms:</td>
                            <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;">
	<input name="payment" type="radio" value="L/C" <?php if($fetch['payment_terms']=='L/C'){ ?> checked="checked"<?php }?> id="free1"/>
                              L/C
        <input name="payment" type="radio" value="D/A" <?php if($fetch['payment_terms']=='D/A'){ ?> checked="checked"<?php }?> />
                              D/A
                              <input name="payment" type="radio" value="D/P" <?php if($fetch['payment_terms']=='D/P'){ ?> checked="checked"<?php }?>/>
                              D/P
                              <input name="payment" type="radio" value="T/T" <?php if($fetch['payment_terms']=='T/T'){ ?> checked="checked"<?php }?>/>
                              T/T
                              <input name="payment" type="radio" value="Western Union" <?php if($fetch['payment_terms']=='Western Union'){ ?> checked="checked"<?php }?>/>
                              Western Union
                              <input name="payment" type="radio" value="MoneyGram" <?php if($fetch['payment_terms']=='MoneyGram'){ ?> checked="checked"<?php }?>/>
                              MoneyGram
                              <input name="payment" type="radio" value="Others" <?php if($fetch['payment_terms']=='Others'){ ?> checked="checked"<?php }?>/>
                              Others</td>
                          </tr>
                          <tr>
                            <td colspan="2" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><div id="addcomments2" style="display:none" >
                              <input type="text" name="others" />
                            </div></td>
                          </tr>
                          <tr>
                            <td class="blackBo" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Minimam Order Quantity </td>
                            <td width="22%" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input type="text" name="p_miniquantity" class="textBoxSi" value="<?php echo $fetch['minimum_quantity'];?>"/></td>
                            <td width="45%"><select name="p_quantity" class="textBoxSi">
							<option value="">Select</option>
                                <option value="Bag/Bags" <?php if($fetch['pdt_quantity']=='Bag/Bags'){ ?> selected="selected"<?php }?>> Bag/Bags </option>
                                <option value="Barrel/Barrels" <?php if($fetch['pdt_quantity']=='Barrel/Barrels'){ ?> selected="selected"<?php }?>> Barrel/Barrels </option>
                                <option value="Bushel/Bushels" <?php if($fetch['pdt_quantity']=='Bushel/Bushels'){ ?> selected="selected"<?php }?>> Bushel/Bushels </option>
                                <option value="Cubic Meter" <?php if($fetch['pdt_quantity']=='Cubic Meter'){ ?> selected="selected"<?php }?>> Cubic Meter </option>
                                <option value="Dozen" <?php if($fetch['pdt_quantity']=='Dozen'){ ?> selected="selected"<?php }?>> Dozen </option>
                                <option value="Gallon" <?php if($fetch['pdt_quantity']=='Gallon'){ ?> selected="selected"<?php }?>> Gallon </option>
                                <option value="Gram" <?php if($fetch['pdt_quantity']=='Gram'){ ?> selected="selected"<?php }?>> Gram </option>
                                <option value="Kilogram" <?php if($fetch['pdt_quantity']=='Kilogram'){ ?> selected="selected"<?php }?>> Kilogram </option>
                                <option value="Kilometer" <?php if($fetch['pdt_quantity']=='Kilometer'){ ?> selected="selected"<?php }?>> Kilometer </option>
                                <option value="Long Ton" <?php if($fetch['pdt_quantity']=='Long Ton'){ ?> selected="selected"<?php }?>> Long Ton </option>
                                <option value="Meter" <?php if($fetch['pdt_quantity']=='Meter'){ ?> selected="selected"<?php }?>> Meter </option>
                                <option value="Metric Ton" <?php if($fetch['pdt_quantity']=='Metric Ton'){ ?> selected="selected"<?php }?>> Metric Ton </option>
                                <option value="Ounce" <?php if($fetch['pdt_quantity']=='Ounce'){ ?> selected="selected"<?php }?>> Ounce </option>
                                <option value="Pair" <?php if($fetch['pdt_quantity']=='Pair'){ ?> selected="selected"<?php }?>> Pair </option>
                                <option value="Pack/Packs" <?php if($fetch['pdt_quantity']=='Pack/Packs'){ ?> selected="selected"<?php }?>> Pack/Packs </option>
                                <option value="Piece/Pieces" <?php if($fetch['pdt_quantity']=='Piece/Pieces'){ ?> selected="selected"<?php }?>> Piece/Pieces </option>
                                <option value="Pound" <?php if($fetch['pdt_quantity']=='Pound'){ ?> selected="selected"<?php }?>> Pound </option>
                                <option value="Set/Sets" <?php if($fetch['pdt_quantity']=='Set/Sets'){ ?> selected="selected"<?php }?>> Set/Sets </option>
                                <option value="Short Ton" <?php if($fetch['pdt_quantity']=='Short Ton'){ ?> selected="selected"<?php }?>> Short Ton </option>
                                <option value="Square Meter" <?php if($fetch['pdt_quantity']=='Square Meter'){ ?> selected="selected"<?php }?>> Square Meter </option>
                                <option value="Ton" <?php if($fetch['pdt_quantity']=='Ton'){ ?> selected="selected"<?php }?>> Ton </option>
                              </select>                            </td>
                          </tr>
                          <tr>
                            <td class="blackBo">&nbsp;</td>
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
                            <td colspan="2" style="color:#000099"><strong> Show Buyers your Ability to Supply </strong></td>
                          </tr>-->
						  <tr>
                        <td height="30" colspan="2" class="normalbold" style="color:#000099">&nbsp;&nbsp;&nbsp;&nbsp;Show Buyers your Ability to Supply</td>
                      </tr>
                          <tr>
                            <td height="30" class="blackBo" style="font-family:'Times New Roman', Times, serif; font-size:14px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Production Capacity:</td>
                            <td width="67%" height="30"><input type="text" name="p_capacity"   style="width:80px;"  maxlength="6" value="<?php echo $fetch['pdt_capacity'];?>"/>
                                <select name="capacity" class="textBox" style="width:130px;" >
                                  <option value="">Select Unit Type</option>
                                  <option value="Bag/Bags" <?php if($fetch['capacity']=='Bag/Bags'){ ?> selected="selected"<?php }?>> Bag/Bags </option>
                                  <option value="Barrel/Barrels" <?php if($fetch['capacity']=='Barrel/Barrels'){ ?> selected="selected"<?php }?>> Barrel/Barrels </option>
                                  <option value="Cubic Meter" <?php if($fetch['capacity']=='Cubic Meter'){ ?> selected="selected"<?php }?>> Cubic Meter </option>
                                  <option value="Dozen" <?php if($fetch['capacity']=='Dozen'){ ?> selected="selected"<?php }?>> Dozen </option>
                                  <option value="Gallon" <?php if($fetch['capacity']=='Gallon'){ ?> selected="selected"<?php }?>> Gallon </option>
                                  <option value="Gram" <?php if($fetch['capacity']=='Gram'){ ?> selected="selected"<?php }?>> Gram </option>
                                  <option value="Kilogram" <?php if($fetch['capacity']=='Kilogram'){ ?> selected="selected"<?php }?>> Kilogram </option>
                                  <option value="Kilometer" <?php if($fetch['capacity']=='Kilometer'){ ?> selected="selected"<?php }?>> Kilometer </option>
                                  <option value="Long Ton" <?php if($fetch['capacity']=='Long Ton'){ ?> selected="selected"<?php }?>> Long Ton </option>
                                  <option value="Meter" <?php if($fetch['capacity']=='Meter'){ ?> selected="selected"<?php }?>> Meter </option>
                                  <option value="Mertic Ton" <?php if($fetch['capacity']=='Mertic Ton'){ ?> selected="selected"<?php }?>> Mertic Ton </option>
                                  <option value="Ounce" <?php if($fetch['capacity']=='Ounce'){ ?> selected="selected"<?php }?>> Ounce </option>
                                  <option value="Pair" <?php if($fetch['capacity']=='Pair'){ ?> selected="selected"<?php }?>> Pair </option>
                                  <option value="pack/packs" <?php if($fetch['capacity']=='pack/packs'){ ?> selected="selected"<?php }?>> pack/packs </option>
                                  <option value="Piece/Pieces" <?php if($fetch['capacity']=='Piece/Pieces'){ ?> selected="selected"<?php }?>> Piece/Pieces </option>
                                  <option value="Pound" <?php if($fetch['capacity']=='Pound'){ ?> selected="selected"<?php }?>> Pound </option>
                                  <option value="Set/Sets" <?php if($fetch['capacity']=='Set/Sets'){ ?> selected="selected"<?php }?>> Set/Sets </option>
                                  <option value="Short Ton" <?php if($fetch['capacity']=='Short Ton'){ ?> selected="selected"<?php }?>> Short Ton </option>
                                </select>
                              &nbsp;per &nbsp;
                              <select name="time" class="textBox" style="width:90px;">
                                <option value="">Select Time</option>
                                <option value="Day" <?php if($fetch['time']=='Day'){ ?> selected="selected"<?php }?>> Day </option>
                             <option value="Week" <?php if($fetch['time']=='Week'){ ?> selected="selected"<?php }?>> Week </option>
                         <option value="Month" <?php if($fetch['time']=='Month'){ ?> selected="selected"<?php }?>> Month </option>
                           <option value="Year" <?php if($fetch['time']=='Year'){ ?> selected="selected"<?php }?>> Year </option>
                              </select>                            </td>
                          </tr>
                          <tr>
                            <td width="33%" height="30" class="blackBo" style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Delivery Time:</td>
                            <td height="30" class="inTxtNormal" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><input name="p_deliverytime" type="text" class="textBox" value="<?php echo $fetch['deliverytime'];?>"></td>
                          </tr>
                          <tr>
                            <td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Packaging Details&nbsp;&nbsp;(English)</td>
                            <td class="inTxtNormal" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                              <textarea name="p_packagedetails"><?php echo $fetch['pakage_details'];?></textarea>
                            </label></td>
                          </tr>
                          <tr>
                            <td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Packaging Details&nbsp;&nbsp;(French)</td>
                            <td class="inTxtNormal" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                              <textarea name="p_packagedetails1"><?php echo $fetch['pakage_details_french'];?></textarea>
                            </label></td>
                          </tr>
						 <?php /*?> <tr>
                            <td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Packaging Details&nbsp;&nbsp;(Chinese)</td>
                            <td class="inTxtNormal" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                              <textarea name="p_packagedetails2"><?php echo $fetch['pakage_details_chinese'];?></textarea>
                            </label></td>
                          </tr><?php */?>
						  <tr>
                            <td style="font-family:'Times New Roman', Times, serif; font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style1" style="color:#FF0000">*</span> Packaging Details&nbsp;&nbsp;(Spanish)</td>
                            <td class="inTxtNormal" style="font-family:'Times New Roman', Times, serif; font-size:14px;"><label>
                              <textarea name="p_packagedetails3"><?php echo $fetch['pakage_details_spanish'];?></textarea>
                            </label></td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="center">
                                <!--<input name="feature_product" type="image" id="feature_product" value="Submit" src="../images/bu_submit.gif" />-->
                                <input type="submit" name="feature_product" value="Submit" />
                                &nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" onclick="javascript:history.back();"/>
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