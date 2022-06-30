<?php 
include("includes/header.php");

$buyid=$_REQUEST['id'];

//$sess_id=$_SESSION['sess_id']; 

$res_select="select * from buyingleads where buy_id='$buyid'";

$res_query=mysqli_query($con,$res_select);

$res_fetch=mysqli_fetch_array($res_query);

$b_id=$res_fetch['buy_id'];
$photo=$res_fetch['photo'];


if(isset($_REQUEST['Submit']))
{
$buyid=$_REQUEST['id'];

$sess_id=$_SESSION['sess_id']; 

$res_select="select * from buyingleads where buy_id='$buyid'";

$res_query=mysqli_query($con,$res_select);

$res_fetch=mysqli_fetch_array($res_query);

$b_id=$res_fetch['buy_id'];



session_start();
$sess_id=$_SESSION['sess_id']; 
$today=date("F j, Y");
$expired = date("F j, Y", strtotime("+1 year"));
$subject=$_REQUEST['subject'];
$keyword=$_REQUEST['keyword'];
$keyword1=$_REQUEST['keyword1'];
$keyword2=$_REQUEST['keyword2'];
$category=$_REQUEST['p_cat'];
$subcategory=$_REQUEST['subcategory'];
$briefdes=$_REQUEST['briefdes'];
$detdes=$_REQUEST['detdes'];
//$purchase=$_REQUEST['purchase'];
$valid=$_REQUEST['valid'];
$mycontact=$_REQUEST['mycontact'];
$price=$_REQUEST['price'];
$range1=$_REQUEST['range1'];
$range2=$_REQUEST['range2'];
$miniquantity=$_REQUEST['miniquantity'];
$quantity=$_REQUEST['quantity'];
$certificate=$_REQUEST['certificate'];
$currentphoto=$_REQUEST['currentphoto'];
//$today=date("F j, Y");
//$expired = date("F j, Y", strtotime("+1 year"));

	

$filename=basename($_FILES['userfile']['name']);
$tmpfilename=$_FILES['userfile']['tmp_name'];
$uploadpath1="upload/".$filename;
move_uploaded_file($tmpfilename,$uploadpath1); 	

$ftimages = "blog_photo_thumbnail/".$filename;
//$thumb= new EasyThumbnail($uploadpath1, $ftimages, 120);


if($filename!="")
{
$photofile=$filename;
}
else
{
$photofile=$photo;
 }

//echo "UPDATE buyingleads SET subject='$subject', keyword='$keyword', keyword1='$keyword1', keyword2='$keyword2', photo='$photofile', category='$category', subcategory='$subcategory', briefdes='$briefdes', detdes='$detdes', valid='$valid', mycontact='$mycontact', price='$price', range1='$range1', range2='$range2', miniquantity='$miniquantity', quantity='$quantity', certificate='$certificate', update_date='$today', expiredate='$expired' where buy_id='$buyid'"; break;

 $sql1="UPDATE buyingleads SET subject='$subject', keyword='$keyword', keyword1='$keyword1', keyword2='$keyword2', photo='$photofile', category='$category', subcategory='$subcategory', briefdes='$briefdes', detdes='$detdes', valid='$valid', mycontact='$mycontact', price='$price', range1='$range1', range2='$range2', miniquantity='$miniquantity', quantity='$quantity', certificate='$certificate', update_date='$today', expiredate='$expired' where buy_id='$buyid'"; 

$query1=mysqli_query($con,$sql1);

header("location:buying_view.php?id=$buyid");

}
else
{
//echo "update not success";
}


 ?>

<style type="text/css">
.redbold
{
color:#FF0000;
font-weight:bold;
}
</style>
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
alert("Please enter the subject");
document.buying.subject.focus();
return false;
}

/*if(fnam=="")
{
alert("Please Upload in image");
document.buying.userfile.focus();
return false;
}
*/
/*splt=fnam.split('.');
chksplt=splt[1].toLowerCase();

if(chksplt=='jpg'|| chksplt=='jpeg'){

}else{
alert(" Upload only jpg,jpeg");
document.buying.userfile.focus();
return false;
}
*/

if(document.buying.keyword.value=="")
{
alert("Please enter the keyword");
document.buying.keyword.focus();
return false;
}
if(document.buying.p_cat.value=="")
{
alert("Please select the category");
document.buying.p_cat.focus();
return false;
}
if(document.buying.subcategory.value=="")
{
alert("Please select the subcategory");
document.buying.subcategory.focus();
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
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"><strong><?php echo $edit_buy_lead; ?></strong></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<form id="form1" name="buying" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this)">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
                              <tr>
                                <td  style="padding:5px;font-size:16px" class="prodcuts_search"><strong><?php echo $basic_info; ?> </strong></td>
                                <td align="right" valign="middle" class="prodcuts_search"  style="padding:5px; "><span class="style6">*</span> <?php echo $sell_index_reinfr;?></td>
                              </tr>
                              <tr>
                                <td width="39%" class="prodcuts_search"><span class="redbold">*</span><?php echo $subject; ?>:</td>
                                <td width="61%"><input type="text" name="subject" value="<?php echo $res_fetch['subject'];?>" />                                </td>
                              </tr>
							  
                              <tr>
                                <td class="prodcuts_search"><span class="redbold"></span><?php echo $attachment_product_photo; ?></td>
                                <td><input type="file" name="userfile" class="textBox" value="<?php echo $res_fetch['photo'];?>"/>
								<input type="hidden" name="currentphoto"  value="<?php echo $res_fetch['photo']?>" />
								<?php if((file_exists("upload/".$res_fetch['photo']))&&($res_fetch['photo']!='')) {  ?><img src="<?php echo "upload/".$res_fetch['photo'];?>" height="75" width="75" border="0"/><?php } else { ?><img src="upload/img_noimg.jpg" width="98" height="86" border="0" /><?php } ?><br /></td>
                              </tr>
                              
                              <tr>
                                <td class="prodcuts_search"><span class="redbold">*</span><?php echo $keyword; ?></td>
                                <td><input type="text" name="keyword" class="textBox" value="<?php echo $res_fetch['keyword'];?>"/></td>
                              </tr>
                              <tr>
                                <td class="prodcuts_search">&nbsp;&nbsp;<?php echo $more_kewords; ?> </td>
                                <td><input type="text" name="keyword1" class="textBoxSi" value="<?php echo $res_fetch['keyword1'];?>"/>
                                  <input type="text" name="keyword2" class="textBoxSi" value="<?php echo $res_fetch['keyword2'];?>"/></td>
                              </tr>
                              <tr>
                                <td class="prodcuts_search"> <span class="redbold">*</span><?php echo $category; ?></td>
                                <td><select name="p_cat" class="text" style="width:180px" onChange="Javascript:categorylist(this.value);">
                                  <option value=""><?php echo $sel; ?></option>
                                 <?php
								 $select_cate="SELECT * FROM category WHERE parent_id=''";
								 $res_cate=mysqli_query($con,$select_cate);
								 while($fetch_cate=mysqli_fetch_array($res_cate))
								 {
								 if($res_fetch['category']==$fetch_cate['c_id'])
								 {
								 $selected="SELECTED";
								 } 
								 else
								 {
								 $selected='';
								 }
								 ?>
								 <option value="<?php echo $fetch_cate['c_id']; ?>" <?php echo $selected; ?>><?php echo $fetch_cate['category']; ?></option>
									 <?php } ?>
                                </select></td>
                              </tr>
							  <tr>
							    <td class="prodcuts_search"><span class="redbold">*</span><?php echo $sub_cat; ?></td>
							    <td>
							   
								<div id="subcategory">
								  <select name="subcategory" class="text" id="subcat" style="width:180px ">
                                    <option value=""><?php echo $sel; ?></option>
									<?php 
									$cat_id=$res_fetch['category'];
									echo $select_sub="SELECT * FROM category WHERE parent_id='$cat_id'";
									$res_sub=mysqli_query($con,$select_sub);
									while($fetch_sub=mysqli_fetch_array($res_sub))
									{
									if($res_fetch['subcategory']==$fetch_sub['c_id'])
									{
									$selected="SELECTED";
									}
									else
									{
									$selected="";
									}
									?>
									<option value="<?php echo $fetch_sub['c_id']; ?>" <?php echo $selected; ?>><?php echo $fetch_sub['category']; ?></option>
									<?php } ?>
                                 
                                  </select>
								</div></td></tr>
                              <tr>
                                <td class="prodcuts_search"><span class="redbold">*</span><?php echo $breif_des; ?> </td>
                                <td><textarea name="briefdes" cols="40" value="" ><?php echo $res_fetch['briefdes'];?></textarea></td>
                              </tr>
                              <tr>
                                <td class="prodcuts_search">&nbsp;&nbsp;<?php echo $detail_des; ?></td>
                                <td><textarea name="detdes" cols="40" value="" class="texteditor"><?php echo $res_fetch['detdes'];?></textarea></td>
                              </tr>
                             
                              <tr>
                                <td class="prodcuts_search"><span class="redbold">*</span><?php echo $expired_date; ?></td>
                                <td><select name="valid" class="textBoxSi">
                                    <option value="<?php echo $res_fetch['valid'];?>"><?php echo $res_fetch['valid'];?></option>
									<option value="Select"><?php echo $sel; ?></option>
									<option value="1 Week">1 <?php echo $week; ?></option>
									<option value="2 Weeks">2 <?php echo $weeks; ?></option>
									<option value="1 Month">1 <?php echo $month; ?></option>
                                    <option value="12 Months">12 <?php echo $months; ?></option>
                                    <option value="6 Months">6 <?php echo $months; ?></option>
                                    <option value="4 Months">4 <?php echo $months; ?></option>
                                    <option value="2 Months">2 <?php echo $months; ?></option>
                                  </select>                                </td>
                              </tr>
                              <tr>
                                <td class="prodcuts_search"><span class="redbold">*</span><?php echo $contact_preference;?></td>
                                <td><input name="mycontact" type="radio" value="Allow all suppliers to contact me(More quotations)"<?PHP if($res_fetch['mycontact']=='Allow all suppliers to contact me(More quotations)'){?> checked="checked" <?php }?>/>
<?php echo $allow_more; ?></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input name="mycontact" type="radio" value="Allow all suppliers to contact me by email only while concealing my other contact details" <?PHP if($res_fetch['mycontact']=='Allow all suppliers to contact me by email only while concealing my other contact details'){?>  checked="checked" <?php }?>/>
                                <?php echo $allow_supliers; ?></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input name="mycontact" type="radio" value="Only paid suppliers may contact me(Less quotations)" <?PHP if($res_fetch['mycontact']=='Only paid suppliers may contact me(Less quotations)'){?> checked="checked" <?php }?>/>
                                <?php echo $less_only; ?></td>
                              </tr>
                              <tr>
                                <td colspan="2"><table width="100%">
                                    <tr>
                                      <td colspan="3" class="blackBo" style="padding:5px;font-size:16px "><strong><?php echo $my_reqirement; ?></strong></td>
                                    </tr>
                                    <tr>
										  <td width="40%" class="prodcuts_search"><span class="redbold">*</span><?php echo $price_range; ?></td>
                                      <td colspan="2"><select name="price" style="width:80px;">
                                          <!-- <option value="<?php //echo $res_fetch['price'];?>"><?php //echo $res_fetch['price'];?></option> -->
                                          
										  <option value="<?php echo $res_fetch['price'];?>"><?php echo $res_fetch['price'];?></option>
                                          <option value="GBP">GBP </option>
                                          <option value="RMB"> RMB </option>
                                          <option value="EUR"> EUR </option>
                                          <option value="AUD"> AUD </option>
                                          <option value="CAD"> CAD </option>
                                          <option value="CHF"> CHF </option>
                                          <option value="JPY"> JPY</option>
                                          <option value="HKD"> HKD </option>
                                          <option value="NZD"> NZD </option>
                                          <option value="SGD"> SGD </option>
                                          <option value="OTHER"> <?php echo $OTHER; ?> </option>
                                        </select>
                                        <input type="text" name="range1" style="width:80px;" value="<?php echo $res_fetch['range1'];?>"/>&nbsp;~&nbsp;                                        
                                        <input type="text" name="range2" style="width:80px;" value="<?php echo $res_fetch['range2'];?>"/></td>
                                  </tr>
                                    <tr>
                                      <td class="prodcuts_search"><span class="redbold">*</span><?php echo $minimum_order_qua; ?></td>
                                      <td width="27%"><input type="text" name="miniquantity" class="textBoxSi" value="<?php echo $res_fetch['miniquantity'];?>"/></td>
                                      <td width="33%"><select name="quantity" class="textBoxSi" >
<option value="<?php echo $res_fetch['quantity']; ?>" ><?php echo $res_fetch['quantity']; ?></option>
<option value="Unit"><?php echo $Unit; ?></option>
<option value="Bag/Bags" ><?php echo $bag; ?> </option>
<option value="Barrel/Barrels" > <?php echo $barrel; ?> </option>
<option value="Bushel/Bushels" ><?php echo $Bushel; ?></option>
<option value="Cubic meter" > <?php echo $cubic_meter; ?> </option>
<option value="Dozen" > <?php echo $Dozen; ?> </option>
<option value="Gallon"> <?php echo $Gallon ; ?> </option>
<option value="Gram" > <?php echo $Gram; ?></option>
<option value="Kilogram" ><?php echo $Kilogram; ?> </option>
<option value="Kilometer"><?php echo $Kilometer; ?> </option>
<option value="Long Ton" > <?php echo $long_ton; ?> </option>
<option value="Meter" > <?php echo $Meter; ?> </option>
<option value="Metric Ton"> <?php echo $metric_ton; ?></option>
<option value="Ounce" ><?php echo $Ounce; ?></option>
<option value="Pair" > <?php echo $Pair; ?> </option>
<option value="Pack/Packs"> <?php echo $pack; ?></option>
<option value="Piece/Pieces" > <?php echo $pieces; ?></option>
<option value="Pound" > <?php echo $pound; ?></option>
<option value="Set/Sets"><?php echo $set; ?></option>
<option value="Short Ton"> <?php echo $short_ton; ?></option>
<option value="Square Meter"> <?php echo $squre_meter; ?> </option>
<option value="Ton" ><?php echo $ton; ?> </option>
                                        </select>                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="prodcuts_search"><?php echo $certificat_require; ?></td>
                                      <td colspan="2"><textarea name="certificate" cols="35"><?php echo $res_fetch['certificate'];?></textarea></td>
                                    </tr>
                                </table></td>
                              </tr>
                        <!--  <onclick="switchDiv('tabTwo','tabOne'), swapTabs('tab2');">
						onclick="switchDiv('tabOne','tabTwo'), swapTabs('tab1');"-->
                              <tr>
                                <td colspan="2" align="center">
						<!--<input name="Submit" type="image" class="button2" value="Submit" src="images/bu_submit.gif" />-->
                                  <input type="submit" class="search_bg" name="Submit" value="<?php echo $submit; ?>" />
                                  <input type="button" class="search_bg" name="Submit2" value="<?php echo $cancel; ?>" onClick="javascript:history.back();"/></td>
                              </tr>
                            </table></td>
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
