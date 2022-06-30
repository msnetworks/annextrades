<?php 
include("includes/header.php");

if($session_user=="")
{

header("location:login.php");

}

 include("easythumbnail.class.php");
if(isset($_POST['submit']))
{
$p_name=$_POST['p_name'];
$p_keyword=$_POST['p_keyword'];
$p_cat=$_POST['p_cat'];
$p_subcategory=$_POST['subcategory'];
$country=$_POST['country'];
$p_photo=basename($_FILES['image']['name']);
$p_bdes=mysqli_real_escape_string($con, $_POST['p_bdes']);
$p_ddes=mysqli_real_escape_string($con, $_POST['detail_description']);
$p_price=$_POST['p_price'];
$range1=$_POST['range1'];
$range2=$_POST['range2'];
$p_miniquantity=$_POST['p_miniquantity'];
$p_quantity=$_POST['p_quantity'];
$p_capacity=$_POST['p_capacity'];
$capacity=$_POST['capacity'];
$time=$_POST['time'];
$payment=$_POST['payment'];
if($_SESSION['language']=='english')
{
$lang_status='0';

}
else if($_SESSION['language']=='french')
{
$lang_status='1';

}
else if($_SESSION['language']=='chinese')
{
$lang_status='2';
}
else
{
$lang_status='3';
}
if($payment=='')
{
$p=$_POST['others'];
}
else
{
$p=$payment;
}
$pro_capacity=$p_capacity;
//$range12=$_POST['range12'];
$p_deliverytime=$_POST['p_deliverytime'];
$p_packagedetails=$_POST['description'];

 $date=date("Y.m.d");
 
 $hh=$_SESSION['hh'];

$newfilename1=basename($_FILES['clg_0']['name']); 
$uploaddir1='productlogo/';
 $uploadfile1=$uploaddir1 . $newfilename1;
move_uploaded_file($_FILES['clg_0']['tmp_name'], $uploadfile1);
$ftimages1 = "blog_photo_thumbnail/".$newfilename1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

@$ftmp2 = $_FILES['clg_1']['tmp_name'];
@$oname2 = $_FILES['clg_1']['name'];
@$fname2 = $_FILES['clg_1']['name'];
$fsize2 = $_FILES['clg_1']['size'];
$ftype2 = $_FILES['clg_1']['type'];
$date2 =date("Y.m.d");
$newfilename2=basename($_FILES['clg_1']['name']);
$uploaddir2='productlogo/';
 $uploadfile2=$uploaddir2 . $newfilename2;
move_uploaded_file($_FILES['clg_1']['tmp_name'], $uploadfile2);
$ftimages2 = "blog_photo_thumbnail/".$newfilename2;
$thumb2= new EasyThumbnail($uploadfile2, $ftimages2, 120);

@$ftmp3 = $_FILES['clg_2']['tmp_name'];
@$oname3 = $_FILES['clg_2']['name'];
@$fname3 = $_FILES['clg_2']['name'];
$fsize3= $_FILES['clg_2']['size'];
$ftype3 = $_FILES['clg_2']['type'];
$date3 =date("Y.m.d");
echo $newfilename3=basename($_FILES['clg_2']['name']); 
$uploaddir3='productlogo/';
 $uploadfile3=$uploaddir3 . $newfilename3;
move_uploaded_file($_FILES['photos3']['tmp_name'], $uploadfile3);
$ftimages3 = "blog_photo_thumbnail/".$newfilename3;
$thumb3= new EasyThumbnail($uploadfile3, $ftimages3, 120);

@$ftmp4 = $_FILES['clg_3']['tmp_name'];
@$oname4 = $_FILES['clg_3']['name'];
@$fname4 = $_FILES['clg_3']['name'];
$fsize4= $_FILES['clg_3']['size'];
$ftype4 = $_FILES['clg_3']['type'];
$date4 =date("Y.m.d");
$newfilename4=basename($_FILES['clg_3']['name']);
$uploaddir4='productlogo/';
 $uploadfile4=$uploaddir4 . $newfilename4;
move_uploaded_file($_FILES['clg_3']['tmp_name'], $uploadfile4);
$ftimages4 = "blog_photo_thumbnail/".$newfilename4;
$thumb4= new EasyThumbnail($uploadfile4, $ftimages4, 120);

@$ftmp5 = $_FILES['clg_4']['tmp_name'];
@$oname5 = $_FILES['clg_4']['name'];
@$fname5 = $_FILES['clg_4']['name'];
$fsize5= $_FILES['clg_4']['size'];
$ftype5 = $_FILES['clg_4']['type'];
$date5 =date("Y.m.d");
$newfilename5=basename($_FILES['clg_4']['name']);
$uploaddir5='productlogo/';
 $uploadfile5=$uploaddir5 . $newfilename5;
move_uploaded_file($_FILES['clg_4']['tmp_name'], $uploadfile5);
$ftimages5 = "blog_photo_thumbnail/".$newfilename5;
$thumb5= new EasyThumbnail($uploadfile5, $ftimages5, 120);



  $insertquery="INSERT INTO `product` (`userid` , `p_name` , `p_keyword` , `p_category` ,`p_subcategory`,`country`,`p_photo`, `p_bdes` , `p_ddes` , `p_price` , `range1` , `range2` ,`paymenttype` ,`p_min_quanity` , `p_quanity_type` , `p_capaacity` , `p_ctype` , `percapacity` , `range12` , `p_delivertytime` , `p_packingdetails` ,`udate`,`expiredate`,`status`,`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`lang_status`)
VALUES (
 '$session_user', '$p_name', '$p_keyword', '$p_cat','$p_subcategory','$country','$newfilename1','$p_bdes', '$p_ddes', '$p_price', '$range1', '$range2','$p', '$p_miniquantity', '$p_quantity', '$pro_capacity', '$capacity', '$time', '', '$p_deliverytime', '$p_packagedetails'
,'$date','$expiredate','1','$newfilename1','$newfilename2','$newfilename3','$newfilename4','$newfilename5','$lang_status')"; 


mysqli_query($con,$insertquery);

header("location:my_products.php?suc");
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

function trim1(str)
{
	
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}
function validate(doc)
{
	if((trim1(document.product.p_name.value)=="")||(document.product.p_name.value==""))
	{
	alert("Please enter the product Name");
	document.product.p_name.focus();
	return false;
	}

	if((trim1(document.product.p_keyword.value)=="")||(document.product.p_keyword.value==""))
	{
	alert("Please enter the product keyword");
	document.product.p_keyword.focus();
	return false;
	}
	
	if(document.product.p_cat.value=="")
	{
	alert("Please enter the product Category");
	document.product.p_cat.focus();
	return false;
	}
	
	
	if(document.product.subcategory.value=="")
	{
	alert("Please enter the product SubCategory");
	document.product.subcategory.focus();
	return false;
	}
	
	if(document.product.country.value=="")
	{
	alert("Please enter the  Country");
	document.product.country.focus();
	return false;
	}
	
	
	if(document.product.p_bdes.value=="")
	{
	alert("Please Enter the product brief description");
	document.product.p_bdes.focus();
	return false;
	}
	
								var a=document.product.clg_0.value;
								var c=document.product.clg_1.value;
								var d=document.product.clg_2.value;
								var e=document.product.clg_3.value;
								var f=document.product.clg_4.value;
								
								//alert(c);
								//alert(d);
								if(a!="")
								{
								//alert(a);
								splt=a.split('.');
								chksplt=splt[1].toLowerCase();
								
								if(chksplt=='jpg' || chksplt=='jpeg'|| chksplt=='bmp'|| chksplt=='png'|| chksplt=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_0.value='';
								document.product.clg_0.focus();
								return false;
								}
								}
								
								
								
								if(c!="")
								{
								splt1=c.split('.');
								chksplt1=splt1[1].toLowerCase();
								
								if(chksplt1=='jpg' || chksplt1=='jpeg'|| chksplt1=='bmp'|| chksplt1=='png'|| chksplt1=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_1.value='';
								document.product.clg_1.focus();
								return false;
								}
								}
								
								
								if(d!="")
								{
								splt2=d.split('.');
								chksplt2=splt2[1].toLowerCase();
								
								if(chksplt2=='jpg' || chksplt2=='jpeg'|| chksplt2=='bmp'|| chksplt2=='png'|| chksplt2=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_2.value='';
								document.product.clg_2.focus();
								return false;
								}
								}
								
								
								if(e!="")
								{
								splt3=e.split('.');
								chksplt3=splt3[1].toLowerCase();
								
								if(chksplt3=='jpg' || chksplt3=='jpeg'|| chksplt3=='bmp'|| chksplt3=='png'|| chksplt3=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_3.value='';
								document.product.clg_3.focus();
								return false;
								}
								}
								
								if(f!="")
								{
								splt4=f.split('.');
								chksplt4=splt4[1].toLowerCase();
								
								if(chksplt4=='jpg' || chksplt4=='jpeg'|| chksplt4=='bmp'|| chksplt4=='png'|| chksplt4=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_4.value='';
								document.product.clg_4.focus();
								return false;
								}
								}
	
   if(document.product.p_price.value=="")
	{
		alert("Please Select the Currency");
		document.product.p_price.focus();
		return false;
	}
	
   if(document.product.range1.value=="")
	{
		alert("Please Enter the Minimum Range");
		document.product.range1.focus();
		return false;
	}
	
   if(isNaN(document.product.range1.value))
	{
		alert("Range from should be number only");
		document.product.range1.focus();
		return false;
	}
   if(document.product.range2.value=="")
	{
		alert("Please Enter the Maximum Range");
		document.product.range2.focus();
		return false;
	}
if(isNaN(document.product.range2.value))
	{
		alert("Range To should be number only");
		document.product.range2.focus();
		return false;
	}
	
  if(document.product.payment.value=="")
	{
		alert("Please Enter the Payment Terms");
		document.product.payment.focus();
		return false;
	}

	if(document.product.p_miniquantity.value=="")
	{
		alert("Please Enter the Quantity ");
		document.product.p_miniquantity.focus();
		return false;
	}
  if(isNaN(document.product.p_miniquantity.value))
	{
		alert("Quantity should be number only");
		document.product.p_miniquantity.focus();
		return false;
	}


if(document.product.p_capacity.value=="")
	{
		alert("Please Enter the Production Capacity");
		document.product.p_capacity.focus();
		return false;
	}
if(isNaN(document.product.p_capacity.value))
	{
		alert("Capacity should be number only");
		document.product.p_capacity.focus();
		return false;
	}

	if(document.product.capacity.value=="")
	{
		alert("Please Enter the Capacity Unit");
		document.product.capacity.focus();
		return false;
	}
	if(document.product.time.value=="")
	{
		alert("Please Enter the Time Of Production");
		document.product.time.focus();
		return false;
	}
	
	if(document.product.p_deliverytime.value=="")
	{
		alert("Please Enter the Delivery Time Of Production");
		document.product.p_deliverytime.focus();
		return false;
	}
	}
 


function show2(addcomments2)
{
	
 document.getElementById(addcomments2).style.display = "block";

}
function hide2(addcomments2)
{
	document.getElementById(addcomments2).style.display = "none";
}

</script>

<script src="js/add_delRow.js" type="text/javascript"></script>

 
<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > <?php echo $success_mail_msg; ?> </div>
<?php } ?>



<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div class="headinggg"> <?php echo $add_product; ?></div>
<form id="form1" name="product" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this);">
<table cellpadding="0" cellspacing="0" width="100%" style="height:300px;" >
<tr>
<td width="80%" valign="top" style="padding-left:50px;" ><table align="center"  cellpadding="3" cellspacing="6" width="100%">
 
<tr>
<td>
<p style="color:#00355D;"><strong><?php echo $basic_info; ?></strong></p></td></tr>
<tr><td><table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="200"><span class="mandory">*</span> <?php echo $pro_name; ?> </td><td width="100">:</td><td>
<input type="text" name="p_name" id="p_name" class="txtfield2" value="" /></td>
</tr>

<tr>
<td><span class="mandory">*</span> <?php echo $pro_keyword; ?> </td><td>:</td><td><input type="text" name="p_keyword" id="p_keyword" class="txtfield2" value="" /></td>
</tr>
<tr>
<td><span class="mandory">*</span> <?php echo $pro_cat; ?> </td><td>:</td><td><select name="p_cat" onchange="Javascript:FUNCTION1(this.value);" class="select1" >  
<option value=""><?php echo $sel_cat; ?></option>
<?php 
if($_SESSION['language']=='english')
{
$select_cate="SELECT * FROM category WHERE parent_id=''";
}
else if($_SESSION['language']=='french')
{
$select_cate="SELECT * FROM category_french WHERE parent_id=''";
}
else if($_SESSION['language']=='chinese')
{
$select_cate="SELECT * FROM category_chinese WHERE parent_id=''";
}
else
{
$select_cate="SELECT * FROM category_spanish WHERE parent_id=''";
}

$res_cate=mysqli_query($con,$select_cate);
while($fetch_cate=mysqli_fetch_array($res_cate))
{
?>
<option value="<?php echo $fetch_cate['c_id']; ?>"><?php echo $fetch_cate['category']; ?></option>
<?php } ?>

</select></td>
</tr>

<tr>
<td><span class="mandory">*</span> <?php echo $sel_pro_cat; ?> </td><td>:</td><td>

<div id="subcat12">
<select name="subcategory"  class="select1">  
<option value=""><?php echo $sel_sub_cat; ?></option>


</select>
</div></td>
</tr>
<!--<tr>
<td>Email </td><td>:</td><td><?php echo $fetch_log['email']; ?></td>
</tr>-->

<tr>
<td><span class="mandory">*</span> <?php echo $country; ?> </td><td>:</td><td>
<select name="country"  class="select1"> 
<option value=""><?php echo $sel_con; ?></option>
<?php
$select_con="SELECT * FROM country";
$res_con=mysqli_query($con,$select_con);
while($fetch_con=mysqli_fetch_array($res_con))
{
?> 
<option value="<?php echo $fetch_con['country_id']; ?>"><?php echo $fetch_con['country_name']; ?></option>
<?php } ?>
</select></td>
</tr>

<tr>
<td><span class="mandory">*</span> <?php echo $breif_des; ?> </td><td>:</td><td>
<textarea name="p_bdes" id="p_bdes" class="txtarea1" ></textarea></td>
</tr>
</table></td></tr>

<tr>
<td>

<p style="color:#00355D;"><strong><?php echo $add_product_photo; ?></strong></p></td></tr>
<tr>

<td><table cellpadding="0" cellspacing="0" width="100%" id="dataTable">


<tr>
<td width="200"><?php echo $photos; ?></td><td width="100">:</td><td><input type="file" name="clg_0" id="clg_0" size="40" value="" onKeyDown="return chkkeycode(event,this.id)" class="textarea" /> <div id="b_0_err" style="display:none; color:#FF3300;"></div>
							</td>
							  <td width="30"><img src="plus_icon.png" border="0" onClick="addRow_new('dataTable','clg','clgfrm','clgto')" title="Add New Point" /></td>
</tr>
</table></td></tr>

<tr>
<td>

<p style="color:#00355D;"><strong><?php echo $add_detailed_pro; ?></strong></p></td></tr>
<tr>

<td><table cellpadding="0" cellspacing="0" width="100%">


<tr>
<td width="200"><?php echo $detail_des;?></td><td width="100">:</td><td><textarea name="detail_description" id="detail_description" class="texteditor"  ></textarea></td>
</tr>
</table></td></tr>



<tr>
<td>
<br />
<p style="color:#00355D;"><strong><?php echo $sel_payment_shipping;?></strong></p></td></tr>
 
<tr><td><table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="200"><span class="mandory">*</span><?php echo $price_range; ?> </td><td width="100">:</td><td><select name="p_price"  class="txtfield_small">
                                                                      <option value=""><?php echo $currency; ?></option>
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
                                                                      <option value="Other"><?php echo $other; ?> </option>
                                                                    </select>
																	&nbsp;&nbsp;
																	<input type="text" name="range1" class="txtfield_small"/>
                                                                    &nbsp;~&nbsp;
                                                                    <input type="text" name="range2" class="txtfield_small"/></td>
</tr>
<tr>
<td><span class="mandory">*</span><?php echo $payment_terms; ?> </td><td>:</td><td>
<input name="payment" type="radio" value="L/C"  checked="checked"  id="free1" onclick="javascript:hide2('addcomments2');" />
<span style="font-size:12"><?php echo $lc;?></span>
<input name="payment" type="radio" value="D/A"  onclick="javascript:hide2('addcomments2');" />
<span style="font-size:12"><?php echo $da; ?> </span>
<input name="payment" type="radio" value="D/P"  onclick="javascript:hide2('addcomments2');" />
<span style="font-size:12"><?php echo $dp; ?></span>
<input name="payment" type="radio" value="T/T"   onclick="javascript:hide2('addcomments2');"/>
<span style="font-size:12"><?php echo $tt; ?></span>
<input name="payment" type="radio" value="Western Union"   onclick="javascript:hide2('addcomments2');"/>
<span style="font-size:12"><?php echo $western_union; ?></span>
<input name="payment" type="radio" value="MoneyGram"   onclick="javascript:hide2('addcomments2');" />
<span style="font-size:12"><?php echo $money_gram; ?></span>
<input name="payment" type="radio" value=""  onclick="javascript:show2('addcomments2');" />
<span style="font-size:12"> <?php echo $others; ?></span></td>
</tr>
<tr>
<td>&nbsp; </td><td>&nbsp;</td><td><div id="addcomments2" style="display:none" ><input type="text" name="others" id="others" class="txtfield2" value="" /></div></td>
</tr>

<tr>
<td><span class="mandory">*</span><?php echo $minimum_order_qua; ?></td><td>:</td><td><input type="text" name="p_miniquantity" class="textBoxSi" /> <select name="p_quantity" class="textBoxSi">
			<option value="Unit"><?php echo $Unit; ?></option>
			<option value="Bag/Bags"><?php echo $bag; ?> </option>
			<option value="Barrel/Barrels"><?php echo $barrel; ?></option>
			<option value="Bushel/Bushels"><?php echo $Bushel; ?></option>
			<option value="Cubic Meter"><?php echo $cubic_meter; ?></option>
			<option value="Dozen"><?php echo $Dozen; ?></option>
			<option value="Gallon"><?php echo $Gallon; ?></option>
			<option value="Gram"><?php echo $Gram; ?> </option>
			<option value="Kilogram"><?php echo $Kilogram; ?> </option>
			<option value="Kilometer"><?php echo $Kilometer; ?></option>
			<option value="Long Ton"><?php echo $long_ton;?> </option>
			<option value="Meter"><?php echo $Meter; ?> </option>
			<option value="Metric Ton"><?php echo $metric_ton; ?> </option>
			<option value="Ounce"><?php echo $Ounce; ?> </option>
			<option value="Pair"><?php echo $Pair; ?> </option>
			<option value="Pack/Packs"><?php echo $pack; ?> </option>
			<option value="Piece/Pieces"><?php echo $pieces; ?> </option>
			<option value="Pound"><?php echo $pound; ?></option>
			<option value="Set/Sets"><?php echo $set; ?></option>
			<option value="Short Ton"><?php echo $short_ton; ?> </option>
			<option value="Square Meter"><?php echo $squre_meter; ?> </option>
			<option value="Ton"><?php echo $ton; ?></option>
			</select> </td>
</tr>


</table></td></tr>

<tr>
<td>
<br />
<p style="color:#00355D;"><strong><?php echo $show_buy_abil; ?></strong></p></td></tr>

<tr><td><table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="200"><span class="mandory">*</span><?php echo $production_capacity; ?> </td><td width="100">:</td><td>
				<input type="text" name="p_capacity" class="txtfield_small"  maxlength="6"/>
			    <select name="capacity" class="txtfield_small" >
				<option value=""><?php echo $sel_unit_type; ?></option>
				<option value="Bag/Bags"><?php echo $bag; ?> </option>
				<option value="Barrel/Barrels"><?php echo $barrel; ?> </option>
				<option value="Cubic Meter"><?php echo $cubic_meter; ?> </option>
				<option value="Dozen"><?php echo $Dozen; ?> </option>
				<option value="Gallon"><?php echo $Gallon; ?></option>
				<option value="Gram"><?php echo $Gram; ?> </option>
				<option value="Kilogram"><?php echo $Kilogram; ?> </option>
				<option value="Kilometer"><?php echo $Kilometer;?> </option>
				<option value="Long Ton"><?php echo $long_ton; ?> </option>
				<option value="Meter"><?php echo $Meter; ?> </option>
				<option value="Mertic Ton"><?php echo $metric_ton; ?> </option>
				<option value="Ounce"><?php echo $Ounce; ?> </option>
				<option value="Pair"><?php echo $Pair; ?></option>
				<option value="pack/packs"><?php echo $pack; ?> </option>
				<option value="Piece/Pieces"><?php echo $pieces; ?> </option>
				<option value="Pound"><?php echo $pound; ?></option>
				<option value="Set/Sets"><?php echo $set; ?> </option>
				<option value="Short Ton"><?php echo $short_ton; ?></option>
			  </select>
			  <span style="font-size:12"> &nbsp;<font style="color:#FF0000;">*</font><?php echo per; ?>&nbsp;</span>
			  <select name="time" class="txtfield_small">
				<option value=""><?php echo $time; ?></option>
				<option value="Day"><?php echo $day; ?></option>
				<option value="Week"><?php echo $week; ?></option>
				<option value="Month"><?php echo $month; ?></option>
				<option value="Year"><?php echo $year; ?></option>
			  </select> </td>
</tr>
<tr>
<td><span class="mandory">*</span><?php echo $delivery_time; ?> </td><td>:</td><td><input type="text" name="p_deliverytime" id="p_deliverytime" class="txtfield2" value="" /></td>
</tr>
<tr>
<td><?php echo $packaging_details;?> </td><td>:</td><td><textarea name="description" id="description" class="txtarea1" ></textarea></td>
</tr>
</table></td></tr>

<tr>

<td><input type="submit" name="submit" value="<?php echo $submit; ?>" ></td>

</tr>

</table></td>
<!--<td width="50%" valign="top"><table cellpadding="3" cellspacing="3" width="100%" >
<tr>
<td>Firstname </td><td>:</td><td><?php //echo $firstname; ?></td>
</tr>
</table>
</td>-->
</tr>
</table>
</form>
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
