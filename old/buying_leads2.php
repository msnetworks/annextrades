<?php 
include("includes/header.php");

//session_start();
$today=date("F j, Y");
date('Y-m-d');
$today=date("F j, Y");

if(isset($_REQUEST['Submit']))
{

$subject=$_REQUEST['subject'];
$keyword=$_REQUEST['keyword'];
$keyword1=$_REQUEST['keyword1'];
$keyword2=$_REQUEST['keyword2'];
$category=$_REQUEST['p_cat'];
//echo "<BR>";
$subcategory=$_REQUEST['sub_cat'];
//echo "<BR>";
$briefdes=$_REQUEST['briefdes'];
$detdes=$_REQUEST['detdes'];
$purchase=$_REQUEST['purchase'];
$valid=$_REQUEST['valid'];

if($valid=='1 Week')
$expired = date("F j, Y", strtotime("+1 week"));
if($valid=='2 Weeks')
$expired = date("F j, Y", strtotime("+14 days"));
if($valid=='1 Month')
$expired = date("F j, Y", strtotime("+1 month"));
if($valid=='2 Months')
$expired = date("F j, Y", strtotime("+2 months"));
if($valid=='4 Months')
$expired = date("F j, Y", strtotime("+4 months"));
if($valid=='6 Months')
$expired = date("F j, Y", strtotime("+6 months"));
if($valid=='12 Months')
$expired = date("F j, Y", strtotime("+12 months"));



$mycontact=$_REQUEST['mycontact'];
$price=$_REQUEST['price'];
$range1=$_REQUEST['range1'];
$range2=$_REQUEST['range2'];
$miniquantity=$_REQUEST['miniquantity'];
$quantity=$_REQUEST['quantity'];
$certificate=$_REQUEST['certificate'];
$company = $_REQUEST['companyname'];
$address = $_POST['streetaddress'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		
	 $up_date= date("d.m.y");
	
$newfilename=basename($_FILES['userfile']['name']);
$uploaddir='upload/';
$uploadfile=$uploaddir . $newfilename;
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
{
echo "uploaded successfully";
}
else
{
echo "error";
}
$ftimages = "blog_photo_thumbnail/".$newfilename;
//$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

$select_buy="select * from registration where id='$session_user'";

$select_query=mysqli_query($con,$select_buy);

$select_count=mysqli_num_rows($select_query);

$select_fetch=mysqli_fetch_array($select_query);

$country = $select_fetch['country'];

$buyid=$select_fetch['id'];

$idd=$session_user;

$post_id=$_SERVER['REMOTE_ADDR'];

 $res1="insert into buyingleads (id, subject, photo, keyword, keyword1, keyword2, category, subcategory, briefdes, detdes, purchase, valid, mycontact, price, range1, range2, miniquantity, quantity, certificate, ver_code, update_date, expiredate,  up_date, companyname, streetaddress, city, state, country, zip, status) values ('$idd', '$subject', '$newfilename', '$keyword', '$keyword1', '$keyword2', '$category', '$subcategory', '$briefdes', '$detdes', '$purchase', '$valid', '$mycontact', '$price', '$range1', '$range2', '$miniquantity', '$quantity', '$certificate', '$ver_code', '$today','$expired',  '$up_date', '$company', '$address','$city','$state','$country','$zip','1')"; 

$result_sql1=mysqli_query($con,$res1) or die("insert error");

$selecttrade=mysqli_query($con,"select * from trade_alert where (keyword like '$subject%' or keyword like '$keyword' or keyword like '$keyword1' or keyword like '$keyword2') and  selectinfo='buyingleads'");

while($rowfetch=mysqli_fetch_array($selecttrade))
{
$tradeuserid=$rowfetch['user_id'];
$selectreg=mysqli_query($con,"select * from registration where id='$tradeuserid'");
$fetchreg=mysqli_fetch_array($selectreg);
$em=$fetchreg['email'];
$Firstname=$fetchreg['firstname'];
$selectreg1=mysqli_query($con,"select * from registration where id='$sess_id'");
$fetchreg1=mysqli_fetch_array($selectreg1);
$em1=$fetchreg1['email'];
$sub=$subject;
$msg=
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
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Dear $Firstname,</span></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">I have already a member in $webname. And given below for the my detail description of purchase Requirement.</span> </td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
    
  </tr>
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">Detail description in my Buying leads</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $briefdes</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\">$detdes</span></td>
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

$headers = 'From:' . $em1 ."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($em,$sub,$msg,$headers);

}

if($result_sql1)
{
header("location:buying_leads.php");
}

}
 ?>
 <script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
 <script type="text/javascript" src="admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		
		mode : "specific_textareas",
		editor_selector : "texteditor",
		mode:"textareas",
		theme : "advanced",
		editor_deselector : "noeditor",
		/*mode : "textareas",
		theme : "advanced",*/
		width : 450,
		height : 150,
		
    	plugins : "style,layer,save,paste,advlist,autosave",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
		theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,link,unlink,anchor",
		
		theme_advanced_buttons3 : "formatselect,fontselect,fontsizeselect",
		
	

	

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

	});
	</script> 
	
	<script type="text/javascript">

function validate(doc)
{
var fnam=document.buying.userfile.value;

if(document.buying.subject.value=="")
{
alert("Please enter the Buying Lead Headline");
document.buying.subject.focus();
return false;
}

if(fnam!="")
{
splt=fnam.split('.');
chksplt=splt[1].toLowerCase();

if(chksplt=='jpg' || chksplt=='jpeg'|| chksplt=='bmp'|| chksplt=='png'|| chksplt=='gif'){

}else{
alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
document.buying.userfile.value='';
document.buying.userfile.focus();
return false;
}

}


var key=document.buying.keyword.value;
if(key=="")
{
alert("Please enter the keyword");
document.buying.keyword.focus();
return false;
}
var noalpha = /^[a-zA-Z ]*$/;
var key1=document.buying.keyword1.value;
var key2=document.buying.keyword2.value;

if(key1!="")
{
	if (!noalpha.test(key1)) {
     alert("Special Characters Are Not Allowed In Keyword1 .");
	 document.buying.keyword1.value="";
	 document.buying.keyword1.focus();
     return false;
	}
}

if(key2!="")
{
	if (!noalpha.test(key2)) {
     alert("Special Characters Are Not Allowed In Keyword2 .");
	 document.buying.keyword2.value="";
	 document.buying.keyword2.focus();
     return false;
	}
}
if(document.buying.p_cat.value=="")
{
alert("Please select the category");
document.buying.p_cat.focus();
return false;
}


if(document.buying.sub_cat.value=="")
{
alert("Please select the subcategory");
document.buying.sub_cat.focus();
return false;
}

if(document.buying.briefdes.value=="")
{
alert("Please enter the Brief description");
document.buying.briefdes.focus();
return false;
}

if(document.buying.valid.value=="")
{
alert("Please select the Valid days");
document.buying.valid.focus();
return false;
}
if(document.buying.mycontact.value=="")
{
alert("Please select the Mycontact");
document.buying.mycontact.focus();
return false;
}
if(document.buying.price.value=="")
{
alert("Please select the Currency Type");
document.buying.price.focus();
return false;
}
if((document.buying.range1.value=="")|| (document.buying.range1.value <= 0))
{
	 alert("Please Enter Price Range1");
	   document.buying.range1.focus();
	   return false
}
if(isNaN(document.buying.range1.value))
 {
       alert("Please Enter Number only");
	   document.buying.range1.focus();
	   return false
 } 
if((document.buying.range2.value=="")|| (document.buying.range2.value <= 0))
{
 alert("Please Enter Price Range2");
	   document.buying.range2.focus();
	   return false

 

}
if(isNaN(document.buying.range2.value))
 {
       alert("Please Enter Number only");
	   document.buying.range2.focus();
	   return false
 } 
  if(parseInt(document.buying.range2.value) <= parseInt(document.buying.range1.value))
 {
 alert("The Max Range Should Be Greater than Min Ramnge");
   document.buying.range2.focus();
	   return false
 }
if(document.buying.miniquantity.value=="")
{
 alert("Please Enter Minimum Quantity");
	   document.buying.miniquantity.focus();
	   return false

}
if(isNaN(document.buying.miniquantity.value)|| (document.buying.miniquantity.value <= 0))
 {
       alert("Please Enter Number only");
	   document.buying.miniquantity.focus();
	   return false
 } 
 
 
 if(document.buying.quantity.value=="Unit")
{
 alert("Please Enter Quantity Unit ");
	   document.buying.quantity.focus();
	   return false

}

}


</script>
 
<script type="text/javascript">
function doPreview() {
              var newwin = window.open("buying_preview.php");   
   //var newWin = window.open("", "Preview","width=500,height=300");
   //var newWin = "buying_preview.php"
   newWin.document.write("<html><body>"+document.getElementById('detdes').value, document.getElementById('price').value, document.getElementById('range1').value+"</body></html>");
  newWin.document.close();
}

function textCounter(field, countfield, maxlimit) {

if (field.value.length > maxlimit) // if the current length is more than allowed
field.value =field.value.substring(0, maxlimit); // don't allow further input
else
countfield.value = maxlimit - field.value.length;}
</script> 
 
<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > Confirmation Mail Sent To Your Email </div>
<?php } ?>



<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"><strong> <?php echo $add_buy; ?></strong></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<form id="buying" name="buying" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this)">
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #0075b0; padding-left:50px;">
                              <tr>
                                <td  height="25" style="padding:5px;" class="normalbold"><strong><?php echo $basic_info; ?></strong></td>
                                <td align="right" valign="middle"  style="padding:5px;"><span style="color:#FF0000">*</span>Required information</td>
                              </tr>
                              <tr>
                                <td width="28%" height="30" class="seller"><span style="color:#FF0000">*</span><?php echo $buying_headline; ?></td>
                                <td width="72%" height="30"><input type="text" name="subject" class="txtfield2" />                                </td>
                              </tr>
                              <tr>
                                <td height="30" class="seller"><?php echo $attachment_product_photo; ?></td>
                                <td height="30"><input type="file" name="userfile" id="userfile"  />
                                  <br />
                                  <span class="textsmall" id="notice"></span></td>
                              </tr>
                              
                              <tr>
                                <td height="30" class="seller"><span style="color:#FF0000">*</span><?php echo $keyword; ?></td>
                                <td height="30"><input type="text" name="keyword" class="txtfield2" /></td>
                              </tr>
                              <tr>
                                <td height="30" class="seller">&nbsp;&nbsp;&nbsp;<?php echo $more_kewords; ?></td>
                                <td height="30"><input type="text" name="keyword1" class="txtfield2_new" maxlength="20" style="width:163px;" />
                                  <input type="text" name="keyword2" class="txtfield2_new" maxlength="20" style="width:163px;"/></td>
                              </tr>
                              <tr>
                                <td height="30" class="seller"><span style="color:#FF0000">*</span><?php echo $category; ?></td>
                                <td height="30">
						<select name="p_cat" id="city"  onchange="FUNCTION1(this.value);" class="txtfield2">
						  <option value=""><?php echo $category; ?></option>
						  <?php 
						  $select_cate="SELECT * FROM category WHERE parent_id=''";
						  $res_cate=mysqli_query($con,$select_cate);
						  while($fetch_catw=mysqli_fetch_array($res_cate))
						  {					  
						  ?>
						  <option value="<?php echo $fetch_catw['c_id']; ?>"><?php echo $fetch_catw['category']; ?></option>
						  <?php } ?>
                        
                       </select></td>
                              </tr>
							  <tr>
							    <td height="30" class="seller"><span style="color:#FF0000">* </span><?php echo $sub_cat; ?></td>
							    <td height="30">
								<div id="subcat12">
								<select name="subcategory" class="txtfield2">
							   <option value=""><?php echo $sub_cat; ?></option>
							    </select>
								</div>			<input type="hidden" name="sub_cat" value="" />				  </td></tr> 
                              <tr>
                                <td class="seller"><span style="color:#FF0000">*</span><?php echo $breif_des; ?> </td>
                                <td style="padding:10px"><textarea name="briefdes" cols="40" class="txtarea1" rows="3" onkeydown="textCounter(this.form.briefdescription, this.form.remLen,128);"
onkeyup="textCounter(this.form.briefdescription, this.form.remLen,128); "></textarea><br />
max <span class="redbold" id="newcharcount">  <input name="remLen" type="text" id="remLen" value="128" size="3" maxlength="3" readonly="readonly" /> </span> <?php echo $char_left; ?></td> <!--onkeyup="document.getElementById('newcharcount').innerHTML=this.value.length ;"  -->
                              </tr>
                              <tr>
                                <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo$detail_des; ?></td>
                                <td>
<!--<input type="text" name="detdes1" onkeypress="javascript:alert('Hi');"/> -->
<!--<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>-->
<textarea name="detdes" id="detdes" class="texteditor"  ></textarea><br />


<!--<textarea rows="6" name="detdes" cols="45" ID="7" onkeyup="javascript:document.buying.detdes1.value=this.value;" onchange="javascript:document.buying.detdes1.value=this.value;"></textarea>-->

<!--<script language="JavaScript">
generate_wysiwyg('7');
</script>--></td>
                              </tr>
                             
                              <tr>
                                <td height="30" class="seller"><span style="color:#FF0000">*</span><?php echo $expired_date; ?></td>
                                <td height="30"><select name="valid" class="txtfield2" >
                                    <option value=""><?php echo $sel; ?></option>
									<option value="1 Week"><?php echo $one_week; ?></option>
									<option value="2 Weeks"><?php echo $weeks2; ?></option>
									<option value="1 Months"><?php echo $month1; ?></option>
									<option value="2 Months"><?php echo $months2; ?></option>
									<option value="4 Months"><?php echo $months4; ?></option>
										<option value="6 Months"><?php echo $months6; ?></option>
                                    <option value="12 Months"><?php echo $months12; ?></option>
                                    
                                  </select>                                </td>
                              </tr>
                              <tr>
                                <td> <span style="color:#FF0000">*</span><?php echo $contact_preference; ?></td>
                                <td><input name="mycontact" type="radio" value="Allowall suppliers to contact me(More quotations)" checked="checked"/>
                                <?php echo $allow_more; ?></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input name="mycontact"  type="radio" value="Allow all suppliers to contact me by email only while concealing my other contact details" />
                                <?php echo $allow_supliers; ?></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input name="mycontact"  type="radio" value="Only paid suppliers may contact me(Less quotations)" />
                                <?php echo $less_only; ?></td>
                              </tr>
                              <tr>
                                <td colspan="2"><table width="100%">
                                    <tr>
                                      <td colspan="3" class="normalbold"  style="padding:5px; "><strong><?php echo $my_reqirement; ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td width="28%" class="seller">&nbsp;&nbsp;<span style="color:#FF0000">*</span>&nbsp;<?php echo $price_range; ?></td>
                                      <td colspan="2"><select name="price" id="price"  class="txtfield_small" >
                                          <option value=""><?php echo $currency; ?></option>
                                          <option value="USD"><?php echo $usd; ?> </option>
                                          <option value="GBP"> <?php echo $GBP; ?> </option>
                                          <option value="RMB"> <?php echo $RMB; ?> </option>
                                          <option value="EUR"> <?php echo AUD; ?> </option>
                                          <option value="AUD"> <?php echo $AUD; ?> </option>
                                          <option value="CAD"> <?php echo $CAD; ?> </option>
                                          <option value="CHF"> <?php echo $CHF; ?> </option>
											  <option value="JPY"> <?php echo JPY; ?> </option>
                                          <option value="HKD"> <?php echo $HKD; ?> </option>
                                          <option value="NZD"> <?php echo $NZD; ?> </option>
                                          <option value="SGD"> <?php echo $SGD; ?> </option>
                                          <option value="OTHER"> <?php echo $OTHER; ?> </option>
                                        </select>
                                        <input type="text" name="range1" id="range1"  class="txtfield_small" />&nbsp;~&nbsp;                                        
                                        <input type="text" name="range2" id="range2"  class="txtfield_small" /></td>
                                  </tr>
                                    <tr>
                                      <td class="seller">&nbsp;<span style="color:#FF0000">*</span>&nbsp;   <?php echo $minimum_order_qua; ?></td>
                                      <td width="19%"><input type="text" name="miniquantity" id="miniquantity"class="txtfield_small" style="width:163px;" /></td>
                                      <td width="53%">&nbsp;&nbsp;&nbsp;
                                        <select name="quantity" id="quantity" class="txtfield_small" style="width:140px;">
                                          <option value="Unit"><?php echo $Unit; ?></option>
                                          <option value="Bag/Bags"><?php echo $bag; ?> </option>
											  <option value="Barrel/Barrels"> <?php echo $barrel; ?> </option>
                                          <option value="Bushel/Bushels"> <?php echo $Bushel; ?></option>
                                          <option value="Cubic meter"> <?php echo $cubic_meter; ?> </option>
                                          <option value="Dozen"> <?php echo $Dozen; ?></option>
                                          <option value="Gallon"> <?php echo $Gallon; ?></option>
                                          <option value="Gram"> <?php echo $Gram; ?> </option>
                                          <option value="Kilogram"> <?php echo $Kilogram; ?> </option>
                                          <option value="Kilometer"> <?php echo $Kilometer; ?> </option>
                                          <option value="Long Ton"> <?php echo $long_ton; ?> </option>
                                          <option value="Meter"> <?php echo $Meter; ?> </option>
                                          <option value="Metric Ton"> <?php echo $metric_ton; ?> </option>
                                          <option value="Ounce"> <?php echo $Ounce; ?> </option>
                                          <option value="Pair"> <?php echo $Pair; ?> </option>
                                          <option value="Pack/Packs"> <?php echo $pack; ?> </option>
                                          <option value="Piece/Pieces"> <?php echo $pieces;?> </option>
                                          <option value="Pound"> <?php echo $pound; ?> </option>
                                          <option value="Set/Sets"><?php echo $set; ?></option>
                                          <option value="Short Ton"> <?php echo $short_ton; ?> </option>
                                          <option value="Square Meter"> <?php echo $squre_meter; ?> </option>
                                          <option value="Ton"> <?php echo $ton; ?> </option>
                                        </select>                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $certificat_require; ?></td>
                                      <td colspan="2"><textarea name="certificate" class="txtarea1" cols="35"></textarea></td>
                                    </tr>
									<?php
												
														$profilesql = mysqli_query($con,"select * from registration where id='$session_user'");
														
												
														$profilefetch = mysqli_fetch_array($profilesql);
														
													
														
											
												?>
                                    <tr>
                                      <td class="normalbold">&nbsp;&nbsp;<strong><?php echo $com_address; ?></strong></td>
                                      <td colspan="2">&nbsp;</td>
                                    </tr>
									<tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $company_name; ?> </td>
                                      <td colspan="2"><input type="text" name="companyname" class="txtfield2" value="<?php echo $profilefetch['companyname']; ?>" readonly="" /></td>
                                    </tr>
                                    <tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $street_address; ?></td>
                                      <td colspan="2"><input type="text" name="streetaddress" class="txtfield2" value="<?php echo $profilefetch['street']; ?>" readonly="" /></td>
                                    </tr>
                                    <tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $city; ?></td>
                                      <td colspan="2"><input type="text" name="city" class="txtfield2" readonly="" value="<?php echo $profilefetch['city']; ?>" /></td>
                                    </tr>
                                    <tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $state; ?></td>
                                      <td colspan="2"><input type="text" name="state" class="txtfield2" readonly="" value="<?php echo $profilefetch['state'];?>" /></td>
                                    </tr>
									<?php
											  $country =$profilefetch['country'];
					                         $sql_rr=mysqli_query($con,"select * from `country` where  country_id='$country'");   							                                             $row = mysqli_fetch_array($sql_rr); 
					                          ?>    
                                    <tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $country1; ?></td>
                                      <td colspan="2"><input type="text" name="country" class="txtfield2" readonly="" value="<?php echo $row['country_name'];?>" /></td>
                                    </tr>
                                    <tr>
                                      <td class="seller">&nbsp;&nbsp;&nbsp;<?php echo $zip_code; ?>									  </td>
                                      <td colspan="2"><input type="text" name="zip" readonly="" class="txtfield2" value="<?php echo $profilefetch['zipcode'];?>" /></td>
                                    </tr>
                                </table></td>
                              </tr>
                        <!--  <onclick="switchDiv('tabTwo','tabOne'), swapTabs('tab2');">
						onclick="switchDiv('tabOne','tabTwo'), swapTabs('tab1');"-->
                              <tr>
                                <td colspan="2" align="center"><!--<input name="Submit" type="image" class="button2" value="Submit" src="images/bu_submit.gif" />-->
                                  <input type="submit" class="search_bg" name="Submit" value="<?php echo $submit; ?>" />
                                 <!-- <a href="buying_preview.php"></a>--></td>
                              </tr>
                            </table></form>

<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
