<?php 
include("includes/header.php");
mysqli_set_charset($con, "utf8_unicode_ci");
if($session_user=="")
{

header("location:login.php");
include ('controller/config.php');
}

$pro_id=$_GET['id'];

$select_pro="SELECT * FROM product WHERE id='$pro_id' ";
$res_pro=mysqli_query($con,$select_pro);
$fetch_pro=mysqli_fetch_array($res_pro);

 
 ?>
 
<script>
		function loadXMLDoc(idd)
		{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ajax_photo.php?id="+idd,true);
		xmlhttp.send();
		}
</script>
 
	
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

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
			
			
			/*if(document.product.p_bdes.value=="")
			{
			alert("Please Enter the product brief description");
			document.product.p_bdes.focus();
			return false;
			}*/
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



 
<?php
	if(isset($_REQUEST['succ'])) { ?>
		<div style="padding-left:300px; color:#009900; font-weight:bold;" > <?php echo $success_mail_msg; ?> </div>
<?php } ?>



	<div class="body-cont">
		<div class="body-cont1"> 
			<div class="company__container">
				<?php include("includes/side_menu.php"); ?>
					<div class="body-right"> 
						<?php include("includes/menu.php"); ?>
						<?php 
						$user_type=$fetch_log['usertype']; 
						if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
						?>
						<div class="tabs-cont"> 
							<div class="left">
								<div style="border:1px solid #F0EFF0;" class="bordersty">
									<form id="form1" name="product" method="post" action="controller/edit_product.php?id=<?php echo $pro_id; ?>" enctype="multipart/form-data" onsubmit="return validate(this);">
										<table cellpadding="0" cellspacing="0" width="100%" style="height:300px;" >
											<tr>
												<td width="80%" valign="top" style="padding-left:50px;" >
													<table align="center"  cellpadding="3" cellspacing="6" width="100%">
														<tr>
															<td><br />
																<p style="color:#00355D;"><strong> <?php echo $basic_info; ?></strong></p>
															</td>
														</tr>
														<tr>
															<td><span class="mandory">*</span> <?php echo $pro_name; ?></td>
															<td>:</td>
															<td>
																<input type="text" name="p_name" id="p_name" class="txtfield2" value="<?php echo $fetch_pro['p_name']; ?>" />
															</td>
														</tr>
														<tr>
														<tr>
															<td><span class="mandory">*</span> <?php echo $pro_keyword; ?></td><td>:</td><td><input type="text" name="p_keyword" id="p_keyword" class="txtfield2" value="<?php echo $fetch_pro['p_keyword']; ?>" /></td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span> <?php echo $pro_cat; ?> 
															</td>
															<td>:</td>
															<td>
																<select name="p_cat" onchange="Javascript:FUNCTION1(this.value);" class="select1" >  
																	<option value=""><?php echo $sel_cat; ?></option>
																		<?php 
																			$select_cate="SELECT * FROM category WHERE parent_id=''";
																			$res_cate=mysqli_query($con,$select_cate);
																			while($fetch_cate=mysqli_fetch_array($res_cate))
																			{
																			if($fetch_pro['p_category']==$fetch_cate['c_id'])
																			{
																			$selected="SELECTED";

																			}else
																			{
																			$selected="";
																			}
																		?>
																	<option value="<?php echo $fetch_cate['c_id']; ?>" <?php echo $selected; ?>><?php echo $fetch_cate['category']; ?></option>
																	<?php } ?>
																</select>
															</td>
														</tr>
														<tr>
															<td><span class="mandory">*</span> <?php echo $sel_pro_cat; ?> </td>
															<td>:</td>
															<td>

																<div id="subcat12">
																	<select name="subcategory"  class="select1">  
																		<option value=""><?php echo $sel_sub_cat; ?></option>
																			<?php 
																				$cat_id=$fetch_pro['p_subcategory'];
																				$select_sub_cat="SELECT * FROM category WHERE c_id='$cat_id'";
																				$res_sub_cat=mysqli_query($con,$select_sub_cat);
																				while($fetch_sub=mysqli_fetch_array($res_sub_cat))
																				{
																				if($fetch_pro['p_subcategory']==$fetch_sub['c_id'])
																				{
																				$selected1="SELECTED";
																				}
																				else
																				{
																				$selected1="SELECTED";

																				}
																			?>
																		<option value="<?php echo $fetch_sub['c_id']; ?>" <?php  echo $selected1; ?>><?php echo $fetch_sub['category']; ?></option>
																		<?php } ?>	
																	</select>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span> <?php echo $country; ?> </td>
															<td>:</td>
															<td>
																<select name="country"  class="select1"> 
																	<option value=""><?php echo $sel_con; ?></option>
																	<?php
																	$select_con="SELECT * FROM country";
																	$res_con=mysqli_query($con,$select_con);
																	while($fetch_con=mysqli_fetch_array($res_con))
																	{
																	if($fetch_pro['country']==$fetch_con['country_id'])
																	{
																	$selected2="SELECTED";
																	}
																	else
																	{
																	$selected2="";
																	}
																	?> 
																	<option value="<?php echo $fetch_con['country_id']; ?>" <?php echo $selected2; ?>><?php echo $fetch_con['country_name']; ?></option>
																	<?php } ?>
																</select>
															</td>
														</tr>

														<tr>
															<td><span class="mandory">*</span> <?php echo $breif_des; ?> </td>
															<td>:</td>
															<td>
																<?php 
																	$bdes= $fetch_pro['p_bdes'];
																?>
																<textarea name="p_bdes" id="editor"><?php  echo htmlspecialchars_decode( $bdes );?></textarea>
																<script>
																	CKEDITOR.replace( 'editor' );
																</script>
															</td>
														</tr>
														<tr>
															<td>
																<br />
																<p style="color:#00355D;"><strong> <?php echo "Add Photos"; ?></strong></p>
															</td>
														</tr>
															<?php
															if($fetch_pro['photo1'])
															{
															?>
														<tr>
															<td>
																<p style="color:#00355D;"> <?php echo "Photo1"; ?></p>
															</td>
															<td>:</td>
															<td>
																<input type="hidden" name="pho1"  readonly="true" value="<?php echo $fetch_pro['photo1']; ?>"/>
																<img src="productlogo/<?php echo $fetch_pro['photo1'];?>" style="width: 200px;">
																<input type="file" name="photo1" id="photo1"/>
															</td>
														</tr>
															<?php
																}
																if($fetch_pro['photo2'])
																{
															?>
														<tr>
															<td>
																<p style="color:#00355D;"> <?php echo "Photo2"; ?></p>
															</td>
															<td>:</td>
															<td>
																<input type="hidden" name="pho2" readonly="true" value="<?php echo $fetch_pro['photo2']; ?>"/>
																<img src="productlogo/<?php echo $fetch_pro['photo2']; ?>" style="width: 200px;">
																<input type="file" name="photo2" id="photo2"/>
															</td>
														</tr>
														<?php
															}
															if($fetch_pro['photo3'])
															{
														?>
														<tr>
															<td>
																<p style="color:#00355D;"> <?php echo "Photo3"; ?></p>
															</td>
															<td>:</td>
															<td><input type="hidden" name="pho3" readonly="true" value="<?php echo $fetch_pro['photo3']; ?>"/>
																<img src="productlogo/<?php echo $fetch_pro['photo3']; ?>" style="width: 200px;">
																<input type="file" name="photo3" id="photo3"/>
															</td>
														</tr>
														<?php
															}
															if($fetch_pro['photo4'])
															{
														?>
														<tr>
															<td>
																<p style="color:#00355D;"> <?php echo "Photo4"; ?></p>
															</td>
															<td>:</td>
															<td>
																<input type="hidden" name="pho4" readonly="true" value="<?php echo $fetch_pro['photo4']; ?>"/>
																<img src="productlogo/<?php echo $fetch_pro['photo4']; ?>" style="width: 200px;">
																<input type="file" name="photo4" id="photo4" value="<?php echo $fetch_pro['photo4']; ?>"/>
															</td>
														</tr>
														<?php
														}
														if($fetch_pro['photo5'])
														{
														?>
														<tr>
															<td>
																<p style="color:#00355D;"> <?php echo "Photo5"; ?></p></td><td>:</td>
															<td><input type="hidden" name="pho5" readonly="true" value="<?php echo $fetch_pro['photo5']; ?>"/>
																<img src="productlogo/<?php echo $fetch_pro['photo5']; ?>" style="width: 200px;">
																<input type="file" name="photo5" id="photo5" value="<?php echo $fetch_pro['photo5']; ?>"/>
															</td>
														</tr>
														<?php
														}
														?>
														<tr>
															<td></td>
															<td></td>
															<td>
																<?php $idd=$pro_id; ?>
																<button type="button" onclick="loadXMLDoc(<?php echo $idd; ?>)">Add More photo</button>&nbsp;
																<div id="myDiv"></div>
															</td>
														</tr>
														<tr>
															<td>
																<p style="color:#00355D;"><strong> <?php echo $add_detailed_pro; ?></strong></p>
															</td>
														</tr>
														<tr>
															<td>
																<?php echo $detail_des; ?> 
																</td><td>:</td><td>
																<p>
																<textarea name="p_ddes" id="form-control" class=""  ><?php echo $fetch_pro['p_ddes']; ?></textarea></p>
																<script>
																	CKEDITOR.replace('p_ddes');
																</script>
															</td>
														</tr>
														<tr>
															<td>
																<p style="color:#00355D;"><strong> <?php echo $sel_payment_shipping; ?> </strong></p>
															</td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span> <?php echo $price_range; ?>
															</td>
															<td>:</td>
															<td>
																<select name="p_price"  class="txtfield_small">
																	<option value="">Currency</option>
																	<option value="USD" <?php if($fetch_pro['p_price']=="USD") { ?> selected="selected" <?php } ?>> USD </option>
																	<option value="GBP" <?php if($fetch_pro['p_price']=="GBP") { ?> selected="selected" <?php } ?>> GBP </option>
																	<option value="RMB" <?php if($fetch_pro['p_price']=="RMB") { ?> selected="selected" <?php } ?>> RMB </option>
																	<option value="EUR" <?php if($fetch_pro['p_price']=="AUD") { ?> selected="selected" <?php } ?>> EUR </option>
																	<option value="AUD" <?php if($fetch_pro['p_price']=="AUD") { ?> selected="selected" <?php } ?>> AUD </option>
																	<option value="CAD" <?php if($fetch_pro['p_price']=="CAD") { ?> selected="selected" <?php } ?>> CAD </option>
																	<option value="CHF" <?php if($fetch_pro['p_price']=="CHF") { ?> selected="selected" <?php } ?>> CHF </option>
																	<option value="JPY" <?php if($fetch_pro['p_price']=="JPY") { ?> selected="selected" <?php } ?>> JPY </option>
																	<option value="HKD" <?php if($fetch_pro['p_price']=="HKD") { ?> selected="selected" <?php } ?>> HKD </option>
																	<option value="NZD" <?php if($fetch_pro['p_price']=="NZD") { ?> selected="selected" <?php } ?>> NZD </option>
																	<option value="SGD" <?php if($fetch_pro['p_price']=="SGD") { ?> selected="selected" <?php } ?>> SGD </option>
																	<option value="Other" <?php if($fetch_pro['p_price']=="Other") { ?> selected="selected" <?php } ?>> <?php echo $other; ?> </option>
																</select>
																&nbsp;&nbsp;
																<input type="text" name="range1" class="txtfield_small" value="<?php echo $fetch_pro['range1']; ?>"/>
																&nbsp;~&nbsp;
																<input type="text" name="range2" class="txtfield_small" value="<?php echo $fetch_pro['range2']; ?>"/>
															</td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span> <?php echo $payment_terms; ?> 
															</td>
															<td>:</td>
															<td>
																<input name="payment" type="radio" value="L/C" <?php if($fetch_pro['paymenttype']=="L/C") { ?> checked="checked" <?php } ?>    id="free1" onclick="javascript:hide2('addcomments2');" />
																<span style="font-size:12"><?php echo $lc; ?></span>
																<input name="payment" type="radio" value="D/A" <?php if($fetch_pro['paymenttype']=="D/A") { ?> checked="checked" <?php } ?>   onclick="javascript:hide2('addcomments2');" />
																<span style="font-size:12"><?php echo $da; ?></span>
																<input name="payment" type="radio" value="D/P" <?php if($fetch_pro['paymenttype']=="D/P") { ?> checked="checked" <?php } ?>   onclick="javascript:hide2('addcomments2');" />
																<span style="font-size:12"><?php echo $dp; ?></span>
																<input name="payment" type="radio" value="T/T" <?php if($fetch_pro['paymenttype']=="T/T") { ?> checked="checked" <?php } ?>    onclick="javascript:hide2('addcomments2');"/>
																<span style="font-size:12">  <?php echo $tt; ?> </span>
																<input name="payment" type="radio" value="Western Union" <?php if($fetch_pro['']=="Western Union") { ?> checked="checked" <?php } ?>    onclick="javascript:hide2('addcomments2');"/>
																<span style="font-size:12"> 
																<?php echo $western_union; ?></span>
																<input name="payment" type="radio" value="MoneyGram" <?php if($fetch_pro['paymenttype']=="MoneyGram") { ?> checked="checked" <?php } ?>    onclick="javascript:hide2('addcomments2');" />
																<span style="font-size:12"> <?php echo $money_gram; ?></span>
																<input name="payment" type="radio" value="" <?php if($fetch_pro['']=="paymenttype") { ?> checked="checked" <?php } ?>   onclick="javascript:show2('addcomments2');" />
																<span style="font-size:12"> <?php echo $others; ?></span>
															</td>
														</tr>
														<tr>
															<td>&nbsp; </td><td>&nbsp;</td><td><div id="addcomments2" style="display:none" ><input type="text" name="others" id="others" class="txtfield2" value="<?php echo $fetch_pro['paymenttype']; ?>" /></div></td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span><?php echo $minimum_order_qua ?>
															</td>
															<td>:</td>
															<td>
																<input type="text" name="p_miniquantity" class="textBoxSi" value="<?php echo $fetch_pro['p_min_quanity']; ?>" /> 
																<select name="p_quantity" class="textBoxSi">
																	<option value=""><?php echo $Unit; ?></option>
																	<option value="Bag/Bags" <?php if($fetch_pro['p_quanity_type']=="Bag/Bags") { ?> selected="selected" <?php } ?>> <?php echo $bag; ?></option>
																	<option value="Barrel/Barrels" <?php if($fetch_pro['p_quanity_type']=="Barrel/Barrels") { ?> selected="selected" <?php } ?>> <?php echo $barrel; ?> </option>
																	<option value="Bushel/Bushels" <?php if($fetch_pro['p_quanity_type']=="Bushel/Bushels") { ?> selected="selected" <?php } ?>> <?php echo $Bushel; ?></option>
																	<option value="Cubic Meter" <?php if($fetch_pro['p_quanity_type']=="Cubic Meter") { ?> selected="selected" <?php } ?>> <?php echo $cubic_meter; ?> </option>
																	<option value="Dozen" <?php if($fetch_pro['p_quanity_type']=="Dozen") { ?> selected="selected" <?php } ?>> <?php echo  $Dozen ; ?></option>
																	<option value="Gallon" <?php if($fetch_pro['p_quanity_type']=="Gallon") { ?> selected="selected" <?php } ?>> <?php echo $Gallon; ?> </option>
																	<option value="Gram" <?php if($fetch_pro['p_quanity_type']=="Gram") { ?> selected="selected" <?php } ?>> <?php echo $Gram; ?> </option>
																	<option value="Kilogram" <?php if($fetch_pro['p_quanity_type']=="Kilogram") { ?> selected="selected" <?php } ?>> <?php echo $Kilogram; ?> </option>
																	<option value="Kilometer" <?php if($fetch_pro['p_quanity_type']=="Kilometer") { ?> selected="selected" <?php } ?>><?php echo $Kilometer; ?> </option>
																	<option value="Long Ton" <?php if($fetch_pro['p_quanity_type']=="Long Ton") { ?> selected="selected" <?php } ?>><?php echo $long_ton; ?> </option>
																	<option value="Meter" <?php if($fetch_pro['']=="Meter") { ?> selected="selected" <?php } ?>> <?php echo $Meter; ?> </option>
																	<option value="Metric Ton" <?php if($fetch_pro['']=="Metric Ton") { ?> selected="selected" <?php } ?>><?php echo $metric_ton; ?> </option>
																	<option value="Ounce" <?php if($fetch_pro['p_quanity_type']=="Ounce") { ?> selected="selected" <?php } ?>> <?php echo $Ounce; ?> </option>
																	<option value="Pair" <?php if($fetch_pro['p_quanity_type']=="Pair") { ?> selected="selected" <?php } ?>> <?php echo $Pair; ?> </option>
																	<option value="Pack/Packs" <?php if($fetch_pro['p_quanity_type']=="Pack/Packs") { ?> selected="selected" <?php } ?>> <?php echo $pack; ?> </option>
																	<option value="Piece/Pieces" <?php if($fetch_pro['p_quanity_type']=="Piece/Pieces") { ?> selected="selected" <?php } ?>> <?php echo $pieces; ?> </option>
																	<option value="Pound" <?php if($fetch_pro['p_quanity_type']=="Pound") { ?> selected="selected" <?php } ?>> <?php echo $pound; ?></option>
																	<option value="Set/Sets" <?php if($fetch_pro['p_quanity_type']=="Set/Sets") { ?> selected="selected" <?php } ?>> <?php echo $set; ?></option>
																	<option value="Short Ton" <?php if($fetch_pro['p_quanity_type']=="Short Ton") { ?> selected="selected" <?php } ?>> <?php echo $short_ton; ?> </option>
																	<option value="Square Meter" <?php if($fetch_pro['p_quanity_type']=="Square Meter") { ?> selected="selected" <?php } ?>> <?php echo $squre_meter; ?> </option>
																	<option value="Ton" <?php if($fetch_pro['p_quanity_type']=="Ton") { ?> selected="selected" <?php } ?>> <?php echo $ton; ?></option>
																</select> 
															</td>
														</tr>
														<tr>
															<td>
																<br />
																<p style="color:#00355D;"><strong> <?php echo $show_buy_abil; ?></strong></p>
															</td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span> <?php echo $production_capacity; ?> 
															</td>
															<td>:</td>
															<td>
																<input type="text" name="p_capacity" class="txtfield_small"  maxlength="6" value="<?php echo $fetch_pro['p_capaacity']; ?>"/>
																<select name="capacity" class="txtfield_small" <?php echo $fetch_pro['p_ctype']; ?> >
																	<option value=""><?php echo $sel_unit_typ; ?></option>
																	<option value="Bag/Bags" <?php if($fetch_pro['p_ctype']=="Bag/Bags") { ?> selected="selected" <?php } ?>><?php echo $bag; ?> </option>
																	<option value="Barrel/Barrels" <?php if($fetch_pro['p_ctype']=="Barrel/Barrels") { ?> selected="selected" <?php } ?>><?php echo $barrel; ?> </option>
																	<option value="Cubic Meter" <?php if($fetch_pro['p_ctype']=="Cubic Meter") { ?> selected="selected" <?php } ?>><?php echo $cubic_meter; ?> </option>
																	<option value="Dozen" <?php if($fetch_pro['p_ctype']=="Dozen") { ?> selected="selected" <?php } ?>>  <?php echo  $Dozen ; ?> </option>
																	<option value="Gallon" <?php if($fetch_pro['p_ctype']=="Gallon") { ?> selected="selected" <?php } ?>>  <?php echo $Gallon; ?></option>
																	<option value="Gram" <?php if($fetch_pro['p_ctype']=="Gram") { ?> selected="selected" <?php } ?>> <?php echo $Gram; ?> </option>
																	<option value="Kilogram" <?php if($fetch_pro['p_ctype']=="Kilogram") { ?> selected="selected" <?php } ?>> <?php echo $Kilogram; ?> </option>
																	<option value="Kilometer" <?php if($fetch_pro['p_ctype']=="Kilometer") { ?> selected="selected" <?php } ?>> <?php echo $Kilometer; ?> </option>
																	<option value="Long Ton" <?php if($fetch_pro['p_ctype']=="Long Ton") { ?> selected="selected" <?php } ?>> <?php echo $long_ton; ?> </option>
																	<option value="Meter" <?php if($fetch_pro['p_ctype']=="Meter") { ?> selected="selected" <?php } ?>><?php echo $Meter; ?> </option>
																	<option value="Mertic Ton" <?php if($fetch_pro['p_ctype']=="Mertic Ton") { ?> selected="selected" <?php } ?>> <?php echo $metric_ton; ?> </option>
																	<option value="Ounce" <?php if($fetch_pro['p_ctype']=="Ounce") { ?> selected="selected" <?php } ?>> <?php echo $Ounce; ?> </option>
																	<option value="Pair" <?php if($fetch_pro['p_ctype']=="Pair") { ?> selected="selected" <?php } ?>><?php echo $Pair; ?></option>
																	<option value="pack/packs" <?php if($fetch_pro['p_ctype']=="pack/packs") { ?> selected="selected" <?php } ?>> <?php echo $pack; ?></option>
																	<option value="Piece/Pieces" <?php if($fetch_pro['p_ctype']=="Piece/Pieces") { ?> selected="selected" <?php } ?>> <?php echo $pieces; ?> </option>
																	<option value="Pound" <?php if($fetch_pro['p_ctype']=="Pound") { ?> selected="selected" <?php } ?>> <?php echo $pound; ?></option>
																	<option value="Set/Sets" <?php if($fetch_pro['p_ctype']=="Set/Sets") { ?> selected="selected" <?php } ?>><?php echo $set; ?></option>
																	<option value="Short Ton" <?php if($fetch_pro['p_ctype']=="Short Ton") { ?> selected="selected" <?php } ?>> <?php echo $short_ton; ?> </option>
																</select>
																<span style="font-size:12"> &nbsp;<font style="color:#FF0000;">*</font><?php echo $per; ?>&nbsp;</span>
																<select name="time" class="txtfield_small">
																	<option value=""><?php echo $time; ?></option>
																	<option value="Day" <?php if($fetch_pro['percapacity']=="Day") { ?> selected="selected" <?php } ?>> <?php echo $day; ?> </option>
																	<option value="Week" <?php if($fetch_pro['percapacity']=="Week") { ?> selected="selected" <?php } ?>> <?php echo $week; ?> </option>
																	<option value="Month" <?php if($fetch_pro['percapacity']=="Month") { ?> selected="selected" <?php } ?>> <?php echo $month; ?> </option>
																	<option value="Year" <?php if($fetch_pro['percapacity']=="Year") { ?> selected="selected" <?php } ?>><?php echo $year; ?> </option>
																</select> 
															</td>
														</tr>
														<tr>
															<td>
																<span class="mandory">*</span> <?php echo $delivery_time; ?> 
															</td>
															<td>:</td>
															<td>
																<input type="text" name="p_deliverytime" id="p_deliverytime" class="txtfield2" value="<?php echo $fetch_pro['p_delivertytime']; ?>" />
															</td>
														</tr>
														<tr>
															<td>
																<?php echo $packaging_details; ?> 
															</td>
															<td>:</td>
															<td>
																<textarea name="description" id="description" class="txtarea1" ><?php echo $fetch_pro['p_packingdetails']; ?></textarea>
															</td>
														</tr>
														<tr>
															<td>&nbsp;</td>
															<td><input type="submit" name="submit" value="<?php echo $submit; ?>" ></td>
															<td>&nbsp;</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</form>
								<div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("includes/footer.php"); ?>
