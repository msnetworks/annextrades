<?php 
session_start();
	ob_start();
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	include("../db-connect/notfound.php");
	include("includes/header.php");
	
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

  $expiredate = date("Y.m.d", strtotime("+1 year"));
 
  /* echo "insert into featureproducts (f_pdt_name,f_pdt_images,companyname,companyemail,company_start,country,address,price,range1,range2,payment_terms,minimum_quantity,pdt_quantity,pdt_capacity,capacity,time,deliverytime,pakage_details,f_pdt_up_date,f_pdt_exp_date) values('$pdtname','$filename','$companyname','$comemail','$comstart','$country','$address','$price','$range1','$range2','$paymentterms','$minquantity','$pdtquantity','$pdtcapacity','$capacity','$time','$deliverytime','$packdetails','$date','$expiredate')";
  
  exit;*/
	 mysqli_query($con,"insert into featureproducts (f_pdt_name,f_pdt_name_french,f_pdt_name_chinese,f_pdt_name_spanish,f_pdt_images,companyname,companyname_french,companyname_chinese,companyname_spanish,companyemail,company_start,country,address,address_french,address_chinese,address_spanish,price,range1,range2,payment_terms,minimum_quantity,pdt_quantity,pdt_capacity,capacity,time,deliverytime,pakage_details,pakage_details_french,pakage_details_chinese,pakage_details_spanish,f_pdt_up_date,f_pdt_exp_date) values('$pdtname','$pdtname1','$pdtname2','$pdtname3','$filename','$companyname','$companyname1','$companyname2','$companyname3','$comemail','$comstart','$country','$address','$address1','$address2','$address3','$price','$range1','$range2','$paymentterms','$minquantity','$pdtquantity','$pdtcapacity','$capacity','$time','$deliverytime','$packdetails','$packdetails1','$packdetails2','$packdetails3','$date','$expiredate')");
   header("location:featureproductss.php?added");
   //echo $con->error;
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
 if(document.feature.file.value=="")
 {
  alert("Please Upload The Product Image");
  document.feature.file.focus();
  return false;
  }
 var fnam=document.feature.file.value;
splt=fnam.split('.');
chksplt=splt[1].toLowerCase();

if(chksplt=='jpg'|| chksplt=='jpeg'){

}else{
alert(" Upload only jpg, jpeg");
document.feature.file.focus();
return false;
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
		<header><h3 class="tabs_involved">Feature Products</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="left" cellspacing="0">
				
				<tr><td><form action="" method="post" name="feature" enctype="multipart/form-data" onsubmit="return featureval();"><table width="100%" border="0" cellpadding="0" cellspacing="0">

                  <tr>
                    <td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
                      
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
                        <td height="30" colspan="2" class="normalbold" style="color:#000099;">&nbsp;&nbsp;<b>Basic Information</b></td>
                      </tr>
                      <tr class="gbold">
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Product Name&nbsp;&nbsp;(English)</td>
                        <td width="67%" height="30"><input name="pdtname" type="text" id="pdtname" /></td>
                      </tr>
					   <tr class="gbold">
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Product Name&nbsp;&nbsp;(French)</td>
                        <td width="67%" height="30"><input name="pdtname1" type="text" id="pdtname1" /></td>
                      </tr>
					  <!-- <tr class="gbold">
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Product Name&nbsp;&nbsp;(Chinese)</td>
                        <td width="67%" height="30"><input name="pdtname2" type="text" id="pdtname2" /></td>
                      </tr>-->
					  <tr class="gbold">
                        <td width="33%" height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Product Name&nbsp;&nbsp;(Spanish)</td>
                        <td width="67%" height="30"><input name="pdtname3" type="text" id="pdtname3" /></td>
                      </tr>
                      <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Product Image </td>
                        <td><input type="file" name="file" /></td>
                      </tr>
                      
                     <!-- <tr>
                        <td colspan="2" class="inTxtHead">&nbsp;Comapny info </td>
                      </tr>-->
                      <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(English) </td>
                        <td height="30"><input name="companyname" type="text" id="companyname" /></td>
                      </tr>
					  <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(French) </td>
                        <td height="30"><input name="companyname1" type="text" id="companyname1" /></td>
                      </tr>
					  <!--<tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(Chinese) </td>
                        <td height="30"><input name="companyname2" type="text" id="companyname2" /></td>
                      </tr>-->
					  <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name&nbsp;&nbsp;(Spanish) </td>
                        <td height="30"><input name="companyname3" type="text" id="companyname3" /></td>
                      </tr>
                      <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Email </td>
                        <td height="30"><input name="com_email" type="text" id="com_email" /></td>
                      </tr>
                      <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Company Established On </td>
                        <td height="30"><input name="startyear" type="text" id="startyear" /></td>
                      </tr> <?php $q=mysqli_query($con,"select * from country");
								    ?>
                      <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Country</td>
                        <td height="30"><span class="inTxtNormal">
                          <select name="country" class="textBox" >
                            <option value="" >Select Country</option>
                            <?PHP
								   while($r=mysqli_fetch_array($q))
								   {
								   ?>
                            <option value="<?PHP echo $r['country_id']; ?>"><?PHP echo $r['country_name']; ?></option>
                            <?PHP }?>
                          </select>
                        </span></td>
                      </tr>
                      <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(English)</td>
                        <td height="30"><input name="address" type="text" id="address" /></td>
                      </tr>
					  <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(French)</td>
                        <td height="30"><input name="address1" type="text" id="address1" /></td>
                      </tr>
					 <!-- <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(Chinese)</td>
                        <td height="30"><input name="address2" type="text" id="address2" /></td>
                      </tr>-->
					  <tr class="gbold">
                        <td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span>&nbsp;Address&nbsp;&nbsp;(Spanish)</td>
                        <td height="30"><input name="address3" type="text" id="address3" /></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%">
                          <!--<tr>
                            <td colspan="3" class="normalbold" bgcolor="#99CCFF"><strong> Select Payment and Shipping Terms </strong></td>
                          </tr>-->
						  <tr>
                            <td height="32" colspan="3" class="normalbold" style="color:#000099;"><strong> &nbsp;&nbsp;Select Payment and Shipping Terms </strong></td>
                          </tr>
                          <tr class="gbold">
                            <td width="33%" height="30" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Price range </td>
                            <td height="30" colspan="2"><select name="p_price"  class="textBox" style="width:80px;">
                                <option value="">currency</option>
                                <option value="USD"> USD </option>
                                <option value="GBP"> GBP </option>
                                <option value="RMB"> RMB </option>
                                <option value="EUR"> EUR </option>
                                <option value="AUD"> AUD </option>
                                <option value="CAD"> CAD </option>
                                <option value="CHF"> CHF </option>
                                <option value="JPY"> JPY </option>
                                <option value="HKD"> HKD </option>
                                <option value="NZD"> NZD </option>
                                <option value="SGD"> SGD </option>
                                <option value="Other"> Other </option>
                              </select>
                                <input type="text" name="range1" style="width:80px;"  maxlength="6"/>
                              &nbsp;~&nbsp;
                                <input type="text" name="range2" style="width:80px;"  maxlength="6"/></td>
                          </tr>
                          <tr class="gbold">
                            <td width="33%" rowspan="2" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Payment Terms:</td>
                            <td colspan="2"><input name="payment" type="radio" value="L/C"  checked="checked"  id="free1" onclick="javascript:hide2('addcomments2');" />
                              L/C
                              <input name="payment" type="radio" value="D/A"  onclick="javascript:hide2('addcomments2');" />
                              D/A
                              <input name="payment" type="radio" value="D/P"  onclick="javascript:hide2('addcomments2');" />
                              D/P
                              <input name="payment" type="radio" value="T/T"   onclick="javascript:hide2('addcomments2');"/>
                              T/T
                              <input name="payment" type="radio" value="Western Union"   onclick="javascript:hide2('addcomments2');"/>
                              Western Union
                              <input name="payment" type="radio" value="MoneyGram"   onclick="javascript:hide2('addcomments2');" />
                              MoneyGram
                              <input name="payment" type="radio" value="Others"  onclick="javascript:show2('addcomments2');" />
                              Others</td>
                          </tr>
                          <tr class="gbold">
                            <td colspan="2"><div id="addcomments2" style="display:none" >
                              <input type="text" name="others" />
                            </div></td>
                          </tr>
                          <tr class="gbold">
                            <td class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Minimam Order Quantity </td>
                            <td width="22%"><input type="text" name="p_miniquantity" class="textBoxSi" /></td>
                            <td width="45%"><select name="p_quantity" class="textBoxSi">
							<option value="">Select</option>
                                <option value="Bag/Bags"> Bag/Bags </option>
                                <option value="Barrel/Barrels"> Barrel/Barrels </option>
                                <option value="Bushel/Bushels"> Bushel/Bushels </option>
                                <option value="Cubic Meter"> Cubic Meter </option>
                                <option value="Dozen"> Dozen </option>
                                <option value="Gallon"> Gallon </option>
                                <option value="Gram"> Gram </option>
                                <option value="Kilogram"> Kilogram </option>
                                <option value="Kilometer"> Kilometer </option>
                                <option value="Long Ton"> Long Ton </option>
                                <option value="Meter"> Meter </option>
                                <option value="Metric Ton"> Metric Ton </option>
                                <option value="Ounce"> Ounce </option>
                                <option value="Pair"> Pair </option>
                                <option value="Pack/Packs"> Pack/Packs </option>
                                <option value="Piece/Pieces"> Piece/Pieces </option>
                                <option value="Pound"> Pound </option>
                                <option value="Set/Sets"> Set/Sets </option>
                                <option value="Short Ton"> Short Ton </option>
                                <option value="Square Meter"> Square Meter </option>
                                <option value="Ton"> Ton </option>
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
                            <td colspan="2" bgcolor="#99CCFF" class="normalbold"><strong> Show Buyers your Ability to Supply </strong></td>
                          </tr>-->
						  <tr>
                            <td height="33" colspan="2" class="normalbold" style="color:#000099;"><strong>&nbsp;&nbsp;Show Buyers your Ability to Supply </strong></td>
                          </tr>
                          <tr class="gbold">
                            <td height="30" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Production Capacity:</td>
                            <td width="67%" height="30"><input type="text" name="p_capacity"   style="width:80px;"  maxlength="6"/>
                                <select name="capacity" class="textBox" style="width:130px;" >
                                  <option value="">Select Unit Type</option>
                                  <option value="Bag/Bags"> Bag/Bags </option>
                                  <option value="Barrel/Barrels"> Barrel/Barrels </option>
                                  <option value="Cubic Meter"> Cubic Meter </option>
                                  <option value="Dozen"> Dozen </option>
                                  <option value="Gallon"> Gallon </option>
                                  <option value="Gram"> Gram </option>
                                  <option value="Kilogram"> Kilogram </option>
                                  <option value="Kilometer"> Kilometer </option>
                                  <option value="Long Ton"> Long Ton </option>
                                  <option value="Meter"> Meter </option>
                                  <option value="Mertic Ton"> Mertic Ton </option>
                                  <option value="Ounce"> Ounce </option>
                                  <option value="Pair"> Pair </option>
                                  <option value="pack/packs"> pack/packs </option>
                                  <option value="Piece/Pieces"> Piece/Pieces </option>
                                  <option value="Pound"> Pound </option>
                                  <option value="Set/Sets"> Set/Sets </option>
                                  <option value="Short Ton"> Short Ton </option>
                                </select>
                              &nbsp;per &nbsp;
                              <select name="time" class="textBox" style="width:90px;">
                                <option value="">Select Time</option>
                                <option value="Day"> Day </option>
                                <option value="Week"> Week </option>
                                <option value="Month"> Month </option>
                                <option value="Year"> Year </option>
                              </select>                            </td>
                          </tr>
                          <tr class="gbold">
                            <td width="33%" height="30" class="blackBo">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Delivery Time:</td>
                            <td height="30" class="inTxtNormal"><input name="p_deliverytime" type="text" class="textBox"></td>
                          </tr>
                          <tr class="gbold">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details&nbsp;&nbsp;(English)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails"></textarea>
                            </label></td>
                          </tr>
                          <tr class="gbold">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details&nbsp;&nbsp;(French)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails1"></textarea>
                            </label></td>
                          </tr>
						 <!-- <tr class="gbold">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details&nbsp;&nbsp;(Chinese)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails2"></textarea>
                            </label></td>
                          </tr>-->
						  <tr class="gbold">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000;">*</span> Packaging Details&nbsp;&nbsp;(Spanish)</td>
                            <td class="inTxtNormal"><label>
                              <textarea name="p_packagedetails3"></textarea>
                            </label></td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="center">
                                <!--<input name="feature_product" type="image" id="feature_product" value="Submit" src="../images/bu_submit.gif" />-->
                                <input type="submit" name="feature_product" value="Submit" />
                                &nbsp;&nbsp;<!--<input type="button" name="back" value="Back" onclick="javascript:history.back();"/>-->
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