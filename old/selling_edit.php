 <?php 
include("includes/header.php");
$id=$_REQUEST['id'];
$viewquery1 = mysqli_query($con,"select * from tbl_seller where seller_id='$sellid'");
								//echo "select * from tbl_seller where seller_id='$id'";
	$viewfetch1 = mysqli_fetch_array($viewquery1);
	
 $Logo=$viewfetch1['seller_photo'];
if(isset($_REQUEST['submit']))
	{

        $price1=$_REQUEST['price'];
	    $cur_type=$_REQUEST['cur_type'];
		$del_type=$_REQUEST['del_type'];	
		$del_charge=$_REQUEST['del_charge'];
		$del_cur_type=$_REQUEST['del_cur_type'];

$leadtype = $_REQUEST['leadtype'];
$subject1 = $_REQUEST['subject'];
$keyword1 = $_REQUEST['keyword'];
$category1=$_REQUEST['p_cat'];
$subcategory=$_REQUEST['subcategory'];
$briefdescription = $_REQUEST['briefdescription'];
$detailed_description = $_REQUEST['detaileddescription'];
$valid = $_REQUEST['valid'];
 $photo = $_REQUEST['uploadedfile']; 
$companyname = $_REQUEST['companyname'];
$businesstype = $_REQUEST['businesstype'];
$businesstype=implode(",",$businesstype);

$businessrange = $_REQUEST['businessrange'];
 $up_today=date("Y-m-d"); 
		
		 $es_today = date('Y-m-d',mktime(0,0,0, date("m") , date("d") , date("Y") + 1 ));
		
		
		$today=date("F j, Y");
		$expired = date("F j, Y", strtotime("+1 year"));

 $productphotos= basename($_FILES['uploadedfile']['name']); 
 
if($productphotos=="") 
{
$Photo=$Logo;
}
else
{
$Photo=$productphotos;
}

$uploaddir='uploads/';
$uploadfile=$uploaddir . basename($_FILES['uploadedfile']['name']);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $uploadfile))
{
echo "";
}
else
{
echo "error";
}
/*echo "UPDATE `tbl_seller` SET `seller_leadtype` = '$leadtype',
`seller_subject` = '$subject',
`seller_keyword` = '$keyword',
`seller_category` = '$category',
`seller_subcategory` = '$subcategory',
`seller_description` = '$briefdescription',
`seller_detaildescription` = '$detailed_description',
`seller_valid` = '$valid',
`seller_photo` = '$Photo',
`seller_companyname` = '$companyname',
`seller_businesstype` = '$businesstype',
`seller_businessrange` = '$businessrange',seller_updated_date='$today',seller_expired_date='$expired' WHERE `seller_id`='$sellid'";exit;
*/
if($productphotos!='')
{
 $upquery="UPDATE `tbl_seller` SET `seller_leadtype` = '$leadtype',
`seller_subject` = '$subject1',
`seller_keyword` = '$keyword1',
`seller_category` = '$category1',
`seller_subcategory` = '$subcategory',
`seller_description` = '$briefdescription',
`seller_detaildescription` = '$detailed_description',
`seller_valid` = '$valid',
`seller_photo` = '$Photo',
`seller_companyname` = '$companyname',
`seller_businesstype` = '$businesstype',
`seller_businessrange` = '$businessrange',seller_updated_date='$today',seller_expired_date='$expired',price='$price1',cur_type='$cur_type',delivery_type='$del_type',delivery_charge='$del_charge',del_cur_type='$del_cur_type' WHERE `seller_id`='$id'"; 
}
else
{
 $upquery="UPDATE `tbl_seller` SET `seller_leadtype` = '$leadtype',
`seller_subject` = '$subject1',
`seller_keyword` = '$keyword1',
`seller_category` = '$category1',
`seller_subcategory` = '$subcategory',
`seller_description` = '$briefdescription',
`seller_detaildescription` = '$detailed_description',
`seller_valid` = '$valid',
`seller_companyname` = '$companyname',
`seller_businesstype` = '$businesstype',
`seller_businessrange` = '$businessrange',seller_updated_date='$today',seller_expired_date='$expired',price='$price1',cur_type='$cur_type',delivery_type='$del_type',delivery_charge='$del_charge',del_cur_type='$del_cur_type' WHERE `seller_id`='$id'"; 
}
	$update1 = mysqli_query($con,$upquery); 
  header("Location:selling_view.php?id=$id"); 
/*echo $update="UPDATE tbl_seller SET seller_leadtype='agent',
seller_subject='Software Engineer12',
seller_keyword='Software Engineer12',
seller_description='Software EngineerSoftware Engineer12',
seller_detaildescription='Software Engineer Software Engineer Software Engineer1',
seller_valid= '4',
seller_photo= '',
seller_companyname='companyname2',
seller_businesstype='fds2',
seller_businessrange='Computers1' WHERE seller_id=9" or mysqli_error($con);
*/}
?>


 <script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
 <script language="javascript">
	
	function validationedit()
		{
		
		fnam=document.frm_seller_edit.uploadedfile.value;
		
			if(document.frm_seller_edit.subject.value=='')
				{
					
					alert("Please Enter Subject");
					document.frm_seller_edit.subject.focus();
					return false;
				}
				
				if(document.frm_seller_edit.keyword.value=='')
				{
					
					alert("Please Enter Keyword");
					document.frm_seller_edit.keyword.focus();
					return false;
				}
				
				if(document.frm_seller_edit.p_cat.value=='')
				{
					
					alert("Please Enter Category");
					document.frm_seller_edit.p_cat.focus();
					return false;
				}
				
				if(document.frm_seller_edit.subcategory.value=='')
				{
					
					alert("Please Enter Sub Category");
					document.frm_seller_edit.subcategory.focus();
					return false;
				}
				
				if(document.frm_seller_edit.briefdescription.value=='')
				{
					
					alert("Please Enter Brief Description");
					document.frm_seller_edit.briefdescription.focus();
					return false;
				}
				
				if(document.frm_seller.price.value=='')
				{
					
					alert("Please enter the price");
					document.frm_seller.price.focus();
					return false;
				}
				
				if(document.frm_seller.cur_type.value=='')
				{
					
					alert("Please choose currency type");
					document.frm_seller.cur_type.focus();
					return false;
				}
				
				if(document.frm_seller.del_type.value=='')
				{
					
					alert("Please choose the delivery type");
					document.frm_seller.del_type.focus();
					return false;
				}
				
					if(document.frm_seller.del_type.value==1)
				{
					if(document.frm_seller.del_charge.value=='')
					{
					alert("Please choose the delivery Charge");
					document.frm_seller.del_charge.focus();
					return false;
					}
					
					if(document.frm_seller.del_cur_type.value=='')
				{
					
					alert("Please choose delivery currency type");
					document.frm_seller.del_cur_type.focus();
					return false;
				}
				}
				
			/*	if(document.frm_seller_edit.detaileddescription.value=='')
				{
					
					alert("Please Enter Detailed Description");
					document.frm_seller_edit.detaileddescription.focus();
					return false;
				} 
				
				
				if(document.frm_seller_edit.uploadedfile.value=='')
				{
					
					alert("Please Enter Product Photo");
					document.frm_seller_edit.uploadedfile.focus();
					return false;
				}*/
				
				
				splt=document.frm_seller_edit.uploadedfile.value.split('.');
				chksplt=splt[1].toLowerCase();
				
				if(chksplt=='jpg'||chksplt=='gif' || chksplt=='png'|| chksplt=='jpeg'||chksplt=='bmp'){
				
				}else{
				alert(" Upload only jpg,jpeg,tif,bmp,gif,png ");
				return false;
				}
				
				
		var lengthcount=document.frm_seller_edit.maxvalue.value;
		var checkedcount=0;
		for(var i=1; i<lengthcount; i++) {
		 var checklist = "checkbox["+i+"]";
		 //alert(checklist);
	//	alert(document.getElementById(checklist));
		 var dom = document.getElementById(checklist);
		if(dom.checked==true) {
			checkedcount++;
		}
		}
		if(checkedcount ==0) {
			alert("Select Atleast One Business Type");
			return false;
		}
			
		}
		

</script>

 <script type="text/javascript">
 
 function del_chage()
 {
	 //alert("hello");
	 if(document.getElementById('del_type').value==1)
	 {
		 document.getElementById('del_val').style.display="block";
	 }
	 else
	 {
		 document.getElementById('del_val').style.display="none";
	 }
	 
 }
 
 </script>

 
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
<?php
								
									$viewquery = mysqli_query($con,"select * from tbl_seller where seller_id='$id'");
								//echo "select * from tbl_seller where seller_id='$id'";
									$viewfetch = mysqli_fetch_array($viewquery);
									  $id = $viewfetch['seller_id'];
									  $cat  = $viewfetch['seller_category'];
									  $type = $viewfetch['seller_leadtype'];
								
								
								?>
<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"><?php echo $edit_sel_lead ; ?></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->

				<form name="frm_seller_edit" method="post" action="" enctype="multipart/form-data">
					<table width="100%" border="0" cellspacing="0" cellpadding="3">
							
									
								
									<tr height="5">
										<td colspan="4">&nbsp;</td>
									</tr>
									
									<tr>
									<td width="6%">&nbsp;</td>
										<td width="26%" align="right" class="prodcuts_search"><div align="left"><strong><?php echo $selling_lead_type; ?>:</strong></div></td>
										<td width="4%">&nbsp;</td>
										<td width="64%" class="sellertext">
											<input type="radio" name="leadtype" value="sell" <?php if($type=='sell') { echo "checked"; }?>/><?php echo $sell; ?>
											<input type="radio" name="leadtype" value="agent" <?php if($type=='agent') { echo "checked"; }?> /><?php echo $agent; ?> 
									  <input type="radio" name="leadtype" value="cooperation" <?php if($type=='cooperation') { echo "checked"; }?> /><?php echo $cooperation; ?>									  </td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $subject; ?>:</strong></td>
										<td>&nbsp;</td>
										<td>
											<input type="text" name="subject" class="txtfield2" value="<?php echo $viewfetch['seller_subject']; ?>" /><br />
											<span class="bottomlink"><?php echo $product_listing; ?></span>										</td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"> <span style="color:#FF0000">*&nbsp;</span><strong><?php echo $keyword; ?>:</strong></td>
										<td>&nbsp;</td>
										<td><input type="text" name="keyword" class="txtfield2" value="<?php echo $viewfetch['seller_keyword']; ?>" />
										  <!--<a href="" class="sellertextsmall">How to set a good keyword</a> -->
											<br />
											<span class=""><?php echo $plz_input; ?>.</span>									  </td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $category; ?>:</strong></td>
										<td>&nbsp;</td>
									
		<td>
			<select name="p_cat" class="txtfield2" onchange="Javascript:FUNCTION1(this.value);">
                                  <option value=""><?php echo $sel_cat; ?></option>
                                  <?php 
								  $select_cat="SELECT * FROM category WHERE  parent_id =''";
								  $res_cat=mysqli_query($con,$select_cat);
								  while($fetch_cat=mysqli_fetch_array($res_cat))
								  {
								  if($viewfetch['seller_category']==$fetch_cat['c_id'])
								  {
								  $selected="SELECTED";
								  }
								  else
								  {
								  $selected="";
								  }
								  
								  ?>
								 <option value="<?php echo $fetch_cat['c_id']; ?>" <?php echo $selected; ?>><?php echo $fetch_cat['category']; ?></option>
								 <?php } ?>
                                </select>		</td>
	</tr>
	
	
	<tr>
	<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $sub_cat; ?>:</strong></td>
										<td>&nbsp;</td>
								
		<td>
			<div id="subcat12">
								  <select name="subcategory" class="txtfield2" id="subcat" >
                                    <option value=""><?php echo $sel_sub_cat; ?></option>
									<?php 
									$cat_id=$viewfetch['seller_category'];
									$select_sub="SELECT * FROM category WHERE parent_id='$cat_id'";
									$res_sub=mysqli_query($con,$select_sub);
									while($fetch_sub=mysqli_fetch_array($res_sub))
									{	
									if($fetch_sub['c_id']==$viewfetch['seller_subcategory'])
									{
									$selected1="SELECTED";
									
									}		
									else
									{
									$selected1="";
									}
									?>
									<option value="<?php echo $fetch_sub['c_id']; ?>" <?php echo $selected1; ?>><?php echo $fetch_sub['category']; ?></option>
									<?php } ?>
                                    
                                  </select>
								</div>		</td>
	</tr>
	
	
	
																		
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $breif_des; ?>:</strong></td>
										<td>&nbsp;</td>
									  <td valign="top">
											<textarea name="briefdescription" class="txtarea1" cols="40" rows="3"><?php echo $viewfetch['seller_description']; ?></textarea>
											<br /></td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><strong><?php echo $detail_des; ?>:</strong></td>
										<td>&nbsp;</td>
										<td valign="top">
<textarea name="detaileddescription" cols="40" class="txtarea1" rows="3" ><?php echo $viewfetch['seller_detaildescription']; ?></textarea> 
												
											
											<br /></td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><strong><?php echo $valid_for; ?>:</strong></td>
										<td>&nbsp;</td>
										<td valign="top">
	<select name="valid" class="txtfield2">
			<option  value="12" <?php if($viewfetch['seller_valid']==12) { ?> selected="selected" <?php } ?>>12 <?php echo $months; ?></option>
			<option value="6" <?php if($viewfetch['seller_valid']==6) { ?> selected="selected" <?php } ?>>6 <?php echo $months; ?></option>
			<option value="4" <?php if($viewfetch['seller_valid']==4) { ?> selected="selected" <?php } ?>>4 <?php echo $months; ?></option>
			<option value="2" <?php if($viewfetch['seller_valid']==2) { ?> selected="selected" <?php } ?>>2 <?php echo $months; ?></option>
	</select> 
												
											
											<br /></td>
									</tr>
									<tr>
                                    <td>&nbsp;</td>
                                                <td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*</span><strong><?php echo $price; ?> :</strong></td>
                                               <td>&nbsp;</td>
                                                <td><input type="text" name="price" id="price" value="<?php echo $viewfetch['price']; ?>"/>&nbsp;<select name="cur_type" id="cur_type"  class="txtfield_small" >
                                          <option value=""><?php echo $currency; ?></option>
                                          <option value="USD" <?php if($viewfetch['cur_type']=='USD') { ?> selected="selected" <?php } ?>>USD </option>
                                          <option value="GBP" <?php if($viewfetch['cur_type']=='GBP') { ?> selected="selected" <?php } ?>> GBP </option>
                                          <option value="RMB" <?php if($viewfetch['cur_type']=='RMB') { ?> selected="selected" <?php } ?>> RMB </option>
                                          <option value="EUR" <?php if($viewfetch['cur_type']=='EUR') { ?> selected="selected" <?php } ?>> EUR </option>
                                          <option value="AUD" <?php if($viewfetch['cur_type']=='AUD') { ?> selected="selected" <?php } ?>> AUD </option>
                                          <option value="CAD" <?php if($viewfetch['cur_type']=='CAD') { ?> selected="selected" <?php } ?>> CAD </option>
                                          <option value="CHF" <?php if($viewfetch['cur_type']=='CHF') { ?> selected="selected" <?php } ?>> CHF </option>
                                          <option value="JPY" <?php if($viewfetch['cur_type']=='JPY') { ?> selected="selected" <?php } ?>> JPY </option>
                                          <option value="HKD" <?php if($viewfetch['cur_type']=='HKD') { ?> selected="selected" <?php } ?>> HKD </option>
                                          <option value="NZD" <?php if($viewfetch['cur_type']=='NZD') { ?> selected="selected" <?php } ?>> NZD </option>
                                          <option value="SGD" <?php if($viewfetch['cur_type']=='SGD') { ?> selected="selected" <?php } ?>> SGD </option>
                                          <option value="OTHER" <?php if($viewfetch['cur_type']=='OTHER') { ?> selected="selected" <?php } ?>> <?php echo $OTHER; ?> </option>
                                        </select>
                                                    </td>
                                              </tr>
                                            <tr>
                                            
                                            <td>&nbsp;</td>
                                                <td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*</span><strong> <?php echo $delivery_type; ?> :</strong></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                <select name="del_type" id="del_type" class="txtfield2" onchange="del_chage();">
                                                    <option value=""> <?php echo $selectt; ?></option>
                                                    <option value="1" <?php if($viewfetch['delivery_type']=='1') { ?> selected="selected" <?php } ?>> <?php echo $deliver_user; ?></option>
                                                    <option value="2" <?php if($viewfetch['delivery_type']=='2') { ?> selected="selected" <?php } ?>><?php echo $need_buyer; ?></option>
                                                  </select>
                                                </td>
                                              </tr>
                                              
                                    <?php if($viewfetch['delivery_type']=='1') { ?>
                                              <tr>
                                               <td>&nbsp;</td>
                                                <td class="prodcuts_search" valign="top" align="left"><span style="color:#FF0000">*</span><strong> <?php echo $delivery_charge; ?>:</strong></td>
                                               <td>&nbsp;</td>
                                                <td><input type="text" name="del_charge" id="del_charge" value="<?php echo $viewfetch['delivery_charge']; ?>"/>&nbsp;<select name="del_cur_type" id="del_cur_type"  class="txtfield_small" >
                                          <option value=""><?php echo $currency; ?></option>
                                          <option value="USD" <?php if($viewfetch['del_cur_type']=='USD') { ?> selected="selected" <?php } ?>>USD </option>
                                          <option value="GBP" <?php if($viewfetch['del_cur_type']=='GBP') { ?> selected="selected" <?php } ?>> GBP </option>
                                          <option value="RMB" <?php if($viewfetch['del_cur_type']=='RMB') { ?> selected="selected" <?php } ?>> RMB </option>
                                          <option value="EUR" <?php if($viewfetch['del_cur_type']=='EUR') { ?> selected="selected" <?php } ?>> EUR </option>
                                          <option value="AUD" <?php if($viewfetch['del_cur_type']=='AUD') { ?> selected="selected" <?php } ?>> AUD </option>
                                          <option value="CAD" <?php if($viewfetch['del_cur_type']=='CAD') { ?> selected="selected" <?php } ?>> CAD </option>
                                          <option value="CHF" <?php if($viewfetch['del_cur_type']=='CHF') { ?> selected="selected" <?php } ?>> CHF </option>
                                          <option value="JPY" <?php if($viewfetch['del_cur_type']=='JPY') { ?> selected="selected" <?php } ?>> JPY </option>
                                          <option value="HKD" <?php if($viewfetch['del_cur_type']=='HKD') { ?> selected="selected" <?php } ?>> HKD </option>
                                          <option value="NZD" <?php if($viewfetch['del_cur_type']=='NZD') { ?> selected="selected" <?php } ?>> NZD </option>
                                          <option value="SGD" <?php if($viewfetch['del_cur_type']=='SGD') { ?> selected="selected" <?php } ?>> SGD </option>
                                          <option value="OTHER" <?php if($viewfetch['del_cur_type']=='OTHER') { ?> selected="selected" <?php } ?>> <?php echo $OTHER; ?> </option>
                                        </select>
                                                </td>
                                              </tr>
                                            <?php } ?>
                                           
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">&nbsp;</span><strong><?php echo $attach_product_photo; ?>:</strong></td>
										<td>&nbsp;</td>
										<td valign="top">
										<?php if ($viewfetch['seller_photo'] == "")  { $Photo="uploads/img_noimg.jpg";  } else { $Photo = "Logo/".$viewfetch['seller_photo']; }?>
											<input type="file" name="uploadedfile"  value="<?php $viewfetch['seller_photo']; ?>" /><?php //echo $filename;  ?><?php if((file_exists("uploads/".$viewfetch['seller_photo']))&&($viewfetch['seller_photo']!='')) { ?><img src="<?php echo "uploads/".$viewfetch['seller_photo'];?>" height="100" width="100" /><?php } else { ?><img src="uploads/img_noimg.jpg" height="100" width="100" /><?php } ?>
											<!--<div class="column">
												<div id="preview"  class="VCenter100" align="left">
													<span class="sellercomments" id="nophoto" name="nophoto">Choose a product photo from publish products.</span>
												</div>
											</div>-->										</td>
									</tr>
									
									<tr>
									  <td class="sellertext" align="left" valign="top" colspan="3">&nbsp;</td>
								  </tr>
									<tr>
										<td class="" align="left" valign="top" colspan="4">
											<?php echo $desc; ?>.										</td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><strong><?php echo $company_name; ?>:</strong></td>
										<td>&nbsp;</td>
										<td>
											<input type="text" name="companyname" class="txtfield2" value="<?php echo $viewfetch['seller_companyname']; ?>" />										</td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $bussiness_type; ?>:</strong></td>
										<td>&nbsp;</td>
										<td class="sellertext">
										
										<?php			
											$viewquery = mysqli_query($con,"select * from tbl_seller where seller_id='$id'");
						//echo "select * from tbl_seller where seller_id='$id'";
						$viewfetch = mysqli_fetch_array($viewquery);
						$id = $viewfetch['seller_id'];
						$category  = $viewfetch['seller_category'];
						$valid = $viewfetch['seller_valid'];
						$biz = $viewfetch['seller_businesstype'];
				        echo "<br>";
				
			
					 $businesstype = explode(',',$viewfetch['seller_businesstype']);
					 //$j=9;
				foreach($businesstype as $onegam) 
				{
				$onegam;
				}					
						

					
					//echo $businesstype[0];echo "<br>";
					//echo $businesstype[1];	echo "<br>";
					//echo $businesstype[2];	echo "<br>";
					//echo $businesstype[3];	echo "<br>";
					//echo $businesstype[4];		echo "<br>";
					//echo $businesstype[5];echo "<br>";
					//echo $businesstype[6];	echo "<br>";
					//echo $businesstype[7];	echo "<br>";
					//echo $businesstype[8];	echo "<br>";
					//echo $businesstype[9];		echo "<br>";
					
					$i=1;
					
					//echo "<br>";
					?>
										
<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Manufacturer" <?php if(substr_count($viewfetch['seller_businesstype'], 'Manufacturer')) { ?> checked="checked" <?php } ?> /><?php echo $Manufacturer; ?>
				<br /> <?php $i++;?>
				<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Trading Company"<?php if(substr_count($viewfetch['seller_businesstype'], 'Trading Company')) {  ?> checked="checked" <?php } ?>/><?php echo $tradeing_company; ?>
				<br /><?php $i++;?>
				<input type="checkbox" name="businesstype[]"  id="checkbox[<?php echo $i;?>]" value="Buying Office" <?php if(substr_count($viewfetch['seller_businesstype'], 'Buying Office')) {?> checked="checked" <?php } ?>/><?php echo $buying_office; ?></strong>
				<br /><?php $i++;?>
 <input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Agent"<?php if(substr_count($viewfetch['seller_businesstype'], 'Agent')) { ?> checked="checked" <?php } ?> /><?php echo $agent; ?>
				<br /><?php $i++;?>
				<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Distributor/Wholesaler"<?php if(substr_count($viewfetch['seller_businesstype'], 'Distributor/Wholesaler')) {  ?> checked="checked" <?php } ?> /><?php echo $distributor; ?>
				<br /><?php $i++;?>
				<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Government ministry/Bureau/Commission" <?php if(substr_count($viewfetch['seller_businesstype'], 'Government ministry/Bureau/Commission')) { ?> checked="checked" <?php } ?> /><?php echo $government_ministry; ?>
				<br /><?php $i++;?>
				<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Association" <?php if(substr_count($viewfetch['seller_businesstype'], 'Association')) {?> checked="checked" <?php } ?>/><?php echo $association; ?><br /><?php $i++;?>
				<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Business Service" <?php if(substr_count($viewfetch['seller_businesstype'], 'Business Service')) { ?> checked="checked" <?php } ?>/><?php echo $bussi_service; ?>
				<br /><?php $i++;?>
				<input type="checkbox" name="businesstype[]" id="checkbox[<?php echo $i;?>]" value="Other" <?php if(substr_count($viewfetch['seller_businesstype'], 'Other')) {  ?> checked="checked" <?php } ?>/><?php echo $other; ?>									</td>
								     <input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />	</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td class="prodcuts_search" align="left" valign="top"><strong><?php echo $business_range; ?>:</strong></td>
										<td>&nbsp;</td>
										<td class="">
											<?php echo $product_service_we; ?>
											<br />
								<input type="text" name="businessrange" value="<?php echo $viewfetch['seller_businessrange']; ?>" size="25" />
											<!--<input type="text" name="" value="" size="5"  />
											<input type="text" name="" value="" size="5"  />
											<input type="text" name="" value="" size="5"  />
											<input type="text" name="" value="" size="5"  />
											<span class="sellertextsmall">Add</span>
											<br />
											<span class="sellertextsmall">more</span>-->										</td>
									</tr>
									
									
									<tr>
										
										<td class="" colspan="4">
											
											<span class="inTxtNormal">
											<?php echo $desc_too; ?>.											</span>										</td>
									</tr>
									
								
									<!--<tr>
										<td class="seller" align="right" valign="top">Company Address</td>
										<td>&nbsp;</td>
										<td>
											<table cellpadding="1" cellspacing="0" border="0">
												<?php
												
												
												 
														$profilesql = mysqli_query($con,"select * from registration where id='$sess_id'");
														
														//echo "select * from registration where id='$sess_id'";
														
														
														$profilefetch = mysqli_fetch_array($profilesql);
														
														//echo "sidufyi";
														
														//echo $addr = $profilefetch['city'];
												
												?>
											
												<tr>
													<td class="sellertext">Street Address</td>
													<td><input type="text" name="streetaddress" value="<?php echo $profilefetch['street']; ?>" /></td>
												</tr>
												<tr>
													<td class="sellertext">City</td>
													<td><input type="text" name="city" value="<?php echo $profilefetch['city']; ?>" /></td>
												</tr>
												<tr>
													<td class="sellertext">Province/State</td>
													<td><input type="text" name="state" value="<?php echo $profilefetch['state'];?>" /></td>
												</tr>
												<tr>
													<td class="sellertext">Country</td>
													<td><input type="text" name="country" value="<?php echo $profilefetch['countrycode'];?>" /></td>
												</tr>
												<tr>
													<td class="sellertext">Zip/Postal Code</td>
													<td><input type="text" name="zip" value="<?php echo $profilefetch['zipcode'];?>" /></td>
												</tr>
											</table>
										</td>
									</tr>-->
									
									<tr >
										
										<td colspan="4" align="center" >
											<input name="submit" class="search_bg" type="submit" onclick="return validationedit();" value="<?php echo $update; ?>" />	
											<!-- <a href="view_sell_offer_details.php?id=<?php echo $_GET['sellid']; ?>"> --><input name="Cancel" class="search_bg" type="button"  value="<?php echo $cancel; ?>" onclick="javascript:location.href='selling_view.php ?id=<?php echo $_GET['id']; ?>'" />	   <!-- </a> -->   </td>
																														
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
